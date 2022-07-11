<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('About order') }}
        </h2>
    </x-slot>
    <br>
    <div class="container">
        <div class="container bg-white py-6">
            <div class="pull-left">
                <h4 class="bg-indigo-50">{{ $order->uuid }}</h4>
                <h4 class="bg-indigo-50">{{ $order->created_at }}</h4>
            </div>
            @if($order->status === 'consideration')
                @show
            <div class="btn-group pull-right" role="group" aria-label="Basic example">
                <a class="btn btn-outline-dark" href="{{ route('admin.orders.index') }}"> Back</a>
                <form action="{{ route('admin.orders.approve', $order) }}"  method="POST">
                    @csrf
                    @method('POST')
                    <button class="btn btn-outline-dark">Approve</button>
                </form>
                <form action="{{ route('admin.orders.reject', $order) }}" method="POST">
                    @csrf
                    @method('POST')
                    <button  class="btn btn-outline-dark">Reject</button>
                </form>
            </div>
            @endif
            <br>
            <table class="table table-striped">
                <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Product</th>
                    <th>Price</th>
                </tr>
                </thead>
                @foreach ($order->products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->price .'$' }}</td>
                    </tr>
                @endforeach
            </table>
            <div class="pull-left">
                <h4>{{ $order->description }}</h4>
            </div>
            <div class="pull-right bg-indigo-50">
                <h4>{{ $order->status }}</h4>
            </div>
        </div>
    </div>
</x-app-layout>
