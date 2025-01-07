<form action="{{ $role->id == null ? route('role.store') : route('role.update', ['role' => $role->id]) }}" method="POST"

    id="role_form" novalidate="" class="needs-validation">

    <div class="card-body">

        @csrf

        <div class="row">

            <div class="col-sm-12 col-lg-12">

                <div class="form-group col-sm-6">

                    <label for="name">Role</label>

                    <input class="form-control @error('name') is-invalid @enderror" name="name" type="text"

                        value="{{ old('name', $role->name) }}" required="" placeholder="Role">

                    @error('name')

                        <div class="invalid-feedback">{{ $message }}</div>

                    @enderror

                    <div class="valid-feedback">Looks good!</div>

                    <div class="invalid-feedback">Please enter role.</div>

                </div>

                <input type="hidden" value="web" name="guard_name">

            </div>

            <div class="form-group col-sm-12 col-lg-12">

                <div class="permission">

                    <label for="permission">Permission:</label>

                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"

                        data-accordion="false">

                        <div class="row">

                            @foreach ($groupPermission as $key => $permissions)

                                <div class="col-sm-6 nav-item">

                                    <div class="custom-checkbox permission">

                                        <input id="{{ $key }}" type="checkbox" class="check-all"

                                            name="checkAll">

                                        <label for="{{ $key }}"> <b>{{ Str::ucfirst(explode('.',$permissions[0]->name)[1]) }}</b></label>

                                    </div>



                                    @foreach ($permissions as $permission)

                                        <div class="custom-control custom-checkbox ms-3 nav-treeview">

                                            <input id="{{ $permission->id }}" type="checkbox" class="check-one"

                                                name="permission_data[]" value="{{ $permission->id }}"

                                                {{ $role->id != null && count($role->permission_data) > 0 && isset($role->permission_data[$permission->id]) ? 'checked' : '' }}>

                                            <input id="{{ $permission->module }}" type="hidden"

                                                name="permission_module[{{$permission->id}}]" value="{{ $permission->module }}">

                                            <label for="{{ $permission->id }}">{{ Str::ucfirst($permission->name) }}</label>



                                        </div>



                                    @endforeach

                                </div>

                            @endforeach

                        </div>

                    </ul>

                </div>

            </div>

        </div>

    </div>

    <div class="modal-footer">

        <button class="btn btn-primary" type="submit">{{ $role->id == null ? 'Save' : 'Update' }}</button>

        <a href="{{ route('role.index') }}" class="btn btn-secondary">Cancel</a>

    </div>

</form>

