<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Email Template</title>
  </head>
  <body style="margin: 0; padding: 0">
    <table border="0" cellpadding="0" cellspacing="0" width="600" style="border-spacing: 0;font-family: Arial, sans-serif;border: 1px solid #c0c0c0;">
      <tr>
        <td align="center" style="">
          <table>
            <tr>
              <td style="border-spacing: 0;width: 50%; height: 120px;background: #008000;">
                <h3 style="font-weight: bold;margin-left: 20px;color: #ffffff;">Your Entity Registration <br />Completed Successfully
                </h3>
              </td>
              <td style="border-spacing: 0;width: 50%;" bgcolor="#f0f0f0">
                <img src="{{ asset('img/gift-logo-gray-content.png') }}" style="" />
              </td>
            </tr>
            <tr>
              <td
                colspan="3"
                style="padding: 20px 10px 5px;font-family: Arial, sans-serif;color: #333333;font-size: 16px;">
                Dear {{ ucwords(strtolower($emailData['data']['authorized_person_first_name'])) .' ' .ucwords(strtolower($emailData['data']['authorized_person_last_name'])) }},
              </td>
            </tr>
            <tr>
              <td
                colspan="3"
                style="
                  padding: 5px 10px 10px;
                  font-family: Arial, sans-serif;
                  color: #333333;
                  font-size: 16px;
                "
              >
                <p>
                  We are pleased to inform you that your entity registration has been successfully <strong>completed</strong>
                </p>
				<p>To access your account, please log in using the credentials provided below:</p>
              </td>
            </tr>
          </table>
          <table
            border="0"
            cellpadding="0"
            cellspacing="0"
            width="600"
            style="padding: 10px"
            class="borderleftright"
          >
            <tbody>
              <tr>
                <td>
                  <table style="border: 1px solid #c0c0c0; border-radius: 10px; width: 100%; border-spacing: 0; overflow: hidden;">
                    <thead>
                      <tr style="background-color: #f1f1f1;">
                        <th colspan="2" style="padding: 12px; font-family: Arial, sans-serif; color: #333; font-size: 16px; text-align: left; border-bottom: 1px solid #c0c0c0;">Details</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td style=" padding: 10px; font-family: Arial, sans-serif; color: #333333; font-size: 14px; border-right: 1px solid #c0c0c0;border-bottom: 1px solid #c0c0c0;">Login URL</td>
                        <td style=" padding: 10px; font-family: Arial, sans-serif; color: #333333; font-size: 14px; font-weight: bold; border-bottom: 1px solid #c0c0c0;">{{route('login')}}</td>
                      </tr>
                      <tr>
                        <td style=" background-color: #f9f9f9;padding: 10px; font-family: Arial, sans-serif; color: #333333; font-size: 14px; border-bottom: 1px solid #c0c0c0;border-right: 1px solid #c0c0c0;">Email</td>
                        <td style=" background-color: #f9f9f9;padding: 10px; font-family: Arial, sans-serif; color: #333333; font-size: 14px; font-weight: bold; border-bottom: 1px solid #c0c0c0;">{{ $emailData['data']['email'] }}</td>
                      </tr> 
					  <tr>
                        <td style="padding: 10px; font-family: Arial, sans-serif; color: #333333; font-size: 14px; border-right: 1px solid #c0c0c0;border-bottom: 1px solid #c0c0c0;">Password</td>
                        <td style="padding: 10px; font-family: Arial, sans-serif; color: #333333; font-size: 14px; font-weight: bold; border-bottom: 1px solid #c0c0c0;">{{ $emailData['data']['normal_password'] }}</td>
                      </tr>
                    </tbody>
                  </table>
                  
                </td>
              </tr>
            </tbody>
          </table>
          <table
            class="borderleftright"
            cellpadding="0"
            cellspacing="0"
            width="598"
            style="background-color: #ffffff;"
          >
            <tr>
              <td
                colspan="2"
                style="
                  padding: 20px;
                  font-family: Arial, sans-serif;
                  color: #333333;
                  font-size: 16px;
                  line-height: 20px;
                "
              >
                <b> Thanks, </b>
                <br />
                GIFT SEZ
              </td>
            </tr>
          </table>
          <table
            cellpadding="0"
            cellspacing="0"
            width="598"
            height="4"
            style="background-color: #008000;"
          >
            <tbody>
              <tr></tr>
            </tbody>
          </table>
          <table
            cellpadding="0"
            cellspacing="0"
            width="598"
            style="background-color: #f2f2f2;
            "
          >
            <tbody>
              <tr>
                <td
                  style="
                    padding: 20px 10px;
                    font-family: Arial, sans-serif;
                    font-size: 12px;
                    color: #666666;
                  "
                >
                  For any other inquiry:
                  <br />
                  Email: <b>giftsezcustoms@gmail.com</b>
                </td>
                <td
                  style="
                    padding: 20px 10px;
                    font-family: Arial, sans-serif;
                    font-size: 12px;
                    color: #666666;
                  "
                >
                  For technical support
                  <br />
                  Email: <b>ground24@cerebulb.com</b>
                </td>
                <td
                  style="
                    padding: 5px;
                    font-family: Arial, sans-serif;
                    font-size: 12px;
                    color: #666666;
                    text-align: center;

                    /* padding-left: ; */
                  "
                >
                  <div style="margin-bottom: 8px">
                    <a href="http://www.cerebulb.com" target="_blank">
                        <img width="121px" src="{{ asset('img/developed-by.png') }}" style="margin: 10px 0px 10px 5px; border: none;" />
                    </a>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
          <table
            cellpadding="0"
            cellspacing="0"
            width="598"
            height="4"
          >
            <tbody>
              <tr>
                <td
                  colspan="3"
                  style="
                    font-family: Arial, sans-serif;
                    background-color: #f2f2f2;
                    font-size: 16px;
                    padding-bottom: 10px;
                    text-align: center;
                  "
                >
                  www.giftgujarat.in
                </td>
              </tr>
            </tbody>
          </table>
        </td>
      </tr>
    </table>
  </body>
</html>