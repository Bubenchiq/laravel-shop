<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Our production') }}
        </h2>
    </x-slot>

    <div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <br>
                <h2>Production</h2>
            </div>
        </div>
    </div>

@if($message = Session::get('success'))
        <div class="alert alert-black">
            <p>{{ $message }}</p>
        </div>
@endif
<table class="table">
    <thead class="thead-dark">
        <tr>
            <th>#</th>
            <th>Product</th>
            <th>Price</th>
            <th></th>
        </tr>
    </thead>
        @foreach ($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->price .'$' }}</td>
            <td width="150">
                <div class="container">
                 <a class="btn btn-black" href="{{ route('user.products.show',$product->id) }}">Show</a>
                </div>

            </td>
        </tr>
        @endforeach
    </div>
    </table>
    </x-app-layout>
