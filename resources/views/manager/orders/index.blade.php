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
                        @if($order->status === 'approved')
                            <td class="align-middle bg-warning">{{ $order->status }}</td>
                        @elseif($order->status === 'rejected')
                            <td class="align-middle bg-danger">{{ $order->status }}</td>
                        @else
                            <td class="align-middle bg-info">{{ $order->status }}</td>
                        @endif
                        <td class="align-middle">{{ $order->considered_at }}</td>
                        <td class="align-middle">{{ $order->total_price .'$' }}</td>
                        <td width="150">
                            <div class="container">
                                <a class="btn btn-outline-dark" href="{{ route('manager.orders.show',$order->uuid) }}">Show</a>
                            </div>
                        </td>
                    </tr>

                @endforeach
            </table>
        @endif
    </div>
</x-app-layout>
