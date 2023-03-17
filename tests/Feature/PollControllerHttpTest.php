<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Tests\TestCase;


class PollControllerHttpTest extends TestCase
{
    use RefreshDatabase;

    public function test_create(): void
    {
        $dateInFuture = Carbon::now()->addDays(7);

        $testData = [
            'name' => 'HTTP Test Test',
            'description' => 'This poll was created by the HTTP Test',
            'endDate' => $dateInFuture,
            'phase' => '1'
        ];
        $response = $this->post('/api/polls/create', $testData);

        $response->assertCreated();
        $this->assertDatabaseHas('polls', [
            'name' => 'HTTP Test Test',
        ]);
    }

    public function test_getAll(): void
    {
        $dateInFuture = Carbon::now()->addDays(7);

        $testPoll = [
            'name' => 'HTTP Test Test',
            'description' => 'This poll was created by the HTTP Test',
            'endDate' => $dateInFuture,
            'phase' => '1'
        ];

        $testVote = [
            'description' => '1',
            'pollId' => '1',
        ];

        $this->post('/api/polls/create', $testPoll);
        $this->post('/api/votes/create', $testVote);
        $this->post('/api/votes/create', $testVote);

        $response = $this->get('/api/polls/all');
        $response->assertJson([[
            'id' => 1,
            'name' => 'HTTP Test Test',
            'description' => 'This poll was created by the HTTP Test',
            'phase' => 1,
            'upvotes' => 2,
            'downvotes' => 0,
        ]
        ]);
}
}
