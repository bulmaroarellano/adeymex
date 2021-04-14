@extends('layouts/contentLayoutMaster')

@section('title', 'Envios')


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



    <div class="paquetes">
        <section id="basic-datatable">
            <div class="row">
            <!--    <a href="{{ route('paquetes.create') }}">
                    <button class="btn btn-primary my-1 ml-1">
                        Nuevo Envio
                    </button>
                </a>
            -->
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


    <div class="col-md-6 col-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Datos del Remitente</h4>
          </div>
          <div class="card-body">
            <form class="form form-horizontal">
              <div class="row">
                <div class="col-12">
                  <div class="form-group row">
                    <div class="col-sm-3 col-form-label">
                      <label for="nombre_remitente">Nombre</label>
                    </div>
                    <div class="col-sm-9">
                      <div class="input-group input-group-merge">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i data-feather="user"></i></span>
                        </div>
                        <input
                          type="text"
                          id="fname-icon"
                          class="form-control"
                          name="nombreRemitente"
                          placeholder="Nombre Completo"
                        />
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group row">
                    <div class="col-sm-3 col-form-label">
                      <label for="email-icon">Email</label>
                    </div>
                    <div class="col-sm-9">
                      <div class="input-group input-group-merge">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i data-feather="mail"></i></span>
                        </div>
                        <input
                          type="email"
                          id="email-icon"
                          class="form-control"
                          name="emailRemitente"
                          placeholder="Email"
                        />
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group row">
                    <div class="col-sm-3 col-form-label">
                      <label for="contact-icon">Teléfono</label>
                    </div>
                    <div class="col-sm-9">
                      <div class="input-group input-group-merge">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i data-feather="smartphone"></i></span>
                        </div>
                        <input
                          type="number"
                          id="telefonnoRemiotente"
                          class="form-control"
                          name="TelefonoRemitentew"
                          placeholder="Telefono"
                        />
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group row">
                    <div class="col-sm-3 col-form-label">
                      <label for="pass-icon">Password</label>
                    </div>
                    <div class="col-sm-9">
                      <div class="input-group input-group-merge">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i data-feather="lock"></i></span>
                        </div>
                        <input
                          type="password"
                          id="pass-icon"
                          class="form-control"
                          name="contact-icon"
                          placeholder="Password"
                        />
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-9 offset-sm-3">
                  <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input" id="customCheck2" />
                      <label class="custom-control-label" for="customCheck2">Remember me</label>
                    </div>
                  </div>
                </div>
                <div class="col-sm-9 offset-sm-3">
                  <button type="reset" class="btn btn-primary mr-1">Submit</button>
                  <button type="reset" class="btn btn-outline-secondary">Reset</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
@endsection

@section('vendor-script')

@endsection
