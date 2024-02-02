<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class InstallAndRun extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:install-and-run';

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


        $this->info('installing NPM');
        exec('npm install');

        $this->info('running migrations');
        exec('php artisan migrate');

        $this->info('seeding database...');
        exec('php artisan db:seed');

        $this->info('Running npm run dev');
        exec('npm run build');

        $this->info('starting the application...');
        exec('php artisan serve');
    }
}
