<?php

namespace App\Jobs;

use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CancelConference implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $tries = 2;
    public $backoff = 5;
    // public $timeout = 20;
    
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->connection = 'database-cancellations';
        $this->queue = 'cancellations';
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        sleep(20);
        // throw new Exception();
        info('CancelConference Job.....');
    }
}
