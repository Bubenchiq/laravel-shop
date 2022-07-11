<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product cart') }}
        </h2>
    </x-slot>
    <br>
    <form action="{{ route('user.orders.store') }}", method="post">
        @csrf

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
                                <textarea name="description" id="description" class="form-control" placeholder="Input description"></textarea>
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
