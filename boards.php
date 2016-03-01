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
<title>Welcome To New Tracer</title>
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
    <span class="header-search-icon icon-lg icon-search light js-search-icon js-search-focus"></span>
   </div>
   
  <div class="user-settings-wrapper header-user">
    <ul class="nav">
      <li class="dropdown"> <a class="header-btn header-member js-open-header-member-menu" href="#" aria-label="" style="padding-left:0px;"> <span class="member"> <span class="member-initials" title=""><img src="assets/img/user-icon.png" /></span> </span> <span class="header-btn-text"><?php echo ucwords($_SESSION["ses_user_name"]); ?></span> </a> 
    <div class="btn-group">  
      <a class="dropdown-toggle header-btn dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false" style="padding: 0px 15px;"> User Profile </a> 
            <ul class="dropdown-menu">
            <p style="text-align:center; border-bottom:1px dotted #ccc; font-size:12px;">( <?php echo ucwords($_SESSION["ses_user_name"]); ?> )</p>
            <li><a href="profile.php">Edit Profile</a></li>
            <li><a href="changepassword.php">Change Password</a></li>
            <li><a href="logout.php">Logout</a></li>
            </ul>          
    </div>
    <div class="btn-group">   
       <a class="dropdown-toggle header-btn dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false"> <span class="header-btn-icon icon-lg icon-information light"></span> </a>
        <div class="dropdown-menu dropdown-settings">
          <div class="media">
            <div class="media-body">
              <h4 class="media-heading tac">About Tracer</h4>
            </div>
          </div>
          <hr />
          <a href="#" class="btn btn-sm boardc-col1">Tour</a>&nbsp; <a href="" class="btn btn-sm boardc-col7">Blog</a>&nbsp; <a href="" class="btn btn-sm boardc-col3">More...</a> 
       </div>
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
<!-- Content  -->
<div class="container" style="padding-top:30px;"><!-- container -->

  <div class="row"><!-- row -->
    <div class="col-md-12"> <!-- col-md-12 -->
    <div class="col-md-2"></div>
    <a href="risk_assessment.php" title="Risk Assessment Board">
    <div class="col-md-3">
      <div class="boardc boardc-col1">
         <h4 class="tac">Risk Assessment</h4>
      </div>
    </div>
    </a>
    <a href="#" title="Vulnerability Assessment Board">
    <div class="col-md-3">
      <div class="boardc boardc-col2">
         <h4 class="tac">Vulnerability Assessment</h4>
      </div>
    </div>
    </a>
    <a href="#" title="Contingency Board">
    <div class="col-md-3">
      <div class="boardc boardc-col3">
         <h4 class="tac">Contingency</h4>
      </div>
    </div>
    </a>
    <div class="col-md-2"></div>
    
    <a href="#" title="Document Download Board">
    <div class="col-md-3">
      <div class="boardc boardc-col4">
         <h4 class="tac">Document Download</h4>
      </div>
    </div>
    </a>
    <a href="#" title="File Download Board">
    <div class="col-md-3">
      <div class="boardc boardc-col5">
         <h4 class="tac">File Download</h4>
      </div>
    </div>
    </a>
    <a href="#" title="Policy Portal Board">
    <div class="col-md-3">
      <div class="boardc boardc-col6">
         <h4 class="tac">Policy Portal</h4>
      </div>
    </div> 
    </a>
    <div class="col-md-2"></div>
    </a>
    <a href="#" title="Dashboard Board">
    <div class="col-md-3">
      <div class="boardc boardc-col7">
         <h4 class="tac">Dashboard</h4>
      </div>
    </div>
    </a>
    
    </div> <!-- col-md-12 --> 
  </div><!-- row -->
  </div><!-- container -->
<script src="assets/js/jquery-1.11.1.js"></script>
<!-- BOOTSTRAP SCRIPTS  -->
<script src="assets/js/bootstrap.js"></script>
</body>
</html>
