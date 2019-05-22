<?php

namespace RB28DETT\RB28DETT\Commands;

use Illuminate\Console\Command;
use RB28DETT\RB28DETT\Packages;

class RB28DETTPackages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rb28dett:packages';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Shows all the rb28dett installed packages';

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
        $headers = ['Package List'];

        $packages = collect(Packages::all())->map(function ($package) {
            return [ucfirst($package)];
        });

        $this->table($headers, $packages);
    }
}
