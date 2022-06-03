<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Our production') }}
        </h2>
    </x-slot>
    <br>
    <div class="container d-flex bg-white py-4">
        <form method="get" action="{{ route('user.products.index') }}">
            <div class="container d-flex align-items-center justify-content-center bg-white py-4">
                <div class="form-check form-check-inline">
                    <label for="searchByName">Name</label>
                    <input type="text" class="form-control" value="{{ request('name') }}" id="name" name="name">
                </div>
                <div class="form-check form-check-inline">
                    <label for="searchByName">Min price</label>
                    <input type="text" class="form-control" value="{{ request('minPrice') }}" id="minPrice" name="minPrice">
                </div>
                <div class="form-check form-check-inline">
                    <label for="searchByName">Max price</label>
                    <input type="text" class="form-control" value="{{ request('maxPrice') }}" id="maxPrice" name="maxPrice">
                </div>
                <div class="form-check form-check-inline">
                    <button type="submit" class="align-middle btn-btn-black">search</button>
                </div>
            </div>
        </form>
    </div>
    <br>
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
<div class="container bg-white py-6">
    <table class="table table-striped">
        <thead class="thead-light">
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
    </table>
    <div class="container bg-white">
        {{ $products->links() }}
    </div>
</div>
    </x-app-layout>
