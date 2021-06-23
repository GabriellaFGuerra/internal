@extends('layout.index', ['title' => 'Login'])

@section('login')
    <style>
        .hover-text:hover {
            color: #020F2F;
        }

    </style>
    <div class="login min-h-screen flex flex-col justify-center sm:py-12">
        <div class="p-10 xs:p-0 mx-auto md:w-full md:max-w-md">
            <img src="{{ asset('img/logo.png') }}" />
            <div class="bg-white shadow w-full rounded-lg divide-y divide-gray-200">
                <div class="px-5 py-7">
                    <form method="post" action="{{ route('login.auth') }}">
                        @csrf
                        <label class="font-semibold text-sm text-gray-600 pb-1 block">Email</label>
                        @error('email')
                            <span class="flex items-center font-medium tracking-wide text-red-500 text-xs">
                                Email não encontrado
                            </span>
                        @enderror
                        <input type="email" name="email"
                            class="border rounded-lg px-3 py-2 sm:py-0 mt-1 mb-5 text-sm w-full @error('email') border-red-500 @enderror" />

                        <label class="font-semibold text-sm text-gray-600 pb-1 block">Senha</label>
                        @error('password')
                            <span class="flex items-center font-medium tracking-wide text-red-500 text-xs">
                                Senha incorreta
                            </span>
                        @enderror
                        <input type="password" name="password"
                            class="border rounded-lg px-3 py-2 sm:py-0 mt-1 mb-5 text-sm w-full @error('email') border-red-500 @enderror" />
                        <button type="submit"
                            class="transition duration-200 focus:shadow-sm focus:ring-4 focus:ring-blue-500 focus:ring-opacity-50 w-full py-2.5 rounded-lg text-sm shadow-sm hover:shadow-md font-semibold text-center inline-block btn-submit">
                            <span class="inline-block mr-2">Login</span>
                        </button>
                    </form>
                </div>
                <div class="py-5">
                    <div class="grid sm:grid-rows-2 sm:gap-0 grid-cols-2 gap-2 ">
                        <div class="text-center sm:text-left whitespace-nowrap">
                            <a href="{{ route('forgotpassword') }}"
                                class="hover-text transition duration-200 mx-auto px-auto cursor-pointer font-normal text-sm rounded-lg text-gray-500 focus:outline-none">
                                <span class="inline-block ml-1">Esqueci minha senha</span>
                            </a>
                        </div>
                        <div class="text-center sm:text-right  whitespace-nowrap">
                            <a href="{{ route('register') }}"
                                class="hover-text transition duration-200 mx-auto px-auto cursor-pointer font-normal text-sm rounded-lg text-gray-500 focus:outline-none">
                                <span class="inline-block ml-1">Registrar-se</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
