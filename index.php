<?php

include('classes/general.php');
$tracer = new Tracer();


$user = trim($_POST["txtUsername"]);
$pass = trim($_POST["txtPassword"]);

//echo $ds = disk_free_space("/");
$err = '';
if (isset($_POST) && $user != '' && $pass != '') {
ob_start();
session_start();
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
                        
                            header("Location:boards.php");
                        }else{
                            header("Location:boards.php");
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
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<meta name="description" content="" />
<meta name="author" content="" />
<title>Tracer Login</title>
<link href="assets/css/bootstrap.css" rel="stylesheet" />
<link href="assets/css/font-awesome.css" rel="stylesheet" />
<link href="assets/css/style.css" rel="stylesheet" />
<link href="assets/css/core.css" rel="stylesheet" />


<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
            <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
            
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
<header style="display:block;"> 
<a class="header-logo" href="#" aria-label=""> <span class="header-logo-default"></span> </a>
<div class="user-settings-wrapper header-user">
                    <ul class="nav">

                        <li class="dropdown">
                            <a class="dropdown-toggle header-btn dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                                <span class="header-btn-icon icon-lg icon-information light"></span>
                            </a>
                            <div class="dropdown-menu dropdown-settings">
                                <div class="media">
                                    <div class="media-body">
                                        <h4 class="media-heading tac">About Tracer </h4>
                                    </div>
                                </div>

                                <hr />
                                <a href="#" class="btn btn-sm">Tour</a>&nbsp; <a href="" class="btn btn-sm">Blog</a>&nbsp; <a href="" class="btn btn-sm">More...</a>

                            </div>
                        </li>


                    </ul>
                </div>
              
</header>
<img src="assets/img/top.jpg" alt="Client Logo" width="100%" title="Client Logo"   style="display:none;"/>
<!-- HEADER END-->
<div class="navbar navbar-inverse set-radius-zero">
  <div class="container">
    <div class="left-div">
      
    </div>
  </div>
</div>
<div class="navbar-inverse">
  <div class="container">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#login" data-toggle="tab">Login</a></li>
    </ul>
  </div>
</div>
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="col-md-4"> </div>
      <div class="col-md-4">
        <div class="tab-content">
          <div class="tab-pane fade active in" id="login" style="text-align:center;">
              <h4 style="text-align:center; margin-top:50px; font-size:20px;"> <strong>Please Enter Your Login Information</strong></h4>
              <br>
              <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="form1" id="form1">
                        <div class="loginmsg">
                            <div id="errdis">  
                                <p style="display:block;"> <?php echo $err; ?></p>
                            </div>
                        </div>
              <input type="text" class="form-control fm" required autocomplete="off" placeholder="Username" id="txtUsername" name="txtUsername"><br>
              <input type="password" class="form-control fm" required autocomplete="off" placeholder="Password" name="txtPassword" id="txtPassword">
              <hr>
              <input type="submit" class="btn btn-default" value="Login" style="padding: 10px 40px;border-right: 3px solid #888888;border-radius: 6px;border-bottom: 3px solid #888888;">
              <hr>
              <p>Fogot Password? <a href="#" id="forgot_password"> Click here </a> </p>
              </form>
            </div>
        </div>
      </div>
      <div class="col-md-4"> </div>
    </div>
  </div>
</div>
<!-- LOGO HEADER END-->
<section class="menu-section">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="navbar-collapse collapse ">
          <ul id="menu-top" class="nav navbar-nav navbar-right">
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>
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
<script src="assets/js/jquery-1.11.1.js"></script>
<script type="text/javascript" src="js/plugins/jquery-1.7.min.js"></script>
            <script type="text/javascript" src="js/plugins/jquery-ui-1.8.16.custom.min.js"></script>
<!-- BOOTSTRAP SCRIPTS  -->
<script src="assets/js/bootstrap.js"></script>
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
