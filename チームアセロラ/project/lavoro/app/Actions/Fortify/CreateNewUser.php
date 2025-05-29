<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * route('register')等が呼び出されたとき
     * このcreateを使ってユーザーを登録する
     *
     * @param  array<string, string>  $input
     * @return \App\Models\User
     */
    public function create(array $input): User
    {
        // データ整形
        $full_name = $input['last_name'] . ' ' . $input['first_name'];
        $full_ruby = $input['last_ruby'] . ' ' . $input['first_ruby'];
        $full_address =
            $input['address_post'] . ', ' .
            $input['address_pref'] . ', ' .
            $input['address_town'] . ', ' .
            $input['address_street'] . ', ' .
            $input['address_num'];

        // ユーザー情報作成
        $user = new User();

        $user->name = $full_name;
        $user->ruby = $full_ruby;
        $user->email = $input['email'];
        $user->password = Hash::make($input['password']);
        $user->tel = $input['tel'];
        $user->company = $input['company'];
        $user->birthday = $input['birthday'];
        $user->address = $full_address;
        $user->gender = $input['gender'];
        $user->get_notice = $input['get_notice'];
        $user->is_admin = false;
        $user->is_deleted = false;

        $user->save();

        return $user;
    }
}
