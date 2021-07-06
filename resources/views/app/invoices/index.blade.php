@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <div style="display: flex; justify-content: space-between;">
                <h4 class="card-title">@lang('crud.invoices.index_title')</h4>
            </div>

            <div class="searchbar mt-4 mb-5">
                <div class="row">
                    <div class="col-md-6">
                        <form>
                            <div class="input-group">
                                <input
                                    id="indexSearch"
                                    type="text"
                                    name="search"
                                    placeholder="{{ __('crud.common.search') }}"
                                    value="{{ $search ?? '' }}"
                                    class="form-control"
                                    autocomplete="off"
                                />
                                <div class="input-group-append">
                                    <button
                                        type="submit"
                                        class="btn btn-primary"
                                    >
                                        <i class="ik ik-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6 text-right">
                        @can('create', App\Models\Invoice::class)
                        <a
                            href="{{ route('invoices.create') }}"
                            class="btn btn-primary"
                        >
                            <i class="ik ik-plus"></i>
                            @lang('crud.common.create')
                        </a>
                        @endcan
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-borderless table-hover">
                    <thead>
                        <tr>
                            <th class="text-right">
                                @lang('crud.invoices.inputs.amount')
                            </th>
                            <th class="text-left">
                                @lang('crud.invoices.inputs.due_at')
                            </th>
                            <th class="text-left">
                                @lang('crud.invoices.inputs.paid_at')
                            </th>
                            <th class="text-left">
                                @lang('crud.invoices.inputs.customer_id')
                            </th>
                            <th class="text-left">
                                @lang('crud.invoices.inputs.event_id')
                            </th>
                            <th class="text-center">
                                @lang('crud.common.actions')
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($invoices as $invoice)
                        <tr>
                            <td>{{ $invoice->amount ?? '-' }}</td>
                            <td>{{ $invoice->due_at ?? '-' }}</td>
                            <td>{{ $invoice->paid_at ?? '-' }}</td>
                            <td>
                                {{ optional($invoice->customers)->dni ?? '-' }}
                            </td>
                            <td>{{ optional($invoice->event)->id ?? '-' }}</td>
                            <td class="text-center" style="width: 134px;">
                                <div
                                    role="group"
                                    aria-label="Row Actions"
                                    class="btn-group"
                                >
                                    @can('update', $invoice)
                                    <a
                                        href="{{ route('invoices.edit', $invoice) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >
                                            <i class="icon ik ik-edit-2 f-16 mr-15 text-green"></i>
                                        </button>
                                    </a>
                                    @endcan @can('view', $invoice)
                                    <a
                                        href="{{ route('invoices.show', $invoice) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >
                                            <i class="icon ion-md-eye"></i>
                                        </button>
                                    </a>
                                    @endcan @can('delete', $invoice)
                                    <form
                                        action="{{ route('invoices.destroy', $invoice) }}"
                                        method="POST"
                                        onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')"
                                    >
                                        @csrf @method('DELETE')
                                        <button
                                            type="submit"
                                            class="btn btn-light text-danger"
                                        >
                                            <i class="ik ik-trash-2 f-16 text-red"></i>
                                        </button>
                                    </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6">
                                @lang('crud.common.no_items_found')
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="6">{!! $invoices->render() !!}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
