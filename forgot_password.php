<?php
include('classes/general.php');
$tracer = new Tracer();
$password_reset_initiated = 0;
 
if(isset($_GET['token'])){
    
    $token = $_GET['token'];
     
    $sqlsel = "select user_email, user_name, updated_date, user_password from tr_users where token LIKE '" . $token . "' AND active = '2' AND status = '1'";
    
    $qrypas = mysql_query($sqlsel) or die("Error: (" . mysql_errno() . ") " . mysql_error());

    if (mysql_num_rows($qrypas) > 0){
        $res = mysql_fetch_assoc($qrypas);
        $dbTime = $res['updated_date']; 
        
        $end = strtotime($dbTime) + 900 ;  //900 = 15 min X 60 sec
        
        $endTime = date('Y-m-d H:i:s',$end); 
        
        
        $currentTime = date('Y-m-d H:i:s'); 
      
        
        $str_time = strtotime($endTime);
        $cur_time = strtotime($currentTime);
        
        if ($str_time >= $cur_time){ 
           
           $password_reset_initiated = 1;
            
        }else{
           $password_reset_initiated = 0;
           $res = mysql_query('UPDATE tr_users SET active = 1 WHERE token= "'. $token.'" AND user_name = "' . $res['user_name'] . '"');
        }
    }
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>   
<head>
        <title>..::Tracer - Risk Analysis Tool::..</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <!--[if lte IE 8]>
                    <link rel="stylesheet" type="text/css" href="css/menu_i8.css" />
            <![endif]-->
            <!--[if lte IE 9]>
                    <link rel="stylesheet" type="text/css" href="css/menu_i9.css" />
            <![endif]-->
            <link rel="shortcut icon" href="image/icons-t.gif" />
            <link href="css/login.css" rel="stylesheet" type="text/css"></link>
            <link href="css/button.css" rel="stylesheet" type="text/css"></link>

            <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
            <script type="text/javascript" src="js/plugins/jquery-1.7.min.js"></script>
            <script type="text/javascript" src="js/plugins/jquery-ui-1.8.16.custom.min.js"></script>
  
</head>
<style>
    #chgpass_form{
        margin-left:5px;
    }
     #chgpass_form .short{
        color:#FF0000;
    }
     #chgpass_form .weak{
        color:#E66C2C;
    }
     #chgpass_form .good{
        color:#2D98F3;
    }
     #chgpass_form .strong{
        color:#006400;
    }
   
    #error{
       color:red;
       fonr-size:14px;
       margin-left: 20px;
    }
</style>
<script>
  
    function brfore_load(){
                    var container = '#container_content';

                    jQuery(container).append('<div class="ajaxloaderoverlay"><div class="ajaxloader"></div></div>');
                    jQuery(container).find('#wizard').css({'background':''});
                    jQuery(container).find('#wizard').animate({opacity: ".4"});

                    var overlay  = jQuery(container).find('.ajaxloaderoverlay'); 
                    var loader  = jQuery(container).find('.ajaxloader');  

                    overlay.css({ "position":'absolute',"top":'250px',"left":'586px'});
                    loader.css({"margin":0,"padding":0,"position":'absolute'});
    }// End before load fun

    function checkStrength(password){
       
       //initial strength
       var strength = 0

       //if the password length is less than 6, return message.
      //alert(password.length);
       if (password.length < 6 && password.length != 0) {
           $('#result').removeClass()
           $('#result').addClass('short')
           return 'Too short'
       }

       //length is ok, lets continue.

       //if length is 8 characters or more, increase strength value
       if (password.length > 7) strength += 1

       //if password contains both lower and uppercase characters, increase strength value
       if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/))  strength += 1

       //if it has numbers and characters, increase strength value
       if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/))  strength += 1 

       //if it has one special character, increase strength value
       if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/))  strength += 1

       //if it has two special characters, increase strength value
       if (password.match(/(.*[!,%,&,@,#,$,^,*,?,_,~].*[!,",%,&,@,#,$,^,*,?,_,~])/)) strength += 1

       //now we have calculated strength value, we can return messages

       //if value is less than 2
       if (strength < 2 && password.length != 0) {
           $('#result').removeClass()
           $('#result').addClass('weak')
           return 'Weak'
       }else if (strength == 2 && password.length != 0) {
           $('#result').removeClass()
           $('#result').addClass('good')
           return 'Good'
       }else if(password.length != 0) {
           
           $('#result').removeClass()
           $('#result').addClass('strong')
           return 'Strong'
       }else{
           return ''
       }
   }
    function brfore_load(){
                    var container = '#container_content';

                    jQuery(container).append('<div class="ajaxloaderoverlay"><div class="ajaxloader"></div></div>');
                    jQuery(container).find('#wizard').css({'background':''});
                    jQuery(container).find('#wizard').animate({opacity: ".4"});

                    var overlay  = jQuery(container).find('.ajaxloaderoverlay'); 
                    var loader  = jQuery(container).find('.ajaxloader');  

                    overlay.css({ "position":'absolute',"top":'250px',"left":'586px'});
                    loader.css({"margin":0,"padding":0,"position":'absolute'});
    }// End before load fun
   function message_container(response){
                var container = '#container_reset';

                jQuery(container).append('<div class="success1">'+response.mess+'</div>');
                var load_msg  = jQuery(container).find('.success1');  

                if(response){
                    load_msg.css({ "position":'absolute',"top":'250px',"left":'586px',"z-index":"100"}).delay( 5800 ).fadeOut('slow');
                }else{
                load_msg.css({ "position":'absolute',"top":'250px',"left":'586px',"z-index":"100"}).delay( 1800 ).fadeOut('slow');
                }
    }// End message fun
    function validatePassword() {

    var passRegex = /^(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/; 
    //var passRegex = /^(?=.*?[#?!@$%^&*-]).{8,}$/; 
    var p = document.getElementById('password2').value;
    
    var errors = [];
    
    
    if (p.length < 6) {
      document.getElementById('password2').focus();
      $('.tr_message').html('Your password must be at least 6 characters');
     //errors.push("Your password must be at least 8 characters"); 
     return false;
    }
    /*if (p.search(/[a-z]/i) < 0) {
    errors.push("Your password must contain at least one letter."); 
    }
    if (p.search(/[0-9]/) < 0) {
    errors.push("Your password must contain at least one digit."); 
    }*/
    if (!passRegex.test(p)) {
        document.getElementById('password2').focus();
        $('.tr_message').html('Password should contain a mix of capital and lower-case letters, numbers and symbols');
        //alert("password should contain atleast one special character");
        //errors.push("password should contain atleast one special character"); 
        return false;
    }
   
    if (errors.length > 0) {
    //alert(errors.join("\n"));
    return false;
    }
   return true;
 }
      

     $(document).ready(function () {
         
       var message = $(".tr_message");
          
       $('#password2').keyup(function(){
                 
                    $('#result').html(checkStrength($('#password2').val()))
       })
        $('#password').keyup(function(){
                    $('#result').html(checkStrength($('#password').val()))
                    
       })
    
      $( "#subSubmit" ).on( "click", function( event ) {
          
                var pass1 = $.trim($("#password").val());
                var pass2 = $.trim($("#password2").val()); 
                var check;
                
                if(pass1 == ''){
                    alert("Please enter Password");
                    return false;
                }else if(pass2 == ''){
                    alert("Please enter Confirm Password");
                    return false;
                }else if (pass1 != pass2){
                    alert("Passwords do not match");
                    return false;
                }
                
                    var target      = $( event.target );
                    var form_val    = $("#chgpass_form").serializeArray();
                    var stat;
                    var checkstrength = (checkStrength($('#password2').val()));
                    if(checkstrength == 'Weak' || checkstrength == 'Too short'){
                        alert("Confirm password do not make Weak and Too Short! Please make Good and Strong");
                        stat = false;
                    }else if(checkstrength == 'Good' || checkstrength == 'Strong'){
                        stat = true;
                    }
                   var checkpassword = validatePassword();
                  
                   
                     if(stat && checkpassword){
                                       
                            jQuery.ajax({
                                type: "POST",
                                url: 'user/process.php',
                                data: {
                                    chg_pass    : 1,
                                    formdata    : form_val,
                                    token: '<?php echo $token; ?>',
                                    user_name: '<?php echo $res['user_name']; ?>',
                                    useremail: '<?php echo $res['user_email']; ?>'
                                     
                                },
                                success: function( res ){
                                    //var response = jQuery.parseJSON(res);
                                     //jQuery('#container_content .ajaxloaderoverlay').remove();   
                                     //alert(response.mess);
                                     //if ( target.is( "#tr_home" ) ){
                                      // message_container(response);
                                      $('#errorg').html('<span style="color:#65952f;"><b>You have successfully changed your password</b></span>').show().delay( 6800 ).slideUp();
                                     //}
                                     //$('#result').html('');
                                     window.location = 'logout.php';
                                     //$("#chgpass_form input").val('');


                               },
                               beforeSend: function( xhr ) {
                                    if ( target.is( "#tr_home" ) ) {
                                        brfore_load();
                                    }


                                }
                            });
                  }
                    
                    return false;
        
        
        });
        
        
      
        
       $('#forgot_Submit').on('click' , function(){
        
        if( $.trim($('#username').val()) === '' ){
            message.html('<span style="color:red;">Please enter the Username</span>').show().delay( 6800 ).slideUp();
           
        }else{
        
            jQuery.ajax({
                type: "POST",
                url: "forgotajax.php",
                data: { username: $('#forgot_form #username').val() },
                success: function( res ) {
                    var response = jQuery.parseJSON(res);
                    //console.log(res);
                   // message.html("Loading...");
                    message.html(response.mess).show();
                }
            });
        }
    });
});
    
</script>
<div id="container_reset" class="clearfix page-full" style="position:relative;border-radius:10px;">
<table width="100%" cellspacing="0" cellpadding="0" border="0">
<?php 
if($password_reset_initiated == 1){
    ?>
    
        <tbody><tr>
                <td valign="top" class="c12_ltbg"><img alt="" src="image/spacer.gif"></td>
                <td valign="top" class="c12_mid" style="position:relative; border-radius:10px; background:url(image/changepassword.png) #ffffff -309px 0px no-repeat; height:492px; vertical-align:middle" valign="middle" align="center">
                    <!--  PAGES  BEGINS	--> 
                    <form id="chgpass_form" action="index.php">
                        <table width="683" style="margin-left:357px;" border="0" cellspacing="0" cellpadding="0">
                             <tr>
                                 <td style="font-size:13pt; color: #65952f;"><h2 style=" padding:10px 0px; border-bottom: 1px solid #b1b1b1; font-weight: normal;">Password Reset</h2></td>
                             </tr>
                            <tr>
                                <td style="font-size:12pt; color: #333333;">Passwords are case-sensitive and must be at least 6 characters.</td>
                            </tr>  
                            <tr>
                                <td style="font-size:12pt; color: #333333;">A good password should contain a mix of capital, lower-case letters, numbers and symbols.</td>
                            </tr>   
                        </table> 
                        <span id="errorg"></span>

                        <table width="460" height="150" style="margin-left:140px;" border="0" cellspacing="0" cellpadding="0">

<td style="font-size:14pt;"></td>
                                <td style="font-size:14pt; width:318px; height: 30px;">
                                    <div class="tr_message" style=" color: #FF0000;font-size:10pt; padding-top: 12px;"></div> 
                       </td>
                            </tr>
                            <tr>
                                <td style="font-size:12pt;">New Password :</td>
                                <td style="font-size:12pt; width:276px; height: 38px;"><input style="-webkit-box-shadow: 0px 0px 33px -7px rgba(201,201,201,1);-moz-box-shadow: 0px 0px 33px -7px rgba(201,201,201,1);
box-shadow: 0px 0px 33px -7px rgba(201,201,201,1); border:1px solid #CCC; border-radius:3px; width: 100%; padding:3px 10px;" id="password"  name="password" type="text" placeholder="Enter text here.." class="width97" value="">

                                </td>
                            </tr>
                            <tr>
                                <td style="font-size:12pt;">Confirm Password :</td>
                                <td style="font-size:12pt; width:276px; height: 38px;"><input style="-webkit-box-shadow: 0px 0px 33px -7px rgba(201,201,201,1);
-moz-box-shadow: 0px 0px 33px -7px rgba(201,201,201,1);
box-shadow: 0px 0px 33px -7px rgba(201,201,201,1); border:1px solid #CCC; border-radius:3px; width: 100%; padding:3px 10px;" id="password2" name="password2" type="text" placeholder="Enter text here.." class="width97" value="">
                                    <span id="result"></span>

                                </td>
                            </tr>

                            <tr>
                                <td style="font-size:14pt;">&nbsp;</td>
                                <td colspan="2" style="text-align:left; height: 32px;" valign="middle" class="forgot_form">
                                     <div>
                                             <input class="login_submit" type="submit" name="subSubmit" id="subSubmit" value="Submit" />
                                     </div>
                                </td>
                            </tr>
                        </table>
                    </form>
                    <!--  PAGES  ENDS	-->

                </td>
                <td valign="top" class="c12_rtbg"><img alt="" src="image/spacer.gif"></td>
            </tr>
        </tbody>

    <?php }else { ?>
    

        <tbody><tr>
                <td valign="top" class="c12_ltbg"><img alt="" src="image/spacer.gif"></td>
                <td valign="top" class="c12_mid" style="position:relative; background:url(image/changepassword.png) #ffffff -309px 0px no-repeat; height:492px; border-radius:10px; vertical-align:middle" valign="middle" align="center">
                    <!--  PAGES  BEGINS	--> 
                    <div id="forgot_form" name="forgot_form">
                          
                        <table width="683" style="margin-left:357px;" border="0" cellspacing="0" cellpadding="0">
                             <tr>
                                 <td style="font-size:13pt; color: #65952f;"><h2 style=" padding:10px 0px; border-bottom: 1px solid #b1b1b1; font-weight: normal;">Password Reset</h2></td>
                             </tr>
                            <tr>
                                <td style="font-size:12pt; color: red; padding-top: 10px;"><b>The password reset link was expired, please try again by generating a new link.</b></td>
                            </tr> 
                            
                            <tr>
                                <td style="font-size:12pt;">If you've forgotten your password, enter your username below and we'll send you instructions on how to securely change your password.</td>
                            </tr> 
                          
                        </table> 
                        <span id="error" style=" font-size: 10px;"></span>

                        <table width="420" height="36" style="margin-left:100px;" border="0" cellspacing="0" cellpadding="0">
<tr>
                                <td style="font-size:14pt;"></td>
                                <td style="font-size:14pt; width:318px; height: 30px;">
                                    <div class="tr_message" style=" display: none; font-size:10pt;  padding-bottom: 12px;"></div> 
                       </td>
                            </tr>

                            <tr>
                                <td style="font-size:14pt;">Username :</td>
                                <td style="font-size:14pt; width:318px;">
                                    
                                    <input style="-webkit-box-shadow: 0px 0px 33px -7px rgba(201,201,201,1);-moz-box-shadow: 0px 0px 33px -7px rgba(201,201,201,1);
box-shadow: 0px 0px 33px -7px rgba(201,201,201,1); border:1px solid #CCC; border-radius:3px; padding:3px 10px; width: 100%;" id="username"  name="username" type="text" placeholder="Enter text here.."  value="">
                                        <span id="message"></span>
                                </td>
                            </tr>
                       
                            <tr>
                                <td style="font-size:14pt;">&nbsp;</td>
                                <td  style="text-align:left; padding:10px 0px; " valign="middle" class="forgot_form">
                                    <input class="forgot_Submit" type="submit" name="forgot_Submit" id="forgot_Submit" value="Submit" />
                                </td>
                            </tr>
                        </table>
                    </div>
                    <!--  PAGES  ENDS	-->

                </td>
                <td valign="top" class="c12_rtbg"><img alt="" src="image/spacer.gif"></td>
            </tr>
        </tbody>

    
    <?php } ?>

</table>
</div>
</html> 