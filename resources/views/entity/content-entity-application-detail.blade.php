<div class="tab-pane fade show active" id="entity-application-detail" role="tabpanel" aria-labelledby="tab-entity-application-detail">

    <div class="card card-custom card-custom-shadow">

        <div class="card-header custom-form-block-header">

            <h3 class="card-title">Applicant Detail</h3>

        </div>

        {!! Form::open(['route' => 'entity.save-entity-application-detail', 'class' => 'form', 'id' => 'entity_application_detail_form', 'action-for' => 'add']) !!}

            {!! Form::hidden('is_entity_application_detail_valid', null, ['id' => 'is_entity_application_detail_valid']) !!}

            {!! Form::hidden('id', !empty($entityApplicationDetailData) ? $entityApplicationDetailData->id : null , ['class' => 'entity-application-id']) !!}

            {!! Form::hidden('application_type', !empty($entityApplicationDetailData) && $entityApplicationDetailData->application_type == 1 ? 1 : 0, ['class' => 'entity-application-type']) !!}

            {!! Form::hidden('user_id', Auth::id(), ['class' => 'entity-application-user-id']) !!}

            {!! Form::hidden('draft_status', !empty($entityApplicationDetailData) && $entityApplicationDetailData->status == 201 ? 'Draft' : '', ['class' => 'entity-application-draft-status']) !!}

            

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

                            <!-- {!! Form::date('date_of_birth', date('d-m-Y'), ['class' => 'form-control date required', 'placeholder' => 'Select Date of birth','id'=> 'date_of_birth','max' => now()->format('Y-m-d'),]) !!} -->

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

                        <div class="col-lg-10 entity_application_mobile_data">

                            <label>Mobile Number: *</label>

                            {!! Form::text('mobile_number', !empty($entityApplicationDetailData) ? $entityApplicationDetailData->mobile_number : null, ['class' => 'form-control required entity_application_mobile_number', 'placeholder' => '']) !!}

                            <span id="entity_application_mobile_number-valid-msg" class="hide">✓ Valid</span>

                            <span id="entity_application_mobile_number-error-msg" class="hide"></span>
                        </div>

                    </div>
                    @if (empty($entityApplicationDetailData))
                        <div class="form-group  align-items-center">

                            <div class="col-lg-10">

                                <label>Application Type: *</label>

                                <div class="col-lg-6">

                                    <div class="radio-inline">

                                        <label class="radio radio-outline radio-primary">

                                            {{ Form::radio('type', 'Permanent',!empty($entityApplicationDetailData) && $entityApplicationDetailData->type == 'Permanent' ? true : false) }}

                                            <span></span>Permanent

                                        </label>

                                        <label class="radio radio-outline radio-primary">

                                            {{ Form::radio('type', 'Temporary',!empty($entityApplicationDetailData) && $entityApplicationDetailData->type == 'Temporary' ? true : false) }}

                                            <span></span>Temporary

                                        </label>

                                    </div>

                                </div>

                            </div>

                        </div>
                    @else
                        <div class="form-group align-items-center">

                            <div class="col-lg-10">

                                <label>Application Type: *</label>

                                <div class="">

                                    <input type="text" class="form-control" name="type" value="{{ !empty($entityApplicationDetailData) && $entityApplicationDetailData->type == 'Permanent' ? 'Permanent' : 'Temporary' }}" readonly>

                                </div>

                            </div>

                        </div>
                    @endif
                    

                    <div class="form-group">

                        <div class="col-lg-10">

                            <label>Upload Profile Picture: *</label>

                            {!! Form::hidden('image_hidden', !empty($entityApplicationDetailData) ? $entityApplicationDetailData->image : null, ['id' => 'image_hidden']) !!}

                            {!! Form::hidden('previous_image_hidden', !empty($entityApplicationDetailData) ? $entityApplicationDetailData->image : null, ['id' => 'previous_image_hidden']) !!}

                            <div class="dropzone dropzone-default dropzone-success" id="image">

                                <div class="dropzone-msg dz-message needsclick">

                                    <h3 class="dropzone-msg-title">Drop file here or click to upload.</h3>

                                    <span class="dropzone-msg-desc">Only image file is allowed for upload</span>

                                </div>

                            </div>

                           

                                @if (!empty($entityApplicationDetailData))

                                <img width="50" height="50" src="{{ asset('upload/entity-data/entity-application/' . $entityApplicationDetailData->image) }}" id="old_image" alt="">

                                    <a href="javascript:;" id="image-remove-btn" onclick="removeImage()">remove</a>

                                @endif

                                <span class="form-text text-muted">Allowed file Type : png, jpg, jpeg & Image size : 130 PX x 180 PX or 3.5 CM x 4.5 CM</span>
                           
                                
                           

                        </div>

                    </div>
                    <div class="form-group">

                        <div class="col-lg-10">

                            <label>Upload Card Holder Signature: *</label>

                            {!! Form::hidden('signature_hidden', !empty($entityApplicationDetailData) ? $entityApplicationDetailData->signature : null, ['id' => 'signature_hidden']) !!}

                            {!! Form::hidden('previous_signature_hidden', !empty($entityApplicationDetailData) ? $entityApplicationDetailData->signature : null, ['id' => 'previous_signature_hidden']) !!}



                            <div class="dropzone dropzone-default dropzone-success" id="signature">

                                <div class="dropzone-msg dz-message needsclick">

                                    <h3 class="dropzone-msg-title">Drop file here or click to upload.</h3>

                                    <span class="dropzone-msg-desc">Only image file is allowed for upload</span>

                                </div>

                            </div>


                                @if (!empty($entityApplicationDetailData))

                                <img width="50" height="50" src="{{ asset('upload/entity-data/entity-application/' . $entityApplicationDetailData->signature) }}" id="old_signature" alt="">

                                    <a href="javascript:;" id="signature-remove-btn" onclick="removeSignature()">remove</a>

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

                        <button id="entity_application_detail_submit_button" type="button" class="btn btn-primary mr-2">Save And Next</button>

                    </div>

                </div>

            </div>

        {!! Form::close() !!}

    </div>

</div>


