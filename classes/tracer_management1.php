<?php
class tracer_management1 {
    
    function __construct(){
        
    }
     public function getMailAssignData($user_id){
            $sql = mysql_query("SELECT * FROM tr_mail_assign WHERE client_id = '".$user_id."'");
            $res = mysql_fetch_object($sql);
            return $res;
    }
    public function getUserName($field = '' , $user_id = ''){

        if($user_id == ''){
        
        }
        $sql = "SELECT ".$field." FROM tr_users WHERE user_id='".$user_id."'";
        $qrysql = mysql_query($sql) or die("Error: (" . mysql_errno() . ") " . mysql_error());
        return $qrysql;
   }
      public function ra_dcf_percent(){

           
            $sql_ra_dcf = mysql_query('SELECT * FROM tr_ra_dcf WHERE user_id= '.$_SESSION['ses_user_id'].' ORDER BY radcf_id ASC');
            $ra_dcf_val[] = mysql_fetch_assoc($sql_ra_dcf);
            $sql_ra_dcf_grid = mysql_query('SELECT * FROM tr_ra_dcf_grid WHERE user_id= '.$_SESSION['ses_user_id'].' ORDER BY ra_dcf_grid_id ASC');
            $ra_dcf_grid[] = mysql_fetch_assoc($sql_ra_dcf_grid);
            
            $p      = intval( $this->percentage(2,16,$ra_dcf_val,false) );
            $p1     = intval( $this->percentage(18,3,$ra_dcf_grid,false) );
            $percentage = intval(($p+$p1) / 19 * 100);

            if($percentage == 100 && ($ra_dcf_val[0]['completed_mail'] != 1)){

            $mail = $this->getMailAssignData($_SESSION['ses_user_id']);
            
            $res = mysql_fetch_assoc($this->getUserName( 'user_name' ,$_SESSION['ses_user_id']));

            $this->completion_mail( $mail->email_list , $from = '', $subject, $ra_dcf_val, $form='RA DCF', $res['user_name']);
            mysql_query('UPDATE tr_ra_dcf SET completed_mail=1 WHERE user_id="'.$_SESSION['ses_user_id'].'"');
           }
            return $percentage;
        }
     public function ra_dcaf_percent(){

            
            $select_form_fields = mysql_query('SELECT * FROM tr_ra_dcaf WHERE user_id= '.$_SESSION['ses_user_id']);
            $percentage = '';
            $i =0;
            while ($totalrow = mysql_fetch_assoc($select_form_fields)) {
                $rowcommon = array($totalrow);
                $percentage  = $percentage + $this->percentage(1,4,$rowcommon);
                $i++;
            }
            if(intval($percentage/$i) == 100 && ($rowcommon[0]['completed_mail'] != 1)){

             $mail = $this->getMailAssignData($_SESSION['ses_user_id']);
             $res = mysql_fetch_assoc($this->getUserName( 'user_name' ,$_SESSION['ses_user_id']));  
             $this->completion_mail( $mail->email_list , $from = '',$subject,$rowcommon, $form='RA DCAF', $res['user_name']);
             mysql_query('UPDATE tr_ra_dcaf SET completed_mail=1 WHERE user_id="'.$_SESSION['ses_user_id'].'"');
             }

            return intval($percentage/$i).'%';
        }
    public function percentage($page_start ,$total_page,$data , $flag = true) {
            $k = $page_start;
            $j = 0;
            
            //print_t($data);
            foreach ($data as $keys => $values) {
                foreach ($values as $key => $value) {
                    $sk = 'page' . $k;

                    if ($key == $sk) {

                        $page = unserialize(urldecode($value));

                        foreach ($page as $pkey => $pvalue) {
                            if (trim($pvalue) != '') {
                                $j++;
                                break;
                            }
                        }

                        $k++;
                    }
                }
            }
            
            if($flag){
                $percent = intval($j / $total_page * 100);
            }else{
                $percent = $j;
            }
            
            return $percent;
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
    
  

//End
}//End Class