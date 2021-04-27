<div class="form-group{{ $has_error ? ' has-error' : '' }}">
    <label for="{{ $id }}">{{ $label }}</label>
    <textarea name="{{ $name }}" id="{{ $id }}" class="form-control" style="max-width: 100%;"  placeholder="{{ $placeholder }}">{!! $old or $value !!}</textarea>
    @include('crud::fields.partials.help')
    @include('crud::fields.partials.errors')
</div>
