<div class="tab-pane fade" id="entity-authorized-person-detail" role="tabpanel" aria-labelledby="tab-entity-authorized-person-detail">

    <div class="card card-custom card-custom-shadow">

        <div class="card-header custom-form-block-header">

            <h3 class="card-title">Primary Authorized Signature Of Entity</h3>

        </div>

        {!! Form::open(['route' => 'users.save-entity-authorized-person-detail', 'class' => 'form', 'id' => 'entity_authorized_person_detail_form', 'action-for' => 'add']) !!}

            {!! Form::hidden('is_entity_authorized_person_detail_valid', null, ['id' => 'is_entity_authorized_person_detail_valid']) !!}

            {!! Form::hidden('id', null, ['class' => 'entity-id']) !!}

            <div class="card-body row">

                <div class="col-lg-6">

                    <div class="form-group">

                        <div class="col-lg-10">

                            <label>First Name: *</label>

                            {!! Form::text('authorized_person_first_name', null, ['class' => 'form-control required', 'placeholder' => 'First Name', 'maxlength' => config('constant.ENTITY_APPLICATION_FIRST_NAME_MAXLENGTH')]) !!}

                        </div>

                    </div>

                    <div class="form-group">

                        <div class="col-lg-10">

                            <label>Last Name: *</label>

                            {!! Form::text('authorized_person_last_name', null, ['class' => 'form-control required', 'placeholder' => 'Last Name', 'maxlength' => config('constant.LAST_NAME_MAXLENGTH')]) !!}

                        </div>

                    </div>

                    <div class="form-group  align-items-center">

                        <div class="col-lg-10">

                            <label>Gender: *</label>

                            <div class="col-lg-6">

                                <div class="radio-inline">

                                    <label class="radio radio-outline radio-primary">

                                        {{ Form::radio('authorized_person_gender', 'Male') }}

                                        <span></span>Male

                                    </label>

                                    <label class="radio radio-outline radio-primary">

                                        {{ Form::radio('authorized_person_gender', 'Female') }}

                                        <span></span>Female

                                    </label>

                                    <label class="radio radio-outline radio-primary">

                                        {{ Form::radio('authorized_person_gender', 'Other') }}

                                        <span></span>Other

                                    </label>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="form-group">

                        <div class="col-lg-10 entity_auth_person_mobile_data">

                            <label>Mobile Number: *</label>

                            {!! Form::text('authorized_person_mobile_number', null, ['class' => 'form-control required entity_auth_person_mobile_number']) !!}
                            <span id="entity_auth_person_mobile_number-valid-msg" class="hide">✓ Valid</span>

                            <span id="entity_auth_person_mobile_number-error-msg" class="hide"></span>
                        </div>

                    </div>

                    <div class="form-group">

                        <div class="col-lg-10 ">

                            <label>Upload Document (Company's Authorize letter and ID proof of authorize person): *</label>

                            {!! Form::hidden('entity_authorized_person_support_document_hidden', null, ['id' => 'entity_authorized_person_support_document_hidden']) !!}





                            <div class="dropzone dropzone-default dropzone-success" id="entity_authorized_person_support_document">

                                <div class="dropzone-msg dz-message needsclick">

                                    <h3 class="dropzone-msg-title">Drop file here or click to upload.</h3>

                                    <span class="dropzone-msg-desc">Only image or pdf file is allowed for upload</span>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="col-lg-6">

                    <div class="form-group">

                        <div class="col-lg-10">

                            <label>Designation/Status: *</label>

                            {!! Form::text('authorized_person_designation', null, ['class' => 'form-control required', 'placeholder' => 'Designation', 'maxlength' => config('constant.DESIGNATION_MAXLENGTH')]) !!}

                        </div>

                    </div>

                    <div class="form-group">

                        <div class="col-lg-10 entity_contact_person_mobile_data">

                            <label>Mobile Number Of Contact Person: *</label>

                            {!! Form::text('authorized_person_mobile_number_2', null, ['class' => 'form-control required entity_contact_person_mobile_number']) !!}
                            <span id="entity_contact_person_mobile_number-valid-msg" class="hide">✓ Valid</span>

                            <span id="entity_contact_person_mobile_number-error-msg" class="hide"></span>
                        </div>

                    </div>

                    <div class="form-group">

                        <div class="col-lg-10">

                            <label>Upload Signature: *</label>

                            {!! Form::hidden('entity_authorized_person_signature_hidden', null, ['id' => 'entity_authorized_person_signature_hidden']) !!}

                            <div class="dropzone dropzone-default dropzone-success" id="entity_authorized_person_signature">

                                <div class="dropzone-msg dz-message needsclick">

                                    <h3 class="dropzone-msg-title">Drop file here or click to upload.</h3>

                                    <span class="dropzone-msg-desc">Only image file is allowed for upload</span>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="card-footer">

                <div class="row">

                    <div class="col-lg-5"></div>

                    <div class="col-lg-7">

                        <button id="entity_authorized_person_detail_submit_button" type="button" class="btn btn-primary mr-2">Save And Next</button>

                    </div>

                </div>

            </div>

        {!! Form::close() !!}

    </div>

</div>

