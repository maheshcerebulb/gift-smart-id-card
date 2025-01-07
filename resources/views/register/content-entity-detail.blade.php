<div class="tab-pane fade show active" id="entity-detail" role="tabpanel" aria-labelledby="tab-entity-detail">

    <div class="card card-custom card-custom-shadow">

        <div class="card-header custom-form-block-header">

            <h3 class="card-title">Entity Details:</h3>

        </div>

        {!! Form::open(['route' => 'users.save-basic-entity-detail', 'class' => 'form', 'id' => 'entity_detail_form', 'action-for' => 'add']) !!}

            {!! Form::hidden('is_entity_detail_valid', null, ['id' => 'is_entity_detail_valid']) !!}

            {!! Form::hidden('id', null, ['class' => 'entity-id']) !!}

            <div class="card-body row">

                <div class="col-lg-6">

                    <div class="form-group">

                        <div class="col-lg-10">

                            <label class="">Entity Category: *</label>

                            {!! Form::select('unit_category', array('' => '-- Select --', 'Developer' => 'Developer','Co-Developer' => 'Co-Developer', 'Unit' => 'Unit', 'Other' => 'Other'), null, array('class' => 'form-control','id' => 'unit_category')) !!}

                        </div>

                    </div>

                    <div class="form-group">

                        <div class="col-lg-10">

                            <label>Application No (Form F):</label>

                            {!! Form::text('request_id', null, ['class' => 'form-control required','id'=>'application_no', 'placeholder' => 'Application No', 'maxlength' => '100']) !!}

                        </div>

                    </div>



                    <div class="form-group">

                        <div class="col-lg-10">

                            <label class="">Constitution of Business: *</label>

                            {!! Form::select('constitution_of_business', array('' => '-- Select --', 'Limited' => 'Limited', 'Private Limited' => 'Private Limited', 'Limited Liability Partnership' => 'Limited Liability Partnership', 'Proprietorship' => 'Proprietorship','Other'=> 'Other'), null, array('class' => 'form-control','id' => 'constitution_of_business')) !!}

                        </div>

                    </div>

                    <div class="form-group" id="otherInput" style="display: none;">

                        <div class="col-lg-10">

                            <label class="">Other Constitution:</label>

                            {!! Form::text('other_constitution_of_business', null, array('class' => 'form-control','placeholder' => 'Other Constitution', )) !!}

                        </div>

                    </div>

                    <div class="form-group">

                        <div class="col-lg-10">

                            <label>Registration Number:</label>

                            {!! Form::text('registration_number', null, ['class' => 'form-control required', 'placeholder' => 'Registration Number', 'maxlength' => '100']) !!}

                        </div>

                    </div>

                    <div class="form-group">

                        <div class="col-lg-10">

                            <label>Permanent Account Number (PAN) : *</label>

                            {!! Form::text('pan_number', null, ['class' => 'form-control required', 'placeholder' => 'Permanent Account Number', 'maxlength' => '10']) !!}

                        </div>

                    </div>

                </div>

                <div class="col-lg-6">

                    <div class="form-group">

                        <div class="col-lg-10">

                            <label>Email Address: *</label>

                            {!! Form::text('email', null, ['class' => 'form-control required email', 'placeholder' => 'Email Address', 'maxlength' => '100']) !!}

                        </div>

                    </div>

                    <div class="form-group">

                        <div class="col-lg-10">

                            <label>Company Name: *</label>

                            {!! Form::text('company_name', null, ['class' => 'form-control required','id'=>'company_name', 'placeholder' => 'Company Name', 'maxlength' => config('constant.COMPANY_NAME_MAXLENGTH')]) !!}

                        </div>

                    </div>

                    <div class="form-group">

                        <div class="col-lg-10">

                            <label>Entity Tower Name in SEZ: * </label>

                            <button type="button" style="float: right;" class="btn btn-sm btn-primary d-flex align-items-center" id="add_address">+</button>



                            <select name="company_address" class="form-control required company_address-option">

                                <option value="">-- Select --</option>

                                @foreach($company_address as $key => $address)

                                    <option value="{{ $address->address }}" data-id="{{ $address->id }}">{{ $address->address }}</option>

                                @endforeach

                            </select>

                        </div>

                    </div>



                    <div class="form-group">

                        <div class="col-lg-11 row">

                            <div class="col-lg-6">

                                <label>Country: *</label>

                                <select name="company_country" class="form-control required country-option">

                                    <option value="">-- Select --</option>

                                    @foreach($country_lists as $country_id => $country_name)

                                        <option value="{{ $country_name }}" data-id="{{ $country_id }}">{{ $country_name }}</option>

                                    @endforeach

                                </select>

                            </div>

                            <div class="col-lg-6">

                                <label>State: *</label>

                                <select name="company_state" class="form-control required state-option"><option value="">-- Select --</option></select>

                            </div>

                        </div>

                    </div>

                    <div class="form-group">

                        <div class="col-lg-11 row">

                            <div class="col-lg-6">

                                <label>City: *</label>

                                <select name="company_city" class="form-control required city-option"><option value="">-- Select --</option></select>

                            </div>

                            <div class="col-lg-6">

                                <label>Pin Code: *</label>

                                {!! Form::text('company_pin_code', null, ['class' => 'form-control required', 'placeholder' => 'Pin Code', 'maxlength' => '15']) !!}

                            </div>

                        </div>

                    </div>



                </div>

            </div>

            <div class="card-footer">

                <div class="row">

                    <div class="col-lg-5"></div>

                    <div class="col-lg-7">

                        <button id="entity_detail_submit_button" type="button" class="btn btn-primary mr-2 job-detail-submit-btn">Save And Next</button>

                    </div>

                </div>

            </div>

        {!! Form::close() !!}

    </div>

</div>

<div class="modal fade" id="addresspopup" tabindex="-1" role="dialog" aria-labelledby="addresspopup" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title" id="exampleModalLabel">Add Address</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <i aria-hidden="true" class="ki ki-close"></i>

                </button>

            </div>

            {!! Form::open(['route' => 'common.add_address', 'class' => 'form', 'id' => 'add_address_form', 'action-for' => 'add']) !!}



                <div class="modal-body">

                    <div class="form-group row">

                        <label class="col-form-label text-right col-lg-3 col-sm-12">Address</label>

                        <div class="col-lg-9 col-md-9 col-sm-12">

                            <div class="input-group" data-z-index="6">

                                {!! Form::text('address', null, ['class' => 'form-control required', 'placeholder' => 'Address', 'maxlength' => '100','id' => 'address_input']) !!}



                            </div>

                        </div>

                    </div>                    

                </div>



                <div class="modal-footer">

                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>

                    <button type="submit" class="btn btn-primary font-weight-bold" id="add_address_submit_button">Save changes</button>

                </div>

                {!! Form::close() !!}

        </div>

    </div>

</div>



