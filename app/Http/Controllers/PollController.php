<?php

namespace App\Http\Controllers;

use App\Models\Poll;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PollController extends Controller
{
    public function create(Request $request): Response
    {
        $name = $request->input('name');
        $description = $request->input('description');
        $endDate = $request->input('endDate');
        $phase = $request->input('phase');

        $poll = new Poll();
        $poll->name = $name;
        $poll->description = $description;
        $poll->end_date = $endDate;
        $poll->phase = $phase;

        $poll->save();
        return response('entry created',201);
    }
}
