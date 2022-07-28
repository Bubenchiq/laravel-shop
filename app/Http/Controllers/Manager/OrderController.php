<?php

namespace App\Http\Controllers\Manager;

use App\Models\Order;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        if (!session('cart_id')) {
            session(['cart_id' => uniqid()]);
        }

        $this->middleware(['permission:order@index'])->only(['index']);
        $this->middleware(['permission:order@show'])->only(['show']);
        $this->middleware(['permission:order@edit'])->only(['edit', 'update']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $orders = Order::query()
            ->latest()->paginate(10);

        return view('manager.orders.index', compact('orders'));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Order $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return view('manager.orders.show', compact('order'));
    }

    public function approve(Order $order)
    {
        $order->update([
            'status' => Order::STATUS_APPROVED,
            'manager_id' => auth()->id(),
            'considered_at' => now()
        ]);

        return redirect()
            ->route('manager.orders.index', compact('order'))
            ->with('success', 'Order approved');
    }

    public function reject(Order $order)
    {
        $order->update([
            'status' => Order::STATUS_REJECTED,
            'manager_id' => auth()->id(),
            'considered_at' => now()
        ]);

        return redirect()
            ->route('manager.orders.index', compact('order'))
            ->with('success', 'Order rejected');
    }
}
