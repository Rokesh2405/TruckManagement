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

    $msg = addsalessettlement($payment_currency,$load_no,$settlement_amt,$payment_date,$salesman_name,$company_name,$payment_type,$cheque_no,$cheque_date,$payment_amount,$getid);
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
                        <a href="<?php echo $sitename; ?>master/salesman_settlement.htm"><button type="button" class="btn btn-default">Back to Listings Page</button>
                        </a>
                       
                    </div>

                    <h4 class="page-title"><?php
                        if (isset($_REQUEST['banid'])) {
                            echo "Edit";
                        } else {
                            echo "Add";
                        }
                        ?> Sales Settlement</h4>
                    <ol class="breadcrumb" style="margin-bottom: 0px;">
                      
                        <li class="breadcrumb-item"><a href="sales_settlement.htm">Sales Settlement</a></li>
                        <li class="breadcrumb-item active"><?php
                            if (isset($_REQUEST['banid'])) {
                                echo "Edit";
                            } else {
                                echo "Add";
                            }
                            ?> Sales Settlement</li>
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
                            <label>Load No <span style="color:#FF0000;"> </span></label>
                           <input type="text" name="load_no" placeholder="Load No"  id="load_no" class="form-control" value="<?php echo getsalesmansettlement('load_no',$_REQUEST['banid']);?>"> 
                          </div>

                         
                              <div class="col-md-3">
                            <label>Salesman Name<span style="color:#FF0000;"> </span></label>
                          
                              <select class="form-control" name="salesman_name" onchange="getamt(this.value)">
                               <option value="">SELECT SALESMAN</option>
        <?php
        $clist = pFETCH("SELECT * FROM salesman WHERE `id`!=?", '0');
        while ($cfetch = $clist->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                         
        <option value="<?php echo $cfetch['id']; ?>" <?php if($cfetch['id']==getsalesmansettlement('salesman_name',$_REQUEST['banid'])) { ?> selected="selected" <?php } ?>><?php echo $cfetch['salesman_name']; ?></option>
        <?php } ?> 
                           </select>
                            
                          </div>
                         
                          <div class="col-md-3">
                            <label>Settlement Amount</label>
                           <input type="text" readonly name="settlement_amt" id="settlement_amt" placeholder="Settlement Amount"  id="settlement_amt" class="form-control" value="<?php echo getsalesmansettlement('settlement_amt',$_REQUEST['banid']);?>"> 
                          </div>

                          <div class="col-md-3">
                            <label>Company Name<span style="color:#FF0000;"> </span></label>
                           <input type="text" name="company_name" placeholder="Enter Company Name"  id="company_name" class="form-control" value="<?php echo getsalesmansettlement('company_name',$_REQUEST['banid']);?>" maxlength="50">
                            
                            
                          </div>
                   
                    
                          </div>
                          <div class="row">
                    <div class="col-md-3">
                            <label>Payment Type</label>
                          <select name="payment_type" class="form-control">
                                              <option value="">Select</option>  
                                                  <option value="Cash" <?php if(getsalesmansettlement('payment_type',$_REQUEST['banid'])=='Cash') { ?> selected="selected" <?php } ?>>Cash</option>
                                                  <option value="Visa" <?php if(getsalesmansettlement('payment_type',$_REQUEST['banid'])=='Visa') { ?> selected="selected" <?php } ?>>Visa</option>
                                                  <option value="Master" <?php if(getsalesmansettlement('payment_type',$_REQUEST['banid'])=='Master') { ?> selected="selected" <?php } ?>>Master</option>
                                                  <option value="AMEX" <?php if(getsalesmansettlement('payment_type',$_REQUEST['banid'])=='AMEX') { ?> selected="selected" <?php } ?>>AMEX</option>
                                                  <option value="Debit" <?php if(getsalesmansettlement('payment_type',$_REQUEST['banid'])=='Debit') { ?> selected="selected" <?php } ?>>Debit</option>
                                                  <option value="Cheque" <?php if(getsalesmansettlement('payment_type',$_REQUEST['banid'])=='Cheque') { ?> selected="selected" <?php } ?>>Cheque</option>
                                                  <option value="Direct" <?php if(getsalesmansettlement('payment_type',$_REQUEST['banid'])=='Direct') { ?> selected="selected" <?php } ?>>Direct</option>
                                                  <option value="E-Transfer" <?php if(getsalesmansettlement('payment_type',$_REQUEST['banid'])=='E-Transfer') { ?> selected="selected" <?php } ?>>E-Transfer</option>
                                              </select>
                          </div>
                             

                           <div class="col-md-3">
                            <label>Payment Date<span style="color:#FF0000;"> </span></label>
                           <input type="date" name="payment_date" placeholder="Enter Payment Date"  id="payment_date" class="form-control" value="<?php echo getsalesmansettlement('payment_date',$_REQUEST['banid']);?>" maxlength="7"></div>
                         <div class="col-md-3">
                            <label>Cheque No</label>
                           <input type="text" name="cheque_no" placeholder="Cheque No"  id="cheque_no" class="form-control" value="<?php echo getsalesmansettlement('cheque_no',$_REQUEST['banid']);?>" maxlength="16">
                            
                            
                          </div>
 <div class="col-md-3">
                            <label>Cheque Date</label>
                           <input type="date" name="cheque_date" placeholder="Cheque Date"  id="cheque_date" class="form-control" value="<?php echo getsalesmansettlement('cheque_date',$_REQUEST['banid']);?>"> 
                          </div>
                          
                        </div>

                        <div class="row">
                            
                      
                         <!--  <div class="col-md-3">
                            <label>Payment Amount</label>
                             <input type="text" name="payment_amount"  id="payment_amount" class="form-control" value="<?php echo getsalesmansettlement('payment_amount',$_REQUEST['banid']);?>">
                          
                          </div> -->
                           <div class="col-md-3">
                            <label>Payment Currency</label>
                            <select name="payment_currency" class="form-control">
                                 <option value="CAD" <?php if(getsalesmansettlement('payment_currency',$_REQUEST['banid'])=='CAD') { ?> selected="selected" <?php } ?>>CAD</option>
                                 <option value="USD" <?php if(getsalesmansettlement('payment_currency',$_REQUEST['banid'])=='USD') { ?> selected="selected" <?php } ?>>USD</option>
                               
                              
                            </select>
                            
                          </div>
<div class="col-md-3">
                            <label>Payment Amount</label>
                            <input type="text" class="form-control" name="payment_amount" value="<?php echo getsalesmansettlement('payment_amount',$_REQUEST['banid']);?>" placeholder="Payment Amount"  maxlength="50">
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
                            <a href="<?php echo $sitename; ?>master/salesman_settlement.htm">Back to Listings page</a>
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
 


function getamt(a){
     var load_no= $('#load_no').val();
var successCount = 0;
       $.ajax({
         cache: true,
         url: "<?php echo $sitename; ?>pages/master/getdetails.php?salesmanamt="+a+"&load_no="+load_no,
         success: 
           function(data)
           {
            const myArray = data.split("#");
           $('#settlement_amt').val(myArray[0]); 
          $('#company_name').val(myArray[1]); 
          
         },
         complete: function() 
         {
           
          // setInterval(sendRequest, 30000); 
         }
     });
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


