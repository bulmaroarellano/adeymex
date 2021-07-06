@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('events.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.events.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.events.inputs.customer_id')</h5>
                    <span>{{ optional($event->customer)->dni ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.events.inputs.guests_number')</h5>
                    <span>{{ $event->guests_number ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.events.inputs.date')</h5>
                    <span>{{ $event->date ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.events.inputs.start_our')</h5>
                    <span>{{ $event->start_our ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.events.inputs.start_end')</h5>
                    <span>{{ $event->start_end ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('events.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Event::class)
                <a href="{{ route('events.create') }}" class="btn btn-light">
                    <i class="ik ik-plus"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
