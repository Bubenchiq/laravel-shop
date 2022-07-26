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
            <div class="btn-group pull-right" role="group" aria-label="Basic example">
                <a class="btn btn-outline-dark" href="{{ route('manager.orders.index') }}"> Back</a>
                @if($order->status === 'consideration')
                    <form action="{{ route('manager.orders.approve', $order) }}" method="POST">
                        @csrf
                        @method('POST')
                        <button class="btn btn-outline-dark" onclick="return confirm('Approve this order?')">Approve
                        </button>
                    </form>
                    <form action="{{ route('manager.orders.reject', $order) }}" method="POST">
                        @csrf
                        @method('POST')
                        <button class="btn btn-outline-dark" onclick="return confirm('Approve this order?')">Reject
                        </button>
                    </form>
                @endif
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
            <div class="pull-left">
                <h4>{{ $order->description }}</h4>
            </div>
            <div class="d-flex bg-white justify-content-center align-items-center input-group-text border w-40 py-2 border-dark rounded-pill pull-right">
                <h4> {{$order->status}} </h4>
            </div>
        </div>
    </div>
</x-app-layout>
