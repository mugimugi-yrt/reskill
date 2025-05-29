<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * メニューバーから遷移
     * 管理者登録依頼画面を表示
     *
     * @return \Illuminate\Http\Response
     */
    public function request()
    {
        return view('auth.request');
    }

    public function request_check(Request $request)
    {
        $validateData = $this->validate($request, [
            'email'          => 'required|string|max:100',
            'password'       => 'required',
        ]);

        return view('check.request', ['formData' => $validateData]);
    }
}
