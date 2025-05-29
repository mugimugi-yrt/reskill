<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use Illuminate\Auth\Events\Authenticated;
use Illuminate\Support\Facades\Session;

class RedirectAfterLogin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(Authenticated $event)
    {
        // $user = $event->user;

        // if ($user->name == 'admin') {
        //     Session::put('url.intended', route('home'));
        // } else {
        //     Session::put('url.intended', route('likes.index'));
        // }
    }
}
