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
}
