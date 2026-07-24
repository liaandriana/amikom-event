@extends('layouts.app')

@section('content')

<div class="min-h-screen flex items-center justify-center bg-gray-100">

    <div class="w-full max-w-md bg-white rounded-xl shadow-lg p-8">

        <h2 class="text-2xl font-bold text-center mb-6">
            Login Organization
        </h2>

        @if ($errors->any())
            <div class="mb-4 p-3 bg-red-100 text-red-600 rounded">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('organization.login.post') }}">

            @csrf

            <div class="mb-4">

                <label class="block mb-2 font-semibold">
                    Email
                </label>

                <input
                    type="email"
                    name="email"
                    class="w-full border rounded-lg p-3"
                    required>

            </div>

            <div class="mb-6">

                <label class="block mb-2 font-semibold">
                    Password
                </label>

                <input
                    type="password"
                    name="password"
                    class="w-full border rounded-lg p-3"
                    required>

            </div>

            <button
                class="w-full bg-indigo-600 text-white py-3 rounded-lg hover:bg-indigo-700">

                Login

            </button>

        </form>

    </div>

</div>

@endsection