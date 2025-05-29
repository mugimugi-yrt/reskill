<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;
use App\Actions\Fortify\CreateNewUser;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin.index', ['users' => $users]);
    }

    /**
     * ユーザー一覧画面から遷移
     * ユーザー情報登録画面を表示
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new User();
        return view('admin.create', ['user' => $user]);
    }

    /**
     * ユーザー情報作成画面から遷移
     * requestから内容を取得し、確認画面を表示
     * requestの内容を配列にして渡す
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create_check(Request $request)
    {
        // 基本入力validation
        $validator = Validator::make($request->all(), [
            'first_name'     => 'required|string',
            'last_name'      => 'required|string',
            'first_ruby'     => 'required|string',
            'last_ruby'      => 'required|string',
            'password'       => 'required|confirmed',
            'email'          => 'required|string|max:100',    // email format validation は今後検討
            'tel'            => 'required|string',            // tel format validation は今後検討
            'company'        => 'required|string|max:50',
            'birthday'       => 'required|date',
            'address_post'   => 'required|regex:/^\d{3}-\d{4}$/',
            'address_pref'   => 'required|string',
            'address_town'   => 'required|string',
            'address_street' => 'required|string',
            'address_num'    => 'required|string',
            'gender'         => 'required',
            'get_notice'     => 'required|boolean',
        ], [
            // 郵便番号validation
            'address_post.regex' => '郵便番号は「123-4567」の形式で入力してください。',
        ]);

        // 氏名の合計文字数が50文字を超えていたらエラー
        $full_name = $request->last_name . $request->first_name;
        if (mb_strlen($full_name) > 50) {
            $validator->errors()->add('full_name', '氏名（姓＋名）は50文字以内で入力してください。');
        }

        // 氏名のフリガナの合計文字数が50文字を超えていたらエラー
        $full_ruby = $request->last_ruby . $request->first_ruby;
        if (mb_strlen($full_ruby) > 50) {
            $validator->errors()->add('full_ruby', 'フリガナ（セイ＋メイ）は50文字以内で入力してください。');
        }

        // 住所の合計文字数が100文字を超えていたらエラー
        // address = "address_post, address_pref, address_town, address_street, address_num" (実データには/は入っていない)
        $full_address = 
            $request->address_post . ', '.
            $request->address_pref . ', '.
            $request->address_town . ', '.
            $request->address_street . ', '.
            $request->address_num;
        if (mb_strlen($full_address) > 100) {
            $validator->errors()->add('full_address', '住所全体は100文字以内で入力してください。');
        }

        // エラーがあれば戻る
        if ($validator->errors()->count() > 0) {
            // (memo) flashメッセージは、$validatorを使っている？？
            return back()->withInput()->withErrors($validator);
        }

        // validation通過後、確認画面へ
        $validated_data = $validator->validated();
        return view('check.admin_create', ['formData' => $validated_data]);
    }

    /**
     * ユーザー情報作成の確認画面から遷移
     * 確認画面でvalidateされたrequestから内容を取得し、
     * 内容を整形して新たなデータを作成する (CreateNewUserのcreate)
     * その後、showメソッドにリダイレクト
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // CreateNewUser::create() に $request->all() を渡す
        $creator = App::make(CreateNewUser::class);
        $user = $creator->create($request->all());

        // ユーザー詳細ページへリダイレクト
        return redirect(route('admin.users.show', ['user' => $user->id]));
    }

    /**
     * create、edit、index画面から遷移
     * ユーザーの詳細画面の表示
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('admin.show', ['user' => $user]);
    }

    /**
     * ユーザー情報詳細画面から遷移
     * ユーザー情報編集画面を表示
     * 引数のidはupdateまで大事に取っておく
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.edit', ['user' => $user]);
    }

    /**
     * ユーザー情報編集画面から遷移
     * requestから内容を取得し、確認画面を表示
     * requestの内容を配列にして渡す
     * ここではidは使わないが、次のupdateで使うので大事に取っておく
     *
     * @param  \Illuminate\Http\Request  $request, int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit_check(Request $request, $id)
    {
        // 基本入力validation
        $validator = Validator::make($request->all(), [
            'first_name'     => 'required|string',
            'last_name'      => 'required|string',
            'first_ruby'     => 'required|string',
            'last_ruby'      => 'required|string',
            'password'       => 'required|confirmed',         // 最小文字数の変更は今後検討
            'email'          => 'required|string|max:100',    // email format validation は今後検討
            'tel'            => 'required|string',            // tel format validation は今後検討
            'company'        => 'required|string|max:50',
            'birthday'       => 'required|date',
            'address_post'   => 'required|regex:/^\d{3}-\d{4}$/',
            'address_pref'   => 'required|string',
            'address_town'   => 'required|string',
            'address_street' => 'required|string',
            'address_num'    => 'required|string',
            'gender'         => 'required|string',
            'get_notice'     => 'required|boolean',
        ], [
            
            
            // 郵便番号validation
            'address_post.regex' => '郵便番号は「123-4567」の形式で入力してください。',
        ]);

        // 氏名の合計文字数が50文字を超えていたらエラー
        $full_name = $request->last_name . $request->first_name;
        if (mb_strlen($full_name) > 50) {
            $validator->errors()->add('full_name', '氏名（姓＋名）は50文字以内で入力してください。');
        }

        // 氏名のフリガナの合計文字数が50文字を超えていたらエラー
        $full_ruby = $request->last_ruby . $request->first_ruby;
        if (mb_strlen($full_ruby) > 50) {
            $validator->errors()->add('full_ruby', 'フリガナ（セイ＋メイ）は50文字以内で入力してください。');
        }

        // 住所の合計文字数が100文字を超えていたらエラー
        // address = "address_post, address_pref, address_town, address_street, address_num" (実データには/は入っていない)
        $full_address = 
            $request->address_post . ', '.
            $request->address_pref . ', '.
            $request->address_town . ', '.
            $request->address_street . ', '.
            $request->address_num;
        if (mb_strlen($full_address) > 100) {
            $validator->errors()->add('full_address', '住所全体は100文字以内で入力してください。');
        }

        // エラーがあれば戻る
        if ($validator->errors()->count() > 0) {
            return back()->withInput()->withErrors($validator);
        }

        // validation通過後、確認画面へ
        // idを引き渡して、updateに繋げる
        $validated_data = $validator->validated();
        return view('check.admin_edit', ['formData' => $validated_data, 'user_id' =>$id]);
    }

    /**
     * ユーザー情報編集の確認画面から遷移
     * 確認画面でvalidateされたrequestから内容を取得し、
     * saveを使って更新 (is_admin と is_delete は入れない)
     * その後、showメソッドにリダイレクト
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        // 氏名、フリガナ、住所を整形
        $full_name = $request->last_name . ' ' . $request->first_name;
        $full_ruby = $request->last_ruby . ' ' . $request->first_ruby;
        $full_address = 
            $request->address_post . ', '.
            $request->address_pref . ', '.
            $request->address_town . ', '.
            $request->address_street . ', '.
            $request->address_num;

        // データのupdate
        $user->name = $full_name;
        $user->ruby = $full_ruby;
        $user->password = Hash::make($request->password);
        $user->email = $request->email;
        $user->tel = $request->tel;
        $user->company = $request->company;
        $user->birthday = $request->birthday;
        $user->address = $full_address;
        $user->gender = $request->gender;
        $user->get_notice = $request->get_notice;

        $user->save();

        // ユーザー詳細ページへリダイレクト
        return redirect(route('admin.users.show', ['user' => $user->id]));
    }

    /**
     * ユーザー詳細画面から呼び出し
     * id_delete を true にして
     * ユーザー一覧画面を表示する
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->is_deleted = true;
        $user->save();

        // ユーザー一覧ページへリダイレクト
        return redirect(route('admin.users.index'));
    }
}
