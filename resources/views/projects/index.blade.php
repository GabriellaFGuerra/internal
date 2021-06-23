@extends('layout.index', ['title' => 'Projetos', 'action' => 'Projetos', 'button' => 'Novo projeto', 'route' =>
'createProject'])

@section('content')
    <div class="flex flex-row flex-wrap text-white grid md:grid-cols-3">
        @foreach ($projects as $project)
            <div class="py-6 px-3 text-white w-full">
                <div class="shadow-xl rounded-lg overflow-hidden  bg-dark-blue ">
                    <div class="p-4">
                        <p class="text-3xl">
                            <a class="hover:no-underline link"
                                href="{{ route('project', ['name' => $project->project, 'id' => $project->id]) }}">{{ str_replace('_', ' ', ucwords($project->project, '_')) }}</a>
                        </p>
                        <p>
                            {{ $project->address . ' - ' . $project->district }}
                            <br>
                            {{ 'CEP: ' . $project->zipcode }}
                        </p>
                    </div>
                    <div class="px-4 pt-3 pb-4 border-t border-gray-300">
                        <div class="flex items-center pt-2">
                            <div class="bg-cover bg-center w-10 h-10 rounded-full mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <div>
                                <p class="font-bold">
                                    {{ $project->user->firstname . ' ' . $project->user->lastname }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        @endforeach
    </div>
@endsection
