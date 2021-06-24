@extends('layout.index', ['title' => 'Plantas - Nova planta', 'action' => 'Plantas'])

@section('content')
    <form action="{{ route('storeBlueprint', ['id_project' => $id_project, 'project_name' => $project_name]) }}"
        method="POST" enctype="multipart/form-data">
        @csrf
        <div class="flex flex-col">
            <div class="-mx-3 md:flex mb-2">
                <div class="md:w-full px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-white text-xs font-bold mb-2" for="grid-name">
                        Nome da planta
                    </label>
                    <input name="name"
                        class="border-2 border-gray-500 rounded-lg px-2 py-2 mt-1 mb-4 text-sm w-full text-gray-900"
                        id="grid-name" type="text" placeholder="Nome" value="{{ old('name') }}">
                </div>

                <div class="md:w-full px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-white text-xs font-bold mb-2" for="grid-project">
                        Projeto
                    </label>
                    <input disabled
                        class="border-2 border-gray-500 rounded-lg px-2 py-2 mt-1 mb-4 text-sm w-full text-gray-900"
                        id="grid-name" type="text" value="{{ str_replace('_', ' ', ucwords($project_name, '_')) }}">
                </div>
            </div>
            <div class="-mx-3 md:flex">
                <div class="w-full px-2 md:mb-0">
                    <label for="files"
                        class="block uppercase tracking-wide text-white text-xs font-bold mb-2">Plantas</label><br>
                    <input type="file" class="file" name="files[]" id="files" data-browse-on-zone-click="true" required
                        multiple>
                    @error('files')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="flex place-items-end py-5">
            <button type="submit" class="focus:outline-none btn-submit text-sm py-2.5 px-5 rounded-full">
                Adicionar planta
            </button>
        </div>
    </form>
@endsection
