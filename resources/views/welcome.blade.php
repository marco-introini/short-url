<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-LETDWXE4J3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', 'G-LETDWXE4J3');
    </script>


    <title>Short URL - MintPHP.dev</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>


<body>
<!-- Header 17 -->
<section class="w-full text-gray-700 bg-white">

    <div class="px-8 mx-auto max-w-7xl lg:px-16">
        <!-- Top Nav -->
        <div class="flex flex-col flex-wrap py-10 mx-auto md:flex-row-reverse max-w-7xl :flex :flex-col">

            <div class="relative flex flex-col md:flex-row-reverse">
                <nav class="flex flex-wrap items-center pt-3 pb-5 mb-4 space-x-5 text-base border-b border-gray-200 md:space-x-12 md:pt-0 md:mb-0 md:border-b-0 md:pr-3 md:mr-3 md:pb-0 :flex">
                    <a href="{{ route('home') }}"
                       class="font-medium leading-6 text-gray-800 hover:text-gray-900">Home</a>
                    <a href="{{ url('/admin') }}"
                       class="font-medium leading-6 text-gray-800 hover:text-gray-900">Login</a>
                </nav>
            </div>
        </div>
        <!-- End Top Nav -->


        <div class="relative flex flex-col items-center lg:flex-row">
            <div class="flex justify-start w-full md:py-12 lg:py-32 lg:w-1/3">
                <div class="flex flex-col items-center justify-center w-full lg:items-start lg:max-w-lg">
                    <p class="inline-block mb-4 text-xs font-medium tracking-wider text-green-400 uppercase"
                       data-primary="green-400">OPEN SOURCE </p>
                    <h5 class="text-6xl font-thin leading-none text-center mb-7 lg:text-left md:text-7xl">
                        <span class="block">Short</span>
                        <span class="block font-bold">URL</span>
                    </h5>
                    <form action="https://github.com/marco-introini/short-url">
                        <button type="submit"
                                class="inline-flex items-center justify-center px-8 py-4 mr-6 text-xl font-medium tracking-wide text-white transition duration-200 bg-green-400 hover:bg-green-500 focus:shadow-outline focus:outline-none"
                                data-primary="green-400" data-rounded="">View on GitHub
                        </button>
                    </form>
                </div>
            </div>
            <div class="relative w-full h-auto pt-16 lg:w-2/3">
                <img src="https://cdn.devdojo.com/images/november2022/header-right-graphic.png" class="w-full h-auto">
            </div>
        </div>

    </div>

    <div class="items-center w-full h-auto py-12 bg-green-400 lg:-mt-16" data-primary="green-400">
        <div class="flex mx-auto max-w-7xl lg:px-16">
            <div class="flex flex-col items-center w-full pr-5 lg:w-1/3 lg:flex-row">
                <p class="w-full mb-5 text-base text-center text-green-600 lg:text-left lg:w-48 lg:mb-0"
                   data-primary="green-400">An OS Software by <br>Marco Introini</p>
                <a href="https://marcointroini.it"
                   class="flex-shrink-0 px-4 py-3 text-white bg-green-500 border-green-700"
                   data-primary="green-400" data-rounded="">Visit Home Page</a>
            </div>
            <div class="hidden w-2/3 lg:block"></div>
        </div>
    </div>


</section>
<section class="h-[640px] bg-white">
    <div class="max-w-7xl px-5 py-20 space-y-5 flex flex-col w-full h-full items-center justify-center mx-auto">
        <div class="flex h-1/4 w-full rounded-md">

            <h5 class="text-6xl font-thin leading-none text-center mb-7 lg:text-left md:text-7xl">
                <span class="block font">Documentation</span>
            </h5>

        </div>
        <div class="flex h-3/4 w-full rounded-md">
            <div class="prose lg:prose-xl">
                <x-markdown>
                    @php(readfile('../README.md'))
                </x-markdown>

            </div>

        </div>
    </div>
</section>

</body>
</html>
