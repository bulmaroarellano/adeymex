@extends('layouts/contentLayoutMaster')

@section('title', 'Caja')

@section('vendor-style')
    {{-- Vendor Css files --}}
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/charts/apexcharts.css')) }}">
@endsection
@section('page-style')
    {{-- Page Css files --}}
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/charts/chart-apex.css')) }}">
@endsection

@section('content')
    <!-- Statistics card section -->
    <section id="statistics-card">
        <!-- Miscellaneous Charts -->
        <div class="row match-height justify-content-center">

            <!--/ Line Chart -->
            <div class="col-md-11 col-12">
                <div class="card card-statistics">

                    <div class="card-header">
                        {{-- <h4 class="card-title">Statistics</h4> --}}
                        <div class="d-flex justify-content-end  w-100">
                            {{-- ! ULTIMA ACTULIZACION --}}
                            <p class="card-text ">Updated 1 month ago</p>
                        </div>
                    </div>

                    <div class="card-body statistics-body">
                        <div class="row ">
                            <div class="col-md-3 col-sm-6 col-12 mb-2 mb-md-0">
                                <div class="media">
                                    <div class="avatar bg-light-success mr-2">
                                        <div class="avatar-content">
                                            <i data-feather="dollar-sign" class="avatar-icon"></i>
                                        </div>
                                    </div>
                                    <div class="media-body my-auto">
                                        <h4 class="font-weight-bolder mb-0">${{$dinero_efectivo}}</h4>
                                        <p class="card-text font-small-3 mb-0">Dinero en Efectivo</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-12 mb-2 mb-md-0">
                                <div class="media">
                                    <div class="avatar bg-light-info mr-2">
                                        <div class="avatar-content">
                                            <i data-feather="cast" class="avatar-icon"></i>
                                        </div>
                                    </div>
                                    <div class="media-body my-auto">
                                        <h4 class="font-weight-bolder mb-0">${{$dinero_tranferencia}}</h4>
                                        <p class="card-text font-small-3 mb-0">Transferencias Bancaria </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-12 mb-2 mb-sm-0">
                                <div class="media">
                                    <div class="avatar bg-light-info mr-2">
                                        <div class="avatar-content">
                                            <i data-feather="credit-card" class="avatar-icon"></i>
                                        </div>
                                    </div>
                                    <div class="media-body my-auto">
                                        <h4 class="font-weight-bolder mb-0">${{$dinero_tarjeta_debito}}</h4>
                                        <p class="card-text font-small-3 mb-0">Tarjeta de Debito</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-12 mb-2 mb-sm-0">
                                <div class="media">
                                    <div class="avatar bg-light-info mr-2">
                                        <div class="avatar-content">
                                            <i data-feather="credit-card" class="avatar-icon"></i>
                                        </div>
                                    </div>
                                    <div class="media-body my-auto">
                                        <h4 class="font-weight-bolder mb-0">${{$dinero_tarjeta_credito}}</h4>
                                        <p class="card-text font-small-3 mb-0">Tarjeta de Credito</p>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="row d-flex justify-content-center mt-3">

                            <div class="col-md-3 col-sm-6 col-12">
                                <div class="media">
                                    <div class="avatar bg-light-success mr-2">
                                        <div class="avatar-content">
                                            <i data-feather="dollar-sign" class="avatar-icon"></i>
                                        </div>
                                    </div>
                                    <div class="media-body my-auto">
                                        <h4 class="font-weight-bolder mb-0">{{$total}}</h4>
                                        <p class="card-text font-small-3 mb-0">Total </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 col-sm-6 col-12 mb-2 mb-sm-0">
                                <div class="media">
                                    <a href="{{route('gastos.create')}}">
                                        <div class="avatar bg-light-danger mr-2">
                                            <div class="avatar-content">
                                                <i data-feather="box" class="avatar-icon"></i>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="media-body my-auto">
                                        
                                        <h5 class="card-text font-small-3 mb-0 font-weight-bolder ">Ingresar Gastos</h5>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!--/ Statistics Card section-->
@endsection

@section('vendor-script')
    {{-- Vendor js files --}}

@endsection
@section('page-script')
    {{-- Page js files --}}

@endsection
