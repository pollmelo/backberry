<?php

namespace App\Http\Controllers;

use App\Models\Vote;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    public function create(Request $request): JsonResponse
    {
        $pollId = $request->input('poll_id');
        $description = $request->input('description');

        try {
            $vote = new Vote();
            $vote->poll_id = $pollId;
            $vote->description = (int)$description;
            $vote->save();
        } catch (Exception $e) {
            return \response()->json([
                'error' => 'Creation failed.',
            ], status: 500);
        }

        return \response()->json($vote, status: 201);
    }
}
