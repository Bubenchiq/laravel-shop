<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('About product') }}
        </h2>
    </x-slot>
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <br>
                <h2> More about {{ $product->name}} </h2>
            </div>
            <div class="pull-right">
                <br>
                <a class="btn btn-black" href="{{ route('admin.products.index') }}"> Back</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                {{ $product->name }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>price:</strong>
                {{ $product->price }} $
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Description:</strong>
                {{ $product->description }}
            </div>
        </div>
</div>

</x-app-layout>
