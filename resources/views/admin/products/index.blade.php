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
<br>
    <div class="container d-flex bg-white py-4">
        <form method="get" action="{{ route('admin.products.index') }}">
            <div class="container d-flex align-items-center justify-content-center bg-white py-4">
                <div class="form-check form-check-inline">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" value="{{ request('name') }}" id="name" name="name">
                </div>
                <div class="form-check form-check-inline">
                    <label for="minPrice">Min price</label>
                    <input type="text" class="form-control" value="{{ request('minPrice') }}" id="minPrice" name="minPrice">
                </div>
                <div class="form-check form-check-inline">
                    <label for="maxPrice">Max price</label>
                    <input type="text" class="form-control" value="{{ request('maxPrice') }}" id="maxPrice" name="maxPrice">
                </div>
                <div class="form-check form-check-inline">
                    <label for="userId">User id</label>
                    <input type="text" class="form-control" value="{{ request('userId') }}" id="userId" name="userId">
                </div>
                <div class="form-check form-check-inline">
                    <label for="date">Created at</label>
                    <input type="date" class="form-control" value="{{ request('date') }}" id="date" name="date">
                </div>
                <div class="form-check form-check-inline">
                    <button type="submit" class="btn-btn-black">search</button>
                </div>
            </div>
        </form>
    </div>
<br>
<div class="container bg-white py-6">
<table class="table table-striped">
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
    <div class="container bg-white">
        {{ $products->links() }}
    </div>
</div>


</x-app-layout>
