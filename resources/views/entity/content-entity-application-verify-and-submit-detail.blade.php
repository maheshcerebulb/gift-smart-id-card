<div class="tab-pane fade" id="entity-application-verify-and-submit-detail" role="tabpanel" aria-labelledby="tab-content-entity-application-verify-and-submit-detail">

    <div class="card card-custom card-custom-shadow">

        <div class="card-header custom-form-block-header">

            <h3 class="card-title">Verifications</h3>

        </div>

        {!! Form::open(['route' => 'entity.save-entity-application-verify-and-submit-detail', 'class' => 'form', 'id' => 'entity_application_verify_and_submit_detail_form']) !!}

            {!! Form::hidden('id', null, ['class' => 'entity-application-id']) !!}

            {!! Form::hidden('user_id', session::get('User.id'), ['class' => 'entity-application-user-id']) !!}



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

                            <div class="form-group row fv-plugins-icon-container mb-0">

                                <label class="col-xl-5 col-lg-5 col-form-label">Valid Up to</label>

                                <div class="col-lg-1 col-xl-1">:</div>

                                <div class="col-lg-6 col-xl-6">

                                    <p id="card-id-valid-up-to"></p>

                                </div>

                            </div>

                            <div class="form-group row fv-plugins-icon-container mb-0">

                                <label class="col-xl-5 col-lg-5 col-form-label">Mobile Number of pass holder</label>

                                <div class="col-lg-1 col-xl-1">:</div>

                                <div class="col-lg-6 col-xl-6">

                                    <p class="card-id-contact-no"></p>

                                </div>

                            </div>

                        </div>

                        

                    </div>

                    {{-- <div class="col-md-12 d-flex justify-content-around card-preview mb-5">

                        <div class="mx-auto">

                            <div class="text-center mb-10">

                                <p class="h5 font-weight-bolder">Front</p>

                            </div>

                            <div class="card-container background-image">

                                <div>

                                    <p class="header-text">GIFT Special Economic Zone (SEZ)</p>

                                    <p class="sub-header-text"><span id="card_type"></span> Identity Card</p>

                                    <p class="small-text">(Issued under Rule 70 of SEZ Rules, 2006)</p>

                                </div>



                                <div class="image-container">

                                    <img  id="card-id-preview-image" width="60" height="60" style="margin:5px 0px;" src="">

                                    <p class="officer-text">

                                        <span>Chetan Varma</span><br>

                                        <span>Specified Officer <br> GIFT-Special Economic Zone</span>

                                    </p>

                                </div>



                                <div class="table-container">

                                    <table style="color: #231F20;font-size: 8px;padding: 0px 10px;line-height:9px;width: -webkit-fill-available;">

                                        <tbody>

                                            <tr>

                                                <th style="text-align:left;width: 90px;">Serial Number</th>

                                                <td style="width: 5px;">:</td>

                                                <td width="100" id="card-id-application-number"></td>

                                            </tr>

                                            <tr>

                                                <th style="text-align:left;">Name of Passholder</th>

                                                <td>:</td>

                                                <td id="card-id-name"></td>

                                            </tr>

                                            <tr>

                                                <th style="text-align:left;">Designation</th>

                                                <td>:</td>

                                                <td id="card-id-designation"></td>

                                            </tr>

                                            <tr>

                                                <th style="text-align:left;">Name of Entity</th>

                                                <td>:</td>

                                                <td id="card-id-entity-name"></td>

                                            </tr>

                                            <tr>

                                                <th style="text-align:left;">Entity Type</th>

                                                <td>:</td>

                                                <td id="card-id-type"></td>

                                            </tr>

                                            <tr>

                                                <th style="text-align:left;">Date of Issue</th>

                                                <td>:</td>

                                                <td id="card-id-date-of-issue"></td>

                                            </tr>

                                            <tr>

                                                <th style="text-align:left;">Valid upto</th>

                                                <td>:</td>

                                                <td id="card-id-valid-up-to"></td>

                                            </tr>

                                            <tr>

                                                <td colspan="6" style="text-align:right;margin-right:0px;padding:0px;"><img width="45" height="45" id="card-id-qrcodeImage" src="" style="margin-top: 5px;border:2px solid white"></td>

                                            </tr>

                                        </tbody>

                                    </table>

                                </div>

                            </div>

                        </div>

                        <div class="mx-auto">

                            <div class="text-center mb-10">

                                <p class="h5 font-weight-bolder">Back</p>

                            </div>

                            <div class="card-container">

                                <p class="header-text">GIFT Special Economic Zone (SEZ)</p>

                                <p class="address-container">

                                    Villages - Phirozpur and Ratanpur<br>

                                    District - Gandhinagar-382355, State - Gujarat

                                </p>



                                <p class="instruction-container">General Instructions:</p>

                                <ul class="instruction-list">

                                    <li>This pass should be worn and displayed on the person of the pass holder while inside the Zone.</li>

                                    <li>This pass is not transferable</li>

                                    <li>This pass shall be produced on demand by GIFT SEZ Security and Customs staff</li>

                                    <li>The pass holder and his vehicle are liable for Security Check at the GIFT SEZ gate</li>

                                    <li>The loss of this pass shall immediately be reported to the Security Officer, GIFT SEZ</li>

                                    <li>This pass shall be surrendered to the Security Officer, GIFT SEZ through the Developer/Unit/Contractor on expiry or on the person becoming ineligible for this pass.</li>

                                </ul>



                                <p class="passholder-info">

                                    <span>Mobile No. of Passholder: </span><span class="card-id-contact-no"></span>

                                </p>

                            </div>

                        </div>

                    </div> --}}

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

                        <button id="entity_application_verify_and_submit_detail_submit_button" type="button" class="btn btn-primary mr-2">Save And Next</button>

                    </div>

                </div>

            </div>

        {!! Form::close() !!}

    </div>

</div>
