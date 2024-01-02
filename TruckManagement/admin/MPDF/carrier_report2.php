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
$message = '<table width="100%">
<tr>
<td valign="top">
<table border="1" cellpadding="10" cellspacing="0" width="100%">
<tr>
<td>
<strong>WORK TOGETHER GROUP INC</strong><br><br>59118 Westwood Mall, Mississauga, ON , L4T 4J1 <br>Ph#:905-247-6111 , Fax#: 905-247-5993<br> Mailid#: info@worktogethergroup.ca<br>website#: www.worktogethergroup.ca
</td></tr></table>
</td>
</td>&nbsp;</td>
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
<strong>'.$deliverydetails['company_name'].'</strong><br><br>'.$getdetails['delivery_address'].'<br>'.$deliverydetails['province'].'<br>'.$deliverydetails['city'].'
</td></tr></table>
</td>
<td align="right">
<table border="1" cellpadding="10" cellspacing="0" >
<tr>
<td>
<strong>Invoice#: </strong>
</td>
<td>'.$getdetails['id'].'</td>
</tr>
<tr>
<td>
<strong>Date#: </strong>
</td>
<td>'.date('d/m/Y',strtotime($getdetails['date'])).'</td>
</tr>
</table>
</td>
</tr>
</table>
<br>
<table width="100%">
<tr>
<td width="40%">Order #'.$getdetails['load_no'].' Dated '.$getdetails['book_date'].'</td>
<td>Truck # STA08 Trailer #6821</td>
</tr>
</table>
<br>
<table width="100%" border="1" cellpadding="4" cellspacing="0">
<tr>
<td><strong>Item</strong></td>
<td><strong>Shipper</strong></td>
<td><strong>Pick-up Date</strong></td>
<td><strong>Consignee</strong></td>
<td><strong>Delivery Date</strong></td>
<td><strong>Amount</strong></td>
</tr>
<tr>
<td>F.Load</td>
<td>'.$getdetails['pickup_contact'].'<br>'.$getdetails['pickup_address'].'</td>
<td>'.$getdetails['pickup_date'].'</td>
<td>'.$getdetails['delivery_contact'].'<br>'.$getdetails['delivery_address'].'</td>
<td>'.$getdetails['delivery_date'].'</td>
<td>$'.number_format($getdetails['bill_amount'],2).'</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>Add</td>
<td>Waiting Time<br>
5.5hrs x $40
</td>
<td>&nbsp;</td>
<td>220.00</td>
</tr>
</table>
<br>
<table cellpadding="6" width="100%">
<tr>
<td width="40%">Terms : 30 Days<br>Due Date : 01/04/2023<br>Thank you for your business</td>
<td width="30%" valign="top">5.5 hrs x $ 40</td>
<td  width="30%" valign="top">
<table width="100%">
<tr>
<td>Sub-Total (CDN$)<br>HST/GST Exempt</td>
<td valign="top">&nbsp;&nbsp;'.number_format($getdetails['bill_amount'],2).'</td>
</tr>
</table>
</td>
</tr>
<tr>
<td colspan="3" align="right">

<table width="100%">
<tr>
<td>Total Amount (CDN$)</td>
<td style="border-top:1px solid #000;border-bottom:1px solid #000;">'.number_format($getdetails['bill_amount'],2).'</td>
</tr>
</table>
</td>
</tr>

</table>
';
  
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
