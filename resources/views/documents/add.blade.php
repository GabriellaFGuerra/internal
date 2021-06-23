@extends('layout.index', ['title' => 'Documentos - Novo documento', 'action' => 'Documentos'])

@section('content')
    <form method="post" action="{{ route('uploadDoc') }}" enctype="multipart/form-data">
        @csrf
        <div class="flex flex-col">
            <div class="md:w-full px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-white text-xs font-bold mb-2" for="grid-name">
                    Nome do documento (sem extensão)
                </label>
                <input name="name"
                    class="border border-2 border-black rounded-lg px-2 py-2 mt-1 mb-4 text-sm w-full text-gray-900"
                    id="grid-name" type="text" placeholder="Nome" value="{{ old('name') }}">
            </div>

            <div class="w-full py-3 px-4" id="grid-project-dropdown">
                <label class="block uppercase tracking-wide text-white text-xs font-bold mb-2" for="grid-project">
                    Projeto
                </label>
                <select name="project_id"
                    class="border border-2 border-black rounded-lg px-2 py-2 mt-1 mb-4 text-sm w-full text-gray-900"
                    id="grid-project">
                    <option value="">Sem projeto</option>
                    @foreach ($projects as $project)
                        <option value="{{ $project->id }}">{{ str_replace('_', ' ', ucwords($project->project)) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="-mx-3 md:flex">
                <div class="w-full px-2 md:mb-0">
                    <label for="files"
                        class="block uppercase tracking-wide text-white text-xs font-bold mb-2">Arquivo</label><br>
                    <input type="file" class="file" name="files" id="files" data-browse-on-zone-click="true" required
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
                Enviar
            </button>
        </div>
    </form>
@endsection
