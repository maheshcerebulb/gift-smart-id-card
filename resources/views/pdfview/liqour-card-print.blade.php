@extends('layouts.id-card')

@section('pageTitle', 'GIFT SEZ')

@section('content')

<style>

   @media print {

    @page

   {

    size: 5.5in 8.5in ;

    size: landscape;

  }

        .pagebreak { page-break-before: always; } /* page-break-after works, as well */

        

    }

</style>

{{-- {{dd($row)}} --}}

@php

    $row->name=$row->first_name.' '.$row->last_name;

@endphp







<div style="margin-top:0px;margin-bottom:0px;border:2px solid #B27938;height: 200px;width: 320px;box-sizing: border-box;overflow: hidden;position: relative;padding: 5px;float:left;margin:right:5px; border-radius:7px;">

    <div style="">

        <div style="padding:1px;">

            <div style="float: left;width:60px;padding:0px 5px;border-right:0.2px solid #9fa09e;">

                <img width="50" height="40" src="{{asset('img/gift_city_logo_svg.svg')}}">

            </div>

           

            <div style="float:left;text-align:left;padding:0px 5px;">

                <p style="padding-top:0pt;padding-left:0pt;margin:0px 0px;">

                    <span style="color:#B27938;font-size:20px;font-weight: 600;">

                       Liqour Access Permit

                    </span>

                </p>

                <p style="padding-top: 0pt;text-indent: 0pt;margin:0px;font-weight:bolder;">

                    <span style="font-size:6px;padding-top:0;font-weight:bold;color:#000000;">

                    Permit to consume liqour at F.LIII licence premises, GIFT CITY, Gandhinagar

                    </span>

                </p>



            </div>

        </div>

        <div style="width:100%;padding:5px 0px;display:flex;color:#000000;">

            <div style="float:left;width:250px;">

                <table style="color:#000000;font-size: 7px;padding: 0px 0px;line-height:10px;width:100%;font-weight: 500;">

                    <tbody>

                        <tr>

                            <th style="text-align:left;width:50%;">Name</th>

                            <td>:</td>

                            <td style="text-align:left;width:49%;font-weight: 500;">{{ \Illuminate\Support\Str::limit($row->name, 100) }}</td>

                        </tr>

                        <tr>

                            <th style="text-align:left;width:50%;">Designation</th>

                            <td>:</td>

                            <td style="text-align:left;width:49%;font-weight: 500;">{{ \Illuminate\Support\Str::limit($row->designation, 100) }}</td>

                        </tr>

                        <tr>

                            <th style="text-align:left;width:50%;">Company / Organization/ Unit Name and Address</th>

                            <td>:</td>

                            <td style="text-align:left;width:49%;font-weight: 500;">{{ \Illuminate\Support\Str::limit($row->company_name, 100) }}</td>

                        </tr>

                        <tr>

                            <th style="text-align:left;width:50%;">Validity</th>

                            <td>:</td>

                            <td style="width:49%;font-weight: 500;">{{ date('d/m/Y',strtotime($row->expire_date))}}</td>

                        </tr>

                    </tbody>

                </table>

            </div>

            <div style="margin:0px;padding:0px;color:#000000;flex: 1;">

                <p style="font-size: 7px;margin:2px 0px;">

                    <span ><span style="font-weight:bolder;">Sr. No. : </span><span >{{ !empty($row->serial_number) ? $row->serial_number : '' }}</span></span> 

                 </p>

                <div style="margin:0px;padding:0px;border-radius:7px;height:50px;width:50px;" >

                    <img width="50" height="50" src='{{ asset('upload/liqour-data/liqour-application/'.$row->image)}}' style="margin:0px;border:2px solid #B27938;border-radius:5px;">

                </div>

            </div>



        </div>

        <div style="padding:0px 0px;color:#000000;display: flex;">

            <div style="margin-right:0px;padding:0px;float:left;width:20%;align-self:center;">

                <img width="60" height="60" src='{{ asset('upload/liqour-data/liqour-application/qrcode/'.$row->qrcode)}}' style="padding:2px;">

            </div>

            <div style="align-self:center;margin-left:5px;margin-top:10px;margin-bottom:0px;width:80%;">   

                <table style="color: #000000;font-size: 7px;padding: 0px 0px;line-height:12px;width:100%;vertical-align:middle;">

                    <tbody>

                        <tr >

                            <th style="text-align:left;width:54%;">Name of Authorized Officer</th>

                            <td style="width: 1%;">:</td>

                            <td style="width:45%;font-weight: 500;">Nisarg Acharya</td>

                        </tr>

                        <tr>

                            <th style="text-align:left;width:54%;">Sign of Authorized Officer</th>

                            <td style="width: 1%;">:</td>

                            <td style="width:45%;">

                                <img width="50" height="30" src="{{ asset('img/nisarg_acharya_signature.png')}}">

                            </td>

                        </tr>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

<div class="pagebreak"> </div>

<div style="margin-top:0px;margin-bottom:0px;border:2px solid #B27938;height: 200px;width: 320px;box-sizing: border-box;overflow: hidden;position: relative;padding: 0px;border-radius:5px;">

    <div style="padding:0px 5px;">

        <p style="margin:0px;">

            <span style="color:#000000;font-weight: bold;font-size:10px;">

                General Instruction

            </span>

        </p>

    </div>

    <div style="border-top:0px;line-height:8px;color:#000000;padding-left:6px;font-size:7px;font-weight: 500;">

        <ul style="padding: 5px 5px 5px 8px;margin:0px;" class="custom-list">

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

    <div style="border-top:2px solid #B27938;height:45px;color:#000000;padding:0px 5px;">

        <table style="text-align:left;color: #000000;font-size: 7px;padding: 0px 0px;width:100%;padding:0px 5px;line-height: 10px;">

            <tbody>

                <tr style="font-size: 7px;">

                    <th style="text-align:left;width:20% !important;vertical-align:top;font-size: 7.5px;">Temporary Residential Address :</th>

                    <td style="text-align:left;vertical-align:top;font-size: 7.5px;font-weight: 500;">

                        <span style="word-wrap: break-word;">

                            {{ \Illuminate\Support\Str::limit($row->temporary_address, 160,'') }}

                        </span>

                    </td>

                </tr>

            </tbody>

        </table>

    </div>

    <div style="border-top:2px solid #B27938;height:45px;color:#000000;padding:0px 5px;">

        <table style="text-align:left;color: #000000;font-size: 7px !important;padding: 0px 0px;width:100%;padding:0px 5px;line-height: 10px;">

            <tbody>

                <tr>

                    <th style="text-align:left;width:20% !important;vertical-align:top;font-size: 7.5px;">Permanent Residential Address :</th>

                    <td style="text-align:left;vertical-align:top;font-size:7.5px;font-weight: 500;">

                        <span style="word-wrap: break-word;">

                            {{ \Illuminate\Support\Str::limit($row->permanent_address, 160,'') }}

                        </span>

                    </td>

                </tr>

            </tbody>

        </table>

    </div>

    

    <div style="border-top:2px solid #B27938;color:#000000;padding:0px 5px;">

        <table style="color: #000000;font-size: 7px;padding: 0px 0px;width:100%;padding:0px 5px;">

            <tbody>

                <tr>

                    <th style="text-align:left;width:42% !important;font-size: 7px;">Mobile No. of Permit Holder : </th>

                    <td style="font-size: 7px;font-weight: 500;">{{ !empty($row->dial_code) ? '+'.$row->dial_code.' ' : '' }}{{ $row->mobile_number }}</td>

                </tr>

            </tbody>

        </table>

    </div>

</div>