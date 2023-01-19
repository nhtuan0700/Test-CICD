<?php

namespace App\Jobs;

use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProvisionForgeServer implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $tries = 20;
    public $maxExceptions = 3; 

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->attempts() % 2 == 0) {
            throw new Exception('Provision Forge Server with max 3 exception times');
        }
        return $this->release(now()->addSecond(5));
    }

    public function failed(Exception $e)
    {
        info('Loi ne: ' . $e->getMessage());
    }
}
