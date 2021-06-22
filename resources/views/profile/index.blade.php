@extends('layout.index', ['title' => 'Profile', 'action' => 'Perfil'])

@section('content')
    <form method="POST" action="{{ route('resetpassword') }}">
        @csrf
        <div class="rounded  shadow p-3">
            <div class="pb-3">
                <label for="name" class="font-semibold text-gray-700 block pb-1">Nome completo</label>
                <div class="flex">
                    <input disabled id="username" class="border-1  rounded-r px-4 py-2 w-full" type="text"
                        value="{{ $username }}" />
                </div>
            </div>
            <div class="pb-3">
                <label for="role" class="font-semibold text-gray-700 block pb-1">Cargo</label>
                <div class="flex">
                    <input disabled id="role" class="border-1  rounded-r px-4 py-2 w-full" type="text"
                        value="{{ $role }}" />
                </div>
            </div>
            <div class="pb-2">
                <label for="about" class="font-semibold text-gray-700 block pb-1">Email</label>
                <input onclick="this.readOnly = false" readonly id="email" name="email"
                    class="border-1 rounded-r px-4 py-2 w-full border border-black" type="email"
                    value="{{ $email }}" />
            </div>
        </div>
        <div class="rounded  shadow p-3">
            <div class="pb-2">
                <label for="password" class="font-semibold text-gray-700 block pb-1">Nova senha</label>
                <input name="password" id="password" type="password"
                    class="border-1 rounded-r px-4 py-2 w-full border border-black" />

            </div>
        </div>

        <div class="rounded  shadow p-3">
            <div class="pb-2">
                <label for="confirmpassword" class="font-semibold text-gray-700 block pb-1">Confirme a nova
                    senha</label>
                <input name="password_confirmation" id="confirmpassword" type="password"
                    class="border-1 rounded-r px-4 py-2 w-full border border-black" />

            </div>
        </div>

        <div class="rounded shadow p-3">
            <div class="pb-2">
                <label for="oldpassword" class="font-semibold text-gray-700 block pb-1">Senha atual</label>
                <input name="oldpassword" id="oldpassword" type="password"
                    class="border-1 rounded-r px-4 py-2 w-full border border-black" />
            </div>
        </div>

        <button class="btn-submit font-bold rounded shadow-md py-2 px-6 inline-flex items-center">
            <span class="mr-2">Salvar alterações</span>
        </button>

    </form>
@endsection
