<?php

namespace App\Console\Commands;

use App\Instagram\Instagram;
use Illuminate\Console\Command;

class RefreshInstagramFeed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'instagram:refresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refresh and recache the instagram feed';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Instagram $instagram)
    {
        $instagram->refresh(['username' => 'uptownertaichung']);
    }
}
