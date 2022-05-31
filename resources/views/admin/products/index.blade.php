@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Production</h2>
            </div>
            @if($user = auth()->user())
            <div class="pull-right">
                <a class="btn btn-black" href="{{ route('admin.products.create') }}"> Create New Product</a>
            </div>
            @endif
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
                <form action="{{ route('admin.products.destroy',$product->id) }}" method="POST">
                 <a class="btn btn-black" href="{{ route('admin.products.show',$product->id) }}">Show</a>
                 @if($user = auth()->user())
                </form>

                    <a class="btn btn-black" href="{{ route('admin.products.edit',$product->id) }}">Edit</a>
                </form>
                <form action="{{ route('admin.products.destroy',$product->id) }}" method="POST">

                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-black">Delete</button>
                </form>
                @endif

                </div>

            </td>
        </tr>
        @endforeach
    </table>

@endsection
