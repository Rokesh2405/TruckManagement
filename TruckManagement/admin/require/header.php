<?php
//session_start();
  if ($dynamic == '') {
    include ('config/config.inc.php');
}

if ($_SESSION['GRUID'] == '') {
    header("Location:" . $sitename . "pages/");
}

$actual_link = "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
?>
<!DOCTYPE html>
<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Coderthemes">
        <link rel="shortcut icon" href="<?php echo $fsitename; ?>img/adminlogo.png">
        <title>Admin</title>

        <!-- DataTables -->
        <link href="<?php echo $sitename; ?>plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $sitename; ?>plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <!-- Responsive datatable examples -->
        <link href="<?php echo $sitename; ?>plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <!-- Multi Item Selection examples -->
        <link href="<?php echo $sitename; ?>plugins/datatables/select.bootstrap4.min.css" rel="stylesheet" type="text/css" />
          <link href="<?php echo $sitename; ?>plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
          <link href="https://fonts.googleapis.com/css?family=Lato:300,400&display=swap" rel="stylesheet">

        <!--Morris Chart CSS -->
    <!-- <link rel="stylesheet" href="<?php echo $sitename; ?>plugins/morris/morris.css">
 -->
        <link href="<?php echo $sitename; ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $sitename; ?>assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $sitename; ?>assets/css/style.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo $sitename; ?>plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">  
        <script src="<?php echo $sitename; ?>assets/js/modernizr.min.js"></script>

 <script>
            function startTime() {
                var today = new Date();
                var h = today.getHours();
                var m = today.getMinutes();
                var s = today.getSeconds();

                m = checkTime(m);
                s = checkTime(s);

                var ampm = h >= 12 ? 'PM' : 'AM';
                h = h % 12;
                h = h ? h : 12; // the hour '0' should be '12'
                //m = m < 10 ? '0'+m : m;
                m = m < 10 ? m : m;

                var dd = today.getDate();
                //var mm = today.getMonth()+1; //January is 0!
                var mm = today.getMonth();
                var yyyy = today.getFullYear();

                if (dd < 10) {
                    dd = '0' + dd
                }

                if (mm < 10) {
                    //mm='0'+mm
                }

                var monthNames = [
                    "Jan", "Feb", "Mar",
                    "Apr", "May", "June", "Jul",
                    "Aug", "Sep", "Oct",
                    "Nov", "Dec"
                ];

                document.getElementById('txt').innerHTML =
                        h + ":" + m + ":" + s + ' ' + ampm + ' | ' + dd + ' - ' + monthNames[mm] + ' - ' + yyyy;
                var t = setTimeout(startTime, 500);
            }

            function checkTime(i) {
                if (i < 10) {
                    i = "0" + i
                }
                ;  // add zero in front of numbers < 10
                return i;
            }

        </script> <style>
     body{
         font-family:'Lato', sans-serif;
     }
    .alert-success {
    background-color: #194376;
    border-color: #3191e9;
    color: #fff;
}

.panel-info {
    border-color: #194376;
}
.panel-info>.panel-heading {
    color: #fff;
    background-color: #194376;
    border-color: #bce8f1;
}
.btn-default, .btn-default:hover, .btn-default:focus, .btn-default:active, .btn-default.active, .btn-default.focus, .btn-default:active, .btn-default:focus, .btn-default:hover, .open>.dropdown-toggle.btn-default {
    background-color: #194376 !important;
    border: 1px solid #194376 !important;
}
.btn-default, .btn-default:hover, .btn-default:focus, .btn-default:active, .btn-default.active, .btn-default.focus, .btn-default:active, .btn-default:focus, .btn-default:hover, .open>.dropdown-toggle.btn-default {
    background-color: #194376 !important;
    border: 1px solid #194376 !important;
}
a {
    color: #194376;
    text-decoration: none;
    background-color: transparent;
    font-weight:600;
    -webkit-text-decoration-skip: objects;
}
.text-custom {
    color: #194376 !important;
}
.btn-primary, .btn-primary:hover, .btn-primary:focus, .btn-primary:active, .btn-primary.active, .btn-primary.focus, .btn-primary:active, .btn-primary:focus, .btn-primary:hover, .open>.dropdown-toggle.btn-primary {
    background-color: #194376 !important;
    border: 1px solid #194376 !important;
}
.btn-primary, .btn-success, .btn-default, .btn-info, .btn-warning, .btn-danger, .btn-inverse, .btn-purple, .btn-pink {
    color: #ffffff !important;
}
.btn-success, .btn-success:hover, .btn-success:focus, .btn-success:active, .btn-success.active, .btn-success.focus, .btn-success:active, .btn-success:focus, .btn-success:hover, .open>.dropdown-toggle.btn-success {
    background-color: #194376 !important;
    border: 1px solid #194376 !important;
}
.pagination>.active>a, .pagination>.active>span, .pagination>.active>a:hover, .pagination>.active>span:hover, .pagination>.active>a:focus, .pagination>.active>span:focus, .page-item.active .page-link {
    background-color: #194376;
    border-color: #194376;
}

body select option { 
   zoom: 1.2;
}    

@media only screen and (max-width: 600px) {
/*  .topbar{*/
/*      height:10px!important;*/
/*  }*/
/*  .navbar-custom .nav-link {*/
/*    line-height: 10px!important;*/
/*    color: #3fa59f!important;*/
/*    font-size: 9px;*/
/*}*/
/*a.nav-link.dropdown-toggle.waves-effect.waves-light.nav-user {*/
/*    margin-left: -123px;*/
/*    word-spacing: 3px;*/
/*    font-size: 9px;*/
/*}*/
/*a.nav-link.waves-effect.waves-light.nav-user {*/
/*    margin-left: -22px;*/
/*}*/

/*ul.list-inline.float-right.mb-0 {*/
/*    margin-left: -68px;*/
/*}*/
ul.list-inline.float-right.mb-0 {
   width: 315px;
    height: 70px;
    background: #194376;
}
a.nav-link.waves-effect.waves-light.nav-user {
    margin-top: 1px;
    font-size: 11px;
    margin-left: 43px;
}
a.nav-link.waves-effect.waves-light.nav-user.ltf {
    margin-left: -28px;
}
}

.alert-success h4 {
	color:#fff;
}
</style> </head>


    <body class="widescreen fixed-left-void" style="color:#000;" onload="startTime();">
      <!--  <body class="widescreen fixed-left" style="color:#000;" onload="startTime();">
-->
        <!-- Begin page -->
        <div id="wrapper" class="forced enlarged">
 <!--<div id="wrapper" class="forced ">-->
            <!-- Top Bar Start -->
            <div class="topbar">

                <!-- LOGO -->
                <div class="topbar-left" style="background-color:#194376;">
                    <div class="text-left">
                           <button class="button-menu-mobile open-left waves-light waves-effect">
                                <i class="dripicons-menu" style="color:#fff;"></i>
                            </button>
                         
                    </div>
                </div>

                <!-- Button mobile view to collapse sidebar menu -->
                <nav class="navbar-custom" style="background-color:#194376;">

                    <ul class="list-inline float-right mb-0">
					
                        <li class="list-inline-item notification-list">
                            <a class="nav-link waves-light waves-effect" href="#" id="btn-fullscreen">
                                <i class="dripicons-expand noti-icon" style="color:#fff;"></i>
                            </a>
                        </li>

                      <!--<li class="list-inline-item notification-list">-->
                      <!--     <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"-->
                      <!--         aria-haspopup="false" aria-expanded="false" style="font-weight:bold;color:#fff;" id="txt"></a>-->
                      <!--  </li>-->
 <li class="list-inline-item notification-list">
                           <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
                              aria-haspopup="false" aria-expanded="false" style="font-weight:bold;color:#fff;">
                                Welcome <?php echo $_SESSION['name']; ?>&nbsp;&nbsp;&nbsp;&nbsp;|
                               
                           </a>
                        </li>
                         <!--<li class="list-inline-item dropdown notification-list">
                            <a class="nav-link waves-effect waves-light nav-user ltf" href="<?php echo $sitename;?>/master/changepassword.htm" role="button"
                                style="font-weight:bold;color:#fff;">
                          Change Password&nbsp;&nbsp;&nbsp;&nbsp;|
                            </a>
                          
                        </li>-->

                        
                        <li class="list-inline-item dropdown notification-list">
                            <a class="nav-link waves-effect waves-light nav-user ltf" href="<?php echo $sitename;?>logout.php" role="button"
                                style="font-weight:bold;color:#fff;">
                          Logout
                            </a>
                          
                        </li>

                    </ul>

                    <ul class="list-inline menu-left mb-0">
<!--                        <li class="float-left">
                            <button class="button-menu-mobile open-left waves-light waves-effect">
                                GoToHospital
                            </button>
                        </li>-->
                       <a href="<?php echo $sitename; ?>"> <li class="hide-phone app-search" style="padding-top:20px;padding-left:20px; color:#fff;font-size: 20px;">
                        
                                <?php echo getusers('name',$_SESSION['GRUID']); ?>
    
                        </li> </a>

                    </ul>
                    

                </nav>

            </div>
            <!-- Top Bar End -->

            <?php include 'sidebar.php'; ?>