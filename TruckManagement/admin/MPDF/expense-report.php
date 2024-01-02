<?php
require_once __DIR__ . '/vendor/autoload.php';
include ('../config/config.inc.php');

date_default_timezone_set('Asia/Kolkata');
global $db;
$s='';
$s1=array();
if($_REQUEST['fromdate']!='' && $_REQUEST['todate']!='') {
$s1[]="(date(`voucher_date`)>='".date('Y-m-d',strtotime($_REQUEST['fromdate']))."'  AND date(`voucher_date`)<='".date('Y-m-d',strtotime($_REQUEST['todate']))."')";
}

if($_REQUEST['expense_type']!='') {
$s1[]=" `expense`=".$_REQUEST['expense_type'];
}


if(count($s1)>0) {
$s=implode('  AND  ',$s1);
}

$sno=1;
if($s!='') { 
 $stmt = $db->prepare("SELECT * FROM `expenseentry` WHERE $s ORDER BY `date` DESC");
}
else{
$stmt = $db->prepare("SELECT * FROM `expenseentry` ORDER BY `date` DESC");  
}


 $stmt->execute();
$checknum1 = $stmt->rowCount();

$message = '<br>
<div align="center"><h2>Expense Report</h2></div>
<br>
<div align="left">
<strong>From Date</strong>:&nbsp;&nbsp;&nbsp;&nbsp;'.date('d-m-Y',strtotime($_REQUEST['fromdate'])).'
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<strong>To Date</strong>:&nbsp;&nbsp;&nbsp;&nbsp;'.date('d-m-Y',strtotime($_REQUEST['todate'])).'
</div>
<br><br>
<table style="width:100%; font-family:arial; font-size:20px;border-bottom:1px solid #C72465;" border="1" cellpadding="5" cellspacing="0">
    <tr align="center">
    <th>Sno</th>
    <th>Voucher No</th>
    <th>Voucher Date</th>
    <th>Expense</th>
    <th>Expense Description</th>
    <th>Payment Type</th>
    <th>Payment Date</th>
    <th>Payment Amount</th>
    </tr>';
  if($checknum1>0)
{
  $sno=1;
	while ($fdepart = $stmt->fetch(PDO::FETCH_ASSOC)){
	
  $message .='<tr>
  <td>'.$sno.'</td>
 <td>'.$fdepart['voucher_no'].'</td>
  <td>'.date('d-m-Y',strtotime($fdepart['voucher_date'])).'</td>
    <td>'.getexpense('expense_name',$fdepart['expense']).'</td>
    <td>'.$fdepart['expense_desc'].'</td>
    <td>'.$fdepart['payment_type'].'</td>
    <td>'.date('d-m-Y',strtotime($fdepart['payment_date'])).'</td>
    <td>'.$fdepart['payment_type'].'</td>
 </tr>';
 $sno++;
	}
	
}
else
{
 $message .='<tr>
  <td colspan="8" align="center">No Records Found</td>
  </tr>';	
}
  $message .='</table>
			';
          

$mpdf=new mPDF('', 'A4', 0, '', 10, 10, 0, 0, 0, 'L');
$mpdf->SetDisplayMode('default');
$mpdf->list_indent_first_level = 0; // 1 or 0 - whether to indent the first level of a list
$filename = "test1.txt";

$file = fopen($filename, "w");
fwrite($file, $message);
$mpdf->SetTitle('Expense Report');
$mpdf->keep_table_proportions = false;
$mpdf->shrink_this_table_to_fit = 0;
$mpdf->SetAutoPageBreak(true, 10);
$mpdf->WriteHTML(file_get_contents($filename));
//$mpdf->SetWatermarkImage('jiovio.png', 0.10, 'F');
//$mpdf->showWatermarkImage = true;
$mpdf->setAutoBottomMargin = 'stretch';
//$mpdf->setHTMLFooter('<div style="border-top: 0.1mm solid #000000;"><table width="100%"><tr><td colspan="2" align="center"><b>Healthcare</b></td></tr><tr><td><b>E-mail : </b>'.gethospital('emailid',$appointment['hospitalid']).'</td><td align="right"><b>For Support</b><br>'.gethospital('contactno',$appointment['hospitalid']).'</td></tr></table>');
$filename='Expense-Report.pdf';
$mpdf->Output($filename, 'D');
?>
