<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelloController extends Controller
{
    public function index(Request $request) {
        $name = $request->name ?? "名無し";
        return view("hello", ['name' => $name]);
    }
}
