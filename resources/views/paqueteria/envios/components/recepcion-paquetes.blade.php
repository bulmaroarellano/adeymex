<div class="col-md-12" id="recepcion-paquetes">
    <div class="card">

        <div class="card-content ">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="col-md-2">No. Paquetes</th>
                                <th class="col-md-3">No. de Guia</th>
                                <th class="col-md-2">Precio</th>
                                <th>Observaciones</th>
                                <th>Acciones</th>
                            </tr>

                        </thead>
                        <tbody>
                            <tr>
                                {{-- B7946398707300430D size 18; 12 --}}
                                
                                <td><input class="form-control " type="text" name="cantidad_paquetes[]"  /></td>
                                <td><input class="form-control " type="text" name="numero_guia[]"  maxlength="18"/></td>
                                <td><input class="form-control " type="text" name="costo[]"   /></td>
                                <td><input class="form-control " type="text" name="observaciones[]"   /></td>
                                <td><button class="btn btn-danger" id="remove"><i class="fas fa-times-circle"></i></button></td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>

            <button class="btn btn-icon btn-success ml-2 mb-1" type="button" data-repeater-create id="add_recepcion">
                <i data-feather="plus" class="mr-25"></i>
                <span>Add New</span>
            </button>
        </div>

    </div>
</div>
