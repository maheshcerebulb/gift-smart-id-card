<div class="tab-pane fade show active" id="special-entity-application-detail" role="tabpanel" aria-labelledby="tab-special-entity-application-detail">

    <div class="card card-custom card-custom-shadow">

        <div class="card-header custom-form-block-header">

            <h3 class="card-title">Special Applicant Detail</h3>

        </div>

        {!! Form::open(['route' => 'save-special-entity-application-detail', 'class' => 'form', 'id' => 'special_entity_application_detail_form', 'action-for' => 'add']) !!}

            {!! Form::hidden('is_special_entity_application_detail_valid', null, ['id' => 'is_special_entity_application_detail_valid']) !!}

            {!! Form::hidden('id', !empty($entityApplicationDetailData) ? $entityApplicationDetailData->id : null , ['class' => 'special-entity-application-id']) !!}

            {!! Form::hidden('application_type', !empty($entityApplicationDetailData) && $entityApplicationDetailData->application_type == 1 ? 1 : 0, ['class' => 'special-entity-application-type']) !!}

            {!! Form::hidden('user_id', Auth::id(), ['class' => 'special-entity-application-user-id']) !!}

            {!! Form::hidden('draft_status', !empty($entityApplicationDetailData) && $entityApplicationDetailData->status == 201 ? 'Draft' : '', ['class' => 'special-entity-application-draft-status']) !!}

            <div class="card-body row">

                <div class="col-lg-6">

                    <div class="form-group">

                        <div class="col-lg-10">

                            <label>First Name: *</label>

                            {!! Form::text('first_name', !empty($entityApplicationDetailData) ? $entityApplicationDetailData->first_name : null, ['class' => 'form-control required', 'placeholder' => 'First Name', 'maxlength' => config('constant.ENTITY_APPLICATION_FIRST_NAME_MAXLENGTH')]) !!}

                        </div>

                    </div>

                    <div class="form-group">

                        <div class="col-lg-10">

                            <label>Last Name: *</label>

                            {!! Form::text('last_name', !empty($entityApplicationDetailData) ? $entityApplicationDetailData->last_name : null, ['class' => 'form-control required', 'placeholder' => 'Last Name', 'maxlength' => config('constant.LAST_NAME_MAXLENGTH')]) !!}

                        </div>

                    </div>

                    <div class="form-group">

                        <div class="col-lg-10">

                            <label>Entity Name: *</label>

                            {!! Form::text('other_entity', !empty($entityApplicationDetailData) ? $entityApplicationDetailData->other_entity : null, ['class' => 'form-control required', 'placeholder' => 'Entity Name', 'maxlength' => config('constant.COMPANY_NAME_MAXLENGTH')]) !!}

                        </div>

                    </div>

                    <div class="form-group">

                        <div class="col-lg-10">

                            <label>Designation: *</label>

                            {!! Form::text('designation', !empty($entityApplicationDetailData) ? $entityApplicationDetailData->designation : null, ['class' => 'form-control required', 'placeholder' => 'Designation', 'maxlength' => config('constant.DESIGNATION_MAXLENGTH')]) !!}

                        </div>

                    </div>

                    <div class="form-group">

                        <div class="col-lg-10">

                            <label >Date of birth : *</label>

                            <div class="input-group date">

                                <input type="text" class="form-control date datepicker" name="date_of_birth" value="{{ !empty($entityApplicationDetailData) ? date('d-m-Y',strtotime($entityApplicationDetailData->date_of_birth)) : date('d-m-Y') }}" id="date_of_birth">

                                <div class="input-group-append">

                                    <span class="input-group-text">

                                        <i class="la la-calendar"></i>

                                    </span>

                                </div>

                            </div>

                            <!-- {!! Form::date('date_of_birth', date('d-m-Y'), ['class' => 'form-control date required', 'placeholder' => 'Select Date of birth','id'=> 'special_date_of_birth','max' => now()->format('Y-m-d'),]) !!} -->

                        </div>

                    </div>



                    <div class="form-group  align-items-center">

                        <div class="col-lg-10">

                            <label>Gender: *</label>

                            <div class="col-lg-6">

                                <div class="radio-inline">

                                    <label class="radio radio-outline radio-primary">

                                        {{ Form::radio('gender', 'Male',!empty($entityApplicationDetailData) && $entityApplicationDetailData->gender == 'Male' ? true : false) }}

                                        <span></span>Male

                                    </label>

                                    <label class="radio radio-outline radio-primary">

                                        {{ Form::radio('gender', 'Female',!empty($entityApplicationDetailData) && $entityApplicationDetailData->gender == 'Female' ? true : false) }}

                                        <span></span>Female

                                    </label>

                                    <label class="radio radio-outline radio-primary">

                                        {{ Form::radio('gender', 'Other',!empty($entityApplicationDetailData) && $entityApplicationDetailData->gender == 'Other' ? true : false) }}

                                        <span></span>Other

                                    </label>

                                </div>

                            </div>

                        </div>

                    </div>



                </div>

                <div class="col-lg-6">



                    <div class="form-group">

                        <div class="col-lg-10">

                            <label>Email Address: *</label>

                            {!! Form::text('email', !empty($entityApplicationDetailData) ? $entityApplicationDetailData->email : null, ['class' => 'form-control required email', 'placeholder' => 'Email Address', 'maxlength' => '100']) !!}

                        </div>

                    </div>

                    <div class="form-group">

                        <div class="col-lg-10 special_entity_application_mobile_data">

                            <label>Mobile Number: *</label>

                            {!! Form::text('mobile_number', !empty($entityApplicationDetailData) ? $entityApplicationDetailData->mobile_number : null, ['class' => 'form-control required special_entity_application_mobile_number', 'placeholder' => '']) !!}

                            <span id="special_entity_application_mobile_number-valid-msg" class="hide">✓ Valid</span>

                            <span id="special_entity_application_mobile_number-error-msg" class="hide"></span>
                        </div>

                    </div>
                    @if (empty($entityApplicationDetailData))
					
                        <div class="form-group  align-items-center">

                            <div class="col-lg-10">

                                <label>Application Type: *</label>

                                <div class="col-lg-6">

                                    <div class="radio-inline">

                                        <label class="radio radio-outline radio-primary">

                                            {{ Form::radio('type', 'Other',!empty($entityApplicationDetailData) && $entityApplicationDetailData->type == 'Other' ? true : false,['id' => 'type']) }}

                                            <span></span>Other

                                        </label>
                                    </div>
                                    
                                </div>
                                <div class="col-lg-12">
                                    
                                    <label>Department: *</label>
									<button type="button" style="float: right;" class="btn btn-sm btn-primary d-flex align-items-center" id="add_department">+</button>

									<select class="form-control required " name="application_department" id="application_department">
										<option value="">All</option>
										@foreach ($departments as $department)
											<option value="{{ $department->name}}" {{ !empty($entityApplicationDetailData->department) && $entityApplicationDetailData->department == $department->name ? 'selected' : '' }}>{{ $department->name }}</option>
										@endforeach
									</select>
                                </div>

                            </div>

                        </div>
                    @else
                        <div class="form-group align-items-center">

                            <div class="col-lg-10">

                                <label>Application Type: *</label>

                                <div class="">

                                    <input type="text" class="form-control" name="type" value="Other" readonly>

                                </div>

                            </div>

                            <div class="col-lg-10">

                                <label>Department: *</label>

                                <div class="">

                                    <input type="text" class="form-control" name="department" value="{{ !empty($entityApplicationDetailData) ? $entityApplicationDetailData->department : ''}}" readonly>

                                </div>

                            </div>

                        </div>
                    @endif
                    

                    <div class="form-group">

                        <div class="col-lg-10">

                            <label>Upload Profile Picture: *</label>

                            {!! Form::hidden('special_image_hidden', !empty($entityApplicationDetailData) ? $entityApplicationDetailData->image : null, ['id' => 'special_image_hidden']) !!}

                            {!! Form::hidden('previous_special_image_hidden', !empty($entityApplicationDetailData) ? $entityApplicationDetailData->image : null, ['id' => 'previous_special_image_hidden']) !!}

                            <div class="dropzone dropzone-default dropzone-success" id="special_image">

                                <div class="dropzone-msg dz-message needsclick">

                                    <h3 class="dropzone-msg-title">Drop file here or click to upload.</h3>

                                    <span class="dropzone-msg-desc">Only image file is allowed for upload</span>

                                </div>

                            </div>

                           

                                @if (!empty($entityApplicationDetailData))

                                <img width="50" height="50" src="{{ asset('upload/entity-data/entity-application/' . $entityApplicationDetailData->image) }}" id="old_special_image" alt="">

                                    <a href="javascript:;" id="special-image-remove-btn" onclick="removeImage()">remove</a>

                                @endif

                                <span class="form-text text-muted">Allowed file Type : png, jpg, jpeg & Image size : 130 PX x 180 PX or 3.5 CM x 4.5 CM</span>
                           
                                
                           

                        </div>

                    </div>
                    <div class="form-group">

                        <div class="col-lg-10">

                            <label>Upload Card Holder Signature: *</label>

                            {!! Form::hidden('special_signature_hidden', !empty($entityApplicationDetailData) ? $entityApplicationDetailData->signature : null, ['id' => 'special_signature_hidden']) !!}

                            {!! Form::hidden('previous_special_signature_hidden', !empty($entityApplicationDetailData) ? $entityApplicationDetailData->signature : null, ['id' => 'previous_special_signature_hidden']) !!}



                            <div class="dropzone dropzone-default dropzone-success" id="special_signature">

                                <div class="dropzone-msg dz-message needsclick">

                                    <h3 class="dropzone-msg-title">Drop file here or click to upload.</h3>

                                    <span class="dropzone-msg-desc">Only image file is allowed for upload</span>

                                </div>

                            </div>


                                @if (!empty($entityApplicationDetailData))

                                <img width="50" height="50" src="{{ asset('upload/entity-data/entity-application/' . $entityApplicationDetailData->signature) }}" id="old_special_signature" alt="">

                                    <a href="javascript:;" id="special-signature-remove-btn" onclick="removeSignature()">remove</a>

                                @endif

                                <span class="form-text text-muted">Allowed file types: png, jpg, jpeg & Image size : 140 PX x 60 PX or 3.7 CM x 1.5 CM</span>
                           

                        </div>

                    </div>
                </div>

            </div>

            <div class="card-footer">

                <div class="row">

                    <div class="col-lg-5"></div>

                    <div class="col-lg-7">

                        <button id="special_entity_application_detail_submit_button" type="button" class="btn btn-primary mr-2">Save And Next</button>

                    </div>

                </div>

            </div>

        {!! Form::close() !!}

    </div>

</div>

<div class="modal fade" id="departmentpopup" tabindex="-1" role="dialog" aria-labelledby="departmentpopup" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Department</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            {!! Form::open(['route' => 'common.add_department', 'class' => 'form', 'id' => 'add_department_form', 'action-for' => 'add']) !!}
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-form-label text-right col-lg-3 col-sm-12">Department</label>
                        <div class="col-lg-9 col-md-9 col-sm-12">
                            <div class="input-group" data-z-index="6">
                                {!! Form::text('department', null, ['class' => 'form-control required', 'placeholder' => 'Department', 'maxlength' => '100','id' => 'department_input']) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary font-weight-bold" id="add_department_submit_button">Save changes</button>
                </div>
                {!! Form::close() !!}
        </div>
    </div>
</div>

