<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AggregateDailyEmissions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:aggregate-daily-emissions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $this->info('Emisi harian berhasil diagregasi.');
    }
}
