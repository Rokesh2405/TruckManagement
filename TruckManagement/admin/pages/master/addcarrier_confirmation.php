<?php
$menu = "4";
$thispageid = 17;
$franchisee = 'yes';
include ('../../config/config.inc.php');
include ('../../require/header.php');
// error_reporting(1);
// ini_set('display_errors','1');
// error_reporting(E_ALL);

if (isset($_REQUEST['sendmail'])) {
@extract($_REQUEST);
$getid = $_REQUEST['banid'];
 //Send Mail

$carrierconfirm = FETCH_all("SELECT * FROM `carrier_confirmation` WHERE id=? ", $getid);

 $carrier=$carrierconfirm['carrier'];

$insert_id=$getid;

$carrierinfo = FETCH_all("SELECT * FROM `carrier` WHERE customer_name=? ", $carrier);

$to=$carrierinfo['email_dispatch'];//
$from="info@worktogethergroup.ca";//config pana email



$message='<p>Hi<br><br>Your recent carrier confirmation invoice  <br><br>
* <a href="'.$sitename.'MPDF/carrier_report.php?id='.$insert_id.'&type="download">Click the link to download the invoice</a>
</p>';


///////form2//

$subject =$carrier." (".$carrierconfirm['load_no'].")"." - Carrier Confirmation Invoice";
$resmail = sendgridApiMail($to, $message, $subject, $from, '');

        if ($resmail->statusCode() == '202') 
        {
}

//Send Mail

    $msg = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Mail Sent Successfully!</h4></div>';
}


if (isset($_REQUEST['submit'])) {
@extract($_REQUEST);
$getid = $_REQUEST['banid'];
$ip = $_SERVER['REMOTE_ADDR'];
   
if($_REQUEST['getid']!=''){
$getid=$_REQUEST['getid'];
}

$msg = addcarrierconfirmation($invoice_received_date,$charging_amount,$status,$note2,$note,$bill_currency,$payment_currency,$bill_amount,$salesman_payment_type,$salesman_payment_date,$salesman_cheque_no,$salesman_cheque_date,$book_date,$book_time,$delivery_qty,$delivery_description,$delivery_weight,$salesman,$salesman_commission,$payment_type,$payment_date,$cheque_no,$cheque_date,$payment_amount,$load_no,$booked_by,$carrier,$contact,$pickup_date,$pickup_time,$pickup_address,$pickup_no,$pickup_contact,$delivery_date,$delivery_time,$delivery_address,$delivery_to,$delivery_contact,$qty,$description,$weight,$payment,$getid);
}

$link22 = FETCH_all("SELECT * FROM `carrier_confirmation` WHERE id!=? ORDER BY `id` DESC", 0);
   if($link22['load_no']!=''){
    $expno=explode('WT000',$link22['load_no']);
               $loadno="WT000".($expno['1']+1);
           }
           else{
             $loadno='WT0000';
           } 


?>
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

                        <a href="<?php echo $sitename; ?>master/carrier_confirmation.htm"><button type="button" class="btn btn-default">Back to Listings Page</button>
                        </a>
                        &nbsp;&nbsp;
                        <?php  if (isset($_REQUEST['banid'])) { ?>
                            <form name="mailform" method="post">
                            <button type="submit" name="sendmail" class="btn btn-default">Send Mail</button>
                                            &nbsp;&nbsp;
                            </form>
                         <a href="<?php echo $sitename; ?>MPDF/carrier_report.php?id=<?php echo $_REQUEST['banid']; ?>" target="_blank"><button type="button" class="btn btn-default">Confirmation Print</button>
                        </a> 
                    <?php } ?>
                    </div>

                    <h4 class="page-title"><?php
                        if (isset($_REQUEST['banid'])) {
                            echo "Edit";
                        } else {
                            echo "Add";
                        }
                        ?> Load Board</h4>
                    <ol class="breadcrumb" style="margin-bottom: 0px;">
                      
                        <li class="breadcrumb-item"><a href="carrier_confirmation.htm"> Load Board</a></li>
                        <li class="breadcrumb-item active"><?php
                            if (isset($_REQUEST['banid'])) {
                                echo "Edit";
                            } else {
                                echo "Add";
                            }
                            ?> Load Board</li>
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
                            <label>Book Date</label>
                           <input type="date" name="book_date" placeholder="Enter Load Number"  id="book_date" class="form-control" value="<?php echo getcarrierconfirmation('book_date',$_REQUEST['banid']);?>" maxlength="50" >
                            
                            </div>
                             <div class="col-md-3">
                            <label>Book Time</label>
                           <input type="time" name="book_time" placeholder="Enter Load Number"  id="book_time" class="form-control" value="<?php echo getcarrierconfirmation('book_time',$_REQUEST['banid']);?>" maxlength="50" >
                            
                            </div>
                             <div class="col-md-3">
                            <label>Load No</label>
                           <input type="text" readonly="readonly" name="load_no" placeholder="Enter Load Number"  id="contact_name" class="form-control" value="<?php if(getcarrierconfirmation('load_no',$_REQUEST['banid'])!='') { echo getcarrierconfirmation('load_no',$_REQUEST['banid']); } else { echo $loadno; } ?>" maxlength="50" >
                            
                            
                          </div>
                              <div class="col-md-3">
                            <label>Booked By <span style="color:#FF0000;"> </span></label>
                          
                              <input type="text" name="booked_by" placeholder="Enter Booked By"  id="booked_by" class="form-control" value="<?php echo getcarrierconfirmation('booked_by',$_REQUEST['banid']);?>" maxlength="50" >
                            
                          </div>
                         </div>
                         <div class="row">
                          <div class="col-md-3">
                            <label>Carrier<span style="color:#FF0000;"> </span></label>
                           <input type="text" name="carrier" placeholder="Enter Carrier"  id="carrier" class="form-control" value="<?php echo getcarrierconfirmation('carrier',$_REQUEST['banid']);?>" maxlength="50">
                            
                            
                          </div>
                    <div class="col-md-3">
                            <label>Customer</label>
                           <input type="text" name="contact" placeholder="Enter Customer"  id="contact" class="form-control" value="<?php echo getcarrierconfirmation('contact',$_REQUEST['banid']);?>" >
                            
                            
                          </div>
                         
                            <div class="col-md-3">
                            <label>Pickup Date</label>
                            <input type="date" class="form-control" name="pickup_date" value="<?php echo getcarrierconfirmation('pickup_date',$_REQUEST['banid']);?>" maxlength="50">
                          </div>
                      

                           <div class="col-md-3">
                            <label>Pickup Time<span style="color:#FF0000;"> </span></label>
                           <input type="time" name="pickup_time" placeholder="Enter Pickup Time"  id="pickup_time" class="form-control" value="<?php echo getcarrierconfirmation('pickup_time',$_REQUEST['banid']);?>" maxlength="7"></div>

                          </div>
                          <div class="row">
                         <div class="col-md-3">
                            <label>Pickup No</label>
                           <input type="text" name="pickup_no" placeholder="Pickup No"  id="pickup_no" class="form-control" value="<?php echo getcarrierconfirmation('pickup_no',$_REQUEST['banid']);?>" maxlength="16">
                            
                            
                          </div>
 <div class="col-md-3">
                            <label>Pickup</label>
                           <input type="text" name="pickup_contact" placeholder="Pickup"  id="pickup_contact" class="form-control" value="<?php echo getcarrierconfirmation('pickup_contact',$_REQUEST['banid']);?>"><a href="<?php echo $sitename; ?>master/addpickup.htm" target="_blank"><span class="fa fa-plus plusspan"></span></a>
                          </div>
                      
                            <div class="col-md-3">
                            <label>Delivery Date</label>
                            <input type="date" class="form-control" name="delivery_date" value="<?php echo getcarrierconfirmation('delivery_date',$_REQUEST['banid']);?>" maxlength="50">
                          </div>
                      

                           <div class="col-md-3">
                            <label>Delivery Time<span style="color:#FF0000;"> </span></label>
                           <input type="time" name="delivery_time" placeholder="Enter Delivery Time"  id="delivery_time" class="form-control" value="<?php echo getcarrierconfirmation('delivery_time',$_REQUEST['banid']);?>" maxlength="7"></div>

                          </div>
                          <div class="row">

                         <div class="col-md-3">
                            <label>Delivery No</label>
                           <input type="text" name="delivery_to" placeholder="Delivery No"  id="delivery_to" class="form-control" value="<?php echo getcarrierconfirmation('delivery_to',$_REQUEST['banid']);?>" maxlength="16">
                            
                            
                          </div>
 <div class="col-md-3">
                            <label>Delivery</label>
                           <input type="text" name="delivery_contact" placeholder="Delivery"  id="delivery_contact" class="form-control" value="<?php echo getcarrierconfirmation('delivery_contact',$_REQUEST['banid']);?>">
                            
                             <a href="<?php echo $sitename; ?>master/addpickup.htm"  target="_blank"><span class="fa fa-plus plusspan"></span></a>
                          </div>

                      
                          
                           <div class="col-md-3">
                            <label>Pickup Qty<span style="color:#FF0000;"> </span></label>
                           <input type="text" name="qty" placeholder="Enter Quantity"  id="qty" class="form-control" value="<?php echo getcarrierconfirmation('qty',$_REQUEST['banid']);?>" maxlength="7"></div>
                         <div class="col-md-3">
                            <label>Pickup Description</label>
                           <input type="text" name="description" placeholder="Description"  id="description" class="form-control" value="<?php echo getcarrierconfirmation('description',$_REQUEST['banid']);?>" >
                            
                            
                          </div>

                          </div>
                          <div class="row">
 <div class="col-md-3">
                            <label>Pickup Weight</label>
                           <input type="text" name="weight" placeholder="Weight"  id="weight" class="form-control" value="<?php echo getcarrierconfirmation('weight',$_REQUEST['banid']);?>">
                            
                            
                          </div>
 <div class="col-md-3">
                            <label>Delivery Qty<span style="color:#FF0000;"> </span></label>
                           <input type="text" name="delivery_qty" placeholder="Enter Quantity"  id="delivery_qty" class="form-control" value="<?php echo getcarrierconfirmation('delivery_qty',$_REQUEST['banid']);?>" maxlength="7"></div>
                         <div class="col-md-3">
                            <label>Delivery Description</label>
                           <input type="text" name="delivery_description" placeholder="Description"  id="delivery_description" class="form-control" value="<?php echo getcarrierconfirmation('delivery_description',$_REQUEST['banid']);?>" >
                            
                            </div>
                            <div class="col-md-3">
                            <label>Delivery Weight</label>
                           <input type="text" name="delivery_weight" placeholder="Delivery Weight"  id="delivery_weight" class="form-control" value="<?php echo getcarrierconfirmation('delivery_weight',$_REQUEST['banid']);?>">
                            
                            
                          </div>
                           </div>
                          <div class="row">
                             <div class="col-md-3">
                            <label>Bill Currency</label>
                            <select name="bill_currency" class="form-control">
                                <option value="CAD" <?php if(getcarrierconfirmation('bill_currency',$_REQUEST['banid'])=='CAD') { ?> selected="selected" <?php } ?>>CAD</option>
                                <option value="USD" <?php if(getcarrierconfirmation('bill_currency',$_REQUEST['banid'])=='USD') { ?> selected="selected" <?php } ?>>USD</option>
                                

                            </select>
                            
                          </div>

                               <div class="col-md-3">
                            <label>Bill Amount</label>
                             <input type="text" name="bill_amount"  id="bill_amount" class="form-control" value="<?php echo getcarrierconfirmation('bill_amount',$_REQUEST['banid']);?>">
                          
                          </div>  
 <div class="col-md-3">
                            <label>Payment Currency</label>
                            <select name="payment_currency" class="form-control">
                                 <option value="CAD" <?php if(getcarrierconfirmation('payment_currency',$_REQUEST['banid'])=='CAD') { ?> selected="selected" <?php } ?>>CAD</option>
                                 <option value="USD" <?php if(getcarrierconfirmation('payment_currency',$_REQUEST['banid'])=='USD') { ?> selected="selected" <?php } ?>>USD</option>
                               
                              
                            </select>
                            
                          </div>
 <div class="col-md-3">
                            <label>Payment</label>
                           <input type="text" name="payment" placeholder="Payment"  id="payment" class="form-control" value="<?php echo getcarrierconfirmation('payment',$_REQUEST['banid']);?>">
                            
                            
                          </div>
</div>
                          <div class="row">
                            
                              <div class="col-md-3">
                            <label>Pickup Address</label>
                              <input type="text"  readonly="readonly" name="pickup_address" placeholder="Pickup Address"  id="pickup_address" class="form-control" value="<?php echo getcarrierconfirmation('pickup_address',$_REQUEST['banid']);?>">
                              
                           </div>
                            <div class="col-md-3">
                            <label>Delivery Address</label>
                             <input type="text" readonly="readonly" name="delivery_address" placeholder="Delivery Address"  id="delivery_address" class="form-control" value="<?php echo getcarrierconfirmation('delivery_address',$_REQUEST['banid']);?>">
                           
                          </div>

<div class="col-md-3">
                            <label>Payment Type</label>
                              <select name="payment_type" class="form-control">
                                              <option value="">Select</option>  
                                                  <option value="Cash" <?php if(getcarrierconfirmation('payment_type',$_REQUEST['banid'])=='Cash') { ?> selected="selected" <?php } ?>>Cash</option>
                                                  <option value="Visa" <?php if(getcarrierconfirmation('payment_type',$_REQUEST['banid'])=='Visa') { ?> selected="selected" <?php } ?>>Visa</option>
                                                  <option value="Master" <?php if(getcarrierconfirmation('payment_type',$_REQUEST['banid'])=='Master') { ?> selected="selected" <?php } ?>>Master</option>
                                                  <option value="AMEX" <?php if(getcarrierconfirmation('payment_type',$_REQUEST['banid'])=='AMEX') { ?> selected="selected" <?php } ?>>AMEX</option>
                                                  <option value="Debit" <?php if(getcarrierconfirmation('payment_type',$_REQUEST['banid'])=='Debit') { ?> selected="selected" <?php } ?>>Debit</option>
                                                  <option value="Cheque" <?php if(getcarrierconfirmation('payment_type',$_REQUEST['banid'])=='Cheque') { ?> selected="selected" <?php } ?>>Cheque</option>
                                                  <option value="Direct" <?php if(getcarrierconfirmation('payment_type',$_REQUEST['banid'])=='Direct') { ?> selected="selected" <?php } ?>>Direct</option>
                                                  <option value="E-Transfer" <?php if(getcarrierconfirmation('payment_type',$_REQUEST['banid'])=='E-Transfer') { ?> selected="selected" <?php } ?>>E-Transfer</option>
                                              </select>
                          </div>
                            <div class="col-md-3">
                            <label>Payment Date</label>
                             <input type="date" name="payment_date"  id="payment_date" class="form-control" value="<?php echo getcarrierconfirmation('payment_date',$_REQUEST['banid']);?>">
                          
                          </div>
                      


                          </div>
                         
                          <!-- <div class="row">
                             <div class="col-md-3">
                            <label>Salesman <span style="color:#FF0000;"> </span></label>
                          
                              <input type="text" name="salesman" placeholder="Enter Salesman"  id="salesman" class="form-control" value="<?php echo getcarrierconfirmation('salesman',$_REQUEST['banid']);?>" maxlength="50" >
                            
                          </div>
                          <div class="col-md-3">
                            <label>Salesman Commission<span style="color:#FF0000;"> </span></label>
                          
                              <input type="text" readonly="readonly" name="salesman_commission" placeholder="Enter Salesman Commission"  id="salesman_commission" class="form-control" value="<?php echo getcarrierconfirmation('salesman_commission',$_REQUEST['banid']);?>" maxlength="50" >
                            
                          </div>
                          <div class="col-md-3">
                            <label>Salesman Payment Type<span style="color:#FF0000;"> </span></label>
                          <select name="salesman_payment_type" class="form-control">
                                              <option value="">Select</option>  
                                                  <option value="Cash" <?php if(getcarrierconfirmation('salesmanpayment_type',$_REQUEST['banid'])=='Cash') { ?> selected="selected" <?php } ?>>Cash</option>
                                                  <option value="Visa" <?php if(getcarrierconfirmation('salesmanpayment_type',$_REQUEST['banid'])=='Visa') { ?> selected="selected" <?php } ?>>Visa</option>
                                                  <option value="Master" <?php if(getcarrierconfirmation('salesmanpayment_type',$_REQUEST['banid'])=='Master') { ?> selected="selected" <?php } ?>>Master</option>
                                                  <option value="AMEX" <?php if(getcarrierconfirmation('salesmanpayment_type',$_REQUEST['banid'])=='AMEX') { ?> selected="selected" <?php } ?>>AMEX</option>
                                                  <option value="Debit" <?php if(getcarrierconfirmation('salesmanpayment_type',$_REQUEST['banid'])=='Debit') { ?> selected="selected" <?php } ?>>Debit</option>
                                                  <option value="Cheque" <?php if(getcarrierconfirmation('salesmanpayment_type',$_REQUEST['banid'])=='Cheque') { ?> selected="selected" <?php } ?>>Cheque</option>
                                                  <option value="Direct" <?php if(getcarrierconfirmation('salesmanpayment_type',$_REQUEST['banid'])=='Direct') { ?> selected="selected" <?php } ?>>Direct</option>
                                                  <option value="E-Transfer" <?php if(getcarrierconfirmation('salesmanpayment_type',$_REQUEST['banid'])=='E-Transfer') { ?> selected="selected" <?php } ?>>E-Transfer</option>
                                              </select>
                          </div>

                       <div class="col-md-3">
                            <label>Salesman Payment Date</label>
                             <input type="date" name="salesman_payment_date"  id="salesman_payment_date" class="form-control" value="<?php echo getcarrierconfirmation('salesman_payment_date',$_REQUEST['banid']);?>">
                          
                          </div> 
                          
                      </div>
                      <div class="row">
                         <div class="col-md-3">
                            <label>Salesman Cheque No</label>
                             <input type="text" name="salesman_cheque_no"  id="salesman_cheque_no" class="form-control" value="<?php echo getcarrierconfirmation('salesman_cheque_no',$_REQUEST['banid']);?>">
                          
                          </div> 
                        <div class="col-md-3">
                            <label>Salesman Cheque Date</label>
                             <input type="date" name="salesman_cheque_date"  id="salesman_cheque_date" class="form-control" value="<?php echo getcarrierconfirmation('salesman_cheque_date',$_REQUEST['banid']);?>">
                          
                          </div>
                          </div>
                           -->
                           <div class="row">

     <div class="col-md-3">
                            <label>Cheque No</label>
                             <input type="text" name="cheque_no"  id="cheque_no" class="form-control" value="<?php echo getcarrierconfirmation('cheque_no',$_REQUEST['banid']);?>">
                          
                          </div>
                          <div class="col-md-3">
                            <label>Cheque Date</label>
                             <input type="date" name="cheque_date"  id="cheque_date" class="form-control" value="<?php echo getcarrierconfirmation('cheque_date',$_REQUEST['banid']);?>">
                          
                          </div>
                          <div class="col-md-3">
                            <label>Invoice Received Date</label>
                             <input type="date" name="invoice_received_date"  id="invoice_received_date" class="form-control" value="<?php echo getcarrierconfirmation('invoice_received_date',$_REQUEST['banid']);?>">
                          
                          </div>
                          <div class="col-md-3">
                            <label>Charging Amount</label>
                             <input type="text" name="charging_amount"  id="charging_amount" class="form-control" value="<?php echo getcarrierconfirmation('charging_amount',$_REQUEST['banid']);?>">
                          
                          </div>
                          
                           </div>
                           <div class="row">
                              <div class="col-md-3">
                            <label>Note 1</label>
                            <textarea name="note" id="note" class="form-control" maxlength="200"><?php echo getcarrierconfirmation('note',$_REQUEST['banid']);?></textarea>
                             
                          </div>
                           <div class="col-md-3">
                            <label>Note 2</label>
                            <textarea name="note2" id="note2" class="form-control" maxlength="200"><?php echo getcarrierconfirmation('note2',$_REQUEST['banid']);?></textarea>
                             
                          </div>
                            <div class="col-md-3">
                            <label>Status</label>
                            <select name="status" class="form-control" required>
                            <option value="">Select</option>    
                            <option value="Initiate" <?php if(getcarrierconfirmation('status',$_REQUEST['banid'])=='Initiate') { ?> selected <?php } ?>>Initiate</option>
                            <option value="On Progress" <?php if(getcarrierconfirmation('status',$_REQUEST['banid'])=='On Progress') { ?> selected <?php } ?>>On Progress</option>
                              <option value="Cancelled" <?php if(getcarrierconfirmation('status',$_REQUEST['banid'])=='Cancelled') { ?> selected <?php } ?>>Cancelled</option>
                          
                            <option value="Completed" <?php if(getcarrierconfirmation('status',$_REQUEST['banid'])=='Completed') { ?> selected <?php } ?>>Completed</option>
                            <option value="Hold" <?php if(getcarrierconfirmation('status',$_REQUEST['banid'])=='Hold') { ?> selected <?php } ?>>Hold</option>
                            </select>
                          
                             
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
						

                  </div>
                 
                        
                                 <br>
                         
               
                </div><!-- /.box-body -->
              
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

$(document).on('keydown', '#pickup_contact', function (e){
     var product = $(this).val();
     $(this).val($(this).val().toUpperCase());
     $this = $(this);
     
     // Initialize jQuery UI autocomplete
  $('#pickup_contact').autocomplete({
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
      $('#pickup_contact').val(''); 
            var keyCode = event .keyCode || event .which;
   if(keyCode=='13' || keyCode=='9'){
     $('#pickup_contact').focus();  
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
$(document).on('keydown', '#delivery_contact', function (e){
     var product = $(this).val();
     $(this).val($(this).val().toUpperCase());
     $this = $(this);
     
     // Initialize jQuery UI autocomplete
  $('#delivery_contact').autocomplete({
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
      $('#delivery_contact').val(''); 
            var keyCode = event .keyCode || event .which;
   if(keyCode=='13' || keyCode=='9'){
     $('#delivery_contact').focus();  
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


