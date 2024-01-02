<?php
require_once __DIR__ . '/vendor/autoload.php';
include ('../config/config.inc.php');
error_reporting(1);
ini_set('display_errors','1');
error_reporting(E_ALL);
date_default_timezone_set('Asia/Kolkata');
global $db;


$stmt = $db->prepare("SELECT * FROM `orders` WHERE `vendor_id`='".$_REQUEST['vendor_id']."' AND (date(`date`)>='".date('Y-m-d',strtotime($_REQUEST['fromdate']))."'  AND date(`date`)<='".date('Y-m-d',strtotime($_REQUEST['todate']))."') ORDER BY `id` DESC ");	
$stmt->execute();
$checknum1 = $stmt->rowCount();

$message = '<br>
<div align="center"><h2>Payment Report</h2></div>
<br>
<div align="left">
<strong>From Date</strong>:&nbsp;&nbsp;&nbsp;&nbsp;'.date('d-m-Y',strtotime($_REQUEST['fromdate'])).'
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<strong>To Date</strong>:&nbsp;&nbsp;&nbsp;&nbsp;'.date('d-m-Y',strtotime($_REQUEST['todate'])).'
</div>
<br><br>
<table style="width:100%; font-family:arial; font-size:20px;border-bottom:1px solid #C72465;" border="1" cellpadding="5" cellspacing="0">
  <tr>
  <th align="left">Order Date</th>
   <th align="left">Order ID</th>
    <th align="left">Amount</th>
	 <th align="left">Order Status</th>
  </tr>';
  if($checknum1>0)
{
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		if($row['deliver_status']=='Delivered') {
	$payment="Paid";
}
else{
	$payment="Pending";
}
  $message .='<tr>
  <td>'.date('d-m-Y',strtotime($row['date'])).'</td>
  <td>'.$row['id'].'</td>
  <td>Rs. '.$row['grand_total'].'</td>
    <td>'.$payment.'</td>
  </tr>';
	}
	
}
else
{
 $message .='<tr>
  <td colspan="4" align="center">No Records Found</td>
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
$mpdf->SetTitle('Report');
$mpdf->keep_table_proportions = false;
$mpdf->shrink_this_table_to_fit = 0;
$mpdf->SetAutoPageBreak(true, 10);
$mpdf->WriteHTML(file_get_contents($filename));
//$mpdf->SetWatermarkImage('jiovio.png', 0.10, 'F');
//$mpdf->showWatermarkImage = true;
$mpdf->setAutoBottomMargin = 'stretch';
//$mpdf->setHTMLFooter('<div style="border-top: 0.1mm solid #000000;"><table width="100%"><tr><td colspan="2" align="center"><b>Healthcare</b></td></tr><tr><td><b>E-mail : </b>'.gethospital('emailid',$appointment['hospitalid']).'</td><td align="right"><b>For Support</b><br>'.gethospital('contactno',$appointment['hospitalid']).'</td></tr></table>');
$filename='report.pdf';
$mpdf->Output($filename, 'D');
?>