<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class StatisticController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:statistic@index'])->only(['index']);
    }

    public function index(Request $request)
    {
        $searchData['from'] = $request->get('date_from')
            ? Carbon::createFromFormat('Y-m-d', $request->get('date_from'))->startOfDay()
            : now()->startOfDay();

        $searchData['to'] = $request->get('date_to')
            ? Carbon::createFromFormat('Y-m-d', $request->get('date_to'))->endOfDay()
            : now()->endOfDay();

        $statistic = DB::table('order_product')
            ->select([
                'product_id',
                DB::raw('products.name as product_name'),
                DB::raw('SUM(count) as final_count'),
                DB::raw('SUM(order_product.price * order_product.count) as final_revenue'),
            ])
            ->leftJoin('products', 'order_product.product_id', '=' ,'products.id')
            ->leftJoin('orders', 'order_product.order_uuid', '=' ,'orders.uuid')
            ->where('status',Order::STATUS_APPROVED)
            ->whereBetween('considered_at', [$searchData['from'], $searchData['to']])
            ->groupBy('product_id')
            ->orderByDesc('final_revenue')
            ->paginate(10);

        return view('admin.statistic.index', compact('statistic'));
    }
}
