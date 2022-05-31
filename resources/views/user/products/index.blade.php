@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
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
        </tr>
    </thead>
        @foreach ($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->products_name }}</td>
            <td>{{ $product->products_price .'$' }}</td>
            <td>
                <div class="container">
                 <a class="btn btn-black" href="{{ route('user.products.show',$product->id) }}">Show</a>
                </div>

            </td>
        </tr>
        @endforeach
    </table>

@endsection
