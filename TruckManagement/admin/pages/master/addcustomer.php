<?php
$menu = "4";
$thispageid = 17;
$franchisee = 'yes';
include ('../../config/config.inc.php');
include ('../../require/header.php');
// error_reporting(1);
// ini_set('display_errors','1');
// error_reporting(E_ALL);

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
    
	
	 $pimage1 = getcustomer('proof', $_REQUEST['banid']);
    if(isset($_FILES["proof"]) && $_FILES["proof"]["error"] == 0)
    {
        $allowed1 = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
        $filename1 = time().str_replace(' ','-',$_FILES["proof"]["name"]);
        $filetype1 = $_FILES["proof"]["type"];
        $filesize1 = $_FILES["proof"]["size"];
        $ext1 = pathinfo($filename1, PATHINFO_EXTENSION);
        if(!array_key_exists($ext1, $allowed1)) die("Error: Please select a valid file format.");
        $maxsize1 = 5 * 1024 * 1024;
        if($filesize1 > $maxsize1) die("Error: File size is larger than the allowed limit.");
        if(in_array($filetype1, $allowed1))
        {
                move_uploaded_file($_FILES["proof"]["tmp_name"], $filename1 . "../../../../images/proof/" . $filename1);
                echo "Your file was uploaded successfully.";
    
        } 
        else
        {
            echo "Error: There was a problem uploading your file. Please try again."; 
        }
    } 
    else {
        $filename1 = $pimage1;
    }
	
	 $pimage2 = getcustomer('cuphoto', $_REQUEST['banid']);
    if(isset($_FILES["cuphoto"]) && $_FILES["cuphoto"]["error"] == 0)
    {
        $allowed2 = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
        $filename2 = time().str_replace(' ','-',$_FILES["cuphoto"]["name"]);
        $filetype2 = $_FILES["cuphoto"]["type"];
        $filesize2 = $_FILES["cuphoto"]["size"];
        $ext2 = pathinfo($filename2, PATHINFO_EXTENSION);
        if(!array_key_exists($ext2, $allowed2)) die("Error: Please select a valid file format.");
        $maxsize2 = 5 * 1024 * 1024;
        if($filesize2 > $maxsize2) die("Error: File size is larger than the allowed limit.");
        if(in_array($filetype2, $allowed2))
        {
                move_uploaded_file($_FILES["cuphoto"]["tmp_name"], $filename2 . "../../../../images/cuphoto/" . $filename2);
                echo "Your file was uploaded successfully.";
    
        } 
        else
        {
            echo "Error: There was a problem uploading your file. Please try again."; 
        }
    } 
    else {
        $filename2 = $pimage2;
    }
	
	
	$pimage3 = getcustomer('bikephoto', $_REQUEST['banid']);
    if(isset($_FILES["bikephoto"]) && $_FILES["bikephoto"]["error"] == 0)
    {
        $allowed3 = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
        $filename3 = time().str_replace(' ','-',$_FILES["bikephoto"]["name"]);
        $filetype3 = $_FILES["bikephoto"]["type"];
        $filesize3 = $_FILES["bikephoto"]["size"];
        $ext3 = pathinfo($filename3, PATHINFO_EXTENSION);
        if(!array_key_exists($ext3, $allowed3)) die("Error: Please select a valid file format.");
        $maxsize3= 5 * 1024 * 1024;
        if($filesize3 > $maxsize3) die("Error: File size is larger than the allowed limit.");
        if(in_array($filetype3, $allowed3))
        {
                move_uploaded_file($_FILES["bikephoto"]["tmp_name"], $filename3 . "../../../../images/bikephoto/" . $filename3);
                echo "Your file was uploaded successfully.";
    
        } 
        else
        {
            echo "Error: There was a problem uploading your file. Please try again."; 
        }
    } 
    else {
        $filename3 = $pimage3;
    }
	
	$appid1=implode(',',$appid);
	$appname1=implode(',',$appname);
	$appmobile1=implode(',',$appmobile);
	$appaddress1=implode(',',$appaddress);

if($_REQUEST['getid']!=''){
$getid=$_REQUEST['getid'];
}

    $msg = addcustomer($remark,$email_dispatch,$currency,$website,$status,$email,$customer_name,$contact_name,$customer_address,$customer_address1,$posta_zip_code,$country,$telephone_admin,$telephone_port,$fax1,$fax2,$province_state,$city,$terms,$surity,$credit_limit,$getid);
}
 $link22 = FETCH_all("SELECT * FROM `customer` WHERE id!=? ORDER BY `id` DESC", 0);
           if($link22['customer_code']!=''){
               $customer_code=$link22['customer_code']+1;
           }
           else{
             $customer_code='991240001';
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


<!-- Content Wrapper. Contains page content -->
<div class="content-page">
    <!-- Start content -->
    <div class="content" style="margin-top: 50px !important;">
        <div class="container-fluid">

            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="btn-group pull-right m-t-15">
                        <a href="<?php echo $sitename; ?>master/customers.htm"><button type="button" class="btn btn-default">Back to Listings Page</button>
                        </a>

                    </div>

                    <h4 class="page-title"><?php
                        if (isset($_REQUEST['banid'])) {
                            echo "Edit";
                        } else {
                            echo "Add";
                        }
                        ?> Customer</h4>
                    <ol class="breadcrumb" style="margin-bottom: 0px;">
                      
                        <li class="breadcrumb-item"><a href="customers.htm"> Customers-></a></li>
                        <li class="breadcrumb-item active"><?php
                            if (isset($_REQUEST['banid'])) {
                                echo "Edit";
                            } else {
                                echo "Add";
                            }
                            ?> Customer</li>
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
                            <label>Customer Code<span style="color:#FF0000;"></span></label>
                            <input type="hidden" name="getid" id="getid">
                           <input type="text" readonly="readonly" name="customer_code" placeholder="Enter Customer Code" readonly  id="customer_code" class="form-control" value="<?php if($_REQUEST['banid']!='') {  echo getcustomer('customer_code',$_REQUEST['banid']); } else { echo $customer_code; }
                       ?>">
                            
                            
                          </div>
						 <div class="col-md-3">
                            <label></label>
                           <select class="form-control" name="customer_code2" onchange="getcusdetails1(this.value);"  style="background: #bfbff1;">
                               <option value="">SELECT CUSTOMER</option>
        <?php
        $clist = pFETCH("SELECT * FROM customer WHERE `id`!=?", '0');
        while ($cfetch = $clist->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                         
        <option value="<?php echo $cfetch['id']; ?>"><?php echo $cfetch['customer_name']; ?></option>
        <?php } ?> 
                           </select>
                            
                            
                          </div>
						  </div>
                         
                          <div class="row">
                              <div class="col-md-3">
                            <label>Customer Name&nbsp;<span style="color:#FF0000;" id="alresult"> </span></label>
                          
                              <input type="text" name="customer_name" placeholder="Enter Customer Name"  id="customer_name" class="form-control" value="<?php echo getcustomer('customer_name',$_REQUEST['banid']);?>" maxlength="50" onkeyup="alreadyexist(this.value,'customer_name','customer');" >
                            
                          </div>
                          <div class="col-md-3">
                            <label>Contact Name</label>
                           <input type="text" name="contact_name" placeholder="Enter Contact Name"  id="contact_name" class="form-control" value="<?php echo getcustomer('contact_name',$_REQUEST['banid']);?>" maxlength="50" >
                            
                            
                          </div>
                          <div class="col-md-3">
                            <label>Currency</label>
                           <select class="form-control" name="currency" id="currency">
                            <option value="">Select</option>
                               <option value="ca" <?php if(getcustomer('currency',$_REQUEST['banid'])=='ca') { ?> selected="selected" <?php } ?>>CA</option>
                               <option value="us" <?php if(getcustomer('currency',$_REQUEST['banid'])=='us') { ?> selected="selected" <?php } ?>>US</option>
                           </select>
                            
                            
                          </div>
                        
                         <div class="col-md-3">
                            <label>Address 1<span style="color:#FF0000;"> </span></label>
                           <input type="text" name="customer_address" placeholder="Enter Address"  id="customer_address" class="form-control" value="<?php echo getcustomer('customer_address',$_REQUEST['banid']);?>" maxlength="50">
                            
                            
                          </div>
                          </div>
                          <div class="row">
                             <div class="col-md-3">
                            <label>Address 2</label>
                           <input type="text" name="customer_address1" placeholder="Enter Address"  id="customer_address1" class="form-control" value="<?php echo getcustomer('customer_address1',$_REQUEST['banid']);?>" maxlength="50">
                            
                            
                          </div>
                          <div class="col-md-3">
                            <label>Province / State</label>
                          <select class="form-control" name="province_state" id="province_state">
<option value="ON (Canada)" <?php if(getcustomer('province_state',$_REQUEST['banid'])=='ON (Canada)') { ?> selected="selected" <?php } ?>>ON (Canada)</option>    
       <?php
        $clist = pFETCH("SELECT * FROM states WHERE `status`=?", '1');
        while ($cfetch = $clist->fetch(PDO::FETCH_ASSOC)) {
                            ?>
<option value="<?php echo $cfetch['state']; ?>" <?php if(getcustomer('province_state',$_REQUEST['banid'])==$cfetch['state']) { ?> selected="selected" <?php } ?>><?php echo $cfetch['state']; ?></option>
<?php } ?>
</select>

                          </div>
                           <div class="col-md-3">
                            <label>City</label>
                            <input type="text" class="form-control" name="city" id="city" value="<?php echo getcustomer('city',$_REQUEST['banid']);?>" maxlength="50">
                          </div>
                           <div class="col-md-3">
                            <label>Postal / Zip Code<span style="color:#FF0000;"> </span></label>
                           <input type="text" name="posta_zip_code" placeholder="Enter Postal / Zip Code"  id="posta_zip_code" class="form-control" value="<?php echo getcustomer('posta_zip_code',$_REQUEST['banid']);?>" maxlength="7">
                            
                            
                          </div>
                        </div>
                          <div class="row">
                             
                          <div class="col-md-3">
                            <label>Country</label>
                            <select name="country" id="country" class="form-control">
<option value="CANADA" <?php if(getcustomer('country',$_REQUEST['banid'])=='CANADA') { ?> selected="selected" <?php } ?>>CANADA</option>
<option value="US" <?php if(getcustomer('country',$_REQUEST['banid'])=='US') { ?> selected="selected" <?php } ?>>US</option>
                            </select>
                          </div>
                          <div class="col-md-3">
                            <label>Email Dispatch <span style="color:red;" id="emailerror1"></span></label>
                           <input type="email" name="email_dispatch" placeholder="Enter Email Dispatch"  id="email_dispatch" class="form-control" value="<?php echo getcustomer('email_dispatch',$_REQUEST['banid']);?>" maxlength="50" onkeyup="ValidateEmail(this.value,'emailerror1');">
                            
                            
                          </div>
                          <div class="col-md-3">
                            <label>Email Others <span style="color:red;" id="emailerror2"></span></label>
                           <input type="email" name="email" placeholder="Enter Email Others"  id="email" class="form-control" value="<?php echo getcustomer('email',$_REQUEST['banid']);?>" maxlength="50" onkeyup="ValidateEmail(this.value,'emailerror2');">
                            
                            
                          </div>
                              <div class="col-md-3">
                            <label>Telephone Office<span style="color:#FF0000;"> </span></label>
                           <input type="text" name="telephone_admin" placeholder="Telephone Office"  id="telephone_admin" class="form-control" value="<?php echo getcustomer('telephone_admin',$_REQUEST['banid']);?>" onkeyup="telformat(this.value,'telephone_admin');" maxlength="16">
                            
                            
                          </div>
                         
                         </div>
                          <div class="row">
                            
                          <div class="col-md-3">
                            <label>Telephone Account</label>
                           <input type="text" name="telephone_port" placeholder="Telephone Account"  id="telephone_port" class="form-control" value="<?php echo getcustomer('telephone_port',$_REQUEST['banid']);?>" onkeyup="telformat(this.value,'telephone_port');" maxlength="16">
                            
                            
                          </div>
                          <div class="col-md-3">
                            <label>Web Site</label>
                           <input type="text" name="website" placeholder="Web Site"  id="website" class="form-control" value="<?php echo getcustomer('website',$_REQUEST['banid']);?>" maxlength="50">
                            
                            
                          </div>
                           <div class="col-md-3">
                            <label>Telephone Cell<span style="color:#FF0000;"> </span></label>
                           <input type="text" name="fax1" placeholder="Enter Telephone Cell"  id="fax1" class="form-control" value="<?php echo getcustomer('fax1',$_REQUEST['banid']);?>" onkeyup="telformat(this.value,'fax1');" maxlength="16">
                            
                            
                          </div>
                          <div class="col-md-3">
                            <label>Fax </label>
                           <input type="text" name="fax2" placeholder="Enter Fax"  id="fax2" class="form-control" value="<?php echo getcustomer('fax2',$_REQUEST['banid']);?>" onkeyup="telformat(this.value,'fax2');" maxlength="16">
                            
                            
                          </div>
                          </div>
                          

                         <div class="row">
                            
                         
                          <div class="col-md-3">
                            <label>Terms</label>
                            <input type="text" class="form-control" name="terms"  id="terms" value="<?php echo getcustomer('terms',$_REQUEST['banid']);?>" maxlength="50">
                          </div>
                          <div class="col-md-3">
                            <label>Surity</label>
                            <input type="text" class="form-control" name="surity"  id="surity" value="<?php echo getcustomer('surity',$_REQUEST['banid']);?>" maxlength="50">
                          </div>
                              <div class="col-md-3">
                            <label>Credit Limit</label>
                            <input type="number" class="form-control" name="credit_limit" id="credit_limit" value="<?php echo getcustomer('credit_limit',$_REQUEST['banid']);?>" maxlength="50">
                          </div>
                             <div class="col-md-3">
                            <label>Status</label>
                           <select class="form-control" name="status" id="status1">
                               <option value="1" <?php if(getcustomer('status',$_REQUEST['banid'])=='1') { ?> selected="selected" <?php } ?>>ACTIVE</option>
                               <option value="2" <?php if(getcustomer('status',$_REQUEST['banid'])=='2') { ?> selected="selected" <?php } ?>>IN-ACTIVE</option>
                               <option value="3" <?php if(getcustomer('status',$_REQUEST['banid'])=='3') { ?> selected="selected" <?php } ?>>OFF DUTY</option>
                               <option value="4" <?php if(getcustomer('status',$_REQUEST['banid'])=='4') { ?> selected="selected" <?php } ?>>TERMINATED</option>
                               <option value="5" <?php if(getcustomer('status',$_REQUEST['banid'])=='5') { ?> selected="selected" <?php } ?>>VACATION</option>
                           </select>
                       </div>
                            
                      </div>
							     
                        <div class="row">
 <div class="col-md-3">
                            <label>Remark</label>
                            <input type="text" class="form-control" name="remark"  id="remark" value="<?php echo getcustomer('remark',$_REQUEST['banid']);?>" maxlength="50">
                          </div>
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
              
              <div class="col-md-2" align="left">
                   <br>
                  <button type="button" name="submit" id="submit" class="btn btn-success reset" style="float:left;">CLEAR</button>
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
                            <a href="<?php echo $sitename; ?>master/customers.htm">Back to Listings page</a>
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
<script type="text/javascript">

 function ValidateEmail(a,b) {
        var email = a;
        
        var lblError = document.getElementById(b);
        var expr = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
        if (!expr.test(email)) {
            lblError.innerHTML = "Invalid email address.";
        }
        else
        {
           lblError.innerHTML = ""; 
        }
    }

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
 

    function delrec(elem, id) {
        if (confirm("Are you sure want to delete this Details?")) {
            $(elem).parent().remove();
            window.location.href = "<?php echo $sitename; ?>master/<?php echo $_REQUEST['pid']; ?>/editproduct.htm?delid=" + id;
        }
    }

    function delrec1(elem, id) {
        if (confirm("Are you sure want to delete this Details?")) {
            $(elem).parent().remove();
            window.location.href = "<?php echo $sitename; ?>master/<?php echo $_REQUEST['banid']; ?>/editcustomer.htm?delid1=" + id;
        }
    }


    $(document).ready(function (e) {

        $('#add_task').click(function () {


            var data = $('#firsttasktr').clone();
            var rem_td = $('<td />').html('<i class="fa fa-trash fa-2x" style="color:#F00;cursor:pointer;"></i>').click(function () {
                if (confirm("Do you want to delete the Details?")) {
                    $(this).parent().remove();
                    re_assing_serial();

                }
            });
            $(data).attr('id', '').show().append(rem_td);
            $(data).find('td').each(function (e) {
                $(this).find('input[name="appname[]"]').val('');
                $(this).find('input[name="appmobile[]"]').val('');
                $(this).find('textarea[name="appaddress[]"]').val('');
            });
            data = $(data);
            $('#task_table tbody').append(data);
             var tbl = $('#task_table tbody');
              tbl.find('tr').each(function () {
        $(this).find('input[type=text]').bind("keyup", function () {
            calculateSum();
        });
            
 });
            re_assing_serial();

        });

     $('#add_task1').click(function () {


            var data = $('#firsttasktr1').clone();
            var rem_td = $('<td />').html('<i class="fa fa-trash fa-2x" style="color:#F00;cursor:pointer;"></i>').click(function () {
                if (confirm("Do you want to delete the Details?")) {
                    $(this).parent().remove();
                    re_assing_serial1();

                }
            });
            $(data).attr('id', '').show().append(rem_td);
            $(data).find('td').each(function (e) {
                 $(this).find('input[name="appname[]"]').val('');
                $(this).find('input[name="appmobile[]"]').val('');
                $(this).find('textarea[name="appaddress[]"]').val('');
            });
            data = $(data);
            $('#task_table1 tbody').append(data);
             var tbl = $('#task_table1 tbody');
              tbl.find('tr').each(function () {
        $(this).find('input[type=text]').bind("keyup", function () {
            calculateSum();
        });
            
 });
            re_assing_serial1();

        });


    });

 
    function del_addi(elem) {
        if (confirm("Are you sure want to remove this?")) {
            elem.parent().parent().remove();
            additionalprice();
        }
    }

 function del_addi1(elem) {
        if (confirm("Are you sure want to remove this?")) {
            elem.parent().parent().remove();
            additionalprice();
        }
    }
	
    function re_assing_serial() {
        $("#task_table tbody tr").not('#firsttasktr').each(function (i, e) {
            //$(this).find('td').eq(0).html(i + 1+1);
        });
        $("#worker_table tbody tr").not('#firstworkertr').each(function (i, e) {
            $(this).find('td').eq(0).html(i + 1);
        });
    }

 function re_assing_serial1() {
        $("#task_table1 tbody tr").not('#firsttasktr1').each(function (i, e) {
            //$(this).find('td').eq(0).html(i + 1+1);
        });
        $("#worker_table1 tbody tr").not('#firstworkertr1').each(function (i, e) {
            $(this).find('td').eq(0).html(i + 1);
        });
    }
	function getins(a){
		if(a==1)
		{
		$("#ins1").css("display", "block");
		$("#ins_expiry_date").prop('required',true);
	
$("#insurance_name").prop('required',false);
$("#insurance_amount").prop('required',false);
$("#ins2").css("display", "none");
$("#ins3").css("display", "none");	
		}
		else{
			$("#ins2").css("display", "block");
			$("#ins3").css("display", "block");
			$("#insurance_name").attr("required", "true");
$("#insurance_amount").prop('required',true);
$("#ins_expiry_date").prop('required',false);
$("#ins1").css("display", "none");	
		}
	}

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

function alreadyexist($fieldvalue,$fieldname,$table)
{
var successCount = 0;
       $.ajax({
         cache: true,
         url: "<?php echo $sitename; ?>pages/master/alreadyexist.php?fieldvalue="+$fieldvalue+"&fieldname="+$fieldname+"&table="+$table,
         success: 
           function(data)
           {
               if(data!='')
               {
              $('#alresult').html(data); 
         
              }
              else
              {
               $('#alresult').html('');    
              }
         },
         complete: function() 
         {
           
          // setInterval(sendRequest, 30000); 
         }
     });
}
function getcusdetails1(a){
var successCount = 0;
       $.ajax({
         cache: true,
         url: "<?php echo $sitename; ?>pages/master/cusdetails.php?customer="+a,
         success: 
           function(data)
           {
               if(data!='' && data!='0')
               {
            const myArray = data.split("#");
           $('#customer_name').val(myArray[0]); 
          $('#contact_name').val(myArray[1]); 
          $('#currency option[value="'+myArray[2]+'"]').attr("selected", "selected");
          $('#customer_address').val(myArray[3]); 
          $('#customer_address1').val(myArray[4]); 
          $('#email_dispatch').val(myArray[5]); 
          $('#posta_zip_code').val(myArray[6]); 
           $('#country option[value="'+myArray[7]+'"]').attr("selected", "selected");
          $('#email').val(myArray[8]); 
          $('#telephone_admin').val(myArray[9]); 
          $('#telephone_port').val(myArray[10]); 
 $('#website').val(myArray[11]); 
  $('#fax1').val(myArray[12]); 
   $('#fax2').val(myArray[13]); 
    $('#status option[value="'+myArray[14]+'"]').attr("selected", "selected");
     $('#province_state option[value="'+myArray[15]+'"]').attr("selected", "selected");
$('#city').val(myArray[16]); 
$('#terms').val(myArray[17]); 
$('#surity').val(myArray[18]); 
$('#credit_limit').val(myArray[19]); 

$('#getid').val(myArray[20]); 
$('#remark').val(myArray[21]); 
         }
               else{
           $('#customer_name').val(''); 
          $('#contact_name').val(''); 
          $('#currency option[value=""]').attr("selected", "selected");
          $('#customer_address').val(''); 
          $('#customer_address1').val(''); 
          $('#email_dispatch').val(''); 
          $('#posta_zip_code').val(''); 
          $('#country').val(''); 
          $('#email').val(''); 
          $('#telephone_admin').val(''); 
          $('#telephone_port').val(''); 
 $('#website').val(''); 
  $('#fax1').val(''); 
   $('#fax2').val(''); 
    $('#status option[value=""]').attr("selected", "selected");
     $('#province_state option[value=""]').attr("selected", "selected");
$('#city').val(''); 
$('#terms').val(''); 
$('#surity').val(''); 
$('#credit_limit').val(''); 

$('#getid').val('');
$('#remark').val('');
               }
         },
         complete: function() 
         {
           
          // setInterval(sendRequest, 30000); 
         }
     });
}

function getcusdetails(a)
   {
     var successCount = 0;
       $.ajax({
         cache: true,
         url: "<?php echo $sitename; ?>pages/master/cusdetails.php?cusid="+a,
         success: 
           function(data)
           {
               if(data!='' && data!='0')
               {
            const myArray = data.split("#");
           $('#customer_name').val(myArray[0]); 
          $('#contact_name').val(myArray[1]); 
          $('#currency option[value="'+myArray[2]+'"]').attr("selected", "selected");
          $('#customer_address').val(myArray[3]); 
          $('#customer_address1').val(myArray[4]); 
          $('#email_dispatch').val(myArray[5]); 
          $('#posta_zip_code').val(myArray[6]); 
           $('#country option[value="'+myArray[7]+'"]').attr("selected", "selected");
          $('#email').val(myArray[8]); 
          $('#telephone_admin').val(myArray[9]); 
          $('#telephone_port').val(myArray[10]); 
 $('#website').val(myArray[11]); 
  $('#fax1').val(myArray[12]); 
   $('#fax2').val(myArray[13]); 
    $('#status option[value="'+myArray[14]+'"]').attr("selected", "selected");
     $('#province_state option[value="'+myArray[15]+'"]').attr("selected", "selected");
$('#city').val(myArray[16]); 
$('#terms').val(myArray[17]); 
$('#surity').val(myArray[18]); 
$('#credit_limit').val(myArray[19]); 

$('#getid').val(myArray[20]); 
$('#remark').val(myArray[21]); 
         }
               else{
           $('#customer_name').val(''); 
          $('#contact_name').val(''); 
          $('#currency option[value=""]').attr("selected", "selected");
          $('#customer_address').val(''); 
          $('#customer_address1').val(''); 
          $('#email_dispatch').val(''); 
          $('#posta_zip_code').val(''); 
          $('#country').val(''); 
          $('#email').val(''); 
          $('#telephone_admin').val(''); 
          $('#telephone_port').val(''); 
 $('#website').val(''); 
  $('#fax1').val(''); 
   $('#fax2').val(''); 
    $('#status option[value=""]').attr("selected", "selected");
     $('#province_state option[value=""]').attr("selected", "selected");
$('#city').val(''); 
$('#terms').val(''); 
$('#surity').val(''); 
$('#credit_limit').val(''); 
$('#getid').val('');
$('#remark').val('');
        }
         },
         complete: function() 
         {
           
          // setInterval(sendRequest, 30000); 
         }
     });
   }

 $(".reset").click(function() {
    $(this).closest('form').find("input[type=text], input[type=email],input[type=number],input[type=date]").val("");
    $('#province_state').prop('selectedIndex',0);
});


</script>
