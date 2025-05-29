<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * 検索ページを表示
     *
     * @return \Illuminate\Http\Response
     */
    public function search()
    {
        return view('search.search');
    }

    /**
     * search画面からのリクエストをもらって、
     * 検索結果を表示する
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //最低予算,最高予算,場所,利用人数,チェックイン日時,チェックアウト日時,食事,温泉
            $min_budget = $request->min_budget;
            $max_budget = $request->max_budget;
            $place = $request->place;
            $num_guest = $request->num_guest;
            $check_in = $request->check_in; 
            $check_out = $request->check_out;
            $meal = $request->min_budget;
            $hot_spring = $request->min_budget;
        return view('search.index',[
            'min_budget' => $min_budget,
            'max_budget' => $max_budget,
            'place' => $place,
            'num_guest' => $num_guest,
            'check_in' => $check_in,
            'check_out' => $check_out,
            'meal' => $meal,
            'hot_spring' => $hot_spring, 
        ]);
    }

    /**
     * 検索画面から、プラン詳細画面を表示
     *
     * @return \Illuminate\Http\Response
     */
    public function show_plan($id)
    {
        //
        return view('plan.show',['id' => $id]);
    }

    /**
     * プラン詳細画面から、宿詳細画面を表示
     *
     * @return \Illuminate\Http\Response
     */

    public function show_hotel($id)
    {   
        return view('hotel',['id' => $id]);
    }

    /**
     * お気に入り登録
     *
     * @return \Illuminate\Http\Response
     */
    public function create_like(Request $request)
    {
        //
        \Auth::user()->likeHotels()->attach($request->id);
        return back();
    }

    /**
     * お気に入り解除
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy_like($request)
    {
        //
        \Auth::user()->likeHotels()->detach($request->id);
        return back();
    }
}
