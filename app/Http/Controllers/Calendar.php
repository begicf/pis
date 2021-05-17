<?php

namespace App\Http\Controllers;

class Calendar extends Controller
{
    public function index()
    {

        return view('create');
    }


    public function event()
    {

        $model = new \App\Models\Calendar();

        $model->event_id = uniqid();
        $model->event_name = request('event_name');
        $model->event_description = request('event_description');
        $model->start_date = request('start_date');
        $model->end_date = request('end_date');
        $model->event_color = request('event_color')??'#3568ba';
        if ($model->save()) {
            return \redirect('/home')->with('status', 'Successful saved');
        }
    }
}
