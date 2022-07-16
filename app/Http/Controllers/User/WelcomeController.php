<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller
{
    public function __invoke () {
        $default = Product::query()
        ->select([
            'id',
            'products.name',
            'products.price',
            'products.description',
            DB::raw('SUM(order_product.count) as final_count'),
        ])
        ->leftJoin('order_product', 'products.id', '=' ,'order_product.product_id')
        ->leftJoin('orders', 'order_product.order_uuid', '=' ,'orders.uuid')
        ->where('status',Order::STATUS_APPROVED)
        ->groupBy('id')
        ->orderByDesc('final_count')
        ->take(3)
        ->get();

        return view('user.default.default', compact('default'));
    }
}
