<?php

namespace App\Http\Controllers\User;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::query()
            ->when($request->name, fn(Builder $builder) => $builder->where('name', 'like',"%$request->name%"))
            ->when($request->minPrice, fn(Builder $builder) => $builder->where('price', '>=', $request->minPrice))
            ->when($request->maxPrice, fn(Builder $builder) => $builder->where('price', '<=', $request->maxPrice))
            ->latest()->paginate(10);

        return view('user.products.index', compact('products'));
    }

    public function show(Product $product)
    {
        return view('user.products.show',compact('product'));
    }
}
