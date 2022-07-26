<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Update '.$user->name) }}
        </h2>
    </x-slot>
    <br>
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('admin.users.update', $user->id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="min-h-screen bg-gray-100 py-6">
            <div class="container bg-white py-6">
                <div class="pull-right">
                    <a class="btn btn-outline-dark" href="{{ route('admin.users.index') }}"> Back</a>
                </div>
                <div class="row gx-5">
                    <div class="col">
                        <div class="form-group">
                            <label for="name">User's name</label>
                            <input type="text" value="{{ old('name', $user->name) }}" name="name" placeholder="User's name" id="name"
                                   class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="text" name="password" value="{{ old('password') }}" placeholder="User's password"
                                   id="price" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="description">Email</label>
                            <input name="email" id="email" value="{{ old('email', $user->email) }}" placeholder="Input new password"
                                   class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="role">Role</label>
                            <select class="form-select" id="role" name="role">
                                <option> Assign role for user</option>
                                @foreach($availableRoles as $id => $name)
                                    <option @if($user->roles()->first()->id === $id) selected @endif
                                    value="{{ $id }}"> {{ $name }} </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="pt-4" name="btn" style="text-align: right;">
                            <x-button>Update</x-button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-app-layout>
