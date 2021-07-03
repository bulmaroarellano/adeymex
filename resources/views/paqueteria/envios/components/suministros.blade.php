<div class="col-md-8 " id="suministros-envio" style="display: none">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Suministros</h4>
            <div class="heading-elements">
                <ul class="list-inline mb-0">
                    <li>
                        <a data-action="collapse"><i data-feather="chevron-down"></i></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="card-content collapse ">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <th>Suministro</th>
                            <th>Cantidad</th>
                            <th>Unitario</th>
                            <th>Total</th>
                            <th>Acciones</th>

                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
            {{-- <button class="btn btn-success" id="add_suministro"><i class="fas fa-plus-circle"></i></button> --}}
            <button class="btn btn-icon btn-success ml-2 mb-1" type="button" data-repeater-create id="add_suministro">
                <i data-feather="plus" class="mr-25"></i>
                <span>Add New</span>
            </button>
        </div>

    </div>
</div>
