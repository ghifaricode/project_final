<!doctype html>
<html class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="resources/css/style.css">
    <link rel="stylesheet" href="resources/css/style-admin.css">
    <!-- CDN untuk Alpine.js -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.10.5/dist/cdn.min.js" defer></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- CDN untuk jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl5+5hb7v7y2Bl0u8T4F5COCZTnvntPZw5uj5F3e5p6" crossorigin="anonymous"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    {{-- Favicons --}}
    <link rel="icon" href="{{ asset('logo/pelnusa-logo.png') }}" type="image/x-icon">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">

    <title>{{ $title }}</title>

    <script>
        // On page load or when changing themes, best to add inline in `head` to avoid FOUC
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    <style>
        /* Transisi halus untuk perubahan tema */
        * {
            transition: background-color 0.3s ease, color 0.3s ease;
        }
    </style>

    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        // ... konfigurasi warna lainnya
                    }
                }
            }
        }
    </script>
</head>

<body class="font-montserrat bg-slate-50 dark:bg-slate-950">

    <!-- HEADER -->
    @include('admin.layouts.header')

    <div class="flex pt-16 overflow-hidden bg-gray-50 dark:bg-gray-900">

        @include('admin.layouts.sidebar')

        <div id="main-content" class="relative w-full h-full overflow-y-auto bg-gray-50 lg:ml-64 dark:bg-gray-900">
            <!-- BODY -->
            @yield('main')

            <!-- FOOTER -->
            @include('admin.layouts.footer')
            @yield('notification')
        </div>
    </div>

    {{-- Scripts --}}
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="resources/js/app.bundle.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.2/datepicker.min.js"></script>

    @stack('scripts')
</body>
</html>
