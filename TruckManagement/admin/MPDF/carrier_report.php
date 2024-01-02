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
if($getdetails['payment']!=''){
$gpayment=number_format($getdetails['payment'],2);
}
else
{
$gpayment='';	
}
$message = '
<div align="center" style="font-size:20px;"><hr style="color:black;"><strong>CARRIER CONFIRMATION</strong><hr  style="color:black;"></div>
<div align="left" style="font-size:12px; padding-left:220px;">15-7955 Torbram Road <br>Brampton, Ontario, L6T 5B9<br> Canada<br> Mailid#: info@worktogethergroup.ca<br>website#: www.worktogethergroup.ca
</div>
<div class="center" style="font-size:19px;">
<hr  style="color:black;">
<strong>Load Number : '.$getdetails['load_no'].'</strong>
</div>
<br>
<div class="center">
Booked By: '.$getdetails['booked_by'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$getdetails['book_date'].' '.$getdetails['book_time'].'</div>
<hr style="height:5px;color:black;">
<table width="80%" align="center" cellpadding="5" cellspacing="0">
<tr>
<td width="10%" valign="top">Carrier</td>
<td valign="top"><strong>'.$carrierdetails['customer_name'].'<br>'.$carrierdetails['customer_address'].'<br>'.$carrierdetails['customer_address1'].'<br>'.$carrierdetails['province_state'].','.$carrierdetails['city'].'<br>'.$carrierdetails['country'].'<br>'.$carrierdetails['posta_zip_code'].'</strong></td>
</tr>
<tr>
<td valign="top">Rate</td>
<td>
<table width="100%">

<tr> 
<td>&nbsp;<td>
<td width="10%">&nbsp;</td>
<td>'.$getdetails['bill_amount'].'</td>
</tr>
</table>
</td>
</tr>
<tr>
<td>Currency:   </td>
<td>'.$getdetails['bill_currency'].'</td>
</tr>
</table>
<p><strong>Note:</strong></p>
<hr style="height:5px;color:black;">';
if($getdetails['status']=='Cancelled') {
$message .='<p align="center"><img src="'.$sitename.'images/Cancelled.png" align="center"></p>';
}
$message .='<table width="100%">
<tr>
<td width="100%">';
$unitss = $db->prepare("SELECT * FROM `loadboard_address` WHERE `load_id`= ? ORDER BY `id` ASC");
$unitss->execute(array($_REQUEST['id']));
$ucount = $unitss->rowcount();
if ($ucount != '0') {
$message .='<table width="100%" border="1" cellspacing="0"  cellpadding="5"><tr>
<th>Type</th>
<th>Date</th>
<th>Time</th>
<th>No</th>
<th>Company Name</th>
<th>Address</th>
<th>Qty</th>
<th>Description</th>
<th>Weight</th>
</tr>';
while ($funitss = $unitss->fetch(PDO::FETCH_ASSOC)) {
	$message .='<tr>
	<td>'.$funitss['atype'].'</td>
	<td>'.date('d-m-Y',strtotime($funitss['adate'])).'</td>
	<td>'.date('h:i:s',strtotime($funitss['atime'])).'</td>
	<td>'.$funitss['no'].'</td>
	<td>'.$funitss['cname'].'</td>
	<td>'.$funitss['address'].'</td>
	<td>'.$funitss['qty'].'</td>
	<td>'.$funitss['description'].'</td>
	<td>'.$funitss['weight'].'</td>
	</tr>';
	}

$message .='</table>';
}
$message .='<table width="100%" cellpadding="10">
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

</tr>
</table>
<hr style="height:5px;color:black;">
<h3>Terms & Conditions</h3>
<p>WORK TOGETHER GROUP INC DOES ALL PICKUP AND DELIVERY APPOINTMENTS. PLEASE DO NOT CONTACT SHIPPER OR
CONSIGNEE UNDER ANY CIRCUMSTANCES. Driver must identify himself as Work Togrther Group . Unless mentioned otherwise
this load is an exclusive FTL (Full Truck Load) shipment and cannot be sent as an LTL (less than truckload) or partial without a written approval of Work Togrther Group or price adjustment will be made.</p>
<p>Bill to:Work Togrther Group Inc; Submit invoices to Payment terms are Net
45days with ORIGINAL POD(POD has to be sent within 7 days after delivery or $50 fine will be deducted from the rate) or !! GET PAID QUICKER !! QuickPay @5%. pay in 8 days $50/hour late fee if an appointment missed.</p>
<p>In case of detention/lumper or any other accessorial charges Work Togrther Group Inc should be notified within 24hours and charges must be pre-approved before billed. Any changes to the pickup, delivery or customs clearance should be preapproved and confrimed by Work Togrther Group Inc. Freight should never be taken in bond without a written approval of Work Togrther Group Inc. In order to claim the detention a BOL with time in/time out signed by the shipper/consignee should be provided within 24 hours after detention occurs. Maximum detention pay is $40/hour or $125/day. Any failure of service or changes to the initial instructions without written notification of Work Togrther Group Inc will be a subject of $300 or more fine.</p>
<p>Double brokered loads wont be paid.</p>
<p>Please make sure driver secures the load at the back with 2 loads bars and straps</p>
<p>Dry Van waiting time starts after 2 hours </p>
<p>Flatbed waiting starts after 3 hours</p>
<p>Reefer waiting starts after 3 hours</p>
<p>Send POD and Invoice at accounts@worktogthergroup.ca</p>
<p>&nbsp;</p>
<table width="100%" style=" border: 1px solid;">
<tr>
<td><strong>Note : </strong>'.$getdetails['note2'].'</td>
</tr>
</table>
';
  
// $mpdf=new mPDF('', 'A4', 0, '', 10, 10, 0, 0, 0, 'L');
$mpdf=new mPDF('utf-8','A4','0','','20','20','65','10');
$mpdf->SetHTMLHeader('<br>
<div align="center">
<img src="'.$sitename.'invoice-logo.png"></div>
</div>
<div align="center" style="font-size:14px;height:20%;"><strong>WORK TOGETHER GROUP INC.<br>Work Together Grow Together<br>Tel.(905) 247-6111</strong></div><div align="center">&nbsp;</div>');
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
