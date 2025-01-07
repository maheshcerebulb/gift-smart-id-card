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



@if($row->type == 'Temporary')

        <div style="margin-top:0px;margin-bottom:0px;border:2px solid black;height: 204px;width: 320px;box-sizing: border-box;overflow: hidden;position: relative;padding: 5px;background:url({{asset('img/temporary_front_card.jpg')}});background-size:cover;float:left;">
@else

        <div style="margin-top:0px;margin-bottom:0px;border:2px solid black;height: 204px;width: 320px;box-sizing: border-box;overflow: hidden;position: relative;padding: 5px;background:url({{asset('img/front_card_bg.jpg')}});background-size:cover;float:left;">

@endif
        <div>

            <p style="padding-top:0pt;padding-left:0pt;text-align: center;margin: 3px 0px;">

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



        <div style="width:100%;padding:5px;display:flex;">

            <div style="float: left;width:80px;text-align:center;padding:0px;">

                <img width="60" height="60" style="margin:10px 0px;" src="{{asset('upload/entity-data/entity-application/'.$row->image)}}">

                <p style="text-align:center;margin:0px;margin-top:10px;">

                    <img width="60" height="20" src="{{ asset('img/officer_signature.png')}}">

                    <span style="color: #231F20;font-weight:bold;font-size:6px;text-transform:uppercase;">Chetan Varma </span><br>

                    <span style="color: #231F20;font-size:6px;">Specified Officer<br> GIFT-Special Economic Zone</span>

                </p>

            </div>



            <div style="height: 80px;max-height:80px;">

                <table style="color: #231F20;font-size: 7px;padding: 0px 0px;line-height:7px;width:100%;">

                    <tbody>

                        <tr>

                            <th style="text-align:left;text-transform:uppercase;width:95px;">Serial Number</th>

                            <td style="width:2px;">:</td>

                            <td>
                                @if ($row->type != 'Other')
                                    {{ $row->serial_no }}
                                @else
                                    {{ $row->final_special_serial_no }}
                                @endif</td>
                        </tr>

                        <tr>

                            <th style="text-align:left;text-transform:uppercase;">Name of Passholder</th>

                            <td>:</td>

                            <td style="text-transform:uppercase;">{{ $row->first_name.' '.$row->last_name }}</td>

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

                            <td colspan="6" style="text-align:right;margin-right:0px;padding:0px;"><img width="40" height="40" src='{{ asset('upload/qrcode/'.$row->qrcode)}}' style="border:2px solid white;"></td>

                        </tr> --}}

                    </tbody>

                </table>
                
            </div>
            <div>
                <table style="color: #231F20;font-size: 7px;padding: 0px 0px;line-height:7px;width:100%;margin-top:10px;">
                    <tr>
                        <td style="width: 9%;"></td>
                        <th style="text-align:left;width:40%;text-transform:uppercase;">Sign of Card Holder</th>
                        <td style="width:1%;">:</td>

                        <td style="text-align:left;text-transform:uppercase;height:20px;width:50px;background-color:#ffffff;border-radius:5px;box-shadow: inset 0 0 10px rgba(0,0,0,0.5);width:30%;
                        ">
                            <img width="50" height="20" src="{{asset('upload/entity-data/entity-application/'.$row->signature)}}" style="border-radius:5px;box-shadow: inset 0 0 10px rgba(0,0,0,0.5);
                            ">
                        </td>
                        <td style="width:20%;"></td>
                    </tr>
                </table>
            </div>
        </div>

    </div>




