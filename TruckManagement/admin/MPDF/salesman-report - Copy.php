<?php
require_once __DIR__ . '/vendor/autoload.php';
include ('../config/config.inc.php');
error_reporting(1);
ini_set('display_errors','1');
error_reporting(E_ALL);
date_default_timezone_set('Asia/Kolkata');
global $db;
$getdetails = FETCH_all("SELECT * FROM `carrier_confirmation` WHERE id=?", $_REQUEST['id']);

$balanceamt=$getdetails['bill_amount']-$getdetails['payment'];
$carrierdetails = FETCH_all("SELECT * FROM `carrier` WHERE customer_name=?", $getdetails['carrier']);
$pickupdetails = FETCH_all("SELECT * FROM `pickup` WHERE company_name=?", $getdetails['pickup_contact']);
$deliverydetails = FETCH_all("SELECT * FROM `pickup` WHERE company_name=?", $getdetails['delivery_contact']);

$message = '<br>
<div align="center">
<img src="'.$sitename.'invoice-logo.png"></div>
</div>
<div align="center" style="font-size:14px;"><strong>WORK TOGETHER GROUP INC.</strong></div>
<div align="center" style="font-size:20px;"><hr style="color:black;"><strong>CARRIER CONFIRMATION</strong><hr  style="color:black;"></div>
<div align="center" style="font-size:12px;">59118 Westmood Mall, Mississauga, ON , L4T 4JI Ph#:416-788-4011 Fax#:<hr  style="color:black;">
</div>
<div class="center" style="font-size:19px;">
<strong>Load Number : '.$getdetails['load_no'].'</strong>
</div>
<br>
<div class="center">
Booked By: '.$getdetails['booked_by'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$getdetails['book_date'].' '.$getdetails['book_time'].'</div>
<hr style="height:5px;color:black;">
<table width="80%" align="center" cellpadding="5" cellspacing="0">
<tr>
<td width="10%" valign="top">Carrier</td>
<td valign="top"><strong>'.$carrierdetails['customer_name'].'<br>'.$carrierdetails['customer_address'].'<br>'.$carrierdetails['customer_address1'].'</strong></td>
</tr>
<tr>
<td valign="top">Contact</td>
<td><strong>'.$getdetails['contact'].'</strong>
<table width="100%">
<tr> 
<td>Ph#:'.$pickupdetails['phoneno'].'<td>
<td width="10%">&nbsp;</td>
<td>Fax#:</td>
</tr>
<tr> 
<td>Rate:<td>
<td width="10%">&nbsp;</td>
<td>$'.$getdetails['bill_amount'].'</td>
</tr>
</table>
</td>
</tr>
</table>
<p><strong>Note:</strong></p>
<hr style="height:5px;color:black;">
<table width="100%">
<tr>
<td width="50%">
<table width="100%" cellpadding="10">
<tr>
<td><strong>Pickup At</strong></td>
<td>Date</td>
<td>'.date('m/d/Y',strtotime($getdetails['pickup_date'])).'</td>
<td>'.$getdetails['pickup_time'].'</td>
</tr>
<tr>
<td  valign="top">Name</td>
<td colspan="3"><strong>'.$pickupdetails['company_name'].'<br>'.$getdetails['pickup_address'].'</strong></td>
</tr>
<tr>
<td>Ph#</td>
<td colspan="3"><strong>'.$pickupdetails['phoneno'].'</strong></td>
</tr>
<tr>
<td>Contact#</td>
<td colspan="3"><strong>'.$pickupdetails['contact_name'].'</strong></td>
</tr>
<tr>
<td colspan="4"><strong>Pickup#:</strong>'.$getdetails['pickup_no'].'</td>
</tr>
<tr>
<td>Qty</td>
<td colspan="2">Description</td>
<td>Weight</td>
</tr>
<tr>
<td colspan="4"><hr></td>
</tr>
<tr>
<td>'.$getdetails['qty'].'Skid</td>
<td colspan="2">'.$getdetails['description'].'</td>
<td>'.$getdetails['weight'].'</td>
</tr>
<tr>
<td colspan="4">
<strong style="font-size:12px;">Note : follow the pin point map i send you for delivery</strong></td>
</tr>
</table>

</td>
<td><div style="border-left: 6px solid black;height:800px;"></div></td>
<td width="50%" valign="top">
<table width="100%" cellpadding="10">
<tr>
<td><strong>Delivery To</strong></td>
<td>Date</td>
<td>'.date('m/d/Y',strtotime($getdetails['delivery_date'])).'</td>
<td>'.$getdetails['delivery_time'].'</td>
</tr>
<tr>
<td valign="top">Name</td>
<td colspan="3"><strong>'.$deliverydetails['company_name'].'<br>'.$getdetails['delivery_address'].'</strong></td>
</tr>
<tr>
<td>Ph#</td>
<td colspan="3"><strong>'.$deliverydetails['phoneno'].'</strong></td>
</tr>
<tr>
<td>Contact#</td>
<td colspan="3"><strong>'.$deliverydetails['contact_name'].'</strong></td>
</tr>
<tr>
<td colspan="4"><strong>Del#:</strong>'.$getdetails['delivery_to'].'</td>
</tr>
<tr>
<td>Qty</td>
<td colspan="2">Description</td>
<td>Weight</td>
</tr>
<tr>
<td colspan="4"><hr></td>
</tr>
<tr>
<td>'.$getdetails['delivery_qty'].'Skid</td>
<td colspan="2">'.$getdetails['delivery_description'].'</td>
<td>'.$getdetails['delivery_weight'].'</td>
</tr>
<tr>
<td colspan="4">
<strong style="font-size:14px;">Note : </strong></td>
</tr>
</table>
</td>
</tr>
</table>
<hr style="height:5px;color:black;">
<table width="100%" style=" border: 1px solid;">
<tr>
<td><strong>Item</strong></td>
<td><strong>Description</strong></td>
</tr>
<tr>
<td colspan="2"><hr style="color:black;"></td>
</tr>
<tr>
<td>Fright</td>
<td>$'.number_format($getdetails['bill_amount'],2).'</td>
</tr>
<tr>
<td colspan="2"><hr style="color:black;"></td>
</tr>
<tr>
<td><strong>Bill Amount</strong></td>
<td>$'.number_format($getdetails['bill_amount'],2).'</td>
</tr>
<tr>
<td><strong>Paid Amount</strong></td>
<td>$'.number_format($getdetails['payment'],2).'</td>
</tr>
<tr>
<td colspan="2"><hr style="color:black;"></td>
</tr>
<tr>
<td><strong>Balance Amount</strong></td>
<td>$'.number_format($balanceamt,2).'</td>
</tr>
</table>
<h3>Terms & Conditions</h3>
<p>WORK TOGETHER GROUP INC DOES ALL PICKUP AND DELIVERY APPOINTMENTS PLEASE DO NOT CONTACT SHIPPER OR CONSIGNEE UNDER ANY CIRCUMSTANCES. Driver must identify himself as Work Together Group. Inless mentioned otherwise</p>
';
              

$mpdf=new mPDF('', 'A4', 0, '', 10, 10, 0, 0, 0, 'L');
$mpdf->SetDisplayMode('default');
$mpdf->list_indent_first_level = 0; // 1 or 0 - whether to indent the first level of a list
$filename = "test1.txt";

$file = fopen($filename, "w");
fwrite($file, $message);
$mpdf->SetTitle('Carrier Confirmation');
$mpdf->keep_table_proportions = false;
$mpdf->shrink_this_table_to_fit = 0;
$mpdf->SetAutoPageBreak(true, 10);
$mpdf->WriteHTML(file_get_contents($filename));
//$mpdf->SetWatermarkImage('jiovio.png', 0.10, 'F');
//$mpdf->showWatermarkImage = true;
$mpdf->setAutoBottomMargin = 'stretch';
//$mpdf->setHTMLFooter('<div style="border-top: 0.1mm solid #000000;"><table width="100%"><tr><td colspan="2" align="center"><b>Healthcare</b></td></tr><tr><td><b>E-mail : </b>'.gethospital('emailid',$appointment['hospitalid']).'</td><td align="right"><b>For Support</b><br>'.gethospital('contactno',$appointment['hospitalid']).'</td></tr></table>');
$filename='carrier-confirmation.pdf';
if($_REQUEST['type']=='download') {
	$mpdf->Output($filename, 'D');
}else {
$mpdf->Output($filename, 'I');
}

?>
