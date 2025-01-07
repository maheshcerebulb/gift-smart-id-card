<style>

    ul.custom-list {

        padding: 0px 4px 4px 3px;

        margin: 0px;

        color:#000000;

    }

    ul.custom-list li {

        list-style-image: url('{{asset('img/bullet.svg')}}');

        font-size:7px;

    }

    .styled-div {

        border-top: 2px solid #B27938;

        line-height: 4px;
        height: 48px !important;

        color: #000000;

    }



    .styled-div table {

        text-align: left;

        color: #000000;

        font-size: 8px;

        padding: 0px 1px;

        width: 100%;

    }



    .styled-div th {

        text-align: left;

        width: 20% !important;

        vertical-align: top;

        font-size: 8px;

        color: #000000;

    }



    .styled-div td {

        text-align: left;

        vertical-align: top;

        font-size: 8px;

        white-space: pre-line;

    }



    .styled-div span {

        word-wrap: break-word;

        color: #000000;

    }

    table tr th{font-weight: bold}

</style>

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

                    <td>

                        <span>{{ \Illuminate\Support\Str::limit($row->temporary_address, 160,'') }}</span>

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

                    <td>

                        <span>{{ \Illuminate\Support\Str::limit($row->permanent_address, 160,'') }}</span>

                    </td>

                </tr>

            </tbody>

        </table>

    </div>

    

    <div style="border-top:2px solid #B27938;color:#000000;">

        <table style="color: #000000;font-size: 8px;padding: 2px;width:100%;">

            <tbody>

                <tr>

                    <th style="text-align:left;width:40% !important;font-size: 8px;color: #000000;">Mobile No. of Permit Holder : </th>

                    <td style="font-size: 8px;color: #000000;">{{ !empty($row->dial_code) ? '+'.$row->dial_code.' ' : '' }}{{ $row->mobile_number }}</td>

                </tr>

            </tbody>

        </table>

    </div>

</div>