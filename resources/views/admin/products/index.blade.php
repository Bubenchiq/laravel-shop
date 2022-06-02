<x-app-layout>
    <div class="row">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Our production') }}
                <div class="pull-right">
                    <a class="btn btn-black" href="{{ route('admin.products.create') }}"> Create New Product</a>
                </div>
            </h2>
        </x-slot>
    </div>

@if($message = Session::get('success'))
        <div class="alert alert-black">
            <p>{{ $message }}</p>
        </div>
@endif
<div class="container">
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
    <div class="container">
        <div class="row">
            <tr>
                <div class="container">
                    <div class="col-12 col-md-8">
                        <td>{{ $product->id }}</td>
                     </div>
                    <div class="col-12 col-md-8">
                        <td>{{ $product->name }}</td>
                    </div>
                    <div class="col-12 col-md-8">
                        <td>{{ $product->price .'$' }}</td>
                    </div>
                </div>
                <td width="150">


                    <div class="btn-group" role="group" aria-label="Basic example">
                        <form action="{{ route('admin.products.destroy',$product->id) }}" method="POST">
                            <a class="btn btn-black" href="{{ route('admin.products.show',$product->id) }}">Show</a>
                        </form>

                        <a class="btn btn-black" href="{{ route('admin.products.edit',$product->id) }}">Edit</a>

                        <form action="{{ route('admin.products.destroy',$product->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-black">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
        </div>
    </div>
        @endforeach
    </table>
</div>
</x-app-layout>
