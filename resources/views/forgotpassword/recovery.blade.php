@extends('layout.index', ['title' => 'Password Reset'])

@section('content')
    <div class="container max-w-full mx-auto md:py-24 px-6">
        <div class="max-w-sm mx-auto px-6">
            <div class="relative flex flex-wrap">
                <div class="w-full relative">
                    <div class="md:mt-6">
                        <div class="text-center font-semibold text-black">
                            Crie uma nova senha
                        </div>
                        <form method="POST" action="{{route('recover')}}" class="mt-8"
                              x-data="{password: '',password_confirm: ''}">
                            @csrf
                            <div class="mx-auto max-w-lg ">
                                <div class="py-1">
                                    <input name="email" type="hidden" value="{{ $email }}">
                                    <input name="token" type="hidden" value="{{ $token }}">
                                    <div class="py-1">
                                        <span class="px-1 text-sm text-gray-600">Senha</span>
                                        <input name="password" type="password" x-model="password"
                                               class="text-md block px-3 py-2 rounded-lg w-full
                bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none">
                                    </div>
                                    <div class="py-1">
                                        <span class="px-1 text-sm text-gray-600">Confirmar senha</span>
                                        <input name="password_confirmation" type="password" x-model="password_confirm"
                                               class="text-md block px-3 py-2 rounded-lg w-full
                bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none">
                                    </div>
                                    <div class="flex justify-start mt-3 ml-4 p-1">
                                        <ul>
                                            <li class="flex items-center py-1">
                                                <div
                                                    :class="{'bg-green-200 text-green-700': password == password_confirm && password.length > 0, 'bg-red-200 text-red-700':password != password_confirm || password.length == 0}"
                                                    class=" rounded-full p-1 fill-current ">
                                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                                         stroke="currentColor">
                                                        <path
                                                            x-show="password == password_confirm && password.length > 0"
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="M5 13l4 4L19 7"/>
                                                        <path
                                                            x-show="password != password_confirm || password.length == 0"
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="M6 18L18 6M6 6l12 12"/>

                                                    </svg>
                                                </div>
                                                <span
                                                    :class="{'text-green-700': password == password_confirm && password.length > 0, 'text-red-700':password != password_confirm || password.length == 0}"
                                                    class="font-medium text-sm ml-3"
                                                    x-text="password == password_confirm && password.length > 0 ? 'Senhas iguais' : 'Senhas diferentes' "></span>
                                            </li>
                                            <li class="flex items-center py-1">
                                                <div
                                                    :class="{'bg-green-200 text-green-700': password.length > 7, 'bg-red-200 text-red-700':password.length < 7 }"
                                                    class=" rounded-full p-1 fill-current ">
                                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                                         stroke="currentColor">
                                                        <path x-show="password.length > 7" stroke-linecap="round"
                                                              stroke-linejoin="round" stroke-width="2"
                                                              d="M5 13l4 4L19 7"/>
                                                        <path x-show="password.length < 7" stroke-linecap="round"
                                                              stroke-linejoin="round" stroke-width="2"
                                                              d="M6 18L18 6M6 6l12 12"/>

                                                    </svg>
                                                </div>
                                                <span
                                                    :class="{'text-green-700': password.length > 7, 'text-red-700':password.length < 7 }"
                                                    class="font-medium text-sm ml-3"
                                                    x-text="password.length > 7 ? 'Mínimo atingido' : 'Mínimo de 8 caracteres' "></span>
                                            </li>
                                        </ul>
                                    </div>
                                    <button
                                        class="mt-3 text-lg font-semibold bg-gray-800 w-full text-white rounded-lg px-6 py-3 block shadow-xl hover:text-white hover:bg-black">
                                        Enviar
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection