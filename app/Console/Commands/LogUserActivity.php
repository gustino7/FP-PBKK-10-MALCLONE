<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use \Illuminate\Support\Facades\Auth;
use \Illuminate\Support\Facades\Storage;

class LogUserActivity extends Command
{
    protected $signature = 'log:user-activity';

    protected $description = 'Log user activity';

    public function handle()
    {
        $currentTime = Carbon::now()->toDateTimeString();
        $userId = Auth::id();
        $logMessage = "User activity logged at: " . $currentTime . ", User ID: " . $userId;

        Storage::append('user_activity.log', $logMessage);

        $this->info('User activity logged successfully.');
    }
}
