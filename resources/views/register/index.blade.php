@extends('layout.index', ['title' => 'Register'])

@section('content')

    <style>
        .select2-container {
            width: 100% !important;
            padding: 0;
        }
    </style>

    <div class="container max-w-full mx-auto md:py-24 px-6">
        <div class="max-w-sm mx-auto px-6">
            <div class="relative flex flex-wrap">
                <div class="w-full relative">
                    <div class="md:mt-6">
                        <div class="text-center font-semibold text-black">
                            Cadastre-se para acessar o painel
                        </div>
                        <form method="POST" action="{{route('register.store')}}" class="mt-8"
                              x-data="{password: '',password_confirm: ''}">
                            @csrf
                            <div class="mx-auto max-w-lg ">
                                <div class="py-1">
                                    <span class="px-1 text-sm text-gray-600">Nome</span>
                                    <input name="firstname" type="text"
                                           class="text-md block px-3 py-2 rounded-lg w-full
                bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none">
                                </div>
                                <div class="py-1">
                                    <span class="px-1 text-sm text-gray-600">Sobrenome</span>
                                    <input name="lastname" type="text"
                                           class="text-md block px-3 py-2 rounded-lg w-full
                bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none">
                                </div>
                                <div class="py-1" id="role-dropdown">
                                    <span class="px-1 text-sm text-gray-600">Cargo</span>
                                    <select
                                        name="role"
                                        class="block appearance-none w-full bg-grey-lighter border border-grey-lighter text-grey-darker py-3 px-4 pr-8 rounded"
                                        id="role">
                                        @foreach ($roles as $role)
                                            <option value="{{$role->id}}">{{ $role->role }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="py-1">
                                    <span class="px-1 text-sm text-gray-600">Email</span>
                                    <input name="email" type="email"
                                           class="text-md block px-3 py-2 rounded-lg w-full
                bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none">
                                </div>
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
                                    class="mt-3 text-lg bg-dark-blue w-full text-white rounded-lg px-6 py-3 block shadow-xl hover:text-white hover:bg-gray-900">
                                    Cadastrar-se
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#role').select2({
                dropdownParent: $('#role-dropdown')
            });
        });
    </script>

@endsection
