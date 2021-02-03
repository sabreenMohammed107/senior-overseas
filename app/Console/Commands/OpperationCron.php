<?php

namespace App\Console\Commands;

use App\Models\Operation;
use Illuminate\Console\Command;

class OpperationCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'opperation:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
    public function handle()
    {
        //
        \Log::info("Cron is working fine!");
        Operation::create(['operation_code'=>0]);
    }
}
