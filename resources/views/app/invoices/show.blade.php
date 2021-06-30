@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('invoices.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.invoices.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.invoices.inputs.amount')</h5>
                    <span>{{ $invoice->amount ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.invoices.inputs.due_at')</h5>
                    <span>{{ $invoice->due_at ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.invoices.inputs.paid_at')</h5>
                    <span>{{ $invoice->paid_at ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.invoices.inputs.customer_id')</h5>
                    <span>{{ optional($invoice->customers)->dni ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.invoices.inputs.event_id')</h5>
                    <span>{{ optional($invoice->event)->id ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('invoices.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Invoice::class)
                <a href="{{ route('invoices.create') }}" class="btn btn-light">
                    <i class="ik ik-plus"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
