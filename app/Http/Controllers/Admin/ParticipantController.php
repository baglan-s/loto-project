<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use App\Models\Participant;
use App\Models\Result;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ParticipantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'participants' => Participant::paginate(25),
        ];
        return view('admin.participant.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'cities' => City::all(),
        ];
        return view('admin.participant.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->has(['name', 'phone'])) {
            $this->setNewParticipant($request->all());
        }

        return redirect(route('participant.index'));
    }

    public function setNewParticipant($data = array())
    {
//        $participants = Participant::where('phone', $data['phone'])
//            ->orWhere('name', $data['name'])
//            ->get();

        $participants = Participant::where('name', $data['name'])->get();

        if (!$participants->count()) {
            $participant            = new Participant;
            $participant->name      = $data['name'];

            if (isset($data['phone'])) {
                $participant->phone = $data['phone'];
            }

            if (isset($data['card_number'])) {
                $participant->card_number = $data['card_number'];
            }

            if (isset($data['city_id'])) {
                $participant->city_id = $data['city_id'];
            }

            if (isset($data['city'])) {
                $city                   = City::where('name', $data['city'])->first();
                $participant->city_id   = 0;

                if (!empty($city)) {
                    $participant->city_id = $city->id;
                }
            }

            $participant->chance            = 1;
            $participant->nominal_chance    = 1;

            if (isset($data['chance'])) {
                $participant->chance            = $data['chance'];
                $participant->nominal_chance    = $data['chance'];
            }
        }
        else {
            $participant = $participants->first();
            $participant->chance++;
            $participant->nominal_chance++;
        }

        if ($participant->save()) {
            session()->flash('msg_success', 'Новый участник успешно добавлен!');
        }
        else {
            session()->flash('msg_error', 'Произошла ошибка обратитесь к администратору!');
        }
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
            'cities' => City::all(),
            'participant' => Participant::findOrFail($id),
        ];
        return view('admin.participant.edit', $data);
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
        if ($request->has(['name', 'phone'])) {
            $participant            = Participant::find($id);
            $participant->name      = $request->post('name');
            $participant->phone     = $request->post('phone');

            if ($request->has('card_number')) {
                $participant->card_number = $request->post('card_number');
            }

            if ($request->has('city')) {
                $participant->city_id = $request->post('city');
            }

            if ($request->has('chance')) {
                $participant->chance            = $request->post('chance');
                $participant->nominal_chance    = $request->post('chance');
            }

            if ($participant->save()) {
                session()->flash('msg_success', 'Новый участник успешно добавлен!');
            }
            else {
                session()->flash('msg_error', 'Произошла ошибка обратитесь к администратору!');
            }
        }

        return redirect(route('participant.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($participant = Participant::findOrFail($id)) {
            $participant->delete();

            session()->flash('msg_success', 'Участник успешно удален!');
        }
        else {
            session()->flash('msg_error', 'Произошла ошибка обратитесь к администратору!');
        }

        return redirect(route('participant.index'));
    }

    public function reset()
    {
        DB::table('participants')->truncate();
        DB::table('results')->truncate();

        session()->flash('msg_success', 'Участники успешно удалены!');

        return redirect(route('participant.index'));
    }

    public function import(Request $request)
    {
        if ($file = $request->file('import')) {
            $file->move('temp', $file->getClientOriginalName());
            $file_path = 'temp/' . $file->getClientOriginalName();

            $reader = IOFactory::createReaderForFile($file_path);
            $reader->setReadDataOnly(true);
            $spreadsheet = $reader->load($file_path);

            $worksheet = $spreadsheet->getActiveSheet();

            $highestRow = $worksheet->getHighestRow();
            $highestColumn = $worksheet->getHighestColumn();
            $highestColumnIndex = Coordinate::columnIndexFromString($highestColumn);
            $result = [];

            for ($row = 2; $row < $highestRow; $row++) {
                for ($col = 1; $col <= $highestColumnIndex; $col++) {
                    $key    = $worksheet->getCellByColumnAndRow($col, 1)->getValue();
                    $value  = $worksheet->getCellByColumnAndRow($col, $row)->getValue();

                    $result[$key] = $value;

                }
                $this->setNewParticipant($result);
            }

            if (file_exists($file_path)) unlink($file_path);

            session()->flash('msg_success', 'Участники успешно созданы!');
        }
        else {
            session()->flash('msg_error', 'Произошла ошибка обратитесь к администратору!');
        }

        return redirect(route('participant.index'));
    }
}
