<script>
	@if ($message = Session::get('success'))
		toastr.options = {
			"timeOut": "10000",
		};
		toastr.success("{{ Session::get('success') }}");
	@endif

	@if ($message = Session::get('error'))
		toastr.options = {
			"timeOut": "10000",
		};
		toastr.error("{{ Session::get('error') }}");
	@endif

	@if ($errors->any())
		toastr.options = {
			"timeOut": "10000",
		};
		toastr.error("Please check the form below for errors");
	@endif
</script>