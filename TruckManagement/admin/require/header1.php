<?php
//session_start();
  if ($dynamic == '') {
    include ('config/config.inc.php');
}
if ($_SESSION['GRUID'] == '1') {
    header("Location:" . $sitename . "logout.php");
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
    .alert-success {
    background-color: #3191e9;
    border-color: #3191e9;
    color: #fff;
}

.panel-info {
    border-color: #1a84e6;
}
.panel-info>.panel-heading {
    color: #fff;
    background-color: #1a84e6;
    border-color: #bce8f1;
}
.btn-default, .btn-default:hover, .btn-default:focus, .btn-default:active, .btn-default.active, .btn-default.focus, .btn-default:active, .btn-default:focus, .btn-default:hover, .open>.dropdown-toggle.btn-default {
    background-color: #1a84e6 !important;
    border: 1px solid #1a84e6 !important;
}
.btn-default, .btn-default:hover, .btn-default:focus, .btn-default:active, .btn-default.active, .btn-default.focus, .btn-default:active, .btn-default:focus, .btn-default:hover, .open>.dropdown-toggle.btn-default {
    background-color: #1a84e6 !important;
    border: 1px solid #1a84e6 !important;
}
a {
    color: #1a84e6;
    text-decoration: none;
    background-color: transparent;
    font-weight:600;
    -webkit-text-decoration-skip: objects;
}
.text-custom {
    color: #1a84e6 !important;
}
.btn-primary, .btn-primary:hover, .btn-primary:focus, .btn-primary:active, .btn-primary.active, .btn-primary.focus, .btn-primary:active, .btn-primary:focus, .btn-primary:hover, .open>.dropdown-toggle.btn-primary {
    background-color: #1a84e6 !important;
    border: 1px solid #1a84e6 !important;
}
.btn-primary, .btn-success, .btn-default, .btn-info, .btn-warning, .btn-danger, .btn-inverse, .btn-purple, .btn-pink {
    color: #ffffff !important;
}
.btn-success, .btn-success:hover, .btn-success:focus, .btn-success:active, .btn-success.active, .btn-success.focus, .btn-success:active, .btn-success:focus, .btn-success:hover, .open>.dropdown-toggle.btn-success {
    background-color: #1a84e6 !important;
    border: 1px solid #1a84e6 !important;
}
.pagination>.active>a, .pagination>.active>span, .pagination>.active>a:hover, .pagination>.active>span:hover, .pagination>.active>a:focus, .pagination>.active>span:focus, .page-item.active .page-link {
    background-color: #1a84e6;
    border-color: #1a84e6;
}

body select option { 
   zoom: 1.2;
}     

</style> </head>


    <body class="widescreen fixed-left-void" style="color:#000;" onload="startTime();">

        <!-- Begin page -->
        <div id="wrapper" class="forced enlarged">

            <!-- Top Bar Start -->
            <div class="topbar">

                <!-- LOGO -->
                <div class="topbar-left" style="background-color:#1A84E6;">
                   
                </div>

                <!-- Button mobile view to collapse sidebar menu -->
                <nav class="navbar-custom" style="background-color:#1A84E6; margin-left:0px; !important">

                    <ul class="list-inline float-right mb-0">
                        
                         <li class="list-inline-item notification-list">
					     <a style="color:#fff;" href="<?php echo $fsitename; ?>dashboard.php">Dashboard&nbsp;&nbsp;|&nbsp;&nbsp;</a>
					 </li>    
                        <li class="list-inline-item notification-list">
					     <a style="color:#fff;" href="<?php echo $fsitename; ?>submission.php">Create Submission&nbsp;&nbsp;|&nbsp;&nbsp;</a>
					 </li>    
					 <?php if($_SESSION['usertype']=='supervisor') { ?>
					 
					 <li class="list-inline-item notification-list">
					     <a style="color:#fff;" href="<?php echo $fsitename; ?>sforms.php">My Submission Forms&nbsp;&nbsp;|&nbsp;&nbsp;</a>
					 </li>    
                    <li class="list-inline-item notification-list">
					     <a style="color:#fff;" href="<?php echo $fsitename; ?>mnform.php">Submitted Forms by Manager&nbsp;&nbsp;|&nbsp;&nbsp;</a>
					 </li> 
					   <li class="list-inline-item notification-list">
					     <a style="color:#fff;" href="<?php echo $fsitename; ?>eforms.php">Submitted Forms by Employee</a>
					 </li> 
					 <?php } ?>
					 <?php if($_SESSION['usertype']=='manager') { ?>
				
				
                    <li class="list-inline-item notification-list">
					     <a style="color:#fff;" href="<?php echo $fsitename; ?>mnform.php">My Submission Forms&nbsp;&nbsp;|&nbsp;&nbsp;</a>
					 </li> 
					   <li class="list-inline-item notification-list">
					     <a style="color:#fff;" href="<?php echo $fsitename; ?>eforms.php">Submitted Forms by Employee</a>
					 </li> 
					 <?php } ?>
					  <?php if($_SESSION['usertype']=='employee') { ?>
				
				
					   <li class="list-inline-item notification-list">
					     <a style="color:#fff;" href="<?php echo $fsitename; ?>eforms.php">My Submission Forms</a>
					 </li> 
					 <?php } ?>
 <li class="list-inline-item notification-list">
                           <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
                              aria-haspopup="false" aria-expanded="false" style="font-weight:bold;color:#fff;">
                                
                               Welcome <?php echo getusers('name',$_SESSION['GRUID']); ?>
                               
                               
                           </a>
                        </li>
                        
                        
                        <li class="list-inline-item dropdown notification-list">
                            <a href="<?php echo $sitename; ?>logout.php"  style="font-weight:bold;color:#fff;" >
                          
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
                        <li class="hide-phone app-search" style="padding-top:20px;padding-left:20px; color:#fff;font-size: 20px;">
                        
                               Form Submission
                           
                        </li> 
                    </ul>

                </nav>

            </div>
            <!-- Top Bar End -->
