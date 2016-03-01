<?php
error_reporting(0);
include('classes/general.php');
$tracer = new Tracer();
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<meta name="description" content="" />
<meta name="author" content="" />
<title>..::Tracer - Risk Analysis Tool::..</title>
<link href="assets/css/bootstrap.css" rel="stylesheet" />
<link href="assets/css/font-awesome.css" rel="stylesheet" />
<link href="assets/css/style.css" rel="stylesheet" />
<link href="assets/css/core.css" rel="stylesheet" />
</head>
<body>
<header style="display:block;"> <a class="header-logo" href="#" aria-label=""> <span class="header-logo-default"></span> </a>
  <div class="header-boards-button"><a class="header-btn header-boards js-boards-menu" href="#"><span class="header-btn-icon icon-lg icon-board light"></span><span class="header-btn-text">Boards</span></a></div>
  <div class="header-search">
    <input class="header-search-input js-search-input js-disable-on-dialog" autocomplete="off" autocorrect="off" spellcheck="false" value="" type="text">
    <span class="header-search-icon icon-lg icon-search light js-search-icon js-search-focus"></span> </div>
  <div class="user-settings-wrapper header-user">
    <ul class="nav">
      <li class="dropdown"> <a class="header-btn header-member js-open-header-member-menu" href="#" aria-label="" style="padding-left:0px;"> <span class="member"> <span class="member-initials" title=""><img src="assets/img/user-icon.png" /></span> </span> <span class="header-btn-text"><?php echo ucwords($_SESSION["ses_user_name"]); ?></span> </a>
        <div class="btn-group"> <a class="dropdown-toggle header-btn dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false" style="padding: 0px 15px;"> User Profile </a>
          <ul class="dropdown-menu">
            <p style="text-align:center; border-bottom:1px dotted #ccc; font-size:12px;">( <?php echo ucwords($_SESSION["ses_user_name"]); ?> )</p>
            <li><a href="profile.php">Edit Profile</a></li>
            <li><a href="changepassword.php">Change Password</a></li>
            <li><a href="logout.php">Logout</a></li>
          </ul>
        </div>
        <div class="btn-group"> <a class="dropdown-toggle header-btn dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false"> <span class="header-btn-icon icon-lg icon-information light"></span> </a>
          <div class="dropdown-menu dropdown-settings">
            <div class="media">
              <div class="media-body">
                <h4 class="media-heading tac">About Tracer</h4>
              </div>
            </div>
            <hr />
            <a href="#" class="btn btn-sm boardc-col1">Tour</a>&nbsp; <a href="" class="btn btn-sm boardc-col7">Blog</a>&nbsp; <a href="" class="btn btn-sm boardc-col3">More...</a> </div>
        </div>
      </li>
    </ul>
  </div>
</header>
<!-- HEADER END-->
<div class="navbar navbar-inverse set-radius-zero">
  <div class="container">
    <div class="left-div">
      <div class="client-logo"> <a href="/" aria-label=""><img src="assets/img/total_2.png" alt="Client Logo" title="Client Logo" /></a></div>
      <div class="client-info">
        <h5><?php echo ucwords($_SESSION["ses_user_name"]); ?></h5>
        <h6><?php echo ucwords($_SESSION["ses_user_name"]); ?> Client Compliance Portal</h6>
      </div>
    </div>
  </div>
</div>
<div class="navbar-inverse">
  <div class="container tab-menu">
    <ul class="nav nav-tabs">
      <li class=""><a href="profile.php">Edit Profile</a></li>
      <li class="active"><a href="changepassword.php">Change Password</a></li>
    </ul>
  </div>
</div>
<div class="container">
  <div class="row">
    <div class="col-md-12" style="position: relative;background: rgb(255, 255, 255) url(assets/img/changepassword.png) no-repeat scroll -309px 0px;height: 492px;vertical-align: middle;">
      <div class="tab-content">
        <div class="tab-pane fade active in" id="changepassword">
          <h4 style="margin-top:50px; font-size:20px;"> <strong>Reset Password</strong></h4>
          <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="changepassword" id="changepassword">
            <div class="loginmsg">
              <div id="errdis">
                <p style="display:block;"> <?php echo $err; ?></p>
              </div>
            </div>
            <div class="col-md-5"> </div>
            <div class="col-md-4">
              <p style="color:green">Passwords are case-sensitive and must be at least 6 characters.<br>
                A good password should contain a mix of capital, lower-case letters, numbers and symbols.</p>
  
<!--(1-3-2016)-->
<!--TestingAccount-->
<!--Various Flow Occur-->
                  <div class="form-group">
                     <label style="font-size:14pt;"> User ID : <span style="color:#666666; font-size:16px;">xxxxx</span></label>
                   </div>
                  <div class="form-group">
                  <label>Old Password</label>
                   <input id="old_password" name="old_password" placeholder="Enter text here.." class="form-control" value="" type="text">
                  </div>
                  <div class="form-group">
                  <label>New Password</label>
                  <input class="form-control" id="password" name="password" placeholder="Enter text here.."  value="" type="text">
                  </div>
                  <div class="form-group">
                  <label>Confirm Password</label>
                  <input  id="password2" name="password2" placeholder="Enter text here.." class="form-control" value="" type="text">
                  </div>
				  <input name="submit" value="Update" id="submit" type="submit" class="btn btn-success" style="border-radius: 5px;">
                  <a style=" border-radius: 5px;" href="boards.php" id="tr_home" class="btn btn-danger"  >Cancel</a>
        </div>
        </form>
      </div>
    </div>
  </div>
 </div>
</div>
<script src="assets/js/jquery-1.11.1.js"></script>
<!-- BOOTSTRAP SCRIPTS  -->
<script src="assets/js/bootstrap.js"></script>
</body>
</html>
