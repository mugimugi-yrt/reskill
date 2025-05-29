<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MemoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $memos = \App\Models\Memo::all();
        return view('index', ['memos' => $memos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $memo = new \App\Models\Memo;
        $memo->title = $request->title;
        $memo->content = $request->content;
        $memo->save();
        return redirect(route('memos.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $memo = \App\Models\Memo::find($id);
        return view('show', ['memo' => $memo]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $memo = \App\Models\Memo::find($id);
        return view('edit', ['memo' => $memo]);
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
        $memo = \App\Models\Memo::find($id);
        $memo->title = $request->title;
        $memo->content = $request->content;
        $memo->save();
        return redirect(route('memos.show', $memo->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $memo = \App\Models\Memo::find($id);
        $memo->delete();
        return redirect(route('memos.index'));
    }

    /**
     * editをまねて作成
     * 削除確認画面に遷移
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $memo = \App\Models\Memo::find($id);
        return view('delete', ['memo' => $memo]);
    }
}
