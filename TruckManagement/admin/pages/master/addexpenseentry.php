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

    $msg = addexpenseentry($currency,$voucher_no,$voucher_date,$expense,$expense_desc,$payment_type,$payment_date,$payment_amount,$getid);
}


?>
<?php

$link22 = FETCH_all("SELECT * FROM `expenseentry` WHERE id!=? ORDER BY `id` DESC", 0);
   if($link22['voucher_no']!=''){
    $expno=explode('WT000',$link22['voucher_no']);
               $voucherno="WT000".($expno['1']+1);
           }
           else{
             $voucherno='WT0000';
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
                        <a href="<?php echo $sitename; ?>master/expenseentry.htm"><button type="button" class="btn btn-default">Back to Listings Page</button>
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
                      
                        <li class="breadcrumb-item"><a href="#"> Expense Entry</a></li>
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
                            <label>Voucher No</label>
                           <input type="text" name="voucher_no" placeholder="Enter Voucher No"  id="voucher_no" class="form-control" value="<?php if(getexpenseentry('voucher_no',$_REQUEST['banid'])!='') { echo getexpenseentry('voucher_no',$_REQUEST['banid']); } else { echo $voucherno; } ?>" maxlength="50" >
                            
                            
                          </div>
                           <div class="col-md-3">
                            <label>Voucher Date</label>
                           <input type="date" name="voucher_date" placeholder="Enter Voucher No" class="form-control" value="<?php echo getexpenseentry('voucher_date',$_REQUEST['banid']); ?>" maxlength="50" >
                            
                            
                          </div>
                              <div class="col-md-3">
                            <label>Expense &nbsp;<span style="color:#FF0000;"> </span></label>
                          <select name="expense" class="form-control">
                            <option value="">Select</option>
                            <?php
 $sel = pFETCH("SELECT * FROM `expense` WHERE `id`!=?", 0);
 while ($fdepart = $sel->fetch(PDO::FETCH_ASSOC)) {                             
?>
<option value="<?php echo $fdepart['id']; ?>" <?php if(getexpenseentry('expense',$_REQUEST['banid'])==$fdepart['id']) { ?> selected <?php } ?>><?php echo $fdepart['expense_name']; ?></option>
<?php } ?>
                            </select>
                          </div>
 
                             <div class="col-md-3">
                            <label>Expense Description</label>
                           <input type="text" name="expense_desc" placeholder="Enter Expense Description" class="form-control" value="<?php echo getexpenseentry('expense_desc',$_REQUEST['banid']); ?>" maxlength="150" >
                            
                            
                          </div>
                          </div>
<div class="row">
 <div class="col-md-3">
                            <label>Payment Type</label>
                           <select name="payment_type" class="form-control">
                                              <option value="">Select</option>  
                                                  <option value="Cash" <?php if(getexpenseentry('payment_type',$_REQUEST['banid'])=='Cash') { ?> selected="selected" <?php } ?>>Cash</option>
                                                  <option value="Visa" <?php if(getexpenseentry('payment_type',$_REQUEST['banid'])=='Visa') { ?> selected="selected" <?php } ?>>Visa</option>
                                                  <option value="Master" <?php if(getexpenseentry('payment_type',$_REQUEST['banid'])=='Master') { ?> selected="selected" <?php } ?>>Master</option>
                                                  <option value="AMEX" <?php if(getexpenseentry('payment_type',$_REQUEST['banid'])=='AMEX') { ?> selected="selected" <?php } ?>>AMEX</option>
                                                  <option value="Debit" <?php if(getexpenseentry('payment_type',$_REQUEST['banid'])=='Debit') { ?> selected="selected" <?php } ?>>Debit</option>
                                                  <option value="Cheque" <?php if(getexpenseentry('payment_type',$_REQUEST['banid'])=='Cheque') { ?> selected="selected" <?php } ?>>Cheque</option>
                                                  <option value="Direct" <?php if(getexpenseentry('payment_type',$_REQUEST['banid'])=='Direct') { ?> selected="selected" <?php } ?>>Direct</option>
                                                  <option value="E-Transfer" <?php if(getexpenseentry('payment_type',$_REQUEST['banid'])=='E-Transfer') { ?> selected="selected" <?php } ?>>E-Transfer</option>
                                              </select>
                            
                            
                          </div>
                           <div class="col-md-3">
                            <label>Payment Date</label>
                             <input type="date" name="payment_date"  id="payment_date" class="form-control" value="<?php echo getexpenseentry('payment_date',$_REQUEST['banid']);?>">
                          
                          </div>
                           <div class="col-md-3">
                            <label>Currency</label>
                            <select name="currency" class="form-control">
                                 <option value="CAD" <?php if(getexpenseentry('currency',$_REQUEST['banid'])=='CAD') { ?> selected="selected" <?php } ?>>CAD</option>

                                <option value="USD" <?php if(getexpenseentry('currency',$_REQUEST['banid'])=='USD') { ?> selected="selected" <?php } ?>>USD</option>
                               
                            </select>
                            
                          </div>
                           <div class="col-md-3">
                            <label>Payment Amount</label>
                             <input type="text" name="payment_amount"  id="payment_amount" class="form-control" value="<?php echo getexpenseentry('payment_amount',$_REQUEST['banid']);?>">
                          
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
                            <a href="<?php echo $sitename; ?>master/expenseentry.htm">Back to Listings page</a>
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
