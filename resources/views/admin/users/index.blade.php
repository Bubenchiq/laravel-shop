<x-app-layout>
    <div class="row">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('All users') }}
                <div class="pull-right">
                    <a class="btn btn-black" href="{{ route('admin.users.create') }}"> Create New User</a>
                </div>
            </h2>
        </x-slot>
    </div>

@if($message = Session::get('success'))
        <div class="alert alert-black">
            <p>{{ $message }}</p>
        </div>
@endif
<br>
    <div class="container d-flex bg-white py-4">
        <form method="get" action="{{ route('admin.users.index') }}">
            <div class="container d-flex align-items-center justify-content-center bg-white py-4">
                <div class="form-check form-check-inline">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" value="{{ request('name') }}" id="name" name="name">
                </div>
                <div class="form-check form-check-inline">
                    <label for="userId">User id</label>
                    <input type="text" class="form-control" value="{{ request('userId') }}" id="userId" name="userId">
                </div>
                <div class="form-check form-check-inline">
                    <label for="userId">Role id</label>
                    <input type="text" class="form-control" value="{{ request('roleId') }}" id="roleId" name="roleId">
                </div>
                <div class="form-check form-check-inline">
                    <label for="userId">Role name</label>
                    <input type="text" class="form-control" value="{{ request('roleName') }}" id="roleName" name="roleName">
                </div>
                <div class="form-check form-check-inline">
                    <label for="date">Created at</label>
                    <input type="date" class="form-control" value="{{ request('date') }}" id="date" name="date">
                </div>
                <div class="form-check form-check-inline">
                    <button type="submit" class="btn-btn-black">search</button>
                </div>
            </div>
        </form>
    </div>
<br>
<div class="container bg-white py-6">
<table class="table table-striped">
    <thead class="thead-dark">
        <tr>
            <th>User's id</th>
            <th>Name</th>
            <th>Role Id</th>
            <th>Role Name</th>
            <th></th>
        </tr>
    </thead>
        @foreach ($users as $user)
    <div class="container">
        <div class="row">
            <tr>
                <div class="container">
                    <div class="col-12 col-md-8">
                        <td>{{ $user->id }}</td>
                     </div>
                    <div class="col-12 col-md-8">
                        <td>{{ $user->name }}</td>
                    </div>
                    <div class="col-12 col-md-8">
                        <td>{{ $user->roles->first()->id }}</td>
                    </div>
                    <div class="col-12 col-md-8">
                        <td>{{ $user->roles->first()->name }}</td>
                    </div>
                </div>
                <td width="150">


                    <div class="btn-group" role="group" aria-label="Basic example">
                        <form action="{{ route('admin.users.destroy',$user->id) }}" method="POST">
                            <a class="btn btn-black" href="{{ route('admin.users.show',$user->id) }}">Show</a>
                        </form>

                        <a class="btn btn-black" href="{{ route('admin.users.edit',$user->id) }}">Edit</a>

                        <form action="{{ route('admin.users.destroy',$user->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-black">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
        </div>
    </div>
        @endforeach
    </table>
    <div class="container bg-white">
        {{ $users->links() }}
    </div>
</div>


</x-app-layout>
