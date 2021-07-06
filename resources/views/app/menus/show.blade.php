@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('menus.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.menus.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.menus.inputs.code')</h5>
                    <span>{{ $menu->code ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.menus.inputs.article')</h5>
                    <span>{{ $menu->article ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.menus.inputs.description')</h5>
                    <span>{{ $menu->description ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.menus.inputs.price')</h5>
                    <span>{{ $menu->price ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('menus.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Menu::class)
                <a href="{{ route('menus.create') }}" class="btn btn-light">
                    <i class="ik ik-plus"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
