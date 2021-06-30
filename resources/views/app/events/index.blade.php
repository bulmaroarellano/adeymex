@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <div style="display: flex; justify-content: space-between;">
                <h4 class="card-title">@lang('crud.events.index_title')</h4>
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
                        @can('create', App\Models\Event::class)
                        <a
                            href="{{ route('events.create') }}"
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
                            <th class="text-left">
                                @lang('crud.events.inputs.customer_id')
                            </th>
                            <th class="text-right">
                                @lang('crud.events.inputs.guests_number')
                            </th>
                            <th class="text-left">
                                @lang('crud.events.inputs.date')
                            </th>
                            <th class="text-left">
                                @lang('crud.events.inputs.start_our')
                            </th>
                            <th class="text-left">
                                @lang('crud.events.inputs.start_end')
                            </th>
                            <th class="text-center">
                                @lang('crud.common.actions')
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($events as $event)
                        <tr>
                            <td>
                                {{ optional($event->customer)->dni ?? '-' }}
                            </td>
                            <td>{{ $event->guests_number ?? '-' }}</td>
                            <td>{{ $event->date ?? '-' }}</td>
                            <td>{{ $event->start_our ?? '-' }}</td>
                            <td>{{ $event->start_end ?? '-' }}</td>
                            <td class="text-center" style="width: 134px;">
                                <div
                                    role="group"
                                    aria-label="Row Actions"
                                    class="btn-group"
                                >
                                    @can('update', $event)
                                    <a
                                        href="{{ route('events.edit', $event) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >
                                            <i class="icon ik ik-edit-2 f-16 mr-15 text-green"></i>
                                        </button>
                                    </a>
                                    @endcan @can('view', $event)
                                    <a
                                        href="{{ route('events.show', $event) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >
                                            <i class="icon ion-md-eye"></i>
                                        </button>
                                    </a>
                                    @endcan @can('delete', $event)
                                    <form
                                        action="{{ route('events.destroy', $event) }}"
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
                            <td colspan="6">{!! $events->render() !!}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
