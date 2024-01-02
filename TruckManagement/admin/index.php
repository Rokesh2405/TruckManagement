<?php
$dynamic = '1';
$menu = '1';
$index='1';
include ('config/config.inc.php');


include ('require/header.php');
//print_r($_SESSION);
$_SESSION['mobileno']='';
unset($_SESSION['mobileno']);

if($_SESSION['highrisk']!='unshow' && isset($_SESSION['doctorid']))
{
  $_SESSION['highrisk']='show';  
}


if(isset($_REQUEST['send3'])){
@extract($_REQUEST);

//Send Mail


$to=$emailid;//
$from="microwebzc@gmail.com";//config pana email

$url=$sitename."WorkTogether_portfolio.pdf";
$message='<p>Hi<br><br>Click below link to download the document the WorkTogether Portfolio<br><br>
* <a href="'.$url.'">Click to download</a>
</p>';


///////form2//

$subject ="WorkTogether Portfolio";
$resmail = sendgridApiMail($to, $message, $subject, $from, '');

        if ($resmail->statusCode() == '202') 
        {
}

//Send Mail

    $msg = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Mail Sent Successfully!</h4></div>';


}



if(isset($_REQUEST['send'])){
@extract($_REQUEST);

//Send Mail


$to=$emailid;//
$from="microwebzc@gmail.com";//config pana email

$url=$sitename."Broker_Carrier_Agreement.pdf";
$message='<p>Hi<br><br>Click below link to download the document the Broker Carrier Agreement<br><br>
* <a href="'.$url.'">Click to download</a>
</p>';


///////form2//

$subject ="Broker Carrier Agreement";
$resmail = sendgridApiMail($to, $message, $subject, $from, '');

        if ($resmail->statusCode() == '202') 
        {
}

//Send Mail

    $msg = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Mail Sent Successfully!</h4></div>';


}


if(isset($_REQUEST['send1'])){
@extract($_REQUEST);

//Send Mail


$to=$emailid;//
$from="microwebzc@gmail.com";//config pana email

$url=$sitename."Employment_Agreement.docx";
$message='<p>Hi<br><br>Click below link to download the document the Employment Agreement<br><br>
* <a href="'.$url.'">Click to download</a>
</p>';


///////form2//

$subject ="Employment Agreement";
$resmail = sendgridApiMail($to, $message, $subject, $from, '');

        if ($resmail->statusCode() == '202') 
        {
}

//Send Mail

    $msg = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Mail Sent Successfully!</h4></div>';


}

if(isset($_REQUEST['send2'])){
@extract($_REQUEST);

//Send Mail


$to=$emailid;//
$from="microwebzc@gmail.com";//config pana email

$url=$sitename."Independent_Contractor_Agreement.docx";
$message='<p>Hi<br><br>Click below link to download the document the Independent Contractor Agreement<br><br>
* <a href="'.$url.'">Click to download</a>
</p>';


///////form2//

$subject ="Independent Contractor Agreement";
$resmail = sendgridApiMail($to, $message, $subject, $from, '');

        if ($resmail->statusCode() == '202') 
        {
}

//Send Mail

    $msg = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Mail Sent Successfully!</h4></div>';


}


?>
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <!-- Page-Title -->
       <?php echo $msg; ?>
            <div class="row">
                <div class="col-sm-2">
                <h4 class="page-title">Dashboard</h4>
                    <p class="text-muted page-title-alt">Welcome to <?php echo getusers('name',$_SESSION['GRUID']); ?>!</p>
                </div>
                 <div class="col-sm-10">
                <div class="row">
                    
                    <?php 
                  if($_SESSION['GRUID']=='1') {
                  ?>
                <div class="col-md-12">

                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">Broker Carrier Agreement</button>&nbsp;&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal1">Employment Agreement</button>&nbsp;&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal2">Independent Contractor Agreement</button>&nbsp;&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal3">WorkTogether Portfolio</button>
             </div>
                 <?php } else { ?>
                      <div class="col-md-12" align="right">
<button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">Broker Carrier Agreement</button>


             <?php } ?>
             <!-- Modal -->
  <form name="mform" method="post">
  <div class="modal fade" id="myModal" role="dialog" style="text-align: left;">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Enter your emailid to get Mail</h4>
        </div>
        <div class="modal-body">
          <p>
<input type="email" required="required" name="emailid" class="form-control" placeholder="Enter your Emailid">
          </p>
        </div>
        <div class="modal-footer">
             <button type="submit" class="btn btn-default" name="send">Send</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
</form>
  <form name="mform" method="post">
  <div class="modal fade" id="myModal1" role="dialog" style="text-align: left;">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Enter your emailid to get Mail</h4>
        </div>
        <div class="modal-body">
          <p>
<input type="email" required="required" name="emailid" class="form-control" placeholder="Enter your Emailid">
          </p>
        </div>
        <div class="modal-footer">
             <button type="submit" class="btn btn-default" name="send1">Send</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
</form>

  <form name="mform" method="post">
  <div class="modal fade" id="myModal2" role="dialog" style="text-align: left;">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Enter your emailid to get Mail</h4>
        </div>
        <div class="modal-body">
          <p>
<input type="email" required="required" name="emailid" class="form-control" placeholder="Enter your Emailid">
          </p>
        </div>
        <div class="modal-footer">
             <button type="submit" class="btn btn-default" name="send2">Send</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
</form>
<form name="mform" method="post">
  <div class="modal fade" id="myModal3" role="dialog" style="text-align: left;">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Enter your emailid to get Mail</h4>
        </div>
        <div class="modal-body">
          <p>
<input type="email" required="required" name="emailid" class="form-control" placeholder="Enter your Emailid">
          </p>
        </div>
        <div class="modal-footer">
             <button type="submit" class="btn btn-default" name="send3">Send</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
</form>


      
                </div>
                </div>
                 </div>
            </div>

             <?php 
                  if($_SESSION['GRUID']=='1') {
                  ?>

			<div class="row">
   <div class="col-md-6 col-lg-6 col-xl-2">
             
                    <a href="<?php echo $sitename; ?>master/customers.htm">
                    <div class="widget-bg-color-icon card-box" style="height: 180px;">
                        <div class="bg-icon bg-white pull-left">
                        <img src="customers-icon-9.jpg" height="90" width="90">
                        <br>  <br>
 <p class="text-muted mb-0" align="center">Customer Mgmnt</p>
                        </div>
                        
                        <div class="clearfix"></div>
                    </div>
              </a>
                </div>
  <div class="col-md-6 col-lg-6 col-xl-2">
             
                         <a href="<?php echo $sitename; ?>master/staff.htm">
                             
                    <div class="widget-bg-color-icon card-box" style="height: 180px;">
                        <div class="bg-icon bg-white pull-left">
                         <img src="customer.png" height="90" width="90">
                        <br>  <br>
 <p class="text-muted mb-0" align="center">Staff Mgmnt</p>
                        </div>
                        

                        <div class="clearfix"></div>
                    </div>
                </a>
                </div>
                   <div class="col-md-6 col-lg-6 col-xl-2">
             
                         <a href="<?php echo $sitename; ?>master/carrier.htm">
                             
                    <div class="widget-bg-color-icon card-box" style="height: 180px;">
                        <div class="bg-icon bg-white pull-left">
                         <img src="truck.png" height="90" width="90">
                        <br>  <br>
 <p class="text-muted mb-0" align="center">Carrier Mgmnt</p>
                        </div>
                        

                        <div class="clearfix"></div>
                    </div>
                </a>
                </div>
    <div class="col-md-6 col-lg-6 col-xl-2">
             
                         <a href="<?php echo $sitename; ?>master/pickup.htm">
                             
                    <div class="widget-bg-color-icon card-box" style="height: 180px;">
                        <div class="bg-icon bg-white pull-left">
                         <img src="lorry.png" height="90" width="90">
                        <br>  <br>
 <p class="text-muted mb-0" align="center">Pickup / Delivery Mgmnt</p>
                        </div>
                        

                        <div class="clearfix"></div>
                    </div>
                </a>
                </div>
               
 <div class="col-md-6 col-lg-6 col-xl-2">
             
                         <a href="<?php echo $sitename; ?>master/salesman.htm">
                             
                    <div class="widget-bg-color-icon card-box" style="height: 180px;">
                        <div class="bg-icon bg-white pull-left">
                         <img src="customer.png" height="90" width="90">
                        <br>  <br>
 <p class="text-muted mb-0" align="center">Salesman Mgmnt</p>
                        </div>
                        

                        <div class="clearfix"></div>
                    </div>
                </a>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-2">
             
                         <a href="<?php echo $sitename; ?>master/expense.htm">
                             
                    <div class="widget-bg-color-icon card-box" style="height: 180px;">
                        <div class="bg-icon bg-white pull-left">
                         <img src="expense.jpeg" height="90" width="90">
                        <br>  <br>
 <p class="text-muted mb-0" align="center">Expense Master</p>
                        </div>
                        

                        <div class="clearfix"></div>
                    </div>
                </a>
                </div>
                 <div class="col-md-6 col-lg-6 col-xl-2">
             
                         <a href="<?php echo $sitename; ?>master/expenseentry.htm">
                             
                    <div class="widget-bg-color-icon card-box" style="height: 180px;">
                        <div class="bg-icon bg-white pull-left">
                         <img src="expense.jpeg" height="90" width="90">
                        <br>  <br>
 <p class="text-muted mb-0" align="center">Expense Entry</p>
                        </div>
                        

                        <div class="clearfix"></div>
                    </div>
                </a>
                </div> 
                     <div class="col-md-6 col-lg-6 col-xl-2">
             
                         <a href="<?php echo $sitename; ?>master/carrier_confirmation.htm">
                             
                    <div class="widget-bg-color-icon card-box" style="height: 180px;">
                        <div class="bg-icon bg-white pull-left">
                         <img src="carrier.jpeg" height="90" width="90">
                        <br>  <br>
 <p class="text-muted mb-0" align="center">Load Board</p>
                        </div>
                        

                        <div class="clearfix"></div>
                    </div>
                </a>
                </div>
                 <div class="col-md-6 col-lg-6 col-xl-2">
             
                         <a href="<?php echo $sitename; ?>master/invoice_transaction.htm">
                             
                    <div class="widget-bg-color-icon card-box" style="height: 180px;">
                        <div class="bg-icon bg-white pull-left">
                         <img src="carrier.jpeg" height="90" width="90">
                        <br>  <br>
 <p class="text-muted mb-0" align="center">Invoice Transaction</p>
                        </div>
                        

                        <div class="clearfix"></div>
                    </div>
                </a>
                </div>
                 <div class="col-md-6 col-lg-6 col-xl-2">
             
                         <a href="<?php echo $sitename; ?>master/salesman_settlement.htm">
                             
                    <div class="widget-bg-color-icon card-box" style="height: 180px;">
                        <div class="bg-icon bg-white pull-left">
                         <img src="customer.png" height="90" width="90">
                        <br>  <br>
 <p class="text-muted mb-0" align="center">Salesman Settlement</p>
                        </div>
                        

                        <div class="clearfix"></div>
                    </div>
                </a>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-2">
             
                         <a href="<?php echo $sitename; ?>master/carrier-report.htm">
                             
                    <div class="widget-bg-color-icon card-box" style="height: 180px;">
                        <div class="bg-icon bg-white pull-left">
                         <img src="report.png" height="90" width="90">
                        <br>  <br>
 <p class="text-muted mb-0" align="center">Carrier Report</p>
                        </div>
                        

                        <div class="clearfix"></div>
                    </div>
                </a>
                </div>
                 <div class="col-md-6 col-lg-6 col-xl-2">
             
                         <a href="<?php echo $sitename; ?>master/carrier-individual-report.htm">
                             
                    <div class="widget-bg-color-icon card-box" style="height: 180px;">
                        <div class="bg-icon bg-white pull-left">
                         <img src="report.png" height="90" width="90">
                        <br>  <br>
 <p class="text-muted mb-0" align="center">Carrier Individual Report</p>
                        </div>
                        

                        <div class="clearfix"></div>
                    </div>
                </a>
                </div>
                  <div class="col-md-6 col-lg-6 col-xl-2">
             
                         <a href="<?php echo $sitename; ?>master/carrier-outstanding-report.htm">
                             
                    <div class="widget-bg-color-icon card-box" style="height: 180px;">
                        <div class="bg-icon bg-white pull-left">
                         <img src="report.png" height="90" width="90">
                        <br>  <br>
 <p class="text-muted mb-0" align="center">Carrier Outstanding Report</p>
                        </div>
                        

                        <div class="clearfix"></div>
                    </div>
                </a>
                </div>
                 <div class="col-md-6 col-lg-6 col-xl-2">
             
                         <a href="<?php echo $sitename; ?>master/carrier-customer-report.htm">
                             
                    <div class="widget-bg-color-icon card-box" style="height: 180px;">
                        <div class="bg-icon bg-white pull-left">
                         <img src="report.png" height="90" width="90">
                        <br>  <br>
 <p class="text-muted mb-0" align="center">Customer Report</p>
                        </div>
                        

                        <div class="clearfix"></div>
                    </div>
                </a>
                </div>
                 <div class="col-md-6 col-lg-6 col-xl-2">
             
                         <a href="<?php echo $sitename; ?>master/customer-individual-report.htm">
                             
                    <div class="widget-bg-color-icon card-box" style="height: 180px;">
                        <div class="bg-icon bg-white pull-left">
                         <img src="report.png" height="90" width="90">
                        <br>  <br>
 <p class="text-muted mb-0" align="center">Customer Individual Report</p>
                        </div>
                        

                        <div class="clearfix"></div>
                    </div>
                </a>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-2">
             
                         <a href="<?php echo $sitename; ?>master/customer-outstanding-report.htm">
                             
                    <div class="widget-bg-color-icon card-box" style="height: 180px;">
                        <div class="bg-icon bg-white pull-left">
                         <img src="report.png" height="90" width="90">
                        <br>  <br>
 <p class="text-muted mb-0" align="center">Customer Outstanding Report</p>
                        </div>
                        

                        <div class="clearfix"></div>
                    </div>
                </a>
                </div>
                 
              


        <div class="col-md-6 col-lg-6 col-xl-2">
             
                         <a href="<?php echo $sitename; ?>master/salesman-report.htm">
                             
                    <div class="widget-bg-color-icon card-box" style="height: 180px;">
                        <div class="bg-icon bg-white pull-left">
                         <img src="report.png" height="90" width="90">
                        <br>  <br>
 <p class="text-muted mb-0" align="center">Salesman Report</p>
                        </div>
                        

                        <div class="clearfix"></div>
                    </div>
                </a>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-2">
             
                         <a href="<?php echo $sitename; ?>master/salesman-outstanding-report.htm">
                             
                    <div class="widget-bg-color-icon card-box" style="height: 180px;">
                        <div class="bg-icon bg-white pull-left">
                         <img src="report.png" height="90" width="90">
                        <br>  <br>
 <p class="text-muted mb-0" align="center">Salesman Outstanding Report</p>
                        </div>
                        

                        <div class="clearfix"></div>
                    </div>
                </a>
                </div>
                 <div class="col-md-6 col-lg-6 col-xl-2">
             
                         <a href="<?php echo $sitename; ?>master/salesman-individual-report.htm">
                             
                    <div class="widget-bg-color-icon card-box" style="height: 180px;">
                        <div class="bg-icon bg-white pull-left">
                         <img src="report.png" height="90" width="90">
                        <br>  <br>
 <p class="text-muted mb-0" align="center">Salesman Individual Report</p>
                        </div>
                        

                        <div class="clearfix"></div>
                    </div>
                </a>
                </div>
                
                 <div class="col-md-6 col-lg-6 col-xl-2">
             
                         <a href="<?php echo $sitename; ?>master/expense_report.htm">
                             
                    <div class="widget-bg-color-icon card-box" style="height: 180px;">
                        <div class="bg-icon bg-white pull-left">
                         <img src="report.png" height="90" width="90">
                        <br>  <br>
 <p class="text-muted mb-0" align="center">Expense Report</p>
                        </div>
                        

                        <div class="clearfix"></div>
                    </div>
                </a>
                </div>
                 <div class="col-md-6 col-lg-6 col-xl-2">
             
                         <a href="<?php echo $sitename; ?>master/profit_report.htm">
                             
                    <div class="widget-bg-color-icon card-box" style="height: 180px;">
                        <div class="bg-icon bg-white pull-left">
                         <img src="report.png" height="90" width="90">
                        <br>  <br>
 <p class="text-muted mb-0" align="center">Profit & Loss Report</p>
                        </div>
                        

                        <div class="clearfix"></div>
                    </div>
                </a>
                </div>
                                     
</div>
	<?php } else { ?>
<div class="row">
   <div class="col-md-6 col-lg-6 col-xl-2">
             
                    <a href="<?php echo $sitename; ?>master/customers.htm">
                    <div class="widget-bg-color-icon card-box" style="height: 180px;">
                        <div class="bg-icon bg-white pull-left">
                        <img src="customers-icon-9.jpg" height="90" width="90">
                        <br>  <br>
 <p class="text-muted mb-0" align="center">Customer Mgmnt</p>
                        </div>
                        
                        <div class="clearfix"></div>
                    </div>
              </a>
                </div>

                   <div class="col-md-6 col-lg-6 col-xl-2">
             
                         <a href="<?php echo $sitename; ?>master/carrier.htm">
                             
                    <div class="widget-bg-color-icon card-box" style="height: 180px;">
                        <div class="bg-icon bg-white pull-left">
                         <img src="truck.png" height="90" width="90">
                        <br>  <br>
 <p class="text-muted mb-0" align="center">Carrier Mgmnt</p>
                        </div>
                        

                        <div class="clearfix"></div>
                    </div>
                </a>
                </div>
    <div class="col-md-6 col-lg-6 col-xl-2">
             
                         <a href="<?php echo $sitename; ?>master/pickup.htm">
                             
                    <div class="widget-bg-color-icon card-box" style="height: 180px;">
                        <div class="bg-icon bg-white pull-left">
                         <img src="lorry.png" height="90" width="90">
                        <br>  <br>
 <p class="text-muted mb-0" align="center">Pickup / Delivery Mgmnt</p>
                        </div>
                        

                        <div class="clearfix"></div>
                    </div>
                </a>
                </div>
               
               

                     <div class="col-md-6 col-lg-6 col-xl-2">
             
                         <a href="<?php echo $sitename; ?>master/carrier_confirmation.htm">
                             
                    <div class="widget-bg-color-icon card-box" style="height: 180px;">
                        <div class="bg-icon bg-white pull-left">
                         <img src="carrier.jpeg" height="90" width="90">
                        <br>  <br>
 <p class="text-muted mb-0" align="center">Load Board</p>
                        </div>
                        

                        <div class="clearfix"></div>
                    </div>
                </a>
                </div>
                 <div class="col-md-6 col-lg-6 col-xl-2">
             
                         <a href="<?php echo $sitename; ?>master/invoice_transaction.htm">
                             
                    <div class="widget-bg-color-icon card-box" style="height: 180px;">
                        <div class="bg-icon bg-white pull-left">
                         <img src="carrier.jpeg" height="90" width="90">
                        <br>  <br>
 <p class="text-muted mb-0" align="center">Invoice Transaction</p>
                        </div>
                        

                        <div class="clearfix"></div>
                    </div>
                </a>
                </div>
             

                <div class="col-md-6 col-lg-6 col-xl-2">
             
                         <a href="<?php echo $sitename; ?>master/carrier-report.htm">
                             
                    <div class="widget-bg-color-icon card-box" style="height: 180px;">
                        <div class="bg-icon bg-white pull-left">
                         <img src="report.png" height="90" width="90">
                        <br>  <br>
 <p class="text-muted mb-0" align="center">Carrier Report</p>
                        </div>
                        

                        <div class="clearfix"></div>
                    </div>
                </a>
                </div>
                 <div class="col-md-6 col-lg-6 col-xl-2">
             
                         <a href="<?php echo $sitename; ?>master/carrier-individual-report.htm">
                             
                    <div class="widget-bg-color-icon card-box" style="height: 180px;">
                        <div class="bg-icon bg-white pull-left">
                         <img src="report.png" height="90" width="90">
                        <br>  <br>
 <p class="text-muted mb-0" align="center">Carrier Individual Report</p>
                        </div>
                        

                        <div class="clearfix"></div>
                    </div>
                </a>
                </div>
                  <div class="col-md-6 col-lg-6 col-xl-2">
             
                         <a href="<?php echo $sitename; ?>master/carrier-outstanding-report.htm">
                             
                    <div class="widget-bg-color-icon card-box" style="height: 180px;">
                        <div class="bg-icon bg-white pull-left">
                         <img src="report.png" height="90" width="90">
                        <br>  <br>
 <p class="text-muted mb-0" align="center">Carrier Outstanding Report</p>
                        </div>
                        

                        <div class="clearfix"></div>
                    </div>
                </a>
                </div>
                
               
                 <div class="col-md-6 col-lg-6 col-xl-2">
             
                         <a href="<?php echo $sitename; ?>master/carrier-customer-report.htm">
                             
                    <div class="widget-bg-color-icon card-box" style="height: 180px;">
                        <div class="bg-icon bg-white pull-left">
                         <img src="report.png" height="90" width="90">
                        <br>  <br>
 <p class="text-muted mb-0" align="center">Customer Report</p>
                        </div>
                        

                        <div class="clearfix"></div>
                    </div>
                </a>
                </div>
                 <div class="col-md-6 col-lg-6 col-xl-2">
             
                         <a href="<?php echo $sitename; ?>master/customer-individual-report.htm">
                             
                    <div class="widget-bg-color-icon card-box" style="height: 180px;">
                        <div class="bg-icon bg-white pull-left">
                         <img src="report.png" height="90" width="90">
                        <br>  <br>
 <p class="text-muted mb-0" align="center">Customer Individual Report</p>
                        </div>
                        

                        <div class="clearfix"></div>
                    </div>
                </a>
                </div>
<div class="col-md-6 col-lg-6 col-xl-2">
             
                         <a href="<?php echo $sitename; ?>master/customer-outstanding-report.htm">
                             
                    <div class="widget-bg-color-icon card-box" style="height: 180px;">
                        <div class="bg-icon bg-white pull-left">
                         <img src="report.png" height="90" width="90">
                        <br>  <br>
 <p class="text-muted mb-0" align="center">Customer Outstanding Report</p>
                        </div>
                        

                        <div class="clearfix"></div>
                    </div>
                </a>
                </div>
               
        <div class="col-md-6 col-lg-6 col-xl-2">
             
                         <a href="<?php echo $sitename; ?>master/salesman-report.htm">
                             
                    <div class="widget-bg-color-icon card-box" style="height: 180px;">
                        <div class="bg-icon bg-white pull-left">
                         <img src="report.png" height="90" width="90">
                        <br>  <br>
 <p class="text-muted mb-0" align="center">Salesman Report</p>
                        </div>
                        

                        <div class="clearfix"></div>
                    </div>
                </a>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-2">
             
                         <a href="<?php echo $sitename; ?>master/salesman-outstanding-report.htm">
                             
                    <div class="widget-bg-color-icon card-box" style="height: 180px;">
                        <div class="bg-icon bg-white pull-left">
                         <img src="report.png" height="90" width="90">
                        <br>  <br>
 <p class="text-muted mb-0" align="center">Salesman Outstanding Report</p>
                        </div>
                        

                        <div class="clearfix"></div>
                    </div>
                </a>
                </div>
                 <div class="col-md-6 col-lg-6 col-xl-2">
             
                         <a href="<?php echo $sitename; ?>master/salesman-individual-report.htm">
                             
                    <div class="widget-bg-color-icon card-box" style="height: 180px;">
                        <div class="bg-icon bg-white pull-left">
                         <img src="report.png" height="90" width="90">
                        <br>  <br>
 <p class="text-muted mb-0" align="center">Salesman Individual Report</p>
                        </div>
                        

                        <div class="clearfix"></div>
                    </div>
                </a>
                </div>
               
               </div>
                
                
    <?php } ?>
	<?php include 'require/footer.php'; ?>      