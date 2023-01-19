<?php

namespace App\Console\Commands;

use App\Jobs\ProcessPayment;
use App\Jobs\ProvisionForgeServer;
use App\Jobs\SendVerificationMessage;
use App\Jobs\SendWebhook;
use Illuminate\Console\Command;

class TestJobCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:job';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected $jobHandler = [
        'SendVerificationEmail' => SendVerificationMessage::class,
        'ProcessPayment' => ProcessPayment::class,
        'SendWebhook' => SendWebhook::class,
        'ProvisionForgeServer' => ProvisionForgeServer::class,
    ];


    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $job = $this->choice('Which job do you want to test?', array_keys($this->jobHandler));
        app($this->jobHandler[$job])->dispatch();
        $this->info("Dispatch $job successfully!");
        return Command::SUCCESS;
    }
}
