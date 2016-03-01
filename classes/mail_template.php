<?php

class Mail_Template {

    function __construct() {
        
    }

    /*
     * 
     * Upload mail function to mail assign user
     * 
     */

    function send_mail($to_emailid, $from_id = '', $subject, $data) {
        $to = '';
        $BCC = '';
        if ($to_emailid != '') {
            $to = $to_emailid;
            $BCC = GLO_EMAIL;
        } else {
            $to = 'Ali.Pabrai@ecfirst.com';
            $BCC = 'Bhuvaneswari@pabrai.com,anuradha@pabrai.com';
        }

        $from_id = 'no-reply@ecfirst.com';

        $html = '';

        //echo $subject.'<br>';
        //echo $to.'<br>';
        //$to = 'Ali.Pabrai@ecfirst.com, KM@ecfirst.com, lpayne@kmbs.konicaminolta.us';

        if (is_array($data["file_info"]) && ( count($data["file_info"]) > 0 )) {
            foreach ($data["file_info"] as $value) {
                $html .= ' <tr>
    <td style="padding:5px 10px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif; background-color:#efedcc; color:#000000; border:1px solid #e1debb; font-size:14px;">' . ucfirst($_SESSION["ses_user_name"]) . '</td>
    <td style="padding:5px 10px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif; background-color:#efedcc; color:#000000; border:1px solid #e1debb; font-size:14px;">' . $_SESSION["ses_user_cname"] . '</td>
    <td style="padding:5px 10px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif; background-color:#efedcc; color:#000000; border:1px solid #e1debb; font-size:14px;">' . $value['file_name'] . '</td>
    <td style="padding:5px 10px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif; background-color:#efedcc; color:#000000; border:1px solid #e1debb; font-size:14px;">' . $data['date'] . '</td>
                                    </tr>';
            }



            $headers = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $headers .= 'From: ecfirst <' . $from_id . '>' . "\r\n";
            if ($BCC != '') {
                $headers .= 'Bcc:' . $BCC . "\r\n";
            }

            $message = '<table width="700" border="0" cellspacing="0" cellpadding="0" align="center">
                    <tr>
    <td align="left" valign="top" style="border:solid 2pt #2d4571; mso-border-top-alt:solid 2pt #2d4571; mso-border-left-alt:solid 2pt #2d4571; border-bottom-left-radius: 15px;border-bottom-right-radius:15px; border-top-left-radius: 15px; border-top-right-radius: 15px; background-color:#FFF;">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
    <td colspan="5" height="10">&nbsp;</td>
                        </tr>
  <tr>
  <td width="14">&nbsp;</td>
    <td width="200" align="left" valign="middle"><a href="' . DOMAINURL . '" title=""> <img src="' . DOMAINURL . '/image/tracer_emaillogo.png" width="200" height="32" style="border:0px;" alt="TRACER - Risk Analysis Tool" title="TRACER - Risk Analysis Tool"></a></td>
    <td width="25" align="center" valign="middle"><img style="border:0px;" src="' . DOMAINURL . '/image/sep.png"  width="1" height="39" alt="TRACER - Risk Analysis Tool" title="TRACER - Risk Analysis Tool"></td>
    <td width="537" align="left" valign="middle"><a href="http://ecfirst.com/" title=""> <img style="border:0px;" src="' . DOMAINURL . '/image/ecfirst_emaillogo.png" width="110" height="39" alt="TRACER - Risk Analysis Tool" title="TRACER - Risk Analysis Tool"></a></td>
    <td width="24">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="5" style="padding:25px 10px 15px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif;font-weight:bold;">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="8%" style="padding:10px; text-align:left; margin:0px; font-family:Arial, Helvetica, sans-serif; font-size:24px; font-weight:bold;background-color:#ffffcc;  border: 1px dotted #ffcc66; border-right:none;  color: #990000;"><img src="' . DOMAINURL . '/image/upload_alert.png" width="40" height="36" /></td>
    <td width="92%" style="padding:10px 10px 5px 0px; text-align:left; margin:0px; font-family:Arial, Helvetica, sans-serif; font-size:24px; font-weight:bold;  background-color:#ffffcc;
  border: 1px dotted #ffcc66; border-left:none;  color: #d41c1c;"> Upload Alert! <span style="color:#1F2135;font-size:20px;">' . $_SESSION["ses_user_cname"] . '</span></td>
  </tr>
                    </table>
                </td>
            </tr>
                    <tr>
    <td colspan="5" style="padding:10px 10px 5px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif;">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
    <td style="padding:10px 10px 10px 10px; text-align:left; margin:0px; font-family:Arial, Helvetica, sans-serif; font-size:16px; font-weight:normal; color: #333333; letter-spacing:0.1px; line-height:22px;"></td>
                    </tr>
</table>
</td>
  </tr>
                       <tr>
    <td colspan="5" style="padding:0px 10px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif;">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
    <td colspan="4" style="padding:5px 10px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif; background-color:#efecc9; color:#000000; border:1px solid #dcd9ae;"><strong>UPLOADED FILE DETAILS</strong></td>
                       </tr> 
  <tr>
    <td width="23%" style="padding:5px 10px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif; background-color:#dad593; color:#000000; border:1px solid #bdb876; font-size:14px;"><strong>User Name</strong></td>
    <td width="25%" style="padding:5px 10px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif; background-color:#dad593; color:#000000; border:1px solid #bdb876; font-size:14px;"><strong>Company Name</strong></td>
    <td width="35%" style="padding:5px 10px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif; background-color:#dad593; color:#000000; border:1px solid #bdb876; font-size:14px;"><strong>File Name</strong></td>
    <td width="17%" style="padding:5px 10px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif; background-color:#dad593; color:#000000; border:1px solid #bdb876; font-size:14px;"><strong>Date</strong></td>
        </tr>
                        ' . $html . '

</table>

</td>
  </tr>
                       <tr> 
    <td colspan="5" style="padding:10px 10px 0px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif;">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td style="padding:10px 10px 5px 10px; text-align:left; margin:0px; font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight: bold; color: #333333; letter-spacing:0.1px; line-height:22px;">
                </td>
                                     </tr>
                      <tr>
    <td style="padding:5px 10px 5px 10px; text-align:left; margin:0px; font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:normal; color: #333333; letter-spacing:0.1px; line-height:22px;"><a " href="' . DOMAINURL . '" title="" target="_blank">' . DOMAINURL . '</a></td>
  </tr>
                       <tr>
    <td style="padding:5px 10px 5px 10px; text-align:left; margin:0px; font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:normal; color: #333333; letter-spacing:0.1px; line-height:22px;"><strong>Thank you,</strong><br>
The ecfirst Team
                </td>
                    </tr>
</table>
</td>
                    </tr>
</table>
</td>
  </tr>
              </table>';

            $res = mail($to, $subject, $message, $headers);

            if ($res) {

                $this->upload_thanks_mail($data);

                return "Mail send successfully";
            } else {
                return "Mail send faild";
            }
        } else {
            return "File is empty";
        }
    }

    /*
     * 
     * Upload mail alert to client
     * 
     */

    function upload_thanks_mail($data) {


        $to = $_SESSION["ses_user_email"];

        $from_id = 'no-reply@ecfirst.com';

        $subject = "Tracer - File Upload Alert";

        $html = '';

        //echo $subject.'<br>';
        //echo $to.'<br>';
        //$to = 'Ali.Pabrai@ecfirst.com, KM@ecfirst.com, lpayne@kmbs.konicaminolta.us';

        if (is_array($data["file_info"]) && ( count($data["file_info"]) > 0 )) {
            foreach ($data["file_info"] as $value) {
                $html .= '<tr>
    <td style="padding:5px 10px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif; background-color:#deebd1; color:#000000; border:1px solid #cedcc0; font-size:14px;">' . ucfirst($_SESSION["ses_user_name"]) . '</td>
    <td style="padding:5px 10px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif; background-color:#deebd1; color:#000000; border:1px solid #cedcc0; font-size:14px;">' . $_SESSION["ses_user_cname"] . '</td>
    <td style="padding:5px 10px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif; background-color:#deebd1; color:#000000; border:1px solid #cedcc0; font-size:14px;">' . $value['file_name'] . '</td>
    <td style="padding:5px 10px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif; background-color:#deebd1; color:#000000; border:1px solid #cedcc0; font-size:14px;">' . $data['date'] . '</td>
                                    </tr>';
            }



            $headers = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $headers .= 'From: ecfirst <' . $from_id . '>' . "\r\n";

            $message = '<table width="700" border="0" cellspacing="0" cellpadding="0" align="left">
                    <tr>
    <td align="left" valign="top" style="border:solid 2pt #2d4571; mso-border-top-alt:solid 2pt #2d4571; mso-border-left-alt:solid 2pt #2d4571; border-bottom-left-radius: 15px;border-bottom-right-radius:15px; border-top-left-radius: 15px; border-top-right-radius: 15px; background-color:#FFF;">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
    <td colspan="5" height="10">&nbsp;</td>
                        </tr>
  <tr>
  <td width="14">&nbsp;</td>
    <td width="200" align="left" valign="middle"><a href="' . DOMAINURL . '" title=""> <img src="' . DOMAINURL . '/image/tracer_emaillogo.png" width="200" height="32" style="border:0px;" alt="TRACER - Risk Analysis Tool" title="TRACER - Risk Analysis Tool"></a></td>
    <td width="25" align="center" valign="middle"><img style="border:0px;" src="' . DOMAINURL . '/image/sep.png"  width="1" height="39" alt="TRACER - Risk Analysis Tool" title="TRACER - Risk Analysis Tool"></td>
    <td width="537" align="left" valign="middle"><a href="http://ecfirst.com/" title=""> <img style="border:0px;" src="' . DOMAINURL . '/image/ecfirst_emaillogo.png" width="110" height="39" alt="TRACER - Risk Analysis Tool" title="TRACER - Risk Analysis Tool"></a></td>
    <td width="24">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="5" style="padding:25px 10px 15px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif;font-weight:bold;">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td style="padding:10px; text-align:left; margin:0px; font-family:Arial, Helvetica, sans-serif; font-size:24px; font-weight:bold;  background-color: #f1f4ed;
  border: 1px dotted #e0e4dd;  color: #66a420;"> Thank you</td>
  </tr>
                    </table>
                </td>
            </tr>
                    <tr>
    <td colspan="5" style="padding:10px 10px 5px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif;">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
    <td style="padding:10px 10px 10px 10px; text-align:left; margin:0px; font-family:Arial, Helvetica, sans-serif; font-size:16px; font-weight:normal; color: #333333; letter-spacing:0.1px; line-height:22px;">Your security and compliance support team at ecfirst has important information for you. 
You have successfully uploaded the following file(s).</td>
                    </tr>
</table>
</td>
  </tr>
                       <tr>
    <td colspan="5" style="padding:0px 10px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif;">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
    <td colspan="4" style="padding:5px 10px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif; background-color:#dceace; color:#000000; border:1px solid #c5d6b4;"><strong>UPLOADED FILE DETAILS</strong></td>
                       </tr> 
  <tr>
    <td width="23%" style="padding:5px 10px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif; background-color:#b7d19d; color:#000000; border:1px solid #9ab480; font-size:14px;"><strong>User Name</strong></td>
    <td width="25%" style="padding:5px 10px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif; background-color:#b7d19d; color:#000000; border:1px solid #9ab480; font-size:14px;"><strong>Company Name</strong></td>
    <td width="35%" style="padding:5px 10px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif; background-color:#b7d19d; color:#000000; border:1px solid #9ab480; font-size:14px;"><strong>File Name</strong></td>
    <td width="17%" style="padding:5px 10px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif; background-color:#b7d19d; color:#000000; border:1px solid #9ab480; font-size:14px;"><strong>Date</strong></td>
        </tr>
                        ' . $html . '
</table>

</td>
  </tr>
                       <tr> 
    <td colspan="5" style="padding:10px 10px 0px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif;">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">';

            if ($_SESSION['ses_user_role'] == 4) {
                $message .= '<tr><td style="padding:10px 10px 5px 10px; text-align:left; margin:0px; font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight: bold; color: #333333; letter-spacing:0.1px; line-height:22px;">To Download the File, Log in with your credential: Click the File Upload > Upload File , Download->Click File Name.
                  </td>
        </tr>';
            }

            $message .= '<tr><td style="padding:5px 10px 5px 10px; text-align:left; margin:0px; font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:normal; color: #333333; letter-spacing:0.1px; line-height:22px;"><a " href="' . DOMAINURL . '" title="" target="_blank">' . DOMAINURL . '</a></td>
  </tr>
                       <tr>
    <td style="padding:5px 10px 5px 10px; text-align:left; margin:0px; font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:normal; color: #333333; letter-spacing:0.1px; line-height:22px;"><strong>Thank you,</strong><br>
The ecfirst Team
                </td>
                    </tr>
</table>
</td>
                    </tr>
</table>
</td>
  </tr>
              </table>';

            mail($to, $subject, $message, $headers);
        } else {
            return "File is empty";
        }
    }

    /*
     * 
     * 
     * Delete Aert to mail assign user
     * 
     * 
     */

    function delete_file_mail_alert($to_emailid, $from_id = '', $subject, $data) {

        $to = '';
        $BCC = '';
        if ($to_emailid != '') {
            $to = $to_emailid;
            $BCC = GLO_EMAIL;
        } else {
            $to = 'Ali.Pabrai@ecfirst.com';
            $BCC = 'Bhuvaneswari@pabrai.com,anuradha@pabrai.com';
        }


        $from_id = 'no-reply@ecfirst.com';

        $html = '';

        //echo $subject.'<br>';
        //echo $to.'<br>';
        //$to = 'Ali.Pabrai@ecfirst.com, KM@ecfirst.com, lpayne@kmbs.konicaminolta.us';



        $html .= '<tr>
    <td style="padding:5px 10px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif; background-color:#f2dcdb; color:#000000; border:1px solid #e7cece; font-size:14px;">' . $data["UserName"] . '</td>
    <td style="padding:5px 10px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif; background-color:#f2dcdb; color:#000000; border:1px solid #e7cece; font-size:14px;">' . $data["CompanyName"] . '</td>
    <td style="padding:5px 10px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif; background-color:#f2dcdb; color:#000000; border:1px solid #e7cece; font-size:14px;">' . $data["fileName"] . '</td>
    <td style="padding:5px 10px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif; background-color:#f2dcdb; color:#000000; border:1px solid #e7cece; font-size:14px;">' . $data['Date'] . '</td>
                         </tr>';



        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'From: ecfirst <' . $from_id . '>' . "\r\n";
        if ($BCC != '') {
            $headers .= 'Bcc:' . $BCC . "\r\n";
        }

        $message = '<table width="700" border="0" cellspacing="0" cellpadding="0" align="center">
                    <tr>
    <td align="left" valign="top" style="border:solid 2pt #2d4571; mso-border-top-alt:solid 2pt #2d4571; mso-border-left-alt:solid 2pt #2d4571; border-bottom-left-radius: 15px;border-bottom-right-radius:15px; border-top-left-radius: 15px; border-top-right-radius: 15px; background-color:#FFF;">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
    <td colspan="5" height="10">&nbsp;</td>
                        </tr>
  <tr>
  <td width="14">&nbsp;</td>
    <td width="200" align="left" valign="middle"><a href="' . DOMAINURL . '" title=""> <img src="' . DOMAINURL . '/image/tracer_emaillogo.png" width="200" height="32" style="border:0px;" alt="TRACER - Risk Analysis Tool" title="TRACER - Risk Analysis Tool"></a></td>
    <td width="25" align="center" valign="middle"><img style="border:0px;" src="' . DOMAINURL . '/image/sep.png"  width="1" height="39" alt="TRACER - Risk Analysis Tool" title="TRACER - Risk Analysis Tool"></td>
    <td width="537" align="left" valign="middle"><a href="http://ecfirst.com/" title=""> <img style="border:0px;" src="' . DOMAINURL . '/image/ecfirst_emaillogo.png" width="110" height="39" alt="TRACER - Risk Analysis Tool" title="TRACER - Risk Analysis Tool"></a></td>
    <td width="24">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="5" style="padding:25px 10px 15px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif;font-weight:bold;">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="8%" style="padding:10px; text-align:left; margin:0px; font-family:Arial, Helvetica, sans-serif; font-size:24px; font-weight:bold;background-color:#ffe3e3;  border: 1px dotted #b23232; border-right:none;  color: #990000;"><img src="' . DOMAINURL . '/image/upload_alert.png" width="40" height="36" /></td>
    <td width="92%" style="padding:10px 10px 5px 0px; text-align:left; margin:0px; font-family:Arial, Helvetica, sans-serif; font-size:24px; font-weight:bold;  background-color:#ffe3e3;
  border: 1px dotted #b23232; border-left:none;  color: #d41c1c;"> Delete File Alert! <span style="color:#1F2135;font-size:20px;">' . $_SESSION["ses_user_cname"] . '</span></td>
  </tr>
                    </table>
                </td>
            </tr>
                    <tr>
    <td colspan="5" style="padding:10px 10px 5px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif;">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
    <td style="padding:10px 10px 10px 10px; text-align:left; margin:0px; font-family:Arial, Helvetica, sans-serif; font-size:16px; font-weight:normal; color: #333333; letter-spacing:0.1px; line-height:22px;"></td>
                    </tr>
</table>
</td>
  </tr>
                       <tr>
    <td colspan="5" style="padding:0px 10px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif;">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
    <td colspan="4" style="padding:5px 10px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif; background-color:#f1d8d8; color:#000000; border:1px solid #e3c5c5;"><strong>DELETED FILE DETAILS</strong></td>
                       </tr> 
  <tr>
    <td width="23%"  style="padding:5px 10px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif; background-color:#e1b2b3; color:#000000; border:1px solid #cc9d9e; font-size:14px;"><strong>User Name</strong></td>
    <td width="25%" style="padding:5px 10px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif; background-color:#e1b2b3; color:#000000; border:1px solid #cc9d9e; font-size:14px;"><strong>Company Name</strong></td>
    <td width="35%" style="padding:5px 10px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif; background-color:#e1b2b3; color:#000000; border:1px solid #cc9d9e; font-size:14px;"><strong>File Name</strong></td>
    <td width="17%" style="padding:5px 10px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif; background-color:#e1b2b3; color:#000000; border:1px solid #cc9d9e; font-size:14px;"><strong>Date</strong></td>
        </tr>
                        ' . $html . '
</table>

</td>
  </tr>
                       <tr> 
    <td colspan="5" style="padding:10px 10px 0px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif;">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td style="padding:5px 10px 5px 10px; text-align:left; margin:0px; font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:normal; color: #333333; letter-spacing:0.1px; line-height:22px;"><a " href="' . DOMAINURL . '" title="" target="_blank">' . DOMAINURL . '</a></td>
        </tr>
  <tr>
    <td style="padding:5px 10px 5px 10px; text-align:left; margin:0px; font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:normal; color: #333333; letter-spacing:0.1px; line-height:22px;"><strong>Thank you,</strong><br>
The ecfirst Team
                </td>
                                     </tr>
</table>
                </td>
                    </tr>
</table>
</td>
                    </tr>
              </table>';

        $res = mail($to, $subject, $message, $headers);

        if ($res) {
            return "Mail send successfully";
        } else {
            return "Mail send faild";
        }
    }

    /*
     * 
     * 
     * Download file
     * 
     * 
     */

    function download_mail($to_emailid, $from_id = '', $subject, $data) {

        $to = '';
        $BCC = '';
        $subject = 'Tracer - Download details for ' . $_SESSION['ses_user_cname'];
        if ($to_emailid != '') {
            $to = $to_emailid;
            $BCC = GLO_EMAIL;
        } else {
            $to = 'Ali.Pabrai@ecfirst.com';
            $BCC = 'Bhuvaneswari@pabrai.com,anuradha@pabrai.com';
        }

        $from_id = 'no-reply@ecfirst.com';

        $html = '';

        //echo $subject.'<br>';
        //echo $to.'<br>';
        //$to = 'Ali.Pabrai@ecfirst.com, KM@ecfirst.com, lpayne@kmbs.konicaminolta.us';




        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'From: ecfirst <' . $from_id . '>' . "\r\n";
        if ($BCC != '') {
            $headers .= 'Bcc:' . $BCC . "\r\n";
        }

        $message = '<table width="700" border="0" cellspacing="0" cellpadding="0" align="center">
            <tr>
    <td align="left" valign="top" style="border:solid 2pt #2d4571; mso-border-top-alt:solid 2pt #2d4571; mso-border-left-alt:solid 2pt #2d4571; border-bottom-left-radius: 15px;border-bottom-right-radius:15px; border-top-left-radius: 15px; border-top-right-radius: 15px; background-color:#FFF;">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
    <td colspan="5" height="10">&nbsp;</td>
                            </tr>
  <tr>
  <td width="14">&nbsp;</td>
    <td width="200" align="left" valign="middle"><a href="' . DOMAINURL . '" title=""> <img src="' . DOMAINURL . '/image/tracer_emaillogo.png" width="200" height="32" style="border:0px;" alt="TRACER - Risk Analysis Tool" title="TRACER - Risk Analysis Tool"></a></td>
    <td width="25" align="center" valign="middle"><img style="border:0px;" src="' . DOMAINURL . '/image/sep.png"  width="1" height="39" alt="TRACER - Risk Analysis Tool" title="TRACER - Risk Analysis Tool"></td>
    <td width="537" align="left" valign="middle"><a href="http://ecfirst.com/" title=""> <img style="border:0px;" src="' . DOMAINURL . '/image/ecfirst_emaillogo.png" width="110" height="39" alt="TRACER - Risk Analysis Tool" title="TRACER - Risk Analysis Tool"></a></td>
    <td width="24">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="5" style="padding:25px 10px 15px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif;font-weight:bold;">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="8%" style="padding:10px; text-align:left; margin:0px; font-family:Arial, Helvetica, sans-serif; font-size:24px; font-weight:bold;background-color:#ffffcc;  border: 1px dotted #ffcc66; border-right:none;  color: #990000;"><img src="' . DOMAINURL . '/image/upload_alert.png" width="40" height="36" /></td>
    <td width="92%" style="padding:10px 10px 5px 0px; text-align:left; margin:0px; font-family:Arial, Helvetica, sans-serif; font-size:24px; font-weight:bold;  background-color:#ffffcc;
  border: 1px dotted #ffcc66; border-left:none;  color: #d41c1c;"> Download Alert! <span style="color:#1F2135;font-size:20px;">' . $_SESSION["ses_user_cname"] . '</span></td>
  </tr>
                        </table>
                </td>
            </tr>
            <tr>
    <td colspan="5" style="padding:10px 10px 5px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif;">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
    <td style="padding:10px 10px 10px 10px; text-align:left; margin:0px; font-family:Arial, Helvetica, sans-serif; font-size:16px; font-weight:normal; color: #333333; letter-spacing:0.1px; line-height:22px;"></td>
            </tr>
</table>
</td>
  </tr>
            <tr>
    <td colspan="5" style="padding:0px 10px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif;">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
    <td colspan="4" style="padding:5px 10px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif; background-color:#efecc9; color:#000000; border:1px solid #dcd9ae;"><strong>DOWNLOAD FILE DETAILS</strong></td>
                        </tr>
  <tr>
    <td style="padding:5px 10px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif; background-color:#dad593; color:#000000; border:1px solid #bdb876; font-size:14px;"><strong>User Name</strong></td>
    <td style="padding:5px 10px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif; background-color:#dad593; color:#000000; border:1px solid #bdb876; font-size:14px;"><strong>Company Name</strong></td>
    <td style="padding:5px 10px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif; background-color:#dad593; color:#000000; border:1px solid #bdb876; font-size:14px;"><strong>File Name</strong></td>
    <td style="padding:5px 10px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif; background-color:#dad593; color:#000000; border:1px solid #bdb876; font-size:14px;"><strong>Date</strong></td>
                        </tr>
                        <tr>
    <td width="23%" style="padding:5px 10px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif; background-color:#efedcc; color:#000000; border:1px solid #e1debb; font-size:14px;">' . ucfirst($_SESSION["ses_user_name"]) . '</td>
    <td width="25%" style="padding:5px 10px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif; background-color:#efedcc; color:#000000; border:1px solid #e1debb; font-size:14px;">' . $_SESSION["ses_user_cname"] . '</td>
    <td width="35%" style="padding:5px 10px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif; background-color:#efedcc; color:#000000; border:1px solid #e1debb; font-size:14px;">' . $data['filename'] . '</td>
    <td width="17%" style="padding:5px 10px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif; background-color:#efedcc; color:#000000; border:1px solid #e1debb; font-size:14px;">' . $data['date'] . '</td>
                        </tr>
</table>

                </td>
            </tr>
            <tr>
    <td colspan="5" style="padding:10px 10px 0px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif;">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
    <td style="padding:10px 10px 5px 10px; text-align:left; margin:0px; font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight: bold; color: #333333; letter-spacing:0.1px; line-height:22px;">
                </td>
            </tr>
            <tr>
    <td style="padding:5px 10px 5px 10px; text-align:left; margin:0px; font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:normal; color: #333333; letter-spacing:0.1px; line-height:22px;"><a " href="' . DOMAINURL . '" title="" target="_blank">' . DOMAINURL . '</a></td>
            </tr>
  <tr>
    <td style="padding:5px 10px 5px 10px; text-align:left; margin:0px; font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:normal; color: #333333; letter-spacing:0.1px; line-height:22px;"><strong>Thank you,</strong><br>
The ecfirst Team
    </td>
  </tr>
</table>
</td>
  </tr>
</table>
</td>
  </tr>
        </table>';

        $res = mail($to, $subject, $message, $headers);

        if ($res) {
            return "Mail send successfully";
        } else {
            return "Mail send faild";
        }
    }

    /*
     * 
     * File sharing mail
     * 
     * 
     */

    function file_share_mail($to_emailid, $from_id = '', $subject, $data) {


        $to = '';
        $BCC = '';
        if ($to_emailid != '') {
            $to = $to_emailid;
            $BCC = GLO_EMAIL;
        } else {
            $to = 'Ali.Pabrai@ecfirst.com';
            $BCC = 'Bhuvaneswari@pabrai.com,anuradha@pabrai.com';
        }


        $from_id = 'no-reply@ecfirst.com';

        $html = '';

        //echo $subject.'<br>';
        //echo $to.'<br>';
        //$to = 'Ali.Pabrai@ecfirst.com, KM@ecfirst.com, lpayne@kmbs.konicaminolta.us';



        if (is_array($data["finename"]) && ( count($data["finename"]) > 0 )) {
            foreach ($data["finename"] as $value) {
                $html .= '<tr> 
    <td style="padding:5px 10px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif; background-color:#ceddb9; color:#000000; border:1px solid #b9c9a2; font-size:14px;">' . $value . '</td>
    <td style="padding:5px 10px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif; background-color:#ceddb9; color:#000000; border:1px solid #b9c9a2; font-size:14px;">' . ucfirst($_SESSION["ses_user_name"]) . '</td>
    <td style="padding:5px 10px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif; background-color:#ceddb9; color:#000000; border:1px solid #b9c9a2; font-size:14px;">' . $_SESSION["ses_user_cname"] . '</td>
    <td style="padding:5px 10px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif; background-color:#ceddb9; color:#000000; border:1px solid #b9c9a2; font-size:14px;">' . $data["Date"] . '</td>
  </tr>';
            }
        } else {
            $html .= '<tr>
   <td style="padding:5px 10px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif; background-color:#ceddb9; color:#000000; border:1px solid #b9c9a2; font-size:14px;">' . $data["finename"] . '</td>
    <td style="padding:5px 10px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif; background-color:#ceddb9; color:#000000; border:1px solid #b9c9a2; font-size:14px;">' . ucfirst($_SESSION["ses_user_name"]) . '</td>
    <td style="padding:5px 10px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif; background-color:#ceddb9; color:#000000; border:1px solid #b9c9a2; font-size:14px;">' . $_SESSION["ses_user_cname"] . '</td>
   
    <td style="padding:5px 10px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif; background-color:#ceddb9; color:#000000; border:1px solid #b9c9a2; font-size:14px;">' . $data["Date"] . '</td>
  </tr>';
        }


        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'From: ecfirst <' . $from_id . '>' . "\r\n";
        if ($BCC != '') {
            $headers .= 'Bcc:' . $BCC . "\r\n";
        }

        $message = '<table width="700" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td align="left" valign="top" style="border:solid 2pt #2d4571; mso-border-top-alt:solid 2pt #2d4571; mso-border-left-alt:solid 2pt #2d4571; border-bottom-left-radius: 15px;border-bottom-right-radius:15px; border-top-left-radius: 15px; border-top-right-radius: 15px; background-color:#FFF;">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
     <tr>
    <td colspan="5" height="10">&nbsp;</td>
  </tr>
  <tr>
  <td width="14">&nbsp;</td>
    <td width="200" align="left" valign="middle"><a href="' . DOMAINURL . '" title=""> <img src="' . DOMAINURL . '/image/tracer_emaillogo.png" width="200" height="32" style="border:0px;" alt="TRACER - Risk Analysis Tool" title="TRACER - Risk Analysis Tool"></a></td>
    <td width="25" align="center" valign="middle"><img style="border:0px;" src="' . DOMAINURL . '/image/sep.png"  width="1" height="39" alt="TRACER - Risk Analysis Tool" title="TRACER - Risk Analysis Tool"></td>
    <td width="537" align="left" valign="middle"><a href="http://ecfirst.com/" title=""> <img style="border:0px;" src="' . DOMAINURL . '/image/ecfirst_emaillogo.png" width="110" height="39" alt="TRACER - Risk Analysis Tool" title="TRACER - Risk Analysis Tool"></a></td>
    <td width="24">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="5" style="padding:25px 10px 15px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif;font-weight:bold;">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="92%" style="padding:10px 10px 10px 10px; text-align:left; margin:0px; font-family:Arial, Helvetica, sans-serif; font-size:24px; font-weight:bold;  background-color:#f2ffc7;
  border: 1px dotted #d3deab; color: #557b1f;"> File Sharing Alert!</td>
  </tr>
</table>
</td>
  </tr>
  <tr>
    <td colspan="5" style="padding:10px 10px 5px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif;">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td style="padding:10px 10px 10px 10px; text-align:left; margin:0px; font-family:Arial, Helvetica, sans-serif; font-size:16px; font-weight:normal; color: #333333; letter-spacing:0.1px; line-height:22px;">Your security and compliance support team at ecfirst has important information for you.</td>
  </tr>
</table>
</td>
  </tr>
  <tr>
    <td colspan="5" style="padding:0px 10px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif;">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="4" style="padding:5px 10px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif; background-color:#d3e0bf; color:#000000; border:1px solid #c6d5af;"><strong>SHARING FILE DETAILS</strong></td>
    </tr>
  <tr>
  <td width="35%" style="padding:5px 10px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif; background-color:#b9ce9c; color:#000000; border:1px solid #99ac7f; font-size:14px;"><strong>File Name</strong></td>
    <td width="23%" style="padding:5px 10px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif; background-color:#b9ce9c; color:#000000; border:1px solid #99ac7f; font-size:14px;"><strong>Shared By</strong></td>
    <td width="25%" style="padding:5px 10px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif; background-color:#b9ce9c; color:#000000; border:1px solid #99ac7f; font-size:14px;"><strong>Company Name</strong></td>
    
    <td width="17%" style="padding:5px 10px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif; background-color:#b9ce9c; color:#000000; border:1px solid #99ac7f; font-size:14px;"><strong>Date</strong></td>
  </tr>
' . $html . '
</table>

</td>
  </tr>
  <tr>
    <td colspan="5" style="padding:10px 10px 0px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif;">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td style="padding:10px 10px 5px 10px; text-align:left; margin:0px; font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight: bold; color: #333333; letter-spacing:0.1px; line-height:22px;">To Download the File, Log in with your credential: Click the Document Download > File Received tab. Download->Click File Name. 
    </td>
  </tr>
  <tr>
    <td style="padding:5px 10px 5px 10px; text-align:left; margin:0px; font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:normal; color: #333333; letter-spacing:0.1px; line-height:22px;"><a style="margin-top: 5px; display: block;" href="' . DOMAINURL . '" title="" target="_blank">' . DOMAINURL . '</a></td>
  </tr>
  <tr>
    <td style="padding:5px 10px 5px 10px; text-align:left; margin:0px; font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:normal; color: #333333; letter-spacing:0.1px; line-height:22px;"><strong>Thank you,</strong><br>
The ecfirst Team
    </td>
  </tr>
</table>
</td>
  </tr>
</table>
</td>
  </tr>
</table>';

        $res = mail($to, $subject, $message, $headers);

        if ($res) {
            return "Mail send successfully";
        } else {
            return "Mail send faild";
        }
    }

    /*
     * 
     * Reset Password
     * 
     * 
     */

    function reset_password_mail($to_emailid = '', $from_id = '', $subject = '', $data) {


        if ($data["user_email"]) {
            $to_emailid = $data["user_email"];
        } else {
            $to_emailid = $_SESSION["ses_user_email"];
        }
        $subject = 'Reset Password alert - Tracer';

        $to = '';
        $BCC = '';
        if ($to_emailid != '') {
            $to = $to_emailid;
            $BCC = 'Bhuvaneswari@pabrai.com,anuradha@pabrai.com';
        } else {
            $to = 'Bhuvaneswari@pabrai.com';
        }

        $from_id = 'no-reply@ecfirst.com';

        $html = '';

        $html = ' <table width="700" border="0" cellspacing="0" cellpadding="0" align="center">
            <tr>
    <td align="left" valign="top" style="border:solid 2pt #2d4571; mso-border-top-alt:solid 2pt #2d4571; mso-border-left-alt:solid 2pt #2d4571; border-bottom-left-radius: 15px;border-bottom-right-radius:15px; border-top-left-radius: 15px; border-top-right-radius: 15px; background-color:#FFF;">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
     <tr>
    <td colspan="5" height="10">&nbsp;</td>
  </tr>
  <tr>
  <td width="14">&nbsp;</td>
    <td width="200" align="left" valign="middle"><a href="' . DOMAINURL . '" title=""> <img src="' . DOMAINURL . '/image/tracer_emaillogo.png" width="200" height="32" style="border:0px;" alt="TRACER - Risk Analysis Tool" title="TRACER - Risk Analysis Tool"></a></td>
    <td width="25" align="center" valign="middle"><img style="border:0px;" src="' . DOMAINURL . '/image/sep.png"  width="1" height="39" alt="TRACER - Risk Analysis Tool" title="TRACER - Risk Analysis Tool"></td>
    <td width="537" align="left" valign="middle"><a href="http://ecfirst.com/" title=""> <img style="border:0px;" src="' . DOMAINURL . '/image/ecfirst_emaillogo.png" width="110" height="39" alt="TRACER - Risk Analysis Tool" title="TRACER - Risk Analysis Tool"></a></td>
    <td width="24">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="5" style="padding:25px 10px 5px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif;font-weight:bold;">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td style="padding:10px 10px 10px 10px; text-align:left; margin:0px; font-family:Arial, Helvetica, sans-serif; font-size:18px; font-weight: normal;  background-color: #f1f4ed;  border: 1px dotted #e0e4dd;  color: #000000;">Dear ' . $data['user_name'] . ',</td>
  </tr>
</table>
            </td>
            </tr>
            <tr>
    <td colspan="5" style="padding:10px 10px 5px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif;">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td style="padding:10px 10px 10px 10px; text-align:left; margin:0px; font-family:Arial, Helvetica, sans-serif; font-size:16px; font-weight:normal; color: #333333; letter-spacing:0.1px; line-height:22px;">Your password has been changed successfully.</td>
            </tr>
</table>
</td>
  </tr>
            <tr>
    <td colspan="5" style="padding:0px 10px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif;">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="4" style="padding:10px 10px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif; background-color:#a4c48a; color:#000000; border:1px solid #8faf75;"><strong>RESET PASSWORD CREDENTIAL</strong></td>
            </tr> 
            <tr>
    <td width="50%" style="padding:5px 10px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif; background-color:#d0e7b2; color:#000000; border:1px solid #aecd8a; font-size:14px;"><strong>Username</strong></td>
    <td width="50%" style="padding:5px 10px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif; background-color:#d9f4b7; color:#000000; border:1px solid #aecd8a; font-size:14px;"><strong>Password</strong></td>
   
            </tr>
            <tr>
    <td style="padding:5px 10px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif; background-color:#f0f7e7; color:#000000; border:1px solid #dde7d0; font-size:14px;">' . $data['user_name'] . '</td>
    <td style="padding:5px 10px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif; background-color:#f0f7e7; color:#000000; border:1px solid #dde7d0; font-size:14px;">' . $data['decrypt_code'] . '</td>
            </tr>
</table>

</td>
  </tr>
            <tr>
    <td colspan="5" style="padding:10px 10px 0px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif;">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td style="padding:5px 10px 5px 10px; text-align:left; margin:0px; font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:normal; color: #333333; letter-spacing:0.1px; line-height:22px;"><a href="' . DOMAINURL . '" title="" target="_blank">' . DOMAINURL . '</a></td>
            </tr>
  <tr>
    <td style=" font-family:Arial, Helvetica, sans-serif; padding:5px 10px 5px 10px; text-align:left; margin:0px; font-size:14px; font-weight:normal; color: #333333; letter-spacing:0.1px; line-height:22px;"><strong>Thank you,</strong><br>
The ecfirst Team
    </td>
  </tr>
</table>
</td>
  </tr>
</table>
</td>
  </tr>
            </table>';

        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'From: ecfirst < no-reply@ecfirst.com >' . "\r\n";
        if ($BCC != '') {
            $headers .= 'Bcc:' . $BCC . "\r\n";
        }

        mail($to, $subject, $html, $headers);
        $res_data ['mess'] = 'You have successfully changed your password';
        //$res_data ['page'] = 'logout.php';
        echo json_encode($res_data);
    }

    /*
     * 
     * Registration Mail
     * 
     * 
     */

    function registration_mail($to_emailid = '', $from_id = '', $subject = '', $data) {


        $to_emailid = $data['toemail'];
        $subject = 'Registration from Tracer';

        $to = '';
        $BCC = '';
        if ($to_emailid != '') {
            $to = $to_emailid;
            $BCC = 'Bhuvaneswari@pabrai.com,anuradha@pabrai.com';
        } else {
            $to = 'Bhuvaneswari@pabrai.com';
        }

        $from_id = 'no-reply@ecfirst.com';

        $message = '';

        $message .= '<table width="700" border="0" cellspacing="0" cellpadding="0" align="center">
                <tr>
    <td align="left" valign="top" style="border:solid 2pt #2d4571; mso-border-top-alt:solid 2pt #2d4571; mso-border-left-alt:solid 2pt #2d4571; border-bottom-left-radius: 15px;border-bottom-right-radius:15px; border-top-left-radius: 15px; border-top-right-radius: 15px; background-color:#FFF;">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
     <tr>
    <td colspan="5" height="10">&nbsp;</td>
  </tr>
  <tr>
  <td width="14">&nbsp;</td>
    <td width="200" align="left" valign="middle"><a href="' . DOMAINURL . '" title=""> <img src="' . DOMAINURL . '/image/tracer_emaillogo.png" width="200" height="32" style="border:0px;" alt="TRACER - Risk Analysis Tool" title="TRACER - Risk Analysis Tool"></a></td>
    <td width="25" align="center" valign="middle"><img style="border:0px;" src="' . DOMAINURL . '/image/sep.png"  width="1" height="39" alt="TRACER - Risk Analysis Tool" title="TRACER - Risk Analysis Tool"></td>
    <td width="537" align="left" valign="middle"><a href="http://ecfirst.com/" title=""> <img style="border:0px;" src="' . DOMAINURL . '/image/ecfirst_emaillogo.png" width="110" height="39" alt="TRACER - Risk Analysis Tool" title="TRACER - Risk Analysis Tool"></a></td>
    <td width="24">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="5" style="padding:25px 10px 5px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif;font-weight:bold;">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td style="padding:5px 10px 5px 10px; text-align:left; margin:0px; font-family:Arial, Helvetica, sans-serif; font-size:18px; font-weight: normal;  background-color: #f1f4ed;  border: 1px dotted #e0e4dd;  color: #000000;">Congrats! Successfully Registered...</td>
  </tr>
  <tr>
    <td style="padding:10px 10px 5px 10px; text-align:left; margin:0px; font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight: normal; color: #000000;">Dear ' . $data['user_name'] . ',</td>
  </tr>
</table>
                </td>
                </tr>
                <tr>
    <td colspan="5" style="padding:10px 10px 5px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif;">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td style="padding:10px 10px 10px 10px; text-align:left; margin:0px; font-family:Arial, Helvetica, sans-serif; font-size:16px; font-weight:normal; color: #333333; letter-spacing:0.1px; line-height:22px;">Your security and compliance support team at ecfirst has important information for you.</td>
                </tr>
</table>
</td>
  </tr>
                <tr>
    <td colspan="5" style="padding:0px 10px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif;">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="4" style="padding:10px 10px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif; background-color:#a4c48a; color:#000000; border:1px solid #8faf75;"><strong>YOUR LOGIN CREDENTIALS</strong></td>
                </tr> 
  <tr>
    <td width="50%" style="padding:5px 10px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif; background-color:#d0e7b2; color:#000000; border:1px solid #aecd8a; font-size:14px;"><strong>Username</strong></td>
    <td width="50%" style="padding:5px 10px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif; background-color:#d9f4b7; color:#000000; border:1px solid #aecd8a; font-size:14px;"><strong>Password</strong></td>

  </tr>
                <tr>
    <td style="padding:5px 10px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif; background-color:#f0f7e7; color:#000000; border:1px solid #dde7d0; font-size:14px;">' . $data['user_name'] . '</td>
    <td style="padding:5px 10px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif; background-color:#f0f7e7; color:#000000; border:1px solid #dde7d0; font-size:14px;">' . $data['user_password'] . '</td>
                </tr>
</table>

</td>
  </tr>
                <tr>
    <td colspan="5" style="padding:10px 10px 0px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif;">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td style="padding:5px 10px 5px 10px; text-align:left; margin:0px; font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:normal; color: #333333; letter-spacing:0.1px; line-height:22px;"><a href="' . DOMAINURL . '" title="" target="_blank">' . DOMAINURL . '</a></td>
                </tr>
  <tr>
    <td style=" font-family:Arial, Helvetica, sans-serif; padding:5px 10px 5px 10px; text-align:left; margin:0px; font-size:14px; font-weight:normal; color: #333333; letter-spacing:0.1px; line-height:22px;"><strong>Thank you,</strong><br>
The ecfirst Team
    </td>
  </tr>
</table>
</td>
  </tr>
</table>
</td>
  </tr>
                </table>';

        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'From: ecfirst <' . $from_id . '>' . "\r\n";
        if ($BCC != '') {
            $headers .= 'Bcc:' . $BCC . "\r\n";
        }

        mail($to, $subject, $message, $headers);


        //echo $user_role;
        echo 'Saved Successfully';
    }

    /*
     * 
     * Forgot Password Mail
     * 
     * 
     */

    function forgot_password_mail($to_emailid = '', $from_id = '', $subject = '', $data) {

        $to_emailid = $data['forgotemail'];
        $subject = 'Forgot Password alert - Tracer';

        $to = '';
        $BCC = '';
        if ($to_emailid != '') {
            $to = $to_emailid;
            $BCC = 'Bhuvaneswari@pabrai.com';
            //$BCC = 'sraman0101@gmail.com';
        } else {
            $to = 'Bhuvaneswari@pabrai.com';
        }


        $from_id = 'no-reply@ecfirst.com';

        $msg = '';
        $msg .= '<table width="700" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td align="left" valign="top" style="border:solid 2pt #2d4571; mso-border-top-alt:solid 2pt #2d4571; mso-border-left-alt:solid 2pt #2d4571; border-bottom-left-radius: 15px;border-bottom-right-radius:15px; border-top-left-radius: 15px; border-top-right-radius: 15px; background-color:#FFF;">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
     <tr>
    <td colspan="3" height="10">&nbsp;</td>
  </tr>
  <tr>
<td width="200"  align="left" valign="middle" style="width:110px; padding-left:11px;"><a href="' . DOMAINURL . '" title=""> <img src="' . DOMAINURL . '/image/tracer_emaillogo.png" width="200" height="32" style="border:0px;" alt="TRACER - Risk Analysis Tool" title="TRACER - Risk Analysis Tool"></a></td>
<td width="10" style="text-align:center; width:20px;" align="center" valign="middle"><img style="border:0px;" src="' . DOMAINURL . '/image/sep.png"  width="1" height="39" alt="TRACER - Risk Analysis Tool" title="TRACER - Risk Analysis Tool"></td>
<td width="474" align="left" valign="middle" style=""><a href="http://ecfirst.com/" title=""> <img style="border:0px;" src="' . DOMAINURL . '/image/ecfirst_emaillogo.png" width="110" height="39" alt="TRACER - Risk Analysis Tool" title="TRACER - Risk Analysis Tool"></a></td>
  </tr>
  <tr>
    <td colspan="3" style="padding:25px 10px 5px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif;font-weight:bold;">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
  
  <tr>
    <td style="padding:10px 10px 5px 10px; text-align:left; margin:0px; font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight: normal; color: #000000;">Dear ' . $data["user_name"] . ',</td>
  </tr>
</table>
</td>
  </tr>
  <tr>
    <td colspan="5" style="padding:10px 10px 5px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif;">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td style="padding:10px 10px 10px 10px; text-align:left; margin:0px; font-family:Arial, Helvetica, sans-serif; font-size:16px; font-weight:normal; color: #333333; letter-spacing:0.1px; line-height:22px;">Your security and compliance support team at ecfirst has important information for you.</td>
  </tr>
</table>
</td>
  </tr>
  <tr>
    <td colspan="5" style="padding:0px 10px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif;">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="4" style="padding:10px 10px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif; background-color:#f0ddb4; color:#000000; border:1px solid #e2cfa8;"><strong>FORGOT PASSWORD LINK</strong></td>
    </tr>
    <tr>
    <td colspan="4" style="padding:5px 10px; margin:0px; text-align:left; font-family:Arial, Helvetica, sans-serif; background-color:#fffbef; color:#000000; border:1px solid #f9f3e1; font-size:14px;">Please follow this personal link to securely change your password:</td>
     </tr>

 
   <tr>
    <td colspan="4" style="padding:5px 10px; margin:0px; text-align:left; font-family:Arial, Helvetica, sans-serif; background-color:#fffbef; color:#000000; border:1px solid #f9f3e1; font-size:13px;">This link will be automatically discarded after 15 minutes or after your password has been changed.</td>
    
  </tr>
  <tr>
    <td colspan="4" style="padding:5px 10px; margin:0px; text-align:left; font-family:Arial, Helvetica, sans-serif; background-color:#fffbef; color:#000000; border:1px solid #f9f3e1; font-size:14px;">Please click the following link to change password</td>
   
  </tr>
  <tr>
     <td colspan="4"  style="padding:5px 10px; margin:0px; text-align:left; font-family:Arial, Helvetica, sans-serif; background-color:#fffbef; color:#000000; border:1px solid #f9f3e1; font-size:14px;">' . DOMAINURL . '/forgot_password.php?token=' . $data['token'] . '</td>
    
  </tr>
</table>

</td>
  </tr>
  <tr>
    <td colspan="5" style="padding:10px 10px 0px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif;">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td style="padding:5px 10px 5px 10px; text-align:left; margin:0px; font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:normal; color: #333333; letter-spacing:0.1px; line-height:22px;">Please do not reply to this email. This is an automated email. </td>
  </tr>
  <tr>
    <td style=" font-family:Arial, Helvetica, sans-serif; padding:5px 10px 5px 10px; text-align:left; margin:0px; font-size:14px; font-weight:normal; color: #333333; letter-spacing:0.1px; line-height:22px;"><strong>Thank you,</strong><br>
The ecfirst Team
    </td>
  </tr>
</table>
</td>
  </tr>
</table>
</td>
  </tr>
</table>';

        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'From: ecfirst < no-reply@ecfirst.com >' . "\r\n";
        if ($BCC != '') {
            $headers .= 'Bcc:' . $BCC . "\r\n";
        }

        mail($to, $subject, $msg, $headers);
    }
/***********************************************************************************************************************/
    /*
     * 
     * UN Subscription Mail Alert - Warning
     * 
     * 
     */

    function un_subscription_warning_mail($to_emailid, $CC = '', $data) {

        $subject = 'TRACER Portal- UN Subscription Mail Alert';
        $msg = '';


        $msg .= '<table width="700" border="0" cellspacing="0" cellpadding="0" align="center">
                    <tr>
    <td align="left" valign="top" style="border:solid 2pt #2d4571; mso-border-top-alt:solid 2pt #2d4571; mso-border-left-alt:solid 2pt #2d4571; border-bottom-left-radius: 15px;border-bottom-right-radius:15px; border-top-left-radius: 15px; border-top-right-radius: 15px; background-color:#FFF;">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
    <td colspan="5" height="10">&nbsp;</td>
                        </tr>
  <tr>
  <td width="14">&nbsp;</td>
    <td width="200" align="left" valign="middle"><a href="' . DOMAINURL . '" title=""> <img src="' . DOMAINURL . '/image/tracer_emaillogo.png" width="200" height="32" style="border:0px;" alt="TRACER - Risk Analysis Tool" title="TRACER - Risk Analysis Tool"></a></td>
    <td width="25" align="center" valign="middle"><img style="border:0px;" src="' . DOMAINURL . '/image/sep.png"  width="1" height="39" alt="TRACER - Risk Analysis Tool" title="TRACER - Risk Analysis Tool"></td>
    <td width="537" align="left" valign="middle"><a href="http://ecfirst.com/" title=""> <img style="border:0px;" src="' . DOMAINURL . '/image/ecfirst_emaillogo.png" width="110" height="39" alt="TRACER - Risk Analysis Tool" title="TRACER - Risk Analysis Tool"></a></td>
    <td width="24">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="5" style="padding:25px 10px 15px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif;font-weight:bold;">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="8%" style="padding:10px; text-align:left; margin:0px; font-family:Arial, Helvetica, sans-serif; font-size:24px; font-weight:bold;background-color:#ffffcc;  border: 1px dotted #ffcc66; border-right:none;  color: #990000;"><img src="' . DOMAINURL . '/image/upload_alert.png" width="40" height="36" /></td>
    <td width="92%" style="padding:10px 10px 5px 0px; text-align:left; margin:0px; font-family:Arial, Helvetica, sans-serif; font-size:24px; font-weight:bold;  background-color:#ffffcc;
  border: 1px dotted #ffcc66; border-left:none;  color: #d41c1c;"> Mail Alert for Expiry! <span style="color:#1F2135;font-size:20px;">' . $data["cNamed"] . '</span></td>
  </tr>
                    </table>
                </td>
            </tr>
                    <tr>
    <td colspan="5" style="padding:10px 10px 5px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif;">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
    <td style="padding:10px 10px 10px 10px; text-align:left; margin:0px; font-family:Arial, Helvetica, sans-serif; font-size:16px; font-weight:normal; color: #333333; letter-spacing:0.1px; line-height:22px;"></td>
                    </tr>
</table>
</td>
  </tr>
                       <tr>
    <td colspan="5" style="padding:10px 10px 5px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif;">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
    <td height="34" style="padding:10px 10px 10px 10px; text-align:left; margin:0px; font-family:Arial, Helvetica, sans-serif; font-size:16px; font-weight:normal; color: #333333; letter-spacing:0.1px; line-height:22px;">Dear  ' . $data["userName"] . ',</td>
                    </tr>
</table>
</td>
  </tr>
                       <tr> 
    <td colspan="5" style="padding:0px 10px 0px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif;">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td style="padding:10px 10px 5px 10px; text-align:left; margin:0px; font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight: bold; color: #333333; letter-spacing:0.1px; line-height:22px;">Your Portal subscription will expire in another '.$data['days_left'].'. To extend our service please contact Lorna Waggoner (Lorna.Waggoner@ecfirst.com)</td>
        </tr>
        <tr>
    <td style="padding:5px 10px 5px 10px; text-align:left; margin:0px; font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:normal; color: #333333; letter-spacing:0.1px; line-height:22px;"><strong>Thank you,</strong><br>
The ecfirst Team
                </td>
                    </tr>
</table>
</td>
                    </tr>
                       
</table>
</td>
  </tr>
              </table>';

        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'From: ecfirst < no-reply@ecfirst.com >' . "\r\n";
        if ($CC != '') {
            $headers .= 'Cc:' . $CC . "\r\n";
        }

        $headers .= 'Bcc:' . GLO_EMAIL . "\r\n";


        mail($to_emailid, $subject, $msg, $headers);
    }//end



    /*
     * 
     * Un Subscription mail alert - Block
     * 
     * 
     */

    function un_subscription_block_mail($to_emailid, $CC = '', $data) {

        $subject = 'TRACER Portal- Block the Subscription';
        $msg = '';

        $msg .= '<table width="700" border="0" cellspacing="0" cellpadding="0" align="center">
                    <tr>
    <td align="left" valign="top" style="border:solid 2pt #2d4571; mso-border-top-alt:solid 2pt #2d4571; mso-border-left-alt:solid 2pt #2d4571; border-bottom-left-radius: 15px;border-bottom-right-radius:15px; border-top-left-radius: 15px; border-top-right-radius: 15px; background-color:#FFF;">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
    <td colspan="5" height="10">&nbsp;</td>
                        </tr>
  <tr>
  <td width="14">&nbsp;</td>
    <td width="200" align="left" valign="middle"><a href="' . DOMAINURL . '" title=""> <img src="' . DOMAINURL . '/image/tracer_emaillogo.png" width="200" height="32" style="border:0px;" alt="TRACER - Risk Analysis Tool" title="TRACER - Risk Analysis Tool"></a></td>
    <td width="25" align="center" valign="middle"><img style="border:0px;" src="' . DOMAINURL . '/image/sep.png"  width="1" height="39" alt="TRACER - Risk Analysis Tool" title="TRACER - Risk Analysis Tool"></td>
    <td width="537" align="left" valign="middle"><a href="http://ecfirst.com/" title=""> <img style="border:0px;" src="' . DOMAINURL . '/image/ecfirst_emaillogo.png" width="110" height="39" alt="TRACER - Risk Analysis Tool" title="TRACER - Risk Analysis Tool"></a></td>
    <td width="24">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="5" style="padding:25px 10px 15px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif;font-weight:bold;">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="8%" style="padding:10px; text-align:left; margin:0px; font-family:Arial, Helvetica, sans-serif; font-size:24px; font-weight:bold;background-color:#ffe3e3;  border: 1px dotted #b23232; border-right:none;  color: #990000;"><img src="' . DOMAINURL . '/image/upload_alert.png" width="40" height="36" /></td>
    <td width="92%" style="padding:10px 10px 5px 0px; text-align:left; margin:0px; font-family:Arial, Helvetica, sans-serif; font-size:24px; font-weight:bold;  background-color:#ffe3e3;
  border: 1px dotted #b23232; border-left:none;  color: #d41c1c;"> MAIL ALERT for Expiry! <span style="color:#1F2135;font-size:20px;">' . $data["cNamed"] . '</span></td>
  </tr>
                    </table>
                </td>
            </tr>
                    <tr>
    <td colspan="5" style="padding:10px 10px 5px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif;">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
    <td style="padding:10px 10px 10px 10px; text-align:left; margin:0px; font-family:Arial, Helvetica, sans-serif; font-size:16px; font-weight:normal; color: #333333; letter-spacing:0.1px; line-height:22px;"></td>
                    </tr>
</table>
</td>
  </tr>
                       
                       <tr> 
    <td colspan="5" style="padding:10px 10px 0px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif;">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td style="padding:5px 10px 5px 10px; text-align:left; margin:0px; font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:normal; color: #333333; letter-spacing:0.1px; line-height:22px;">Dear  ' . $data["userName"] . ',</td>
        </tr>
  <tr>
    <td style="padding:5px 10px 5px 10px; text-align:left; margin:0px; font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:normal; color: #333333; letter-spacing:0.1px; line-height:22px;">Your Portal subscription has been blocked. For further assistance and service please contact Lorna Waggoner (Lorna.Waggoner@ecfirst.com).</td>
        </tr>
  <tr>
    <td style="padding:5px 10px 5px 10px; text-align:left; margin:0px; font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:normal; color: #333333; letter-spacing:0.1px; line-height:22px;"><strong>Thank you,</strong><br>
The ecfirst Team
                </td>
                                     </tr>
</table>
                </td>
                    </tr>
</table>
</td>
                    </tr>
              </table>';

                $headers = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                $headers .= 'From: ecfirst < no-reply@ecfirst.com >' . "\r\n";
                if ($CC != '') {
                    $headers .= 'Cc:' . $CC . "\r\n";
                    
                }

                //$headers .= "Bcc:Bhuvaneswari@pabrai.com" . "\r\n";
                $headers .= 'Bcc:' . GLO_EMAIL . "\r\n";


                mail($to_emailid, $subject, $msg, $headers);
        }//end
        
        
        
     /*
     * 
     * Subscription renew
     * 
     * 
     */

    function subscription_renew_mail($to_emailid, $CC = '', $data) {
        
        $subject = $data['subject'];
        if($data['month'] == '1'){
           $extend_month = $data['month'].' Month';
        }else{
            $extend_month = $data['month'].' Months';
        }
        $msg = '';

        $msg .= '<table width="700" border="0" cellspacing="0" cellpadding="0" align="left">
                    <tr>
    <td align="left" valign="top" style="border:solid 2pt #2d4571; mso-border-top-alt:solid 2pt #2d4571; mso-border-left-alt:solid 2pt #2d4571; border-bottom-left-radius: 15px;border-bottom-right-radius:15px; border-top-left-radius: 15px; border-top-right-radius: 15px; background-color:#FFF;">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
    <td colspan="5" height="10">&nbsp;</td>
                        </tr>
  <tr>
  <td width="14">&nbsp;</td>
    <td width="200" align="left" valign="middle"><a href="' . DOMAINURL . '" title=""> <img src="' . DOMAINURL . '/image/tracer_emaillogo.png" width="200" height="32" style="border:0px;" alt="TRACER - Risk Analysis Tool" title="TRACER - Risk Analysis Tool"></a></td>
    <td width="25" align="center" valign="middle"><img style="border:0px;" src="' . DOMAINURL . '/image/sep.png"  width="1" height="39" alt="TRACER - Risk Analysis Tool" title="TRACER - Risk Analysis Tool"></td>
    <td width="537" align="left" valign="middle"><a href="http://ecfirst.com/" title=""> <img style="border:0px;" src="' . DOMAINURL . '/image/ecfirst_emaillogo.png" width="110" height="39" alt="TRACER - Risk Analysis Tool" title="TRACER - Risk Analysis Tool"></a></td>
    <td width="24">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="5" style="padding:25px 10px 15px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif;font-weight:bold;">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td style="padding:10px; text-align:left; margin:0px; font-family:Arial, Helvetica, sans-serif; font-size:24px; font-weight:bold;  background-color: #f1f4ed;
  border: 1px dotted #e0e4dd;  color: #66a420;"> Subscription for Extension! ' . $data["cNamed"] . '</td>
  </tr>
                    </table>
                </td>
            </tr>
                    <tr>
    <td colspan="5" style="padding:10px 10px 5px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif;">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
    <td height="34" style="padding:10px 10px 10px 10px; text-align:left; margin:0px; font-family:Arial, Helvetica, sans-serif; font-size:16px; font-weight:normal; color: #333333; letter-spacing:0.1px; line-height:22px;">Dear  ' . ucfirst($data["userName"]) . ',</td>
                    </tr>
</table>
</td>
  </tr>
                       <tr> 
    <td colspan="5" style="padding:0px 10px 0px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif;">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td style="padding:10px 10px 5px 10px; text-align:left; margin:0px; font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight: normal; color: #333333; letter-spacing:0.1px; line-height:22px;">Your Portal subscription has been extended for an additional '.$extend_month.'. You can continue services with the previous Log-in credential.</td>
        </tr>
        <tr>
    <td style="padding:5px 10px 5px 10px; text-align:left; margin:0px; font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:normal; color: #333333; letter-spacing:0.1px; line-height:22px;"><strong>Thank you,</strong><br>
The ecfirst Team
                </td>
                    </tr>
</table>
</td>
                    </tr>
</table>
</td>
  </tr>
              </table>
              
  ';

                $headers = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                $headers .= 'From: ecfirst < no-reply@ecfirst.com >' . "\r\n";
                if ($CC != '') {
                    $headers .= 'Cc:' . $CC . "\r\n";
                }

                $headers .= 'Bcc:' . GLO_EMAIL . "\r\n";


                mail($to_emailid, $subject, $msg, $headers);
        }
        
       function completion_mail($to_emailid, $from_id = '', $subject = '', $data, $form = '', $username = ''){
                          
        $to = '';
        $BCC = '';
        if ($to_emailid != '') {
            $to = $to_emailid;
             //$BCC = GLO_EMAIL;
            $BCC = 'Bhuvaneswari@pabrai.com, Ali.Pabrai@ecfirst.com';
            
        } else {
            $to = 'Bhuvaneswari@pabrai.com,anuradha@pabrai.com';
        }

        if($form == 'RA DCF'){
            $fo = 'Data Collection Form';
            $rt = '(DCF)';
            $rt1 = 'DCF';
        }
        if($form == 'RA DCAF'){
             $fo = 'Data Center Assessment Form';
            $rt = '(DCAF)';
            $rt1 = 'DCAF';
        }
        $from_id = 'no-reply@ecfirst.com';
       
      $subject = 'Tracer - Alert! '.$fo.' filled by '.$username.'';
        
        $msg .= '<table width="700" border="0" cellspacing="0" cellpadding="0" align="center">
                    <tr>
    <td align="left" valign="top" style="border:solid 2pt #2d4571; mso-border-top-alt:solid 2pt #2d4571; mso-border-left-alt:solid 2pt #2d4571; border-bottom-left-radius: 15px;border-bottom-right-radius:15px; border-top-left-radius: 15px; border-top-right-radius: 15px; background-color:#FFF;">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
    <td colspan="5" height="10">&nbsp;</td>
                        </tr>
  <tr>
  <td width="14">&nbsp;</td>
    <td width="200" align="left" valign="middle"><a href="' . DOMAINURL . '" title=""> <img src="' . DOMAINURL . '/image/tracer_emaillogo.png" width="200" height="32" style="border:0px;" alt="TRACER - Risk Analysis Tool" title="TRACER - Risk Analysis Tool"></a></td>
    <td width="25" align="center" valign="middle"><img style="border:0px;" src="' . DOMAINURL . '/image/sep.png"  width="1" height="39" alt="TRACER - Risk Analysis Tool" title="TRACER - Risk Analysis Tool"></td>
    <td width="537" align="left" valign="middle"><a href="http://ecfirst.com/" title=""> <img style="border:0px;" src="' . DOMAINURL . '/image/ecfirst_emaillogo.png" width="110" height="39" alt="TRACER - Risk Analysis Tool" title="TRACER - Risk Analysis Tool"></a></td>
    <td width="24">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="5" style="padding:25px 10px 15px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif;font-weight:bold;">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="8%" style="padding:10px; text-align:left; margin:0px; font-family:Arial, Helvetica, sans-serif; font-size:24px; font-weight:bold;background-color:#74bf1f;  border: 1px dotted #b23232; border-right:none;  color: #990000;"></td>
    <td width="92%" style="padding:10px 10px 5px 0px; text-align:left; margin:0px; font-family:Arial, Helvetica, sans-serif; font-size:24px; font-weight:bold;  background-color:#74bf1f;
  border: 1px dotted #b23232; border-left:none;  color: #f0f0f0;"> MAIL ALERT On '.$fo.' '.$rt.' Status! <span style="color:#1F2135;font-size:20px;"></span></td>
  </tr>
                    </table>
                </td>
            </tr>
                    <tr>
    <td colspan="5" style="padding:10px 10px 5px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif;">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
    <td style="padding:10px 10px 10px 10px; text-align:left; margin:0px; font-family:Arial, Helvetica, sans-serif; font-size:16px; font-weight:normal; color: #333333; letter-spacing:0.1px; line-height:22px;"></td>
                    </tr>
</table>
</td>
  </tr>
                       
   <tr> 
    <td colspan="5" style="padding:10px 10px 0px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif;">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
 
        <tr>';
         $sd = "<b>".ucfirst($username)."</b>'s ".$rt1." is 100% Completed.";
          $msg .= '<td style="padding:5px 10px 5px 10px; text-align:left; margin:0px; font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:normal; color: #333333; letter-spacing:0.1px; line-height:22px;">'.$sd .'</td>';
        $msg .= '</tr>
        <tr>
          <td style="padding:5px 10px 5px 10px; text-align:left; margin:0px; font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:normal; color: #333333; letter-spacing:0.1px; line-height:22px;">Click <a href="http://tracer.ecfirst.com">here</a> to download the report.</td>
        </tr>
        <tr>
          <td style="padding:5px 10px 5px 10px; text-align:left; margin:0px; font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:normal; color: #333333; letter-spacing:0.1px; line-height:22px;"><strong>Thank you,</strong><br>
      The ecfirst Team
          </td>
       </tr>
</table>
</td>
</tr>
</table>
</td>
                    </tr>
              </table>';
        
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'From: ecfirst < no-reply@ecfirst.com >' . "\r\n";
        if ($BCC != '') {
            $headers .= 'Bcc:' . $BCC . "\r\n";
        }
       
        mail($to, $subject, $msg, $headers);


        
                
     } 
        
     /*
     * 
     * Subscription Add
     * 
     * 
     */

//    function subscription_add_mail($to_emailid, $CC = '', $data) {
//
//        $subject = 'Subscription mail (To extend the period)  ';
//        $msg = '';
//
//        $msg .= '<table width="700" border="0" cellspacing="0" cellpadding="0" align="center">
//                    <tr>
//                      <td align="left" valign="top" style="border:solid 2pt #2d4571; mso-border-top-alt:solid 2pt #2d4571; mso-border-left-alt:solid 2pt #2d4571; border-bottom-left-radius: 15px;border-bottom-right-radius:15px; border-top-left-radius: 15px; border-top-right-radius: 15px; background-color:#FFF;">
//                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
//                       <tr>
//                      <td colspan="3" height="10">&nbsp;</td>
//                    </tr>
//
//                    <tr>
//                      <td colspan="3" style="padding:25px 10px 5px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif;font-weight:bold;">
//                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
//
//
//                  </table>
//                  </td>
//                    </tr>
//
//                    <tr>
//                      <td colspan="5" style="padding:0px 10px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif;">
//                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
//                    <tr>
//                      <td colspan="4" style="padding:10px 10px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif; background-color:#f0ddb4; color:#000000; border:1px solid #e2cfa8;"><strong>Subscription for Extension!  ' . $data["cNamed"] . '</strong></td>
//                      </tr>
//
//                    <tr>
//                       <td colspan="4"  style="padding:5px 10px; margin:0px; text-align:left; font-family:Arial, Helvetica, sans-serif; background-color:#fffbef; color:#000000; border:1px solid #f9f3e1; font-size:14px;">Dear  ' . $data["userName"] . ',</td>
//
//                    </tr>
//                    <tr><td colspan="4"  style="padding:5px 10px; margin:0px;"></td></tr>
//                    <tr><td colspan="4"  style="padding:5px 10px; margin:0px;"></td></tr>
//                    <tr><td colspan="4"  style="padding:5px 10px; margin:0px;"></td></tr>
//                    <tr><td colspan="4"  style="padding:5px 10px; margin:0px;"></td></tr>
//                    <tr><td colspan="4"  style="padding:5px 10px; margin:0px;"></td></tr>
//                    <tr><td  colspan="4"  style="padding:5px 10px; margin:0px; text-align:left; font-family:Arial, Helvetica, sans-serif; background-color:#fffbef; color:#000000; border:1px solid #f9f3e1; font-size:14px;">
//                    
//                        TRACER Portal subscription was extended for another '.$data["month"].' month. You can continue our services & Use the same Log-in credential.
//
//                        </td>
//                    </tr>
//                  </table>
//
//                  </td>
//                    </tr>
//                    <tr>
//                      <td colspan="5" style="padding:10px 10px 0px; margin:0px; text-align:center; font-family:Arial, Helvetica, sans-serif;">
//                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
//                    
//                    <tr>
//                      <td style=" font-family:Arial, Helvetica, sans-serif; padding:5px 10px 5px 10px; text-align:left; margin:0px; font-size:14px; font-weight:normal; color: #333333; letter-spacing:0.1px; line-height:22px;"><strong>Thank you,</strong><br>
//                  The ecfirst Team
//                      </td>
//                    </tr>
//                  </table>
//                  </td>
//                    </tr>
//                  </table>
//                  </td>
//                    </tr>
//                  </table>';
//
//                $headers = 'MIME-Version: 1.0' . "\r\n";
//                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
//                $headers .= 'From: ecfirst < no-reply@ecfirst.com >' . "\r\n";
//                if ($CC != '') {
//                    $headers .= 'Cc:' . $CC . "\r\n";
//                }
//
//                $headers .= "Bcc:Bhuvaneswari@pabrai.com" . "\r\n";
//
//
//                mail($to_emailid, $subject, $msg, $headers);
//        }

}//end class