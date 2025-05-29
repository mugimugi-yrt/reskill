<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function index(Request $request) {
        $categories = Category::all();
        
        $isSearched = false;
        if ($request->category || $request->minPrice || $request->maxPrice || $request->keyword) {
            $isSearched = true;
        }

        // クエリビルダを使ってみる
        $query = Product::query();
        
        if($request->category) { $query = $query->where('category_id', $request->category); }
        if($request->minPrice) { $query = $query->where('price', '>=', $request->minPrice); }
        if($request->maxPrice) { $query = $query->where('price', '<=', $request->maxPrice); }
        if($request->keyword)  { $query = $query->where('name', 'LIKE', '%' . $request->keyword . '%'); }

        $products = $query->paginate(10);

        return view('home.index', ['products' => $products, 'categories' => $categories, 'searched' => $isSearched]);
    }
}
