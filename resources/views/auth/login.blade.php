<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - AmikomEventHub</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-purple-100 via-violet-50 to-fuchsia-100 min-h-screen flex items-center
 justify-center p-6 overflow-hidden">

    <!-- Background Decoration -->
    <div class="fixed top-0 left-0 w-80 h-80 bg-purple-300 rounded-full blur-3xl opacity-30"></div>

    <div class="fixed bottom-0 right-0 w-80 h-80 bg-fuchsia-300 rounded-full blur-3xl opacity-30"></div>

    <!-- Login Card -->
    <div class="relative z-10 max-w-md w-full bg-white/90 backdrop-blur-md rounded-[2rem] p-10 shadow-2xl border border-purple-100">

        <!-- Logo -->
        <div class="text-center mb-8">

            <div class="w-20 h-20 bg-gradient-to-r from-purple-500 to-violet-500 rounded-3xl flex items-center justify-center 
            text-white
             font-black text-3xl mx-auto mb-5 shadow-lg shadow-purple-200">
                AH
            </div>

            <h1 class="text-3xl font-black text-purple-700">
                Admin Login
            </h1>

            <p class="text-slate-500 mt-2">
                Selamat datang di Dashboard AmikomEventHub
            </p>

        </div>

        <!-- Error -->
        @if(session('error'))
            <div class="bg-red-100 text-red-600 p-4 rounded-2xl mb-6 text-center font-semibold">
                {{ session('error') }}
            </div>
        @endif

        <!-- Form -->
        <form action="{{ route('admin.login.post') }}" method="POST" class="space-y-5">

            @csrf

            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">
                    Email
                </label>

                <input
                    type="email"
                    name="email"
                    required
                    class="w-full px-5 py-4 bg-purple-50 border-2 border-purple-100 rounded-2xl focus:ring-4 
                    focus:ring-purple-300/30 focus:border-purple-400 outline-none transition font-medium">
            </div>

            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">
                    Password
                </label>

                <input
                    type="password"
                    name="password"
                    required
                    class="w-full px-5 py-4 bg-purple-50 border-2 border-purple-100 rounded-2xl focus:ring-4 
                    focus:ring-purple-300/30 focus:border-purple-400 outline-none transition font-medium">
            </div>

            <button
                type="submit"
                class="w-full py-4 bg-gradient-to-r from-purple-500 to-violet-500 text-white rounded-2xl 
                font-black text-lg shadow-lg shadow-purple-200 hover:scale-105 transition duration-300">
                Masuk Dashboard

            </button>

        </form>


        <!-- Footer -->
        <div class="text-center mt-8">

            <p class="text-sm text-slate-400">
                © 2026 AmikomEventHub
            </p>

        </div>

    </div>

</body>
</html>