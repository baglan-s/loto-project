<?php

namespace App\Http\Controllers;

use App\Models\Participant;
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
            $present_id = $request->post('present_id');

            if ($city = $loto->getPresentCityRandomized($present_id)) {
                if ($participant = $loto->getCityParticipantRandomized($city)) {
                    // Уменьшаем количество шансов и призов
                    ResultController::reduceAmounts($city, $participant, $present_id);
                    // Записываем результат
                    ResultController::setResult($participant->id, $present_id);
                    $msg = 'Победитель: ' . $participant->name;
                }
                else {
                    $msg = 'В городе ' . $city->name . ' нет участников или шансы закончились';
                }
            }
            else {
                $msg = 'Призы закончились';
            }
        }

        $data = [
            'present_category' => $present_category,
            'msg' => $msg,
        ];

        return view('present_by_category', $data);

    }
}
