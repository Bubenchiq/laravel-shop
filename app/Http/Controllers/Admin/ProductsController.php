<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Products;
use Illuminate\Http\Request;
use App\Models\User;

class ProductsController extends Controller
{
    public function __construct(){
        $this->middleware(['permission:products@index'])->only(['index']);
        $this->middleware(['permission:products@create'])->only(['create', 'store']);
        $this->middleware(['permission:products@show'])->only(['show']);
        $this->middleware(['permission:products@edit'])->only(['edit', 'update']);
        $this->middleware(['permission:products@delete'])->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = Products::query()->latest()->paginate(10);

        return view('admin.products.index', compact('products'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()

    {
        return view('admin.products.createProducts');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'products_name' => 'required',
            'products_description' => 'required',
            'products_price'=> 'required',
        ]);

        Products::create($request->all() + ['user_id' => auth()->id()]);

        return redirect()->route('admin.products.index')->with('success','Product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Products $product)
    {
        return view('admin.products.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Products $product)
    {
        return view('admin.products.updateProduct',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Products $product)
    {
        $request->validate([
            'products_name' => 'required',
            'products_description' => 'required',

        ]);

        $product->update($request->all());

        return redirect()->route('admin.products.index')->with('success','Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Products $product)
    {
        $product->delete();

       return redirect()->route('admin.products.index')
                       ->with('success','Product deleted successfully');
    }
}
