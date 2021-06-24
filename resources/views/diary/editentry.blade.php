@extends('layout.index', ['title' => 'Editar página', 'action' => 'Projetos'])

@section('content')
    <div class="p-5 w-full">
        <form method="post" action="{{ route('editEntry', ['id' => $id, 'name' => $name, 'entry' => $entry]) }}"
            enctype="multipart/form-data">
            @csrf
            <div class="flex flex-col">
                <div class="text-white flex w-full h-auto justify-center items-center">
                    <div class="flex w-10/12 h-auto py-3 justify-center items-center font-bold text-lg md:text-2xl">
                        Editar entrada - {{ date('d/m/Y H:i', strtotime($data->entry_datetime)) }}
                    </div>
                </div>


                <textarea name="entry_text">{{ $data->entry_text }}</textarea>

                <div class="-mx-3 md:flex my-5">
                    <div class="w-full px-2 md:mb-0">
                        <label for="files"
                            class="block uppercase tracking-wide text-white text-xs font-bold mb-2">Imagens</label><br>
                        <input type="file" class="file" name="files[]" id="files" data-browse-on-zone-click="true"
                            multiple>
                        @error('files')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

            </div>

            <div class="flex justify-end py-3">
                <button type="submit" class="focus:outline-none text-sm py-2.5 px-2 rounded-full btn-submit">
                    Salvar
                </button>
            </div>
        </form>
    </div>

    <script>
        $(document).ready(function() {

            tinymce.init({
                selector: 'textarea',
                plugins: 'print preview paste autolink directionality fullscreen link table charmap hr nonbreaking toc insertdatetime advlist lists textpattern help charmap',
                menubar: 'file edit view insert format table help',
                toolbar: 'undo redo | bold italic underline | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | charmap | fullscreen  preview print | link',
                toolbar_sticky: false,
                height: 600,
                quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quicktable',
                toolbar_mode: 'sliding',
                contextmenu: 'link table',
                fontsize_formats: "8px 10px 12px 14px 18px 24px 36px",
                setup: function(editor) {
                    editor.on('change', function() {
                        tinymce.triggerSave();
                    });
                },
            });


        });
    </script>
@endsection
