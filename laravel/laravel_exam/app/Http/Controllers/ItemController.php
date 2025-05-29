<?php

// 問題 3 : コントローラの用意
// php artisan make:controller ItemController --resource
// (モデルと一緒に作る場合：php artisan make:model Controller -mcr)

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * 問題 4 / 問題 8 で使用
     * 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Category::all();  // 検索窓表示用

        $query = Item::query();
        
        if($request->category_id) { $query = $query->where('category_id', $request->category_id); }
        if($request->keyword)  { $query = $query->where('name', 'LIKE', '%' . $request->keyword . '%'); }
        if($request->price_min) { $query = $query->where('price', '>=', $request->price_min); }
        if($request->price_max) { $query = $query->where('price', '<=', $request->price_max); }

        switch ($request->sort) {
            case "price_asc" :
                $items = $query->orderBy('price')->get();
                break;
            case "price_desc" :
                $items = $query->orderBy('price', 'desc')->get();
                break;
            default :
                // 商品データが新しい順(created_at降順)ですべて表示される (問題 4)
                $items = $query->orderBy('created_at', 'desc')->get();
                break;
        }
        
        return view('items.index', ['items' => $items, 'categories' => $categories]);
    }

    /**
     * 問題 5 で使用
     * 
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $dummyItem = new Item;
        return view('items.create', ['item' => $dummyItem, 'categories' => $categories]);
    }

    /**
     * 問題 5 で使用
     * 
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'category_id' => 'required',
            'name' => 'required',
            'price' => 'required|numeric'
        ]);
        $newItem = Item::create($request->all());
        return redirect(route('items.index'));
    }

    /**
     * 問題 6 で使用
     * 
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        return view('items.show', ['item' => $item]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        $categories = Category::all();
        return view('items.edit', ['item' => $item, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        $this->validate($request, [
            'category_id' => 'required',
            'name' => 'required',
            'price' => 'required|numeric'
        ]);
        $item->update($request->all());
        return redirect(route('items.show', $item));
    }

    /**
     * 問題 6 で使用
     * 
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        // 「OK」を押すと、商品が削除されインデックスページに飛ぶ (問題 6)
        $item->delete();
        return redirect(route('items.index'));
    }
}
