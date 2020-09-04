<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use App\Models\Present;
use Illuminate\Http\Request;
use App\Models\PresentCategory;
use App\Http\Controllers\Helpers\LotoController;
use App\Http\Controllers\Admin\ResultController;

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
        if ($request->has(['present_id'])) {
            $present = Present::find($request->post('present_id'));

            while ($present->regions->first()->getPresentsAmount($present->id)) {
                if ($city = $loto->getPresentCityRandomized($present->id)) {
                    if ($participant = $loto->getCityParticipantRandomized($city)) {
                        // Уменьшаем количество шансов и призов
                        ResultController::reduceAmounts($city, $participant, $present->id);
                        // Записываем результат
                        ResultController::setResult($participant->id, $present->id);
                        $msg .= 'Победитель: ' . $participant->name . '! Товар: ' . $present->name. '.<br>';
                    }
                }

                if (Participant::allChances() <= 0) {
                    $msg = empty($msg) ? 'Шансы участников закончились' : $msg;
                    break;
                }
            }
        }

        $data = [
            'present_category' => $present_category,
            'msg' => $msg,
        ];

        return view('present_by_category', $data);

    }
}
