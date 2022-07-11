<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('History of order') }}
        </h2>
    </x-slot>
    <br>

    <div class="container bg-white py-4" id="cartDiv">
        @if($orders->isEmpty())
            <tr>
                <td colspan="4">You have no orders</td>
            </tr>
        @else
            <table class="table table-striped" id="">
                <thead class="thead-light">
                <tr>
                    <th>id</th>
                    <th>date</th>
                    <th>Total price</th>
                    <th></th>
                </tr>
                </thead>
                @foreach ($orders as $order )
                    <tr id="tr_{{$order->id}}">
                        <td>{{ $order->uuid   }}</td>
                        <td>{{ $order->created_at }}</td>
                        <td>{{ $order->total_price .'$' }}</td>
                        <td width="150">
                            <div class="container">
                                <a class="btn btn-black" href="{{ route('user.orders.show',$order->uuid) }}">Show</a>
                            </div>
                        </td>
                    </tr>

                @endforeach
            </table>
        @endif
    </div>
</x-app-layout>
