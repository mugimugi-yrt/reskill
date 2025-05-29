<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Hotel;
use App\Models\Plan;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //予約履歴一覧画面
    public function index()
    {
        $user_id = \Auth::id();
        $plans = Plan::query()->with("hotel")->get();
        $reservations = Reservation::orderBy('created_at', 'desc')->where("user_id",$user_id)->get();
        return view('reserve.index', ['reservations' => $reservations,'plans' =>$plans]);
    }

    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $reservation = new Reservation();
        $plan = json_decode($request->plan);
        return view('reserve.create', ['reservation' => $reservation,'plan'=>$plan ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_check(Request $request)
    {
        //バリデーション記述
        $validateData = $this->validate($request, [
            "plan_id" => "required",
            "hotel_id" => "required",
            "price" => "required",
            'check_in' => 'required',
            'check_out' => 'required',
            'num_user' => 'required|between:1,100',
            'is_deleted' =>"required",
        ]);
        return view('check.reserve_create', ['validateData' => $validateData]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = json_decode($request->validateData);
        $reservation = new Reservation();
        $reservation->user_id = \Auth::id();

        $reservation->plan_id = $validate->plan_id;
        $reservation->check_in = $validate->check_in;
        $reservation->check_out = $validate->check_out;
        $reservation->num_user = $validate->num_user;
        $reservation->is_deleted = $validate->is_deleted;
        $reservation->save();
        return redirect(route('reservations.index'));//予約完了後は予約履歴一覧画面へ
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {

    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $reservation = \App\Models\Reservation::find($id);
        return view('reserve.edit', $reservation->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit_check(Request $request)
    {
        //バリデーション記述
        $validateData = $this->validate($request, [
            'check_in' => 'required',
            'check_out' => 'required',
            'num_user' => 'required|between:1,100',
        ]);
        return view('check.reserve_edit',  ['validateData' => $validateData]);
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
        $reservation = \App\Models\Reservation::find($id);
        return redirect(route('reserve.index',$reservation->id));//変更内容を更新後は履歴一覧へ
    }

    //星・口コミを更新するメソッドupdate_review
    public function update_review(Request $request, $id)
    {
        $reservation = \App\Models\Reservation::find($id);
        $plan = $reservation -> plan;
        $hotel = $reservation -> hotel;
        $hotel -> sum_stars += $reservation -> num_star;
        $hotel -> cnt_star_users += $reservation -> num_user;
        $hotel ->cnt_contents += $reservation -> content;
        $hotel -> save();
        return redirect()->route('reserve.index')->with('id',$id);
    }
}
