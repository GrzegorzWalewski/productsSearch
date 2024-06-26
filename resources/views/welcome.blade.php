<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.jpeg') }}" />
        <title>Product Search</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script>
            // On page load or when changing themes, best to add inline in `head` to avoid FOUC
                if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                    document.documentElement.classList.add('dark');
                } else {
                    document.documentElement.classList.remove('dark')
                }
        </script>
</head>

<body class="antialiased font-sans">
    <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
        <div
            class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
            <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                <header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
                    <div class="flex lg:justify-center lg:col-start-2">
                        <img src="{{ asset('images/logo.jpeg') }}" width="200" height="200" />
                    </div>
                    @if (Route::has('login'))
                    <livewire:welcome.navigation />
                    @endif
                </header>

                <main class="mt-6">
                    <div class="grid gap-6 lg:grid-cols-1 lg:gap-8">
                        <div id="docs-card"
                            class="flex flex-col items-start gap-6 overflow-hidden rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] md:row-span-3 lg:p-10 lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]">
                            <div id="screenshot-container" class="relative flex w-full flex-1 items-stretch">
                                <div class="relative w-full hidden dark:block" data-carousel="slide">
                                    <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
                                        <div class="hidden duration-700 ease-in-out" data-carousel-item>
                                            <img src="{{ asset('images/screens/dashboard.png') }}"
                                                class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-3/4 left-1/2">
                                        </div>
                                        <div class="hidden duration-700 ease-in-out" data-carousel-item>
                                            <img src="{{ asset('images/screens/import.png') }}"
                                                class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-3/4 left-1/2">
                                        </div>
                                        <div class="hidden duration-700 ease-in-out" data-carousel-item>
                                            <img src="{{ asset('images/screens/variant.png') }}"
                                                class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-3/4 left-1/2">
                                        </div>
                                    </div>
                                </div>
                                <div class="relative w-full dark:hidden" data-carousel="slide">
                                    <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
                                        <div class="hidden duration-700 ease-in-out" data-carousel-item>
                                            <img src="{{ asset('images/screens/dashboard_white.png') }}"
                                                class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-3/4 left-1/2">
                                            <div
                                                class="absolute -bottom-16 -left-16 h-40 w-[calc(100%+8rem)] bg-gradient-to-b from-transparent via-white to-white dark:via-zinc-900 dark:to-zinc-900">
                                            </div>
                                        </div>
                                        <div class="hidden duration-700 ease-in-out" data-carousel-item>
                                            <img src="{{ asset('images/screens/import_white.png') }}"
                                                class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-3/4 left-1/2">
                                            <div
                                                class="absolute -bottom-16 -left-16 h-40 w-[calc(100%+8rem)] bg-gradient-to-b from-transparent via-white to-white dark:via-zinc-900 dark:to-zinc-900">
                                            </div>
                                        </div>
                                        <div class="hidden duration-700 ease-in-out" data-carousel-item>
                                            <img src="{{ asset('images/screens/variant_white.png') }}"
                                                class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-3/4 left-1/2">
                                            <div
                                                class="absolute -bottom-16 -left-16 h-40 w-[calc(100%+8rem)] bg-gradient-to-b from-transparent via-white to-white dark:via-zinc-900 dark:to-zinc-900">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="relative flex items-center gap-6 lg:items-end">
                                <div id="docs-card-content" class="flex items-start gap-6 lg:flex-col">
                                    <div
                                        class="flex size-12 shrink-0 items-center justify-center rounded-full bg-[#FF2D20]/10 sm:size-16">
                                        <img src="{{ asset('images/logo.jpeg') }}" class="rounded-full" width="200"
                                            height="200" />
                                    </div>
                                    <div class="pt-3 sm:pt-5 lg:pt-0">
                                        <h2 class="text-xl font-semibold text-black dark:text-white">Products Search
                                        </h2>

                                        <p class="mt-4 text-sm/relaxed">
                                            Welcome to the products search project.
                                        </p>
                                        <p>
                                            To start <a href="{{ route('login') }}">login</a>/<a href="{{ route('register') }}">register</a> and head to the <a href="{{ route('dashboard') }}">dashboard</a>.
                                        </p>
                                        
                                        <h2 class="mt-4 text-xl font-semibold text-black dark:text-white">Features
                                        </h2>

                                        <p class="mt-4 text-sm/relaxed">
                                            <ul class="list-disc list-inside space-y-2">
                                                <li>
                                                    Import products from xls file
                                                </li>
                                                <li>
                                                    Search for product by name or manufacturer
                                                </li>
                                                <li>
                                                    Get product min quantity for variant
                                                </li>
                                            </ul>
                                        </p>
                                        
                                        <h2 class="mt-4 text-xl font-semibold text-black dark:text-white">Tech stack
                                        </h2>

                                        <p class="mt-4 text-sm/relaxed">
                                            <ul class="list-disc list-inside space-y-2">
                                                <li>
                                                    Laravel
                                                </li>
                                                <li>
                                                    Livewire
                                                </li>
                                                <li>
                                                    Tailwind
                                                </li>
                                                <li>
                                                    SQLite
                                                </li>
                                                <li>
                                                    Flowbite
                                                </li>
                                            </ul>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>

                <footer class="py-16 text-center text-sm text-black dark:text-white/70">
                    Grzegorz "Grzojda" Walewski
                </footer>
            </div>
        </div>
    </div>
    <script>
        var themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
        var themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

        // Change the icons inside the button based on previous settings
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            themeToggleLightIcon.classList.remove('hidden');
        } else {
            themeToggleDarkIcon.classList.remove('hidden');
        }

        var themeToggleBtn = document.getElementById('theme-toggle');

        themeToggleBtn.addEventListener('click', function() {

            // toggle icons inside button
            themeToggleDarkIcon.classList.toggle('hidden');
            themeToggleLightIcon.classList.toggle('hidden');

            // if set via local storage previously
            if (localStorage.getItem('color-theme')) {
                if (localStorage.getItem('color-theme') === 'light') {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                } else {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                }

            // if NOT set via local storage previously
            } else {
                if (document.documentElement.classList.contains('dark')) {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                } else {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                }
            }
            
        });
    </script>
</body>

</html>