@extends('layout.index', ['title' => 'Projetos - Novo projeto', 'action' => 'Projetos'])

@section('content')
    <form method="post" action="{{ route('storeProject') }}" enctype="multipart/form-data">
        @csrf
        <div class="flex flex-col">
            <div class="-mx-3 md:flex mb-2">
                <div class="md:w-full px-3 mb-2 md:mb-0">
                    <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-name">
                        Nome do Projeto
                    </label>
                    <input name="project"
                        class="border border-2 border-black rounded-lg px-2 py-2 mt-1 mb-4 text-sm w-full text-gray-900"
                        id="grid-name" type="text" placeholder="Projeto">
                </div>
            </div>
            <div class="-mx-3 md:flex mb-2">
                <div class="md:w-full px-3">
                    <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-address">
                        Endereço
                    </label>
                    <input name="address"
                        class="border border-2 border-black rounded-lg px-2 py-2 mt-1 mb-4 text-sm w-full text-gray-900"
                        id="grid-address" type="text" placeholder="Endereço">
                </div>
            </div>
            <div class="flex flex-row">
                <div class="md:w-1/2 px-3">
                    <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-zip">
                        CEP
                    </label>
                    <input name="zipcode"
                        class="border border-2 border-black rounded-lg px-2 py-2 mt-1 mb-4 text-sm w-full text-gray-900"
                        id="grid-zip" type="text" placeholder="CEP">
                </div>
                <div class="md:w-1/2 px-3">
                    <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                        for="grid-neighborhood">
                        Bairro
                    </label>
                    <input name="district"
                        class="border border-2 border-black rounded-lg px-2 py-2 mt-1 mb-4 text-sm w-full text-gray-900"
                        id="grid-neighborhood" type="text" placeholder="Bairro">
                </div>
            </div>
            <div class="md:w-full px-3 mb-2 md:mb-0" id="grid-stage-dropdown">
                <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-stage">
                    Etapa
                </label>
                <select name="stage"
                    class="border border-2 border-black rounded-lg px-2 py-2 mt-1 mb-4 text-sm w-full text-gray-900"
                    id="grid-stage">
                    <option value="1">Etapa 1</option>
                    <option value="2">Etapa 2</option>
                    <option value="3">Etapa 3</option>
                </select>
            </div>
            <div class="md:w-full px-3 mb-2 md:mb-0" id="grid-user-dropdown">
                <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-user">
                    Responsável
                </label>
                <select name="user_id"
                    class="border border-2 border-black rounded-lg px-2 py-2 mt-1 mb-4 text-sm w-full text-gray-900"
                    id="grid-user">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->firstname . ' ' . $user->lastname }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="flex place-items-end py-5">
            <button type="submit" class="focus:outline-none btn-submit text-sm py-2.5 px-5 rounded-full">
                Criar projeto
            </button>
        </div>

    </form>
@endsection
