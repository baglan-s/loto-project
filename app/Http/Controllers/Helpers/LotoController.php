<?php

namespace App\Http\Controllers\Helpers;

use App\Models\Participant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Present;

class LotoController extends Controller
{
    // Рандомизация города
    public function getPresentCityRandomized($present_id)
    {
        // Выбираем города у регионов которых количество призов больше нуля
        $cities = City::wherehas('region', function ($query) use ($present_id) {
            $query->whereHas('presents', function ($query) use ($present_id) {
                $query->where('presents.id', $present_id)->where('region_presents.region_amount', '>', 0);
            });
        });

        // Если такие города имеются возвращаем случайный город
        if ($cities->count()) {
            return $this->getRandomElement($cities->get());
        }

        return false;
    }

    // Рандомизация участника
    public function getCityParticipantRandomized($city)
    {
        // Проверка на наличие участников в данном городе
        if ($participants_count = $city->participants->count()) {
            // Выбираем только тех участников у которых количество шансов больше нуля
            $participants = $city->participants()->where('chance', '>', 0);

            // Возвращаем случайного участника из города
            if ($participants->count()) {
                return $this->getRandomElement($participants->get());
            }
        }

        return false;
    }

    private function getRandomKey($count)
    {
        return mt_rand(0, $count - 1);
    }

    private function getRandomElement($object)
    {
        $array = [];
        foreach ($object as $item) {
            $array[] = $item;
        }
        shuffle($array);
        return $array[0];
    }
}
