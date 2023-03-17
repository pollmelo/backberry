<?php

namespace Tests\Feature;

use App\Models\Poll;
use Illuminate\Foundation\Testing\RefreshDatabase;
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
        $response = $this->get(route('votes.create'));

        $response->assertStatus(405);
    }

    /**
     * @test
     * @return void
     */
    public function create_accessAsPostRequestWithoutData_returns422StatusCode(): void
    {
        $response = $this->post(route('votes.create'), headers: [
            'X-Requested-With' => 'XMLHttpRequest',
            'Accept' => 'application/json',
        ]);

        $response->assertStatus(422);
    }

    /**
     * @test
     * @return void
     */
    public function create_addVoteForNotExistingPoll_returns422StatusCodeAndJsonError(): void
    {
        $response = $this->post(route('votes.create'), data: [
            'pollId' => 1,
            'description' => 1
        ], headers: [
            'X-Requested-With' => 'XMLHttpRequest',
            'Accept' => 'application/json',
        ]);

        $response->assertJson([
            'message' => 'The selected poll id is invalid.',
            'errors' => ['pollId' => ['The selected poll id is invalid.']],
        ]);
        $response->assertStatus(422);
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

        $response = $this->post(route('votes.create'), [
            'pollId' => 1,
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

        $poll = new Poll();
        $poll->name = 'Should we add tests?';
        $poll->description = 'Bla.';
        $poll->end_date = $dateInFuture;
        $poll->phase = 1;
        $poll->save();

        $this->post(route('votes.create'), [
            'pollId' => $poll->id,
            'description' => 1,
        ]);

        $this->assertDatabaseCount('polls', 1);
        $this->assertDatabaseHas('polls', [
            'id' => $poll->id
        ]);
        $this->assertDatabaseCount('votes', 1);
        $this->assertDatabaseHas('votes', [
            'poll_id' => $poll->id
        ]);
    }
}
