@extends('layout.index', ['title' => 'Funcionários'])

@section('content')
    <table class="overflow-x-auto w-full" id="table">
        <thead>
        <tr>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300">
                ID
            </th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300">
                Nome Completo
            </th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300">
                Cargo
            </th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300">
                Email
            </th>
        </tr>
        </thead>
        <tbody class="text-gray-600 divide-y divide-gray-300">
        @foreach ($employees as $employee)
            <tr class="bg-white font-medium divide-y divide-gray-200">
                <td class="p-4 whitespace-nowrap">
                    {{$employee->id}}
                </td>
                <td class="p-4 whitespace-nowrap">
                    {{ucwords($employee->firstname . ' ' . $employee->lastname, ' ')}}
                </td>
                <td class="p-4 whitespace-nowrap">
                    {{$employee->role->role}}
                </td>
                <td class="p-4 whitespace-nowrap">
                    {{$employee->email}}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <script>
        $(document).ready(function () {
            $('#table').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.10.22/i18n/Portuguese-Brasil.json'
                },
                responsive: true
            });
        });
    </script>
@endsection
