<?php

namespace App\Http\Controllers;

use App\Models\Vote;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use function response;

class VoteController extends Controller
{
    public function create(Request $request): JsonResponse
    {
        $request->validate([
            'description' => 'required|boolean',
            'pollId' => 'required|exists:polls,id',
        ]);

        $pollId = $request->input('pollId');
        $description = $request->input('description');


        $vote = new Vote();
        $vote->poll_id = $pollId;
        $vote->description = (bool)$description;
        $vote->save();

        return response()->json($vote, status: 201);
    }
}
