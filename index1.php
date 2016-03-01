<?php
include('classes/general.php');
$tracer = new Tracer();

$user = trim($_POST["txtUsername"]);
$pass = trim($_POST["txtPassword"]);

//echo $ds = disk_free_space("/");
$err = '';
if (isset($_POST) && $user != '' && $pass != '') {

    $sqlsel = "select user_id, user_password from " . $table_prefix . "users where user_name = '" . mysql_real_escape_string($user) . "' and status = '1' and active = '1'";
    
    $qrysel = mysql_query($sqlsel) or die("Error: (" . mysql_errno() . ") " . mysql_error());
    if (mysql_num_rows($qrysel) > 0) {
        
        $rowfetch = mysql_fetch_array($qrysel);
        
        $pass = $tracer->encrypt_decrypt($pass, $action = 'encrypt');
        
        if($pass == $rowfetch['user_password']){
                        
                $sqlpas = "select u.user_id, u.user_role,u.status,u.active, u.user_group, u.user_name, u.va_type, u.user_email, um.user_cname, um.menu_tab, um.locked_status from " . $table_prefix . "users as u INNER JOIN " . $table_prefix . "user_meta as um ON um.user_id=u.user_id where user_name = '" . mysql_real_escape_string($user) . "' and u.user_password = '" . mysql_real_escape_string($pass) . "' and u.status = '1' and u.active = '1'";
                                
                   $qrypas = mysql_query($sqlpas) or die("Error: (" . mysql_errno() . ") " . mysql_error());

                    if (mysql_num_rows($qrypas) > 0) {
                        $rowfetch = mysql_fetch_array($qrypas);
                                          
                        $get_role = mysql_query("select user_id, role from tr_multi_assign where client_id = '" . $rowfetch["user_id"]. "'");
                        
                        $_SESSION["ses_user_role"] = $rowfetch["user_role"];
                         
                        if (mysql_num_rows($get_role) > 0) {
                                   $row_get_multi = mysql_fetch_array($get_role);
                                  
                                   $_SESSION["ses_user_role"] = $row_get_multi["role"];
                                   $_SESSION["ses_multi_id"] = $row_get_multi["user_id"];
                                     
                        }
                         
                        $_SESSION["ses_user_id"] = $rowfetch["user_id"];
                        $_SESSION["ses_user_name"] = $rowfetch["user_name"];
                       
                        $_SESSION["ses_almgtype"] = $rowfetch["user_group"];
                        $_SESSION["ses_status"] = $rowfetch["status"];
                        $_SESSION["ses_active"] = $rowfetch["active"];
                        $_SESSION["ses_user_email"] = $rowfetch["user_email"];
                        $_SESSION["ses_va_type"] = $rowfetch["va_type"];
                        $_SESSION["ses_user_cname"] = $rowfetch["user_cname"];
                        $_SESSION["ses_menu_tab"] = $rowfetch["menu_tab"];
                        $_SESSION["ses_locked_status"] = $rowfetch["locked_status"];
                        $_SESSION['start'] = time();
                        $_SESSION['expire'] = $_SESSION['start'] + (50 * 60);
                        $_SESSION['last_action'] = time();

                        $sqlupd = "update " . $table_prefix . "user_meta set user_lastvisit = now() where user_id = '" . $rowfetch["user_id"] . "'";
                        $qryupd = mysql_query($sqlupd) or die("Error: (" . mysql_errno() . ") " . mysql_error());

                        if($_SESSION["ses_user_role"] != 5){
                            
                            header("Location:welcome.php");
                        }else{
                            header("Location:multi_welcome.php");
                        }
                        exit();
                    } 
        }else {
                $err = 'The Username / Password does not exist';
        }  
               
     
    } else {
        $err = 'The Username / Password does not exist';
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

            <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
            <script type="text/javascript" src="js/plugins/jquery-1.7.min.js"></script>
            <script type="text/javascript" src="js/plugins/jquery-ui-1.8.16.custom.min.js"></script>
            <!--<link href="css/bootstrap.min.css" rel="stylesheet">
            <link rel="stylesheet" type="text/css" href="css/style1.css"/>
            <script src="js/ModalPopupWindow.js" type="text/javascript"></script>-->

            <script>
                function checklogin() {
                    /*var user = document.form1.txtUsername.value;
                     var pwd = document.form1.txtPassword.value;
                     var userlen = user.length;
                     var pwdlen = pwd.length;
                     if (user == "") {
                     document.getElementById('errdis').innerHTML = "Please Enter Your Username";
                     document.form1.txtUsername.focus();
                     return false;
                     } else if (userlen <= 3) {
                     document.getElementById('errdis').innerHTML = "Username should not be less than 3 character";
                     document.form1.txtUsername.focus();
                     return false;
                     } else if (pwd == "") {
                     document.getElementById('errdis').innerHTML = "Please Enter Your Password";
                     document.form1.txtPassword.focus();
                     return false;
                     } else if (pwdlen <= 3) {
                     document.getElementById('errdis').innerHTML = "Password should not be less than 3 character";
                     document.form1.txtPassword.focus();
                     return false;
                     }*/
                }
                function clearerr() {
                    document.getElementById('errdis').innerHTML = "";
                }

                var img = new Image();
                img.src = 'image/bg-jj-main.png';
                var img = new Image();
                img.src = 'image/login-pages.png';
                <!--alert("test");-->       

            </script> 
            <style>
                .cp_dialog_header .cp_title {
                    font-size: 18px;
                    font-weight: 700;
                }
                .cp_title {
                    float: left;
                    font-size: 14px!important;
                    text-align: center;
                    width: 100%;
                    padding-top: 12px;
                    padding-bottom: 10px;
                }
                fieldset {
                    border: 1px solid #ddd;
                    padding: 1.25rem;
                    margin: 1.125rem 0;
                }
                .reveal-modal .close-reveal-modal, dialog .close-reveal-modal, .cp_close {
                    font-size: 1.9rem;
                    line-height: 1;
                    position: absolute;
                    top: .5rem;
                    right: .6875rem;
                    color: #aaa !important;
                    font-weight: 100;
                    cursor: pointer;
                }
            </style>
            
    </head>
    <body>
    
        <div class="login_cont" style="position:relative;">
        <div class="ie8_css">
    <div class="iee8">
    <div class="login_iee8"><img src="image/ie88.png"></div></div>
    </div>
            <div class="login_img">
                <div class="login_inp">

                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="form1" id="form1" onSubmit="return checklogin();">

                        <div class="loginmsg">
                            <div id="errdis">  
                                <p style="display:block;"> <?php echo $err; ?></p>
                            </div>
                        </div>
                        <div class="username overtext">
                            <input type="text" required="required" id="txtUsername" name="txtUsername" placeholder="Email" class="login_txtusername"/>
                            <p class="logintext">
                                Username 
                            </p>
                        </div>

                        <div class="password overtext">
                            <input type="password" id="txtPassword" autocomplete="off" required="required" name="txtPassword" placeholder="Password" class="overtext"/>
                            <p class="logintext">
                                Password
                            </p>
                        </div>
                        <div class="submit_but">
                            <input class="login_submit" type="submit" name="subSubmit" id="subSubmit" value="" />
                        </div>
                        <div class="keep"><a href="#" id="forgot_password"><img src="image/forgot-pass.png" title="Forgot password? click here" alt="Forgot password? click here" width="174" height="15"></a></div>
                    </form>
                </div>
            </div>
        </div>
        
        <!----------------------------------------------------------------------------------->
        
        <div class="forgot_password_container" style="display:none;">
            <div class="cp_dialog_header">
                <div class="cp_title">Forgot Password</div>
                <div> <span class="cp_close"> <a class="close-reveal-modal">×</a></span></div>
            </div>
            <fieldset>

                <div name="forgot_form" id="forgot_form" class="forgot_form">
                    
                    <div class="tr_message" style=" display: none; font-size: smaller;  padding-bottom: 16px;"></div>                    
                    <span class="lable"> Username : </span> 
                    <input style="width: 88%;" type="text" name="username" id="username" class="" value="" />

                    <div style="text-align: center;clear: both; margin: 20px 0;">
                        <input type="submit" name="forgot_Submit" value="Send" id="forgot_Submit"/>
                    </div>
                    <p style="font-size: smaller;">A reset password will be sent to the associated email address.</p>
                </div>
            </fieldset>

        </div>
        
        <!------------------------------------------------------------------------------------>
    </body>
</html>

<script>

 $(document).ready(function () {
     
    var message = jQuery(".tr_message");
     
    jQuery("#forgot_password").click(function(){
            jQuery(".forgot_password_container").dialog({
               minWidth: 600,
               minHeight:250,
               draggable:false,
               position: "center",
               modal: true,
               open: function(ev, ui) { 
               }
             });
             jQuery(".ui-dialog-titlebar").css({'display':'none'});
             jQuery(".ui-dialog").css({'box-shadow':'5px 5px 20px #000'});
    });
    
    $(document).on('click','.cp_close',function(){  // Close
        message.hide();
        jQuery(this).parent().parent().parent().dialog('close');
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
                    message.html(response.mess).show();
                }
            });
        }
    });
    
    
});

</script>