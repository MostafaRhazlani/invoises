@extends('layouts.master')

@section('title')
الاقسام
@endsection

@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">الاعدادات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ الاقسام</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')

	@if ($errors->any())
	<div class="alert alert-danger">
			<ul>
					@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
					@endforeach
			</ul>
	</div>
	@endif

	@if(session()->has('Add'))
		<div class="alert alert-success alert-dismissible fade show" role="alert">
			<strong>{{ session()->get('Add') }}</strong>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
  @endif

	@if(session()->has('Delete'))
		<div class="alert alert-danger alert-dismissible fade show" role="alert">
			<strong>{{ session()->get('Delete') }}</strong>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
	@endif

	@if(session()->has('Edit'))
		<div class="alert alert-success alert-dismissible fade show" role="alert">
			<strong>{{ session()->get('Edit') }}</strong>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
	@endif

		<!-- row -->
		<div class="row">
			<!--div-->
			<div class="col-xl-12">
				<div class="card mg-b-20">
					<div class="card-header pb-0">
							<div class="">
									<a class="modal-effect btn btn-primary-gradient btn-block w-25" data-effect="effect-scale"
											data-toggle="modal" href="#modaldemo8"><i class="fas fa-plus"></i>&nbsp; اضافة قسم</a>
							</div>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table id="example1" class="table key-buttons text-md-nowrap">
								<thead>
									<tr>
										<th class="border-bottom-0">#</th>
										<th class="border-bottom-0">اسم القسم</th>
										<th class="border-bottom-0">الوصف</th>
										<th class="border-bottom-0">العمليات</th>
									</tr>
								</thead>
								<tbody>
										<?php $i = 0; ?>
									@foreach ($sections as $section)
										<?php $i++; ?>
										<tr>
											<td>{{ $i }}</td>
											<td>{{ $section->section_name }}</td>
											<td>{{ $section->description }}</td>
											<td>
												<a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
													data-id="{{ $section->id }}" data-section_name="{{ $section->section_name }}"
													data-description="{{ $section->description }}" data-toggle="modal"
													href="#exampleModal2" title="تعديل"><i class="las la-pen"></i>
												</a>

												<a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
													data-id="{{ $section->id }}" data-section_name="{{ $section->section_name }}"
													data-toggle="modal" href="#modaldemo9" title="حذف"><i
													class="las la-trash"></i>
												</a>
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<!--/div-->
			<!-- Basic modal -->
			<div class="modal" id="modaldemo8">
				<div class="modal-dialog" role="document">
					<div class="modal-content modal-content-demo">
						<div class="modal-header">
							<h6 class="modal-title">اضافة قسم</h6>
							<button aria-label="Close" class="close" data-dismiss="modal" type="button">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<form action="{{ route('sections.store') }}" method="post">
							@csrf
							<div class="modal-body">
								<div class="form-group">
									<label for="section_name">اسم القسم</label>
									<input type="text" class="form-control" id="section_name" name="section_name">
								</div>
								<div class="form-group">
									<label for="description">الملاحضات</label>
									<textarea class="form-control" name="description" id="description" rows="3"></textarea>
								</div>
							</div>
							<div class="modal-footer">
									<button class="btn ripple btn-success" type="submit">تأكيد</button>
									<button class="btn ripple btn-secondary" data-dismiss="modal" type="button">اغلاق</button>
							</div>
						</form>
					</div>
				</div>
			</div>
			<!-- End basic modal -->
		</div>
		<!-- row closed -->

		<!-- edit -->
		<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">تعديل القسم</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
							</button>
					</div>
					<form  action="sections/update" method="post">
						@csrf
						@method('PATCH')
						<div class="modal-body">
							<div class="form-group">
									<input type="hidden" name="id" id="id" value="">
									<label for="recipient-name" class="col-form-label">اسم القسم:</label>
									<input class="form-control" name="section_name" id="section_name" type="text">
							</div>
							<div class="form-group">
									<label for="message-text" class="col-form-label">ملاحظات:</label>
									<textarea class="form-control" id="description" name="description"></textarea>
							</div>
						</div>
							<div class="modal-footer">
									<button type="submit" class="btn btn-primary">تاكيد</button>
									<button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
							</div>
						</form>
				</div>
			</div>
		</div>

		<!-- delete -->
		<div class="modal" id="modaldemo9">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content modal-content-demo">
					<div class="modal-header">
						<h6 class="modal-title">حذف القسم</h6>
						<button aria-label="Close" class="close" data-dismiss="modal" type="button">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
						<form action="sections/destroy" method="post">
							@csrf
							@method('delete')
							<div class="modal-body">
									<p>هل انت متاكد من عملية الحذف ؟</p><br>
									<input type="hidden" name="id" id="id" value="">
									<input class="form-control" name="section_name" id="section_name" type="text" readonly>
							</div>
							<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
									<button type="submit" class="btn btn-danger">تاكيد</button>
							</div>
						</form>
				</div>
			</div>
		</div>

	</div>
	<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection
@section('js')
<!-- Internal Data tables -->
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
<!--Internal  Datatable js -->
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>
<script src="{{URL::asset('assets/js/modal.js')}}"></script>

<script> 
	$('#exampleModal2').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget)
		var id = button.data('id')
		var section_name = button.data('section_name')
		var description = button.data('description')
		var modal = $(this)
		modal.find('.modal-body #id').val(id);
		modal.find('.modal-body #section_name').val(section_name);
		modal.find('.modal-body #description').val(description);
	})

	$('#modaldemo9').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget)
		var id = button.data('id')
		var section_name = button.data('section_name')
		var modal = $(this)
		modal.find('.modal-body #id').val(id);
		modal.find('.modal-body #section_name').val(section_name);
	})
</script>
@endsection