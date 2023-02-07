<?php

namespace App\DTOs\HttpApi;

readonly class PollDataTransferObject
{
    public int $id;
    public string $name;
    public string $description;
    public DateTime $endDate;
    public int $phase;
    public int $upvotes;
    public int $downvotes;
    public DateTime $createdAt;
    public DateTime $updatedAt;

    function __construct(int $id, string $name, string $description, int $phase, int $upvotes, int $downvotes, DateTime $createdAt, DateTime $updatedAt)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->phase = $phase;
        $this->upvotes = $upvotes;
        $this->downvotes = $downvotes;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }
}
