<!DOCTYPE html>

<html lang="en" >

	<!-- begin::Head -->

	<head>

	<meta charset="utf-8" />

		<title>{{ config('constant.SITE_NAME') }}</title>

		<meta name="description" content="{{ config('constant.SITE_NAME') }}" />

		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

		<meta name="csrf-token" content="{{ csrf_token() }}">

		<!--begin::Fonts-->

		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />

		<!--end::Fonts-->

		<!--begin::Page Vendors Styles(used by this page)-->

		<!--end::Page Vendors Styles-->

		<!--begin::Global Theme Styles(used by all pages)-->

		<link href="{!! asset('css/plugins.bundle.css?v=1.0.1') !!}" rel="stylesheet" type="text/css" />

        <link href="{!! asset('css/prismjs.bundle.css?v=1.0.1') !!}" rel="stylesheet" type="text/css" />

		<link href="{!! asset('css/style.bundle.css?v=1.0.1') !!}" rel="stylesheet" type="text/css" />

		<link href="{!! asset('css/custom.css?v=1.0.1') !!}" rel="stylesheet" type="text/css" />

		<link rel="stylesheet" type="text/css" href="{{ asset('css/intlTelInput.css') }}">



		<!--end::Global Theme Styles-->

		<!--begin::Layout Themes(used by all pages)-->

		<!--end::Layout Themes-->

        @yield('css')



		<link rel="shortcut icon" href="{!! asset('img/gift_city_logo_svg.svg') !!}" type="image/x-icon">

	</head>

	<!-- end::Head -->

	<!-- end::Body -->

	<body id="kt_body" class="header-fixed header-mobile-fixed page-loading">

		<!--begin::Main-->

		<div class="d-flex flex-column flex-root">

			<!--begin::Page-->

			<div class="d-flex flex-row flex-column-fluid page">

				<!--begin::Wrapper-->

				<div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">

					<!--begin::Header-->

					@include('elements.header')

					<!--end::Header-->



					<!--begin::Container-->

					<div class="d-flex flex-row flex-column-fluid container-fluid">

						<!--begin::Content Wrapper-->

						@yield('content')

						<!--end::Content Wrapper-->

					</div>

					<!--end::Container-->



					<!--begin::Footer-->

					@include('elements.footer')

					<!--end::Footer-->

				</div>

				<!--end::Wrapper-->

			</div>

			<!--end::Page-->

		</div>

		<!--end::Main-->

		<!-- begin::User Panel-->

		@include('elements.user-side-panel')



		<!--begin::Scrolltop-->

		<div id="kt_scrolltop" class="scrolltop">

			<span class="svg-icon">

				<!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Up-2.svg-->

				<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">

					<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">

						<polygon points="0 0 24 0 24 24 0 24" />

						<rect fill="#000000" opacity="0.3" x="11" y="10" width="2" height="10" rx="1" />

						<path d="M6.70710678,12.7071068 C6.31658249,13.0976311 5.68341751,13.0976311 5.29289322,12.7071068 C4.90236893,12.3165825 4.90236893,11.6834175 5.29289322,11.2928932 L11.2928932,5.29289322 C11.6714722,4.91431428 12.2810586,4.90106866 12.6757246,5.26284586 L18.6757246,10.7628459 C19.0828436,11.1360383 19.1103465,11.7686056 18.7371541,12.1757246 C18.3639617,12.5828436 17.7313944,12.6103465 17.3242754,12.2371541 L12.0300757,7.38413782 L6.70710678,12.7071068 Z" fill="#000000" fill-rule="nonzero" />

					</g>

				</svg>

				<!--end::Svg Icon-->

			</span>

		</div>

		<!--end::Scrolltop-->

		<script type="text/javascript">

			var httpPath = "{{ url('/') }}/";

			var baseUrl = "{{ asset('') }}";

        </script>

		<!--begin::Global Config(global config for global JS scripts)-->

		<script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1200 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#6993FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#F3F6F9", "dark": "#212121" }, "light": { "white": "#ffffff", "primary": "#E1E9FF", "secondary": "#ECF0F3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#212121", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#ECF0F3", "gray-300": "#E5EAEE", "gray-400": "#D6D6E0", "gray-500": "#B5B5C3", "gray-600": "#80808F", "gray-700": "#464E5F", "gray-800": "#1B283F", "gray-900": "#212121" } }, "font-family": "Poppins" };</script>

		<!--end::Global Config-->

		<!--begin::Global Theme Bundle(used by all pages)-->

		<script src="{!! asset('js/plugins.bundle.js?v=7.0.5') !!}" type="text/javascript" ></script>

        <script src="{!! asset('js/prismjs.bundle.js?v=7.0.5') !!}" type="text/javascript" ></script>

		<script src="{!! asset('js/scripts.bundle.js?v=7.0.5') !!}" type="text/javascript" ></script>

		<script type="text/javascript" src="{{asset('js/intlTelInput.js?v=1.0.1')}}"></script>
		<script type="text/javascript" src="{{asset('js/utils.js?v=1.0.1')}}"></script>



		<!--end::Global Theme Bundle-->

		<!--begin::Page Vendors(used by this page)-->





		<!--end::Page Vendors-->

		<!--begin::Page Scripts(used by this page)-->

		<script src="{!! asset('js/common.js?v=1.0.1') !!}" type="text/javascript" ></script>

		<script src="{!! asset('js/entity.js?v=1.0.2') !!}" type="text/javascript" ></script>

		<script src="{!! asset('js/liqour.js?v=1.0.1') !!}" type="text/javascript" ></script>

		<script href="{!! asset('css/bootstrap-maxlength.js?v=1.0.1') !!}"  ></script>

		<script>
			
			function getBaseCompanyList(selectedValue) {
				// Get the checkbox element
				const url = `get-base-company-list?filter=${selectedValue}`;

				fetch(httpPath + url)
						.then(response => response.json())
						.then(data => {
							if (data.success) {
									const select5 = document.getElementById('filter_company');
									select5.innerHTML = ''; // Clear existing options

									// Add default option
									const selectBuildingOption = document.createElement('option');
										selectBuildingOption.value = '';
										selectBuildingOption.text = 'Select Company';
										selectBuildingOption.selected = true;  // Make it selected by default
										select5.appendChild(selectBuildingOption);

										// Add "All" option (second)
										const defaultOption = document.createElement('option');
										defaultOption.value = '0';
										defaultOption.text = 'All';
										select5.appendChild(defaultOption);

										// Append new options (top 10 companies)
										data.companies.forEach(company => {
											const option = document.createElement('option');
											option.value = company;
											option.text = company;
											select5.appendChild(option);
										});
							} else {
								console.error('Failed to fetch top 10 buildings.');
							}
						})
						.catch(error => console.error('Error:', error));
				
			}
		</script>
		@php

			if (isset($ApplicationDetailData)) {
				if(!empty($ApplicationDetailData) && $ApplicationDetailData->mobile_number){
						echo "<script>set_country_code('mobile_number','".strtolower($ApplicationDetailData->country_code)."')</script>";
				}
			}
			else {
				echo "<script>set_country_code('mobile_number','in')</script>";
			}

			if (isset($entityApplicationDetailData)) {
				if(!empty($entityApplicationDetailData) && $entityApplicationDetailData->mobile_number){
						echo "<script>set_country_code('entity_application_mobile_number','".strtolower($entityApplicationDetailData->country_code)."')</script>";
				}
			}
			else {
				echo "<script>set_country_code('entity_application_mobile_number','in')</script>";
			}
		@endphp

        @yield('scripts')

		<!--end::Page Scripts-->

	</body>

	<!-- end::Body -->

</html>

