@extends('layouts/contentLayoutMaster')

@section('title', 'Envios')


@section('page-style')
    <link rel="stylesheet" href="{{ asset('css/base/pages/app-invoice-list.css') }}">
@endsection

@section('content')

    <div class="paquetes">
        <section id="basic-datatable">
            <div class="row">
                <div class="col-12">
                    <div class="card table-responsive">
                        <table class="datatables-basic table table-bordered">
                            <thead>
                                {{-- ENCABEZADOS --}}
                                <tr>
                                    <th>id</th>
                                    <th>Nombre</th>
                                    <th>Destino</th>
                                    
                                    {{-- <th>C.P</th>
                                    <th>Email</th> --}}
                                    <th>Acciones</th>

                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($envios as $envio)
                                    <tr>
                                        <td>{{ $envio->id }}</td>
                                        <td>{{ $envio->nombre }}</td>
                                        <td>{{ $envio->destino }}</td>
                                        {{-- <td>{{ $remitente->ciudad }}</td>
                                        <td>{{ $remitente->cp }}</td>
                                        <td>{{ $remitente->email }}</td> --}}

                                        <td class="d-flex">
                                            <div class="btn ">
                                                <a href="" class="" style="color: rgb(66, 66, 219);">
                                                    <i class="far fa-eye"></i>
                                                </a>
                                            </div>
                                            <div class="btn ">
                                                <a href="" class="" style="color: Dodgerblue;">
                                                    <i class="fas fa-marker"></i>
                                                </a>
                                            </div>
                                            <div class= "btn">
                                                <a href="" class="" style="color: tomato;">
                                                    <i class="far fa-trash-alt"></i>
                                                </a>
                                            </div>
                                        </td>

                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    {{ $envios->links() }}
                </div>
            </div>

        </section>
    </div>

@endsection

@section('vendor-script')

@endsection
