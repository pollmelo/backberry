<?php

namespace App\DTOs\HttpApi;

use DateTime;

readonly class PollDataTransferObject
{
    public int $id;
    public string $name;
    public string $description;
    public DateTime $endDate;
    public int $phase;
    public int $upvotes;
    public int $downvotes;
    public DateTime $created_at;
    public DateTime $updated_at;

    function __construct(int $id, string $name, string $description, DateTime $endDate, int $phase, int $upvotes, int $downvotes, DateTime $created_at, DateTime $updated_at)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->endDate = $endDate;
        $this->phase = $phase;
        $this->upvotes = $upvotes;
        $this->downvotes = $downvotes;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }
}
