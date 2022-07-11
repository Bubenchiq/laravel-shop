<?php

namespace App\Http\Controllers\User;

use App\Models\Order;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        if (!isset($_COOKIE['cart_id'])) {
            setcookie('cart_id', uniqid());
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $orders = Order::query()->where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('user.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('user.orders.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $cart_id = $_COOKIE['cart_id'];
        $cart = \Cart::session($cart_id);
        $sum = $cart->getTotal('price');

        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'phone' => 'required',
        ]);

        $content = \Cart::getContent();
        foreach ($content as $key => $value) {
            $products[$key] = ['count' => $value->quantity, 'price' => $value->price];

        }

        /** @var Order $order */
        $order = Order::create($request->all() + ['user_id' => auth()->id(), 'total_price' => $sum]);
        $order->products()->sync($products);

        \Cart::clear();

        return redirect()->route('user.orders.show', compact('order'))
            ->with('success', 'Order created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Order $order
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(404);
        }

        return view('user.orders.show', compact('order'));
    }

}
