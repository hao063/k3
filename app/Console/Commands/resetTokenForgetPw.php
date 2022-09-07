<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class resetTokenForgetPw extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:reset_token_forget_pw';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset token forget password';

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
     * @return int
     */
    public function handle()
    {
        $data = User::select('id')
                ->where("updated_at", "<" , now()->addMinutes(-5)->toDateTimeString())
                ->where("token", "<>", 1)
                ->where("token", "<>", null)
                ->update([
                    'token' => null,
                    'updated_at' => now()
                ]);
        return 0;
    }
}
