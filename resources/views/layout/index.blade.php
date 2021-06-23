<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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

    <!-- Bootstrap 4 -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- File Input -->
    <link href="{{ asset('css/fileinput.css') }}" rel="stylesheet">

    <!-- jQuery -->
    <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>

    <!-- UIkit CSS
    <link rel="stylesheet" href="{{ asset('css/uikit.min.css') }}" />
-->
    <!-- Material Icons
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/material-design-icons/3.0.1/iconfont/material-icons.min.css"
        integrity="sha256-x8PYmLKD83R9T/sYmJn1j3is/chhJdySyhet/JuHnfY=" crossorigin="anonymous" />
-->

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">


    <!-- TinyMCE -->
    <script type="text/javascript"
        src="https://cdn.tiny.cloud/1/0jnvj5pf98dzsgqm7o7tal9ky21exdgw0k0f434ih2x49bkq/tinymce/5/tinymce.min.js"
        referrerpolicy="origin"></script>

    <!-- Select2
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}" />
-->
</head>

<body class="bg-sidebar">
    @if (!Route::is('login') and !Route::is('register') and !Route::is('forgotpassword') and !Route::is('recovery'))
        <div class="flex">
            <aside class="sticky top-0 bg-sidebar h-screen w-64 hidden sm:block shadow-xl">
                <div class="p-3">
                    <a href="{{ route('home') }}"
                        class="text-white text-xl font-semibold uppercase hover:text-gray-300">Grupo Reica</a>
                    @isset($route)
                        <a href="{{ route($route) }}"
                            class="w-full hover:no-underline bg-white cta-btn font-semibold py-1.5 mt-3 rounded-br-lg rounded-bl-lg rounded-tr-lg shadow-lg hover:shadow-xl hover:bg-gray-300 flex items-center justify-center">
                            <i class="fas fa-plus mr-3"></i> {{ $button }}
                        </a>
                    @endisset
                </div>
                <nav class="sticky text-white text-base font-semibold pt-1">
                    <a href="{{ route('home') }}"
                        class="flex items-center hover:no-underline text-white hover:text-white {{ $action == 'Perfil' ? 'active-nav-link' : 'opacity-75' }} py-4 pl-6 nav-item">
                        <i class="fas fa-user mr-3"></i>
                        Perfil
                    </a>
                    @if (Auth::user()->role_id == 1 or Auth::user()->role_id == 2)
                        <a href="{{ route('purchases') }}"
                            class="flex items-center hover:no-underline text-white hover:text-white {{ $action == 'Compras' ? 'active-nav-link' : 'opacity-75' }}  hover:opacity-100 py-4 pl-6 nav-item">
                            <i class="fas fa-shopping-basket mr-3"></i>
                            Compras
                        </a>
                    @endif
                    @if (Auth::user()->role_id != 4)
                        <a href="{{ route('documents') }}"
                            class="flex items-center hover:no-underline text-white hover:text-white {{ $action == 'Documentos' ? 'active-nav-link' : 'opacity-75' }}  hover:opacity-100 py-4 pl-6 nav-item">
                            <i class="fas fa-file-upload mr-3"></i>
                            Documentos
                        </a>
                    @endif
                    @if (Auth::user()->role_id != 3)
                        <a href="{{ route('stock') }}"
                            class="flex items-center hover:no-underline text-white hover:text-white {{ $action == 'Estoque' ? 'active-nav-link' : 'opacity-75' }}  hover:opacity-100 py-4 pl-6 nav-item">
                            <i class="fas fa-layer-group mr-3"></i>
                            Estoque
                        </a>
                    @endif
                    @if (Auth::user()->role_id != 4)
                        <a href="{{ route('employees') }}"
                            class="flex items-center hover:no-underline text-white hover:text-white {{ $action == 'Funcionários' ? 'active-nav-link' : 'opacity-75' }}  hover:opacity-100 py-4 pl-6 nav-item">
                            <i class="fas fa-user-friends mr-3"></i>
                            Funcionários
                        </a>

                        <a href="{{ route('blueprints') }}"
                            class="flex items-center hover:no-underline text-white hover:text-white {{ $action == 'Plantas' ? 'active-nav-link' : 'opacity-75' }}  hover:opacity-100 py-4 pl-6 nav-item">
                            <i class="fas fa-images mr-3"></i>
                            Plantas
                        </a>
                        <a href="{{ route('projects') }}"
                            class="flex items-center hover:no-underline text-white hover:text-white {{ $action == 'Projetos' ? 'active-nav-link' : 'opacity-75' }}  hover:opacity-100 py-4 pl-6 nav-item">
                            <i class="fas fa-pencil-ruler mr-3"></i>
                            Projetos
                        </a>
                    @endif
                </nav>

                <a href="{{ route('logout') }}"
                    class="absolute w-full text-white upgrade-btn bottom-0 active-nav-link flex items-center hover:no-underline hover:text-white justify-center py-2">
                    <i class="fas fa-sign-out-alt mr-3"></i>
                    Sair
                </a>
            </aside>

            <div class="w-full flex flex-col h-full overflow-y-hidden">
                <header x-data="{ isOpen: false }" class="w-full bg-sidebar py-3 px-6 sm:hidden">
                    <div class="flex items-center hover:no-underline justify-between">
                        <a href="index.html"
                            class="text-white text-3xl font-semibold uppercase hover:text-gray-300">Admin</a>
                        <button @click="isOpen = !isOpen" class="text-white text-3xl focus:outline-none">
                            <i x-show="!isOpen" class="fas fa-bars"></i>
                            <i x-show="isOpen" class="fas fa-times"></i>
                        </button>
                    </div>

                    <!-- Dropdown Nav -->
                    <nav :class="isOpen ? 'flex': 'hidden'" class="flex flex-col pt-4">
                        @isset($route)
                            <a href="{{ route($route) }}"
                                class="w-full hover:no-underline bg-white cta-btn font-semibold py-1.5 mt-3 rounded-br-lg rounded-bl-lg rounded-tr-lg shadow-lg hover:shadow-xl hover:bg-gray-300 flex items-center justify-center">
                                <i class="fas fa-plus mr-3"></i> {{ $button }}
                            </a>
                        @endisset
                        <a href="{{ route('home') }}"
                            class="flex items-center hover:no-underline text-white hover:text-white {{ $action == 'Perfil' ? 'active-nav-link' : 'opacity-75' }} py-4 pl-6 nav-item">
                            <i class="fas fa-user mr-3"></i>
                            Perfil
                        </a>
                        @if (Auth::user()->role_id == 1 or Auth::user()->role_id == 2)
                            <a href="{{ route('purchases') }}"
                                class="flex items-center hover:no-underline text-white hover:text-white {{ $action == 'Compras' ? 'active-nav-link' : 'opacity-75' }}  hover:opacity-100 py-4 pl-6 nav-item">
                                <i class="fas fa-shopping-basket mr-3"></i>
                                Compras
                            </a>
                        @endif
                        @if (Auth::user()->role_id != 4)
                            <a href="{{ route('documents') }}"
                                class="flex items-center hover:no-underline text-white hover:text-white {{ $action == 'Documentos' ? 'active-nav-link' : 'opacity-75' }}  hover:opacity-100 py-4 pl-6 nav-item">
                                <i class="fas fa-file-upload mr-3"></i>
                                Documentos
                            </a>
                        @endif
                        @if (Auth::user()->role_id != 3)
                            <a href="{{ route('stock') }}"
                                class="flex items-center hover:no-underline text-white hover:text-white {{ $action == 'Estoque' ? 'active-nav-link' : 'opacity-75' }}  hover:opacity-100 py-4 pl-6 nav-item">
                                <i class="fas fa-layer-group mr-3"></i>
                                Estoque
                            </a>
                        @endif
                        @if (Auth::user()->role_id != 4)
                            <a href="{{ route('employees') }}"
                                class="flex items-center hover:no-underline text-white hover:text-white {{ $action == 'Funcionários' ? 'active-nav-link' : 'opacity-75' }}  hover:opacity-100 py-4 pl-6 nav-item">
                                <i class="fas fa-user-friends mr-3"></i>
                                Funcionários
                            </a>

                            <a href="{{ route('blueprints') }}"
                                class="flex items-center hover:no-underline text-white hover:text-white {{ $action == 'Plantas' ? 'active-nav-link' : 'opacity-75' }}  hover:opacity-100 py-4 pl-6 nav-item">
                                <i class="fas fa-images mr-3"></i>
                                Plantas
                            </a>
                            <a href="{{ route('projects') }}"
                                class="flex items-center hover:no-underline text-white hover:text-white {{ $action == 'Projetos' ? 'active-nav-link' : 'opacity-75' }}  hover:opacity-100 py-4 pl-6 nav-item">
                                <i class="fas fa-pencil-ruler mr-3"></i>
                                Projetos
                            </a>
                        @endif
                        <a href="#"
                            class="flex items-center hover:no-underline text-white hover:text-white  hover:opacity-100 py-2 pl-4 nav-item">
                            <i class="fas fa-sign-out-alt mr-3"></i>
                            Sair
                        </a>
                    </nav>
                </header>



                <div class="w-full overflow-x-hidden flex flex-col">
                    <main class="w-full flex-grow p-6">
                        <h1 class="text-3xl text-white">{{ $title }}</h1>
                        @if ($errors->any())
                            <div
                                class="alert flex flex-row items-center bg-red-200 p-5 rounded border-b-2 border-red-300">
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
                            <div
                                class="alert flex flex-row items-center bg-green-200 p-5 rounded border-b-2 border-green-300">
                                <div
                                    class="alert-icon flex items-center bg-green-100 border-2 border-green-500 justify-center h-10 w-10 flex-shrink-0 rounded-full">
                                    <span class="text-green-500">
                                        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 20 20" stroke="currentColor">
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
                            <div
                                class="alert flex flex-row items-center bg-red-200 p-5 rounded border-b-2 border-red-300">
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

                        @yield('content')
                    </main>
                </div>
            </div>
        </div>

    @else
        @yield('auth')
    @endif


</body>

<!-- Bootstrap 4 -->
<script src="{{ asset('js/bootstrap.min.js') }}"></script>


<!-- FileInput -->
<script src="{{ asset('js/fileinput.js') }}"></script>
<script src="{{ asset('js/fileinput-lang/pt-BR.js') }}"></script>
<script src="{{ asset('js/fileinput-theme/theme.js') }}"></script>

<!-- jQuery Mask
<script type="text/javascript" src="{{ asset('js/jquery.mask.min.js') }}"></script>
-->
<!-- AlpineJS -->
<script type="text/javascript" src="//unpkg.com/alpinejs" defer></script>

<!-- UIkit JS
<script type="text/javascript" src="{{ asset('js/uikit.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/uikit-icons.min.js') }}"></script>
-->
<script>
    $("#files").fileinput({
        theme: "fas",
        language: "pt-BR",
        hideThumbnailContent: false,
        allowedFileExtensions: ["jpg", "png", "jpeg", "pdf", "txt", "docx"],
    });
</script>

</html>
