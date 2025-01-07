<div class="tab-pane fade" id="special-entity-application-verify-and-submit-detail" role="tabpanel" aria-labelledby="tab-content-special-entity-application-verify-and-submit-detail">

    <div class="card card-custom card-custom-shadow">

        <div class="card-header custom-form-block-header">

            <h3 class="card-title">Verifications</h3>

        </div>

        {!! Form::open(['route' => 'entity.save-special-entity-application-verify-and-submit-detail', 'class' => 'form', 'id' => 'special_entity_application_verify_and_submit_detail_form']) !!}

            {!! Form::hidden('id', null, ['class' => 'special-entity-application-id']) !!}

            {!! Form::hidden('user_id', session::get('User.id'), ['class' => 'special-entity-application-user-id']) !!}



            <div class="card-body">

                <div class="row">

                    <div class="col-md-12">

                        <h5 class="text-dark font-weight-bold mb-10">ID Card Details:</h5>

                    </div>

                    <div class="col-lg-6">

                        <!--begin::Wizard Step 1-->

                        <div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current">

                            <!--begin::Group-->

                            

                            <!--end::Group-->

                            <!--begin::Group-->

                            <div class="form-group row fv-plugins-icon-container mb-0">

                                <label class="col-xl-5 col-lg-5 col-form-label">Serial Number</label>

                                <div class="col-lg-1 col-xl-1">:</div>

                                <div class="col-lg-6 col-xl-6">

                                    <p id="card-id-application-number"></p>

                                </div>

                            </div>

                            <!--end::Group-->

                            <!--begin::Group-->

                            <div class="form-group row fv-plugins-icon-container mb-0">

                                <label class="col-xl-5 col-lg-5 col-form-label">Name of Passholder</label>

                                <div class="col-lg-1 col-xl-1">:</div>

                                <div class="col-lg-6 col-xl-6">

                                    <p id="card-id-name"></p>

                                </div>

                            </div>



                            <div class="form-group row fv-plugins-icon-container mb-0">

                                <label class="col-xl-5 col-lg-5 col-form-label">Designation</label>

                                <div class="col-lg-1 col-xl-1">:</div>

                                <div class="col-lg-6 col-xl-6">

                                    <p id="card-id-designation"></p>

                                </div>

                            </div>

                            <div class="form-group row fv-plugins-icon-container mb-0">

                                <label class="col-xl-5 col-lg-5 col-form-label">Name of Entity</label>

                                <div class="col-lg-1 col-xl-1">:</div>

                                <div class="col-lg-6 col-xl-6">

                                    <p id="card-id-entity-name"></p>

                                </div>

                            </div>

                            <div class="form-group row fv-plugins-icon-container mb-0">

                                <label class="col-xl-5 col-lg-5 col-form-label">Entity Type</label>

                                <div class="col-lg-1 col-xl-1">:</div>

                                <div class="col-lg-6 col-xl-6">

                                    <p id="card-id-type"></p>

                                </div>

                            </div>

                            <div class="form-group row fv-plugins-icon-container mb-0">

                                <label class="col-xl-5 col-lg-5 col-form-label">Department</label>

                                <div class="col-lg-1 col-xl-1">:</div>

                                <div class="col-lg-6 col-xl-6">

                                    <p id="card-id-department"></p>

                                </div>

                            </div>

                            <div class="form-group row fv-plugins-icon-container mb-0">

                                <label class="col-xl-5 col-lg-5 col-form-label">Application Type</label>

                                <div class="col-lg-1 col-xl-1">:</div>

                                <div class="col-lg-5 col-xl-6">

                                    <p id="card-id-application-type"></p>

                                </div>

                            </div>

                            <div class="form-group row fv-plugins-icon-container mb-0">

                                <label class="col-xl-5 col-lg-5 col-form-label">Date of Issue</label>

                                <div class="col-lg-1 col-xl-1">:</div>

                                <div class="col-lg-5 col-xl-6">

                                    <p id="card-id-date-of-issue"></p>

                                </div>

                            </div>

                            {{-- <div class="form-group row fv-plugins-icon-container mb-0">

                                <label class="col-xl-5 col-lg-5 col-form-label">Valid Up to</label>

                                <div class="col-lg-1 col-xl-1">:</div>

                                <div class="col-lg-6 col-xl-6">

                                    <p id="card-id-valid-up-to"></p>

                                </div>

                            </div> --}}

                            <div class="form-group row fv-plugins-icon-container mb-0">

                                <label class="col-xl-5 col-lg-5 col-form-label">Mobile Number of pass holder</label>

                                <div class="col-lg-1 col-xl-1">:</div>

                                <div class="col-lg-6 col-xl-6">

                                    <p class="card-id-contact-no"></p>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="w-100 form-group">

                            <div class="checkbox-inline justify-content-between">

                                <label class="checkbox checkbox-inline mr-2">

                                {{ Form::checkbox('accept_term', true, null,['class' => 'your-custom-class']) }}

                                <span></span></label>

                                I hereby Solemnly affirm and declare that the information given herein above is true and correct to the best of my knowledge and belief and nothing has concealed therefrom.		

                            </div>

                        </div>

                        <div class="form-group w-100">

                            <label>Name of Authorized Signatory: *</label>

                            {!! Form::text('authorized_signatory', null, ['class' => 'form-control required', 'placeholder' => 'Authorized Signatory', 'maxlength' => '255','id'=> 'authorized_signatory']) !!}

                        </div>

                    </div>

                    {{-- <div class="row">

                        <div class="col-lg-6">

                            <div class="form-group">

                                <div class="checkbox-inline justify-content-between">

                                    <label class="checkbox checkbox-inline mr-2">

                                    {{ Form::checkbox('accept_term', true, null,['class' => 'your-custom-class']) }}

                                    <span></span></label>

                                    I hereby Solemnly affirm and declare that the information given herein above is true and correct to the best of my knowledge and belief and nothing has concealed therefrom.		

                                </div>

                            </div>

                        </div>

                        <div class="col-lg-6">

                            <div class="form-group">

                                <label>Name of Authorized Signatory: *</label>

                                {!! Form::text('authorized_signatory', null, ['class' => 'form-control required', 'placeholder' => 'Authorized Signatory', 'maxlength' => '255','id'=> 'authorized_signatory']) !!}

                            </div>

                        </div>

                    </div> --}}

                </div>

                

            </div>

            <div class="card-footer">

                <div class="row">

                    <!-- <div class="col-lg-5"></div> -->

                    <div class="col-lg-12 text-center">

                        <button id="special_entity_application_verify_and_submit_detail_submit_button" type="button" class="btn btn-primary mr-2">Save And Next</button>

                    </div>

                </div>

            </div>

        {!! Form::close() !!}

    </div>

</div>
