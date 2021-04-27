@extends('layouts/contentLayoutMaster')

@section('title', 'Codigos Postales')

@section('vendor-style')
    {{-- vendor css files --}}
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap4.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap4.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap4.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/rowGroup.bootstrap4.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
@endsection
@section('content')

    <section class="codigosPostales">

        @include('paqueteria/components/codigosPostales_form')

        <div class="container mt-2">
        
            <div class="table-responsive">
                <table class="table mb-3">
                    <thead>
                        <tr>
                            <th scope="col">Codigo Postal</th>
                            <th scope="col">Dirección</th>
                            <th scope="col">Ciudad</th>
                            <th scope="col">Codigo Estado</th>
                            <th scope="col">Municipio</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                       
                        @foreach ($codigosPostales as $codigoPostal)
                            <tr>
                                <td>{{ $codigoPostal->codigoPostal }}</td>
                                <td>{{ $codigoPostal->direccion }}</td>
                                <td>{{ $codigoPostal->ciudad }}</td>
                                <td>{{ $codigoPostal->codigoEstado }}</td>
                                <td>{{ $codigoPostal->municipio }}</td>
                                
                                
                                {{-- + Acciones --}}
                                <td class="d-flex">
                                    {{-- VER --}}
                                    <a href="{{ route('codigosPostales.show', [$codigoPostal, '0']) }}" class="btn"
                                        style="color: rgb(66, 66, 219);">
                                        <i class="far fa-eye"></i>
                                    </a>

                                    {{-- EDITAR --}}
                                    <a href="{{ route('codigosPostales.show', [$codigoPostal, '1']) }}" class="btn"
                                        style="color: rgb(66, 66, 219);">
                                        <i class="fas fa-pen-alt"></i>
                                    </a>

                                    <form action="{{ route('codigosPostales.destroy', $codigoPostal) }}" method="POST">
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

            {{ $codigosPostales->links() }}

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