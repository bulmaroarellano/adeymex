

<div class="toast" data-autohide="false" style="position: absolute; top: -60px; right: 40%;">
    <div class="toast-header">
        <strong class="mr-auto">Completar el formulario: </strong>
        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="toast-body">
        @foreach ($errors->all() as $error)
                <small class="alert-danger">{{ $error }}</small> <br>
        @endforeach
    </div>
</div>

<script src="{{ asset(mix('vendors/js/jquery/jquery.min.js')) }}"></script>
<script>
    $(function() {
        $('.toast').toast('show')
    });
</script>
