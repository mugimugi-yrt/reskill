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
        $reservations = Reservation::orderBy('created_at', 'desc')->get();
        return view('reserve.index', ['reservations' => $reservations]);
    }

    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $reservation = new Reservation();
        return view('reserve.create', ['reservation' => $reservation]);
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
            'check_in' => 'required',
            'check_out' => 'required',
            'num_user' => 'required|between:1,100',
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
        $request->user()->reservations()->create($request->all());
        return redirect(route('reserve.index'));//予約完了後は予約履歴一覧画面へ
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
