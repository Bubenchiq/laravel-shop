<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product cart') }}
        </h2>
    </x-slot>
    <br>
    <form action="{{ route('user.orders.store') }}", method="post">
        @csrf

{{--        <div class="container bg-white py-4" id="cartDiv">--}}
{{--            @if($cart->isEmpty())--}}
{{--                <p>There is nothing in cart.</p>--}}
{{--            @else--}}
{{--                <table class="table table-striped" id="">--}}
{{--                    <thead class="thead-light">--}}
{{--                    <tr>--}}
{{--                        <th>#</th>--}}
{{--                        <th>Product</th>--}}
{{--                        <th>Price</th>--}}
{{--                        <th>Count</th>--}}
{{--                        <th>Total price</th>--}}
{{--                        <th></th>--}}
{{--                    </tr>--}}
{{--                    </thead>--}}
{{--                    @foreach ($cart as $item)--}}
{{--                        <tr id="tr_{{$item->id}}">--}}
{{--                            <td>{{ $item->id }}</td>--}}
{{--                            <td>{{ $item->name }}</td>--}}
{{--                            <td>{{ $item->price .'$' }}</td>--}}
{{--                            <td class="ml-3">--}}
{{--                                <button id="{{$item->id}}" class="btn btn-black cart_button">+</button>--}}
{{--                                <span id="span_{{$item->id}}"> {{$item->quantity }}</span>--}}
{{--                                <button id="{{$item->id}}" class="btn btn-black cart_button_del">-</button>--}}
{{--                            </td>--}}
{{--                            <td id="td_total_{{$item->id}}">{{ $item->price * $item->quantity .' $'}}</td>--}}
{{--                            <td width="150">--}}
{{--                                <div class="container">--}}
{{--                                    <a class="btn btn-black" href="{{ route('user.products.show',$item->id) }}">Show</a>--}}
{{--                                </div>--}}

{{--                            </td>--}}
{{--                        </tr>--}}

{{--                    @endforeach--}}
{{--                </table>--}}

{{--                <span id="fullPrice" class="d-flex bg-white justify-content-center align-items-center input-group-text border w-40 py-2 border-dark rounded-pill pull-right">--}}
{{--                         Total price: {{ $sum }}--}}
{{--                </span>--}}
{{--            @endif--}}
{{--        </div>--}}
        <div class="container bg-white py-4" id="cartDiv">
            <br>
            <div class="container bg-white py-4 bg-gray-100 px-6">
                <div class="bg-gray">
                    <div class="row gx-5">
                        <div class="col">
                            <div class="form-group">
                                <label for="name">Your name</label>
                                <input type="text" name="name" placeholder="Input your name" id="name" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" name="phone" placeholder="Input your phone number" id="phone" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="email ">Email</label>
                                <input type="email" name="email" placeholder="Input your email" id="email" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="description">Comment</label>
                                <textarea type="description" name="description" id="description" class="form-control" placeholder="Input description"></textarea>
                            </div>

                            <div class="pt-4">
                                <x-button>Place order</x-button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-app-layout>
