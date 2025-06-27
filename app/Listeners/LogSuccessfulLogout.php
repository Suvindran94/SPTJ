<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use DB;

class LogSuccessfulLogout
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
public function handle(Logout $event)
{
    DB::table('login_logs')->insert([
        'user_id' => $event->user->id ?? null,
        'email' => $event->user->email ?? null,
        'event' => 'logout',
        'ip_address' => request()->ip(),
        'user_agent' => request()->userAgent(),
        'created_at' => now(),
        'updated_at' => now(),
    ]);
}

}
