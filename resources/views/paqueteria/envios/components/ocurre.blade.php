

<div class="col-md-6">
    <div class="form-group">
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
            <label class="form-check-label" for="inlineCheckbox1">
                Habilitar Ocurre
            </label>
          </div>
    </div>
    {{-- ! OCURRE  --}}
    <div class="form-group">
        <div class="input-group input-group-merge">
            <div class="input-group input-group-merge">
                {{ Form::select('ocurre',  session()->has('values') ? [] : [], 
                session()->has('values') ?  [] : [],[
                   'placeholder' => '',
                   'readonly' => session()->has('values')
                       ? (session()->get('edit') == 1 ? false : true )
                       : false,
                   'class' => 'ocurre-search form-control  col-sm-12'
                ])}}
            </div>
        </div>
    </div>
</div>

<div class="col-md-2 d-flex align-items-center mt-1">
   
    <label for="ocurre" class="btn btn-success">
        <i class="fas fa-search"></i>
        <input id="ocurre" type="submit" value="false" class="hidden" name="cotizar[]"/>
    </label>
</div>



