<?php
$menu = "4";
$thispageid = 17;
$franchisee = 'yes';
include ('../../config/config.inc.php');
include ('../../require/header.php');
// error_reporting(1);
// ini_set('display_errors','1');
// error_reporting(E_ALL);

if (isset($_REQUEST['submit'])) {
    @extract($_REQUEST);
    $getid = $_REQUEST['banid'];
    $ip = $_SERVER['REMOTE_ADDR'];
   
if($_REQUEST['getid']!=''){
$getid=$_REQUEST['getid'];
}

    $msg = addexpense($expense_code,$expense_name,$getid);
}


?>
<script type="text/javascript">

 
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
                        <a href="<?php echo $sitename; ?>master/expense.htm"><button type="button" class="btn btn-default">Back to Listings Page</button>
                        </a>

                    </div>

                    <h4 class="page-title"><?php
                        if (isset($_REQUEST['banid'])) {
                            echo "Edit";
                        } else {
                            echo "Add";
                        }
                        ?> Expense</h4>
                    <ol class="breadcrumb" style="margin-bottom: 0px;">
                      
                        <li class="breadcrumb-item"><a href="salesman.htm"> Expense</a></li>
                        <li class="breadcrumb-item active"><?php
                            if (isset($_REQUEST['banid'])) {
                                echo "Edit";
                            } else {
                                echo "Add";
                            }
                            ?> Expense</li>
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
                            <label>Expense Code</label>
                           <input type="text" name="expense_code" placeholder="Enter Expense Code"  id="contact_name" class="form-control" value="<?php echo getexpense('expense_code',$_REQUEST['banid']);?>" maxlength="50" >
                            
                            
                          </div>
                              <div class="col-md-3">
                            <label>Expense Name&nbsp;<span style="color:#FF0000;"> </span></label>
                          
                              <input type="text" name="expense_name" placeholder="Enter Expense Name"  class="form-control" value="<?php echo getexpense('expense_name',$_REQUEST['banid']);?>" maxlength="50" >
                            
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
              
              <div class="col-md-2" align="left">
                   <br>
                  <button type="button" name="submit" id="submit" class="btn btn-success reset" style="float:left;">CLEAR</button>
              </div>
                        </div>	
						
                            <!-- <div class="row">
							<div class="col-md-6">
                            <label>Proof Details</label>
<textarea name="proof_details" class="form-control" required="required"><?php echo getsalesman('proof_details', $_REQUEST['banid']); ?></textarea>                          
				 </div>
							<div class="col-md-6">
                            <label>Address<span style="color:#FF0000;"> </span></label>
<textarea name="address" class="form-control" required="required"><?php echo getsalesman('address', $_REQUEST['banid']); ?></textarea>                          
				 </div>
				 </div> -->
				 
				 <!-- <div class="row">
						  <div class="col-md-6">
                            <label>Status</label>
                          
                          <select name="status" class="form-control">
                         <option value="1" <?php if(getsalesman('status', $_REQUEST['banid'])=='1') { ?> selected="selected" <?php } ?>>Active</option>      
                         <option value="0" <?php if(getsalesman('status', $_REQUEST['banid'])=='0') { ?> selected="selected" <?php } ?>>Inactive</option>      
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
							<option value="1" <?php if(getsalesman('having_insurance',$_REQUEST['banid'])=='1') { ?> selected="selected" <?php } ?>>Yes</option>
							<option value="0" <?php if(getsalesman('having_insurance',$_REQUEST['banid'])=='0') { ?> selected="selected" <?php } ?>>No</option>
							</select>
						    </div>
							
							<div class="col-md-6"  <?php if(getsalesman('having_insurance',$_REQUEST['banid'])=='1') { ?> style="display:block;"<?php } else { ?>style="display:none;"<?php } ?> id="ins1">
                            <label>Insurance Expiry Date <span style="color:#FF0000;"> </span></label>
                           <input type="date"  name="ins_expiry_date" placeholder="Select Expiry Date" value="<?php echo getsalesman('ins_expiry_date',$_REQUEST['banid']);?>" id="ins_expiry_date" class="form-control">
                           </div>
														</div>
													<br>	
										<div class="row" >
										<div class="col-md-6" <?php if(getsalesman('having_insurance',$_REQUEST['banid'])=='0') { ?> style="display:block;"<?php } else { ?>style="display:none;"<?php } ?> id="ins2">
                            <label>Name of the Insurance<span style="color:#FF0000;"> </span></label>
                           <input type="text" name="insurance_name" placeholder="Enter Insurance Name" value="<?php echo getsalesman('insurance_name',$_REQUEST['banid']);?>" id="insurance_name" class="form-control">
                           </div>
									<div class="col-md-6" <?php if(getsalesman('having_insurance',$_REQUEST['banid'])=='0') { ?> style="display:block;"<?php } else { ?>style="display:none;"<?php } ?> id="ins3">
                            <label>Insurance Amount<span style="color:#FF0000;"> </span></label>
                           <input type="text" name="insurance_amount" placeholder="Enter Insurance Amount" value="<?php echo getsalesman('insurance_amount',$_REQUEST['banid']);?>" id="insurance_amount" class="form-control">
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
                            <a href="<?php echo $sitename; ?>master/salesman.htm">Back to Listings page</a>
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
  
 $(".reset").click(function() {
    $(this).closest('form').find("input[type=text], input[type=email],input[type=number],input[type=date]").val("");
    $('#province_state').prop('selectedIndex',0);
});


</script>
