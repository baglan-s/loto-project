<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use App\Models\Present;
use Illuminate\Http\Request;
use App\Models\PresentCategory;
use App\Http\Controllers\Helpers\LotoController;
use App\Http\Controllers\Admin\ResultController;
use App\Models\RegionPresent;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'categories' => PresentCategory::all(),
        ];
        return view('index', $data);
    }

    public function presentByCategory(Request $request, $id)
    {
        $present_category = PresentCategory::findOrFail($id);
        $loto = new LotoController();
        $msg = '';
        $result = [];
        if ($request->has(['present_id'])) {
            $present = Present::find($request->post('present_id'));

            if ($present->category->id == 1) {
                while ($present->regions->first()->getPresentsAmount($present->id)) {
                    if ($city = $loto->getPresentCityRandomized($present->id)) {
                        if ($participant = $loto->getCityParticipantRandomized($city)) {
                            // Уменьшаем количество шансов и призов
                            ResultController::reduceAmounts($city, $participant, $present->id);
                            // Записываем результат
                            ResultController::setResult($participant->id, $present->id);
                            $result[] = [
                                'name' => $participant->name,
                                'card_number' => $participant->card_number,
                            ];
                        }
                    }

                    if (Participant::allChances() <= 0) {
                        $msg = empty($msg) ? 'Шансы участников закончились' : $msg;
                        break;
                    }
                }
            }
            else {
                if ($city = $loto->getPresentCityRandomized($present->id)) {
                    if ($participant = $loto->getCityParticipantRandomized($city)) {
                        // Уменьшаем количество шансов и призов
                        ResultController::reduceAmounts($city, $participant, $present->id);
                        // Записываем результат
                        ResultController::setResult($participant->id, $present->id);
                        $result[] = [
                            'name' => $participant->name,
                            'card_number' => $participant->card_number,
                        ];
                    }
                }
            }
        }

        $data = [
            'present_category' => $present_category,
            'msg' => $msg,
            'result' => $result,
        ];

        return view('present_by_category_enza', $data);

    }

    public function regionPresents()
    {
        $region_presents = RegionPresent::all();

        foreach ($region_presents as $regionPresent) {
            $regionPresent->nominal_region_amount = $regionPresent->region_amount;
            $regionPresent->save();
        }
    }
}
