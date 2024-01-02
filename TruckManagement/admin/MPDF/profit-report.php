<?php
require_once __DIR__ . '/vendor/autoload.php';
include ('../config/config.inc.php');

date_default_timezone_set('Asia/Kolkata');
global $db;
$s='';
$s1=array();

if($_REQUEST['fromdate']!='' && $_REQUEST['todate']!='') {
$s1[]="(A.`book_date`>='".date('Y-m-d',strtotime($_REQUEST['fromdate']))."'  AND A.`book_date`<='".date('Y-m-d',strtotime($_REQUEST['todate']))."')";
}


if(count($s1)>0) {
$s=implode('  AND  ',$s1);
}

$sno=1;

if($s!='') { 

 $stmt = $db->prepare("SELECT A.`book_date`,A.`bill_amount`,B.`rate`,B.`invoice_no`,B.`customer_name`,A.`load_no` FROM `carrier_confirmation` AS A ,`invoice_transaction` AS B WHERE A.`load_no`=B.`load_no` AND $s ORDER BY A.`id` DESC");
}
else{
$stmt = $db->prepare("SELECT A.`book_date`,A.`bill_amount`,B.`rate`,B.`invoice_no`,B.`customer_name`,A.`load_no` FROM `carrier_confirmation` AS A ,`invoice_transaction` AS B WHERE A.`load_no`=B.`load_no` ORDER BY A.`id` DESC");  
}

 $stmt->execute();
$checknum1 = $stmt->rowCount();


$message = '
<table style="width:100%; font-family:arial; font-size:15px;border-bottom:1px solid #C72465;" border="1" cellpadding="5" cellspacing="0">
    <tr align="center">
    <th>Sno</th>
    <th>Book Date</th>
    <th>Load No</th>
    <th>Invoice No</th>
    <th>Customer Name</th>
    <th align="right">Load</th>
    <th align="right">Invoice</th>
    <th align="right">Commission</th>
    <th align="right">Profit</th>
    </tr>';
  if($checknum1>0)
{
  $sno=1;
	while ($fdepart = $stmt->fetch(PDO::FETCH_ASSOC)){
	$salesmanrept = FETCH_all("SELECT * FROM salesman_settlement WHERE load_no=?", $fdepart['load_no']);
//if($fdepart['rate']!='' && $fdepart['bill_amount']!='' && $fdepart['settlement_amt']!='') {
$fintot=$fdepart['rate'];
if(!empty($fdepart['bill_amount']))
{
if(is_null($fdepart['bill_amount'])) {

}else{
$fintot=$fintot-$fdepart['bill_amount'];
}
}

if(!empty($salesmanrept['settlement_amt']))
{
$fintot=$fintot-$salesmanrept['settlement_amt'];
}
$loadval +=$fdepart['bill_amount'];
$invalue +=$fdepart['rate'];
$selamt +=$salesmanrept['settlement_amt'];
$finamt +=$fintot;
  $message .='<tr>
  <td align="center">'.$sno.'</td>
 <td align="center">'.date('d-m-Y',strtotime($fdepart['book_date'])).'</td>
  <td align="center">'.$fdepart['load_no'].'</td>
    <td align="center">'.$fdepart['invoice_no'].'</td>
    <td>'.$fdepart['customer_name'].'</td>
    <td align="right">'.number_format($fdepart['bill_amount'],2).'</td>
    <td align="right">'.number_format($fdepart['rate'],2).'</td>
    <td align="right">'.number_format($salesmanrept['settlement_amt'],2).'</td>
    <td align="right">'.number_format($fintot,2).'</td>
 </tr>';
 $sno++;
	}
 $message .='<tr>
  <td colspan="5" align="center">Total</td>
  <td align="right">'.number_format($loadval,2).'</td>
<td align="right">'.number_format($invalue,2).'</td>
<td align="right">'.number_format($selamt,2).'</td>
<td align="right">'.number_format($finamt,2).'</td>
</tr>';

}
else
{
 $message .='<tr>
  <td colspan="9" align="center">No Records Found</td>
  </tr>';	
}
  $message .='</table>';
          
$mpdf=new mPDF('', 'A4-L', 0, '', 10, 10, 50, 0, 0, 'L');
$header ='<br>
<div align="center"><h2 align="center">WORK TOGETHER GROUP</h2></div>
<div align="center"><h3 align="center">Profit & Loss A/c from '.date('M/d/Y',strtotime($_REQUEST['fromdate'])).' To '.date('M/d/Y',strtotime($_REQUEST['todate'])).'</h3>
</div>
<br>
<table width="100%">
<tr>
<td><strong>Run Date: '.date('M/d/Y').'</strong></td>
<td align="right"><strong>Page No.: {PAGENO}</strong></td>
</tr>
</table>';
$mpdf->SetHTMLHeader($header);
$mpdf->SetDisplayMode('default');
$mpdf->list_indent_first_level = 0; // 1 or 0 - whether to indent the first level of a list
$filename = "test1.txt";


$file = fopen($filename, "w");
fwrite($file, $message);
$mpdf->SetTitle('Profit & Loss Report');
$mpdf->keep_table_proportions = false;
$mpdf->shrink_this_table_to_fit = 0;
$mpdf->SetAutoPageBreak(true, 10);
$mpdf->WriteHTML(file_get_contents($filename));
//$mpdf->SetWatermarkImage('jiovio.png', 0.10, 'F');
//$mpdf->showWatermarkImage = true;
$mpdf->setAutoBottomMargin = 'stretch';

//$mpdf->SetFooter('{PAGENO}');
//$mpdf->setHTMLFooter('<div style="border-top: 0.1mm solid #000000;">Page No : {PAGENO}');
$filename='Profit-Report.pdf';
$mpdf->Output($filename, 'D');
?>
