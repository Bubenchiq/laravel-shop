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
                <h4>{{ $order->uuid }}</h4>
                <h4>{{ $order->created_at }}</h4>
            </div>
            <div class="pull-right">
                <a class="btn btn-outline-dark" href="{{ route('user.orders.index') }}"> Back</a>
            </div>
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
        </div>
    </div>
</x-app-layout>
