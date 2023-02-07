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

}
