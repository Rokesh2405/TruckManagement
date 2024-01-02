<?php
require_once __DIR__ . '/vendor/autoload.php';
include ('../config/config.inc.php');
error_reporting(1);
ini_set('display_errors','1');
error_reporting(E_ALL);
date_default_timezone_set('Asia/Kolkata');
global $db;


if($_REQUEST['fromdate']!='' && $_REQUEST['todate']!='') {
$s1[]="(date(A.`date`)>='".date('Y-m-d',strtotime($_REQUEST['fromdate']))."'  AND date(A.`date`)<='".date('Y-m-d',strtotime($_REQUEST['todate']))."')";
}
if($_REQUEST['salesman']!='')
{
 $salesmanlist = FETCH_all("SELECT * FROM `salesman` WHERE salesman_name=? ", $_REQUEST['salesman']);
    
$s1[]="B.`salesman_name`='".$salesmanlist['id']."'";
}


if(count($s1)>0) {
$s=implode('  AND  ',$s1);
}

$sno=1;
if($s!='') {
 $stmt = $db->prepare("SELECT A.`salesman_payment_date`,A.`load_no`,A.`date`,A.`salesman`,A.`salesman_commission`,B.`payment_amount` FROM `carrier_confirmation` A, `salesman_settlement` B  WHERE A.`load_no`=B.`load_no` AND $s ORDER BY A.`date` DESC");
}
else{

$stmt = $db->prepare("SELECT A.`salesman_payment_date`,A.`load_no`,A.`date`,A.`salesman`,A.`salesman_commission`,B.`payment_amount` FROM `carrier_confirmation` A, `salesman_settlement` B WHERE A.`load_no`=B.`load_no` ORDER BY A.`date` DESC");  
}



 $stmt->execute();
$checknum1 = $stmt->rowCount();

$message = '<br>
<div align="center"><h2>Sales Individual Report</h2></div>
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
    <th>Load No</th>
    <th>Date</th>
      <th>Salesman Name</th>
      <th>Commission Amt</th>
      <th>Pay Date</th>
      <th>Pay Amount</th>
      <th>Balance</th>
    </tr>';
  if($checknum1>0)
{
  $sno=1;
	while ($fdepart = $stmt->fetch(PDO::FETCH_ASSOC)){
  $salescommission = FETCH_all("SELECT * FROM `salesman_settlement` WHERE load_no=? ", $fdepart['load_no']);
if($salescommission['payment_amount']>$salescommission['settlement_amt']) {
    $balcamt=$salescommission['payment_amount']-$salescommission['settlement_amt'];
}
if($salescommission['payment_amount']<$salescommission['settlement_amt']) {
    $balcamt=$salescommission['settlement_amt']-$salescommission['payment_amount'];
}

  $message .='<tr>
  <td>'.$sno.'</td>
 <td>'.$fdepart['load_no'].'</td>
  <td>'.date('d-m-Y',strtotime($fdepart['date'])).'</td>
    <td>'.getsalesman('salesman_name',$salescommission['salesman_name']).'</td>
    <td>'.$salescommission['settlement_amt'].'</td>
    <td>'.date('d-m-Y',strtotime($salescommission['payment_date'])).'</td>
    <td>'.$salescommission['payment_amount'].'</td>
    <td>'.$balcamt.'</td>
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
$mpdf->SetTitle('Sales Individual Report');
$mpdf->keep_table_proportions = false;
$mpdf->shrink_this_table_to_fit = 0;
$mpdf->SetAutoPageBreak(true, 10);
$mpdf->WriteHTML(file_get_contents($filename));
//$mpdf->SetWatermarkImage('jiovio.png', 0.10, 'F');
//$mpdf->showWatermarkImage = true;
$mpdf->setAutoBottomMargin = 'stretch';
//$mpdf->setHTMLFooter('<div style="border-top: 0.1mm solid #000000;"><table width="100%"><tr><td colspan="2" align="center"><b>Healthcare</b></td></tr><tr><td><b>E-mail : </b>'.gethospital('emailid',$appointment['hospitalid']).'</td><td align="right"><b>For Support</b><br>'.gethospital('contactno',$appointment['hospitalid']).'</td></tr></table>');
$filename='Sales-Individual-report.pdf';
$mpdf->Output($filename, 'D');
?>
