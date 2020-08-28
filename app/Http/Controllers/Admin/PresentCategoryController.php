<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PresentCategory;

class PresentCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'present_categories' => PresentCategory::all()->sortBy('name'),
        ];

        return view('admin.present-category.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.present-category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->has('name') && PresentCategory::create(['name' => $request->post('name')])) {
            session()->flash('msg_success', 'Новая категория успешно добавлена!');
        }
        else {
            session()->flash('msg_error', 'Произошла ошибка обратитесь к администратору!');
        }

        return redirect(route('present-category.index'));
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
            'present_category' => PresentCategory::findOrFail($id),
        ];
        return view('admin.present-category.edit', $data);
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
        if ($request->has('name') && $present_category = PresentCategory::findOrFail($id)) {
            $present_category->update(['name' => $request->post('name')]);
            session()->flash('msg_success', 'Категория успешно изменена!');
        }
        else {
            session()->flash('msg_error', 'Произошла ошибка обратитесь к администратору!');
        }

        return redirect(route('present-category.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $present_category = PresentCategory::findOrFail($id);

        if (!$present_category->presents->count()) {
            if ($present_category->delete()) {
                session()->flash('msg_success', 'Категория успешно удалена!');
            }
            else {
                session()->flash('msg_error', 'Произошла ошибка обратитесь к администратору!');
            }
        }
        else {
            session()->flash('msg_error', 'Невозможно удалить категорию, так как в данной категории еще есть призы!');
        }

        return redirect(route('present-category.index'));
    }
}
