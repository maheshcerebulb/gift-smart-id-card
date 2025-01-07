<div class="card-body">
    <div class="form-group row">
        <label class="col-lg-3 col-form-label">Name: *</label>
        <div class="col-lg-6">
            {!! Form::text('name', null, ['class' => 'form-control form-control-solid required', 'placeholder' => 'Enter name', 'maxlength' => '255']) !!}
            @if ($errors->has('name'))
                @foreach($errors->get('name') as $message)
                    <span class="text-danger" for="name">{{ $message }}</span>
                @endforeach
            @endif
        </div>
    </div>
    <div class="form-group row">
        <label class="col-lg-3 col-form-label">Email: *</label>
        <div class="col-lg-6">
            {!! Form::email('email', null, ['class' => 'form-control form-control-solid required', 'placeholder' => 'Enter email', 'maxlength' => '50']) !!}
            @if ($errors->has('email'))
                @foreach($errors->get('email') as $message)
                    <span class="text-danger" for="email">{{ $message }}</span>
                @endforeach
            @endif              
        </div>
    </div>
    @if(isset($isEdit))
        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Password:</label>
            <div class="col-lg-6">
                {!! Form::input('password', 'password',  null, ['class' => 'form-control form-control-solid required', 'placeholder' => 'Enter Password']) !!}   
                @if ($errors->has('password'))
                    @foreach($errors->get('password') as $message)
                        <span class="text-danger" for="password">{{ $message }}</span>
                    @endforeach
                @endif                   
            </div>
        </div>
        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Confirm Password:</label>
            <div class="col-lg-6">
                {!! Form::input('password', 'password_confirmation',  null, ['class' => 'form-control form-control-solid required', 'placeholder' => 'Enter Password']) !!}                                
            </div>
        </div>
    @else
        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Password: *</label>
            <div class="col-lg-6">
                {!! Form::input('password', 'password',  null, ['class' => 'form-control form-control-solid required', 'placeholder' => 'Enter Password']) !!}
                @if ($errors->has('password'))
                    @foreach($errors->get('password') as $message)
                        <span class="text-danger" for="password">{{ $message }}</span>
                    @endforeach
                @endif                   
            </div>
        </div>
        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Confirm Password: *</label>
            <div class="col-lg-6">
                {!! Form::input('password', 'password_confirmation',  null, ['class' => 'form-control form-control-solid required', 'placeholder' => 'Enter Password']) !!}                                
            </div>
        </div>
    @endif
    
    <div class="form-group row">
        <label class="col-lg-3 col-form-label">Group: *</label>
        <div class="col-lg-6">
            {!! Form::select('group_id', ['' => 'Select Group'] + $listRole, null, ['class' => 'form-control form-control-solid required']) !!}
            @if ($errors->has('group_id'))
                @foreach($errors->get('group_id') as $message)
                    <span class="text-danger" for="role">{{ $message }}</span>
                @endforeach
            @endif            
        </div>
    </div>
    <div class="form-group row">
        <label class="col-lg-3 col-form-label">Status: *</label>
        <div class="col-lg-6">
            {!! Form::select('is_active', ['' => 'Select status'] + $listStatus, null, ['class' => 'form-control form-control-solid required']) !!}
            @if ($errors->has('is_active'))
                @foreach($errors->get('is_active') as $message)
                    <span class="text-danger" for="status">{{ $message }}</span>
                @endforeach
            @endif           
        </div>
    </div>                            
</div>