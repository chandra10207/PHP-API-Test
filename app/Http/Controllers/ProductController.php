<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
class ProductController extends Controller
{
    public function store(Request $request)
    {
        $product =  Product::create($request->all());
        return response()->json($product, 201);
    }
}
