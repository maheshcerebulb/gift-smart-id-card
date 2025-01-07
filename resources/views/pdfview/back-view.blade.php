<div style="border:2px solid black;height: 204px;width: 320px;box-sizing: border-box;overflow: hidden;position: relative;padding: 5px; float:right;">

    <div style="text-align:center;">

        <img width="75" height="75" src='{{ asset('upload/qrcode/'.$row->qrcode)}}' style="border:2px solid white;text-center;">

    </div>

    <p style="padding-top:2pt;padding-left: 9pt;text-indent: 0pt;text-align:left;margin:0px;">

        <span style="color: #231F20;font-weight: bold;border-bottom: 1px solid;font-size:7px;">

            General Instructions:

        </span>

    </p>

    <ul style="padding: 0px 0 0 25px;font-size:7px;">

        <li> This pass should be worn and displayed on the person of the pass holder while inside the Zone.</li>

        <li> This pass is not transferable</li>

        <li> This pass shall be produced on demand by GIFT SEZ Security and Customs staff</li>

        <li> The pass holder and his vehicle are liable for Security Check at the GIFT SEZ gate</li>

        <li> The loss of this pass shall immediately be reported to the Security Officer, GIFT SEZ</li>

        <li> This pass shall be surrendered to the Security Officer, GIFT SEZ through the Developer/Unit/Contractor on expiry or on the person becoming ineligible for this pass.</li>

    </ul>

    <p style="padding-left: 9pt;text-align: left;font-size: 7px;">

        <span style="color:#231F20;font-weight:bold;text-transform:uppercase;">

            Mobile No. of Passholder:

        </span>

        <span style="color: #231F20;text-transform:uppercase;">{{ !empty($row->dial_code) ? '+'.$row->dial_code.' ' : '' }}{{ $row->mobile_number }}</span>

    </p>

</div>