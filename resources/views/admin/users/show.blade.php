<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('About user') }}
        </h2>
    </x-slot>
    <br>
    <div class="container bg-white py-6">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <br>
                    <h2> More about {{ $user->name}} </h2>
                </div>
                <div class="pull-right">
                    <br>
                    <a class="btn btn-outline-dark" href="{{ route('admin.users.index') }}"> Back</a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    {{ $user->name }}
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>User's role:</strong>
                    {{ $user->getRoleNames()->first() }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Created at:</strong>
                    {{ $user->created_at }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <form action="{{ route('admin.users.destroy',$user->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-dark pull-right">Delete</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
