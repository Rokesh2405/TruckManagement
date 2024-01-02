<?php
include '../config/config.inc.php';

if (isset($_REQUEST['logsubmit'])) {
    @extract($_REQUEST);
    /* $captcha = $_POST['g-recaptcha-response'];
      $ip = $_SERVER['REMOTE_ADDR'];
      $rsp = "https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha&remoteip=$ip";
      $jsondate = file_get_contents($rsp);
      $arr = json_decode($jsondate, true);
      if ($arr['success'] == '1') { */
    $msg = LoginCheck($uname, $pwd, $ip, $rememberme, $_REQUEST['login']);
    // echo $msg;
    if ($msg == "Admin" || $msg == "User" || $msg == "agent" || $msg == "Hurray! You will redirect into dashboard soon") {
        header("location:" . $sitename);
        exit;
    } else {
        echo '<script>window.onload = function(){ $("#login-box").addClass("animated shake" ); };</script>';
    }
    /* } else {
      $msg = $arr.'<span style="color:#FF0000; font-weight:bold;">Captcha Code Invalid</span>';
      } */
}
?>
 
<!DOCTYPE html>
<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="<?php echo $fsitename; ?>img/adminlogo.png">

        <title>Login</title>

        <link href="<?php echo $sitename; ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $sitename; ?>assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $sitename; ?>assets/css/style.css" rel="stylesheet" type="text/css" />

        <script src="<?php echo $sitename; ?>assets/js/modernizr.min.js"></script>
        
    </head>
    <body>

    <div class="account-pages"></div>
    <div class="clearfix"></div>
	
	  <div class="wrapper-page">
            <div class="card-box">
                <div class="panel-heading">
                    <h4 class="text-center"> Sign In</h4>
                </div>

     
                <div class="p-20">
                    <form class="form-horizontal m-t-20" method="POST" name="loginform" id="loginform">
					<span id="hideDiv"><?php echo $msg; ?></span>
                        <div class="form-group ">
                            <div class="col-12">
                                <input class="form-control" type="text" required="required" name="uname" placeholder="Username">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-12">
                                <input class="form-control" type="password" required="required" placeholder="Password" name="pwd">
                            </div>
                        </div>


                        <div class="form-group text-center m-t-40">
                            <div class="col-12">
                             <button class="btn btn-success btn-block text-uppercase waves-effect waves-light"
                                    type="submit" name="logsubmit" id="logsubmit"  style="background-color:#194376 !important;">Log In
                            </button>
                            </div>
                        </div>

                       
                    </form>

                </div>
            </div>
            <!--<div class="row">-->
            <!--    <div class="col-sm-12 text-center">-->
            <!--        <p>Don't have an account? <a href="<?php echo $fsitename; ?>pages/register.php" class="text-primary m-l-5"><b>Sign Up</b></a>-->
            <!--        </p>-->

            <!--    </div>-->
            <!--</div>-->
            
        </div>

   <script type="text/javascript">
$(function() {
setTimeout(function() { $("#hideDiv").fadeOut(500); }, 2000)

})
        </script>

</html>