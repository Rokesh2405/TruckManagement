<?php
$loginaccess2 = $db->prepare("SELECT * FROM `users` WHERE `orgpassword` = ? AND `id`=? ");
$loginaccess2->execute(array($_SESSION['Gpassword'], $_SESSION['GRUID']));
$loginaccess2 = $loginaccess2->fetch();
if ($loginaccess2['id'] == '') {
    logout();
    session_destroy();
    session_unset();
    if ($_SERVER['HTTP_HOST'] == 'localhost') {
    header("location:http://localhost/ttbilling/truckmanagement/admin/pages/");
  }
  else
  {
    header("https://ttbilling.in/truckmanagement/admin/pages/");

  }
}
?>

<!-- ========== Left Sidebar Start ========== -->
<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">
        <!--- Divider -->
        <div id="sidebar-menu" <?php  if(getusers('mainadmin',$_SESSION['GRUID'])=='0') { ?>  style="padding-bottom:0px;" <?php } ?>>
            <ul>

                <li class="has_sub">
                    <a href="<?php echo $sitename; ?>" class="waves-effect subdrop"  <?php if($menu==1) { ?>style="font-weight:bold;" <?php } ?>>
                        <i class="fa fa-bank" <?php if($menu==1) { ?>style="font-weight:bold;" <?php } ?>></i> <span> Home</span> </a>
                </li>
			
							 
           </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
<!-- Left Sidebar End -->
<!-- Right Sidebar -->
<!--   <div class="side-bar right-bar nicescroll">
      <h4 class="text-center">Chat</h4>
      <div class="contact-list nicescroll">
          <ul class="list-group contacts-list">
              <li class="list-group-item">
                  <a href="#">
                      <div class="avatar">
                          <img src="assets/images/users/avatar-1.jpg" alt="">
                      </div>
                      <span class="name">Chadengle</span>
                      <i class="fa fa-circle online"></i>
                  </a>
                  <span class="clearfix"></span>
              </li>
              <li class="list-group-item">
                  <a href="#">
                      <div class="avatar">
                          <img src="assets/images/users/avatar-2.jpg" alt="">
                      </div>
                      <span class="name">Tomaslau</span>
                      <i class="fa fa-circle online"></i>
                  </a>
                  <span class="clearfix"></span>
              </li>
              <li class="list-group-item">
                  <a href="#">
                      <div class="avatar">
                          <img src="assets/images/users/avatar-3.jpg" alt="">
                      </div>
                      <span class="name">Stillnotdavid</span>
                      <i class="fa fa-circle online"></i>
                  </a>
                  <span class="clearfix"></span>
              </li>
              <li class="list-group-item">
                  <a href="#">
                      <div class="avatar">
                          <img src="assets/images/users/avatar-4.jpg" alt="">
                      </div>
                      <span class="name">Kurafire</span>
                      <i class="fa fa-circle online"></i>
                  </a>
                  <span class="clearfix"></span>
              </li>
              <li class="list-group-item">
                  <a href="#">
                      <div class="avatar">
                          <img src="assets/images/users/avatar-5.jpg" alt="">
                      </div>
                      <span class="name">Shahedk</span>
                      <i class="fa fa-circle away"></i>
                  </a>
                  <span class="clearfix"></span>
              </li>
              <li class="list-group-item">
                  <a href="#">
                      <div class="avatar">
                          <img src="assets/images/users/avatar-6.jpg" alt="">
                      </div>
                      <span class="name">Adhamdannaway</span>
                      <i class="fa fa-circle away"></i>
                  </a>
                  <span class="clearfix"></span>
              </li>
              <li class="list-group-item">
                  <a href="#">
                      <div class="avatar">
                          <img src="assets/images/users/avatar-7.jpg" alt="">
                      </div>
                      <span class="name">Ok</span>
                      <i class="fa fa-circle away"></i>
                  </a>
                  <span class="clearfix"></span>
              </li>
              <li class="list-group-item">
                  <a href="#">
                      <div class="avatar">
                          <img src="assets/images/users/avatar-8.jpg" alt="">
                      </div>
                      <span class="name">Arashasghari</span>
                      <i class="fa fa-circle offline"></i>
                  </a>
                  <span class="clearfix"></span>
              </li>
              <li class="list-group-item">
                  <a href="#">
                      <div class="avatar">
                          <img src="assets/images/users/avatar-9.jpg" alt="">
                      </div>
                      <span class="name">Joshaustin</span>
                      <i class="fa fa-circle offline"></i>
                  </a>
                  <span class="clearfix"></span>
              </li>
              <li class="list-group-item">
                  <a href="#">
                      <div class="avatar">
                          <img src="assets/images/users/avatar-10.jpg" alt="">
                      </div>
                      <span class="name">Sortino</span>
                      <i class="fa fa-circle offline"></i>
                  </a>
                  <span class="clearfix"></span>
              </li>
          </ul>
      </div>
  </div> -->
<!-- /Right-bar -->

<!-- END wrapper -->