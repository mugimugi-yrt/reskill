<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function check() {
        if (\Auth::user()->name == 'admin') {
            return redirect(route('likes.index'));
        } else {
            return redirect(route('mypage'));
        }
    }

    public function index()
    {
        // my books
        $books = \Auth::user()->books()->orderBy('created_at', 'desc')->paginate(20);
        return view('home.index', ['books' => $books]);
    }

}
