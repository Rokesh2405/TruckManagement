<?php
require_once __DIR__ . '/vendor/autoload.php';
include ('../config/config.inc.php');


date_default_timezone_set('Asia/Kolkata');
$getdetails = FETCH_all("SELECT * FROM `export_tbl` WHERE id=?", $_REQUEST['id']);
$customerdetails = FETCH_all("SELECT * FROM `customer` WHERE customer_name=?", $getdetails['customer_name']);


$stmt = $db->prepare("SELECT * FROM `export_items` WHERE `import_id`='".$_REQUEST['id']."' ORDER BY `id` DESC ");   
$stmt->execute();
$checknum1 = $stmt->rowCount();


$message = '<br><table style="width:100%; font-family:arial; font-size:18px;">
    <tr>
    <td width="10%" valign="top"><img src="../images/kkcarrier.jpeg" width="100"></td>
    <td  width="40%" align="left" style="padding-right:20px;"><h4>Khuman & Khuman carrier</h4><h5 style="align:right;">60 Lacoste Blvd 
Unit # 119<br>
Brampton Ontario<br>
Canada<br></h5>
<br>
<table width="100%" border="1" cellpadding="10" cellspacing="0">
<tr>
<td align="center"><strong>Phone #</strong></td>
<td align="center"><strong>(905) 465- 4041</strong></td>
</tr>
</table>
</td>
<td  width="50%" align="left" style="padding-right:20px;" align="right" valign="top">
<table width="100%" border="1" cellpadding="10" cellspacing="0">
<tr>
<td align="center"><strong>Date</strong></td>
<td align="center"><strong>Invoice #</strong></td>
</tr>
<tr>
<td>'.date('Y-m-d',strtotime($getdetails['invoice_date'])).'</td>
<td>'.$getdetails['order_no'].'</td>
</tr>
</table>
</td>
    </tr>
	
   
    </table>
<br><br>
<table width="100%" cellpadding="10" cellspacing="0">
<tr>
<td width="12%">&nbsp;</td>
<td width="90%"><table width="100%" border="1" cellpadding="10" cellspacing="0">
<tr>
<td align="left"><strong>Invoice To</strong></td>
</tr>
<tr>
<td>'.$customerdetails['customer_address'].'<br>'.$customerdetails['customer_address1'].'<br>'.$customerdetails['city'].','.$customerdetails['state'].'<br>'.$customerdetails['country'].'<br>'.$customerdetails['posta_zip_code'].'</td>
</tr>
</table>
</td>
</tr>
</table>
<br><br>
<table width="95%" align="center" cellpadding="10" cellspacing="0" border="1">
<tr>
<th>QTY</th>
<th>ITEM</th>
<th>DESCRIPTION</th>
<th>Rate</th>
<th>Amount</th>
</tr>';
 if($checknum1>0)
{
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    
  $message .='<tr>
  <td>1</td>
  <td>Container Delivery</td>
  <td>Ref #'.$row['ref_no'].'<br>'.$customerdetails['customer_address'].'<br>'.$customerdetails['customer_address1'].'<br>'.$customerdetails['city'].','.$customerdetails['state'].'<br>'.$customerdetails['country'].'<br>'.$customerdetails['posta_zip_code'].'</td>
 <td>'.$row['rate'].'</td>
  <td>'.$row['rate'].'</td>
  </tr>';
    }
    
}
else
{
 $message .='<tr>
  <td colspan="4" align="center">No Records Found</td>
  </tr>';   
}
$balcamt=$getdetails['total_amount']-$getdetails['payment'];
 $message .='</table>
 <br><br>
<table width="95%" cellpadding="10" cellspacing="0" border="1" align="center">
<tr>
<td width="65%">&nbsp;</td>
<td align="right">
<table width="100%">
<tr>
<td width="50%"><strong>Total</strong></td>
<td width="20%">&nbsp;</td>
<td align="right" width="30%">$'.number_format($getdetails['total_amount'],2).'</td>
</tr>
<tr>
<td><strong>Payments/'.$getdetails['payment_type'].'</strong></td>
<td width="30%">&nbsp;</td>
<td align="right">$'.number_format($getdetails['payment'],2).'</td>
</tr>
<tr>
<td><h3>Balance Due</h3></td>
<td width="30%">&nbsp;</td>
<td align="right">$'.number_format($balcamt,2).'</td>
</tr>
</table>
</td>
</tr>
</table>
<br><br>
<table width="95%" align="center" border="0">
<tr>
<td width="50%">
<table width="100%" border="0" cellpadding="10" cellspacing="0">
<tr>
<td>GST/HST No</td>
<td>853482867</td>
</tr>
</table >
</td>
<td width="50%" align="right">
<table width="100%" border="1" cellpadding="10" cellspacing="0">
<tr>
<td>E-mail</td>
<td>Info@kkhuman.ca</td>
</tr>
</table>
</td>
</tr>
</table>
			';
                $sno++;

$mpdf=new mPDF('', 'A4', 0, '', 0, 0, 0, 0, 0, 'L');
$mpdf->SetDisplayMode('default');
$mpdf->list_indent_first_level = 0; // 1 or 0 - whether to indent the first level of a list
$filename = "test.txt";

$file = fopen($filename, "w");
fwrite($file, $message);
$mpdf->SetTitle('Customer Invoice');
$mpdf->keep_table_proportions = false;
$mpdf->shrink_this_table_to_fit = 0;
$mpdf->SetAutoPageBreak(true, 10);
$mpdf->WriteHTML(file_get_contents($filename));
//$mpdf->SetWatermarkImage('jiovio.png', 0.10, 'F');
//$mpdf->showWatermarkImage = true;
$mpdf->setAutoBottomMargin = 'stretch';
//$mpdf->setHTMLFooter('<div style="border-top: 0.1mm solid #000000;"><table width="100%"><tr><td colspan="2" align="center"><b>Healthcare</b></td></tr><tr><td><b>E-mail : </b>'.gethospital('emailid',$appointment['hospitalid']).'</td><td align="right"><b>For Support</b><br>'.gethospital('contactno',$appointment['hospitalid']).'</td></tr></table>');
$filename='invoice.pdf';
$mpdf->Output($filename, 'I');
?>
