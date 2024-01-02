<?php
require_once __DIR__ . '/vendor/autoload.php';
include ('../config/config.inc.php');


date_default_timezone_set('Asia/Kolkata');
$getdetails = FETCH_all("SELECT * FROM `driver_dailysheetreport` WHERE `id`=? ", $_REQUEST['id']);
$driverdetails = FETCH_all("SELECT * FROM `driver_tbl` WHERE driver_name=?", $getdetails['driver_name']);
$deductiondetails = FETCH_all("SELECT SUM(`packingcharge_amt`) AS `packingchargeamt` FROM `driver_deduction` WHERE driver_name=? AND (date(`invoice_date`)>='".$getdetails['fromdate']."' AND date(`invoice_date`)<='".$getdetails['todate']."') ", $getdetails['driver_name']);
$packinghst=$deductiondetails['packingchargeamt']*(13/100);
$packingtotal=$deductiondetails['packingchargeamt']+$packinghst;

$licencedetails = FETCH_all("SELECT SUM(`licence`) AS `licenceamt` FROM `driver_deduction` WHERE driver_name=? AND (date(`invoice_date`)>='".$getdetails['fromdate']."' AND date(`invoice_date`)<='".$getdetails['todate']."') ", $getdetails['driver_name']);

    $truckdetails = FETCH_all("SELECT SUM(`truck_insurance`) AS `truck_insurance` FROM `driver_deduction` WHERE driver_name=? AND (date(`invoice_date`)>='".$getdetails['fromdate']."' AND date(`invoice_date`)<='".$getdetails['todate']."') ", $getdetails['driver_name']);

$totalamt=$deductiondetails['packingchargeamt']+$truckdetails['truck_insurance']+$licencedetails['licenceamt'];
$totalhst=$packinghst;
$finalamt=$packingtotal+$truckdetails['truck_insurance']+$licencedetails['licenceamt'];

$message = '<br><table style="width:50%; font-family:arial; font-size:18px;" align="center">
    <tr>
    <td width="10%" valign="top"><img src="../images/kkcarrier.jpeg" width="100"></td>
    <td  width="40%" align="left" style="padding-right:20px;"><h4>Khuman & Khuman carrier</h4><h5 style="align:right;">60 Lacoste Blvd 
Unit # 119<br>
Brampton Ontario<br>
Canada<br></h5>

</td>
    </tr>
  
   
    </table>

<table width="50%" cellpadding="10" cellspacing="0" align="center">

<tr>
<td>'.$getdetails['driver_name'].'&nbsp;&nbsp;'.date('d-m-Y').'<br>'.$driverdetails['driver_code'].'&nbsp;&nbsp;'.$driverdetails['company_name'].'<br>PAY PERIOD '.strtoupper(date('d F',strtotime($getdetails['fromdate']))).'-'.strtoupper(date('d F Y',strtotime($getdetails['todate']))).'</td>
</tr>
<tr>
<td><h2>Earnings</h2></td>
</tr>
</table>


<table width="50%" align="center" cellpadding="10" cellspacing="0" border="1">
<tr>
<th>DAYS</th>
<th>DATE</th>
<th>AMOUNT</th>
</tr>';
 $array = array(); 

    $period = new DatePeriod(
        new DateTime(date('Y-m-d',strtotime($getdetails['fromdate']))),
        new DateInterval('P1D'),
        new DateTime(date('Y-m-d',strtotime($getdetails['todate']. ' +1 day')))
    );

foreach ($period as $key => $value) {
    $driverdetails = FETCH_all("SELECT * FROM `driver_dailysheet` WHERE driver_name=? AND date(`invoice_date`)='".$value->format('Y-m-d')."' ", $getdetails['driver_name']);
    if($driverdetails['id']!='') {
    $cudate=$value->format('d-M-Y');
    $message .='<tr>
     <td>'.strtoupper($value->format('l')).'</td>
    <td align="right">'.$value->format('d-M').'</td>
    <td align="right">$'.$driverdetails['total_amount'].'</td>
    </tr>
  ';
}
else
{
   $message .='<tr>
    <td>'.strtoupper($value->format('l')).'</td>
    <td align="right">'.$value->format('d-M').'</td>
    <td align="right">OFF</td>
    </tr>
  ';  
}
  $totamt+=$driverdetails['total_amount'];
        }

$hstval=$totamt*(13/100);
$balcamt=$totamt-$hstval;
$message .='<tr>
<td colspan="2">ADD FROM LAST PAYROLL</td>
<td>&nbsp;</td>
</tr>
<tr>
<td colspan="2">SUBTOTAL</td>
<td align="right">$'.$totamt.'</td>
</tr>
<tr>
<td colspan="2">HST</td>
<td align="right">$'.$hstval.'</td>
</tr>
<tr>
<td>TOTAL</td>
<td>&nbsp;</td>
<td align="right">$'.$balcamt.'</td>
</tr>
<tr>
<td colspan="3" align="center">PAID CHQ#'.$getdetails['cheque_no'].' ON '.strtoupper(date('d F Y')).'</td>
</tr>
</table><br>
  <table width="50%" align="center" cellpadding="10" cellspacing="0" border="1">
<tr>
<th>DEDUCTIONS</th>
<th>AMOUNT</th>
<th>HST 13%</th>
<th>TOTAL</th>
</tr>
<tr>
<td>PARKING CHARGES</td>
<td>$'.$deductiondetails['packingchargeamt'].'</td>
<td>$'.$packinghst.'</td>
<td>'.$packingtotal.'</td>
</tr>
<tr>
<td>FUEL INC HST</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>';
$stmt = $db->prepare("SELECT * FROM `driver_deduction` WHERE driver_name='".$getdetails['driver_name']."' AND (date(`invoice_date`)>='".$getdetails['fromdate']."' AND date(`invoice_date`)<='".$getdetails['todate']."') ORDER BY `invoice_date` ASC "); 
$stmt->execute();
$checknum1 = $stmt->rowCount();
if($checknum1>0)
{
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

    $totalamt +=$row['packingcharge_amt'];
       $totalhst +=$row['packingcharge_hst'];
          $finalamt +=$row['finalamt'];
$message .='<tr>
<td>'.date('d-M-Y',strtotime($row['invoice_date'])).'</td>
<td>'.$row['packingcharge_amt'].'</td>
<td>'.$row['packingcharge_hst'].'</td>
<td>'.$row['packingcharge_total'].'</td>
</tr>
';
}
}
$erngs=$balcamt-$finalamt;
$message .='<tr>
<td>LICENSE (PLATES)</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>'.$licencedetails['licenceamt'].'</td>
</tr><tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>TRUCK INSURANCE</td>
<td>$'.$truckdetails['truck_insurance'].'</td>
<td>&nbsp;</td>
<td>'.$truckdetails['truck_insurance'].'</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td><strong>TOTAL DEDUCTION</strong></td>
<td><strong>$'.$totalamt.'</strong></td>
<td><strong>$'.$totalhst.'</strong></td>
<td><strong>'.$finalamt.'</strong></td>
</tr>
</table><br>
 <table width="50%" align="center" cellpadding="10" cellspacing="0" border="1">
<tr>
<th colspan="2" align="left"><strong>NETPAY</strong></th>
</tr>
<tr>
<td>TOTAL EARNINGS</td>
<td>$'.$balcamt.'</td>
</tr>
<tr>
<td>TOTAL DEDUCTIONS</td>
<td>$'.$finalamt.'</td>
</tr>
<tr>
<td><strong>TOTAL</strong></td>
<td>$'.$erngs.'</td>
</tr>
<tr>
<td><strong>NET EARNING</strong></td>
<td>&nbsp;</td>
</tr>
<tr>
<td colspan="2">PAID CHQ#'.$getdetails['cheque_no'].' ON '.strtoupper(date('d F Y')).'</td>
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
$mpdf->SetTitle('Driver Invoice');
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
