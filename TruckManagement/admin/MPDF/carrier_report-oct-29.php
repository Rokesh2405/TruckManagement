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
$contactdetails = FETCH_all("SELECT * FROM `customer` WHERE customer_name=?", $getdetails['contact']);
$message = '
<div align="center" style="font-size:20px;"><hr style="color:black;"><strong>CARRIER CONFIRMATION</strong><hr  style="color:black;"></div>
<div align="center" style="font-size:12px;">59118 Westmood Mall, Mississauga, ON , L4T 4JI <br>Ph#:905-247-6111 , Fax#: 905-247-5993<br> Mailid#: info@worktogethergroup.ca<br>website#: www.worktogethergroup.ca<hr  style="color:black;">
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
<td><strong>'.$contactdetails['customer_name'].'<br>'.$contactdetails['customer_address'].'<br>'.$contactdetails['customer_address1'].'</strong>
<table width="100%">
<tr> 
<td>Ph#:'.$contactdetails['telephone_admin'].'<td>
<td width="10%">&nbsp;</td>
<td>&nbsp;</td>
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
<td colspan="3"><strong>'.$pickupdetails['company_name'].'<br>'.$getdetails['pickup_address'].'<br>'.$pickupdetails['province'].'<br>'.$pickupdetails['city'].'</strong></td>
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
<td colspan="3"><strong>'.$deliverydetails['company_name'].'<br>'.$getdetails['delivery_address'].'<br>'.$deliverydetails['province'].'<br>'.$deliverydetails['city'].'</strong></td>
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
<td>'.$getdetails['bill_currency'].number_format($getdetails['bill_amount'],2).'</td>
</tr>
<tr>
<td colspan="2"><hr style="color:black;"></td>
</tr>
<tr>
<td><strong>Bill Amount</strong></td>
<td>'.$getdetails['bill_currency'].number_format($getdetails['bill_amount'],2).'</td>
</tr>
<tr>
<td><strong>Paid Amount</strong></td>
<td>'.$getdetails['payment_currency'].number_format($getdetails['payment'],2).'</td>
</tr>
<tr>
<td colspan="2"><hr style="color:black;"></td>
</tr>
<tr>
<td><strong>Balance Amount</strong></td>
<td>'.$getdetails['payment_currency'].number_format($balanceamt,2).'</td>
</tr>
</table>
<h3>Terms & Conditions</h3>
<p>WORK TOGETHER GROUP INC DOES ALL PICKUP AND DELIVERY APPOINTMENTS. PLEASE DO NOT CONTACT SHIPPER OR
CONSIGNEE UNDER ANY CIRCUMSTANCES. Driver must identify himself as Work Togrther Group . Unless mentioned otherwise
this load is an exclusive FTL (Full Truck Load) shipment and cannot be sent as an LTL (less than truckload) or partial without a written approval of Work Togrther Group or price adjustment will be made.</p>
<p>Bill to:Work Togrther Group Inc; Submit invoices to Payment terms are Net
35days with ORIGINAL POD(POD has to be sent within 7 days after delivery or $50 fine will be deducted from the rate) or !! GET PAID QUICKER !! QuickPay @5%. pay in 8 days $50/hour late fee if an appointment missed.</p>
<p>In case of detention/lumper or any other accessorial charges Work Togrther Group Inc should be notified within 24hours and charges must be pre-approved before billed. Any changes to the pickup, delivery or customs clearance should be preapproved and confrimed by Work Togrther Group Inc. Freight should never be taken in bond without a written approval of Work Togrther Group Inc. In order to claim the detention a BOL with time in/time out signed by the shipper/consignee should be provided within 24 hours after detention occurs. Maximum detention pay is $40/hour or $125/day. Any failure of service or changes to the initial instructions without written notification of Work Togrther Group Inc will be a subject of $300 or more fine.</p>
<p>Double brokered loads wont be paid.</p>
<p>Please make sure driver secures the load at the back with 2 loads bars and straps</p>
<p>Dry Van waiting time starts after 2 hours </p>
';
              

// $mpdf=new mPDF('', 'A4', 0, '', 10, 10, 0, 0, 0, 'L');
$mpdf=new mPDF('utf-8','A4','0','','20','20','55','10');
$mpdf->SetHTMLHeader('<br>
<div align="center">
<img src="'.$sitename.'invoice-logo.png"></div>
</div>
<div align="center" style="font-size:14px;"><strong>WORK TOGETHER GROUP INC.<br>Work Together Group Together</strong></div>');
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
