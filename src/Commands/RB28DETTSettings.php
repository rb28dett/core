<?php

namespace RB28DETT\RB28DETT\Commands;

use Illuminate\Console\Command;
use RB28DETT\Settings\Models\Settings;

class RB28DETTSettings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rb28dett:settings';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Shows all the rb28dett settings';

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

        $this->table(
            ['Base URL'], [
            [config('rb28dett.settings')['base_url']],
        ]);

        $this->table(
            ['API URL'], [
            [config('rb28dett.settings')['api_url']],
        ]);

        $s = Settings::first();

        $this->table(
            ['APP Name'], [
            [$s->appname],
        ]);

        $this->table(
            ['Description'], [
            [$s->description],
        ]);

        $this->table(
            ['Keywords'], [
            [$s->keywords],
        ]);

        $this->table(
            ['Author'], [
            [$s->author],
        ]);
    }
}
