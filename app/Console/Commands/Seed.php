<?php

namespace App\Console\Commands;

use App\Models\Poll;
use Database\Factories\PollFactory;
use Illuminate\Console\Command;

class Seed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seed';

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
    public function handle()
    {
        Poll::factory()->count(5)->create();
        return Command::SUCCESS;
    }
}
