@extends('layouts/contentLayoutMaster')

@section('title', 'Envios')


@section('page-style')
    <link rel="stylesheet" href="{{ asset('css/base/pages/app-invoice-list.css') }}">
@endsection

@section('content')

    <div class="paquetes">
        <section id="basic-datatable">
            <div class="row">
                <a href="{{ route('paquetes.create') }}">
                    <button class="btn btn-primary my-1 ml-1">
                        Nuevo Envio
                    </button>
                </a>
                <div class="col-12">
                    <div class="card table-responsive">
                        <table class="datatables-basic table table-bordered">
                            <thead>
                                {{-- ENCABEZADOS --}}
                                <tr>
                                    <th>id</th>
                                    <th>Nombre del remitente</th>
                                    <th>Destino</th>
                                    <th>Status </th>

                                    {{-- <th>C.P</th>
                                    <th>Email</th> --}}
                                    <th>Acciones</th>

                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($envios as $envio)
                                    <tr>
                                        <td>{{ $envio->id }}</td>
                                        <td>{{ $envio->nombre_remitente }}</td>
                                        <td>{{ $envio->ciudad_destinatario }}</td>
                                        <td>{{ $envio->status }}</td>
                                        {{-- + Acciones --}}
                                        <td class="d-flex">
                                            <div class="btn">
                                                <a href="{{ route('paquetes.show', $envio) }}" class=""
                                                    style="color: rgb(66, 66, 219);">
                                                    <i class="far fa-eye"></i>
                                                </a>
                                            </div>
                                            <div class="btn ">
                                                <a href="{{ route('paquetes.edit', $envio) }}" class=""
                                                    style="color: Dodgerblue;">
                                                    <i class="fas fa-marker"></i>
                                                </a>
                                            </div>
                                            <form action="{{ route('paquetes.destroy', $envio) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <button class="btn" type="submit">

                                                    <i class="far fa-trash-alt" style="color: tomato;"></i>

                                                </button>
                                            </form>
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
