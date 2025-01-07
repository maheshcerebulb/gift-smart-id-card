
<form
    action="{{ route('permission.store') }}"
    method="POST" id="permission_form" novalidate="" class="needs-validation">
    <div class="card-body">
        @csrf
        <div class="row">
            <div class="form-group col-sm-6">
                <label for="name">Permission</label>
                <div class="permission">
                    <div class="each-input">
                        <input class="permission Input permissionInput form-control @error('name') is-invalid @enderror" name="name[0]" type="text" placeholder="Enter permission name" value="{{ old('name[0]') }}">
                        <button type="button" name="add" id="add" class="btn btn-success">Add More</button>
                    </div>
                    <div class="append-list"></div>
                </div>

                <!-- <input class="form-control @error('name') is-invalid @enderror" name="name" type="text" required="" placeholder="Name"> -->
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <div class="valid-feedback">Looks good!</div>
                <div class="invalid-feedback">Please enter name.</div>
            </div>
            <div class="form-group col-sm-6">
                <label for="module">Module</label>
                <button type="button" class="float-right add-module" title="Create Module" data-toggle="modal" data-target="#module_form_modal">+</button>
                <select class="form-control custom-select @error('module') is-invalid @enderror" name="module" id="moduleId">
                    @if(count($moduleList))
                        @foreach ($moduleList as $module)
                            <option value="{{ $module->id }}" {{ isset($value) && $module->id==$value->module ? 'selected' : ''}}> {{ $module->name }} </option>
                        @endforeach
                    @else
                        <option disabled value="No module found selected">No module found selected</option>
                    @endif
                </select>
                <!-- <input class="form-control @error('module') is-invalid @enderror" name="module" type="text" required="" placeholder="Module"> -->
                @error('module')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <div class="valid-feedback">Looks good!</div>
                <div class="invalid-feedback">Please enter module.</div>
            </div>
            <input type="hidden" name="guard_name" value="web">

        </div>
    </div>
    <div class="modal-footer">
        <input class="btn btn-primary" type="submit" value="Save">
        <a href="{{ route('permission.index') }}" class="btn btn-secondary">Cancel</a>
    </div>
</form>

