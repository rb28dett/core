<?php

namespace RB28DETT\RB28DETT\Commands;

use Illuminate\Console\Command;

class RB28DETTInfo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rb28dett:info';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Shows the rb28dett logo';

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
        $this->comment('                                                      ');
        $this->comment(' _____  ____ ___   ___  _____  ______ _______ _______ ');
        $this->comment('|  __ \|  _ \__ \ / _ \|  __ \|  ____|__   __|__   __|');
        $this->comment('| |__) | |_) | ) | (_) | |  | | |__     | |     | |   ');
        $this->comment("|  _  /|  _ < / / > _ <| |  | |  __|    | |     | |   ");
        $this->comment('| | \ \| |_) / /_| (_) | |__| | |____   | |     | |   ');
        $this->comment("|_|  \_\____/____|\___/|_____/|______|  |_|     |_|   ");
        $this->comment('                                                      ');
        $this->comment('             RB28DETT Administration Panel            ');
        $this->comment('                                                      ');
        $this->line(' ');
    }
}
