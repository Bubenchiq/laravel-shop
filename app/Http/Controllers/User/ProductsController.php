<?php

namespace App\Http\Controllers\User;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::query()->latest()->paginate(10);

        return view('user.products.index', compact('products'));
    }

    public function show(Product $product)
    {
        return view('user.products.show',compact('product'));
    }
}
