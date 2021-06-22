<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/extra.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('img/icon.png') }}" />
    <title>
        @isset($title)
            {{ $title }} |
        @endisset
        {{ str_replace('_', ' ', config('app.name')) }}
    </title>
    <!-- Main styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">

    <!-- jQuery -->
    <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>

    <!-- UIkit CSS -->
    <link rel="stylesheet" href="{{ asset('css/uikit.min.css') }}" />

    <!-- Datatables -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/datatables.min.css') }}" />

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/material-design-icons/3.0.1/iconfont/material-icons.min.css"
        integrity="sha256-x8PYmLKD83R9T/sYmJn1j3is/chhJdySyhet/JuHnfY=" crossorigin="anonymous" />

    <!-- Font Awesome -->
    <script type="text/javascript" src="https://kit.fontawesome.com/0f80458282.js" crossorigin="anonymous"></script>


    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}" />

    <!-- TinyMCE -->
    <script type="text/javascript"
        src="https://cdn.tiny.cloud/1/0jnvj5pf98dzsgqm7o7tal9ky21exdgw0k0f434ih2x49bkq/tinymce/5/tinymce.min.js"
        referrerpolicy="origin"></script>

    <head>

    <body>
        @if (!Route::is('login') and !Route::is('register') and !Route::is('forgotpassword') and !Route::is('recovery'))
            <nav class="flex items-center bg-dark-blue p-3 flex-wrap">
                <a href="{{ route('home') }}" class="p-2 mr-4 inline-flex items-center">
                    <span class="text-xl text-white font-bold uppercase tracking-wide">Grupo Reica</span>
                </a>
                <button
                    class="text-white inline-flex p-3 rounded lg:hidden ml-auto hover:text-white outline-none nav-toggler"
                    data-target="#navigation">
                    <i class="material-icons">menu</i>
                </button>
                <div class="hidden top-navbar w-full lg:inline-flex lg:flex-grow lg:w-auto" id="navigation">
                    <div
                        class="lg:inline-flex lg:flex-row lg:ml-auto lg:w-auto w-full lg:items-center items-start flex flex-col lg:h-auto">

                        <a href="{{ route('home') }}"
                            class="lg:inline-flex lg:w-auto w-full px-3 py-2 rounded text-white items-center justify-center nav-text">
                            <span>Home</span>
                        </a>
                        @if (Auth::user()->role_id == 1 or Auth::user()->role_id == 2)
                            <a href="{{ route('purchases') }}"
                                class="lg:inline-flex lg:w-auto w-full px-3 py-2 rounded text-white items-center justify-center nav-text">
                                <span>Compras</span>
                            </a>
                        @endif
                        @if (Auth::user()->role_id != 4)
                            <a href="{{ route('documents') }}"
                                class="lg:inline-flex lg:w-auto w-full px-3 py-2 rounded text-white items-center justify-center nav-text">
                                <span>Documentos</span>
                            </a>
                        @endif
                        @if (Auth::user()->role_id != 3)
                            <a href="{{ route('stock') }}"
                                class="lg:inline-flex lg:w-auto w-full px-3 py-2 rounded text-white items-center justify-center nav-text">
                                <span>Estoque</span>
                            </a>
                        @endif
                        @if (Auth::user()->role_id != 4)
                            <a href="{{ route('employees') }}"
                                class="lg:inline-flex lg:w-auto w-full px-3 py-2 rounded text-white items-center justify-center nav-text">
                                <span>Funcionários</span>
                            </a>

                            <a href="{{ route('blueprints') }}"
                                class="lg:inline-flex lg:w-auto w-full px-3 py-2 rounded text-white items-center justify-center nav-text">
                                <span>Plantas</span>
                            </a>
                            <a href="{{ route('projects') }}"
                                class="lg:inline-flex lg:w-auto w-full px-3 py-2 rounded text-white items-center justify-center nav-text">
                                <span>Projetos</span>
                            </a>
                        @endif
                        @auth
                            <a href="{{ route('profile') }}"
                                class="lg:inline-flex lg:w-auto w-full px-3 py-2 rounded text-white items-center justify-center nav-text">
                                <span>Perfil</span>
                            </a>
                            <a href="{{ route('logout') }}"
                                class="lg:inline-flex lg:w-auto w-full px-3 py-2 rounded text-white items-center justify-center nav-text">
                                <span>Logout</span>
                            </a>
                        @endauth
                    </div>
                </div>
            </nav>

            <script>
                $(document).ready(function() {
                    $(".nav-toggler").each(function(_, navToggler) {
                        var target = $(navToggler).data("target");
                        $(navToggler).on("click", function() {
                            $(target).animate({
                                height: "toggle"
                            });
                        });
                    });
                });
            </script>

            @if ($errors->any())
                <div class="alert flex flex-row items-center bg-red-200 p-5 rounded border-b-2 border-red-300">
                    <div
                        class="alert-icon flex items-center bg-red-100 border-2 border-red-500 justify-center h-10 w-10 flex-shrink-0 rounded-full">
                        <span class="text-red-500">
                            <svg fill="currentColor" viewBox="0 0 20 20" class="h-6 w-6">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </span>
                    </div>
                    <div class="alert-content ml-4">
                        <div class="alert-title font-semibold text-lg text-red-800">
                            Erro
                        </div>
                        <div class="alert-description text-sm text-red-600">
                            <ul class="list-disc">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif
            @if (session()->has('message') or session()->has('status'))
                <div class="alert flex flex-row items-center bg-green-200 p-5 rounded border-b-2 border-green-300">
                    <div
                        class="alert-icon flex items-center bg-green-100 border-2 border-green-500 justify-center h-10 w-10 flex-shrink-0 rounded-full">
                        <span class="text-green-500">
                            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                        </span>
                    </div>
                    <div class="alert-content ml-4">
                        <div class="alert-title font-semibold text-lg text-green-800">
                            {{ session()->get('message') ?? session()->get('status') }}
                        </div>
                    </div>
                </div>
            @endif
            @if (session()->has('error'))
                <div class="alert flex flex-row items-center bg-red-200 p-5 rounded border-b-2 border-red-300">
                    <div
                        class="alert-icon flex items-center bg-red-100 border-2 border-red-500 justify-center h-10 w-10 flex-shrink-0 rounded-full">
                        <span class="text-red-500">
                            <svg fill="currentColor" viewBox="0 0 20 20" class="h-6 w-6">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </span>
                    </div>
                    <div class="alert-content ml-4">
                        <div class="alert-title font-semibold text-lg text-red-800">
                            {{ session()->get('error') }}
                        </div>
                    </div>
                </div>
            @endif
        @endif

        @yield('content')

    </body>

    <!-- jQuery Mask -->
    <script type="text/javascript" src="{{ asset('js/jquery.mask.min.js') }}"></script>

    <!-- AlpineJS -->
    <script type="text/javascript" src="//unpkg.com/alpinejs" defer></script>

    <!-- Datatables -->
    <script type="text/javascript" src="{{ asset('js/datatables.min.js') }}"></script>

    <!-- UIkit JS -->
    <script type="text/javascript" src="{{ asset('js/uikit.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/uikit-icons.min.js') }}"></script>

</html>
