@extends('layout.index', ['title' => 'Login'])

@section('content')
    <style>
        .login-btn {
            background-color: #55B2FF;
            color: #1E4D66;
        }

        .login-btn:hover {
            background-color: #1E4D66;
            color: #55B2FF;
        }
    </style>
    <div class="min-h-screen bg-gray-100 flex flex-col justify-center sm:py-12">
        <div class="p-10 xs:p-0 mx-auto md:w-full md:max-w-md">
            <img src="{{ asset('img/logo.png') }}"/>
            <div class="bg-white shadow w-full rounded-lg divide-y divide-gray-200">
                <div class="px-5 py-7">
                    <form method="post" action="{{route('login.auth')}}">
                        @csrf
                        <label class="font-semibold text-sm text-gray-600 pb-1 block">Email</label>
                        <input type="email" name="email" class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full"/>
                        <label class="font-semibold text-sm text-gray-600 pb-1 block">Senha</label>
                        <input type="password" name="password"
                               class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full"/>
                        <button type="submit"
                                class="transition duration-200 login-btn focus:shadow-sm focus:ring-4 focus:ring-blue-500 focus:ring-opacity-50 w-full py-2.5 rounded-lg text-sm shadow-sm hover:shadow-md font-semibold text-center inline-block">
                            <span class="inline-block mr-2">Login</span>
                        </button>
                    </form>
                </div>
                <div class="py-5">
                    <div class="grid grid-cols-2 gap-1">
                        <div class="text-center sm:text-left whitespace-nowrap">
                            <a href="{{route('forgotpassword')}}"
                               class="transition duration-200 mx-5 px-5 py-4 cursor-pointer font-normal text-sm rounded-lg text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-200 focus:ring-2 focus:ring-gray-400 focus:ring-opacity-50 ring-inset">
                                <span class="inline-block ml-1">Esqueci minha senha</span>
                            </a>
                        </div>
                        <div class="text-center sm:text-right  whitespace-nowrap">
                            <a href="{{route('register')}}"
                               class="transition duration-200 mx-5 px-5 py-4 cursor-pointer font-normal text-sm rounded-lg text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-200 focus:ring-2 focus:ring-gray-400 focus:ring-opacity-50 ring-inset">
                                <span class="inline-block ml-1">Registrar-se</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
