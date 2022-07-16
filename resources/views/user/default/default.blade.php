<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Welcome') }}
        </h2>
    </x-slot>
    <br>
    <div class="container">
        @if($message = Session::get('success'))
            <div class="alert alert-black">
                <p>{{ $message }}</p>
            </div>
        @endif

        <div class="container d-flex ">
        @foreach ($default as $raw)
            <div class="container bg-white py-6 w-25">
                <div class="border-b pull-left w-100">
                    <h4>{{ $raw->name }}</h4>
                </div>
                <br>
                <div class=" align-middle">
                        <td>{{ $raw->description }}</td>
                </div>
                <div class="pull-right">
                    <h4>{{ $raw->price .'$' }}</h4>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
