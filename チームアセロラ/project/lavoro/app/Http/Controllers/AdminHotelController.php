<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class AdminHotelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hotels = Hotel::all();
        return view('hotel.index', ['hotels' => $hotels]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $hotel = new Hotel();
        return view('hotel.create', ['hotel' => $hotel]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_check(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'        => 'required|string|max:50',
            'address_post'   => 'required|regex:/^\d{3}-\d{4}$/',
            'address_pref'   => 'required|string',
            'address_town'   => 'required|string',
            'address_street' => 'required|string',
            'address_num'    => 'required|string',
            'station'     => 'required|string|max:50',
            'tel'         => 'required|string|max:15',
            'img_source'     => 'required',
            'start_time'  => 'required|string|max:255',
            'end_time'    => 'required|string|max:255',
            'hot_spring'  => 'nullable|boolean',
            'genre'       => 'nullable|string|max:50',
            'group_room'  => 'nullable|integer|min:0',
        ], [
            // 郵便番号validation
            'address_post.regex' => '郵便番号は「123-4567」の形式で入力してください。',
        ]);

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

        // validation通過
        $validated_data = $validator->validated();

        // ファイルアップロード処理
        $path = $request->file('img_source')->store('public/hotel_images');
        $validated_data['image'] = Storage::url($path); // 画像を見せたいときは、asset()を使う

        return view('check.hotel_create', ['formData' => $validated_data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 住所の整形
        $full_address = 
            $request->address_post . ', '.
            $request->address_pref . ', '.
            $request->address_town . ', '.
            $request->address_street . ', '.
            $request->address_num;
        
        // フォームから送られた各項目を取得
        $hotel = new Hotel();

        $hotel->name = $request->name;
        $hotel->address = $full_address;
        $hotel->station = $request->station;
        $hotel->tel = $request->tel;
        $hotel->image = $request->image; // create_checkでStorage::url()されたもの
        $hotel->start_time = $request->start_time;
        $hotel->end_time = $request->end_time;
        $hotel->hot_spring = $request->hot_spring; // null/0/1 をそのまま保存
        $hotel->genre = $request->genre;
        $hotel->group_room = $request->group_room;

        // デフォルト値をセット
        $hotel->cnt_contents = 0;
        $hotel->cnt_star_users = 0;
        $hotel->sum_stars = 0;
        $hotel->is_deleted = false;

        $hotel->save();

        return redirect(route('admin.hotels.show', $hotel->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $hotel = \App\Models\Hotel::find($id);
        return view('hotel.show', ['hotel' => $hotel]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hotel = \App\Models\Hotel::find($id);
        return view('hotel.edit', ['hotel' => $hotel]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit_check(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name'        => 'required|string|max:50',
            'address_post'   => 'required|regex:/^\d{3}-\d{4}$/',
            'address_pref'   => 'required|string',
            'address_town'   => 'required|string',
            'address_street' => 'required|string',
            'address_num'    => 'required|string',
            'station'     => 'required|string|max:50',
            'tel'         => 'required|string|max:15',
            'img_source'     => 'required',
            'start_time'  => 'required|string|max:255',
            'end_time'    => 'required|string|max:255',
            'hot_spring'  => 'nullable|boolean',
            'genre'       => 'nullable|string|max:50',
            'group_room'  => 'nullable|integer|min:0',
        ], [
            // 郵便番号validation
            'address_post.regex' => '郵便番号は「123-4567」の形式で入力してください。',
        ]);

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

        // validation通過
        $validated_data = $validator->validated();

        // ファイルアップロード処理
        $path = $request->file('img_source')->store('public/hotel_images');
        $validated_data['image'] = Storage::url($path); 

        return view('check.hotel_edit', ['formData' => $validated_data, 'hotel_id' => $id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // 住所の整形
        $full_address = 
            $request->address_post . ', '.
            $request->address_pref . ', '.
            $request->address_town . ', '.
            $request->address_street . ', '.
            $request->address_num;

        // データの更新
        $hotel = Hotel::find($id);

        $hotel->name = $request->name;
        $hotel->address = $full_address;
        $hotel->station = $request->station;
        $hotel->tel = $request->tel;
        $hotel->image = $request->image; // create_checkでStorage::url()されたもの
        $hotel->start_time = $request->start_time;
        $hotel->end_time = $request->end_time;
        $hotel->hot_spring = $request->hot_spring; // null/0/1 をそのまま保存
        $hotel->genre = $request->genre;
        $hotel->group_room = $request->group_room;

        $hotel->save();

        return redirect(route('admin.hotels.show', $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hotel = \App\Models\Hotel::find($id);
        $hotel->is_deleted = true;
        $hotel->save();
        return redirect(route('admin.hotels.index'));
    }
}
