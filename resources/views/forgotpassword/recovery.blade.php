@extends('layout.index', ['title' => 'Password Reset'])

@section('auth')
    <div class="container max-w-full mx-auto md:py-8 px-6">
        <div class="max-w-sm mx-auto px-6">
            <div class="relative flex flex-wrap">
                <div class="w-full relative">
                    <div class="items-center">
                        <img src="{{ asset('img/logo.png') }}">
                    </div>
                    <form method="POST" action="{{ route('recover') }}" class=""
                        x-data="{password: '',password_confirm: ''}">
                        @csrf
                        <input name="email" type="hidden" value="{{ $email }}">
                        <input name="token" type="hidden" value="{{ $token }}">
                        <div class="mx-auto max-w-lg ">
                            <div class="bg-white shadow w-full rounded-lg divide-y divide-gray-200">
                                <div class="px-5 py-7">
                                    <form method="post" action="{{ route('login.auth') }}">
                                        @csrf
                                        <label class="font-semibold text-sm text-gray-600 pb-1 block">Senha</label>
                                        <input type="password" name="password" x-model="password"
                                            class="border-2 border-gray-400 rounded-lg px-3 py-2 mt-1 mb-4 text-sm w-full text-gray-900" />

                                        <label class="font-semibold text-sm text-gray-600 pb-1 block">Confirme a
                                            senha</label>
                                        <input type="password" name="password_confirmation" x-model="password_confirm"
                                            class="border-2 border-gray-400 rounded-lg px-3 py-2 mt-1 mb-4 text-sm w-full text-gray-900" />


                                        <div class="flex justify-start ml-4 p-1">
                                            <ul>
                                                <li class="flex items-center">
                                                    <div :class="{'bg-green-200 text-green-700': password == password_confirm && password.length > 0, 'bg-red-200 text-red-700':password != password_confirm || password.length == 0}"
                                                        class=" rounded-full p-1 fill-current ">
                                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                                            stroke="currentColor">
                                                            <path
                                                                x-show="password == password_confirm && password.length > 0"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M5 13l4 4L19 7" />
                                                            <path
                                                                x-show="password != password_confirm || password.length == 0"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M6 18L18 6M6 6l12 12" />

                                                        </svg>
                                                    </div>
                                                    <span
                                                        :class="{'text-green-700': password == password_confirm && password.length > 0, 'text-red-700':password != password_confirm || password.length == 0}"
                                                        class="font-medium text-sm ml-3"
                                                        x-text="password == password_confirm && password.length > 0 ? 'Senhas iguais' : 'Senhas diferentes' "></span>
                                                </li>
                                                <li class="flex items-center py-1">
                                                    <div :class="{'bg-green-200 text-green-700': password.length > 7, 'bg-red-200 text-red-700':password.length < 7 }"
                                                        class=" rounded-full p-1 fill-current ">
                                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                                            stroke="currentColor">
                                                            <path x-show="password.length > 7" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="2"
                                                                d="M5 13l4 4L19 7" />
                                                            <path x-show="password.length < 7" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="2"
                                                                d="M6 18L18 6M6 6l12 12" />

                                                        </svg>
                                                    </div>
                                                    <span
                                                        :class="{'text-green-700': password.length > 7, 'text-red-700':password.length < 7 }"
                                                        class="font-medium text-sm ml-3"
                                                        x-text="password.length > 7 ? 'Mínimo atingido' : 'Mínimo de 8 caracteres' "></span>
                                                </li>
                                            </ul>
                                        </div>

                                        <button type="submit"
                                            class="transition duration-200 focus:shadow-sm focus:ring-4 focus:ring-blue-500 focus:ring-opacity-50 w-full py-2.5 rounded-lg text-sm shadow-sm hover:shadow-md font-semibold text-center inline-block btn-submit-auth">
                                            <span class="inline-block mr-2">Atualizar senha</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
