<?php
$loginaccess2 = $db->prepare("SELECT * FROM `users` WHERE `orgpassword` = ? AND `id`=? ");
$loginaccess2->execute(array($_SESSION['Gpassword'], $_SESSION['GRUID']));
$loginaccess2 = $loginaccess2->fetch();
if ($loginaccess2['id'] == '') {
    logout();
    session_destroy();
    session_unset();
    header("location:http://localhost/kk_carrier/admin/pages/");
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
			
							 <li class="has_sub">
          <a href="<?php echo $sitename; ?>master/addcompanydetails.htm" class="waves-effect <?php if($menu==16 || $menu==17) { ?> active subdrop <?php } ?>"><i class="fa fa-support"></i> <span> Company</span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                 <!-- <li>
                    <a href="<?php echo $sitename; ?>master/proof.htm" class="waves-effect subdrop"  <?php if($menu==6) { ?>style="font-weight:bold;" <?php } ?>>
                       
                       <span>Proofs</span> </a>
                   
                </li>
				<li>
                 <a href="<?php echo $sitename; ?>master/bikes.htm" class="waves-effect subdrop"  <?php if($menu==16) { ?>style="font-weight:bold;" <?php } ?>>
                        <span>Bikes</span> </a>
                </li>
                <li>
                 <a href="<?php echo $sitename; ?>master/models.htm" class="waves-effect subdrop"  <?php if($menu==17) { ?>style="font-weight:bold;" <?php } ?>>
                        <span>Models</span> </a>
                </li> -->
				
			    </ul>
                            </li> 

                   <li class="has_sub">
          <a href="<?php echo $sitename; ?>master/customers.htm" class="waves-effect <?php if($menu==2 || $menu==3) { ?> active subdrop <?php } ?>"><i class="fa fa-group  
"></i> <span>Customers</span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                
                <!--  <li>
                    <a href="<?php echo $sitename; ?>master/subusers.htm" class="waves-effect subdrop"  <?php if($menu==3) { ?>style="font-weight:bold;" <?php } ?>>
                       <span> Sub Users</span> </a>
                   
                </li> -->
				   
                </ul>
                            </li>
                 <li class="has_sub">
                    <a href="<?php echo $sitename; ?>master/staff.htm" class="waves-effect subdrop"  <?php if($menu==115) { ?>style="font-weight:bold;" <?php } ?>>
                   
                    <i class="fa fa-cart-arrow-down 
 text-primary"></i><span> Staff</span> </a>
                   
                </li>
                          <li class="has_sub">
                <a href="<?php echo $sitename; ?>master/drivers.htm" class="waves-effect <?php if($menu==22 || $menu==23) { ?> active subdrop <?php } ?>"><i class="fa fa-drivers-license  
"></i> <span>Drivers</span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                
                
				   
                </ul>
                            </li>
           
		   
				  <li class="has_sub">
                                <a href="<?php echo $sitename; ?>master/delivery.htm" class="waves-effect <?php if($menu==6 || $menu==7 || $menu==8 || $menu==9) { ?> active subdrop <?php } ?>"><i class="fa fa-truck"></i> <span> Truck</span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                 <!-- <li>
        <a href="<?php echo $sitename; ?>master/expense_type.htm" class="waves-effect subdrop"  <?php if($menu==6) { ?>style="font-weight:bold;" <?php } ?>>
                       
                       <span>Expense Type</span> </a>
                   
                </li>
				<li>
                 <a href="<?php echo $sitename; ?>master/expense.htm" class="waves-effect subdrop"  <?php if($menu==6) { ?>style="font-weight:bold;" <?php } ?>>
                        <span>Delivery</span> </a>
                </li>
                 -->
				
			    </ul>
                            </li> 

	  <li class="has_sub">
                                <a href="<?php echo $sitename; ?>master/driverearning.htm" class="waves-effect <?php if($menu==6 || $menu==7 || $menu==8 || $menu==9) { ?> active subdrop <?php } ?>"><i class=" md-credit-card"></i> <span> Trailer</span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                 
                
				
			    </ul>
                            </li> 


                 <li class="has_sub">
                    <a href="<?php echo $sitename; ?>logout.php" class="waves-effect subdrop"  <?php if($menu==15) { ?>style="font-weight:bold;" <?php } ?>>
                   
                    <i class="fa fa-sign-out text-primary"></i><span> Logout</span> </a>
                   
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