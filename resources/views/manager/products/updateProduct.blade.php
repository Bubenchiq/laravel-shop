<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Update '.$product->name) }}
        </h2>
    </x-slot>
    <div class="pull-right">
                <a class="btn btn-black" href="{{ route('manager.products.index') }}"> Back</a>
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
<form action="{{ route('manager.products.update', $product->id) }}", method="post">
    @csrf
    @method('PUT')
<div class="min-h-screen bg-gray-100 px-6">
    <div class="min-h-screen bg-gray-100">
        <div class="row gx-5">
            <div class="col">
                <div class="form-group">
                    <label for="name">Product's name</label>
                    <input type="text" value="{{$product->name}}" name="name" placeholder="Name of product" id="name" class="form-control">
                </div>

                 <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" value="{{$product->price}}" name="price" placeholder="Name of product" id="price" class="form-control">
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" class="form-control" placeholder="Input description">{{$product->description}}

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
</x-app-layout>
