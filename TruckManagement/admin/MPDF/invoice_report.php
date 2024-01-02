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

$pickupdetails=date('d/m/Y',strtotime($carrierinfodetails['pickup_date'])).' '.$carrierinfodetails['pickup_time'];
}
else
{
$pickupdetails="";
}
if($carrierinfodetails['delivery_date']!='') {

$deliverydetails=date('d/m/Y',strtotime($carrierinfodetails['delivery_date'])).' '.$carrierinfodetails['delivery_time'];
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
$message = '
<table width="100%">
<tr>
<td>'.$cusdetails['customer_name'].'<br>
'.$address.'<br> '.$cusdetails['city'].','.$cusdetails['province_state'].'<br> '.$cusdetails['country'].'<br> '.$cusdetails['posta_zip_code'].' <br>Email#:'.$cusdetails['email_dispatch'].'<br>Ph#:'.$cusdetails['telephone_admin'].'</td>
<td valign="top" align="right">
<table width="100%">
<tr>
<td colspan="2" align="center">&nbsp;</td>
</tr>

<tr>
<td>
<table style=" border: 1px solid;" cellpadding="5">
<tr>
<td>INVOICE NO</td></tr>
</table></td>
<td><table style=" border: 1px solid;" cellpadding="5">
<tr>
<td>INVOICE DATE</td></tr>
</table></td>
</tr>
<tr>
<td align="center">'.$getdetails['invoice_no'].'</td>
<td align="center">'.date('M/d/Y',strtotime($getdetails['invoice_date'])).'</td>
</tr>
<tr>
<td colspan="2" align="center">&nbsp;</td>
</tr>

<tr>
<td colspan="2" align="center">
<table style=" border: 1px solid;" cellpadding="5" width="100%">
<tr>
<td>CUSTOMER NO</td></tr>
</table></td>
</tr>
<tr>
<td colspan="2" align="center">'.$getdetails['customer_no'].'</td>
</tr>
</table>
</td>

</tr>
<tr>

</table>
<table width="60%">
<tr>
<td><strong>Truck:</strong></td>
<td><strong>Trailer</strong></td>
</tr>
</table>
<table width="100%" style=" border: 1px solid;">
<tr>
<td>Shipment#</td>
<td>PickUp#</td>
<td>Date</td>
</tr>
<tr>
<td valign="top">'.$getdetails['shipment_no'].'</td>
<td>
<table>
<tr>
<td><strong>Shipper :</strong></td>
<td>'.$carrierinfodetails['pickup_contact'].'<br>'.$carrierinfodetails['pickup_address'].'</td>
</tr>
<tr>
<td><strong>Receiver :</strong></td>
<td>'.$carrierinfodetails['delivery_contact'].'<br>'.$carrierinfodetails['delivery_address'].'</td>
</tr>
<tr>
<td><strong>Shipment :</strong></td>
<td>All</td>
</tr>';
if($getdetails['hst']=='NO HST') {
$message .='<tr>
<td><strong>'.$lhst.' :</strong></td>
<td>'.$getdetails['hst'].'</td>
</tr>';
}
else 
{
$message .='<tr>
<td colspan="2"><strong>'.$getdetails['hst'].'</strong></td>
</tr>';
}
$message .='<tr>
<td><strong>Currency :</strong></td>
<td>'.$getdetails['rate_currency'].'</td>
</tr>
</table>
</td>
<td valign="top"><table>
<tr>
<td>'.$pickupdetails.'</td> </td>
</tr>
<tr>
<td>'.$deliverydetails.'</td></td>
</tr>
</table></td>
</tr>
</table>
<table width="100%" style=" border: 1px solid;" cellpadding="5">
<tr>
<td><strong>Shipment#</strong></td>
<td><strong>Charges</strong></td>
<td><strong>Description</strong></td>
<td><strong>UOM</strong></td>
<td><strong>Qty</strong></td>
<td><strong>Rate</strong></td>
<td><strong>Charge</strong></td>
</tr>
<tr>
<td>All</td>
<td>Fright</td>
<td>'.$carrierinfodetails['delivery_description'].'</td>
<td>&nbsp;</td>
<td>'.$getdetails['qty'].'</td>
<td>'.number_format($getdetails['rate'],2).'</td>
<td>'.number_format($getdetails['charge'],2).'</td>
</tr>
</table>
<table width="100%">
<tr>
<td valign="top" width="60%">
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
<td valign="top" width="50%" align="right">
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
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td colspan="5">
<h3>Terms and Conditions</h3>
<br>
<!--<p>WORK TOGETHER GROUP INC DOES ALL PICKUP AND DELIVERY APPOINTMENTS PLEASE DO NOT CONTACT SHIPPER OR CONSIGNEE UNDER ANY CIRCUMSTANCES. Driver must identify himself as Work Together Group. Inless mentioned otherwise</p>-->
<br><p>Thank you for your business.</p>
<br><p>Please pay within the one-week date you receive the invoice any late payment charges are 3% daily until we receive the payment.</p>
</td>

</td>
</tr>
</table>
<p>&nbsp;</p>
<table width="100%" style=" border: 1px solid;">
<tr>
<td><strong>Note : </strong>'.$getdetails['note'].'</td>
</tr>
</table>
';
              

$mpdf=new mPDF('utf-8','A4','','','15','15','49','18');
$mpdf->SetHTMLHeader('<table width="100%">
<tr>
<td width="40%" valign="top"><div align="center">
<img src="'.$sitename.'invoice-logo.png"></div>
</div>
<div align="center" style="font-size:14px;"><strong>WORK TOGETHER GROUP INC.<br>Work Together Grow Together</strong></div></td>
<td>WORK TOGETHER GROUP INC<br>
15-7955 Torbram Road <br>Brampton, Ontario, L6T 5B9<br> Canada<br>PH#:905-247-6111 , FAX#: 905-247-5993<br>
Email: accounts@worktogethergroup.ca</td>
<td valign="top"><h2>INVOICE</h2></td>
</tr>
</table>');

$mpdf->SetDisplayMode('default');
$mpdf->list_indent_first_level = 0; // 1 or 0 - whether to indent the first level of a list
$filename = "test1.txt";

$file = fopen($filename, "w");
fwrite($file, $message);
$mpdf->SetTitle('Invoice Transaction');

$mpdf->keep_table_proportions = false;
$mpdf->shrink_this_table_to_fit = 0;
$mpdf->SetAutoPageBreak(true, 10);
//$mpdf->setHTMLheader('<div style="border-top: 0.1mm solid #000000;"><table width="100%"><tr><td colspan="2" align="center"><img src="'.$sitename.'invoice-logo.png"></td></tr></table>');

$mpdf->WriteHTML(file_get_contents($filename));
//$mpdf->SetWatermarkImage('jiovio.png', 0.10, 'F');
//$mpdf->showWatermarkImage = true;
$mpdf->setAutoBottomMargin = 'stretch';

// $mpdf->setHTMLheader('<div style="border-top: 0.1mm solid #000000;"><table width="100%"><tr><td colspan="2" align="center"><b>Healthcare</b></td></tr><tr><td><b>E-mail : </b>'.gethospital('emailid',$appointment['hospitalid']).'</td><td align="right"><b>For Support</b><br>'.gethospital('contactno',$appointment['hospitalid']).'</td></tr></table><div>
// <table width="100%">
// <tr>
// <td width="40%" valign="top"><div align="center">
// <img src="'.$sitename.'invoice-logo.png"></div>
// </div>
// <div align="center" style="font-size:14px;"><strong>WORK TOGETHER GROUP INC.<br>Work Together Group Together</strong></div></td>
// <td>WORK TOGETHER GROUP INC<br>
// 59118 WESTMOOD MALL ,<br> MISSISSAUGA ON L4T 4JI CANADA <br>PH#::905-247-6111 , 905-247-5993<br>
// Email: harry@worktogethergroup.ca</td>
// <td valign="top"><h2>INVOICE</h2></td>
// </tr>
// </table></div>');
//$mpdf->setHTMLFooter('<div style="border-top: 0.1mm solid #000000;"><table width="100%"><tr><td colspan="2" align="center"><b>Healthcare</b></td></tr><tr><td><b>E-mail : </b>'.gethospital('emailid',$appointment['hospitalid']).'</td><td align="right"><b>For Support</b><br>'.gethospital('contactno',$appointment['hospitalid']).'</td></tr></table>');
$filename='invoice-transaction.pdf';
if($_REQUEST['type']=='download') {
	$mpdf->Output($filename, 'D');
}else {
$mpdf->Output($filename, 'I');
}
?>
