<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use Laravel\Fortify\Fortify;

class CustomAuthenticatedSessionController extends AuthenticatedSessionController
{
    public function store(Request $request)
    {
    //     $request->validate([
    //     Fortify::username() => 'required|string',
    //     'password' => 'required|string',
    // ]);

    // if (! \Auth::attempt($request->only(Fortify::username(), 'password'), $request->boolean('remember'))) {
    //     throw ValidationException::withMessages([
    //         Fortify::username() => [trans('auth.failed')],
    //     ]);
    // }

    // $request->session()->regenerate();

    // $user = Auth::user();

    // return redirect()->intended($user->name == 'admin' ? route('likes.index') : route('books.index'));
        // $user = \Auth::user();

        // if ($user->name == 'admin') {
        //     return redirect(route('likes.index'));
        // }

        // return redirect(route('books.index'));
    }
}
