<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use App\Models\Participant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
            'participants' => Participant::paginate(15),
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
            $participants = Participant::where('phone', $request->post('phone'))
                ->orWhere('name', $request->post('name'))
                ->get();

            if (!$participants->count()) {
                $participant            = new Participant;
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
            }
            else {
                $participant = $participants->first();
                $participant->chance++;
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
}
