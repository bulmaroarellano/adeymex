@extends('layouts/contentLayoutMaster')
@section('title', 'Usuarios')
@section('content')
<!-- push external head elements to head -->


@section('vendor-style')
<link rel="stylesheet" href="{{ asset('vendors/css/extensions/toastr.min.css') }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap4.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap4.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap4.min.css')) }}">

@endsection
@section('page-style')


@endsection

@section('content' )

<section id="basic-table">
    <div class="row">
        <div class="col-12">
            <!-- start message area-->
            @include('include.message')
            <!-- end message area-->

            <div class="card">
                <div class="card-header">

                </div>
                <div class="card-body">

                    <table id="dtBasicExample" class="table table-striped table-bordered table-lg" cellspacing="0"
                        width="100%">
                        <thead>
                            <tr>
                                <th class="text-left">
                                    @lang('crud.users.inputs.name')
                                </th>
                                <th class="text-left">
                                    @lang('crud.users.inputs.email')
                                </th>
                                <th class="text-center">
                                    @lang('crud.common.actions')
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                            <tr>
                                <td>{{ $user->name ?? '-' }}</td>
                                <td>{{ $user->email ?? '-' }}</td>
                                <td class="text-center">
                                    <div role="group" aria-label="Row Actions" class="btn-group"
                                        style="display: flex;justify-content: space-around;">
                                        @can('update', $user)
                                        <a href="{{ route('users.edit', $user) }}">
                                            <i data-feather='edit'></i></a>
                                        @endcan
                                        @can('view', $user)
                                        <a href="{{ route('users.show', $user) }}">
                                            <i data-feather='eye'></i>

                                        </a>
                                        @endcan


                                        @can('delete', $user)
                                        <form action="{{ route('users.destroy', $user) }}" method="POST"
                                            onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')">
                                            @csrf @method('DELETE')


                                            <i class="text-danger" data-feather='x-circle'></i>
                                        </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3">
                                    @lang('crud.common.no_items_found')
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @can('create', App\Models\User::class)

            <div class="card-footer white  d-flex justify-content-between">
                <!-- {{-- <button class="btn btn-primary btn-md px-3 my-0 mr-0"> -->
                <!-- Agregar nuevo -->
                <!-- </button> --}} -->
                <a href="{{ route('users.create') }}">
                    <div class="btn btn-primary">
                        <span>Agregar Nuevo </span>
                    </div>
                </a>
            </div>
            @endcan
        </div>
    </div>
</section>
@endsection
@section('vendor-script')
<script src="{{ asset('vendors/js/extensions/toastr.min.js') }}"></script>


<script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/datatables.bootstrap4.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap4.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/datatables.buttons.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/buttons.bootstrap4.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
@endsection

@section('page-script')
<script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>

<script>
$(document).ready(function() {
    $('#dtBasicExample').DataTable({
        "paging": true,
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ] // false to disable pagination (or any other option)
    });
    $('.dataTables_length').addClass('bs-select');
});
</script>@endsection