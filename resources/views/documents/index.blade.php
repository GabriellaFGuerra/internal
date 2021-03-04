@extends('layout.index', ['title' => 'Documentos'])

@section('content')
    <div class="w-full m-auto">
        <div class="shadow-lg bg-white pb-6 pt-4 rounded-lg leading-normal">
            <table class="border-collapse w-full" id="table">
                <thead>
                <tr>
                    <th class="p-4 text-left text-sm font-medium text-gray-500">
                        ID
                    </th>
                    <th class="p-4 text-left text-sm font-medium text-gray-500">
                        Documento
                    </th>
                    <th class="p-4 text-left text-sm font-medium text-gray-500">
                        Tipo de documento
                    </th>
                    <th class="p-4 text-left text-sm font-medium text-gray-500">
                        Ações
                    </th>
                </tr>
                </thead>

                <tbody class="text-gray-600 text-sm divide-y divide-gray-300">
                @foreach ($documents as $document)
                    <tr class="bg-white font-medium text-sm divide-y divide-gray-200">
                        <td class="p-4 whitespace-nowrap">
                            {{ $document->id }}
                        </td>
                        <td class="p-4 whitespace-nowrap">
                            <a href="{{ route('downloadDoc', ['id' => $document->id]) }}">{{ $document->document_name }}</a>
                        </td>
                        <td class="p-4 whitespace-nowrap">
                            <span class="rounded bg-green-400 py-1 px-3 text-xs font-bold">Documento</span>
                        </td>
                        <td class="p-4 whitespace-nowrap">
                            <a href="{{ route('deleteDoc', ['id' => $document->id])}}">
                                Remover
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <button onclick="document.getElementById('add_documento').showModal()"
            class="fixed bottom-1 right-0 p-0 w-16 h-16 mx-5 bg-gray-800 rounded-full hover:bg-gray-700 active:shadow-lg mouse shadow transition ease-in duration-200 focus:outline-none">
        <svg viewBox="0 0 20 20" enable-background="new 0 0 20 20" class="w-6 h-6 inline-block">
            <path fill="#FFFFFF" d="M16,10c0,0.553-0.048,1-0.601,1H11v4.399C11,15.951,10.553,16,10,16c-0.553,0-1-0.049-1-0.601V11H4.601
                                    C4.049,11,4,10.553,4,10c0-0.553,0.049-1,0.601-1H9V4.601C9,4.048,9.447,4,10,4c0.553,0,1,0.048,1,0.601V9h4.399
                                    C15.952,9,16,9.447,16,10z"/>
        </svg>
    </button>
    <form action="{{ route('trashDoc') }}">
    <button type="submit"
        class="fixed bottom-1 left-0 p-0 w-16 h-16 mx-5 bg-gray-800 rounded-full hover:bg-gray-700 active:shadow-lg mouse shadow transition ease-in duration-200 focus:outline-none">
        <svg class="w-6 h-6 inline-block"
             xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="#FFFFFF">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  fill="transparent"
                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
        </svg>
    </button>
    </form>

    <style>
        dialog[open] {
            animation: appear .15s cubic-bezier(0, 1.8, 1, 1.8);
        }

        dialog::backdrop {
            background: linear-gradient(45deg, rgba(0, 0, 0, 0.5), rgba(54, 54, 54, 0.5));
            backdrop-filter: blur(3px);
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

    <dialog id="add_documento" class="p-5 bg-white rounded-md">
        <div class="flex flex-col">
            <form action="{{route('uploadDoc')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="flex w-full h-auto justify-center items-center">
                    <div class="flex w-10/12 h-auto py-3 justify-center items-center text-2xl font-bold">
                        Novo documento
                    </div>
                    <div onclick="document.getElementById('add_documento').close();"
                         class="flex w-1/12 h-auto justify-center cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                             fill="none"
                             stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-x">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </div>
                </div>

                <div class="md:w-full px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                           for="grid-name">
                        Nome do documento (sem extensão)
                    </label>
                    <input
                        name="name"
                        class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-red rounded py-3 px-4 mb-3"
                        id="grid-name" type="text" placeholder="Nome">
                </div>

                <div class="md:w-full px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                           for="grid-project">
                        Projeto
                    </label>
                    <select
                        name="project_id"
                        class="block appearance-none w-full bg-grey-lighter border border-grey-lighter text-grey-darker py-3 px-4 pr-8 rounded"
                        id="grid-project">
                        <option value="">Sem projeto</option>
                    </select>
                </div>

                <div class="bg-white p-7 rounded mx-auto">
                    <div x-data="dataFileDnD()"
                         class="relative flex flex-col p-4 text-gray-400 border border-gray-200 rounded">
                        <div x-ref="dnd"
                             class="relative flex flex-col text-gray-400 border border-gray-200 border-dashed rounded cursor-pointer">
                            <input accept="*"
                                   name="document"
                                   type="file" multiple
                                   class="absolute inset-0 z-50 w-full h-full p-0 m-0 outline-none opacity-0 cursor-pointer"
                                   @change="addFiles($event)"
                                   @dragover="$refs.dnd.classList.add('border-blue-400'); $refs.dnd.classList.add('ring-4'); $refs.dnd.classList.add('ring-inset');"
                                   @dragleave="$refs.dnd.classList.remove('border-blue-400'); $refs.dnd.classList.remove('ring-4'); $refs.dnd.classList.remove('ring-inset');"
                                   @drop="$refs.dnd.classList.remove('border-blue-400'); $refs.dnd.classList.remove('ring-4'); $refs.dnd.classList.remove('ring-inset');"
                                   title=""/>

                            <div class="flex flex-col items-center justify-center py-10 text-center">
                                <svg class="w-6 h-6 mr-1 text-current-50" xmlns="http://www.w3.org/2000/svg"
                                     fill="none"
                                     viewBox="0 0 24 24"
                                     stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <p class="m-0">Arraste seus arquivos ou clique nesta área</p>
                            </div>
                        </div>

                        <template x-if="files.length > 0">
                            <div class="grid grid-cols-2 gap-4 mt-4" @drop.prevent="drop($event)"
                                 @dragover.prevent="$event.dataTransfer.dropEffect = 'move'">
                                <template x-for="(_, index) in Array.from({ length: files.length })">
                                    <div
                                        class="relative flex flex-col items-center overflow-hidden text-center bg-gray-100 border rounded cursor-move select-none"
                                        style="padding-top: 100%;" @dragstart="dragstart($event)"
                                        @dragend="fileDragging = null"
                                        :class="{'border-blue-600': fileDragging == index}" draggable="true"
                                        :data-index="index">
                                        <button
                                            class="absolute top-0 right-0 z-50 p-1 bg-white rounded-bl focus:outline-none"
                                            type="button" @click="remove(index)">
                                            <svg class="w-4 h-4 text-gray-700" xmlns="http://www.w3.org/2000/svg"
                                                 fill="none"
                                                 viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      stroke-width="2"
                                                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                        <template x-if="files[index].type.includes('audio/')">
                                            <svg
                                                class="absolute w-12 h-12 text-gray-400 transform top-1/2 -translate-y-2/3"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      stroke-width="2"
                                                      d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"/>
                                            </svg>
                                        </template>
                                        <template
                                            x-if="files[index].type.includes('application/') || files[index].type === ''">
                                            <svg
                                                class="absolute w-12 h-12 text-gray-400 transform top-1/2 -translate-y-2/3"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      stroke-width="2"
                                                      d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                            </svg>
                                        </template>
                                        <template x-if="files[index].type.includes('image/')">
                                            <img
                                                class="absolute inset-0 z-0 object-cover w-full h-full border-4 border-white preview"
                                                x-bind:src="loadFile(files[index])"/>
                                        </template>
                                        <template x-if="files[index].type.includes('video/')">
                                            <video
                                                class="absolute inset-0 object-cover w-full h-full border-4 border-white pointer-events-none preview">
                                                <fileDragging x-bind:src="loadFile(files[index])"
                                                              type="video/mp4"></fileDragging>
                                            </video>
                                        </template>

                                        <div
                                            class="absolute bottom-0 left-0 right-0 flex flex-col p-2 text-xs bg-white bg-opacity-50">
                                        <span class="w-full font-bold text-gray-900 truncate"
                                              x-text="files[index].name">Loading</span>
                                            <span class="text-xs text-gray-900"
                                                  x-text="humanFileSize(files[index].size)">...</span>
                                        </div>

                                        <div class="absolute inset-0 z-40 transition-colors duration-300"
                                             @dragenter="dragenter($event)"
                                             @dragleave="fileDropping = null"
                                             :class="{'bg-blue-200 bg-opacity-80': fileDropping == index && fileDragging != index}">
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </template>
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                            class="focus:outline-none text-blue-600 text-sm py-2.5 px-5 rounded-full border border-blue-600 hover:bg-blue-50">
                        Enviar
                    </button>
                </div>
            </form>
            <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
            <script src="https://unpkg.com/create-file-list"></script>
            <script>
                function dataFileDnD() {
                    return {
                        files: [],
                        fileDragging: null,
                        fileDropping: null,
                        humanFileSize(size) {
                            const i = Math.floor(Math.log(size) / Math.log(1024));
                            return (
                                (size / Math.pow(1024, i)).toFixed(2) * 1 +
                                " " +
                                ["B", "kB", "MB", "GB", "TB"][i]
                            );
                        },
                        remove(index) {
                            let files = [...this.files];
                            files.splice(index, 1);

                            this.files = createFileList(files);
                        },
                        drop(e) {
                            let removed, add;
                            let files = [...this.files];

                            removed = files.splice(this.fileDragging, 1);
                            files.splice(this.fileDropping, 0, ...removed);

                            this.files = createFileList(files);

                            this.fileDropping = null;
                            this.fileDragging = null;
                        },
                        dragenter(e) {
                            let targetElem = e.target.closest("[draggable]");

                            this.fileDropping = targetElem.getAttribute("data-index");
                        },
                        dragstart(e) {
                            this.fileDragging = e.target
                                .closest("[draggable]")
                                .getAttribute("data-index");
                            e.dataTransfer.effectAllowed = "move";
                        },
                        loadFile(file) {
                            const preview = document.querySelectorAll(".preview");
                            const blobUrl = URL.createObjectURL(file);

                            preview.forEach(elem => {
                                elem.onload = () => {
                                    URL.revokeObjectURL(elem.src); // free memory
                                };
                            });

                            return blobUrl;
                        },
                        addFiles(e) {
                            const files = createFileList([...this.files], [...e.target.files]);
                            this.files = files;
                            this.form.formData.files = [...files];
                        }
                    };
                }
            </script>
        </div>
    </dialog>

    <script>
        $(document).ready(function () {
            $('#table').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.10.22/i18n/Portuguese-Brasil.json'
                },
                responsive: true
            })
        })
    </script>
@endsection
