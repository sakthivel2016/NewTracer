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
      <li class="active"><a href="profile.php">Edit Profile</a></li>
      <li class=""><a href="changepassword.php">Change Password</a></li>
    </ul>
  </div>
</div>
<div class="container">
  <div class="row">
    <div class="col-md-12" style="position: relative;background: rgb(255, 255, 255) url(assets/img/changepassword.png) no-repeat scroll -309px 0px;height: 492px;vertical-align: middle;">
      <div class="tab-content">
        <div class="tab-pane fade active in" id="editprofile">
          <h4 style="margin-top:50px; font-size:20px;"> <strong>Edit Profile:</strong></h4>
          <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="editprofile" id="editprofile">
            <div class="loginmsg">
              <div id="errdis">
                <p style="display:block;"> <?php echo $err; ?></p>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>First Name:</label>
                <input name="fname" value="" id="fname" type="text" class="form-control">
              </div>
              <div class="form-group">
                <label>Company Name:</label>
                <input name="cname" value="" id="cname" type="text" class="form-control">
              </div>
              <div class="form-group">
                <label>Address:</label>
                <textarea style="height:98px;" name="address" id="address" class="form-control"></textarea>
              </div>
              <div class="form-group">
                <label>Zip Code:</label>
                    <input name="zipcode" value="" id="zipcode" type="text" class="form-control">
              </div>
            </div>
            <div class="col-md-4"> 
                <div class="form-group">
                <label>Last Name:</label>
                    <input name="lname" class="form-control" value="" id="lname" type="text">
                </div>
                <div class="form-group">
                <label>Acronym Name:</label>
                    <input name="acroname" class="form-control" value="" id="acroname" type="text">
                </div>
                <div class="form-group">
                <label>City:</label>
                    <input name="city" class="form-control" value="" id="city" type="text">
                </div>
                <div class="form-group">
                <label> State/Province:</label>
                    <input name="state" class="form-control" value="" id="state" type="text">
                </div>
                <div class="form-group">
                <label>Country:</label>
                    <input name="country" class="form-control" value="" id="country" type="text">
                </div>
            </div>
            <div class="col-md-4"> 
               <div class="form-group">
                <label>User Name:</label>
                    <input name="username" class="form-control" value="" id="username" disabled="" type="text">
               </div>
               <div class="form-group">
                <label>Email ID:</label>
                    <input name="emailid" class="form-control" value="" id="emailid" type="text">
               </div>
               <div class="form-group">
                <label>Phone No:</label>
                    <input name="phone" class="form-control" value="" id="phone" type="text">
               </div>
               <div class="form-group">
                <label>Mobile No:</label>
                    <input name="mobile" class="form-control" value="" id="mobile"  type="text">
               </div>
            </div>
             <div class="col-md-12" style="text-align:center;" > 
             <input name="submit" value="Update" id="submit" type="submit" class="btn btn-default" style="padding: 10px 40px;border-right: 3px solid #888888;border-radius: 6px;border-bottom: 3px solid #888888;">
            
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
