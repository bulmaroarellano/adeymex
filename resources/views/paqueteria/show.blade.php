@extends('layouts/contentLayoutMaster')

@section('title', 'Informacion de envio ')


@section('page-style')
    <link rel="stylesheet" href="{{ asset('css/base/pages/app-invoice-list.css') }}">
@endsection

@section('content')

    <div class="show-envio">
        <section id="basic-datatable">
            <div class="row">
                <div class="col-12">
                    <div class="card table-responsive">
                        <table class="datatables-basic table table-bordered">
                            <h2>Remitente</h2>
                            <thead>
                                {{-- ENCABEZADOS --}}
                                <tr>
                                    <th>id</th>
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
                                        <td>{{ $remitente->id }}</td>
                                        <td>{{ $remitente->nombre_remitente }}</td>
                                        <td>{{ $remitente->direccion_remitente }}</td>
                                        <td>{{ $remitente->ciudad_remitente }}</td>
                                        <td>{{ $remitente->telefono_remitente }}</td>
                                        <td>{{ $remitente->cp_remitente }}</td>
                                        <td>{{ $remitente->email_remitente }}</td>
                                        <td>{{ $remitente->peso_remitente }}</td>
                                        <td>{{ $remitente->largo_remitente }}</td>
                                        <td>{{ $remitente->ancho_remitente }}</td>
                                        <td>{{ $remitente->altura_remitente }}</td>

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
                                    <th>id</th>
                                    <th>Nombre</th>
                                    <th>Direccion</th>
                                    <th>Ciudad </th>
                                    <th>Telefono </th>
                                    <th>C.P</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                    <tr>
                                        <td>{{ $destinatario->id }}</td>
                                        <td>{{ $destinatario->nombre_destinatario }}</td>
                                        <td>{{ $destinatario->direccion_destinatario }}</td>
                                        <td>{{ $destinatario->ciudad_destinatario }}</td>
                                        <td>{{ $destinatario->telefono_destinatario }}</td>
                                        <td>{{ $destinatario->cp_destinatario }}</td>
                                    </tr>
                            </tbody>
                           
                        </table>
                    </div>
                    
                </div>
            </div>

        </section>
    </div>

@endsection

@section('vendor-script')

@endsection
