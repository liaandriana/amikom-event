<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Organization</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="min-h-screen flex items-center justify-center">

    <div class="w-full max-w-md bg-white rounded-2xl shadow-lg p-8">

        <h2 class="text-2xl font-bold text-center mb-2">
            Register Organization
        </h2>

        <p class="text-center text-gray-500 mb-6">
            Daftarkan HIMA atau Kepanitiaan Anda
        </p>

        @if(session('success'))
            <div class="mb-4 p-3 rounded-lg bg-green-100 text-green-700">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-4 p-3 rounded-lg bg-red-100 text-red-600">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('organization.register.post') }}" method="POST">

            @csrf

            <div class="mb-4">
                <label class="block mb-2 font-semibold">
                    Nama HIMA / Kepanitiaan
                </label>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    class="w-full border rounded-lg p-3"
                    required>
            </div>

            <div class="mb-4">
                <label class="block mb-2 font-semibold">
                    Email
                </label>

                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    class="w-full border rounded-lg p-3"
                    required>
            </div>

            <div class="mb-4">
                <label class="block mb-2 font-semibold">
                    Password
                </label>

                <input
                    type="password"
                    name="password"
                    class="w-full border rounded-lg p-3"
                    required>
            </div>

            <div class="mb-6">
                <label class="block mb-2 font-semibold">
                    Konfirmasi Password
                </label>

                <input
                    type="password"
                    name="password_confirmation"
                    class="w-full border rounded-lg p-3"
                    required>
            </div>

            <button
                type="submit"
                class="w-full bg-indigo-600 text-white py-3 rounded-lg hover:bg-indigo-700 transition">

                Register

            </button>

        </form>

        <p class="text-center mt-6 text-sm">
            Sudah punya akun?
            <a href="{{ route('organization.login') }}"
               class="text-indigo-600 font-semibold hover:underline">
                Login
            </a>
        </p>

    </div>

</div>

</body>
</html>