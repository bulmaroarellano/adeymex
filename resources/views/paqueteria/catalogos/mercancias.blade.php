@extends('layouts/contentLayoutMaster')

@section('title', 'Mercancias ')

@section('vendor-style')
    {{-- vendor css files --}}
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap4.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap4.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap4.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/rowGroup.bootstrap4.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
@endsection
@section('content')

    <section class="mercancias">

        @include('paqueteria/components/mercancias_form')

        <div class="container mt-2">
        
            <div class="table-responsive">
                <table class="table mb-3">
                    <thead>
                        <tr>
                            <th scope="col">Producto</th>
                            <th scope="col">Producto en Ingles</th>
                            <th scope="col">Clave Internacional</th>
                            <th scope="col">Costo</th>
                            <th scope="col">Moneda</th>
                            {{-- <th scope="col">Medida</th> --}}
                            <th scope="col">Unidad de Medida</th>
                            {{-- <th scope="col">País</th> --}}
                            <th scope="col">Peso</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                       
                        @foreach ($mercancias as $mercancia)
                            <tr>
                                <td>{{ $mercancia->producto }}</td>
                                <td>{{ $mercancia->productoIngles }}</td>
                                <td>{{ $mercancia->claveInternacional }}</td>
                                <td>{{ $mercancia->costo }}</td>
                                <td>{{ $mercancia->moneda }}</td>
                                {{-- <td>{{ $mercancia->medida }}</td> --}}
                                <td>{{ $mercancia->unidadMedida }}</td>
                                {{-- <td>{{ $mercancia->pais }}</td> --}}
                                <td>{{ $mercancia->peso }}</td>
                                
                                {{-- + Acciones --}}
                                <td class="d-flex">
                                    {{-- VER --}}
                                    <a href="{{ route('mercancias.show', [$mercancia, '0']) }}" class="btn"
                                        style="color: rgb(66, 66, 219);">
                                        <i class="far fa-eye"></i>
                                    </a>

                                    {{-- EDITAR --}}
                                    <a href="{{ route('mercancias.show', [$mercancia, '1']) }}" class="btn"
                                        style="color: rgb(66, 66, 219);">
                                        <i class="fas fa-pen-alt"></i>
                                    </a>

                                    <form action="{{ route('mercancias.destroy', $mercancia) }}" method="POST">
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

            {{ $mercancias->links() }}

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
