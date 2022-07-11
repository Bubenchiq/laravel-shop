<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('History of orders') }}
        </h2>
    </x-slot>
    <br>

    <div class="container bg-white py-4" id="cartDiv">
        @if($orders->isEmpty())
            <tr>
                <td colspan="4">There is no orders</td>
            </tr>
        @else
            <table class="table table-striped">
                <thead class="thead-light">
                <tr>
                    <th class="align-middle">id</th>
                    <th class="align-middle">User name</th>
                    <th class="align-middle">User id</th>
                    <th class="align-middle">Created at</th>
                    <th class="align-middle">Status</th>
                    <th class="align-middle">Considered at</th>
                    <th class="align-middle">Total price</th>
                    <th></th>
                </tr>
                </thead>
                @foreach ($orders as $order )
                    <tr id="tr_{{$order->id}}">
                        <td class="align-middle">{{ $order->uuid   }}</td>
                        <td class="align-middle">{{ $order->name   }}</td>
                        <td class="align-middle">{{ $order->user_id   }}</td>
                        <td class="align-middle">{{ $order->created_at }}</td>
                        <td class="align-middle">{{ $order->status }}</td>
                        <td class="align-middle">{{ $order->considered_at }}</td>
                        <td class="align-middle">{{ $order->total_price .'$' }}</td>
                        <td width="150">
                            <div class="container">
                                <a class="btn btn-outline-dark" href="{{ route('admin.orders.show',$order->uuid) }}">Show</a>
                            </div>
                        </td>
                    </tr>

                @endforeach
            </table>
        @endif
    </div>
</x-app-layout>
