@extends('layouts/contentLayoutMaster')
@section('title', 'Show')

@section('vendor-style')
    {{-- vendor css files --}}
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap4.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap4.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap4.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/rowGroup.bootstrap4.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')



    <div class="col-md-12">
        <div class="row">
            <div class="col-md-8">
                {{-- DIRECCION --}}
                <section id="card-navigation">
                    {{-- <h5 class="">Navigation</h5> --}}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card text-center">
                                <div class="card-header py-2">
                                    <ul class="nav nav-pills card-header-pills ml-0" id="pills-tab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="dir-tab" data-toggle="pill" href="#dir"
                                                role="tab" aria-controls="pills-home" aria-selected="true">Direcciones</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="paqueteria-tab" data-toggle="pill" href="#paqueteria"
                                                role="tab" aria-controls="paqueteria" aria-selected="false">Paquetes</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="suministros-tab" data-toggle="pill" href="#suministros"
                                                role="tab" aria-controls="suministros" aria-selected="false">Suministros</a>
                                        </li>

                                    </ul>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content" id="pills-tabContent">
                                        <div class="tab-pane fade show active" id="dir" role="tabpanel"
                                            aria-labelledby="dir-tab">
                                            <h5>Direccion Envio </h5>
                                        </div>
                                        <div class="tab-pane fade" id="paqueteria" role="tabpanel"
                                            aria-labelledby="paqueteria-tab">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Numero Guia</th>
                                                            <th>Largo</th>
                                                            <th>Ancho</th>
                                                            <th>Alto</th>
                                                            <th>Peso</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>{{ $masterGuia }}</td>
                                                            <td>{{ $masterPaquete->largo_paquete }}</td>
                                                            <td>{{ $masterPaquete->ancho_paquete }}</td>
                                                            <td>{{ $masterPaquete->alto_paquete }}</td>
                                                            <td>{{ $masterPaquete->peso_paquete }}</td>
                                                        </tr>

                                                        <tr>
                                                            @foreach ($slavePaquetes as $paquete)
                                                                <td>{{ $paquete['largo_paquete'] }}</td>
                                                                <td>{{ $paquete['ancho_paquete'] }}</td>
                                                                <td>{{ $paquete['alto_paquete'] }}</td>
                                                                <td>{{ $paquete['peso_paquete'] }}</td>
                                                            @endforeach
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="suministros" role="tabpanel"
                                            aria-labelledby="suministros-tab">
                                            <h4>Suministros</h4>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="col-md-4">
                <div class="row">
                    <div class="col-md-12 ">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Descargas</h4>
                                <div class="d-flex justify-content-between">

                                    <div class="d-flex flex-column ">
                                        @if ($fda)
                                            <a href="{{asset($fda->url_fda)}}" download>
                                                <button class="btn btn-secondary">
                                                    FDA
                                                    <i class="fas fa-file-pdf fa-lg"></i>
                                                </button>
                                            </a>
                                        @endif
    
                                        <a href="{{asset($ticket->url_ticket)}}" download>
                                            <button class="btn btn-danger mt-2">
                                                Ticket
                                                <i class="fas fa-file-pdf fa-lg"></i>
                                            </button>
                                        </a>
                                    </div>


                                    <div class="d-flex flex-column ">
                                        <a href="{{ asset($urlMasterGuia) }}" download>
                                            <button class="btn btn-danger mb-2">
                                                Guia Envio
                                                <i class="fas fa-file-pdf fa-lg"></i>
                                            </button>
                                        </a>
    
                                        @if ($invoice)
                                            <a href="{{ asset($invoice->url_invoice_guia) }}" download>
                                                <button class="btn btn-danger  ">
                                                    Commercial-Invoice
                                                    <i class="fas fa-file-pdf fa-lg"></i>
                                                </button>
                                            </a>
                                        @endif
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-5">
                {{-- PAGOS --}}
                <div class="card">
                    <h4 class="card-header">Costos</h4>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                    
                                    <tr>
                                        <td>Metodo de Pago</td>
                                        <td>{{$pago->metodo_pago}}</td>
                                    </tr>
                                    <tr>
                                        <td>Referencia de Pago</td>
                                        <td>{{$pago->referencia_pago ?? ''}}</td>
                                    </tr>
                                    <tr>
                                        <td>Costo envio</td>
                                        <td>$ {{$pago->costo_sucursal_envio ?? ''}}</td>
                                    </tr>
                                    <tr>
                                        <td>Cargos</td>
                                        <td>$ {{$pago->cargos_envio ?? ''}}</td>
                                    </tr>
                                    <tr>
                                        <td>Impuestos</td>
                                        <td>$  {{$pago->impuestos_envio ?? ''}}</td>
                                    </tr>
                                    <tr>
                                        <td>Cargos Logistica </td>
                                        <td>$  {{$pago->cargo_logistica_interna ?? ''}}</td>
                                    </tr>
                                    <tr>
                                        <td>Suministros </td>
                                        <td>$ {{$pago->suministros_precio_total ?? ''}}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-danger">Total </td>
                                        <td>$ {{$pago->precio_total_sucursal ?? ''}}</td>
                                    </tr>
    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>




    </div>

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

@section('page-script')
@endsection
