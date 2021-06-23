@extends('layout.index', ['title' => 'Compras - Editar compra', 'action' => 'Compras'])

@section('content')
    <form method="post" action="{{ route('updatePurchase', $purchase->id) }}" enctype="multipart/form-data">
        @csrf
        <div class="flex flex-col">
            <div class="-mx-3 md:flex">
                <div class="w-full px-2">
                    <label class="block uppercase tracking-wide text-white text-xs font-bold mb-2" for="grid-name">
                        Item
                    </label>
                    <input name="name"
                        class="border border-2 border-black rounded-lg px-2 py-2 mt-1 mb-4 text-sm w-full text-gray-900"
                        id="grid-name" type="text" placeholder="Item" value="{{ $purchase->item ?? old('name') }}">
                </div>
            </div>
            <div class="-mx-3 md:flex">
                <div class="w-full px-2">
                    <label class="block uppercase tracking-wide text-white text-xs font-bold mb-2" for="grid-price">
                        Valor unitário
                    </label>
                    <input name="vl_unit"
                        class="border border-2 border-black rounded-lg px-2 py-2 mt-1 mb-4 text-sm w-full text-gray-900"
                        id="grid-price" type="number" step="0.01" placeholder="Valor unitário"
                        value="{{ $purchase->unit_value ?? old('vl_unit') }}">
                </div>
                <div class="w-full px-2">
                    <label class="block uppercase tracking-wide text-white text-xs font-bold mb-2" for="grid-quantity">
                        Quantidade
                    </label>
                    <input name="quantity"
                        class="border border-2 border-black rounded-lg px-2 py-2 mt-1 mb-4 text-sm w-full text-gray-900"
                        id="grid-quantity" type="number" placeholder="Quantidade"
                        value="{{ $purchase->quantity ?? old('quantity') }}">
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
                        @if ($category->id == $purchase->category_id)
                            <option value="{{ $category->id }}" selected>{{ $category->category }}</option>
                        @else
                            <option value="{{ $category->id }}">{{ $category->category }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="w-full px-2" id="grid-project-dropdown">
                <label class="block uppercase tracking-wide text-white text-xs font-bold mb-2" for="grid-project-create">
                    Projeto
                </label>
                <select name="project_id"
                    class="border border-2 border-black rounded-lg px-2 py-2 mt-1 mb-4 text-sm w-full text-gray-900"
                    id="grid-project-create">
                    <option value="">Sem projeto</option>
                    @foreach ($projects as $project)
                        @if ($project->id == $purchase->project_id)
                            <option value="{{ $project->id }}" selected>
                                {{ str_replace('_', ' ', ucwords($project->project)) }}
                            </option>
                        @else
                            <option value="{{ $project->id }}">
                                {{ str_replace('_', ' ', ucwords($project->project)) }}
                            </option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="-mx-3 md:flex">
                <div class="w-full px-2 md:mb-0">
                    <label class="block uppercase tracking-wide text-white text-xs font-bold mb-2" for="grid-provider">
                        Fornecedor
                    </label>
                    <input name="provider"
                        class="border border-2 border-black rounded-lg px-2 py-2 mt-1 mb-4 text-sm w-full text-gray-900"
                        id="grid-provider" type="text" placeholder="Fornecedor"
                        value="{{ $purchase->provider ?? old('provider') }}">
                </div>
            </div>
            <div class="-mx-3 md:flex">
                <div class="w-full px-2 md:mb-0">
                    <label class="block uppercase tracking-wide text-white text-xs font-bold mb-2" for="grid-invoice-key">
                        Chave identificadora
                    </label>
                    <input name="invoice_key"
                        class="border border-2 border-black rounded-lg px-2 py-2 mt-1 mb-4 text-sm w-full text-gray-900"
                        id="grid-invoice-key" type="text" placeholder="Chave identificadora"
                        value="{{ $purchase->invoice_key ?? old('invoice_key') }}">
                </div>
            </div>
            <div class="flex place-items-end py-5">
                <button type="submit" class="focus:outline-none btn-submit text-sm py-2.5 px-5 rounded-full">
                    Fechar compra
                </button>
            </div>

    </form>
@endsection
