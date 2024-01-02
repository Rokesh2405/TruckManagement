<?php
$menu = "10";
include ('../../config/config.inc.php');
$dynamic = '1';
//$datepicker = '1';
$datatable = '1';

include ('../../require/header.php');

if (isset($_REQUEST['delete']) || isset($_REQUEST['delete_x'])) {
    $chk = $_REQUEST['chk'];
    $chk = implode('.', $chk);
    $msg = delregister($chk);
}
if(isset($_REQUEST['export']))
{
@extract($_REQUEST);
if($_SESSION['usertype']=='vendor') {
    $vendid=$_SESSION['usertypeid'];
}
else
{
    $vendid=$_REQUEST['vendorid'];
}


$url=$sitename.'MPDF/customer-outstanding-report.php?type=customer&fromdate='.$_REQUEST['fromdate'].'&todate='.$_REQUEST['todate'];
echo "<script>window.open('".$url."', '_blank');</script>";
}

?>
<script type="text/javascript" >
    function validcheck(name)
    {
        var chObj = document.getElementsByName(name);
        var result = false;
        for (var i = 0; i < chObj.length; i++) {
            if (chObj[i].checked) {
                result = true;
                break;
            }
        }
        if (!result) {
            return false;
        } else {
            return true;
        }
    }

    function checkdelete(name)
    {
        if (validcheck(name) == true)
        {
            if (confirm("Please confirm you want to Delete this Model(s)"))
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else if (validcheck(name) == false)
        {
            alert("Select the check box whom you want to delete.");
            return false;
        }
    }

</script>
<script type="text/javascript">
    function checkall(objForm) {
        len = objForm.elements.length;
        var i = 0;
        for (i = 0; i < len; i++) {
            if (objForm.elements[i].type == 'checkbox') {
                objForm.elements[i].checked = objForm.check_all.checked;
            }
        }
    }
</script>

<style type="text/css">
    .row { margin:0;
    }
    #normalexamples tbody tr td:nth-child(5),tbody tr td:nth-child(6)
    {
        text-align:center;
    }
    #normalexamples tbody tr td:nth-child(4),tbody tr td:nth-child(7),tbody tr td:nth-child(8)
    {
        text-align:right;
    }
    input#chk\[\] {
    margin-left: 29px;
}
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        
        <div class="row">
            <div class="container-fluid">
                <!-- Page-Title -->
                <div class="row">
                <div class="col-sm-12">
                     <div class="btn-group pull-right m-t-15">
                       <!--  <a href="<?php echo $sitename; ?>master/userforms.htm"><button type="button" class="btn btn-default">Download Excel</button></a>  -->
                       <!--  <a href="<?php echo $sitename; ?>master/addregister.htm"><button type="button" class="btn btn-default">Add New</button></a>     -->                    
                    </div>
                  <h4 class="page-title">Reports</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo $sitename; ?>"><?php echo getusers('name', $_SESSION['GRUID']); ?></a></li>
                        <li class="breadcrumb-item active"> Customer Outstanding Report</li>
                    </ol>
                </div>
</div>
                <!-- /.box-header -->
            <div class="row">
                    <div class="col-12">
                      
                        <div class="card-box table-responsive">
                            
<div class="row">
<div class="col-md-12">
<form name="search" method="post">
<div class="panel panel-info">
    <div class="panel-heading">Search</div>
    <div class="panel-body">
    <div class="row">
    <div class="col-md-4">
     <label>From Date</label>
    <input type="date" name="fromdate" class="form-control" value="<?php if($_REQUEST['fromdate']!=''){ echo $_REQUEST['fromdate']; } else { echo "2023-01-01"; } ?>">
    </div>
    <div class="col-md-4">
     <label>To Date</label>
    <input type="date" name="todate" class="form-control" value="<?php if($_REQUEST['todate']!=''){ echo $_REQUEST['todate']; } else { echo date('Y-m-d');} ?>">
    </div>

<div class="col-md-4">
      <br>
      <input type="submit" name="search" value="Search" class="btn btn-success">&nbsp;&nbsp;
      <input type="submit" class="btn btn-success" name="export" value="Download  PDF">
      </div>
</div>
<br>

    </div>
  </div>
</form>
</div>
</div>
 <br>                          
<?php if($msg !='') { echo $msg; } 
?>
     
              
                 <form name="form1" method="post" action="">
                                <div class="table-responsive">
                                    <table id="normalexamples" class="table table-bordered table-striped" width="100%">
                                         <thead>
                                <tr align="center">
    <th style="width:5%;">Sno</th>
    <th style="width:8%;">Invoice No</th>
    <th style="width:10%;">Invoice Date</th>
    <th style="width:10%;">Customer Name</th>
    <th style="width:10%;">Sales Amount</th>
    <th style="width:10%;">Pay Date</th>
    <th style="width:5%;">Pay Amount</th>
    <th style="width:5%;">Balance</th>
    </tr>
                            </thead>
                              <tbody>
                                 <?php 

if($_REQUEST['fromdate']!='' && $_REQUEST['todate']!='') {
$s1[]="(`invoice_date`>='".date('Y-m-d',strtotime($_REQUEST['fromdate']))."'  AND `invoice_date`<='".date('Y-m-d',strtotime($_REQUEST['todate']))."')";
}

if(count($s1)>0) {
$s=implode('  AND  ',$s1);
}
$sno=1;
if($s!='') { 

 $message1 = $db->prepare("SELECT * FROM `invoice_transaction` WHERE `id`!='0' AND $s ORDER BY `invoice_date` DESC");
}
else{

$message1 = $db->prepare("SELECT * FROM `invoice_transaction` WHERE `id`!='0' ORDER BY `invoice_date` DESC");  
}

 $message1->execute();
while($fdepart = $message1->fetch(PDO::FETCH_ASSOC)) {
  if($fdepart['received_amount']=='')
    {
$balanceamt=$fdepart['total'];
    }
elseif($fdepart['received_amount']<$fdepart['total']) {
$balanceamt=$fdepart['total']-$fdepart['received_amount'];
}
else
{
 $balanceamt=0;   
}


if($fdepart['invoice_date']!='')
{
$idate=date('d-m-Y',strtotime($fdepart['invoice_date']));
}
else
{
$idate='';
}
if($fdepart['payment_date']!='')
{
$pdate=date('d-m-Y',strtotime($fdepart['payment_date']));
}
else
{
$pdate='';
}
?>
<tr>
   <td><?php echo $sno; ?></td>
 <td><?php echo $fdepart['invoice_no']; ?></td>
  <td><?php echo $idate; ?></td>
      <td><?php echo $fdepart['customer_name']; ?></td>
    <td><?php echo number_format($fdepart['total'],2); ?></td>

    <td><?php echo $pdate; ?></td>
    <td><?php echo number_format($fdepart['received_amount'],2); ?></td>
       <td><?php echo number_format($balanceamt,2); ?></td>
 </tr>                
<?php  $sno++; }  ?>

 <tbody>

                                    </table>
                                </div>
                            </form>
            </div><!-- /.box-body -->
        </div><!-- /.box -->

        </div>
            </div>
        </div>
    </div><!-- /.content -->
</div><!-- /.content-wrapper -->

<?php
include ('../../require/footer.php');
?>  
<link href="https://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" rel="Stylesheet">
<script src="https://code.jquery.com/ui/1.10.2/jquery-ui.js" ></script>
<script src="https://code.jquery.com/jquery-migrate-3.0.0.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>


<script type="text/javascript">
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
      $('#normalexamples').dataTable({
        "bProcessing": true,
        "bServerSide": false,
        //"scrollX": true,
        "searching": true
    });
</script>
  <script src="https://code.jquery.com/ui/1.10.2/jquery-ui.js" ></script>


