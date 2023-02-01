<?php

namespace App\Http\Controllers;

use App\Models\Poll;
use App\Models\Vote;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PollController extends Controller
{
    public function create(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|max:255|unique:polls,name',
            'description' => 'required',
            'endDate' => 'required|date|after:today',
            'phase' => 'nullable|integer|min:1',
        ]);

        $name = $request->input('name');
        $description = $request->input('description');
        $endDate = $request->input('endDate');
        $phase = $request->input('phase');

        $poll = new Poll();
        $poll->name = $name;
        $poll->description = $description;
        $poll->end_date = $endDate;

        if ($phase != null) {
            $poll->phase = $phase;
        }

        $poll->save();

        return response()->json($poll, status: 201);
    }

    public function getPoll(Request $request, int $id): JsonResponse
    {
        $poll = Poll::find($id);
        $votes = $poll->votes()->get();
        $upvotes = 0;
        $downvotes = 0;
        foreach ($votes as $value) {
            if ($value->description == 0) {
                $downvotes += 1;
            }

            if ($value->description == 1) {
                $upvotes += 1;
            }
            unset($value); 
        }

        return response()->json([$poll, $upvotes, $downvotes], status: 200);
    }
}
