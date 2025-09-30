<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Adens Events') }}</title>

    <link rel="icon" type="image/png" href="{{ asset('assets/images/adens-logo.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

 <!-- jQuery + Timepicker -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        [x-cloak] {
            display: none !important;
        }


        .empty-state {
   border-style: dashed;
    border: 2px dashed lightgrey;
    border-radius: 8px;
    cursor: pointer;
    padding: 25px 8px;
    text-align: center;
}

.empty-state .icon-plus {
    font-size: 2rem; /* Adjust the size of the icon */
    margin-left: auto;
    margin-right: auto;
    text-align: center; /* Optional: To ensure it's centered if you need */
    color: #d1d5db; /* Equivalent to text-gray-400 */
    transition: color 0.3s ease-in-out; /* Smooth transition for color changes */
}

.empty-state .icon-plus:hover {
    color: #48bb78; /* Equivalent to hover:text-green-500 */
}
    </style>
</head>

<body class="font-sans antialiased">
      <!-- Loader -->
    {{-- <div id="loader" class="fixed inset-0 bg-white flex items-center justify-center z-50">
        <div class="w-16 h-16 border-4 border-indigo-500 border-t-transparent rounded-full animate-spin"></div>
    </div> --}}

    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endisset

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>

        {{-- <script>
        // Hide loader when page is fully loaded
        window.addEventListener('load', function() {
    const loader = document.getElementById('loader');
    loader.style.opacity = 0;
    setTimeout(() => loader.style.display = 'none', 500);
    document.getElementById('main-content').style.display = 'block';
});

    </script> --}}
</body>

</html>