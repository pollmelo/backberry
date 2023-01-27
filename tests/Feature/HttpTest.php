<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HttpTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $testData=[
            'name' => 'HTTP Test Test',
            'description' => 'This poll was created by the HTTP Test',
            'endDate' => '2023-01-31',
            'phase' => '1'
        ];
        $response = $this->post('/api/polls/create',$testData);

        $response->assertStatus(200);
    }
}
