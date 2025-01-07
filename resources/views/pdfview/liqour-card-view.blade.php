
@extends('layouts.id-card')
@section('pageTitle', 'GIFT SEZ')
@section('content')

<style>
    .permit-container {
    margin-top: 0px;
    margin-bottom: 0px;
    border: 2px solid #B27938;
    height: 200px;
    width: 320px;
    box-sizing: border-box;
    overflow: hidden;
    position: relative;
    padding: 5px;
    float: left;
    margin-right: 5px;
    border-radius: 7px;
}

.logo-container {
    float: left;
    width: 60px;
    padding: 0px 5px;
    border-right: 0.2px solid #9fa09e;
}

.logo-container img {
    width: 50px;
    height: 40px;
}

.permit-details {
    float: left;
    text-align: left;
    padding: 0px 5px;
}

.main-title {
    color: #B27938;
    font-size: 20px;
    margin-bottom: 0px;
}

.sub-text {
    font-size: 6px;
    padding-top: 0;
    font-weight: bold;
    color: #000000;
    margin-bottom: 0px;
}

.details-table {
    width: 100%;
    padding: 5px 0px;
    display: flex;
    color: #000000;
    font-size: 7px !important;
}

.personal-info {
    float: left;
    width: 250px;
}

.personal-info table {
    color: #000000;
    font-size: 7px;
    padding: 0px;
    line-height: 10px;
    width: 100%;
}

.image-container {
    margin: 0px;
    padding: 0px;
    color: #000000;
    flex: 1;
    font-size: 7px;
}

.image-container img {
    margin: 0px;
    padding: 0px;
    border-radius: 7px;
    height: 50px;
    width: 50px;
    border: 2px solid #B27938;
}

.qr-code-container {
    margin-right: 0px;
    padding: 0px;
    float: left;
    width: 20%;
    align-self: center;
}

.qr-code-container img {
    width: 60px;
    height: 60px;
    padding: 2px;
}

.officer-details {
    align-self: center;
    margin-left: 5px;
    margin-top: 10px;
    margin-bottom: 0px;
    width: 80%;
}

.officer-details table {
    color: #000000;
    font-size: 9px;
    padding: 0px 0px;
    line-height: 12px;
    width: 100%;
    vertical-align: middle;
}


.general-instruction-container {
    margin-top: 0px;
    margin-bottom: 0px;
    border: 2px solid #B27938;
    height: 200px;
    width: 320px;
    box-sizing: border-box;
    overflow: hidden;
    position: relative;
    padding: 0px;
    border-radius: 5px;
}

.instruction-header {
    padding: 0px 5px;
}

.instruction-title {
    color: #000000;
    font-weight: bold;
    font-size: 12px;
}

.instructions-list {
    border-top: 0px;
    line-height: 10px;
    color: #000000;
    padding-left: 5px;
    font-size: 7px;
    font-weight: 500;
}

.custom-list {
    padding: 0px 5px 5px 10px;
    margin: 0px;
}

.address-container {
    border-top: 2px solid #B27938;
    height: 40px;
    color: #000000;
    font-size: 7px;
    padding: 0px 5px;
}

.address-table {
    color: #000000;
    font-size: 7px;
    width: 100%;
    padding: 5px;
    line-height: 10px;
}


.mobile-number-container {
    border-top: 2px solid #B27938;
    color: #000000;
    padding: 0px 5px;
}

.mobile-number {
    color: #000000;
    font-size: 7px;
    padding: 0px 0px;
    width: 100%;
    padding: 0px 5px;
    line-height: 9px;
}


</style>

<div class="permit-container">
    <div class="logo-container">
        <img src="{{asset('img/gift_city_logo_svg.svg')}}" width="50" height="40">
    </div>
    <div class="permit-details">
        <p class="main-title">Liquor Access Permit</p>
        <p class="sub-text">Permit to consume liquor at F.LIII license premises, GIFT CITY, Gandhinagar</p>
    </div>
    <div class="details-table">
        <div class="personal-info">
            <table class="personal-info-table">
                <tbody>
                    <tr>
                        <th style="text-align:left;width:39%;">Name</th>
                        <td>:</td>
                        <td style="text-align:left;width:60%;">{{ \Illuminate\Support\Str::limit($row->name, 100) }}</td>
                    </tr>
                    <tr>
                        <th style="text-align:left;width:39%;">Designation</th>
                        <td>:</td>
                        <td style="text-align:left;width:60%;">{{ \Illuminate\Support\Str::limit($row->designation, 100) }}</td>
                    </tr>
                    <tr>
                        <th style="text-align:left;width:39%;">Company / Organization/ Unit Name and Address</th>
                        <td>:</td>
                        <td style="text-align:left;width:60%;">{{ \Illuminate\Support\Str::limit($row->company_name, 100) }}</td>
                    </tr>
                    <tr>
                        <th style="text-align:left;width:39%;">Validity</th>
                        <td>:</td>
                        <td style="width:60%;">{{ date('d/m/Y',strtotime($row->expire_date))}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="image-container">
            <p><span class="font-weight-bolder">Sr. No. :</span>{{ $row->serial_number }}</p>
            <div>
                <img src="{{ asset('upload/liqour-data/liqour-application/'.$row->image)}}" width="50" height="50">
            </div>
        </div>
    </div>
    <div style="width: 100%;display:flex;">
        <div class="qr-code-container">
            <img src="{{ asset('upload/liqour-data/liqour-application/qrcode/'.$row->qrcode)}}" width="60" height="60">
        </div>
        <div class="officer-details">
            <table style="font-size:7px;">
                <tbody>
                    <tr>
                        <th style="text-align:left;width: 48%;">Name of Authorized Officer</th>
                        <td>:</td>
                        <td style="width: 51%;">Nisarg Acharya</td>
                    </tr>
                    <tr>
                        <th style="text-align:left;width: 48%;">Signature of Authorized Officer</th>
                        <td>:</td>
                        <td style="width: 51%;">
                            <img width="60" height="30" src="{{ asset('img/nisarg_acharya_signature.png')}}">
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    
</div>

<div class="pagebreak"></div>

<div class="general-instruction-container">
    <div class="instruction-header">
        <p class="mb-0"><span class="instruction-title">General Instruction</span></p>
    </div>
    <div class="instructions-list">
        <ul class="custom-list">
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
    <div class="address-container">
        <table class="address-table">
            <tbody>
                <tr style="vertical-align: text-top;">
                    <th style="text-align:left;width:15%;">Temporary Residential Address</th>
                    <td>:</td>
                    <td style="width:84%;">{{ \Illuminate\Support\Str::limit($row->temporary_address, 150) }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="address-container">
        <table class="address-table">
            <tbody>
                <tr style="vertical-align: text-top;">
                    <th style="text-align:left;width:15%;">Permanent Residential Address</th>
                    <td >:</td>
                    <td style="width:84%;">{{ \Illuminate\Support\Str::limit($row->permanent_address, 150) }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="mobile-number-container">
        <table class="mobile-number">
            <tbody>
                <tr style="vertical-align: text-top;">
                    <th style="text-align:left;width:33%;">Mobile No. of Permit Holder</th>
                    <td style="width: 1%;">:</td>
                    <td style="">{{ $row->mobile_number }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
