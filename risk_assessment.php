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
<body style="background-image: url('assets/img/full.jpg');" class="body-board-view">
<header class="body-board-view"> <a class="header-logo" href="#" aria-label=""> <span class="header-logo-default"></span> </a>
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
            <li><a href="#">Edit Profile</a></li>
            <li><a href="#">Change Password</a></li>
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
<!-- Content  -->
<div class="container" style="width:100%;">
  <div class="board-header">
    <h6 class="board-header-btn board-header-btn-name">Risk Assessment</h6>
  </div>
  <!-- container -->
  <div class="row">
    <!-- row -->
    <div class="col-md-12">
      <!-- col-md-12 -->
      <div class="col-md-2">
        <div class="boardt">
          <div class="list-header">
            <h2 class="list-header-name">Interviewee List Form</h2>
          </div>
          <div class="list-cards">
            <div class="list-card" data-toggle="modal" data-target="#interviewee1">
              <div class="list-card-details">
                  <p class="list-card-title">Interviewee List Instructions</p>
              </div>
            </div>
            <div class="list-card" data-toggle="modal" data-target="#interviewee2">
              <div class="list-card-details">
                <p class="list-card-title js-card-name">Interviewee List IT</p>
              </div>
            </div>
            <div class="list-card" data-toggle="modal" data-target="#interviewee3">
              <div class="list-card-details">
                <p class="list-card-title js-card-name">Interviewee List Facility/Security</p>
              </div>
            </div>
            <div class="list-card" data-toggle="modal" data-target="#interviewee4">
              <div class="list-card-details">
                <p class="list-card-title js-card-name">Interviewee List HR</p>
              </div>
            </div>
            <div class="list-card" data-toggle="modal" data-target="#interviewee5">
              <div class="list-card-details">
                <p class="list-card-title js-card-name">Interviewee List Privacy</p>
              </div>
            </div>
            <div class="list-card" data-toggle="modal" data-target="#interviewee6">
              <div class="list-card-details">
                <p class="list-card-title js-card-name">Interviewee List Various Depts.</p>
              </div>
            </div>
            <div class="list-card" data-toggle="modal" data-target="#interviewee7">
              <div class="list-card-details">
                <p class="list-card-title js-card-name">Interviewee List Other Interviewees</p>
              </div>
            </div>
            
          </div>
        </div>
      </div>
    </div>
    <!-- col-md-12 -->
  </div>
  <!-- row -->
</div>
</div>
</div>
<!-- container -->
<script src="assets/js/jquery-1.11.1.js"></script>
<!-- BOOTSTRAP SCRIPTS  -->
<script src="assets/js/bootstrap.js"></script>
</body>
</html>
<?php include('risk_assessment_cards.tpl'); ?>