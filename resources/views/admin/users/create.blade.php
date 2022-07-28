<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create User') }}
        </h2>
    </x-slot>

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.users.store') }}" method="post">
    @csrf
<div class="min-h-screen bg-gray-100 py-6">
    <div class="container py-6 bg-white">
        <div class="row gx-5">
            <div class="col">
                <div class="form-group">
                    <label for="name">User's name</label>
                    <input type="text" name="name" placeholder="User's name" id="name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="password">Pass</label>
                    <input type="password" name="password" placeholder="User's name" id="password" class="form-control">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" placeholder="User's email" id="email" value="{{ old('name') }} " class="form-control">
                </div>
                <div class="form-group">
                    <label for="role">Role</label>
                    <select class="form-select" id="role" name="role">
                        <option selected>Assign role for user</option>
                        @foreach($availableRoles as $id => $name)
                        <option value="{{ $id }}"> {{ $name }} </option>
                        @endforeach
                    </select>
                </div>

                <div class="pt-4" name="btn" style="text-align: right;" >
                            <x-button>Create</x-button>
                </div>
            </div>
        </div>
  </div>
</div>
</form>
</x-app-layout>
