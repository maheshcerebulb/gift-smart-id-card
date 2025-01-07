<form action="{{ $department->id == null ? route('department.store') : route('department.update', ['department' => $department->id]) }}" method="POST"

    id="department_form" novalidate="" class="needs-validation">

    <div class="card-body">

        @csrf

        <div class="row">

            <div class="col-sm-12 col-lg-12">

                <div class="form-group col-sm-6">

                    <label for="name">Name</label>

                    <input class="form-control @error('name') is-invalid @enderror" name="name" type="text"

                        value="{{ old('name', $department->name) }}" required="" placeholder="department" maxlength="{{ config('constant.COMPANY_NAME_MAXLENGTH')}}" >

                    @error('name')

                        <div class="invalid-feedback">{{ $message }}</div>

                    @enderror

                    <div class="valid-feedback">Looks good!</div>

                    <div class="invalid-feedback">Please enter department.</div>

                </div>

            </div>

        </div>

    </div>

    <div class="modal-footer">

        <button class="btn btn-primary" type="submit">{{ $department->id == null ? 'Save' : 'Update' }}</button>

        <a href="{{ route('department.index') }}" class="btn btn-secondary">Cancel</a>

    </div>

</form>

