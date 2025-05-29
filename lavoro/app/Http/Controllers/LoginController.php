<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * route('login'), route('register')の後に遷移
     * 管理者ならユーザー一覧画面表示のためのリダイレクト
     * ユーザーならプラン検索画面表示のためのリダイレクト
     *
     * @return \Illuminate\Http\Response
     */
    public function switch()
    {
        if (\Auth::user()->is_admin) {
            // 管理者
            return redirect(route('admin.users.index'));
        } else {
            // ユーザー
            return redirect(route('searches.top'));
        }
    }
}
