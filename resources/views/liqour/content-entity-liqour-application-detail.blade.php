<div class="tab-pane fade show active" id="liqour-application-detail" role="tabpanel" aria-labelledby="tab-liqour-application-detail">

    <div class="card card-custom card-custom-shadow">

        <div class="card-header custom-form-block-header">
            <h3 class="card-title">Applicant Detail</h3>
            
        </div>

        {!! Form::open(['route' => 'liqour.save-liqour-application-detail', 'class' => 'form', 'id' => 'liqour_application_detail_form', 'action-for' => 'add']) !!}

            {!! Form::hidden('is_liqour_application_detail_valid', null, ['id' => 'is_liqour_application_detail_valid']) !!}

            {!! Form::hidden('id', !empty($ApplicationDetailData) ? $ApplicationDetailData->id : null , ['class' => 'liqour-application-id']) !!}

            

            {!! Form::hidden('user_id', Auth::id(), ['class' => 'liqour-application-user-id']) !!}

            

            <div class="card-body row ">

                <div class="col-lg-6">
                    <div class="form-group">

                        <div class="col-lg-10">

                            <label>Serial No.:</label>

                            {!! Form::text('serial_number',  !empty($ApplicationDetailData) ? $ApplicationDetailData->serial_number : $lastSerialNumber, ['class' => 'form-control required','placeholder' => '00000','readonly'=> 'readonly']) !!}

                        </div>

                    </div>

                    <div class="form-group">

                        <div class="col-lg-10">

                            <label>First Name: *</label>

                            {!! Form::text('first_name', !empty($ApplicationDetailData) ? $ApplicationDetailData->first_name : null, ['class' => 'form-control maxlengthclass required', 'placeholder' => 'First & Middle Name','maxlength' => config('constant.FIRST_NAME_MAXLENGTH')]) !!}

                        </div>

                    </div>


                    <div class="form-group">

                        <div class="col-lg-10">

                            <label>Last Name: *</label>

                            {!! Form::text('last_name', !empty($ApplicationDetailData) ? $ApplicationDetailData->last_name : null, ['class' => 'form-control maxlengthclass required', 'placeholder' => 'Last Name' ,'maxlength' => config('constant.LAST_NAME_MAXLENGTH')]) !!}

                        </div>

                    </div>

                    <div class="form-group">

                        <div class="col-lg-10">

                            <label>Designation: *</label>

                            {!! Form::text('designation', !empty($ApplicationDetailData) ? $ApplicationDetailData->designation : null, ['class' => 'form-control required maxlengthclass', 'placeholder' => 'Designation', 'maxlength' =>config('constant.DESIGNATION_MAXLENGTH')]) !!}

                        </div>

                    </div>

                    <div class="form-group">

                        <div class="col-lg-10">

                            <label>Company/ Organization/ Unit Name & Address: *</label>

                            {!! Form::text('company_name', !empty($ApplicationDetailData) ? $ApplicationDetailData->company_name : null, ['class' => 'form-control maxlengthclass required', 'placeholder' => 'Company Name', 'maxlength' => config('constant.COMPANY_NAME_MAXLENGTH')]) !!}

                        </div>

                    </div>

                    <div class="form-group">

                        <div class="col-lg-10">

                            <label>Temporary Address: *</label>

                            {!! Form::textarea('temporary_address', !empty($ApplicationDetailData) ? $ApplicationDetailData->temporary_address : null, ['class' => 'form-control maxlengthclass required', 'placeholder' => 'Temporary Address', 'maxlength' => '150']) !!}

                        </div>

                    </div>

                    

                </div>

                <div class="col-lg-6">

                    <div class="form-group">

                        <div class="col-lg-10 liqour_mobile_data">

                            <label>Mobile Number: *</label>

                            <input type="text" class="form-control required mobile_number" name="mobile_number" value="{{ !empty($ApplicationDetailData->mobile_number) ?  $ApplicationDetailData->mobile_number : ''}}" id="mobile_number" >

                            <span id="mobile_number-valid-msg" class="hide">✓ Valid</span>

                            <span id="mobile_number-error-msg" class="hide"></span>

                            {{-- {!! Form::text('mobile_number', !empty($ApplicationDetailData) ? $ApplicationDetailData->mobile_number : null, ['class' => 'form-control required', 'placeholder' => 'Mobile Number', 'maxlength' => '10']) !!} --}}

                        </div>

                    </div>

                    

                    <div class="form-group">

                        <div class="col-lg-10">

                            <label>Upload Image: *</label>

                            {!! Form::hidden('liqour_image_hidden', !empty($ApplicationDetailData) ? $ApplicationDetailData->image : null, ['id' => 'liqour_image_hidden']) !!}

                            {!! Form::hidden('previous_liqour_image_hidden', !empty($ApplicationDetailData) ? $ApplicationDetailData->image : null, ['id' => 'previous_liqour_image_hidden']) !!}



                            <div class="dropzone dropzone-default dropzone-success" id="liqour_image">

                                <div class="dropzone-msg dz-message needsclick">

                                    <h3 class="dropzone-msg-title">Drop file here or click to upload.</h3>

                                    <span class="dropzone-msg-desc">Only image file is allowed for upload</span>

                                </div>

                            </div>

                                @if (!empty($ApplicationDetailData))

                                <img width="50" height="50" src="{{ asset('upload/liqour-data/liqour-application/' . $ApplicationDetailData->image) }}" id="old_image" alt="">

                                    <a href="javascript:;" id="image-remove-btn" onclick="removeImage()">remove</a>

                                @endif

                        </div>

                    </div>

                    <div class="form-group">

                        <div class="col-lg-10">

                            <label>Permanent Address: *</label>

                            {!! Form::textarea('permanent_address', !empty($ApplicationDetailData) ? $ApplicationDetailData->permanent_address : null, ['class' => 'form-control maxlengthclass required', 'placeholder' => 'Permanent Address','maxlength' => '150']) !!}

                        </div>

                    </div>

                </div>

            </div>

            <div class="card-footer">

                <div class="row">

                    <div class="col-lg-5"></div>

                    <div class="col-lg-7">

                        <button id="liqour_application_detail_submit_button" type="button" class="btn btn-primary mr-2">Save And Next</button>

                    </div>

                </div>

            </div>

        {!! Form::close() !!}

    </div>

</div>

