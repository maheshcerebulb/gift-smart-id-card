



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
        

    }





    .card-auth-table

    {

        color: #000000;
        font-size: 8px;

        padding: 0px 0px;

        line-height:0.1px;

        width:100%;;

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

</style>

<div style="margin-top:0px;margin-bottom:0px;border:2px solid #B27938;height: 200px;width: 320px;box-sizing: border-box;overflow: hidden;position: relative;padding: 5px;float:left;margin:right:5px; border-radius:5px;">

    <div style="">

        <div style="pedding:1px;">

            <div style="float: left;width:50px;padding:0px 1px;border-right:0.2px solid #9fa09e;">

                <img width="50" height="40" src="{{asset('img/gift_city_logo_svg.svg')}}">

            </div>

            <div style="float:left;text-align:left;padding:10px 10px;line-height:10px;">

                <p style="padding-top:0pt;padding-left:0pt;margin:0px 0px;font-weight:bold;">

                    <span style="color:#B27938;font-weight: bold;font-size:22px;">

                       Liquor Access Permit

                    </span>

                </p>

                <p style="padding-top: 0pt;text-indent: 0pt;margin:0px;font-weight:bold;">

                    <span style="font-size:6px;padding-top:0;font-weight:300;color:#000000;">

                    Permit to consume liquor at F.LIII licence premises, GIFT CITY, Gandhinagar

                    </span>

                </p>

                {{-- <p style="padding-top: 0pt;text-indent: 0pt;margin:0px;">

                    <span style="color:#092752;font-size:7px;">

                        Gift City, Gandhinagar

                    </span>

                </p> --}}

            </div>

        </div>

        <div style="width:100%;padding:0px 0px;display:flex;padding-top:5px;color:#000000;height:80px;">

            <div style="float:left;width:265px;">

                <table style="" class="card-front-table">

                    <tbody>
                        <tr>
                            <th class="th-th">Name</th>
                            <td>:</td>
                            <td class="td-td">{{ \Illuminate\Support\Str::limit($row->name, 25,'')}}</td>
                        </tr>
                        <tr>
                            <th class="th-th">Designation</th>
                            <td>:</td>
                            <td class="td-td">{{ \Illuminate\Support\Str::limit($row->designation, 30,'') }}</td>
                        </tr>
                        <tr>
                            <th class="th-th">Company/ Organization/ Unit Name and Address</th>
                            <td>:</td>
                            <td class="td-td">{{ \Illuminate\Support\Str::limit($row->company_name, 80,'') }}</td>
                        </tr>
                        <tr>
                            <th class="th-th">Validity</th>
                            <td>:</td>
                            <td class="td-td">{{ date('d/m/Y',strtotime($row->expire_date))}}</td>
                        </tr>
                    </tbody>
                </table>

            </div>

            <div style="margin:0px;padding:0px;color:#000000;">

                <p style="font-size: 6px;margin:1px 0px;">

                    <span ><span style="font-weight:bold;">Sr. No. : </span><span >{{ !empty($row->serial_number) ? $row->serial_number : '' }}</span></span> 

                 </p>

                <div style="margin:0px;padding:0px;border-radius:3px;border:2px solid #B27938;height:50px;width:50px;" >

                    <img width="50" height="50" src='{{ asset('upload/liqour-data/liqour-application/'.$row->image)}}' style="margin:0px;">

                </div>

            </div>



            

            {{-- <div style="">

                <table style="color: #231F20;font-size: 8px;padding: 0px 0px;line-height:12px;width:100%;">

                    <tbody>

                        <tr>

                            <th style="text-align:left;text-transform:uppercase;width:50%;">Name of Passholder</th>

                            <td>:</td>

                            <td style="text-transform:uppercase;">{{ $row->name }}</td>

                        </tr>

                        <tr>

                            <th style="text-align:left;text-transform:uppercase;">Designation</th>

                            <td>:</td>

                            <td style="text-transform:uppercase;">{{ $row->designation }}</td>

                        </tr>

                        <tr>

                            <th style="text-align:left;text-transform:uppercase;">Company/Organization/Unit Name & Address</th>

                            <td>:</td>

                            <td style="text-transform:uppercase;">{{ $row->company_name }}</td>

                        </tr>

                        <tr>

                            <th style="text-align:left;text-transform:uppercase;">Validity</th>

                            <td>:</td>

                            <td>{{ date('d-m-Y',strtotime($row->expire_date))}}</td>

                        </tr>

                       

                    </tbody>

                </table>

            </div> --}}

            {{-- <div style="width:80px;">

                <p style="font-size: 7px;margin:5px 0px;">

                   <span style="font-weight:bold;" >Sr No. : <span >{{ !empty($row->serial_number) ? $row->serial_number : '' }}</span></span> 

                </p>

                <img width="50" height="50" src='{{ asset('upload/liqour-data/liqour-application/'.$row->image)}}' style="border:1px solid #B27938;padding:2px;">

            </div> --}}

        </div>

        <div style="padding:0px 0px;color:#000000;">

            <div style="margin-right:0px;padding:0px;float:left;width:22%;align-self:center;">

                <img width="60" height="60" src='{{ asset('upload/liqour-data/liqour-application/qrcode/'.$row->qrcode)}}' style="padding:2px;">   

            </div>

            <div style="margin-left:5px;margin-top:15px;margin-bottom:0px;">   

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

                                <img width="35" height="25" src="{{ asset('img/nisarg_acharya_signature.png')}}">

                            </td>

                        </tr>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

{{-- front end --}}



{{-- back end --}}



