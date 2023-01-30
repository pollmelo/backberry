<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class HttpTest extends TestCase
{
    use RefreshDatabase;

    public function test_create(): void
    {

        $testData = [
            'name' => 'HTTP Test Test',
            'description' => 'This poll was created by the HTTP Test',
            'endDate' => '2023-01-31',
            'phase' => '1'
        ];
        $response = $this->post('/api/polls/create', $testData);

        $response->assertCreated();
        $this->assertDatabaseHas('polls', [
            'name' => 'HTTP Test Test',
        ]);
    }
}
