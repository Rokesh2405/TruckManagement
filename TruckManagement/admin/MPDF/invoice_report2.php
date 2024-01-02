<?php
require_once __DIR__ . '/vendor/autoload.php';
include ('../config/config.inc.php');
error_reporting(1);
ini_set('display_errors','1');
error_reporting(E_ALL);
date_default_timezone_set('Asia/Kolkata');
global $db;



//update invoice status
$ginvoice = $db->prepare("UPDATE `invoice_transaction` SET `invoice_status`=? WHERE `id`=? ");
$ginvoice->execute(array(1,$_REQUEST['id']));
//update invoice status

$getdetails = FETCH_all("SELECT * FROM `invoice_transaction` WHERE id=?", $_REQUEST['id']);

$cusdetails = FETCH_all("SELECT * FROM `customer` WHERE customer_name=?", $getdetails['customer_name']);
$carrierinfodetails = FETCH_all("SELECT * FROM `carrier_confirmation` WHERE load_no=?", $getdetails['load_no']);
if($carrierinfodetails['pickup_date']!='') {
$pickupdetails=date('d/m/Y',strtotime($carrierinfodetails['pickup_date']));

//$pickupdetails=date('d/m/Y',strtotime($carrierinfodetails['pickup_date'])).' '.$carrierinfodetails['pickup_time'];
}
else
{
$pickupdetails="";
}
if($carrierinfodetails['delivery_date']!='') {
$deliverydetails=date('d/m/Y',strtotime($carrierinfodetails['delivery_date']));

//$deliverydetails=date('d/m/Y',strtotime($carrierinfodetails['delivery_date'])).' '.$carrierinfodetails['delivery_time'];
}
else
{
$deliverydetails="";
}
if($getdetails['payment_date']!='') {
	$paymentdate=date('M/d/Y',strtotime($getdetails['payment_date']));
}
else
{
 $paymentdate="";	
}


if($getdetails['cheque_date']!='') {
$chqdate=date('M/d/Y',strtotime($getdetails['cheque_date']));
}
else
{
$chqdate="";	
}

// $carrierdetails = FETCH_all("SELECT * FROM `carrier` WHERE customer_name=?", $getdetails['carrier']);
// $pickupdetails = FETCH_all("SELECT * FROM `pickup` WHERE contact_name=?", $getdetails['contact']);
$address=$cusdetails['customer_address'].','.$cusdetails['customer_address1'];
if($getdetails['hst']=='GST') {
$lhst="GST";
}
else
{
$lhst="HST";	
}

$message = '<table width="100%">


<tr>
<td valign="top" width="50%">
<table border="1" cellpadding="10" cellspacing="0" style="width:630px;">
<tr>
<td>
<strong>WORK TOGETHER GROUP INC</strong><br><br>15-7955 Torbram Road <br>Brampton, Ontario, L6T 5B9<br> Canada<br>Ph#:905-247-6111 , Fax#: 905-247-5993<br> Mailid#: info@worktogethergroup.ca<br>website#: www.worktogethergroup.ca
</td></tr></table>
</td>
<td align="right">
<table border="0" cellpadding="10" cellspacing="0" >
<tr>
<td><img src="'.$sitename.'invoice-logo.png"></td>
</tr>
</table>
</td>
</tr>
</table>
<br>
<table width="100%">
<tr>
<td  width="50%"><h3 style="padding-left:5px;">Invoice To :</h3></td>
<td  width="50%" align="right"><h5 style="padding-left:5px;">Invoice </h5></td>
</tr>
<tr>
<td valign="top" width="50%">
<table border="1" cellpadding="10" cellspacing="0" style="width:630px;">
<tr>
<td>
<strong>'.$cusdetails['customer_name'].'<br>
'.$address.'<br> '.$cusdetails['city'].','.$cusdetails['province_state'].'<br> '.$cusdetails['country'].'<br> '.$cusdetails['posta_zip_code'].' <br>Email#:'.$cusdetails['email_dispatch'].'<br>Ph#:'.$cusdetails['telephone_admin'].'
</td></tr></table>
</td>
<td align="right">
<table border="1" cellpadding="10" cellspacing="0" >
<tr>
<td>
<strong>Invoice#: </strong>
</td>
<td>'.$getdetails['invoice_no'].'</td>
</tr>
<tr>
<td>
<strong>Date#: </strong>
</td>
<td>'.date('M/d/Y',strtotime($getdetails['invoice_date'])).'</td>
</tr>
</table>
</td>
</tr>
</table>
<br>
<table width="100%">
<tr>
<td width="60%">Order #'.$getdetails['load_no'].' Dated '.date('M/d/Y',strtotime($getdetails['invoice_date'])).'</td>
<td>&nbsp;</td>
</tr>
</table>
<br>
<table width="100%" border="1" cellpadding="4" cellspacing="0">
<tr>
<td valign="top"><strong>Item</strong></td>
<td valign="top"><strong>Shipper</strong></td>
<td valign="top"><strong>Pick-up Date</strong></td>
<td valign="top"><strong>Consignee</strong></td>
<td valign="top"><strong>Delivery Date</strong></td>
<td valign="top"><strong>Amount</strong></td>
</tr>
<tr>
<td  valign="top">F.Load</td>
<td valign="top" height="60%">'.$carrierinfodetails['pickup_contact'].'<br>'.$carrierinfodetails['pickup_address'].'</td>
<td valign="top">'.$pickupdetails.'</td>
<td valign="top">'.$carrierinfodetails['delivery_contact'].'<br>'.$carrierinfodetails['delivery_address'].'</td>
<td valign="top">'.$deliverydetails.'</td>
<td  valign="top" style="height:400px;">$'.number_format($getdetails['charge'],2).'</td>
</tr>


</table>
<br><table width="100%">
<tr>
<td valign="top" width="40%">
<table style=" border: 1px solid;" width="100%" cellpadding="5">
<tr>
<td style="font-size:16px;">Payment Type:</td>
<td>&nbsp;</td>
<td>'.$getdetails['payment_type'].'</td>
</tr>
<tr>
<td style="font-size:16px;">Payment Date:</td>
<td>&nbsp;</td>
<td>'.$paymentdate.'</td>
</tr>
<tr>
<td style="font-size:16px;">Cheque No:</td>
<td>&nbsp;</td>
<td>'.$getdetails['cheque_no'].'</td>
</tr>
<tr>
<td style="font-size:16px;">Cheque Date:</td>
<td>&nbsp;</td>
<td>'.$chqdate.'</td>
</tr>
</table>
</td>
<td valign="top" width="30%" align="center">'.$getdetails['note'].'</td>
<td valign="top" width="40%" align="right">
<table style=" border: 1px solid;" width="100%" cellpadding="5">
<tr>
<td style="font-size:16px;">Sub Total:</td>
<td>&nbsp;</td>
<td>'.number_format($getdetails['charge'],2).'</td>
</tr>';

if($getdetails['hst']=='HST' || $getdetails['hst']=='GST') {
	$taxvalue=$getdetails['tax'];
if($getdetails['hst_percent']!='') {
$hpercent=$getdetails['hst_percent'];
}
else
{
$hpercent="13";	
}
$message .='<tr>
<td style="font-size:16px;">'.$lhst.' '.$hpercent.'%:</td>
<td>&nbsp;</td>
<td>'.number_format($taxvalue,2).'</td>
</tr>';
$total=$getdetails['charge']+$taxvalue;
$fintot=$total-$getdetails['received_amount'];
}
else
{
	$total=$getdetails['charge'];
$fintot=$total-$getdetails['received_amount'];

}

$message .='<tr>
<td style="font-size:16px;"><strong>TOTAL DUE:</strong></td>
<td>&nbsp;</td>
<td>'.number_format($total,2).'</td>
</tr>
<tr>
<td style="font-size:16px;"><strong>PAYMENT:</strong></td>
<td>&nbsp;</td>
<td>'.number_format($getdetails['received_amount'],2).'</td>
</tr>
<tr>
<td style="font-size:16px;"><strong>BALANCE DUE:</strong></td>
<td>&nbsp;</td>
<td>'.number_format($fintot,2).'</td>
</tr>
</table>
</td>
</tr>
</table>';

  
 $mpdf=new mPDF('', 'A4', 0, '', 10, 10, 0, 0, 0, 'L');
//$mpdf=new mPDF('utf-8','A4','0','','20','20','65','10');
// $mpdf->SetHTMLHeader('<br>
// <div align="center">
// <img src="'.$sitename.'invoice-logo.png"></div>
// </div>
// <div align="center" style="font-size:14px;height:20%;"><strong>WORK TOGETHER GROUP INC.<br>Work Together Grow Together</strong></div><div align="center">&nbsp;</div>');
$mpdf->SetDisplayMode('default');
$mpdf->list_indent_first_level = 0; // 1 or 0 - whether to indent the first level of a list
$filename = "test1.txt";

$file = fopen($filename, "w");
fwrite($file, $message);
$mpdf->SetTitle('Invoice Transaction');
$mpdf->keep_table_proportions = false;
$mpdf->shrink_this_table_to_fit = 0;
$mpdf->SetAutoPageBreak(true, 10);
$mpdf->WriteHTML(file_get_contents($filename));
//$mpdf->SetWatermarkImage('jiovio.png', 0.10, 'F');
//$mpdf->showWatermarkImage = true;
$mpdf->setAutoBottomMargin = 'stretch';
//$mpdf->setHTMLFooter('<div style="border-top: 0.1mm solid #000000;"><table width="100%"><tr><td colspan="2" align="center"><b>Healthcare</b></td></tr><tr><td><b>E-mail : </b>'.gethospital('emailid',$appointment['hospitalid']).'</td><td align="right"><b>For Support</b><br>'.gethospital('contactno',$appointment['hospitalid']).'</td></tr></table>');
$filename='invoice-transaction.pdf';
if($_REQUEST['type']=='download') {
	$mpdf->Output($filename, 'D');
}else {
$mpdf->Output($filename, 'I');
}

?>
