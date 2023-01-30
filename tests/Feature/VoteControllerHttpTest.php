<?php

namespace Tests\Feature;

use App\Models\Poll;
use DateTime;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class VoteControllerHttpTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @return void
     */
    public function create_accessAsGetRequest_returns405StatusCode(): void
    {
        $response = $this->get(route('vote.create'));

        $response->assertStatus(405);
    }

    /**
     * @test
     * @return void
     */
    public function create_accessAsPostRequestWithoutData_returns500StatusCode(): void
    {
        $response = $this->post(route('vote.create'));

        $response->assertStatus(500);
    }

    /**
     * @test
     * @return void
     */
    public function create_addVoteForNotExistingPoll_returns500StatusCodeAndJsonError(): void
    {
        $response = $this->post(route('vote.create'), [
            'poll_id' => 1,
            'description' => 1
        ]);

        $response->assertJson([
            'error' => 'Creation failed.',
        ]);
        $response->assertStatus(500);
    }

    /**
     * @test
     * @return void
     */
    public function create_addVoteForExistingPoll_returns201StatusCode(): void
    {
        $dateInFuture = Carbon::now()->addDays(7);

        Poll::create([
            'name' => 'Should we add tests?',
            'description' => 'Bla.',
            'end_date' => $dateInFuture,
            'phase' => 1,
        ]);

        $response = $this->post(route('vote.create'), [
            'poll_id' => 1,
            'description' => 1,
        ]);

        $response->assertStatus(201);
    }

    /**
     * @test
     * @return void
     */
    public function create_addVoteForExistingPoll_createsDatabaseEntries(): void
    {
        $dateInFuture = Carbon::now()->addDays(7);

        Poll::create([
            'name' => 'Should we add tests?',
            'description' => 'Bla.',
            'end_date' => $dateInFuture,
            'phase' => 1,
        ]);

        $response = $this->post(route('vote.create'), [
            'poll_id' => 2,
            'description' => 1,
        ]);

        $this->assertDatabaseCount('polls', 1);
        $this->assertDatabaseCount('votes', 1);
        $this->assertDatabaseHas('polls', [
            'id' => 2
        ]);
        $this->assertDatabaseHas('votes', [
            'poll_id' => 2
        ]);
    }
}
