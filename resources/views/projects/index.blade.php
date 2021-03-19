@extends('layout.index', ['title' => 'Projetos'])

@section('content')
    <div class="flex flex-row flex-wrap">
        @foreach ($projects as $project)
            <div style="flex: 0 0 33.333333%">
                <div>
                    <div class="py-6 px-3">
                        <div class="bg-white shadow-xl rounded-lg overflow-hidden">
                            <div class="p-4">
                                <p class="text-3xl text-gray-900"><a
                                        href="{{route('project', ['name' => $project->project, 'id' => $project->id])}}">{{str_replace('_', ' ', ucwords($project->project, '_'))}}</a>
                                </p>
                                <p class="text-gray-700">
                                    {{$project->address . ' - ' . $project->district}}
                                    <br>
                                    {{'CEP: ' . $project->zipcode}}
                                </p>
                            </div>
                            <div class="px-4 pt-3 pb-4 border-t border-gray-300 bg-gray-100">
                                <div class="flex items-center pt-2">
                                    <div class="bg-cover bg-center w-10 h-10 rounded-full mr-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-bold text-gray-900">
                                            {{ $project->user->firstname . ' ' . $project->user->lastname }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <button onclick="document.getElementById('add_projeto').showModal()"
            class="fixed bottom-1 right-0 p-0 w-16 h-16 mx-5 bg-gray-800 rounded-full hover:bg-gray-700 active:shadow-lg mouse shadow transition ease-in duration-200 focus:outline-none">
        <svg viewBox="0 0 20 20" enable-background="new 0 0 20 20" class="w-6 h-6 inline-block">
            <path fill="#FFFFFF" d="M16,10c0,0.553-0.048,1-0.601,1H11v4.399C11,15.951,10.553,16,10,16c-0.553,0-1-0.049-1-0.601V11H4.601
                                    C4.049,11,4,10.553,4,10c0-0.553,0.049-1,0.601-1H9V4.601C9,4.048,9.447,4,10,4c0.553,0,1,0.048,1,0.601V9h4.399
                                    C15.952,9,16,9.447,16,10z"/>
        </svg>
    </button>

    <style>
        dialog[open] {
            animation: appear .15s cubic-bezier(0, 1.8, 1, 1.8);
        }

        dialog::backdrop {
            background: linear-gradient(45deg, rgba(0, 0, 0, 0.5), rgba(54, 54, 54, 0.5));
            backdrop-filter: blur(3px);
        }

        .select2-container {
            width: 100% !important;
            padding: 0;
        }

        @keyframes appear {
            from {
                opacity: 0;
                transform: translateX(-3rem);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
    </style>

    <dialog id="add_projeto" class="p-5 bg-white rounded-md w-1/2 h-auto">
        <div class="flex flex-col">
            <div class="flex w-full h-auto justify-center items-center">
                <div class="flex w-10/12 h-auto py-3 justify-center items-center text-2xl font-bold">
                    Novo projeto
                </div>
                <div onclick="document.getElementById('add_projeto').close();"
                     class="flex w-1/12 h-auto justify-center cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="feather feather-x">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </div>
            </div>
            <form action="{{route('newProject')}}" method="POST">
                @csrf
                <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 flex flex-col my-2">
                    <div class="-mx-3 md:flex mb-6">
                        <div class="md:w-full px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                                   for="grid-name">
                                Nome do Projeto
                            </label>
                            <input
                                name="project"
                                class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-red rounded py-3 px-4 mb-3"
                                id="grid-name" type="text" placeholder="Projeto">
                        </div>
                    </div>
                    <div class="-mx-3 md:flex mb-6">
                        <div class="md:w-full px-3">
                            <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                                   for="grid-address">
                                Endereço
                            </label>
                            <input
                                name="address"
                                class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4 mb-3"
                                id="grid-address" type="text" placeholder="Endereço">
                        </div>
                    </div>
                    <div class="flex flex-row">
                        <div class="md:w-1/2 px-3">
                            <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                                   for="grid-zip">
                                CEP
                            </label>
                            <input
                                name="zipcode"
                                class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4"
                                id="grid-zip" type="text" placeholder="CEP">
                        </div>
                        <div class="md:w-1/2 px-3">
                            <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                                   for="grid-neighborhood">
                                Bairro
                            </label>
                            <input
                                name="district"
                                class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4"
                                id="grid-neighborhood" type="text" placeholder="Bairro">
                        </div>
                    </div>
                    <div class="md:w-full px-3 mb-6 md:mb-0" id="grid-stage-dropdown">
                        <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                               for="grid-stage">
                            Etapa
                        </label>
                        <select
                            name="stage"
                            class="block appearance-none w-full bg-grey-lighter border border-grey-lighter text-grey-darker py-3 px-4 pr-8 rounded"
                            id="grid-stage">
                            <option value="1">Etapa 1</option>
                            <option value="2">Etapa 2</option>
                            <option value="3">Etapa 3</option>
                        </select>
                    </div>
                    <div class="md:w-full px-3 mb-6 md:mb-0" id="grid-user-dropdown">
                        <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                               for="grid-user">
                            Responsável
                        </label>
                        <select
                            name="user_id"
                            class="block appearance-none w-full bg-grey-lighter border border-grey-lighter text-grey-darker py-3 px-4 pr-8 rounded"
                            id="grid-user">
                            @foreach ($users as $user)
                                <option value="{{$user->id}}">{{$user->firstname . ' ' . $user->lastname}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                            class="focus:outline-none text-gray-800 text-sm py-2.5 px-5 rounded-full border border-gray-800 hover:bg-gray-100">
                        Criar projeto
                    </button>
                </div>
            </form>
        </div>
    </dialog>

    <script>
        $(document).ready(function () {

            $('#grid-stage').select2({
                dropdownParent: $('#grid-stage-dropdown')
            });

            $('#grid-user').select2({
                dropdownParent: $('#grid-user-dropdown')
            });
        });
    </script>
@endsection
