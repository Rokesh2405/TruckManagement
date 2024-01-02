<?php
$menu = "4";
$thispageid = 17;
$franchisee = 'yes';
include ('../../config/config.inc.php');
include ('../../require/header.php');
// error_reporting(1);
// ini_set('display_errors','1');
// error_reporting(E_ALL);


if(isset($_REQUEST['send'])){
@extract($_REQUEST);

//Send Mail


$to=$emailid;//
$from="info@worktogethergroup.ca";//config pana email

$url=$sitename."Broker_Carrier_Agreement.pdf";
$message='<p><strong>Hi,</strong><br>
<table width="100%" cellpadding="10" cellspacing="0">
<tr>
<td><strong>Customer Name</strong></td>
<td>'.$customer_name.'</td>
</tr>
<tr>
<td><strong>Pickup Name</strong></td>
<td>'.$pickup_name.'</td>
</tr>
<tr>
<td><strong>Delivery Name</strong></td>
<td>'.$delivery_name.'</td>
</tr>
<tr>
<td><strong>Pickup Date</strong></td>
<td>'.date('d-m-Y',strtotime($pickup_date)).'</td>
</tr>
<tr>
<td><strong>Delivery Date</strong></td>
<td>'.date('d-m-Y',strtotime($delivery_date)).'</td>
</tr>
<tr>
<td><strong>Notes</strong></td>
<td>'.$notes.'</td>
</tr>
</table>
<br><br><br>
<strong>Regards,<br>
worktogethergroup</strong>
</p>';


///////form2//

$subject ="Load Board Availablity";
$resmail = sendgridApiMail($to, $message, $subject, $from, '');

        if ($resmail->statusCode() == '202') 
        {
}

//Send Mail

    $msg = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Mail Sent Successfully!</h4></div>';


}



if($_REQUEST['delid1']!='')
{
 global $db;
 $c=$_REQUEST['delid1'];
        $get = $db->prepare("DELETE FROM `coapplicant` WHERE `id` = ? ");
        $get->execute(array($c));	
		$url=$sitename.'master/'.$_REQUEST['banid'].'/editcustomer.htm';
	  echo "<script>alert('Addon Deleted Successfully');window.location.assign('".$url."')</script>";
			
}

if (isset($_REQUEST['submit'])) {
    @extract($_REQUEST);
    $getid = $_REQUEST['banid'];
    $ip = $_SERVER['REMOTE_ADDR'];


    $msg = addloadconfirmation($emailid,$customer_name,$pickup_name,$delivery_name,$pickup_date,$delivery_date,$notes,$getid);
}

?>
<script type="text/javascript">,
 
    function deleteimage(a, b, c, d, e, f) {

        $.ajax({
            type: "POST",
            url: "<?php echo $sitename; ?>config/functions_ajax.php",
            data: {image: a, id: b, table: c, path: d, images: e, pid: f},
            success: function (data) {
               // alert(data);   
                $('#delimage').html(data);
            }

        });

    }
</script>
 <style>
                         .plusspan {
        float: right;
        margin-right: 6px;
        margin-top: -24px;
        position: relative;
        z-index: 2;
        color: blue;
    }
                    </style>

<!-- Content Wrapper. Contains page content -->
<div class="content-page">
    <!-- Start content -->
    <div class="content" style="margin-top: 50px !important;">
        <div class="container-fluid">

            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="btn-group pull-right m-t-15">
                        <a href="<?php echo $sitename; ?>master/load_confirmation.htm"><button type="button" class="btn btn-default">Back to Listings Page</button>
                        </a>

                    </div>

                    <h4 class="page-title"><?php
                        if (isset($_REQUEST['banid'])) {
                            echo "Edit";
                        } else {
                            echo "Add";
                        }
                        ?> Load Confirmation</h4>
                    <ol class="breadcrumb" style="margin-bottom: 0px;">
                      
                        <li class="breadcrumb-item"><a href="load_confirmation.htm">Load Confirmation</a></li>
                        <li class="breadcrumb-item active"><?php
                            if (isset($_REQUEST['banid'])) {
                                echo "Edit";
                            } else {
                                echo "Add";
                            }
                            ?> Load Confirmation</li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box">

<!-- <p class="text-muted m-b-30 font-13">
    Use the button classes on an <code>&lt;a&gt;</code>, <code>&lt;button&gt;</code>, or <code>&lt;input&gt;</code> element.
</p> -->
                        <div class="row">
                            <div class="col-md-12">
                            <?php echo $msg; ?>

                                <form method="post" autocomplete="off" enctype="multipart/form-data" action="">
                                    <div class="box box-info">
                                     
                                        <div class="box-body">
                                        
                                        <?php //echo $msg; ?>
              
              
                          <div class="row">
                             
						 <div class="col-md-3">
                            <label>Customer Name</label>
                           <input type="text" name="customer_name" placeholder="Enter Customer"  id="contact" class="form-control" value="<?php echo getloadconfirmation('customer_name',$_REQUEST['banid']);?>" >
                            
                            
                          </div>
                          <div class="col-md-3">
                            <label>Pickup Name</label>
                           <input type="text" name="pickup_name" placeholder="Pickup"  id="pickup_name" class="form-control" value="<?php echo getloadconfirmation('pickup_name',$_REQUEST['banid']);?>"><a href="<?php echo $sitename; ?>master/addpickup.htm" target="_blank"><span class="fa fa-plus plusspan"></span></a>
                          </div>
                      <div class="col-md-3">
                            <label>Delivery Name</label>
                           <input type="text" name="delivery_name" placeholder="Delivery"  id="delivery_name" class="form-control" value="<?php echo getloadconfirmation('delivery_name',$_REQUEST['banid']);?>">
                            
                             <a href="<?php echo $sitename; ?>master/addpickup.htm"  target="_blank"><span class="fa fa-plus plusspan"></span></a>
                          </div>
                             <div class="col-md-3">
                            <label>Pickup Date</label>
                            <input type="date" class="form-control" name="pickup_date" value="<?php echo getloadconfirmation('pickup_date',$_REQUEST['banid']);?>" maxlength="50">
                          </div>
                         
						  </div>
                         
                          <div class="row">
                               <div class="col-md-3">
                            <label>Delivery Date</label>
                            <input type="date" class="form-control" name="delivery_date" value="<?php echo getloadconfirmation('delivery_date',$_REQUEST['banid']);?>" maxlength="50">
                          </div>
                            <div class="col-md-3">
                            <label>Emailid</label>
                            <input type="email" class="form-control" name="emailid" value="<?php echo getloadconfirmation('emailid',$_REQUEST['banid']);?>" required="required">
                          </div>
                          <div class="col-md-3">
                            <label>Notes</label>
                            <textarea name="notes" class="form-control"><?php echo getloadconfirmation('notes',$_REQUEST['banid']);?></textarea>
                          </div>
                      </div>
                      <div class="row">
                        
 <div class="col-md-1">
                          <br>
                            <button type="submit" name="submit" id="submit" class="btn btn-success" style="float:left;"><?php
                                if ($_REQUEST['banid'] != '') {
                                    echo 'UPDATE';
                                } else {
                                    echo 'SUBMIT';
                                }
                                ?></button>
                        </div>
              
              <div class="col-md-1" align="left">
                   <br>
                  <button type="button" name="submit" id="submit" class="btn btn-success reset" style="float:left;">CLEAR</button>
              </div>
 <div class="col-md-1" align="left">
                   <br>
                  <button type="submit" name="send" id="send" class="btn btn-success" style="float:left;">SEND MAIL</button>
              </div>

                         
                        </div>	
						
                            <!-- <div class="row">
							<div class="col-md-6">
                            <label>Proof Details</label>
<textarea name="proof_details" class="form-control" required="required"><?php echo getcustomer('proof_details', $_REQUEST['banid']); ?></textarea>                          
				 </div>
							<div class="col-md-6">
                            <label>Address<span style="color:#FF0000;"> </span></label>
<textarea name="address" class="form-control" required="required"><?php echo getcustomer('address', $_REQUEST['banid']); ?></textarea>                          
				 </div>
				 </div> -->
				 
				 <!-- <div class="row">
						  <div class="col-md-6">
                            <label>Status</label>
                          
                          <select name="status" class="form-control">
                         <option value="1" <?php if(getcustomer('status', $_REQUEST['banid'])=='1') { ?> selected="selected" <?php } ?>>Active</option>      
                         <option value="0" <?php if(getcustomer('status', $_REQUEST['banid'])=='0') { ?> selected="selected" <?php } ?>>Inactive</option>      
                          </select></div>
						   
						   
                          </div> -->
						 
						  <!-- <div class="row">
                                                <div class="col-md-12"> 
												<div class="panel panel-info">
                                                        <div class="panel-heading">
                                                            <div class="panel-title">Insurance Details</div>
                                                        </div>
                                                        <div class="panel-body">
														<div class="row">
														  <div class="col-md-6">
                            <label>Having Insurance ? <span style="color:#FF0000;"> </span></label>
							<select name="having_insurance" class="form-control" required="required" onchange="getins(this.value);">
							<option value="">Select</option>
							<option value="1" <?php if(getcustomer('having_insurance',$_REQUEST['banid'])=='1') { ?> selected="selected" <?php } ?>>Yes</option>
							<option value="0" <?php if(getcustomer('having_insurance',$_REQUEST['banid'])=='0') { ?> selected="selected" <?php } ?>>No</option>
							</select>
						    </div>
							
							<div class="col-md-6"  <?php if(getcustomer('having_insurance',$_REQUEST['banid'])=='1') { ?> style="display:block;"<?php } else { ?>style="display:none;"<?php } ?> id="ins1">
                            <label>Insurance Expiry Date <span style="color:#FF0000;"> </span></label>
                           <input type="date"  name="ins_expiry_date" placeholder="Select Expiry Date" value="<?php echo getcustomer('ins_expiry_date',$_REQUEST['banid']);?>" id="ins_expiry_date" class="form-control">
                           </div>
														</div>
													<br>	
										<div class="row" >
										<div class="col-md-6" <?php if(getcustomer('having_insurance',$_REQUEST['banid'])=='0') { ?> style="display:block;"<?php } else { ?>style="display:none;"<?php } ?> id="ins2">
                            <label>Name of the Insurance<span style="color:#FF0000;"> </span></label>
                           <input type="text" name="insurance_name" placeholder="Enter Insurance Name" value="<?php echo getcustomer('insurance_name',$_REQUEST['banid']);?>" id="insurance_name" class="form-control">
                           </div>
									<div class="col-md-6" <?php if(getcustomer('having_insurance',$_REQUEST['banid'])=='0') { ?> style="display:block;"<?php } else { ?>style="display:none;"<?php } ?> id="ins3">
                            <label>Insurance Amount<span style="color:#FF0000;"> </span></label>
                           <input type="text" name="insurance_amount" placeholder="Enter Insurance Amount" value="<?php echo getcustomer('insurance_amount',$_REQUEST['banid']);?>" id="insurance_amount" class="form-control">
                           </div></div>
										</div>				
														</div></div></div> -->

                             
                         
                  </div>
                 
                        
                                 <br>
                         
               
                </div><!-- /.box-body -->
                <br><br>
                <div class="box-footer">
                    <div class="row">
                        <div class="col-md-6">
                            <a href="<?php echo $sitename; ?>master/load_confirmation.htm">Back to Listings page</a>
                        </div>
                       
                    </div>
                </div>
                    
                                    </div>  </form>
                            </div> 
                        </div> 
                    </div> 
                </div> 
            </div> 
        </div> 
    </div> 


    <!-- /.box -->
</div>
<!-- /.content -->
<!-- /.content-wrapper -->

<?php include ('../../require/footer.php'); ?>



<link href="https://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" rel="Stylesheet">
<script src="https://code.jquery.com/ui/1.10.2/jquery-ui.js" ></script>
<script src="https://code.jquery.com/jquery-migrate-3.0.0.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>


<script type="text/javascript">


  $("input[type=text]").keyup(function () {  
            $(this).val($(this).val().toUpperCase());  
            var keyCode = event .keyCode || event .which;
   if(keyCode=='13' || keyCode=='9'){
 if ($('#alresult').html()==='Already Exist') {
     $('#customer_name').focus(); 
      }
        if ($('#emailerror1').html()==='Invalid email address.') {
     $('#email_dispatch').focus(); 
      }
      if ($('#emailerror2').html()==='Invalid email address.') {
     $('#email').focus(); 
      }
     }

        });  
        $(".num").keypress(function() {
            if ($(this).val().length == $(this).attr("maxlength")) {
              $(this).val('');
                $(this).focus();
            }
         
        });
 



function telformat(a,b) {
var phnumber = a;
var numbers = phnumber.replace(/\D/g, ''),
char = { 0: '(', 3: ') ', 6: ' - ' };
phnumber = '';
for (var i = 0; i < numbers.length; i++) {
phnumber += (char[i] || '') + numbers[i];
}
 $('#'+b).val(phnumber); 
}

//pickup

$(document).on('keydown', '#pickup_name', function (e){
     var product = $(this).val();
     $(this).val($(this).val().toUpperCase());
     $this = $(this);
     
     // Initialize jQuery UI autocomplete
  $('#pickup_name').autocomplete({
   source: function( request, response ) {
    $.ajax({
   url:"<?php echo $sitename.'pages/master/'; ?>getdetails.php",
     type: 'post',
     dataType: "json",
     data: {
      search: request.term,request:88
     },
     success: function( data ) {
        if (!$.trim(data)){   
      $('#pickup_name').val(''); 
            var keyCode = event .keyCode || event .which;
   if(keyCode=='13' || keyCode=='9'){
     $('#pickup_name').focus();  
}
}
else
{
     response( data );
}
     }
    });
   },
   select: function (event, ui) {
    $(this).val(ui.item.label); // display the selected text
    var userid = ui.item.value; // selected value
    $.ajax({
                url:"<?php echo $sitename.'pages/master/'; ?>getdetails.php",
                data:{pickup:userid}
            }).done(function(result)
            {
                   $('#pickup_address').val(result);
            })

    return false;
   }
  });
      
});


//salesman

$(document).on('keydown', '#salesman', function (e){
     var product = $(this).val();
     $(this).val($(this).val().toUpperCase());
     $this = $(this);
     
     // Initialize jQuery UI autocomplete
  $('#salesman').autocomplete({
   source: function( request, response ) {
    $.ajax({
   url:"<?php echo $sitename.'pages/master/'; ?>getdetails.php",
     type: 'post',
     dataType: "json",
     data: {
      search: request.term,request:77
     },
     success: function( data ) {
        if (!$.trim(data)){   
      $('#salesman').val(''); 
            var keyCode = event .keyCode || event .which;
   if(keyCode=='13' || keyCode=='9'){
     $('#salesman').focus();  
}
}
else
{
     response( data );
}
     }
    });
   },
   select: function (event, ui) {
    $(this).val(ui.item.label); // display the selected text
    var userid = ui.item.value; // selected value
    payment= $('#payment').val();
    $.ajax({
                url:"<?php echo $sitename.'pages/master/'; ?>getdetails.php",
                data:{salesman:userid,payment:payment}
            }).done(function(result)
            {
                   $('#salesman_commission').val(result);
            })

    return false;
   }
  });
      
});



//delivery
$(document).on('keydown', '#delivery_name', function (e){
     var product = $(this).val();
     $(this).val($(this).val().toUpperCase());
     $this = $(this);
     
     // Initialize jQuery UI autocomplete
  $('#delivery_name').autocomplete({
   source: function( request, response ) {
    $.ajax({
   url:"<?php echo $sitename.'pages/master/'; ?>getdetails.php",
     type: 'post',
     dataType: "json",
     data: {
      search: request.term,request:88
     },
     success: function( data ) {
        if (!$.trim(data)){   
      $('#delivery_name').val(''); 
            var keyCode = event .keyCode || event .which;
   if(keyCode=='13' || keyCode=='9'){
     $('#delivery_name').focus();  
}
}
else
{
     response( data );
}
     }
    });
   },
   select: function (event, ui) {
    $(this).val(ui.item.label); // display the selected text
    var userid = ui.item.value; // selected value
     $.ajax({
                url:"<?php echo $sitename.'pages/master/'; ?>getdetails.php",
                data:{pickup:userid}
            }).done(function(result)
            {
                   $('#delivery_address').val(result);
            })

    return false;
   }
  });
      
});

$(document).on('keydown', '#contact', function (e){
     var product = $(this).val();
     $(this).val($(this).val().toUpperCase());
     $this = $(this);
     
     // Initialize jQuery UI autocomplete
  $('#contact').autocomplete({
   source: function( request, response ) {
    $.ajax({
   url:"<?php echo $sitename.'pages/master/'; ?>getdetails.php",
     type: 'post',
     dataType: "json",
     data: {
      search: request.term,request:1
     },
     success: function( data ) {
        if (!$.trim(data)){   
      $('#contact').val(''); 
            var keyCode = event .keyCode || event .which;
   if(keyCode=='13' || keyCode=='9'){
     $('#contact').focus();  
}
}
else
{
     response( data );
}
     }
    });
   },
   select: function (event, ui) {
    $(this).val(ui.item.label); // display the selected text
    var userid = ui.item.value; // selected value
    return false;
   }
  });
      
});


$(document).on('keydown', '#carrier', function (e){
     var product = $(this).val();
     $(this).val($(this).val().toUpperCase());
     $this = $(this);
     
     // Initialize jQuery UI autocomplete
  $('#carrier').autocomplete({
   source: function( request, response ) {
    $.ajax({
   url:"<?php echo $sitename.'pages/master/'; ?>getdetails.php",
     type: 'post',
     dataType: "json",
     data: {
      search: request.term,request:125
     },
     success: function( data ) {
        if (!$.trim(data)){   
      $('#carrier').val(''); 
            var keyCode = event .keyCode || event .which;
   if(keyCode=='13' || keyCode=='9'){
     $('#carrier').focus();  
}
}
else
{
     response( data );
}
     }
    });
   },
   select: function (event, ui) {
    $(this).val(ui.item.label); // display the selected text
    var userid = ui.item.value; // selected value
    return false;
   }
  });
      
});

$(document).on('keydown', '#booked_by', function (e){
     var product = $(this).val();
     $(this).val($(this).val().toUpperCase());
     $this = $(this);
     
     // Initialize jQuery UI autocomplete
  $('#booked_by').autocomplete({
   source: function( request, response ) {
    $.ajax({
   url:"<?php echo $sitename.'pages/master/'; ?>getdetails.php",
     type: 'post',
     dataType: "json",
     data: {
      search: request.term,request:123
     },
     success: function( data ) {
        if (!$.trim(data)){   
      $('#booked_by').val(''); 
            var keyCode = event .keyCode || event .which;
   if(keyCode=='13' || keyCode=='9'){
     $('#booked_by').focus();  
}
}
else
{
     response( data );
}
     }
    });
   },
   select: function (event, ui) {
    $(this).val(ui.item.label); // display the selected text
    var userid = ui.item.value; // selected value
    return false;
   }
  });
      
});



 $(".reset").click(function() {
    $(this).closest('form').find("input[type=text], input[type=email],input[type=number],input[type=date]").val("");
    $('#province_state').prop('selectedIndex',0);
});


</script>
          <script src="https://code.jquery.com/ui/1.10.2/jquery-ui.js" ></script>



