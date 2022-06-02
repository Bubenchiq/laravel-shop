<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create product') }}
        </h2>
    </x-slot>
@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.products.store') }}", method="post">
    @csrf
<div class="min-h-screen bg-gray-100 px-6">
    <div class="min-h-screen bg-gray-100">
        <div class="row gx-5">
            <div class="col">
                <div class="form-group">
                    <label for="name">Product's name</label>
                    <input type="text" name="name" placeholder="Name of product" id="name" class="form-control">
                </div>

                 <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" step="0.01" name="price" placeholder="Name of product" id="price" class="form-control">
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" class="form-control" placeholder="Input description"></textarea>
                </div>

                <div class="pt-4" name="btn" style="text-align: right;" >
                            <x-button>Create</x-button>
                </div>
            </div>
        </div>
  </div>
</div>
</form>
</x-app-layout>
