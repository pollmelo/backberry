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
        $upvotes = $votes->where('description', true)->count();
        $downvotes = $votes->where('description', false)->count();

        $convertedPoll = [
            "id" => $poll->id,
            "name" => $poll->name,
            "description" => $poll->description,
            "endDate" => $poll->end_date,
            "phase" => $poll->phase,
            "upvotes" => $upvotes,
            "downvotes" => $downvotes,
            "createdAt" => $poll->created_at,
            "updatedAt" => $poll->updated_at,
        ];
        
        return response()->json($convertedPoll, status: 200);
    }

    public function getAll(): JsonResponse
    {
        $polls = Poll::all();
        $convertedPolls = [];

        foreach ($polls as $poll) {
            $votes = $poll->votes();
            $upvotes = $votes->where('description', true)->count();
            $downvotes = $votes->where('description', false)->count();

            $convertedPoll = [
                "id" => $poll->id,
                "name" => $poll->name,
                "description" => $poll->description,
                "endDate" => $poll->end_date,
                "phase" => $poll->phase,
                "upvotes" => $upvotes,
                "downvotes" => $downvotes,
                "createdAt" => $poll->created_at,
                "updatedAt" => $poll->updated_at,
            ];

            $convertedPolls[] = $convertedPoll;
        }

        return response()->json($convertedPolls);
    }
}
