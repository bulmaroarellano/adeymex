@extends('layouts/contentLayoutMaster')
@section('title', 'Recepcion de Paquetes')

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
{!! Form::open([
    'route' => 'recepciones.store',
    'method' => 'POST',
    // 'id' => 'cotizar',
]) !!}
    <div class="col-md-12">
        <div class="row  justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"></div>
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-form-label  text-primary">Paqueteria*</label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group input-group-merge">

                                            {{ Form::select(
                                                'paqueteria',
                                                [
                                                    'FEDEX' => 'FEDEX',
                                                    'DHL' => 'DHL',
                                                    'UPS' => 'UPS',
                                                ],
                                                '',
                                                [
                                                    'placeholder' => 'Seleccionar',
                                                    'readonly' => session()->has('values') ? (session()->get('edit') == 1 ? false : true) : false,
                                                    'class' => 'paqueteria form-control ',
                                                ],
                                            ) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group ">
                                    <label class="col-form-label  text-primary">Horario de recepcion*</label>
                                    <div class="col-md-10">
                                        <input id="datetimepicker-recepcion" type="text" class="col-md-12">
                                        <input id="datetimepicker-recepcion-fecha" type="hidden" class="col-md-12"
                                            name="fecha_recepcion">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @include('paqueteria/envios/components/recepcion-paquetes')
                        </div>
                    </div>
                </div>
                <div class="row d-flex justify-content-sm-around mt-2">

                    <button type="submit" class="btn btn-success">
                        Agregar
                    </button>

                    <a href="{{ route('recepciones.create') }}">
                        <div class="btn btn-danger">
                            <i class="fas fa-ban mr-1"></i>
                            Cancelar
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
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
    {{-- Page js files --}}
    <script src="{{ asset(mix('js/scripts/envios/jquery.datetimepicker.full.min.js')) }}"></script>
    <script src="{{ asset(mix('js/scripts/envios/date-time-picker.js')) }}"></script>

    <script src="{{ asset(mix('js/scripts/envios/add-package.js')) }}"></script>
    <script src="{{ asset(mix('js/scripts/envios/date-time-picker.js')) }}"></script>


@endsection
