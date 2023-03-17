<?php

namespace App\Console\Commands;

use App\Models\Poll;
use App\Models\Vote;
use Database\Factories\PollFactory;
use Illuminate\Console\Command;

class Seed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seed {amountOfPolls=10}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Use factory to seed db.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $randCountOfVotes = rand(10, 150);

        Poll::factory()
            ->count((int)$this->argument("amountOfPolls"))
            ->has(Vote::factory()->count($randCountOfVotes))
            ->create();

        return Command::SUCCESS;
    }
}
