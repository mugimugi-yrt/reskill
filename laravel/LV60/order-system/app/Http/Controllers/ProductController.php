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

        if (!$request->minPrice) { $request->minPrice = Product::min('price'); }
        if (!$request->maxPrice) { $request->maxPrice = Product::max('price'); }

        if (!$request->category) {
            $products = Product::where('price', '>=', $request->minPrice)
                                ->where('price', '<=', $request->maxPrice)
                                ->where('name', 'LIKE', '%' . $request->keyword . '%')
                                ->paginate(10);
        }
        else {
            $products = Product::where('category_id', $request->category)
                                ->where('price', '>=', $request->minPrice)
                                ->where('price', '<=', $request->maxPrice)
                                ->where('name', 'LIKE', '%' . $request->keyword . '%')
                                ->paginate(10);
        }

        return view('index', ['products' => $products, 'categories' => $categories, 'searched' => $isSearched]);
    }
}
