<?php

namespace RB28DETT\RB28DETT\Commands;

use Illuminate\Console\Command;
use RB28DETT\RB28DETT\Packages;

class RB28DETTPublish extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rb28dett:publish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish all the rb28dett vendor views and configurations';

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
        $this->call('rb28dett:info');

        $this->info('Looking for installed packages...');

        $packages = Packages::all();

        $this->call('rb28dett:packages');

        $this->line(' ');
        $this->comment('- Found '.count($packages).' packages installed');

        if ($this->confirm('Do you wish to continue?')) {
            $this->info('Publishing packages...');
            $this->line(' ');

            $bar = $this->output->createProgressBar(count($packages));

            foreach ($packages as $package) {
                $provider = Packages::provider($package);
                if ($provider) {
                    if (class_exists('RB28DETT\\'.ucfirst($package)."\\$provider")) {
                        $pr = 'RB28DETT\\'.ucfirst($package)."\\$provider";
                    } elseif (class_exists('RB28DETT\\'.strtoupper($package)."\\$provider")) {
                        $pr = 'RB28DETT\\'.strtoupper($package)."\\$provider";
                    }

                    if ($pr) {
                        $this->callSilent('vendor:publish', [
                            '--provider' => $pr,
                        ]);
                    }
                }
                $bar->advance();
            }
            $bar->finish();
            $this->line(' ');
            $this->line(' ');
            $this->info('All the packages were published!');
        } else {
            $this->error('Publishing stopped');
        }
    }
}
