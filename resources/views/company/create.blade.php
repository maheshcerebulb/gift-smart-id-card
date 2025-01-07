<form action="{{ $company->id == null ? route('company.store') : route('company.update', ['company' => $company->id]) }}" method="POST"

    id="company_form" novalidate="" class="needs-validation">

    <div class="card-body">

        @csrf

        <div class="row">

            <div class="col-sm-12 col-lg-12">

                <div class="form-group col-sm-6">

                    <label for="name">Name</label>

                    <input class="form-control @error('name') is-invalid @enderror" name="name" type="text"

                        value="{{ old('name', $company->name) }}" required="" placeholder="company" maxlength="{{ config('constant.COMPANY_NAME_MAXLENGTH')}}" >

                    @error('name')

                        <div class="invalid-feedback">{{ $message }}</div>

                    @enderror

                    <div class="valid-feedback">Looks good!</div>

                    <div class="invalid-feedback">Please enter company.</div>

                </div>

                <div class="form-group col-sm-6">

                    <label for="application_no">Application No</label>

                    <input class="form-control @error('application_no') is-invalid @enderror" name="application_no" type="text"

                        value="{{ old('application_no', $company->application_no) }}" required="" placeholder="Application Number">

                    @error('application_no')

                        <div class="invalid-feedback">{{ $message }}</div>

                    @enderror

                    <div class="valid-feedback">Looks good!</div>

                    <div class="invalid-feedback">Please enter application number.</div>

                </div>

            </div>

        </div>

    </div>

    <div class="modal-footer">

        <button class="btn btn-primary" type="submit">{{ $company->id == null ? 'Save' : 'Update' }}</button>

        <a href="{{ route('company.index') }}" class="btn btn-secondary">Cancel</a>

    </div>

</form>

