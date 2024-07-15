<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Trang chủ</title>
     {{-- @vite('resources/css/app.css') --}}
    <link rel="stylesheet" href="/build/assets/app-k_WVtLru.css">
    <link rel="stylesheet" href="/assets/alert_dark.css">
    <script src="/assets/anime.min.js"></script>
    <script src="/assets/swet.js"></script>
    <script src="/assets/axios.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
</head>

<body class="my-scroll">
    @include('Components.templates.header')
    <div class="min-h-[60vh]">
        @yield('content')
    </div>
    @include('Components.templates.footer')
    <div onclick="handleToTop()" class="fixed hover:cursor-pointer bottom-2 right-2">
        <div class="tooltip" data-tip="Lên">
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-arrow-up-circle-fill size-6"
                viewBox="0 0 16 16">
                <path
                    d="M16 8A8 8 0 1 0 0 8a8 8 0 0 0 16 0m-7.5 3.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707z" />
            </svg>
        </div>
    </div>
    <script>
        function handleToTop() {
            window.scrollTo(0, 0);
        }
    </script>
    {{-- @vite('resources/js/app.js') --}}
    <script src="/build/assets/app-HSxG4_BA.js"></script>
</body>

</html>
