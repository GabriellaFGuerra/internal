@extends('layout.index', ['title' => str_replace('_', ' ', ucwords($project_name, '_')), 'action' => 'Plantas'])



@section('content')
    @isset($no_blueprint)
        <div class="alert flex flex-row items-center bg-red-200 p-5 rounded border-b-2 border-red-300">
            <div
                class="alert-icon flex items-center bg-red-100 border-2 border-red-500 justify-center h-10 w-10 flex-shrink-0 rounded-full">
                <span class="text-red-500">
                    <svg fill="currentColor" viewBox="0 0 20 20" class="h-6 w-6">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </span>
            </div>
            <div class="alert-content ml-4">
                <div class="alert-title font-semibold text-lg text-red-800">
                    Erro
                </div>
                <div class="alert-description text-sm text-red-600">
                    {{ $no_blueprint }}
                </div>
            </div>
        </div>
    @endisset
    <div class="flex flex-row flex-wrap grid md:grid-cols-2 gap-2">
        @foreach ($blueprints as $blueprint)

            <div class="flex justify-center items-center w-full">
                <div
                    class="w-64 cursor-pointer border b-gray-400 rounded flex flex-col justify-center items-center text-center p-3 bg-white div-img">
                    <div class="w-32 h-32 flex items-center justify-center ">
                        <a
                            href="{{ route('deleteBlueprint', ['id_project' => $id_project, 'project_name' => $project_name, 'id' => $blueprint->id]) }}">
                            <i class="fas fa-trash-alt fa-2x delete h-9 w-9 text-red-700 hover:text-red-900"></i>
                        </a>
                        <img src="{{ asset('storage/app/public/' . $blueprint->blueprint_path) }}">
                    </div>
                    <a href="{{ route('downloadBlueprint', ['id_project' => $id_project, 'project_name' => $project_name, 'id' => $blueprint->id]) }}"
                        class="hover:no-underline">
                        <p class="uppercase text-lg hover:underline">{{ $blueprint->blueprint }}</p>
                    </a>
                </div>
            </div>

        @endforeach
    </div>

    <a href="{{ route('createBlueprint', ['id_project' => $id_project, 'project_name' => $project_name]) }}"
        class="float">
        <i class="fa fa-plus my-float"></i>
    </a>
    <div class="flex flex-wrap">
        <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/6 mb-4 bg-gray-500"></div>
        <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/6 mb-4 bg-gray-400"></div>
        <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/6 mb-4 bg-gray-500"></div>
        <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/6 mb-4 bg-gray-400"></div>
        <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/2 xl:w-1/6 mb-4 bg-gray-500"></div>
        <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/2 xl:w-1/6 mb-4 bg-gray-400"></div>
    </div>
@endsection
