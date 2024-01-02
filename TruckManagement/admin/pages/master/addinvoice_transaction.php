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
$carrierconfirm = FETCH_all("SELECT * FROM `invoice_transaction` WHERE id=? ", $getid);
$insert_id=$getid;

 $customer_name=$carrierconfirm['customer_name'];

$cusinfo = FETCH_all("SELECT * FROM `customer` WHERE customer_name=? ", $customer_name);

$to=$cusinfo['email_dispatch'];//
$from="info@worktogethergroup.ca";//config pana email


$message='<p>Hi<br><br>Your recent Invoice Transaction <br><br>
* <a href="'.$sitename.'MPDF/invoice_report.php?id='.$insert_id.'&type="download">Click the link to download the invoice</a>
</p>';


///////form2//

$subject =$customer_name." (".$carrierconfirm['invoice_no'].")"." - Invoice Transaction";
$resmail = sendgridApiMail($to, $message, $subject, $from, '');

        if ($resmail->statusCode() == '202') 
        {
}

//Send Mail

    $msg = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Mail Sent Successfully!</h4></div>';
}



function generatePassword ($length = 5)
{
  $genpassword = "";
  $possible = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
  $i = 0;
  while ($i < $length) {
    $char = substr($possible, mt_rand(0, strlen($possible)-1), 1);
    if (!strstr($genpassword, $char)) {
      $genpassword .= $char;
      $i++;
    }
  }
  return $genpassword;
}

if (isset($_REQUEST['submit'])) {
    @extract($_REQUEST);
    $getid = $_REQUEST['banid'];
    $ip = $_SERVER['REMOTE_ADDR'];
   
if($_REQUEST['getid']!=''){
$getid=$_REQUEST['getid'];
}

global $db;
if($getid!='') {
 $resa = $db->prepare("UPDATE `invoice_transaction` SET `hst_percent`=? WHERE `id`=? ");
$resa->execute(array($taxpercentage,$getid));
}

    $msg = addinvoice_transaction($remark,$tax1,$total1,$hst,$note,$received_amount,$rate_currency,$total_currency,$payment_type,$payment_date,$cheque_no,$cheque_date,$invoice_date,$customer_no,$customer_name,$invoice_no,$shipment_no,$qty,$rate,$charge,$tax,$total,$getid);
}
 $link22 = FETCH_all("SELECT * FROM `invoice_transaction` WHERE id!=? ORDER BY `id` DESC", 0);
           if($link22['invoice_no']!=''){
            $excode=explode("WT",$link22['invoice_no']);
            $invoice=$excode['1']+1;
                 $invoicecode="WT000000".$invoice;
           }
           else{
             $invoicecode="WT0000001";
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
                        <a href="<?php echo $sitename; ?>master/invoice_transaction.htm"><button type="button" class="btn btn-default">Back to Listings Page</button>
                        </a>
                        &nbsp;&nbsp;
                        <?php  if (isset($_REQUEST['banid'])) { ?>
                             <form name="mailform" method="post">
                            <button type="submit" name="sendmail" class="btn btn-default">Send Mail</button>
                                            &nbsp;&nbsp;
                            </form>
                         <a href="<?php echo $sitename; ?>MPDF/invoice_report.php?id=<?php echo $_REQUEST['banid']; ?>" target="_blank"><button type="button" class="btn btn-default">Invoice1</button>
                        </a>&nbsp;&nbsp;
                        <a href="<?php echo $sitename; ?>MPDF/invoice_report2.php?id=<?php echo $_REQUEST['banid']; ?>" target="_blank"><button type="button" class="btn btn-default">Invoice2</button>
                        </a>
                    <?php } ?>
                    </div>

                    <h4 class="page-title"><?php
                        if (isset($_REQUEST['banid'])) {
                            echo "Edit";
                        } else {
                            echo "Add";
                        }
                        ?> Invoice Transaction</h4>
                    <ol class="breadcrumb" style="margin-bottom: 0px;">
                     
                        <li class="breadcrumb-item"><a href="invoice_transaction.htm"> Carrier Confirmation</a></li>
                        <li class="breadcrumb-item active"><?php
                            if (isset($_REQUEST['banid'])) {
                                echo "Edit";
                            } else {
                                echo "Add";
                            }
                            ?> Invoice Transaction</li>
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
                            <label>Load No<span style="color:#FF0000;"> </span></label>
                           <input type="text" required="required" name="load_no" placeholder="Enter Load No"  id="shipment_no" class="form-control" value="<?php echo getinvoicetransaction('load_no',$_REQUEST['banid']);?>" maxlength="50" >
                            
                            
                          </div>
                             <div class="col-md-3">
                            <label>Customer Name</label>
                           <input type="text" name="customer_name" placeholder="Enter Customer Name"  id="customer_name" class="form-control" value="<?php echo getinvoicetransaction('customer_name',$_REQUEST['banid']);?>" maxlength="50" >
                            
                            
                          </div>
                              <div class="col-md-3">
                            <label>Invoice No<span style="color:#FF0000;"> </span></label>
                          
                              <input type="text" readonly="readonly" name="invoice_no" placeholder="Enter Invoice Number"  id="invoice_no" class="form-control" value="<?php if(getinvoicetransaction('invoice_no',$_REQUEST['banid'])!='') { echo getinvoicetransaction('invoice_no',$_REQUEST['banid']); } else { echo $invoicecode; }?>" >
                            
                          </div>
                             <div class="col-md-3">
                            <label>Invoice Date</label>
                           <input type="date" name="invoice_date" placeholder="Enter Invoice Date"  id="invoice_date" class="form-control" value="<?php echo getinvoicetransaction('invoice_date',$_REQUEST['banid']);?>" maxlength="50" >
                            
                            
                          </div>
                         
                          
                         
                          </div>
                          <div class="row">
                             <!-- <div class="col-md-3">
                            <label>Customer No<span style="color:#FF0000;"> </span></label>
                           <input type="text" name="customer_no" placeholder="Enter Customer No"  id="customer_no" class="form-control" value="<?php echo getinvoicetransaction('customer_no',$_REQUEST['banid']);?>" maxlength="50">
                            
                            
                          </div> -->
                         <!-- <div class="col-md-3">
                            <label>Shipment No<span style="color:#FF0000;"> </span></label>
                           <input type="text" name="shipment_no" placeholder="Enter Shipment No"  id="shipment_no" class="form-control" value="<?php echo getinvoicetransaction('shipment_no',$_REQUEST['banid']);?>" maxlength="50">
                            
                            
                          </div> -->
                    <div class="col-md-3">
                            <label>Quantity</label>
                           <input type="text" name="qty" placeholder="Enter Quantity"  id="qty" class="form-control" value="<?php echo getinvoicetransaction('qty',$_REQUEST['banid']);?>" >
                         </div>

 <div class="col-md-3">
                            <label>Rate Currency</label>
                            <select name="rate_currency" class="form-control">
                                <option value="CAD" <?php if(getinvoicetransaction('rate_currency',$_REQUEST['banid'])=='CAD') { ?> selected="selected" <?php } ?>>CAD</option>
                                  <option value="USD" <?php if(getinvoicetransaction('rate_currency',$_REQUEST['banid'])=='USD') { ?> selected="selected" <?php } ?>>USD</option>
                                

                            </select>
                            
                          </div>

                         <div class="col-md-3">
                            <label>Rate</label>
                           <input type="text" name="rate" placeholder="Rate"  id="rate" class="form-control" value="<?php echo getinvoicetransaction('rate',$_REQUEST['banid']);?>" maxlength="16">
                            
                            
                          </div>
                 
                            <div class="col-md-3">
                            <label>Charge</label>
                           <input type="text" readonly="readonly" name="charge" placeholder="Charge"  id="charge" class="form-control" value="<?php echo getinvoicetransaction('charge',$_REQUEST['banid']);?>"> 
                          </div>
                        
                        </div>

                        <div class="row">
                             <div class="col-md-3">
                            <label>Tax HST</label>

                            <?php if(getinvoicetransaction('hst_percent',$_REQUEST['banid'])!='') {

                                  $cname=getinvoicetransaction('customer_name',$_REQUEST['banid']);
                              $cusinfo = FETCH_all("SELECT * FROM `customer` WHERE customer_name=? ", $cname);
                              $pstate=$cusinfo['province_state'];
                             // echo "SELECT * FROM `states` WHERE state='".$pstate."' ";

   $stinfo = FETCH_all("SELECT * FROM `states` WHERE state=? ", $pstate);
   if($stinfo['hst']!=getinvoicetransaction('hst_percent',$_REQUEST['banid'])) {
     $hstperc=$stinfo['hst'];
   }
   else
   {
                                $hstperc=getinvoicetransaction('hst_percent',$_REQUEST['banid']);
                            }

                            }
                            else
                            {
                                $cname=getinvoicetransaction('customer_name',$_REQUEST['banid']);
                              $cusinfo = FETCH_all("SELECT * FROM `customer` WHERE customer_name=? ", $cname);
                              $pstate=$cusinfo['province_state'];
                             // echo "SELECT * FROM `states` WHERE state='".$pstate."' ";

   $stinfo = FETCH_all("SELECT * FROM `states` WHERE state=? ", $pstate);
   if($stinfo['hst']!='') {
   $hstperc=$stinfo['hst'];
   }
   else
   {
    $hstperc=13;
   }

                            }
                                ?>
                              <input type="hidden" name="taxpercentage" placeholder="Tax HST"  id="taxpercentage" class="form-control" value="<?php echo $hstperc; ?>" readonly="readonly"> 
                            
                           <input type="text" name="tax" placeholder="Tax HST"  id="tax" class="form-control" value="<?php echo getinvoicetransaction('tax',$_REQUEST['banid']);?>" readonly="readonly">
                           <input type="hidden" name="tax1" id="tax1" value="<?php echo getinvoicetransaction('tax1',$_REQUEST['banid']);?>"> 
                          </div>
                            <div class="col-md-3">
                            <label>Total Currency</label>
                            <select name="total_currency" class="form-control">
                                <option value="CAD" <?php if(getinvoicetransaction('total_currency',$_REQUEST['banid'])=='CAD') { ?> selected="selected" <?php } ?>>CAD</option>
                                     <option value="USD" <?php if(getinvoicetransaction('total_currency',$_REQUEST['banid'])=='USD') { ?> selected="selected" <?php } ?>>USD</option>
                                
                              
                            </select>
                            
                          </div>

                            <!-- <div class="col-md-3">
                            <label>Subtotal</label>
                           <input type="text" name="total" placeholder="Total"  id="total" class="form-control" value="<?php echo getinvoicetransaction('total',$_REQUEST['banid']);?>"> 
                          </div> -->
                           
                           <div class="col-md-3">
                            <label>Total</label>
                           <input type="text" readonly="readonly" name="total" placeholder="Total"  id="total" class="form-control" value="<?php echo getinvoicetransaction('total',$_REQUEST['banid']);?>"> 
                           <input type="hidden" name="total1" id="total1" value="<?php echo getinvoicetransaction('total1',$_REQUEST['banid']);?>">
                          </div>
<div class="col-md-3">
                            <label>Payment Type<span style="color:#FF0000;"> </span></label>
                          <select name="payment_type" class="form-control">
                                              <option value="">Select</option>  
                                                  <option value="Cash" <?php if(getinvoicetransaction('payment_type',$_REQUEST['banid'])=='Cash') { ?> selected="selected" <?php } ?>>Cash</option>
                                                  <option value="Visa" <?php if(getinvoicetransaction('payment_type',$_REQUEST['banid'])=='Visa') { ?> selected="selected" <?php } ?>>Visa</option>
                                                  <option value="Master" <?php if(getinvoicetransaction('payment_type',$_REQUEST['banid'])=='Master') { ?> selected="selected" <?php } ?>>Master</option>
                                                  <option value="AMEX" <?php if(getinvoicetransaction('payment_type',$_REQUEST['banid'])=='AMEX') { ?> selected="selected" <?php } ?>>AMEX</option>
                                                  <option value="Debit" <?php if(getinvoicetransaction('payment_type',$_REQUEST['banid'])=='Debit') { ?> selected="selected" <?php } ?>>Debit</option>
                                                  <option value="Cheque" <?php if(getinvoicetransaction('payment_type',$_REQUEST['banid'])=='Cheque') { ?> selected="selected" <?php } ?>>Cheque</option>
                                                  <option value="Direct" <?php if(getinvoicetransaction('payment_type',$_REQUEST['banid'])=='Direct') { ?> selected="selected" <?php } ?>>Direct</option>
                                                  <option value="E-Transfer" <?php if(getinvoicetransaction('payment_type',$_REQUEST['banid'])=='E-Transfer') { ?> selected="selected" <?php } ?>>E-Transfer</option>
                                              </select>
                          </div>
  
                      </div>
                      <div class="row">
                       <div class="col-md-3">
                            <label>Payment Date</label>
                             <input type="date" name="payment_date"  id="salesman_payment_date" class="form-control" value="<?php echo getinvoicetransaction('payment_date',$_REQUEST['banid']);?>">
                          
                          </div> 
                       <div class="col-md-3">
                            <label>Cheque No</label>
                             <input type="text" name="cheque_no"  id="cheque_no" class="form-control" value="<?php echo getinvoicetransaction('cheque_no',$_REQUEST['banid']);?>">
                          
                          </div> 
                          
                            <div class="col-md-3">
                            <label>Cheque Date</label>
                             <input type="date" name="cheque_date"  id="cheque_date" class="form-control" value="<?php echo getinvoicetransaction('cheque_date',$_REQUEST['banid']);?>">
                          
                          </div> 
                           <div class="col-md-3">
                            <label>Received Amount</label>
                             <input type="text" name="received_amount"  id="received_amount" class="form-control" value="<?php echo getinvoicetransaction('received_amount',$_REQUEST['banid']);?>">
                          
                          </div> 
                      </div>
                      <div class="row">
                          <div class="col-md-3">
                            <label>HST / GST</label>
                            <select name="hst" class="form-control" onchange="gethst(this.value);">
                                <option value="HST" <?php if(getinvoicetransaction('hst',$_REQUEST['banid'])=='HST') { ?> selected="selected" <?php } ?>>HST</option>
                                <option value="No HST" <?php if(getinvoicetransaction('hst',$_REQUEST['banid'])=='No HST') { ?> selected="selected" <?php } ?>>No HST</option>
                                <option value="GST" <?php if(getinvoicetransaction('hst',$_REQUEST['banid'])=='GST') { ?> selected="selected" <?php } ?>>GST</option>
                            </select>
                            
                          </div> 
                         <div class="col-md-3">
                            <label>Note</label>
                            <textarea name="note" id="note" class="form-control" maxlength="200"><?php echo getinvoicetransaction('note',$_REQUEST['banid']);?></textarea>
                             
                          </div> 
                            <div class="col-md-3">
                            <label>Remark</label>
                            <textarea name="remark" id="remark" class="form-control" maxlength="200"><?php echo getinvoicetransaction('remark',$_REQUEST['banid']);?></textarea>
                             
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
                            <a href="<?php echo $sitename; ?>master/invoice_transaction.htm">Back to Listings page</a>
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
 
function gethst(a){
    var tax=$('#tax1').val(); 
    var total=$('#total1').val();
    var charge=$('#charge').val();
if(a=='HST' || a=='GST'){
$('#tax').val(tax); 
$('#total').val(total); 
}
else
{
  
$('#tax').val(''); 
$('#total').val(charge); 
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

sum=0;
$(document).on('keyup', '#qty', function (e){
   sum=Number($('#rate').val())*Number($(this).val());
       $('#charge').val(sum);
        taxvalue=Number(sum)*(Number($('#taxpercentage').val())/100);
      
        $('#tax').val(taxvalue.toFixed());
        $('#tax1').val(taxvalue.toFixed());
    finalval=Number(sum)+Number(taxvalue);
       $('#total').val(finalval.toFixed());
       $('#total1').val(finalval.toFixed());
     });

$(document).on('keyup', '#rate', function (e){
   sum=Number($('#qty').val())*Number($(this).val());
       $('#charge').val(sum);
       taxvalue=Number(sum)*(Number($('#taxpercentage').val())/100);
     $('#tax').val(taxvalue.toFixed(2));
      $('#tax1').val(taxvalue.toFixed(2));
    finalval=Number(sum)+Number(taxvalue);
       $('#total').val(finalval.toFixed(2));
       $('#total1').val(finalval.toFixed(2));
     });

// $(document).on('keyup', '#tax', function (e){
//     charge= $('#charge').val();
//     taxvalue=Number(charge)*(Number($(this).val())/100);
//     finalval=Number(charge)+Number(taxvalue);
//        $('#total').val(finalval);
//      });


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
      search: request.term,request:124
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

$(document).on('keydown', '#customer_name', function (e){
     var product = $(this).val();
     $(this).val($(this).val().toUpperCase());
     $this = $(this);
     
     // Initialize jQuery UI autocomplete
  $('#customer_name').autocomplete({
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
      $('#customer_name').val(''); 
            var keyCode = event .keyCode || event .which;
   if(keyCode=='13' || keyCode=='9'){
     $('#customer_name').focus();  
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

$(document).on('keydown', '#shipment_no', function (e){
     var product = $(this).val();
     $(this).val($(this).val().toUpperCase());
     $this = $(this);
     
     // Initialize jQuery UI autocomplete
  $('#shipment_no').autocomplete({
   source: function( request, response ) {
    $.ajax({
   url:"<?php echo $sitename.'pages/master/'; ?>getdetails.php",
     type: 'post',
     dataType: "json",
     data: {
      search: request.term,request:11
     },
     success: function( data ) {
        if (!$.trim(data)){   
      $('#shipment_no').val(''); 
            var keyCode = event .keyCode || event .which;
   if(keyCode=='13' || keyCode=='9'){
     $('#shipment_no').focus();  
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


