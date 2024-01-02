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
   $msg = addstaff($staff_name,$staff_email,$staff_address1,$staff_salary,$staff_address2,$staff_status,$staff_postal_code,$staff_sin_no,$staff_city,$staff_notes,$staff_provience_state,$staff_dob,$staff_country,$staff_hire_date,$staff_home_telephone,$staff_terminate_date,$staff_cell_no,$staff_option,$getid);
   
}
 $link22 = FETCH_all("SELECT * FROM `staff_tbl` WHERE id!=? ORDER BY `id` DESC", 0);
   if($link22['staff_code']!=''){
               $staff_code=$link22['staff_code']+1;
           }
           else{
             $staff_code='991250001';
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
                    <div class="btn-group pull-right">
                        <a href="<?php echo $sitename; ?>master/staff.htm"><button type="button" class="btn btn-default">Back to Listings Page</button>
                        </a>

                    </div>

                    <h4 class="page-title"><?php
                        if (isset($_REQUEST['banid'])) {
                            echo "Edit";
                        } else {
                            echo "Add";
                        }
                        ?> Staff</h4>
                    <ol class="breadcrumb" style="margin-bottom: 0px;">
                      
                        <li class="breadcrumb-item">Staff List</li>
                        <li class="breadcrumb-item active"><?php
                            if (isset($_REQUEST['banid'])) {
                                echo "Edit";
                            } else {
                                echo "Add";
                            }
                            ?> Staff</li>
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
                            <label>Staff Code</label>
                            
                            <input type="text" class="form-control" readonly="readonly" name="staff_code" id="staff_code" value="<?php if($_REQUEST['banid']!='') {  echo getstaff('staff_code',$_REQUEST['banid']); } else { echo $staff_code; }
                       ?>" maxlength="50">
                            </div>
                              <!--<div class="col-md-3">
                            <label>Search</label>
							<input type="hidden" name="getid" id="getid">
							<input type="text" class="form-control" name="srchcode" id="srchcode" onkeyup="getcusdetails(this.value);" style="background: #bfbff1;">
                            </div>-->
							<div class="col-md-3">
                            <label><span style="color:#ffff;"> *</span></label>
							
							<select name="staffss" id="staffss" class="form-control" onchange="getcusdetails1(this.value);"  style="background: #bfbff1;">
						   <option value="">SELECT STAFF</option>
        <?php
        $clist = pFETCH("SELECT * FROM staff_tbl WHERE `id`!=?", '0');
        while ($cfetch = $clist->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                         
        <option value="<?php echo $cfetch['id']; ?>"><?php echo $cfetch['staff_name']; ?></option>
        <?php } ?> 
                       
							</select>
                            </div>
                            
							</div>
						
							<div class="row">
							<div class="col-md-3">
                            <label>Staff Name&nbsp;<span style="color:#FF0000;" id="alresult"> </span></label>
							<input type="text" required="required" name="staff_name" id="staff_name" value="<?php echo getstaff('staff_name', $_REQUEST['banid']); ?>" class="form-control" maxlength="50" onkeyup="alreadyexist(this.value,'staff_name','staff_tbl')"/>
							</div>
							<div class="col-md-3">
                            <label>Email&nbsp;<span style="color: red;" id="stafferror"></span></label>
							<input type="email" name="staff_email" id="staff_email" class="form-control" value="<?php echo getstaff('staff_email', $_REQUEST['banid']); ?>" maxlength="50" onkeyup="ValidateEmail(this.value,'stafferror');"/>
							</div>
                          
                            <div class="col-md-3">
                            <label>Salary</label>
                            <input type="number" name="staff_salary" id="staff_salary" class="form-control" value="<?php echo getstaff('staff_salary', $_REQUEST['banid']); ?>" step="0.01" maxlength="50"/>
                            </div>
                              <div class="col-md-3">
                            <label>Date of Birth</label>
                            <input type="date" name="staff_dob" id="staff_dob" value="<?php echo getstaff('staff_dob', $_REQUEST['banid']); ?>" class="form-control" />
                            </div>
							</div>
                            <div class="row">
                                   <div class="col-md-3">
                            <label>Address 1</label>
                            <input type="text" name="staff_address1" id="staff_address1" value="<?php echo getstaff('staff_address1', $_REQUEST['banid']); ?>" class="form-control" maxlength="50"/>
                            </div>
                             <div class="col-md-3">
                            <label>Address 2</label>
                            <input type="text" name="staff_address2" id="staff_address2" value="<?php echo getstaff('staff_address2', $_REQUEST['banid']); ?>" class="form-control" maxlength="50" />
                            </div>
                              <div class="col-md-3">
                            <label>Province / State</label>
                                    <select class="form-control" name="staff_provience_state" id="staff_provience_state">
<option value="ON (Canada)" <?php if(getstaff('staff_provience_state',$_REQUEST['banid'])=='ON (Canada)') { ?> selected="selected" <?php } ?>>ON (Canada)</option>    
       <?php
        $clist = pFETCH("SELECT * FROM states WHERE `status`=?", '1');
        while ($cfetch = $clist->fetch(PDO::FETCH_ASSOC)) {
                            ?>
<option value="<?php echo $cfetch['state']; ?>" <?php if(getstaff('staff_provience_state',$_REQUEST['banid'])==$cfetch['state']) { ?> selected="selected" <?php } ?>><?php echo $cfetch['state']; ?></option>
<?php } ?>
</select>
                    </div>
                              <div class="col-md-3">
                            <label>City</label>
                            <input type="text" name="staff_city" id="staff_city" value="<?php echo getstaff('staff_city', $_REQUEST['banid']); ?>" class="form-control" maxlength="50" />
                            </div>
                            </div>
                            <div class="row">
                              <div class="col-md-3">
                            <label>Postal / Zip Code</label>
                            <input type="text" name="staff_postal_code" id="staff_postal_code" value="<?php echo getstaff('staff_postal_code', $_REQUEST['banid']); ?>" class="form-control num" maxlength="7" />
                            </div>
                             <div class="col-md-3">
                            <label>Country</label>
                             <select name="staff_country" id="staff_country" class="form-control">
<option value="CANADA" <?php if(getstaff('staff_country',$_REQUEST['banid'])=='CANADA') { ?> selected="selected" <?php } ?>>CANADA</option>
<option value="US" <?php if(getstaff('staff_country',$_REQUEST['banid'])=='US') { ?> selected="selected" <?php } ?>>US</option>
                            </select>
                           </div>
                           
                       
                            <div class="col-md-3">
                            <label>SIN No.</label>
                            <input type="number" maxlength="12" name="staff_sin_no" id="staff_sin_no" value="<?php echo getstaff('staff_sin_no', $_REQUEST['banid']); ?>" class="form-control num"/>
                            </div>
                              <div class="col-md-3">
                            <label>Notes</label>
                            <input type="text" name="staff_notes" id="staff_notes" value="<?php echo getstaff('staff_notes', $_REQUEST['banid']); ?>" class="form-control" maxlength="50"/>
                            </div>
                            </div>
                            
                           
                            <div class="row">
                         
                           <div class="col-md-3">
                            <label>Cell No.</label>
                            <input type="text" name="staff_cell_no" id="staff_cell_no" value="<?php echo getstaff('staff_cell_no', $_REQUEST['banid']); ?>" class="form-control" onkeyup="telformat(this.value,'staff_cell_no');" maxlength="16"/>
                            </div>
                            
                             <div class="col-md-3">
                            <label>Home Telephone</label>
                            <input type="text" name="staff_home_telephone" id="staff_home_telephone" value="<?php echo getstaff('staff_home_telephone', $_REQUEST['banid']); ?>" class="form-control" onkeyup="telformat(this.value,'staff_home_telephone');" maxlength="16"/>
                            </div>
                            <div class="col-md-3">
                            <label>Hire Date</label>
                            <input type="date" name="staff_hire_date" id="staff_hire_date" value="<?php echo getstaff('staff_hire_date', $_REQUEST['banid']); ?>" class="form-control" />
                            </div>
                            <div class="col-md-3">
                            <label>Terminate Date</label>
                            <input type="date" name="staff_terminate_date" id="staff_terminate_date" value="<?php echo getstaff('staff_terminate_date', $_REQUEST['banid']); ?>" class="form-control" />
                            </div>

                            </div>

                            <div class="row">
                            
                            <div class="col-md-3">
                            <label>Option</label>
                            <select name="staff_option" id="staff_option" class="form-control">
<option value="">Select</option>
<option value="ADMIN" <?php if(getstaff('staff_option', $_REQUEST['banid'])=='ADMIN') { ?> selected="selected" <?php } ?>>ADMIN</option>
<option value="DISPATCH"  <?php if(getstaff('staff_option', $_REQUEST['banid'])=='DISPATCH') { ?> selected="selected" <?php } ?>>DISPATCH</option>
<option value="MARKETING" <?php if(getstaff('staff_option', $_REQUEST['banid'])=='MARKETING') { ?> selected="selected" <?php } ?>>MARKETING</option>
<option value="PROGRAMMMER" <?php if(getstaff('staff_option', $_REQUEST['banid'])=='PROGRAMMMER') { ?> selected="selected" <?php } ?>>PROGRAMMMER</option>
                            </select>
                            </div>
                             <div class="col-md-3">
                            <label>Status</label>
                           <select class="form-control" name="staff_status" id="staff_status">
                               <option value="1" <?php if(getstaff('staff_status', $_REQUEST['banid'])=='1'){ ?> selected="selected" <?php } ?>>ACTIVE</option>
                               <option value="2" <?php if(getstaff('staff_status', $_REQUEST['banid'])=='2'){ ?> selected="selected" <?php } ?>>IN-ACTIVE</option>
                               <option value="3" <?php if(getstaff('staff_status', $_REQUEST['banid'])=='3'){ ?> selected="selected" <?php } ?>>OFF DUTY</option>
                               <option value="4" <?php if(getstaff('staff_status', $_REQUEST['banid'])=='4'){ ?> selected="selected" <?php } ?>>TERMINATED</option>
                               <option value="5" <?php if(getstaff('staff_status', $_REQUEST['banid'])=='5'){ ?> selected="selected" <?php } ?>>VACATION</option>
                           </select>
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

              
                </div><!-- /.box-body -->
                <br><br>
                <div class="box-footer">
                    <div class="row">
                        <div class="col-md-6">
                            <a href="<?php echo $sitename; ?>master/staff.htm">Back to Listings page</a>
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

<script>
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


   $(document).ready(function() {
      $(".reset").click(function() {
    $(this).closest('form').find("input[type=text], input[type=email],input[type=number],input[type=date]").val("");
    $('#province_state').prop('selectedIndex',0);
});


      $("input[type=text]").keyup(function () {  
            $(this).val($(this).val().toUpperCase());
         var keyCode = event .keyCode || event .which;
   if(keyCode=='13' || keyCode=='9'){
 
        if ($('#stafferror').html()==='Invalid email address.') {
     $('#staff_email').focus(); 
      }
     }  

        });  



      $("input[type=email]").keyup(function () {  
            $(this).val($(this).val().toUpperCase());
         var keyCode = event .keyCode || event .which;
   if(keyCode=='13' || keyCode=='9'){
 if ($('#alresult').html()==='Already Exist') {
     $('#staff_name').focus(); 
      }
     }  

        });  

        $(".num").keypress(function() {
            if ($(this).val().length == $(this).attr("maxlength")) {
              $(this).val('');
                $(this).focus();
            }

        });
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
   function getcusdetails1(a){
var successCount = 0;
       $.ajax({
         cache: true,
         url: "<?php echo $sitename; ?>pages/master/cusdetails.php?staff="+a,
         success: 
           function(data)
           {
               if(data!='' && data!='0')
               {
            const myArray = data.split("#");

          $('#staff_name').val(myArray[0]); 
          $('#staff_email').val(myArray[1]); 
          $('#staff_address1').val(myArray[2]); 
          $('#staff_salary').val(myArray[3]); 
          $('#staff_address2').val(myArray[4]); 
           $('#staff_status option[value="'+myArray[5]+'"]').attr("selected", "selected");
          $('#staff_postal_code').val(myArray[6]); 
          $('#staff_sin_no').val(myArray[7]); 
          $('#staff_city').val(myArray[8]); 
          $('#staff_notes').val(myArray[9]); 
        $('#staff_provience_state option[value="'+myArray[10]+'"]').attr("selected", "selected");
        $('#staff_dob').val(myArray[11]); 
        $('#staff_country option[value="'+myArray[12]+'"]').attr("selected", "selected");
        $('#staff_hire_date').val(myArray[13]); 
        $('#staff_home_telephone').val(myArray[14]); 
        $('#staff_cell_no').val(myArray[15]); 
         $('#staff_option option[value="'+myArray[16]+'"]').attr("selected", "selected");
        $('#staff_terminate_date').val(myArray[17]); 
        $('#getid').val(myArray[18]); 
        $('#staff_code').val(myArray[19]);
         }
        else{
           $('#staff_name').val(''); 
          $('#staff_email').val(''); 
          $('#staff_address1').val(''); 
          $('#staff_salary').val(''); 
          $('#staff_address2').val(''); 
          $('#staff_status').val(''); 
          $('#staff_postal_code').val(''); 
          $('#staff_sin_no').val(''); 
          $('#staff_city').val(''); 
          $('#staff_notes').val(''); 
        $('#staff_provience_state').val(''); 
        $('#staff_dob').val(''); 
        $('#staff_country').val(''); 
        $('#staff_hire_date').val(''); 
        $('#staff_home_telephone').val(''); 
        $('#staff_cell_no').val(''); 
        $('#staff_option').val(''); 
        $('#staff_terminate_date').val(''); 
        $('#getid').val(''); 
         $('#staff_code').val('');
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
         url: "<?php echo $sitename; ?>pages/master/cusdetails.php?staffcode="+a,
         success: 
           function(data)
           {
               if(data!='' && data!='0')
               {
            const myArray = data.split("#");

       
          $('#staff_name').val(myArray[0]); 
          $('#staff_email').val(myArray[1]); 
          $('#staff_address1').val(myArray[2]); 
          $('#staff_salary').val(myArray[3]); 
          $('#staff_address2').val(myArray[4]); 
           $('#staff_status option[value="'+myArray[5]+'"]').attr("selected", "selected");
          $('#staff_postal_code').val(myArray[6]); 
          $('#staff_sin_no').val(myArray[7]); 
          $('#staff_city').val(myArray[8]); 
          $('#staff_notes').val(myArray[9]); 
        $('#staff_provience_state option[value="'+myArray[10]+'"]').attr("selected", "selected");
        $('#staff_dob').val(myArray[11]); 
        $('#staff_country option[value="'+myArray[12]+'"]').attr("selected", "selected");
        $('#staff_hire_date').val(myArray[13]); 
        $('#staff_home_telephone').val(myArray[14]); 
        $('#staff_cell_no').val(myArray[15]); 
         $('#staff_option option[value="'+myArray[16]+'"]').attr("selected", "selected");
        $('#staff_terminate_date').val(myArray[17]); 
        $('#getid').val(myArray[18]); 
        $('#staff_code').val(myArray[19]);
         }
        else{
           $('#staff_name').val(''); 
          $('#staff_email').val(''); 
          $('#staff_address1').val(''); 
          $('#staff_salary').val(''); 
          $('#staff_address2').val(''); 
          $('#staff_status').val(''); 
          $('#staff_postal_code').val(''); 
          $('#staff_sin_no').val(''); 
          $('#staff_city').val(''); 
          $('#staff_notes').val(''); 
        $('#staff_provience_state').val(''); 
        $('#staff_dob').val(''); 
        $('#staff_country').val(''); 
        $('#staff_hire_date').val(''); 
        $('#staff_home_telephone').val(''); 
        $('#staff_cell_no').val(''); 
        $('#staff_option').val(''); 
        $('#staff_terminate_date').val(''); 
        $('#getid').val(''); 
         $('#staff_code').val('');
               }
         },
         complete: function() 
         {
           
          // setInterval(sendRequest, 30000); 
         }
     });
   }
</script>  
