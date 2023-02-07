<?php

namespace App\Converter;

use App\DTOs\HttpApi\PollDataTransferObject;
use App\Models\Poll;



class PollDataTransferObjectConverter
{
    public function convert(Poll $poll, int $upvotes, int $downvotes)
    {
        $pollDataTransferObject = new PollDataTransferObject(
            $poll->id,
            $poll->name,
            $poll->description,
            $poll->end_date,
            $poll->phase,
            $upvotes,
            $downvotes,
            $poll->created_at,
            $poll->updated_at,
        );

        return $pollDataTransferObject;
    }
}
