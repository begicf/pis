<?php

namespace App\Http\Controllers;


class Calendar extends Controller
{
    public function index()
    {

        $event = \App\Models\Calendar::prepareEventsJson();

        return view('create', compact($event));
    }
}
