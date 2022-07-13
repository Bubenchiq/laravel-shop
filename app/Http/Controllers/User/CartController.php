<?php

namespace App\Http\Controllers\User;

use App\Models\Product;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use  Illuminate\Http\JsonResponse;


class CartController extends Controller
{
    public function __construct()
    {
        if (!session('cart_id')) {
            session(['cart_id' => uniqid()]);
        }
    }

    public function index(Request $request)
    {
        $cart_id = session('cart_id');
        $cart = \Cart::session($cart_id);
        $sum = $cart->getTotal('price');


        return view('user.cart.index',[
            'cart' => $cart->getContent(),
            'sum' => $sum
            ]);
    }
    public function addToCart(Product $product)
    {
        $cart_id = session('cart_id');
        $cart = \Cart::session($cart_id);

        $cart->add([
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => $product->quantity + 1
        ]);

        $data['total_quantity'] = $cart->getTotalQuantity();
        $data['total_price'] = $cart->getTotal('Price');
        $data['items'] = $cart->getContent();

        return response()->json($data);

    }

    public function removeFromCart(Product $product)
    {
        $cart_id = session('cart_id');
        $cart = \Cart::session($cart_id);

        if ($cart->get($product->id)->quantity > 1) {
            $cart->update($product->id, [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $product->quantity - 1
            ]);
        } else {
            $data['removed_item'] = $product->id;
            $data['total_price'] = $cart->getTotal('Price');
            $cart->remove($product->id);
        }
        $data['total_quantity'] = $cart->getTotalQuantity();
        $data['total_price'] = $cart->getTotal('Price');
        $data['items'] = $cart->getContent();

        return response()->json($data);

    }

}
