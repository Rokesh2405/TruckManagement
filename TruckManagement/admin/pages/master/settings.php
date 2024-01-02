<?php
$menu = "7";
$thispageid = 17;
$franchisee = 'yes';
include ('../../config/config.inc.php');
include ('../../require/header.php');
error_reporting(1);
ini_set('display_errors','1');
error_reporting(E_ALL);

if (isset($_REQUEST['submit'])) {
    @extract($_REQUEST);
    global $db;
    $getid = $_REQUEST['banid'];
    $ip = $_SERVER['REMOTE_ADDR'];
   
 $type=$_REQUEST['banid'];
           $i=0;
           foreach($fieldname as $fieldname11)
           {
               if($fieldname11!='') { 
                  
               $fieldname12=str_replace("'","",str_replace(' ','_',str_replace('-','_',trim($fieldname[$i]))));
              
              
               $fieldid12=$fieldid[$i];
                $status12=$status[$i];
                
              if($fieldname12!='') {
               $chkformfield = $db->prepare("SHOW COLUMNS FROM `forms` WHERE Field = '".$fieldname12."'");
                $chkformfield->execute(array());
                $fcount = $chkformfield->rowcount();
                if ($fcount == '0') {
                    echo "ALTER TABLE `forms` ADD $fieldname12 VARCHAR(122) NULL DEFAULT NULL AFTER `userid`";
                    
                $achkformfield = $db->prepare("ALTER TABLE `forms` ADD $fieldname12 VARCHAR(122) NULL DEFAULT NULL AFTER `userid`");
                $achkformfield->execute(array());
                   
                }
               }
              
             
               if($fieldid12=='') {
                $settingdeail = FETCH_all("SELECT * FROM `settings` WHERE `label`=? AND `type`=?", $fieldname11,$type);   
                if($settingdeail['id']=='') {
             $resa1 = $db->prepare("INSERT INTO `settings` (`type`, `label`,`status`,`fieldname`) VALUES(?,?,?,?)");
            $resa1->execute(array($type,$fieldname11,$status12,$fieldname12));
                }
                
               }
               else
               {
               $settingdeail = FETCH_all("SELECT * FROM `settings` WHERE `label`!=? AND `type`=?", $fieldname11,$type);   
               if($settingdeail['id']=='') {
               $resa1 = $db->prepare("UPDATE `settings` SET `fieldname`=?, `label`=?,`status`=? WHERE `id`=? ");
            $resa1->execute(array($fieldname12,$fieldname11,$status12,$fieldid12)); 
               }
               }
                
           $i++;   
               }
           }
         
             $msg = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button><h4><i class="icon fa fa-check"></i>Successfully Updated</h4></div>';
   
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

    function deleteimage1(a, b, c, d, e, f) {

        $.ajax({
            type: "POST",
            url: "<?php echo $sitename; ?>config/functions_ajax.php",
            data: {image: a, id: b, table: c, path: d, images: e, pid: f},
            success: function (data) {
                //alert(data);   
                $('#delimage1').html(data);
            }

        });
    }
</script>


<!-- Content Wrapper. Contains page content -->
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">

            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="btn-group pull-right m-t-15">
                        <a href="<?php echo $sitename; ?>master/types.htm"><button type="button" class="btn btn-default">Back to Listings Page</button>
                        </a>

                    </div>

                    <h4 class="page-title"><?php
                        if (isset($_REQUEST['banid'])) {
                            echo "Edit";
                        } else {
                            echo "Add";
                        }
                        ?> Fields</h4>
                    <ol class="breadcrumb">
                      
                        <li class="breadcrumb-item">Fields List</li>
                        <li class="breadcrumb-item active"><?php
                            if (isset($_REQUEST['banid'])) {
                                echo "Edit";
                            } else {
                                echo "Add";
                            }
                            ?> Fields</li>
                    </ol>
                    <br>
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
                                        <div class="box-header with-border">

  <span style="float:right; font-size:13px; color: #333333; text-align: right; padding: 8px;"><span style="color:#FF0000;">*</span> Marked Fields are Mandatory<br></span> 
  <br>
                                        </div>
                                        <div class="box-body">
                                            <br>
                                        <?php //echo $msg; ?>
                    <table width="100%" class="table table-bordered" id="task_table" cellpadding="0"  cellspacing="0">
                                            <thead>
                                                <tr>
                                                  <th>Field Name</th>
                                                    <th>Status</th>
                                                   </tr>
                                            </thead>
                                            <tbody>
<?php
$sno=1;
if($_REQUEST['banid']!='') {
 $tamilofficers11=pFETCH("SELECT * FROM `settings` WHERE `type`=? ",$_REQUEST['banid']);
    while ($fetchtamilofficers = $tamilofficers11->fetch(PDO::FETCH_ASSOC))
    {
                                        
?>
<tr>
    <!--<td><?php echo $sno; ?></td>-->
<td><input type="text" name="fieldname[]" class="form-control" value="<?php echo trim($fetchtamilofficers['label']); ?>"/></td>

<td>
     <input type="hidden" name="fieldid[]" class="form-control" value="<?php echo $fetchtamilofficers['id']; ?>"/>
<select name="status[]" class="form-control">
<option value="1" <?php if($fetchtamilofficers['status']=='1') { ?> selected="selected" <?php } ?>>Active</option>
<option value="0" <?php if($fetchtamilofficers['status']=='0') { ?> selected="selected" <?php } ?>>Inactive</option>
</select>  
</td>

</tr>
<?php $sno++;} } ?>
                                    <tr id="firsttasktr">
                                                    <!--<td>1</td>-->
                                                   <td><input type="text" name="fieldname[]" class="form-control"/>
                                                       </td>
                                                    
                                                    <td>
                                                        <input type="hidden" name="fieldid[]" class="form-control" />
                                                       <select name="status[]" class="form-control">
<option value="1">Active</option>
<option value="0">Inactive</option>
</select>  </td>
                                                    
                                                </tr>


                                            </tbody>
                                            <tfoot>
                                              
                                               <tr>
                                                    <td colspan="3" style="border:0;"><button type="button" class="btn btn-info" id="add_task">Add Another</button></td>
                                                    
                                                </tr>
                                            </tfoot>
                                        </table>
                          <div class="row">
                      <div class="col-md-6">
                          <br>
                            <button type="submit" name="submit" id="submit" class="btn btn-success" style="float:left;"><?php
                                if ($_REQUEST['banid'] != '') {
                                    echo 'UPDATE';
                                } else {
                                    echo 'SUBMIT';
                                }
                                ?></button>
                        </div>
              
                    </div>
                                            <br>
                         
               
                </div><!-- /.box-body -->
                <br><br>
                <div class="box-footer">
                    <div class="row">
                        <div class="col-md-6">
                            <a href="<?php echo $sitename; ?>master/types.htm">Back to Listings page</a>
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

      function delrec(elem, id) {
        if (confirm("Are you sure want to delete this Details?")) {
            $(elem).parent().remove();
            window.location.href = "<?php echo $sitename; ?>master/<?php echo $_REQUEST['banid']; ?>/editproduct.htm?delid=" + id;
        }
    }


    $(document).ready(function (e) {
        
        $('#add_task').click(function () {

           
            var data = $('#firsttasktr').clone();
            // var rem_td = $('<td />').html('<i class="fa fa-trash fa-2x" style="color:#F00;cursor:pointer;"></i>').click(function () {
            //     if (confirm("Do you want to delete the Details?")) {
            //         $(this).parent().remove();
            //         re_assing_serial();
                   
            //     }
            // });
            // $(data).attr('id', '').show().append(rem_td);
              $(data).find('td').each(function (e) {
                 $(this).find('input[name="fieldname[]"]').val('');
                 $(this).find('input[name="fieldid[]"]').val('');
                     
            });
            data = $(data);
            $('#task_table tbody').append(data);
            
           
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
                 $(this).find('input[name="bunit[]"]').val('');
                 $(this).find('input[name="bunitprice[]"]').val('');
                     
            });
            data = $(data);
            $('#task_table1 tbody').append(data);
            
           
            re_assing_serial1();

        });
        
      });

    function del_addi(elem) {
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
</script>

