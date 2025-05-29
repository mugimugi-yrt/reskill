<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function index()
    {
        $messages = \Auth::user()->likeMessages()->orderBy('created_at', 'desc')->paginate(20);
        return view('messages.index', ['messages' => $messages]);
    }

    // お気に入り登録
    public function store(Request $request)
    {
        $request->user()->likeMessages()->attach($request->message_id);
        return back();
    }

    // お気に入りの解除
    public function destroy(Request $request)
    {
        $request->user()->likeMessages()->detach($request->message_id);
        return back();
    }
}
