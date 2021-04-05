@extends('layouts/contentLayoutMaster')

@section('title', 'Editar envio ')


@section('page-style')
    <link rel="stylesheet" href="{{ asset('css/base/pages/app-invoice-list.css') }}">
@endsection

@section('content')

    <div class="show-envio">
        <form action="{{route('paquetes.update', [$remitente, $destinatario, $envio])}}" method="POST">
            @csrf
            @method('put')

            <section id="basic-datatable">
                <div class="row">
                    <div class="col-12">
                        <div class="card table-responsive">
                            <table class="datatables-basic table table-bordered">
                                <h2>Remitente</h2>
                                <thead>
                                    {{-- ENCABEZADOS --}}
                                    <tr>

                                        <th>Nombre</th>
                                        <th>Direccion</th>
                                        <th>Ciudad </th>
                                        <th>Telefono </th>
                                        <th>C.P</th>
                                        <th>Email</th>
                                        <th>Peso </th>
                                        <th>Largo </th>
                                        <th>Ancho </th>
                                        <th>Altura </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input type="text" name="nombre_remitente"    value="{{ $remitente->nombre_remitente }}"></td>
                                        <td><input type="text" name="direccion_remitente" value="{{ $remitente->direccion_remitente }}"></td>
                                        <td><input type="text" name="ciudad_remitente"    value="{{ $remitente->ciudad_remitente }}"></td>
                                        <td><input type="tel"  name="telefono_remitente"  value="{{ $remitente->telefono_remitente }}"></td>
                                        <td><input type="text" name="cp_remitente"        value="{{ $remitente->cp_remitente }}"></td>
                                        <td><input type="text" name="email_remitente"     value="{{ $remitente->email_remitente }}"></td>
                                        <td><input type="text" name="peso_remitente"      value="{{ $remitente->peso_remitente }}"></td>
                                        <td><input type="text" name="largo_remitente"     value="{{ $remitente->largo_remitente }}"></td>
                                        <td><input type="text" name="ancho_remitente"     value="{{ $remitente->ancho_remitente }}"></td>
                                        <td><input type="text" name="altura_remitente"    value="{{ $remitente->altura_remitente }}"></td>

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
                                        <td><input type="text" name="nombre_destinatario"    value="{{ $destinatario->nombre_destinatario }}"></td>
                                        <td><input type="text" name="direccion_destinatario" value="{{ $destinatario->direccion_destinatario }}"></td>
                                        <td><input type="text" name="ciudad_destinatario"    value="{{ $destinatario->ciudad_destinatario }}"></td>
                                        <td><input type="tel"  name="telefono_destinatario"  value="{{ $destinatario->telefono_destinatario }}"></td>
                                        <td><input type="text" name="cp_destinatario"        value="{{ $destinatario->cp_destinatario }}"></td>
                                    </tr>
                                </tbody>

                            </table>
                        </div>

                    </div>
                </div>

            </section>
            <button class="btn btn-primary" type="submit">
                Actualizar Envio
            </button>
        </form>

    </div>

@endsection

@section('vendor-script')

@endsection
