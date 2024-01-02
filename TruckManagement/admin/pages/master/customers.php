<?php
$menu = "2";
include ('../../config/config.inc.php');
$dynamic = '1';
//$datepicker = '1';
$datatable = '1';

include ('../../require/header.php');

if (isset($_REQUEST['delete']) || isset($_REQUEST['delete_x'])) {
    $chk = $_REQUEST['chk'];
    $chk = implode('.', $chk);
   
    $msg = delcustomer($chk);
}
?>
<link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.2.7/css/rowReorder.dataTables.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.4/css/responsive.dataTables.min.css" />
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
            if (confirm("Please confirm you want to Delete this Customer..?"))
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
    .row { margin:0;}
    #normalexamples tbody tr td:nth-child(1),tbody tr td:nth-child(3), tbody tr td:nth-child(4),tbody tr td:nth-child(5),tbody tr td:nth-child(6),tbody tr td:nth-child(7) ,tbody tr td:nth-child(8){
        text-align:center;
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

                      <div class="row pull-right">
                    <div class="col-md-6">
                           <div class="btn-group pull-right m-t-15">
                        <a href="<?php echo $sitename; ?>master/addcustomer.htm"><button type="button" class="btn btn-default">Add New</button></a>                              
                    </div>
                    </div>
                     <div class="col-md-6">
                           <div class="btn-group pull-right m-t-15">
                          <a href="<?php echo $sitename; ?>MPDF/customer_report.htm" target="_blank"><button type="button" class="btn btn-default">Print</button></a>                            
                    </div>
                    </div>
                     </div>   

                    
                 
                  <h4 class="page-title">Customer</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo $sitename; ?>"><?php echo getusers('name',$_SESSION['GRUID']); ?></a></li>
                        <li class="breadcrumb-item active">Customers List</li>
                    </ol>
                </div>
</div>

                <!-- /.box-header -->
            <div class="row">
                    <div class="col-12">
                      
                        <div class="card-box table-responsive">
                            <h4 class="m-t-0 header-title">List of Customers</h4>
                            <p class="text-muted font-14 m-b-30">
                             
                                <!--  Responsive is an extension for DataTables that resolves that problem by optimising the table's layout for different screen sizes through the dynamic insertion and removal of columns from the table. -->
                            </p>

              <span id="hideDiv">             
<?php if($msg !='') { echo $msg; } 
if($_SESSION['msg']!='') { echo $_SESSION['msg']; $_SESSION['msg']=''; }
?>
     </span>
              
                 <form name="listoform" id="isform" method="post" action="">
                                <div class="table-responsive">
                                   <table id="normalexamples" class="table table-bordered display nowrap dataTable dtr-inline" style="width: 100%; position: relative;" role="grid" aria-describedby="normalexamples_info">
                                       <thead class="thead-default">
                                <tr align="center">
                                    <th style="width:5%;">S.No</th>
									<th style="width:10%;">Customer Code</th>
									
                                    <th style="width:15%;">Customer Name</th>
                                    <th style="width:20%;">Country</th>
                                    <th style="width:20%;">Zip Code</th>
									<th style="width:20%;">Contact Name</th>
									<th style="width:20%;">Edit</th>
									<th data-sortable="false" align="center" style="text-align: center; padding-right:0; padding-left: 0; width: 10%;"><input name="check_all" id="check_all" value="1" onclick="javascript:checkall(this.form)" type="checkbox" /></th>
                                 
                                </tr>
                            </thead>  

						
                            <tfoot>
                                <tr>

                                    <th colspan="7">&nbsp;</th>
									<th style="margin:0px auto;" align="right"><button type="submit" class="btn btn-danger" name="delete" id="delete" value="Delete" onclick="return checkdelete('chk[]');"> DELETE </button></th>
                                   
                               </tr>
                            </tfoot>
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

<script type="text/javascript">
function editthis(a)
{
var did = a;
window.location.href = '<?php echo $sitename; ?>master/' + a + '/editcustomer.htm';
}     
</script>
<?php
include ('../../require/footer.php');
?>

<script src="https://cdn.datatables.net/rowreorder/1.2.7/js/dataTables.rowReorder.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.4/js/dataTables.responsive.min.js"></script>

<script type="text/javascript">
    $('#normalexamples').dataTable({
         rowReorder: {
            selector: 'td:nth-child(2)'
        },
        responsive: true ,
        "bProcessing": true,
        "bServerSide": false,
        //"scrollX": true,
        "searching": true,
        "sAjaxSource": "<?php echo $sitename; ?>pages/dataajax/gettablevalues.php?types=customertable"
    });
</script>