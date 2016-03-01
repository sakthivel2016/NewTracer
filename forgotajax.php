<?php
include('classes/general.php');
include('classes/mail_template.php');
$mail_mgt = new Mail_Template();

$tracer = new Tracer();

$forgotusername = trim($_POST['username']);

if ($forgotusername != '') {
    
    $forgotusername = $forgotusername;
    
    $sqlsel = "select user_id,user_email,user_password,user_name,status from " . $table_prefix . "users where user_name= '" .mysql_real_escape_string($forgotusername) . "' and active = '1'";
    
    $qrypas = mysql_query($sqlsel) or die("Error: (" . mysql_errno() . ") " . mysql_error());
    
    $res = mysql_fetch_assoc($qrypas);

    if ( (mysql_num_rows($qrypas) > 0) && ($res['status'] == 1) ) {

        $rand_pass = $tracer->randStrGen(10);   
        
        $token = $tracer->randStrGen(50, false);   
                           
        $user_password = $tracer->encrypt_decrypt( $rand_pass , $action = 'encrypt');
        
        $update_date = date('y-m-d H:i:s');
                       
        mysql_query('UPDATE tr_users SET token="' . $token . '", user_password="' . $user_password . '", updated_date="' .$update_date. '", active = 2 WHERE user_email = "' . $res['user_email'] . '" AND user_name= "' . $res['user_name'] . '"');
          
       $data = array('forgotemail' => $res['user_email'], 'user_name' => $res['user_name'], 'token' => $token, 'user_password' => $user_password);
      
       
       $mail_mgt->forgot_password_mail($to_emailid = '', $from_id = '', $subject = '', $data);
        $result = array( 'password' => $random ,'mess' => '<span style="color:green;"><b>A link to reset your password has been sent to your email. Please check it.</b></span>' );
    } else {
        
       // if($res['status'] == 0){
            
                //SUSCRIPTION MAIL ALERT
                //$mail_mgt->subscribe_mail($to_emailid = '', $from_id = '', $subject = '', $data);
              //  $result = array( 'mess' => '<span style="color:green;"><b>Please check your mail..</b></span>' );
        //}else{
    
                $result =  array( 'mess' => '<span style="color:red;">Username does not exists. Please try another one!</span>');
        //}
    }
    echo json_encode($result);
        exit;
}
?>