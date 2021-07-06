@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('customers.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.customers.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.customers.inputs.dni')</h5>
                    <span>{{ $customer->dni ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.customers.inputs.fiscal_code')</h5>
                    <span>{{ $customer->fiscal_code ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.customers.inputs.firstname')</h5>
                    <span>{{ $customer->firstname ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.customers.inputs.lastname')</h5>
                    <span>{{ $customer->lastname ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.customers.inputs.telephone')</h5>
                    <span>{{ $customer->telephone ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.customers.inputs.email')</h5>
                    <span>{{ $customer->email ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.customers.inputs.company_name')</h5>
                    <span>{{ $customer->company_name ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('customers.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Customer::class)
                <a href="{{ route('customers.create') }}" class="btn btn-light">
                    <i class="ik ik-plus"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection


git clone

git
checkout -b bulmaro
nano readme.md
git add a

git commit .m
subir rama

create pull request
create pull request
solocitar ok
autoriza


actualizar master

git pull

git checkout pepito
git merge master


1.- Clonar
2.- crear branch
3.- editar archivo
4.- add -A, luego commit, luego push
En GitHub hacer pull request
6.- luego regresar all repositorio local, en master hacer pull
ir a branch y hacer merge de master
Y de nuevo desde el paso 3
