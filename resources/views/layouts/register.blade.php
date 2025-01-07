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

					@include('elements.register-header')

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

        </script>

		<!--begin::Global Config(global config for global JS scripts)-->

		<script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1200 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#6993FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#F3F6F9", "dark": "#212121" }, "light": { "white": "#ffffff", "primary": "#E1E9FF", "secondary": "#ECF0F3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#212121", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#ECF0F3", "gray-300": "#E5EAEE", "gray-400": "#D6D6E0", "gray-500": "#B5B5C3", "gray-600": "#80808F", "gray-700": "#464E5F", "gray-800": "#1B283F", "gray-900": "#212121" } }, "font-family": "Poppins" };</script>

		<!--end::Global Config-->

		<!--begin::Global Theme Bundle(used by all pages)-->

		<script src="{!! asset('js/plugins.bundle.js?v=1.0.0') !!}" type="text/javascript" ></script>

        <script src="{!! asset('js/prismjs.bundle.js?v=1.0.0') !!}" type="text/javascript" ></script>

		<script src="{!! asset('js/scripts.bundle.js?v=1.0.0') !!}" type="text/javascript" ></script>

		<script type="text/javascript" src="{{asset('js/intlTelInput.js?v=1.0.1')}}"></script>

		<script type="text/javascript" src="{{asset('js/utils.js?v=1.0.1')}}"></script>
		<!--end::Global Theme Bundle-->

		<!--begin::Page Vendors(used by this page)-->

		



		<!--end::Page Vendors-->

		<!--begin::Page Scripts(used by this page)-->

		<script src="{!! asset('js/register.js?v=1.0.0') !!}" type="text/javascript" ></script>

		<!--end::Page Scripts-->

		
	<script>
		set_country_code('entity_contact_person_mobile_number','in')
		set_country_code('entity_auth_person_mobile_number','in')
		// 
function set_country_code(control, country_code) {
    var input = document.querySelector("."+control);
    var errorMsg = document.querySelector("#"+control+"-error-msg");
    var validMsg = document.querySelector("#"+control+"-valid-msg");

    var errorMap = ["Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];
    

    window.addEventListener("load", function () {
      
      
        var errorMsg = document.querySelector("#"+control+"-error-msg");
      
      function getIp(callback) {
       fetch('https://ipinfo.io', { headers: { 'Accept': 'application/json' }})
         .then((resp) => resp.json())
         .catch(() => {
           return {
             country: '',
           };
         })
         .then((resp) => callback(resp.country));
      }
        
        var iti = window.intlTelInput(input, {
                    formatOnDisplay: true,
                    autoInsertDialCode:true,
                    autoHideDialCode: true,
                    initialCountry: country_code,
                    separateDialCode: "false",
                    geoIpLookup: getIp,
                    utilsScript: httpPath + "js/utils.js",
              });
 
        
        input.addEventListener('keyup', formatIntlTelInput);
        input.addEventListener('change', formatIntlTelInput);
      
        function formatIntlTelInput() {
            if (typeof intlTelInputUtils !== 'undefined') { // utils are lazy loaded, so must check
                var currentText = iti.getNumber(intlTelInputUtils.numberFormat.E164);
                if (typeof currentText === 'string') { // sometimes the currentText is an object :)
                    iti.setNumber(currentText); // will autoformat because of formatOnDisplay=true
                }
            }
        }
         
        
               
        input.addEventListener('keyup', function () {     
            reset();
            if (input.value.trim()) {
                if (iti.isValidNumber()) {
        $(input).addClass('form-control is-valid');
                        
                } else {                  
                    $(input).addClass('form-control is-invalid');
                    var errorCode = iti.getValidationError();
                    errorMsg.innerHTML = errorMap[errorCode];                   
                    $(errorMsg).show();
                }
            }


        });        
        input.addEventListener('change', reset);        
        input.addEventListener('keyup', reset);
        
        var reset = function () {
            $(input).removeClass('is-invalid');
            errorMsg.innerHTML = "";
            $(errorMsg).hide();
        
        };
        
      ////////////// testing - start //////////////
      
    //   input.addEventListener('keyup', function(e) {
    //     e.preventDefault();
    //     var num = iti.getNumber(),
    //         valid = iti.isValidNumber();
    //         validMsg.textContent = "Number: " + num + ", valid: " + valid;
    //   }, false);
      
      input.addEventListener("focus", function() {
        validMsg.textContent = "";
      }, false);
          
        
        $(input).on("focusout", function(e, countryData) {
            var intlNumber = iti.getNumber();
            console.log(intlNumber);   
        });
    });
          
          
        //-----------------------only-phone-number-input code (with +)-------------------------------start-------// 
         
    // var iti = window.intlTelInput(input, {
    //     formatOnDisplay: true,
    //     initialCountry: country_code,
    //     separateDialCode: "false",
    //     utilsScript: httpPath + "js/utils.js",
        
    // });


    // var reset = () => {
       
    //     input.classList.remove("error");
    //     errorMsg.innerHTML = "";
    //     errorMsg.classList.add("hide");
    //     validMsg.classList.add("hide");
    // };
    
    // input.addEventListener('blur', () => {
    //     reset();
    //         if (input.value.trim()) {
    //             if (iti.isValidNumber()) {
    //             validMsg.classList.remove("hide");
    //             } else {
    //             input.classList.add("error");
    //             var errorCode = iti.getValidationError();
    //             errorMsg.innerHTML = errorMap[errorCode];
    //             errorMsg.classList.remove("hide");
    //             }
    //         }
    // });

    //   // on keyup / change flag: reset
    // input.addEventListener('change', reset);
    // input.addEventListener('keyup', reset);
}
	</script>
	</body>

	<!-- end::Body -->

</html>