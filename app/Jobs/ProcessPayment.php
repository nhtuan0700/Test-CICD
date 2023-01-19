<?php

namespace App\Jobs;

use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessPayment implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $tries = 3;
    public $backoff = 6;
    // public $maxExceptions = 1;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->queue = 'payments';
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // throw new Exception('ProcessPaymentException');
        info('Process Payment .....');
        return $this->release(now()->addSeconds(3));
    }

    public function failed(Exception $e)
    {
        info('Failed to process payment');
    }
}
