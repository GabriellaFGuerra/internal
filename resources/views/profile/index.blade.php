@extends('layout.index', ['title' => 'Profile'])

@section('content')
    <form method="POST" action="{{route('resetpassword')}}">
        @csrf
        <div class="h-full">
            <div class="border-b-2 block md:flex">
                <div class="w-full md:w-2/5 px-4 py-6 sm:px-6 lg:px-8 bg-white shadow-md">
                    <div class="flex justify-between">
                        <span class="text-xl font-semibold block">Perifl de usuário</span>
                    </div>

                    <div class="w-full px-8 md:p-8 mx-2 flex justify-center">
                        <svg class="w-48 h-48 md:block hidden" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>

                <div class="w-full md:w-3/5 px-8 bg-white lg:ml-4 shadow-md">
                    <div class="rounded  shadow p-6">
                        <div class="pb-6">
                            <label for="name" class="font-semibold text-gray-700 block pb-1">Nome completo</label>
                            <div class="flex">
                                <input disabled id="username" class="border-1  rounded-r px-4 py-2 w-full" type="text"
                                       value="{{ $username }}"/>
                            </div>
                        </div>
                        <div class="pb-6">
                            <label for="role" class="font-semibold text-gray-700 block pb-1">Cargo</label>
                            <div class="flex">
                                <input disabled id="role" class="border-1  rounded-r px-4 py-2 w-full" type="text"
                                       value="{{ $role }}"/>
                            </div>
                        </div>
                        <div class="pb-4">
                            <label for="about" class="font-semibold text-gray-700 block pb-1">Email</label>
                            <input onclick="this.readOnly = false"
                                   readonly id="email" name="email"
                                   class="border-1 rounded-r px-4 py-2 w-full border border-black"
                                   type="email"
                                   value="{{ $email }}"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="h-full">

            <div class="border-b-2 block md:flex">

                <div class="w-full md:w-2/5 px-4 py-6 sm:px-6 lg:px-8 bg-white shadow-md">
                    <div class="flex justify-between">
                        <span class="text-xl font-semibold block">Alterar senha</span>
                    </div>

                    <div class="w-full px-8 md:p-8 mx-2 flex justify-center">
                        <svg class="w-48 h-48 md:block hidden" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </div>
                </div>

                <div class="w-full md:w-3/5 px-8 bg-white lg:ml-4 shadow-md">
                    <div class="rounded  shadow p-6">
                        <div class="pb-4">
                            <label for="password" class="font-semibold text-gray-700 block pb-1">Nova senha</label>
                            <input name="password" id="password" type="password"
                                   class="border-1 rounded-r px-4 py-2 w-full border border-black"/>

                        </div>
                    </div>

                    <div class="rounded  shadow p-6">
                        <div class="pb-4">
                            <label for="confirmpassword" class="font-semibold text-gray-700 block pb-1">Confirme a nova
                                senha</label>
                            <input name="password_confirmation" id="confirmpassword" type="password"
                                   class="border-1 rounded-r px-4 py-2 w-full border border-black"/>

                        </div>
                    </div>

                    <div class="rounded  shadow p-6">
                        <div class="pb-4">
                            <label for="oldpassword" class="font-semibold text-gray-700 block pb-1">Senha atual</label>
                            <input name="oldpassword" id="oldpassword" type="password"
                                   class="border-1 rounded-r px-4 py-2 w-full border border-black"/>
                        </div>
                    </div>

                    <button
                        class="bg-white text-gray-800 font-bold rounded border-b-2 border-green-500 hover:border-green-600 hover:bg-green-500 hover:text-white shadow-md py-2 px-6 inline-flex items-center">
                        <span class="mr-2">Salvar alterações</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path fill="currentcolor" d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </form>
@endsection
