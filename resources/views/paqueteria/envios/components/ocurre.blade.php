<div class="col-md-6 mt-1">
    <div class="form-group">
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="inlineCheckbox1"
                onchange="document.getElementById('ocurre').disabled = !this.checked;"
            >
            <label class="form-check-label" for="inlineCheckbox1">
                Buscar Ocurre
            </label>
        </div>
        <button for="ocurre" class="btn btn-success" id="ocurre" disabled>
            <i class="fas fa-search"></i>
            <input id="ocurre" type="submit" value="false" class="hidden" name="cotizar[]"/>
        </button>
    </div>
    
</div>
