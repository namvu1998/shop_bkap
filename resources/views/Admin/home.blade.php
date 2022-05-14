@extends('admin.master')
@section('content')



<div class="container">

	<div id="table_data">

		<table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
			<!--begin::Table head-->
			<thead>
				<tr class="fw-bolder text-muted">
					<th class="min-w-20px">Stt</th>
					<th class="min-w-40px">Name</th>
					<th class="min-w-40px">Full name</th>
					<th class="min-w-40px">Email</th>
					<th class="min-w-40px">Phone</th>
					<th class="min-w-40px">Address</th>
					<th class="min-w-40px">Note</th>
					<th class="min-w-40px">Detail</th>
				</tr>
			</thead>
			<!--end::Table head-->
			<!--begin::Table body-->
			<tbody>
				@foreach ($orders as $item)
				<tr>
					<td>{{$loop->iteration}}</td>
					<td>{{$item->name}}</td>
					<td>{{$item->user->name}}</td>
					<td>{{$item->email}}</td>
					<td>{{$item->phone}}</td>
					<td>{{$item->address}}</td>
					<td>{{$item->note}}</td>
					<td><a class="btn btn-primary text-btn" href="{{route('orderDetail', $item->id)}}">Detail</a></td>
				</tr>
				@endforeach
			</tbody>
			<!--end::Table body-->
		</table>
		<!-- {{-- {{$category->links()}} --}} -->
	</div>

</div>





<!--begin::Footer-->
<div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
	<!--begin::Container-->
	<div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
		<!--begin::Copyright-->
		<div class="text-dark order-2 order-md-1">
			<span class="text-muted fw-bold me-1">2021©</span>
			<a href="https://keenthemes.com" target="_blank" class="text-gray-800 text-hover-primary">Keenthemes</a>
		</div>
		<!--end::Copyright-->
		<!--begin::Menu-->
		<ul class="menu menu-gray-600 menu-hover-primary fw-bold order-1">
			<li class="menu-item">
				<a href="https://keenthemes.com" target="_blank" class="menu-link px-2">About</a>
			</li>
			<li class="menu-item">
				<a href="https://keenthemes.com/support" target="_blank" class="menu-link px-2">Support</a>
			</li>
			<li class="menu-item">
				<a href="https://1.envato.market/EA4JP" target="_blank" class="menu-link px-2">Purchase</a>
			</li>
		</ul>
		<!--end::Menu-->
	</div>
	<!--end::Container-->
</div>
<!--end::Footer-->
</div>
<!--end::Wrapper-->
</div>
<!--end::Page-->
</div>
<!--end::Root-->
<!--begin::Exolore drawer toggle-->
<button id="kt_explore_toggle" class="btn btn-sm bg-body btn-color-gray-700 btn-active-primary shadow-sm position-fixed px-5 fw-bolder zindex-2 top-50 mt-10 end-0 transform-90 fs-6 rounded-top-0" title="Explore Metronic" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-trigger="hover">
	<span id="kt_explore_toggle_label">Explore</span>
</button>
<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
	<!--begin::Svg Icon | path: icons/duotone/Navigation/Up-2.svg-->
	<span class="svg-icon">
		<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
			<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
				<polygon points="0 0 24 0 24 24 0 24" />
				<rect fill="#000000" opacity="0.5" x="11" y="10" width="2" height="10" rx="1" />
				<path d="M6.70710678,12.7071068 C6.31658249,13.0976311 5.68341751,13.0976311 5.29289322,12.7071068 C4.90236893,12.3165825 4.90236893,11.6834175 5.29289322,11.2928932 L11.2928932,5.29289322 C11.6714722,4.91431428 12.2810586,4.90106866 12.6757246,5.26284586 L18.6757246,10.7628459 C19.0828436,11.1360383 19.1103465,11.7686056 18.7371541,12.1757246 C18.3639617,12.5828436 17.7313944,12.6103465 17.3242754,12.2371541 L12.0300757,7.38413782 L6.70710678,12.7071068 Z" fill="#000000" fill-rule="nonzero" />
			</g>
		</svg>
	</span>
	<!--end::Svg Icon-->
</div>
<!--end::Scrolltop-->
<!--end::Main-->
@stop