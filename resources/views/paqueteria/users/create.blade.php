@extends('layouts/contentLayoutMaster')
@section('title', 'Add User')
@section('content')
    <!-- push external head elements to head -->
    @push('head')
    
        <link rel="stylesheet" href="{{ asset('plugins/select2/dist/css/select2.min.css') }}">
    @endpush


    <div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('users.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.users.create_title')
            </h4>

            <x-form
                method="POST"
                action="{{ route('users.store') }}"
                class="mt-4"
            >
                @include('paqueteria.users.form-inputs')

                <div class="mt-4">
                    <a href="{{ route('users.index') }}" class="btn btn-light">
                        <i class="icon ion-md-return-left text-primary"></i>
                        @lang('crud.common.back')
                    </a>

                    <button type="submit" class="btn btn-primary float-right">
                        <i class="icon ion-md-save"></i>
                        @lang('crud.common.create')
                    </button>
                </div>
            </x-form>
        </div>
    </div>
</div>
@endsection
