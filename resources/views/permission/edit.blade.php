<form
    action="{{ route('permission.update') }}"
    method="POST" id="permission_form" novalidate="" class="needs-validation">
    <div class="card-body">
        @csrf
        <div class="row">
            <div class="form-group col-sm-6">
                <label for="name">Permission</label>
                <div class="permission">
                @foreach($permission as $key => $value)
                    @php $selectedModule = $value->module; @endphp
                    <div class="each-input">
                        <input class="nameInput permissionInput form-control @error('name') is-invalid @enderror" name="name[{{$key}}]" type="text" data-id="{{$value->id}}" placeholder="Enter permission name" value="{{ $value->name }}">
                        <input class="" name="id[{{$key}}]" type="hidden" data-id="{{$value->id}}" placeholder="Enter permission name" value="{{ $value->id }}">
                        @if($key === 0)
                            <button type="button" name="add" id="add" class="btn btn-success">Add More</button>
                        @else
                            <button type="button" class="btn btn-danger btn-remove remove-permission" data-id="{{$value->id}}" >Remove</button>
                        @endif
                    </div>
                @endforeach
                <div class="append-list"></div>
                </div>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <div class="valid-feedback">Looks good!</div>
                <div class="invalid-feedback">Please enter name.</div>
            </div>
            <div class="form-group col-sm-6">
                <label for="module">Module</label>
                <select class="form-control custom-select @error('module') is-invalid @enderror" name="module" id="moduleId">
                    @if(count($moduleList))
                        @foreach ($moduleList as $module)
                            <option value="{{ $module->id }}" {{ isset($value) && $module->id==$value->module ? 'selected' : ''}}> {{ $module->name }} </option>
                        @endforeach
                    @else
                        <option disabled value="No module found selected">No module found selected</option>
                    @endif
                </select>
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
        <input class="btn btn-primary update-permission" type="submit" value="Update">
        <a href="{{ route('permission.index') }}" class="btn btn-secondary">Cancel</a>
    </div>
</form>
