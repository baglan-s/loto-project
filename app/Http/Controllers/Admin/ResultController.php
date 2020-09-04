<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RegionPresent;
use App\Models\Participant;
use App\Models\Result;

class ResultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'results' => Result::paginate(15),
        ];
        return view('admin.result.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $data = [
            'results' => Result::paginate(15),
        ];
        return view('admin.result.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = Result::findOrFail($id);

        if ($result->delete()) {
            session()->flash('msg_success', 'Результат успешно удален!');
        }
        else {
            session()->flash('msg_error', 'Произошла ошибка обратитесь к администратору!');
        }

        return redirect(route('result.index'));
    }

    public function reset()
    {
        $participants       = Participant::all();
        $region_presents    = RegionPresent::all();
        $results            = Result::all();

        foreach ($participants as $participant) {
            $participant->chance = $participant->nominal_chance;
            $participant->save();
        }

        foreach ($region_presents as $regionPresent) {
            $regionPresent->region_amount = $regionPresent->nominal_region_amount;
            $regionPresent->save();
        }

        foreach ($results as $result) {
            $result->delete();
        }
        session()->flash('msg_success', 'Результаты успешно сброшены!');

        return redirect()->back();
    }

    public static function reduceAmounts(object $city, object $participant, $present_id)
    {
        // Уменьшаем шанс участника
        $participant->chance--;
        $participant->save();

        // Уменьшаем количество товара по региону
        $city->region->presents()->updateExistingPivot($present_id, [
            'region_amount' => (int)$city->region->getPresentAmountByRegion($present_id) - 1
        ]);
    }

    public static function setResult($participant_id, $present_id)
    {
        return Result::create([
            'participant_id'    => $participant_id,
            'present_id'        => $present_id,
        ]);
    }
}
