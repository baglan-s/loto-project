<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Region;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'cities' => City::all()->sortBy('name'),
        ];
        return view('admin.city.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'regions' => Region::all()->sortBy('name'),
        ];
        return view('admin.city.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->has(['name', 'region'])) {
            City::create([
                'name' => $request->post('name'),
                'region_id' => $request->post('region'),
            ]);
            session()->flash('msg_success', 'Новый город успешно добавлен!');
        }
        else {
            session()->flash('msg_error', 'Произошла ошибка обратитесь к администратору!');
        }

        return redirect(route('city.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [
            'city'      => City::findOrFail($id),
            'regions'   => Region::all()->sortBy('name'),
        ];

        return view('admin.city.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->has(['name', 'region']) && $city = City::findOrFail($id)) {
            $city->update([
                'name' => $request->post('name'),
                'region_id' => $request->post('region'),
            ]);
            session()->flash('msg_success', 'Город успешно изменен!');
        }
        else {
            session()->flash('msg_error', 'Произошла ошибка обратитесь к администратору!');
        }

        return redirect(route('city.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $city = City::findOrFail($id);

        if ($city->delete()) {
            session()->flash('msg_success', 'Город успешно удален!');
        }
        else {
            session()->flash('msg_error', 'Произошла ошибка обратитесь к администратору!');
        }

        return redirect(route('city.index'));//
    }
}
