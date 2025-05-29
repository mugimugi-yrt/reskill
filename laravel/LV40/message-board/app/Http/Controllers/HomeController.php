<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $messages = \Auth::user()->messages()->orderBy('created_at', 'desc')->paginate(10);
        return view('home.index', ['messages' => $messages]);
    }

    public function edit(Request $request)
    {
        $user = $request->user();
        return view('profile.edit', ['user' => $user]);
    }

    public function update(Request $request)
    {
        $user = $request->user();
        $user->name = $request->name;
        $user->save();
        return redirect(route('home'));
    }

    public function destroy(Request $request)
    {
        $user = $request->user();;
        $user->delete();
        \Auth::logout();
        return redirect('/');
    }
}