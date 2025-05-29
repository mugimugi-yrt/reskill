<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;

class AdminPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plans = \App\Models\Plan::all();
        return view('plan.index', ['plans' => $plans]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $plan = new Plan;
        $hotels = \App\Models\Hotel::all();
        return view('plan.create', ['plan' => $plan, 'hotels' => $hotels]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_check(Request $request)
    {
        $validateData = $this->validate($request, [
            'name'          => 'required|string|max:50',
            'hotel_id'      => 'required',
            'description'   => 'nullable|string|max:400',
            'price'         => 'required|integer|min:0|max:9999999999',
            'max_guest'     => 'required|integer|between:1,100',
            'meal'          => 'required|boolean',
            'start_date'    => 'required|date|max:10',
            'end_date'      => 'required|date|max:10',
        ]);

        $selected_hotel = \App\Models\Hotel::find($validateData['hotel_id']);
        return view('check.plan_create', ['formData' => $validateData, 'hotelName' => $selected_hotel->name]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $plan = new Plan();

        $plan->hotel_id = $request->hotel_id;
        $plan->name = $request->name;
        $plan->description = $request->description;
        $plan->price = $request->price;
        $plan->max_guest = $request->max_guest;
        $plan->meal = $request->meal;
        $plan->start_date = $request->start_date;
        $plan->end_date = $request->end_date;

        $plan->is_deleted = false;

        $plan->save();
        return redirect(route('admin.plans.show', $plan->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $plan = \App\Models\Plan::find($id);
        return view('plan.show', ['plan' => $plan]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $plan = \App\Models\Plan::find($id);
        $hotels = \App\Models\Hotel::all();
        return view('plan.edit', ['plan' => $plan, 'hotels' => $hotels]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit_check(Request $request, $id)
    {
        $validateData = $this->validate($request, [
            'name'          => 'required|string|max:50',
            'hotel_id'      => 'required',
            'description'   => 'nullable|string|max:400',
            'price'         => 'required|integer|min:0|max:9999999999',
            'max_guest'     => 'required|integer|between:1,100',
            'meal'          => 'required|boolean',
            'start_date'    => 'required|date|max:10',
            'end_date'      => 'required|date|max:10',
        ]);

        $selected_hotel = \App\Models\Hotel::find($validateData['hotel_id']);
        return view('check.plan_edit', ['formData' => $validateData, 'hotelName' => $selected_hotel->name, 'plan_id' => $id]);
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
        $plan = Plan::find($id);

        $plan->hotel_id = $request->hotel_id;
        $plan->name = $request->name;
        $plan->description = $request->description;
        $plan->price = $request->price;
        $plan->max_guest = $request->max_guest;
        $plan->meal = $request->meal;
        $plan->start_date = $request->start_date;
        $plan->end_date = $request->end_date;

        $plan->save();
        return redirect(route('admin.plans.show', $plan->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $plan = \App\Models\Plan::find($id);
        $plan->is_deleted = true;
        $plan->save();
        return redirect(route('admin.plans.index'));
    }
}
