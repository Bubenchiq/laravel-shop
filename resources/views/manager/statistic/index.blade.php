<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Statistic of revenue') }}
        </h2>
    </x-slot>
    <br>
    <div class="container d-flex bg-white py-4">
        <form method="get" action="{{ route('manager.statistic.index') }}">
            <div class="container d-flex align-items-center justify-content-center bg-white py-4">
                <div class="form-check form-check-inline">
                    <label for="date_from">From</label>
                    <input type="date" class="form-control" value="{{ request('date_from') }}" id="date_from" name="date_from">
                </div>
                <div class="form-check form-check-inline">
                    <label for="date_to">Till</label>
                    <input type="date" class="form-control" value="{{ request('date_to') }}" id="date_to" name="date_to">
                </div>
                <div class="form-check form-check-inline">
                    <br>
                    <button type="submit" class="btn btn-outline-dark">search</button>
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
                    <h2>Statistic</h2>
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
                    <th>Count</th>
                    <th>Revenue</th>
                </tr>
                </thead>
                @foreach ($statistic as $raw)
                    <tr>
                        <td>{{ $raw->product_id }}</td>
                        <td>{{ $raw->product_name }}</td>
                        <td>{{ $raw->final_count }}</td>
                        <td>{{ $raw->final_revenue .'$' }}</td>
                    </tr>
                @endforeach
            </table>
            <div class="container bg-white">
                {{ $statistic->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
