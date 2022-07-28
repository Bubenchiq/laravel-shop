<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

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
        if($date = $request->get('date')) {
            $searchData['from'] = Carbon::createFromFormat('Y-m-d', $date)->startOfDay();
            $searchData['to'] = Carbon::createFromFormat('Y-m-d', $date)->endOfDay();
        }

        $products = Product::query()
            ->when($request->name, fn(Builder $builder) => $builder->where('name', 'like',"%$request->name%"))
            ->when($request->minPrice, fn(Builder $builder) => $builder->where('price', '>=', $request->minPrice))
            ->when($request->maxPrice, fn(Builder $builder) => $builder->where('price', '<=', $request->maxPrice))
            ->when($request->userId, fn(Builder $builder) => $builder->where('user_id', '=', $request->userId))
            ->when($date, fn(Builder $builder) => $builder->where('created_at', '>=', $searchData['from'])->where('created_at', '<=', $searchData['to']))
            ->latest()->paginate(10);

        return view('manager.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manager.products.createProducts');
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
            'name' => 'required',
            'email' => 'required',
            'password'=> 'required',
        ]);

        Product::create($request->all() + ['user_id' => auth()->id()]);

        return redirect()->route('manager.products.index')->with('success','Product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('manager.products.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('manager.products.updateProduct',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
        ]);

        $product->update($request->all());

        return redirect()->route('manager.products.index')->with('success','Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

       return redirect()->route('manager.products.index')
                       ->with('success','Product deleted successfully');
    }
}
