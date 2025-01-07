<style>

    .rounded-image {

        border-radius: 10px; /* Apply border-radius to specific img tags */

    }

    .font-{font-weight: bold}



    .card-front-table

    {

        color:#000000;

        font-size:8px;
        padding: 0px 0px;

        line-height:12px;
        word-break: break-all;
        width:100%;

    }

    .card-front-table .th-th {

        text-align: left;
        word-break: break-all;
        width: 43%;

    }



    .card-front-table .td-td {

        width: 55%;
        word-break: break-word;
        text-align: left;
        line-break: strict !important;
        max-height: calc(5px * 2); /* Assuming each line is 5px high */
        overflow: hidden;
        text-overflow: ellipsis;
        font-weight: 500;
        

    }





    .card-auth-table

    {

        color: #000000;
        font-size: 8px;
        /* line-height: 0.1px; */
        margin-left:5px;margin-top:10px;
        flex: 1;
    }

    .card-auth-table .th-th-1, .card-auth-table .td-td-1 {

        text-align: left;

    }



    .card-auth-table .th-th-1 {

        width: 50%;

    }



    .card-auth-table .td-td-1 {

        width: 49%;

    }



    .card-auth-table .td-td-1 img {

        width: 40px;

        height: 30px;

    }

    ul.custom-list {

        padding: 0px 4px 4px 3px;

        margin: 0px;

        color:#000000;
        font-weight: 600;
        }

        ul.custom-list li {

        list-style-image: url('{{asset('img/bullet.svg')}}');

        font-size:6px;

        }

        .styled-div {

        border-top: 2px solid #B27938;

        line-height: 10px;
        height: 42px !important;

        color: #000000;
        padding: 0px 5px;

        }



        .styled-div table {

        text-align: left;

        color: #000000;

        font-size: 8px;

        /* padding: 0px 1px; */

        width: 100%;

        }



        .styled-div th {

        text-align: left;

        width: 18% !important;

        vertical-align: top;

        font-size: 8px;

        color: #000000;

        }



        .styled-div td {

        text-align: left;

        vertical-align: top;

        font-size: 8px;

        white-space: pre-line;
        font-weight: 500;

        }



        .styled-div span {

        word-wrap: break-word;

        color: #000000;

        }

        table tr th{font-weight: bold}

</style>
<div class="tab-pane fade" id="liqour-application-verify-and-submit-detail" role="tabpanel" aria-labelledby="tab-liqour-application-verify-and-submit-detail">

    <div class="card card-custom card-custom-shadow">

        <div class="card-header custom-form-block-header">

            <h3 class="card-title">Verifications</h3>

        </div>

        {!! Form::open(['route' => 'liqour.save-liqour-application-verify-and-submit-detail', 'class' => 'form', 'id' => 'liqour_application_verify_and_submit_detail_form']) !!}

            {!! Form::hidden('id', null, ['class' => 'liqour-application-id']) !!}

            {!! Form::hidden('user_id', session::get('User.id'), ['class' => 'liqour-application-user-id']) !!}



            <div class="card-body">

                <div class="row">

                    <div class="col-md-12">

                        <h5 class="text-dark font-weight-bold mb-10">ID Card Details:</h5>

                    </div>
                </div>

                <div class="row">
                    <div class="col-xxl-6 col-xl-6 col-lg-12">

                        <!--begin::Wizard Step 1-->

                        <div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current">

                            <!--begin::Group-->

                            

                            <!--end::Group-->

                            <!--begin::Group-->

                            

                            <!--end::Group-->

                            <!--begin::Group-->

                            <div class="form-group row fv-plugins-icon-container mb-0">

                                <label class="col-xl-5 col-lg-5 col-form-label">Name of Passholder</label>

                                <div class="col-lg-1 col-xl-1">:</div>

                                <div class="col-lg-6 col-xl-6">

                                    <p id="card-id-liqour-name"></p>

                                </div>

                            </div>



                            <div class="form-group row fv-plugins-icon-container mb-0">

                                <label class="col-xl-5 col-lg-5 col-form-label">Designation</label>

                                <div class="col-lg-1 col-xl-1">:</div>

                                <div class="col-lg-6 col-xl-6">

                                    <p id="card-id-liqour-designation"></p>

                                </div>

                            </div>

                            <div class="form-group row fv-plugins-icon-container mb-0">

                                <label class="col-xl-5 col-lg-5 col-form-label">Company Name</label>

                                <div class="col-lg-1 col-xl-1">:</div>

                                <div class="col-lg-6 col-xl-6">

                                    <p id="card-id-liqour-company-name"></p>

                                </div>

                            </div>

                            <div class="form-group row fv-plugins-icon-container mb-0">

                                <label class="col-xl-5 col-lg-5 col-form-label">Temporary Address</label>

                                <div class="col-lg-1 col-xl-1">:</div>

                                <div class="col-lg-6 col-xl-6">

                                    <p id="card-id-liqour-temporary-address"></p>

                                </div>

                            </div>

                            <div class="form-group row fv-plugins-icon-container mb-0">

                                <label class="col-xl-5 col-lg-5 col-form-label">Permanent Address</label>

                                <div class="col-lg-1 col-xl-1">:</div>

                                <div class="col-lg-6 col-xl-6">

                                    <p id="card-id-liqour-permanent-address"></p>

                                </div>

                            </div>

                            

                            <div class="form-group row fv-plugins-icon-container mb-0">

                                <label class="col-xl-5 col-lg-5 col-form-label">Date of Issue</label>

                                <div class="col-lg-1 col-xl-1">:</div>

                                <div class="col-lg-5 col-xl-6">

                                    <p id="card-id-liqour-date-of-issue"></p>

                                </div>

                            </div>

                            <div class="form-group row fv-plugins-icon-container mb-0">

                                <label class="col-xl-5 col-lg-5 col-form-label">Valid Up to</label>

                                <div class="col-lg-1 col-xl-1">:</div>

                                <div class="col-lg-6 col-xl-6">

                                    <p id="card-id-liqour-valid-up-to"></p>

                                </div>

                            </div>

                            <div class="form-group row fv-plugins-icon-container mb-0">

                                <label class="col-xl-5 col-lg-5 col-form-label">Mobile Number of pass holder</label>

                                <div class="col-lg-1 col-xl-1">:</div>

                                <div class="col-lg-6 col-xl-6">

                                    <p class="card-id-liqour-contact-no"></p>

                                </div>

                            </div>

                        </div>
                    </div>

                    <div class="col-xxl-6 col-xl-6 col-lg-12">
                        <div class="row">
                            <div class="col-xxl-12 col-xl-12 col-md-12 d-xl-block d-flex justify-content-around card-preview mb-5">
                                <div style="margin-top:0px;margin-bottom:0px;border:2px solid #B27938;height: 200px;width: 320px;box-sizing: border-box;overflow: hidden;position: relative;padding: 5px;float:left;margin:right:5px; border-radius:5px;">
                                        <div style="float: left;width:50px;padding:0px 1px;border-right:0.2px solid #9fa09e;">
                            
                                            <img width="50" height="40" src="{{asset('img/gift_city_logo_svg.svg')}}">
                            
                                        </div>
                                
                                        <div style="float:left;text-align:left;padding:7px;line-height:12px;">
                            
                                            <p style="padding-top:0pt;padding-left:0pt;margin:0px 0px;font-weight:bold;">
                            
                                                <span style="color:#B27938;font-weight: bold;font-size:22px;">
                            
                                                    Liquor Access Permit
                            
                                                </span>
                            
                                            </p>
                            
                                            <p style="padding-top: 0pt;text-indent: 0pt;margin:0px;font-weight:bold;">
                            
                                                <span style="font-size:6px;padding-top:0;font-weight:bolder;color:#000000;">
                            
                                                Permit to consume liquor at F.LIII licence premises, GIFT CITY, Gandhinagar
                            
                                                </span>
                            
                                            </p>
                            
                                            {{-- <p style="padding-top: 0pt;text-indent: 0pt;margin:0px;">
                            
                                                <span style="color:#092752;font-size:7px;">
                            
                                                    Gift City, Gandhinagar
                            
                                                </span>
                            
                                            </p> --}}
                            
                                        </div>
                                
                                
                                        <div style="width:100%;padding:0px 0px;display:flex;padding-top:5px;color:#000000;height:85px;">
                                
                                            <div style="float:left;width:255px;">
                                
                                                <table style="" class="card-front-table">
                                
                                                    <tbody>
                                
                                                        <tr>
                                
                                                            <th class="th-th">Name</th>
                                
                                                            <td>:</td>
                                
                                                            <td class="td-td card-id-liqour-name"></td>
                                
                                                        </tr>
                                
                                                        <tr>
                                
                                                            <th class="th-th">Designation</th>
                                
                                                            <td>:</td>
                                
                                                            <td  class="td-td card-id-liqour-designation"></td>
                                
                                                        </tr>
                                
                                                        <tr>
                                
                                                            <th class="th-th">Company/ Organization/ Unit Name and Address</th>
                                
                                                            <td>:</td>
                                
                                                            <td  class="td-td card-id-liqour-company-name"></td>
                                
                                                        </tr>
                                
                                                        <tr>
                                
                                                            <th class="th-th">Validity</th>
                                
                                                            <td>:</td>
                                
                                                            <td  class="td-td card-id-liqour-valid-up-to"></td>
                                
                                                        </tr>
                                
                                                    </tbody>
                                
                                                </table>
                                
                                            </div>
                                
                                            <div style="margin:0px;padding:0px;color:#000000;">
                                
                                                <p style="font-size: 6px;margin:1px 0px;">
                                
                                                    <span ><span style="font-weight:bold;">Sr. No. : </span><span class="card-id-liqour-serial-number"></span></span> 
                                
                                                 </p>
                                
                                                <div style="margin:0px;padding:0px;border-radius:3px;border:2px solid #B27938;height:50px;width:50px;" >
                                
                                                    <img width="46" height="46" src='' style="margin:0px;" id="card-id-liqour-person-image">
                                
                                                </div>
                                
                                            </div>
                                
                                
                                
                                           
                                
                                        </div>
                                
                                        <div style="padding:0px 0px;color:#000000;">
                                
                                            {{-- <div style="margin-right:0px;padding:0px;float:left;width:22%;align-self:center;">
                                
                                                <img width="60" height="60" src='{{ asset('upload/liqour-data/liqour-application/qrcode/')}}' style="padding:2px;">   
                                
                                            </div> --}}
                                
                                            <div class="d-flex">
                                                <img width="60" height="60" src='' style="padding:2px;" id="card-id-liqour-qrcodeImage">   
                                
                                                <table  class="card-auth-table">
                                
                                                    <tbody>
                                
                                                        <tr>
                                
                                                            <th class="th-th-1">Name of Authorized Officer</th>
                                
                                                            <td style="width: 1%;">:</td>
                                
                                                            <td class="td-td-1">Nisarg Acharya</td>
                                
                                                        </tr>
                                
                                                        <tr>
                                
                                                            <th class="th-th-1">Sign of Authorized Officer</th>
                                
                                                            <td style="width: 1%;">:</td>
                                
                                                            <td class="td-td-1">
                                
                                                                <img width="35" height="25" src="{{ asset('img/nisarg_acharya_signature.png')}}" >
                                
                                                            </td>
                                
                                                        </tr>
                                
                                                    </tbody>
                                
                                                </table>
                                
                                            </div>
                                
                                        </div>
                                
                                </div>
        
                            </div>
                            <div class="col-xxl-12 col-xl-12 col-md-12">
                                <div style="margin-top:0px;margin-bottom:0px;border:2px solid #B27938;height: 200px;width: 320px;box-sizing: border-box;overflow: hidden;position: relative;padding: 0px;border-radius:5px;">

                                    <div style="padding:0px 5px;">
                                
                                        <p style="margin:0px;">
                                
                                            <span style="color:#000000;font-weight: bold;font-size:12px;">
                                
                                                General Instruction
                                
                                            </span>
                                
                                        </p>
                                
                                    </div>
                                
                                    <div style="border-top:0px;color:#000000;padding-left:12px;">
                                
                                        <ul  class="custom-list">
                                
                                            <li> This permit should be displayed while entering the Wine and Dine Facility Area 
                                
                                                holding F. L. III license in GIFT City.</li>
                                
                                            <li> This permit is not transferable.</li>
                                
                                            <li> This permit shall be produced on demand by concerned officials.</li>
                                
                                            <li> The loss of this permit shall immediately be reported to the Issuing Authority.</li>
                                
                                            <li> The Card holder is bound to follow the provisions of the Gujarat Prohibition Act, 
                                
                                                1949, the rules, regulations and orders made thereunder and conditions. Any 
                                
                                                breach thereof by the Card holder shall be dealt with in accordance with 
                                
                                                provisions of law.
                                
                                            </li>
                                
                                        </ul>
                                
                                    </div>
                                
                                    <div class="styled-div">
                                
                                        <table>
                                
                                            <tbody>
                                
                                                <tr>
                                
                                                    <th>Temporary Residential Address :</th>
                                
                                                    <td class="card-id-liqour-temporary-address">
                                
                                                    </td>
                                
                                                </tr>
                                
                                            </tbody>
                                
                                        </table>
                                
                                    </div>
                                
                                    
                                
                                    <div class="styled-div">
                                
                                        <table>
                                
                                            <tbody>
                                
                                                <tr>
                                
                                                    <th>Permanent Residential Address :</th>
                                
                                                    <td class="card-id-liqour-permanent-address">
                                
                                                        
                                
                                                    </td>
                                
                                                </tr>
                                
                                            </tbody>
                                
                                        </table>
                                
                                    </div>
                                
                                    
                                
                                    <div style="border-top:2px solid #B27938;color:#000000;padding:0px 5px;">
                                
                                        <table style="color: #000000;font-size: 8px;padding:0px 5px;width:100%;">
                                
                                            <tbody>
                                
                                                <tr>
                                
                                                    <th style="text-align:left;width:40% !important;font-size: 8px;color: #000000;">Mobile No. of Permit Holder : </th>
                                
                                                    <td style="font-size: 8px;color: #000000;" class="card-id-liqour-contact-no"></td>
                                
                                                </tr>
                                
                                            </tbody>
                                
                                        </table>
                                
                                    </div>
                                
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

                                    <p class="sub-header-text"><span id="card_type"></span> Id Card</p>

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

                                                <td id="card-id--name"></td>

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

                <div class="row">

                    <div class="col-md-12">

                        {{-- <div class="w-100 form-group">

                            <div class="checkbox-inline">

                                <label class="checkbox checkbox-inline mr-2">

                                {{ Form::checkbox('accept_term', true, null,['class' => 'your-custom-class']) }}

                                <span></span></label>

                                I hereby Solemnly affirm and declare that the information given herein above is true and correct to the best of my knowledge and belief and nothing has concealed therefrom.		

                            </div>

                        </div> --}}

                        {{-- <div class="form-group w-100">

                            <label>Name of Authorized Signatory: *</label>

                            {!! Form::text('authorized_signatory', null, ['class' => 'form-control required', 'placeholder' => 'Authorized Signatory', 'maxlength' => '255','id'=> 'authorized_signatory']) !!}

                        </div> --}}

                    </div>

                </div>

            </div>

            <div class="card-footer">

                <div class="row">

                    <!-- <div class="col-lg-5"></div> -->

                    <div class="col-lg-12 text-center">

                        <button id="liqour_application_verify_and_submit_detail_submit_button" type="button" class="btn btn-primary mr-2">Save And Next</button>

                    </div>

                </div>

            </div>

        {!! Form::close() !!}

    </div>

</div>