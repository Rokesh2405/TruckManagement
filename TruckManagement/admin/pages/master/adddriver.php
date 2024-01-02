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
    
   $msg = adddriver($driver_name, $company_name, $address1, $address_code, $zip_code, $city, $state, $country, $address2, $telephone, $truck_no, $telephone_home, $hst_value, $telephone_us, $driver_email, $driver_commision_rate, $driver_dob, $salary, $hire_date, $mile_rate, $driver_liecense_exp_date, $empty_mile_rate, $empty_mile_date, $hourly_rate, $sin_no, $notes, $status, $license_no, $license_class,$getid);
   
}
 $link22 = FETCH_all("SELECT * FROM `driver_tbl` WHERE id!=? ORDER BY `id` DESC", 0);
           if($link22['driver_code']!=''){
               $driver_code=$link22['driver_code']+1;
           }
           else{
             $driver_code='991350001';
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
                        <a href="<?php echo $sitename; ?>master/drivers.htm"><button type="button" class="btn btn-default">Back to Listings Page</button>
                        </a>

                    </div>

                    <h4 class="page-title"><?php
                        if (isset($_REQUEST['banid'])) {
                            echo "Edit";
                        } else {
                            echo "Add";
                        }
                        ?> Driver</h4>
                    <ol class="breadcrumb" style="margin-bottom: 0px;">
                      
                        <li class="breadcrumb-item">Driver List</li>
                        <li class="breadcrumb-item active"><?php
                            if (isset($_REQUEST['banid'])) {
                                echo "Edit";
                            } else {
                                echo "Add";
                            }
                            ?> Driver</li>
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
                            <label>Driver Code<span style="color:#FF0000;"> </span></label>
							<input type="text" class="form-control" name="driver_code" value="<?php if($_REQUEST['banid']!='') { echo getdriver('driver_code',$_REQUEST['banid']); } else { echo $driver_code; } ?>" readonly="readonly">
							
                            </div>
                           
<!-- 
                            <div class="col-md-3">
                            <label>Search<span style="color:#FF0000;"> </span></label>
                            <input type="hidden" name="getid" id="getid">
                            <input type="text" class="form-control" name="drivercode" id="drivercode" onkeyup="getcusdetails(this.value);" style="background: #bfbff1;">
                            
                            </div> -->
							<div class="col-md-3">
                            <label><span style="color:#FF0000;"> </span></label>
							
							<select name="drivername" id="drivername" class="form-control" onchange="getcusdetails1(this.value);" style="background: #bfbff1;">
							<option value="">Select</option>
							 <?php
        $clist = pFETCH("SELECT * FROM driver_tbl WHERE `id`!=?", '0');
        while ($cfetch = $clist->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                         
        <option value="<?php echo $cfetch['id']; ?>"><?php echo $cfetch['driver_name']; ?></option>
        <?php } ?> 
							</select>
                            </div>
							</div>
                             <div class="row">
                              <div class="col-md-3">
                            <label>Driver Name&nbsp;<span style="color:#FF0000;" id="alresult"> </span></label>
                            <input type="text" class="form-control" required="required" name="driver_name" value="<?php echo getdriver('driver_name',$_REQUEST['banid']);?>" id="driver_name" maxlength="50" onkeyup="alreadyexist(this.value,'driver_name','driver_tbl');">
                            
                            </div>
                             <div class="col-md-3">
                            <label>Company Name<span style="color:#FF0000;"> </span></label>
                            <input type="text" class="form-control" name="company_name" id="company_name" value="<?php echo getdriver('company_name',$_REQUEST['banid']);?>" maxlength="50">
                            
                            </div>
                            <div class="col-md-3">
                            <label>Address1<span style="color:#FF0000;"> </span></label>
                             <input type="text" class="form-control" name="address1" id="address1" value="<?php echo getdriver('address1',$_REQUEST['banid']);?>" maxlength="50">
                            </div>
                             <div class="col-md-3">
                            <label>Address2<span style="color:#FF0000;"> </span></label>
                            <input type="text" class="form-control" name="address2" id="address2" value="<?php echo getdriver('address1',$_REQUEST['banid']);?>" maxlength="50">
                           
                            </div>

                            </div>
							<div class="row">
                             <div class="col-md-3">
                            <label>Province/State<span style="color:#FF0000;"> </span></label>
                             <select class="form-control" name="state" id="state">
                               <option value="ab" <?php if(getdriver('state',$_REQUEST['banid'])=='ab') { ?> selected="selected" <?php } ?>>AB</option>
                               <option value="ak" <?php if(getdriver('state',$_REQUEST['banid'])=='ak') { ?> selected="selected" <?php } ?>>AK</option>
                               <option value="al" <?php if(getdriver('state',$_REQUEST['banid'])=='al') { ?> selected="selected" <?php } ?>>AL</option>
                               <option value="ar" <?php if(getdriver('state',$_REQUEST['banid'])=='ar') { ?> selected="selected" <?php } ?>>AR</option>
                               <option value="az" <?php if(getdriver('state',$_REQUEST['banid'])=='az') { ?> selected="selected" <?php } ?>>AZ</option>
                               <option value="bc" <?php if(getdriver('state',$_REQUEST['banid'])=='bc') { ?> selected="selected" <?php } ?>>BC</option>
                               <option value="ca" <?php if(getdriver('state',$_REQUEST['banid'])=='ca') { ?> selected="selected" <?php } ?>>CA</option>
                               <option value="cd" <?php if(getdriver('state',$_REQUEST['banid'])=='cd') { ?> selected="selected" <?php } ?>>CD</option>
                                 <option value="on" <?php if(getdriver('state',$_REQUEST['banid'])=='on') { ?> selected="selected" <?php } ?>>ON</option>
                           </select>
                         
                            </div>
                            <div class="col-md-3">
                            <label>City<span style="color:#FF0000;"> </span></label>
                            <input type="text" class="form-control" name="city" id="city" value="<?php echo getdriver('city',$_REQUEST['banid']);?>" maxlength="25">
                            </div>
                          <div class="col-md-3">
                            <label>Postal/Zip Code<span style="color:#FF0000;"> </span></label>
                            <input type="text" class="form-control" name="zip_code" id="zip_code" value="<?php echo getdriver('zip_code',$_REQUEST['banid']);?>" maxlength="7">
                            
                            </div>
                            <div class="col-md-3">
                            <label>Country<span style="color:#FFFF;">.</span></label>
                             <select name="country" id="country" class="form-control">
<option value="CANADA" <?php if(getdriver('country',$_REQUEST['banid'])=='CANADA') { ?> selected="selected" <?php } ?>>CANADA</option>
<option value="US" <?php if(getdriver('country',$_REQUEST['banid'])=='US') { ?> selected="selected" <?php } ?>>US</option>
                            </select>
                         

                            </div>
                            </div>
                            
                            <div class="row">
                             <div class="col-md-3">
                            <label>Telephone CDN<span style="color:#FF0000;"> </span></label>
                            <input type="text" class="form-control" name="telephone" id="telephone" value="<?php echo getdriver('telephone',$_REQUEST['banid']);?>"  onkeyup="telformat(this.value,'telephone');" maxlength="16">
                            
                            </div>
                             <div class="col-md-3">
                            <label>Truck No.<span style="color:#FF0000;"> </span></label>
                            <input type="text" name="truck_no" id="truck_no" class="form-control" value="<?php echo getdriver('truck_no',$_REQUEST['banid']); ?>" maxlength="50">
                           </div>
                             <div class="col-md-3">
                            <label>Telephone Home<span style="color:#FF0000;"> </span></label>
                            <input type="text" class="form-control" name="telephone_home" id="telephone_home" value="<?php echo getdriver('telephone_home',$_REQUEST['banid']);?>" onkeyup="telformat(this.value,'telephone_home');" maxlength="16">
                            </div>
                             <div class="col-md-3">
                            <label>HST% Value<span style="color:#FF0000;"> </span></label>
                            <input type="number" step="0.01" class="form-control" name="hst_value" placeholder="HST% Value" value="<?php echo getdriver('hst_value',$_REQUEST['banid']);?>" id="hst_value" maxlength="50">
                           
                            </div>

                            </div>
                            <div class="row">
                            
                            <div class="col-md-3">
                            <label>Telephone-US</label>
                            <input type="text" name="telephone_us" id="telephone_us" value="<?php echo getdriver('telephone_us', $_REQUEST['banid']); ?>" class="form-control" onkeyup="telformat(this.value,'telephone_us');" maxlength="16"/>
                            </div>
                            <div class="col-md-3">
                            <label>Email <span style="color: red;" id="stafferror"></span></label>
                            <input type="email" name="driver_email"  id="driver_email" class="form-control" value="<?php echo getdriver('driver_email', $_REQUEST['banid']); ?>" maxlength="50" onkeyup="ValidateEmail(this.value,'stafferror');"/>
                            </div>
                             <div class="col-md-3">
                            <label>Commission Rate<span style="color:#FF0000;"> </span></label>
                            <input type="number" step="0.01" class="form-control" name="driver_commision_rate" id="driver_commision_rate" value="<?php echo getdriver('driver_commision_rate',$_REQUEST['banid']);?>" maxlength="50" >
                            
                            </div>

                             <div class="col-md-3">
                            <label>Date of Birth<span style="color:#FF0000;"> </span></label>
                            <input type="date" class="form-control" name="driver_dob" id="driver_dob" placeholder="Date of Birth" value="<?php echo getdriver('driver_dob',$_REQUEST['banid']);?>">
                            
                            </div>
                            </div>
                        
							<div class="row">
						
							
                            <div class="col-md-3">
                            <label>Salary<span style="color:#FF0000;"> </span></label>
                            <input type="number"  step="0.01"  class="form-control" name="salary" id="salary" value="<?php echo getdriver('salary',$_REQUEST['banid']);?>" maxlength="50">
                            
                            </div>
                             <div class="col-md-3">
                            <label>Hire Date<span style="color:#FF0000;"> </span></label>
                            <input type="date" class="form-control" name="hire_date" id="hire_date" placeholder="Hire Date" value="<?php echo getdriver('hire_date',$_REQUEST['banid']);?>">
                            
                            </div>

                              <div class="col-md-3">
                            <label>Mile Rate<span style="color:#FF0000;"> </span></label>
                            <input type="number" step="0.01" class="form-control" name="mile_rate" id="mile_rate" value="<?php echo getdriver('mile_rate',$_REQUEST['banid']);?>" maxlength="50">
                            
                            </div>
                             <div class="col-md-3">
                            <label>Driver Lic Ex. Dt.<span style="color:#FF0000;"> </span></label>
                            <input type="date" class="form-control" name="driver_liecense_exp_date"  id="driver_liecense_exp_date" placeholder="Driver Lic Ex. Dt." value="<?php echo getdriver('driver_liecense_exp_date',$_REQUEST['banid']);?>" maxlength="10">
                            
                            </div>
							</div>
							
                            
                           <div class="row">
                             <div class="col-md-3">
                            <label>Empty Mile Rate<span style="color:#FF0000;"> </span></label>
                            <input type="number" step="0.01" class="form-control" name="empty_mile_rate" id="empty_mile_rate" value="<?php echo getdriver('empty_mile_rate',$_REQUEST['banid']);?>" maxlength="50">
                            
                            </div>
                             <!--  <div class="col-md-3">
                            <label><span style="color:#FF0000;"> </span></label>
                             <input type="date" class="form-control" name="empty_mile_date" id="empty_mile_date" value="<?php echo getdriver('empty_mile_date',$_REQUEST['banid']);?>">
                            
                            
                            </div> -->
                            <div class="col-md-3">
                            <label>Hourly Rate<span  style="color:#FF0000;"> </span></label>
                            <input type="number" step="0.01" class="form-control" name="hourly_rate" id="hourly_rate" value="<?php echo getdriver('hourly_rate',$_REQUEST['banid']);?>" maxlength="50">
                            
                            </div>
                             <div class="col-md-3">
                            <label>SIN No.<span style="color:#FF0000;"> </span></label>
                            <input type="number" maxlength="12" class="form-control num" name="sin_no" id="sin_no" placeholder="SIN No." value="<?php echo getdriver('sin_no',$_REQUEST['banid']);?>">
                            
                            </div>
<div class="col-md-3">
                            <label>Notes<span style="color:#FF0000;"> </span></label>
                            <input type="text"  maxlength="50" class="form-control" name="notes" value="<?php echo getdriver('notes',$_REQUEST['banid']);?>" id="notes">
                            </div>
                            </div>
                           
                            <div class="row">
                              
                          
                             <div class="col-md-3">
                            <label>Status</label>
                          
                           <select class="form-control" name="status" id="status1">
                               <option value="1" <?php if(getdriver('status',$_REQUEST['banid'])=='1') { ?> selected="selected" <?php } ?>>ACTIVE</option>
                               <option value="2" <?php if(getdriver('status',$_REQUEST['banid'])=='2') { ?> selected="selected" <?php } ?>>IN-ACTIVE</option>
                               <option value="3" <?php if(getdriver('status',$_REQUEST['banid'])=='3') { ?> selected="selected" <?php } ?>>OFF DUTY</option>
                               <option value="4" <?php if(getdriver('status',$_REQUEST['banid'])=='4') { ?> selected="selected" <?php } ?>>TERMINATED</option>
                               <option value="5" <?php if(getdriver('status',$_REQUEST['banid'])=='5') { ?> selected="selected" <?php } ?>>VACATION</option>
                           </select>

                      </div> 
                       <div class="col-md-3">
                            <label>Driver Licence No.<span style="color:#FF0000;"> </span></label>
                            <input type="text" class="form-control" name="license_no" id="license_no" value="<?php echo getdriver('license_no',$_REQUEST['banid']);?>" maxlength="50">
                            
                            </div>
                             <div class="col-md-3">
                            <label>Licence Class<span style="color:#FFF;"></span></label>
                            <input type="text" class="form-control" name="license_class" id="license_class" placeholder="Licence Class" value="<?php echo getdriver('license_class',$_REQUEST['banid']);?>" maxlength="50">
                            
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
                  <button name="submit" id="submit" class="btn btn-success reset" style="float:left;">CLEAR</button>
              </div>
                     

                    </div>
                                            <br>
                         
               
                </div><!-- /.box-body -->
                <br><br>
                <div class="box-footer">
                    <div class="row">
                        <div class="col-md-6">
                            <a href="<?php echo $sitename; ?>master/drivers.htm">Back to Listings page</a>
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
 if ($('#alresult').html()==='Already Exist') {
     $('#driver_name').focus(); 
      }
        
     }  
        });  


   $("input[type=number]").keyup(function () {  
            $(this).val($(this).val().toUpperCase());  
                var keyCode = event .keyCode || event .which;
   if(keyCode=='13' || keyCode=='9'){

        if ($('#stafferror').html()==='Invalid email address.') {
     $('#driver_email').focus(); 
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
             // $('#'+$fieldname).val(''); 
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
function getcusdetails1(a)
   {
     var successCount = 0;
       $.ajax({
         cache: true,
         url: "<?php echo $sitename; ?>pages/master/cusdetails.php?drivername="+a,
         success: 
           function(data)
           {
               if(data!='' && data!='0')
               {
            const myArray = data.split("#");

          $('#driver_name').val(myArray[0]); 
          $('#company_name').val(myArray[1]); 
          $('#address1').val(myArray[2]); 
          $('#address_code').val(myArray[3]); 
          $('#zip_code').val(myArray[4]); 
          $('#city').val(myArray[5]); 
           $('#state option[value="'+myArray[6]+'"]').attr("selected", "selected");
         $('#country option[value="'+myArray[7]+'"]').attr("selected", "selected");
          $('#address2').val(myArray[8]); 
          $('#telephone').val(myArray[9]); 
         $('#truck_no option[value="'+myArray[10]+'"]').attr("selected", "selected");
        $('#telephone_home').val(myArray[11]); 
        $('#hst_value').val(myArray[12]); 
        $('#telephone_us').val(myArray[13]); 
        $('#driver_email').val(myArray[14]); 
        $('#driver_commision_rate').val(myArray[15]); 
        $('#driver_dob').val(myArray[16]); 
        $('#salary').val(myArray[17]); 
        $('#hire_date').val(myArray[18]); 
        $('#driver_liecense_exp_date').val(myArray[19]); 
        $('#empty_mile_rate').val(myArray[20]); 
        $('#empty_mile_date').val(myArray[21]); 
        $('#hourly_rate').val(myArray[22]); 
        $('#sin_no').val(myArray[23]); 
        $('#notes').val(myArray[24]); 
       $('#status1 option[value="'+myArray[25]+'"]').attr("selected", "selected");
        $('#salary').val(myArray[26]); 
        $('#license_no').val(myArray[27]); 
         $('#license_class').val(myArray[28]); 
        $('#getid').val(myArray[29]); 
        $('#driver_code').val(myArray[30]);
         }
        else{
          
  $('#driver_name').val(''); 
          $('#company_name').val(''); 
          $('#address1').val(''); 
          $('#address_code').val(''); 
          $('#zip_code').val(''); 
          $('#city').val(''); 
           $('#state option[value=""]').attr("selected", "selected");
         $('#country option[value=""]').attr("selected", "selected");
          $('#address2').val(''); 
          $('#telephone').val(''); 
         $('#truck_no option[value=""]').attr("selected", "selected");
        $('#telephone_home').val(''); 
        $('#hst_value').val(''); 
        $('#telephone_us').val(''); 
        $('#driver_email').val(''); 
        $('#driver_commision_rate').val(''); 
        $('#driver_dob').val(''); 
        $('#salary').val(''); 
        $('#hire_date').val(''); 
        $('#driver_liecense_exp_date').val(''); 
        $('#empty_mile_rate').val(''); 
        $('#empty_mile_date').val(''); 
        $('#hourly_rate').val(''); 
        $('#sin_no').val(''); 
        $('#notes').val(''); 
       $('#status1 option[value=""]').attr("selected", "selected");
        $('#salary').val(''); 
        $('#license_no').val(''); 
         $('#license_class').val(''); 
        $('#getid').val(''); 
        $('#driver_code').val('');
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
         url: "<?php echo $sitename; ?>pages/master/cusdetails.php?drivercode="+a,
         success: 
           function(data)
           {
               if(data!='' && data!='0')
               {
            const myArray = data.split("#");

          $('#driver_name').val(myArray[0]); 
          $('#company_name').val(myArray[1]); 
          $('#address1').val(myArray[2]); 
          $('#address_code').val(myArray[3]); 
          $('#zip_code').val(myArray[4]); 
          $('#city').val(myArray[5]); 
           $('#state option[value="'+myArray[6]+'"]').attr("selected", "selected");
         $('#country option[value="'+myArray[7]+'"]').attr("selected", "selected");
          $('#address2').val(myArray[8]); 
          $('#telephone').val(myArray[9]); 
               $('#truck_no').val(myArray[10]); 
        $('#telephone_home').val(myArray[11]); 
        $('#hst_value').val(myArray[12]); 
        $('#telephone_us').val(myArray[13]); 
        $('#driver_email').val(myArray[14]); 
        $('#driver_commision_rate').val(myArray[15]); 
        $('#driver_dob').val(myArray[16]); 
        $('#salary').val(myArray[17]); 
        $('#hire_date').val(myArray[18]); 
        $('#driver_liecense_exp_date').val(myArray[19]); 
        $('#empty_mile_rate').val(myArray[20]); 
        $('#empty_mile_date').val(myArray[21]); 
        $('#hourly_rate').val(myArray[22]); 
        $('#sin_no').val(myArray[23]); 
        $('#notes').val(myArray[24]); 
       $('#status1 option[value="'+myArray[25]+'"]').attr("selected", "selected");
        $('#salary').val(myArray[26]); 
        $('#license_no').val(myArray[27]); 
         $('#license_class').val(myArray[28]); 
        $('#getid').val(myArray[29]); 
        $('#driver_code').val(myArray[30]);
         }
        else{
          
  $('#driver_name').val(''); 
          $('#company_name').val(''); 
          $('#address1').val(''); 
          $('#address_code').val(''); 
          $('#zip_code').val(''); 
          $('#city').val(''); 
           $('#state option[value=""]').attr("selected", "selected");
         $('#country option[value=""]').attr("selected", "selected");
          $('#address2').val(''); 
          $('#telephone').val(''); 
              $('#truck_no').val(myArray[10]); 
        $('#telephone_home').val(''); 
        $('#hst_value').val(''); 
        $('#telephone_us').val(''); 
        $('#driver_email').val(''); 
        $('#driver_commision_rate').val(''); 
        $('#driver_dob').val(''); 
        $('#salary').val(''); 
        $('#hire_date').val(''); 
        $('#driver_liecense_exp_date').val(''); 
        $('#empty_mile_rate').val(''); 
        $('#empty_mile_date').val(''); 
        $('#hourly_rate').val(''); 
        $('#sin_no').val(''); 
        $('#notes').val(''); 
       $('#status1 option[value=""]').attr("selected", "selected");
        $('#salary').val(''); 
        $('#license_no').val(''); 
         $('#license_class').val(''); 
        $('#getid').val(''); 
        $('#driver_code').val('');
               }
         },
         complete: function() 
         {
           
          // setInterval(sendRequest, 30000); 
         }
     });
   }
</script>  
