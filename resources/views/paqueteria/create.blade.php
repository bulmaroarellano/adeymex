@extends('layouts/contentLayoutMaster')

@section('title', 'Nuevo Envio')


@section('page-style')
    <link rel="stylesheet" href="{{ asset('css/base/pages/app-invoice-list.css') }}">
@endsection

@section('content')

    <div class="show-envio">
        <form action="{{route('paquetes.store')}}" method="POST">
            @csrf
            <section id="basic-datatable">
                <div class="row">
                    <div class="col-12">
                        <div class="card table-responsive">
                            <table class="table table-bordered table-striped table-condensed cf">
                                <h2>Remitente</h2>
                                <thead >
                                    {{-- ENCABEZADOS --}}
                                    <tr class="col-5">

                                        <th class="">Nombre</th>
                                        <th class="">Direccion</th>
                                        <th class="">Ciudad </th>
                                        <th class="">Telefono </th>
                                        <th class="">C.P</th>
                                        <th class="">Email</th>
                                        <th class="">Peso </th>
                                        <th class="">Largo </th>
                                        <th class="">Ancho </th>
                                        <th class="">Altura </th>
                                    </tr>
                                </thead>
                                <tbody class="">
                                    <tr >
                                        <td><input type="text" name="nombre_remitente"    value="{{ old('nombre_remitente') }}"></td>
                                        <td><input type="text" name="direccion_remitente" value="{{ old('direccion_remitente') }}"></td>
                                        <td><input type="text" name="ciudad_remitente"    value="{{ old('ciudad_remitente') }}"></td>
                                        <td><input type="tel"  name="telefono_remitente"  value="{{ old('telefono_remitente') }}"></td>
                                        <td><input type="text" name="cp_remitente"        value="{{ old('cp_remitente') }}"></td>
                                        <td><input type="text" name="email_remitente"     value="{{ old('email_remitente') }}"></td>
                                        <td><input type="text" name="peso_remitente"      value="{{ old('peso_remitente') }}"></td>
                                        <td><input type="text" name="largo_remitente"     value="{{ old('largo_remitente') }}"></td>
                                        <td><input type="text" name="ancho_remitente"     value="{{ old('ancho_remitente') }}"></td>
                                        <td><input type="text" name="altura_remitente"    value="{{ old('altura_remitente') }}"></td>

                                    </tr>
                                </tbody>

                            </table>
                        </div>

                    </div>
                </div>

            </section>

            <section id="basic-datatable">
                <div class="row">
                    <div class="col-12">
                        <div class="card table-responsive">
                            <table class="datatables-basic table table-bordered">
                                <h2>Destinatario</h2>
                                <thead>
                                    {{-- ENCABEZADOS --}}
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Direccion</th>
                                        <th>Ciudad </th>
                                        <th>Telefono </th>
                                        <th>C.P</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input type="text" name="nombre_destinatario"    value="{{ old('nombre_destinatario') }}"></td>
                                        <td><input type="text" name="direccion_destinatario" value="{{ old('direccion_destinatario') }}"></td>
                                        <td><input type="text" name="ciudad_destinatario"    value="{{ old('ciudad_destinatario') }}"></td>
                                        <td><input type="tel"  name="telefono_destinatario"  value="{{ old('telefono_destinatario') }}"></td>
                                        <td><input type="text" name="cp_destinatario"        value="{{ old('cp_destinatario') }}"></td>
                                    </tr>
                                </tbody>

                            </table>
                        </div>

                    </div>
                </div>

            </section>
            <button class="btn btn-primary" type="submit">
                Crear
            </button>
        </form>

    </div>

@endsection

@section('vendor-script')

@endsection
