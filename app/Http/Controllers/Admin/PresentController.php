<?php

namespace App\Http\Controllers\Admin;

use App\Models\Present;
use App\Models\PresentCategory;
use App\Models\Region;
use App\Models\RegionPresent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PresentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'presents' => Present::all()->sortBy('created_at'),
        ];
        return view('admin.present.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'regions'               => Region::all()->sortBy('name'),
            'present_categories'    => PresentCategory::all(),
        ];
        return view('admin.present.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->has(['name', 'general_amount'])) {

            $present = Present::create([
                'name'                      => $request->post('name'),
                'present_category_id'       => $request->post('category'),
            ]);

            $regions = Region::all();

            foreach ($regions as $region) {
                RegionPresent::create([
                    'region_id' => $region->id,
                    'present_id' => $present->id,
                    'region_amount' => $request->post('region_amount_' . $region->id),
                    'nominal_region_amount' => $request->post('region_amount_' . $region->id),
                ]);
            }

            session()->flash('msg_success', 'Новый приз успешно добавлен!');
        }
        else {
            session()->flash('msg_error', 'Произошла ошибка обратитесь к администратору!');
        }

        return redirect(route('present.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.present.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $present = Present::findOrFail($id);
        $data = [
            'present'               => $present,
            'present_categories'    => PresentCategory::all(),
            'regions'               => Region::all(),
        ];
        return view('admin.present.edit', $data);
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
        if ($request->has(['name', 'category'])) {
            $present = Present::findOrFail($id);

            $present->update([
                'name'                  => $request->post('name'),
                'present_category_id'   => $request->post('category'),
            ]);
            $regions = Region::all();
            foreach ($regions as $region) {
                if (!$present->regions()->find($region->id)) {
                    RegionPresent::create([
                        'region_id' => $region->id,
                        'present_id' => $present->id,
                        'region_amount' => $request->post('region_amount_' . $region->id),
                        'nominal_region_amount' => $request->post('region_amount_' . $region->id),
                    ]);
                } else {
                    $present->regions()->updateExistingPivot($region->id, [
                        'region_amount' => $request->post('region_amount_' . $region->id),
                        'nominal_region_amount' => $request->post('region_amount_' . $region->id),
                    ]);
                }
            }

            session()->flash('msg_success', 'Новый приз успешно изменен!');
        }
        else {
            session()->flash('msg_error', 'Произошла ошибка обратитесь к администратору!');
        }

        return redirect(route('present.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($present = Present::findOrFail($id)) {
            Present::deleting(function ($present) {
                $present->regions()->detach();
            });
            $present->delete();

            session()->flash('msg_success', 'Приз успешно удален!');
        }
        else {
            session()->flash('msg_error', 'Произошла ошибка обратитесь к администратору!');
        }

        return redirect(route('present.index'));
    }
}
