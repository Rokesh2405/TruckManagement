<?php
require_once __DIR__ . '/vendor/autoload.php';
include ('../config/config.inc.php');

date_default_timezone_set('Asia/Kolkata');
global $db;


if($_REQUEST['fromdate']!='' && $_REQUEST['todate']!='') {
$s1[]="(date(`date`)>='".date('Y-m-d',strtotime($_REQUEST['fromdate']))."'  AND date(`date`)<='".date('Y-m-d',strtotime($_REQUEST['todate']))."')";
}
if($_REQUEST['carrier']!='')
{
$s1[]="`carrier`='".$_REQUEST['carrier']."'";
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

$message = '<table style="width:100%; font-family:arial; font-size:14px;border-bottom:1px solid #C72465;" border="1" cellpadding="5" cellspacing="0">
    <tr align="center">
    <th>Sno</th>
    <th>Load No</th>
    <th>Date</th>
    <th>Pickup Date</th>
    <th>Pickup Time</th>
    <th>Delivery Date</th>
    <th>Cheque No</th>
    <th>Amount</th>
    <th>Pay Date</th>
    <th>Pay Amt</th>
    <th>Balance</th>
    </tr>';
  if($checknum1>0)
{
  $sno=1;
    $ftotal=0;
  $freceived_amount=0;
  $fbalanceamt=0;
	while ($fdepart = $stmt->fetch(PDO::FETCH_ASSOC)){
    if($fdepart['payment']!=$fdepart['bill_amount']) {  
		   if($fdepart['payment']=='')
    {
$balanceamt=$fdepart['bill_amount'];
    }
elseif($fdepart['payment']<$fdepart['bill_amount']) {
$balanceamt=$fdepart['bill_amount']-$fdepart['payment'];
}
else
{
 $balanceamt=0;   
}
if($fdepart['payment_date']!='')
{
$pdate=date('d-m-Y',strtotime($fdepart['payment_date']));
}
else
{
$pdate='';
}
$ftotal +=$fdepart['bill_amount'];
$freceived_amount +=$fdepart['payment'];
$fbalanceamt +=$balanceamt;

  $message .='<tr>
  <td align="center">'.$sno.'</td>
 <td align="center">'.$fdepart['load_no'].'</td>
  <td align="center">'.date('d-m-Y',strtotime($fdepart['date'])).'</td>
  <td align="center">'.date('d-m-Y',strtotime($fdepart['pickup_date'])).'</td>
  <td align="center">'.date('h:i a',strtotime($fdepart['pickup_time'])).'</td>
  <td align="center">'.date('d-m-Y',strtotime($fdepart['delivery_date'])).'</td>
  <td align="center">'.$fdepart['cheque_no'].'</td>
  <td align="right">'.number_format($fdepart['bill_amount'],2).'</td>
  <td align="center">'.$pdate.'</td>
  <td align="right">'.number_format($fdepart['payment'],2).'</td>
  <td align="right">'.number_format($balanceamt,2).'</td>
 </tr>';
 $sno++;
	} } 
	$message .='<tr>
  <td colspan="7" align="center"><strong>Total</strong></td>
  <td align="right">'.number_format($ftotal,2).'</td>
<td>&nbsp;</td>
<td align="right">'.number_format($freceived_amount,2).'</td>
<td align="right">'.number_format($fbalanceamt,2).'</td>
</tr>';
}
else
{
 $message .='<tr>
  <td colspan="11" align="center">No Records Found</td>
  </tr>';	
}
  $message .='</table>
			';
              

$mpdf=new mPDF('', 'A4-L', 0, '', 10, 10, 50, 0, 0, 'L');
$header ='<br>
<div align="center"><h2 align="center">WORK TOGETHER GROUP</h2></div>
<div align="center"><h3 align="center">Carrier Individual Report from '.date('M/d/Y',strtotime($_REQUEST['fromdate'])).' To '.date('M/d/Y',strtotime($_REQUEST['todate'])).'</h3>
</div>
<br>
<table width="100%">
<tr>
<td><strong>Carrier Name: '.$_REQUEST['carrier'].'</strong></td>
<td align="right"><strong>Page No.: {PAGENO}</strong></td>
</tr>
</table>';
$mpdf->SetHTMLHeader($header);
$mpdf->SetDisplayMode('default');
$mpdf->list_indent_first_level = 0; // 1 or 0 - whether to indent the first level of a list
$filename = "test1.txt";

$file = fopen($filename, "w");
fwrite($file, $message);
$mpdf->SetTitle('Carrier Individual Report');
$mpdf->keep_table_proportions = false;
$mpdf->shrink_this_table_to_fit = 0;
$mpdf->SetAutoPageBreak(true, 10);
$mpdf->WriteHTML(file_get_contents($filename));
//$mpdf->SetWatermarkImage('jiovio.png', 0.10, 'F');
//$mpdf->showWatermarkImage = true;
$mpdf->setAutoBottomMargin = 'stretch';
//$mpdf->setHTMLFooter('<div style="border-top: 0.1mm solid #000000;"><table width="100%"><tr><td colspan="2" align="center"><b>Healthcare</b></td></tr><tr><td><b>E-mail : </b>'.gethospital('emailid',$appointment['hospitalid']).'</td><td align="right"><b>For Support</b><br>'.gethospital('contactno',$appointment['hospitalid']).'</td></tr></table>');
$filename='Carrier-Individual-report.pdf';
$mpdf->Output($filename, 'D');
?>
