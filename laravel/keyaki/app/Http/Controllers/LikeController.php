<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function index()
    {
        $books = \Auth::user()->likeBooks()->orderBy('created_at', 'desc')->paginate(20);
        return view('likes.index', ['books' => $books]);
    }

    // お気に入り登録
    public function store(Request $request)
    {
        $request->user()->likeBooks()->attach($request->book_id);
        return back();
    }

    // お気に入りの解除
    public function destroy(Request $request)
    {
        $request->user()->likeBooks()->detach($request->book_id);
        return back();
    }
}
