<?php
require_once __DIR__ . '/vendor/autoload.php';
include ('../config/config.inc.php');
// error_reporting(1);
// ini_set('display_errors','1');
// error_reporting(E_ALL);
date_default_timezone_set('Asia/Kolkata');
global $db;


if($_REQUEST['fromdate']!='' && $_REQUEST['todate']!='') {
$s1[]="(`invoice_date`>='".date('Y-m-d',strtotime($_REQUEST['fromdate']))."'  AND `invoice_date`<='".date('Y-m-d',strtotime($_REQUEST['todate']))."')";
}
if($_REQUEST['customer']!='')
{
$s1[]="`customer_name`='".$_REQUEST['customer']."'";
}


if(count($s1)>0) {
$s=implode('  AND  ',$s1);
}

$sno=1;

if($s!='') { 
 $stmt = $db->prepare("SELECT * FROM `invoice_transaction` WHERE `id`!='0' AND $s ORDER BY `invoice_date` ASC");
}
else{
$stmt = $db->prepare("SELECT * FROM `invoice_transaction` WHERE `id`!='0' ORDER BY `invoice_date` ASC");  
}

 $stmt->execute();
$checknum1 = $stmt->rowCount();

$message = '
<table style="width:100%; font-family:arial; font-size:15px;border-bottom:1px solid #C72465;" border="1" cellpadding="5" cellspacing="0">
    <tr align="center">
    <th width="5%">Sno</th>
   <th width="10%">Invoice No</th>
  <th width="10%">Invoice Date</th>
  <th align="right" width="10%">Sales Amount</th>
  <th align="center" width="10%">Pay Date</th>
  <th width="10%" align="right">Pay Amount</th>
  <th align="right"  width="10%">Balance</th>
    </tr>';
  if($checknum1>0)
{
  $sno=1;
  $ftotal=0;
  $freceived_amount=0;
  $fbalanceamt=0;
	while ($fdepart = $stmt->fetch(PDO::FETCH_ASSOC)){
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
$ftotal +=$fdepart['total'];
$freceived_amount +=$fdepart['received_amount'];
$fbalanceamt +=$balanceamt;
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
  $message .='<tr>
  <td align="center">'.$sno.'</td>
 <td align="center">'.$fdepart['invoice_no'].'</td>
  <td align="center">'.$idate.'</td>
    <td align="right">'.number_format($fdepart['total'],2).'</td>
    <td align="center">'.$pdate.'</td>
    <td  align="right">'.number_format($fdepart['received_amount'],2).'</td>
       <td align="right">'.number_format($balanceamt,2).'</td>
 </tr>';
 $sno++;
	}
$message .='<tr>
  <td colspan="3" align="center">Total</td>
  <td align="right">'.number_format($ftotal,2).'</td>
<td>&nbsp;</td>
<td align="right">'.number_format($freceived_amount,2).'</td>
<td align="right">'.number_format($fbalanceamt,2).'</td>
</tr>';
   } 
else
{
 $message .='<tr>
  <td colspan="7" align="center">No Records Found</td>
  </tr>';	
}
  $message .='</table>
			';
              

$mpdf=new mPDF('', 'A4-L', 0, '', 10, 10, 50, 0, 0, 'L');
$header ='<br>
<div align="center"><h2 align="center">WORK TOGETHER GROUP</h2></div>
<div align="center"><h3 align="center">Customer Individual Report from '.date('M/d/Y',strtotime($_REQUEST['fromdate'])).' To '.date('M/d/Y',strtotime($_REQUEST['todate'])).'</h3>
</div>
<br>
<table width="100%">
<tr>
<td><strong>Customer Name: '.$_REQUEST['customer'].'</strong></td>
<td align="right"><strong>Page No.: {PAGENO}</strong></td>
</tr>
</table>';
$mpdf->SetHTMLHeader($header);
$mpdf->SetDisplayMode('default');
$mpdf->list_indent_first_level = 0; // 1 or 0 - whether to indent the first level of a list
$filename = "test1.txt";

$file = fopen($filename, "w");
fwrite($file, $message);
$mpdf->SetTitle('Customer Individual Report');
$mpdf->keep_table_proportions = false;
$mpdf->shrink_this_table_to_fit = 0;
$mpdf->SetAutoPageBreak(true, 10);
$mpdf->WriteHTML(file_get_contents($filename));
//$mpdf->SetWatermarkImage('jiovio.png', 0.10, 'F');
//$mpdf->showWatermarkImage = true;
$mpdf->setAutoBottomMargin = 'stretch';
//$mpdf->setHTMLFooter('<div style="border-top: 0.1mm solid #000000;"><table width="100%"><tr><td colspan="2" align="center"><b>Healthcare</b></td></tr><tr><td><b>E-mail : </b>'.gethospital('emailid',$appointment['hospitalid']).'</td><td align="right"><b>For Support</b><br>'.gethospital('contactno',$appointment['hospitalid']).'</td></tr></table>');
$filename='Customer-Individual-report.pdf';
$mpdf->Output($filename, 'D');
?>
