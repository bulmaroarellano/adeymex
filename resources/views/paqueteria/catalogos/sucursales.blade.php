@extends('layouts/contentLayoutMaster')

@section('title', 'Sucursales')

@section('vendor-style')
    {{-- vendor css files --}}
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap4.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap4.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap4.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/rowGroup.bootstrap4.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
@endsection
@section('content')

    <section class="sucursales">

        @include('paqueteria/components/sucursales_form')

        <div class="container mt-2">

            <div class="table-responsive">
                <table class="table mb-3">
                    <thead>
                        <tr>
                            <th scope="col">Sucursal</th>
                            <th scope="col">Dirección Completa</th>
                            <th scope="col">Telefono</th>
                            <th scope="col">Correo electrónico</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($sucursales as $sucursal)
                            <tr>
                                <td>{{ $sucursal->sucursal }}</td>
                                <td>{{ $sucursal->domicilio1 }}, C.P: {{ $sucursal->codigoPostal }},
                                    {{ $sucursal->pais }}
                                </td>
                                <td>{{ $sucursal->telefono }}</td>
                                <td>{{ $sucursal->email }}</td>

                                {{-- + Acciones --}}
                                <td class="d-flex">
                                    {{-- VER --}}
                                    <a href="{{ route('sucursales.show', [$sucursal, '0']) }}" class="btn"
                                        style="color: rgb(66, 66, 219);">
                                        <i class="far fa-eye"></i>
                                    </a>

                                    {{-- EDITAR --}}
                                    <a href="{{ route('sucursales.show', [$sucursal, '1']) }}" class="btn"
                                        style="color: rgb(66, 66, 219);">
                                        <i class="fas fa-pen-alt"></i>
                                    </a>

                                    <form action="{{ route('sucursales.destroy', $sucursal) }}" method="POST">
                                        {{-- BORRAR --}}
                                        @csrf
                                        @method('delete')
                                        <button class="btn " style="color: rgb(209, 3, 3);">
                                            <i class="far fa-trash-alt"></i>
                                        </button>

                                    </form>

                                </td>

                            </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>

            {{ $sucursales->links() }}

        </div>

    </section>



@endsection
@section('vendor-script')
    <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.bootstrap4.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap4.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.checkboxes.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.buttons.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/jszip.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/pdfmake.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/vfs_fonts.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.html5.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.print.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.rowGroup.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>


@endsection
