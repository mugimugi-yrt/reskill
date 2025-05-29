<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // (point) ユーザ情報取得はリクエストから
        $user = $request->user();
        return view('home.index', ['user' => $user]);
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
        return view('home.index', ['user' => $user]);
    }

    public function destroy(Request $request)
    {
        $user = $request->user();;
        $user->delete();
        \Auth::logout();
        return redirect('/');
    }
}