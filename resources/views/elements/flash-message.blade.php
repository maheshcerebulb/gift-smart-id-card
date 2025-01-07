@if ($message = Session::get('success'))
	<div class="alert alert-custom alert-notice alert-light-success fade show" role="alert">
		<div class="alert-icon">
			<i class="far fa-check-circle"></i>
		</div>
		<div class="alert-text">{{ Session::get('success') }}</div>
		<div class="alert-close">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">
					<i class="flaticon2-checkmark"></i>
				</span>
			</button>
		</div>
	</div>
@endif
@if (session('status'))
<div class="alert alert-custom alert-notice alert-light-success fade show" role="alert">
		<div class="alert-icon">
			<i class="far fa-check-circle"></i>
		</div>
		<div class="alert-text">{{ Session::get('status') }}</div>
		<div class="alert-close">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">
					<i class="flaticon2-checkmark"></i>
				</span>
			</button>
		</div>
	</div>
@endif
@if ($message = Session::get('error'))
	<div class="alert alert-custom alert-notice alert-light-danger fade show" role="alert">
		<div class="alert-icon">
			<i class="flaticon-circle"></i>
		</div>
		<div class="alert-text">{{ Session::get('error') }}</div>
		<div class="alert-close">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">
					<i class="ki ki-close"></i>
				</span>
			</button>
		</div>
	</div>
@endif

@if ($message = Session::get('warning'))
	<div class="alert alert-custom alert-notice alert-light-danger fade show" role="alert">
		<div class="alert-icon">
			<i class="flaticon-warning"></i>
		</div>
		<div class="alert-text">{{ Session::get('warning') }}</div>
		<div class="alert-close">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">
					<i class="ki ki-close"></i>
				</span>
			</button>
		</div>
	</div>
@endif
{{-- @if ($errors->any())
	<div class="alert alert-custom alert-notice alert-light-warning fade show" role="alert">
		<div class="alert-icon">
			<i class="flaticon-warning"></i>
		</div>
		<div class="alert-text">Please check the form below for errors</div>
		<div class="alert-close">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">
					<i class="ki ki-close"></i>
				</span>
			</button>
		</div>
	</div>
@endif --}}
@if ($errors->any())
<div class="alert alert-custom alert-notice alert-light-danger fade show" role="alert">
    <div class="alert-icon">
        <i class="flaticon-circle"></i>
    </div>
    <div class="alert-text">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    <div class="alert-close">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">
                <i class="ki ki-close"></i>
            </span>
        </button>
    </div>
</div>
@endif
