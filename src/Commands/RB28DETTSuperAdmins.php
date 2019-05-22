<?php

namespace RB28DETT\RB28DETT\Commands;

use Illuminate\Console\Command;
use RB28DETT\Users\Models\User;

class RB28DETTSuperAdmins extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rb28dett:superadmins';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Shows all the rb28dett superadmins';

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
        $headers = ['Email', 'Name', 'Creation Date'];

        $admins = collect(config('rb28dett.superadmins'))->map(function ($admin) {
            $data = [$admin, '-', '-'];

            $user = User::where('email', $admin)->first();

            if ($user) {
                $data[1] = $user->name;
                $data[2] = $user->created_at;
            }

            return $data;
        });

        $this->line(' ');
        $this->comment('- Found '.count($admins).' superadmins');
        $this->line(' ');

        $this->table($headers, $admins);
    }
}
