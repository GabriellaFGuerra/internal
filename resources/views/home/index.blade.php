@extends('layout.index', ['title' => 'Home'])

@section('content')
    <!-- component -->
    <!DOCTYPE html>
    <div class="flex flex-wrap justify-items-center grid md:grid-cols-2 lg:grid-cols-3 gap-0">
        <div class="max-w-md py-4 px-8 bg-white shadow-lg rounded-lg my-5 md:my-10">
            <div>
                <h2 class="text-gray-800 text-3xl font-semibold">Compras</h2>
                <p>Pedidos e compras de materiais/equipamentos para as obras</p>
            </div>
            <div class="flex justify-end mt-4">
                <a href="{{route('purchases')}}" class="text-xl font-medium text-indigo-500">Acessar</a>
            </div>
        </div>

        <div class="max-w-md py-4 px-8 bg-white shadow-lg rounded-lg my-5 md:my-10">
            <div>
                <h2 class="text-gray-800 text-3xl font-semibold">Documentos</h2>
                <p>Documentos e protocolos relacionados a projetos e outras situações</p>
            </div>
            <div class="flex justify-end mt-4">
                <a href="{{route('documents')}}" class="text-xl font-medium text-indigo-500">Acessar</a>
            </div>
        </div>
        <div class="max-w-md py-4 px-8 bg-white shadow-lg rounded-lg my-5 md:my-10">
            <div>
                <h2 class="text-gray-800 text-3xl font-semibold">Estoque</h2>
                <p>Controle de materiais/equipamentos guardados e retirados</p>
            </div>
            <div class="flex justify-end mt-4">
                <a href="{{route('stock')}}" class="text-xl font-medium text-indigo-500">Acessar</a>
            </div>
        </div>
        <div class="max-w-md py-4 px-8 bg-white shadow-lg rounded-lg my-5 md:my-10">
            <div>
                <h2 class="text-gray-800 text-3xl font-semibold">Funcionários</h2>
                <p>Gerenciamento de funcionários em todos os setores</p>
            </div>
            <div class="flex justify-end mt-4">
                <a href="{{route('employees')}}" class="text-xl font-medium text-indigo-500">Acessar</a>
            </div>
        </div>
        <div class="max-w-md py-4 px-8 bg-white shadow-lg rounded-lg my-5 md:my-10">
            <div>
                <h2 class="text-gray-800 text-3xl font-semibold">Plantas</h2>
                <p>Imagens e plantas relacionadas aos projetos separadas por categoria</p>
            </div>
            <div class="flex justify-end mt-4">
                <a href="{{route('blueprints')}}" class="text-xl font-medium text-indigo-500">Acessar</a>
            </div>
        </div>
        <div class="max-w-md py-4 px-8 bg-white shadow-lg rounded-lg my-5 md:my-10">
            <div>
                <h2 class="text-gray-800 text-3xl font-semibold">Projetos</h2>
                <p>Diário de obras e outros dados relacionados aos projetos</p>
            </div>
            <div class="flex justify-end mt-4">
                <a href="{{route('projects')}}" class="text-xl font-medium text-indigo-500">Acessar</a>
            </div>
        </div>
    </div>
@endsection
