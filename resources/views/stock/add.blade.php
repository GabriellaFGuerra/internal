@extends('layout.index', ['title' => 'Compras - Nova compra', 'action' => 'Compras'])

@section('content')
    <form method="post" action="{{ route('storeStock') }}" enctype="multipart/form-data">
        @csrf
        <div class="flex flex-col">
            <div class="-mx-3 md:flex">
                <div class="w-full px-2">
                    <label class="block uppercase tracking-wide text-white text-xs font-bold mb-2" for="grid-name">
                        Item
                    </label>
                    <input name="name"
                        class="border border-2 border-black rounded-lg px-2 py-2 mt-1 mb-4 text-sm w-full text-gray-900"
                        id="grid-name" type="text" placeholder="Item" value="{{ old('name') }}">
                </div>
            </div>
            <div class="-mx-3 md:flex">
                <div class="w-full px-2">
                    <label class="block uppercase tracking-wide text-white text-xs font-bold mb-2" for="grid-quantity">
                        Quantidade
                    </label>
                    <input name="quantity"
                        class="border border-2 border-black rounded-lg px-2 py-2 mt-1 mb-4 text-sm w-full text-gray-900"
                        id="grid-quantity" type="number" placeholder="Quantidade" value="{{ old('quantity') }}">
                </div>
            </div>
            <div class="-mx-3 md:flex">
                <div class="w-full px-2">
                    <label class="block uppercase tracking-wide text-white text-xs font-bold mb-2" for="grid-withdrawn">
                        Retirado em:
                    </label>
                    <input name="withdrawn"
                        class="border border-2 border-black rounded-lg px-2 py-2 mt-1 mb-4 text-sm w-full text-gray-900"
                        id="grid-withdrawn" type="datetime-local"
                        value="{{ date('Y-m-d\TH:i:s', strtotime(old('withdrawn'))) }}">
                </div>
                <div class="w-full px-2">
                    <label class="block uppercase tracking-wide text-white text-xs font-bold mb-2" for="grid-returned">
                        Devolvido em:
                    </label>
                    <input name="returned"
                        class="border border-2 border-black rounded-lg px-2 py-2 mt-1 mb-4 text-sm w-full text-gray-900"
                        id="grid-returned" type="datetime-local" value="{{ date('Y-m-d\TH:i:s', strtotime(old('returned'))) }}">
                </div>
            </div>
            <div class="w-full px-2" id="grid-category-dropdown">
                <label class="block uppercase tracking-wide text-white text-xs font-bold mb-2" for="grid-category-create">
                    Categoria
                </label>
                <select name="category_id"
                    class="border border-2 border-black rounded-lg px-2 py-2 mt-1 mb-4 text-sm w-full text-gray-900"
                    id="grid-category-create">
                    <option value="">Sem categoria</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->category }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex place-items-end py-5">
                <button type="submit" class="focus:outline-none btn-submit text-sm py-2.5 px-5 rounded-full">
                    Finalizar
                </button>
            </div>

    </form>
@endsection
