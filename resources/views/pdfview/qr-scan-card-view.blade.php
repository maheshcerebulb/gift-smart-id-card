@extends('layouts.id-card')

@section('pageTitle', 'GIFT SEZ')

@section('content')

@php

    if($row->application_type == 0)

    {

        $row->application_type = 'New';

    }

    else if($row->application_type == 1)

    {

        $row->application_type = 'Renew';

    }

    if($row->application_type == 2)

    {

        $row->application_type = 'Surrender';

    }

@endphp



<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12" style="flex:1;">

@if($row->type == 'Temporary')

    <div style="margin-top:0px;margin-right:0px;margin-bottom:0px;border:2px solid black;height: 204px;width: 320px;box-sizing: border-box;overflow: hidden;position: relative;padding: 5px;background:url({{asset('img/temporary_front_card.jpg')}});background-size:cover;float:left;">
@else
    <div style="margin-top:0px;margin-right:0px;margin-bottom:0px;border:2px solid black;height: 204px;width: 320px;box-sizing: border-box;overflow: hidden;position: relative;padding: 5px;background:url({{asset('img/front_card_bg.jpg')}});background-size:cover;float:left;">
@endif
        <div>

            <p style="padding-top:0pt;padding-left:0pt;text-align: center;margin: 0px 0px;">

                <span style="color:#092752;font-weight: bold;font-size:16px;">

                    GIFT Special Economic Zone (SEZ)

                </span>

            </p>

            <p style="padding-top: 0pt;text-indent: 0pt;text-align: center;margin:0px;">

                <span style="color:#092752;font-weight:bold;font-size:12px;padding-top:0;">
                    @if ($row->type != 'Other')
                        {{ !empty($row->type) && $row->type == 'Temporary' ? 'Temporary' : 'Permanent' }} 
                    @endif
                    Identity Card

                </span>

            </p>

            <p style="padding-top: 0pt;text-indent: 0pt;text-align: center;margin:0px;">

                <span style="color:#092752;font-size:7px;">

                    (Issued under Rule 70 of SEZ Rules, 2006)

                </span>

            </p>

        </div>

        <div>

            <div style="width:100%;padding:5px;display:flex;">

                <div style="align-self:center;height: fit-content;">

                    <img width="55" height="55" src="{{ asset('upload/entity-data/entity-application/'.$row->image)}}">

                </div>

                <div style="flex:1;margin-left: 10px;">

                    <table style="color: #231F20;font-size: 7px;padding: 0px 0px;line-height:9px;width -webkit-fill-available;font-weight: 500;">

                        <tbody>

                            <tr>

                                <th style="text-align:left;text-transform:uppercase;width:90px;">Serial Number</th>

                                <td  style="width:2px;">:</td>

                                <td style="text-transform:uppercase;">
                                    @if ($row->type != 'Other')
                                        {{ $row->serial_no }}
                                    @else
                                        {{ $row->final_special_serial_no }}
                                    @endif
                                </td>

                            </tr>

                            <tr>

                                <th style="text-align:left;text-transform:uppercase;">Name of Passholder</th>

                                <td>:</td>

                                <td style="text-transform:uppercase;">{{ $row->first_name.' '.$row->last_name}}</td>

                            </tr>

                            <tr>

                                <th style="text-align:left;text-transform:uppercase;">Designation</th>

                                <td>:</td>

                                <td style="text-transform:uppercase;">{{ $row->designation}}</td>

                            </tr>

                            <tr>

                                <th style="text-align:left;text-transform:uppercase;">Name of Entity</th>

                                <td>:</td>

                                @if ($row->type != 'Other')
                                <td style="text-transform:uppercase;">{{$row->entity_name}}</td>
                                @else
                                    <td style="text-transform:uppercase;">{{$row->other_entity}}</td>
                                @endif

                            </tr>

                            @if ($row->type != 'Other')
                                <tr>
                                    <th style="text-align:left;text-transform:uppercase;">Entity Category</th>
                                    <td>:</td>
                                    <td style="text-transform:uppercase;">{{$row->entity_type}}</td>
                                </tr>
                            @else
                                <tr>
                                    <th style="text-align:left;text-transform:uppercase;">Department</th>
                                    <td>:</td>
                                    <td style="text-transform:uppercase;">{{$row->department}}</td>
                                </tr>
                            @endif

                            <tr>

                                <th style="text-align:left;text-transform:uppercase;">Date of Issue</th>

                                <td>:</td>

                                <td>{{date('d-m-Y',strtotime($row->issue_date))}}</td>

                            </tr>

                            @if ($row->type != 'Other')
                            <tr>

                                <th style="text-align:left;text-transform:uppercase;">Valid upto</th>

                                <td>:</td>

                                <td>{{date('d-m-Y',strtotime($row->expire_date))}}</td>

                            </tr>
                            @else
                            <tr>

                                <th style="text-align:left;text-transform:uppercase;">Valid upto</th>

                                <td>:</td>

                                <td>Till posting in SEZ</td>

                            </tr>
                            @endif

                            {{-- <tr style="float:right;">

                                <td colspan="6" style="text-align:right;margin-right:0px;padding:0px;"><img width="40" height="40" src='{{asset('upload/qrcode/'.$row->qrcode)}}' style="border:2px solid white;"></td>

                            </tr> --}}

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

        <div style="display:flex">

            <div style="text-align:center;">

                <img width="60" height="20" src="{{ asset('img/officer_signature.png')}}">

                <p style="text-align:center;margin:0px;">
                    <span style="color: #231F20;font-weight:bold;font-size:7px;text-transform:uppercase;">Chetan Varma </span><br>

                    <span style="color: #231F20;font-size:6px;">Specified Officer<br> GIFT-Special Economic Zone</span>

                </p>

            </div>
            <div style="flex: 1">
                <table style="color: #231F20;font-size: 7px;padding: 0px 0px;line-height:7px;width:100%;margin-top:10px;">
                    <tr>
                        <td style="width: 5%;"></td>
                        <th style="text-align:left;width:22%;text-transform:uppercase;">Sign of Card Holder</th>
                        <td style="width:1%;">:</td>

                        <td style="width:10%;    background-color: white;
                        ">
                            <img width="50" height="20" src="{{asset('upload/entity-data/entity-application/'.$row->signature)}}" style="">
                        </td>
                        <td style="width:10%;"></td>
                    </tr>
                </table>
            </div>

        </div>

    </div>
</div>

<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12" style="flex:1;">

   <div style="border:2px solid black;height: 204px;width: 320px;box-sizing: border-box;overflow: hidden;position: relative;padding: 5px; ">

        <div style="text-align:center;">

            <img width="70" height="70" src='{{ asset('upload/qrcode/'.$row->qrcode)}}' style="border:2px solid white;text-center;">

        </div>

        <p style="padding-top:2pt;text-indent: 0pt;text-align:left;margin:5px;">

            <span style="color: #231F20;font-weight: bold;border-bottom: 1px solid;font-size:8px;">

                General Instructions:

            </span>

        </p>

        <ul style="padding: 0px 0 0 20px;font-size:6.5px;margin-bottom: 5px;">

            <li> This pass should be worn and displayed on the person of the pass holder while inside the Zone.</li>

            <li> This pass is not transferable</li>

            <li> This pass shall be produced on demand by GIFT SEZ Security and Customs staff</li>

            <li> The pass holder and his vehicle are liable for Security Check at the GIFT SEZ gate</li>

            <li> The loss of this pass shall immediately be reported to the Security Officer, GIFT SEZ</li>

            <li> This pass shall be surrendered to the Security Officer, GIFT SEZ through the Developer/Unit/Contractor on expiry or on the person becoming ineligible for this pass.</li>

        </ul>

        <p style="padding-left: 9pt;text-align: left;font-size: 7px;margin:0px;">

            <span style="color:#231F20;font-weight:bold;text-transform:uppercase;">

                Mobile No. of Passholder:

            </span>

            <span style="color: #231F20;text-transform:uppercase;">{{ !empty($row->dial_code) ? '+'.$row->dial_code.' ' : '' }}{{ $row->mobile_number }}</span>

        </p>

    </div>

</div>



