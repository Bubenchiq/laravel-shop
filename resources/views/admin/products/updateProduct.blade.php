@extends('layouts.navigation')
@extends('layouts.app')
@section('content')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Update '.$product->products_name) }}
        </h2>
    </x-slot>
    <div class="pull-right">
                <a class="btn btn-black" href="{{ route('admin.products.index') }}"> Back</a>
            </div>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{ route('admin.products.update', $product->id) }}", method="post">
    @csrf
    @method('PUT')
<div class="min-h-screen bg-gray-100 px-6">
    <div class="min-h-screen bg-gray-100">
        <div class="row gx-5">
            <div class="col">
                <div class="form-group">
                    <label for="products_name">Product's name</label>
                    <input type="text" value="{{$product->products_name}}" name="products_name" placeholder="Name of product" id="products_name" class="form-control">
                </div>

                 <div class="form-group">
                    <label for="products_price">Price</label>
                    <input type="number" value="{{$product->products_price}}" name="products_price" placeholder="Name of product" id="products_price" class="form-control">
                </div>

                <div class="form-group">
                    <label for="products_description">Description</label>
                    <textarea name="products_description" id="products_description" class="form-control" placeholder="Input description">{{$product->products_description}}

                    </textarea>
                </div>

                <div class="pt-4" name="btn" style="text-align: right;" >
                            <x-button>Update</x-button>
                </div>
            </div>
        </div>
  </div>
</div>
</form>
@endsection
</x-app-layout>
