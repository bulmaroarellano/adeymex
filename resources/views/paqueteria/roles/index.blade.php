@extends('layouts/contentLayoutMaster')
@section('title', 'Roles')

@section('vendor-style')
    {{-- vendor css files --}}
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap4.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap4.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap4.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/rowGroup.bootstrap4.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')


    
    <div class="container-fluid">
    	<div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-award bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('Roles')}}</h5>
                            <span>{{ __('Define roles of user')}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="../index.html"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">{{ __('Roles')}}</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row clearfix">
	        <!-- start message area-->
            @include('include.message')
            <!-- end message area-->
            <!-- only those have manage_role permission will get access -->
            @can('manage_role')
			<div class="col-md-12">
	            <div class="card">
	                <div class="card-header"><h3>{{ __('Add Role')}}</h3></div>
	                <div class="card-body">
						{{-- CAMBIE EL METODO PORQUE "POST" no existe en esta ruta --}}
	                    <form class="forms-sample" method="GET" action="{{url('roles/create')}}">
	                    	@csrf
	                        <div class="row">
	                            <div class="col-sm-5">
	                                <div class="form-group">
	                                    <label for="role">{{ __('Role')}}<span class="text-red">*</span></label>
	                                    <input type="text" class="form-control is-valid" id="role" name="role" placeholder="Role Name" required>
	                                </div>
	                            </div>
	                            <div class="col-sm-7">
	                                <label for="exampleInputEmail3">{{ __('Assign Permission')}} </label>
	                                <div class="row">
	                                	@foreach($permissions as $key => $permission)
	                                	<div class="col-sm-4">
                                            <label class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="item_checkbox" name="permissions[]" value="{{$key}}">
                                                <span class="custom-control-label">
                                                	<!-- clean unescaped data is to avoid potential XSS risk -->
														{{-- Tuve que comentar esta linea porque me sa un error --}}
                                                	{{-- {{ clean($permission,'titles')}} --}}
                                                </span>
                                            </label>
	                                		
	                                	</div>
	                                	@endforeach 
	                                </div>
	                                
	                                <div class="form-group">
	                                	<button type="submit" class="btn btn-primary btn-rounded">{{ __('Save')}}</button>
	                                </div>
	                            </div>
	                        </div>
	                    </form>
	                </div>
	            </div>
	        </div>
            @endcan
		</div>
		<div class="row">
	        <div class="col-md-12">
	            <div class="card p-3">
	                <div class="card-header"><h3>{{ __('Roles')}}</h3></div>
	                <div class="card-body">
	                    <div class="table-responsive">
							<table id="roles_table" class="table">
								<thead>
									<tr>
										{{-- <th>{{ __('Role')}}</th>
										<th>{{ __('Permissions')}}</th>
										<th>{{ __('Action')}}</th> --}}
	
										<th>Role</th>
										<th>Permissions</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
	                </div>
	            </div>
	        </div>
	    </div>
    </div>
@endsection

@section('vendor-script')
    <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.bootstrap4.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap4.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.checkboxes.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.buttons.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/jszip.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/pdfmake.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/vfs_fonts.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.html5.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.print.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.rowGroup.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>

@endsection


@section('page-script')
  {{-- Page js files --}}
  <script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>
  <script src="{{ asset(mix('js/scripts/administracion/roles-table.js')) }}"></script>
@endsection
