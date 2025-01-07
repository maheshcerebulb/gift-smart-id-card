<div class="tab-pane fade" id="entity-verify-and-submit-detail" role="tabpanel" aria-labelledby="tab-content-entity-verify-and-submit-detail">
    <div class="card card-custom card-custom-shadow">
        <div class="card-header custom-form-block-header">
            <h3 class="card-title">Verifications</h3>
        </div>
        {!! Form::open(['route' => 'users.save-entity-verify-and-submit-detail', 'class' => 'form', 'id' => 'entity_verify_and_submit_detail_form']) !!}
            {!! Form::hidden('id', null, ['class' => 'entity-id']) !!}
            <div class="card-body row">
                <div class="col-lg-12">
                    <div class="form-group mb-3">
                        <div class="checkbox-inline">
                            <label class="checkbox">
                            {{ Form::checkbox('accept_term', true, null) }}
                            <span></span>I hereby Solemnly affirm and declare that the information given herein above is true and correct to the best of my knowledge and belief and nothing has concealed therefrom.</label>			
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Name of Authorized Signatory: *</label>
                        {!! Form::text('authorized_signatory_name', null, ['class' => 'form-control col-lg-9 required', 'id' => 'authorized_signatory_name', 'placeholder' => 'Name of Authorized Signatory', 'maxlength' => '255', 'disabled' => true]) !!}
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Place: *</label>
                        {!! Form::text('authorized_person_place', null, ['class' => 'form-control col-lg-9 required', 'id' => 'authorized_person_place', 'placeholder' => 'Place', 'maxlength' => '255', 'disabled' => true]) !!}
                    </div>
                </div>
                <div class="col-lg-12 row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Designation/Status</label>
                            <br><label id="person_designation"></label>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <div class="form-group">
                                    <label>Date</label>
                                    <br><label>{{date('d/m/Y')}}</label>
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
                        <button id="entity_verify_and_submit_detail_submit_button" type="button" class="btn btn-primary mr-2">Save And Next</button>
                    </div>
                </div>
            </div>
        {!! Form::close() !!}
    </div>
</div>