<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Region;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'regions' => Region::all()->sortBy('name'),
        ];
        return view('admin.region.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.region.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->has('name') && Region::create(['name' => $request->post('name')])) {
            session()->flash('msg_success', 'Новый регион успешно добавлен!');
        }
        else {
            session()->flash('msg_error', 'Произошла ошибка обратитесь к администратору!');
        }

        return redirect(route('region.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = ['region' => Region::findOrFail($id)];
        return view('admin.region.show', $data);
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
            'region' => Region::findOrFail($id),
        ];
        return view('admin.region.edit', $data);
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
        if ($request->has('name') && $region = Region::findOrFail($id)) {
            $region->update(['name' => $request->post('name')]);
            session()->flash('msg_success', 'Регион успешно изменен!');
        }
        else {
            session()->flash('msg_error', 'Произошла ошибка обратитесь к администратору!');
        }

        return redirect(route('region.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $region = Region::findOrFail($id);

        if (!$region->cities->count()) {
            if ($region->delete()) {
                session()->flash('msg_success', 'Регион успешно удален!');
            }
            else {
                session()->flash('msg_error', 'Произошла ошибка обратитесь к администратору!');
            }
        }
        else {
            session()->flash('msg_error', 'Невозможно удалить регион, так как в данном регионе еще есть города!');
        }

        return redirect(route('region.index'));
    }

    public function deleteCity($region_id, $city_id)
    {
        $city = City::findOrFail($city_id);
        $city->region_id = null;

        if ($city->save()) {
            session()->flash('msg_success', 'Город успешно удален из региона!');
        }
        else {
            session()->flash('msg_error', 'Произошла ошибка обратитесь к администратору!');
        }

        return redirect(route('region.show', $region_id));
    }
}
