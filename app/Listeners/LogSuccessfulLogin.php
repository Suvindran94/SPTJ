<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use DB;

class LogSuccessfulLogin
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
public function handle(Login $event)
{
      \Log::info('LogSuccessfulLogin triggered', [
        'user_id' => $event->user->id,
        'ip' => request()->ip(),
    ]);
    
    DB::table('login_logs')->insert([
        'user_id' => $event->user->id,
        'email' => $event->user->email,
        'event' => 'login',
        'ip_address' => request()->ip(),
        'user_agent' => request()->userAgent(),
        'created_at' => now(),
        'updated_at' => now(),
    ]);
}

}
