<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Organization Dashboard')</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <style>
        body{
            font-family:'Plus Jakarta Sans',sans-serif;
        }
    </style>

</head>

<body class="bg-slate-50">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-indigo-700 text-white flex flex-col">

        <div class="p-6 border-b border-indigo-600">

            <h1 class="text-2xl font-bold">
                AmikomEventHub
            </h1>

            <p class="text-sm text-indigo-200 mt-1">
                Dashboard Organisasi
            </p>

        </div>

        <nav class="flex-1 mt-6">

            <a href="{{ route('organization.dashboard') }}"
               class="block px-6 py-3 hover:bg-indigo-600">

                Dashboard

            </a>

            <a href="{{ route('organization.events.index') }}"
               class="block px-6 py-3 hover:bg-indigo-600">

                Kelola Event

            </a>

        </nav>

        <div class="p-6">

            <form action="{{ route('organization.logout') }}" method="POST">

                @csrf

                <button
                    class="w-full bg-red-500 hover:bg-red-600 py-2 rounded-xl">

                    Logout

                </button>

            </form>

        </div>

    </aside>

    <!-- CONTENT -->
    <main class="flex-1">

        <!-- TOPBAR -->
        <header class="bg-white shadow px-8 py-5 flex justify-between">

            <div>

                <h2 class="text-2xl font-bold">

                    @yield('page_title')

                </h2>

                <p class="text-slate-500">

                    @yield('page_subtitle')

                </p>

            </div>

            <div class="text-right">

                <p class="font-bold">

                    {{ auth('organization')->user()->name }}

                </p>

                <p class="text-sm text-slate-500">

                    Organization

                </p>

            </div>

        </header>

        <div class="p-8">

            @yield('content')

        </div>

    </main>

</div>

</body>
</html>