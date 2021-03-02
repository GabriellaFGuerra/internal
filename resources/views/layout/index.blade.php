<!doctype html>
<html lang="{{app()->getLocale()}}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        @isset($title)
            {{ $title }} |
        @endisset
        {{ str_replace('_', ' ', config('app.name')) }}
    </title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Main Quill library -->
    <script src="//cdn.quilljs.com/1.3.6/quill.js"></script>
    <script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>

    <!-- Theme included stylesheets -->
    <link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link href="//cdn.quilljs.com/1.3.6/quill.bubble.css" rel="stylesheet">

    <!-- UIkit CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.6.16/dist/css/uikit.min.css"/>
    <link rel="stylesheet" type="text/css"
          href="https://cdn.datatables.net/v/dt/dt-1.10.23/r-2.2.7/datatables.min.css"/>

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/material-design-icons/3.0.1/iconfont/material-icons.min.css"
          integrity="sha256-x8PYmLKD83R9T/sYmJn1j3is/chhJdySyhet/JuHnfY=" crossorigin="anonymous"/>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"
            integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>

</head>
<body>
@if (!Route::is('login') and !Route::is('register') and !Route::is('forgotpassword'))
    <style>
        html,
        body {
            font-family: "Rubik", sans-serif;
        }

        /* navigation
         - show navigation always on the large screen devices with (min-width:1024)
        */

        @media (min-width: 1024px) {
            .top-navbar {
                display: inline-flex !important;
            }
        }
    </style>


    <nav class="flex items-center bg-gray-800 p-3 flex-wrap">
        <a href="#" class="p-2 mr-4 inline-flex items-center">
            <span class="text-xl text-white font-bold uppercase tracking-wide">Grupo Reica</span>
        </a>
        <button
            class="text-white inline-flex p-3 hover:bg-gray-900 rounded lg:hidden ml-auto hover:text-white outline-none nav-toggler"
            data-target="#navigation">
            <i class="material-icons">menu</i>
        </button>
        <div
            class="hidden top-navbar w-full lg:inline-flex lg:flex-grow lg:w-auto"
            id="navigation">
            <div
                class="lg:inline-flex lg:flex-row lg:ml-auto lg:w-auto w-full lg:items-center items-start  flex flex-col lg:h-auto">
                <a href="{{route('home')}}"
                   class="lg:inline-flex lg:w-auto w-full px-3 py-2 rounded text-gray-400 items-center justify-center hover:bg-gray-900 hover:text-white">
                    <span>Home</span>
                </a>
                <a href="{{route('purchases')}}"
                   class="lg:inline-flex lg:w-auto w-full px-3 py-2 rounded text-gray-400 items-center justify-center hover:bg-gray-900 hover:text-white">
                    <span>Compras</span>
                </a>
                <a href="{{route('documents')}}"
                   class="lg:inline-flex lg:w-auto w-full px-3 py-2 rounded text-gray-400 items-center justify-center hover:bg-gray-900 hover:text-white">
                    <span>Documentos</span>
                </a>
                <a href="{{route('stock')}}"
                   class="lg:inline-flex lg:w-auto w-full px-3 py-2 rounded text-gray-400 items-center justify-center hover:bg-gray-900 hover:text-white">
                    <span>Estoque</span>
                </a>
                <a href="{{route('blueprints')}}"
                   class="lg:inline-flex lg:w-auto w-full px-3 py-2 rounded text-gray-400 items-center justify-center hover:bg-gray-900 hover:text-white">
                    <span>Plantas</span>
                </a>
                <a href="{{route('projects')}}"
                   class="lg:inline-flex lg:w-auto w-full px-3 py-2 rounded text-gray-400 items-center justify-center hover:bg-gray-900 hover:text-white">
                    <span>Projetos</span>
                </a>
                @auth
                    <a href="{{route('logout')}}"
                       class="lg:inline-flex lg:w-auto w-full px-3 py-2 rounded text-gray-400 items-center justify-center hover:bg-gray-900 hover:text-white">
                        <span>Logout</span>
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <script>
        $(document).ready(function () {
            $(".nav-toggler").each(function (_, navToggler) {
                var target = $(navToggler).data("target");
                $(navToggler).on("click", function () {
                    $(target).animate({
                        height: "toggle"
                    });
                });
            });
        });

    </script>
@endif

@yield('content')

</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"
        integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw=="
        crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.23/r-2.2.7/datatables.min.js"></script>

<!-- UIkit JS -->
<script src="https://cdn.jsdelivr.net/npm/uikit@3.6.16/dist/js/uikit.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/uikit@3.6.16/dist/js/uikit-icons.min.js"></script>
</html>
