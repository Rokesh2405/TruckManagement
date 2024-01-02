<?php
require_once __DIR__ . '/vendor/autoload.php';
include ('../config/config.inc.php');
error_reporting(1);
ini_set('display_errors','1');
error_reporting(E_ALL);
date_default_timezone_set('Asia/Kolkata');
global $db;


if($_REQUEST['fromdate']!='' && $_REQUEST['todate']!='') {
$s1[]="(date(`date`)>='".date('Y-m-d',strtotime($_REQUEST['fromdate']))."'  AND date(`date`)<='".date('Y-m-d',strtotime($_REQUEST['todate']))."')";
}


if(count($s1)>0) {
$s=implode('  AND  ',$s1);
}

$sno=1;
if($s!='') { 
 $stmt = $db->prepare("SELECT * FROM `carrier_confirmation` WHERE `id`!='0' AND $s ORDER BY `date` DESC");
}
else{
$stmt = $db->prepare("SELECT * FROM `carrier_confirmation` WHERE `id`!='0' ORDER BY `date` DESC");  
}

 $stmt->execute();
$checknum1 = $stmt->rowCount();

$message = '<br>
<div align="center"><h2>Carrier Report</h2></div>
<br>
<div align="left">
<strong>From Date</strong>:&nbsp;&nbsp;&nbsp;&nbsp;'.date('d-m-Y',strtotime($_REQUEST['fromdate'])).'
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<strong>To Date</strong>:&nbsp;&nbsp;&nbsp;&nbsp;'.date('d-m-Y',strtotime($_REQUEST['todate'])).'
</div>
<br><br>
<table style="width:100%; font-family:arial; font-size:20px;border-bottom:1px solid #C72465;" border="1" cellpadding="5" cellspacing="0">
    <tr align="center">
    <th >Sno</th>
    <th>Load No</th>
    <th>Date</th>
    <th>Carrier Name</th>
    <th>Pickup Date</th>
    <th>Pickup Time</th>
    <th>Delivery Date</th>
    <th >Delivery Time</th>
    <th >Amount</th>
    <th >Pay Date</th>
    <th >Pay Amt</th>
    <th >Balance</th>
    </tr>';
  if($checknum1>0)
{
  $sno=1;
	while ($fdepart = $stmt->fetch(PDO::FETCH_ASSOC)){
		   if($fdepart['payment_amount']=='')
    {
$balanceamt=$fdepart['bill_amount'];
    }
elseif($fdepart['payment_amount']<$fdepart['bill_amount']) {
$balanceamt=$fdepart['bill_amount']-$fdepart['payment_amount'];
}
else
{
 $balanceamt=0;   
}
  $message .='<tr>
  <td>'.$sno.'</td>
 <td>'.$fdepart['load_no'].'</td>
  <td>'.date('d-m-Y',strtotime($fdepart['date'])).'</td>
    <td>'.$fdepart['carrier'].'</td>
    <td>'.date('d-m-Y',strtotime($fdepart['pickup_date'])).'</td>
    <td>'.date('h:i a',strtotime($fdepart['pickup_time'])).'</td>
    <td>'.date('d-m-Y',strtotime($fdepart['delivery_date'])).'</td>
    <td>'.date('h:i a',strtotime($fdepart['delivery_time'])).'</td>
    <td>'.$fdepart['bill_amount'].'</td>
    <td>'.date('d-m-Y',strtotime($fdepart['payment_date'])).'</td>
     <td>'.$fdepart['payment_amount'].'</td>
       <td>'.$balanceamt.'</td>
 </tr>';
 $sno++;
	}
	
}
else
{
 $message .='<tr>
  <td colspan="12" align="center">No Records Found</td>
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
$mpdf->SetTitle('Carrier Report');
$mpdf->keep_table_proportions = false;
$mpdf->shrink_this_table_to_fit = 0;
$mpdf->SetAutoPageBreak(true, 10);
$mpdf->WriteHTML(file_get_contents($filename));
//$mpdf->SetWatermarkImage('jiovio.png', 0.10, 'F');
//$mpdf->showWatermarkImage = true;
$mpdf->setAutoBottomMargin = 'stretch';
//$mpdf->setHTMLFooter('<div style="border-top: 0.1mm solid #000000;"><table width="100%"><tr><td colspan="2" align="center"><b>Healthcare</b></td></tr><tr><td><b>E-mail : </b>'.gethospital('emailid',$appointment['hospitalid']).'</td><td align="right"><b>For Support</b><br>'.gethospital('contactno',$appointment['hospitalid']).'</td></tr></table>');
$filename='Carrier-report.pdf';
$mpdf->Output($filename, 'D');
?>
