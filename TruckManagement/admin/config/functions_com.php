<?php

function getloadconfirmation($a, $b)
{
global $db;
$get1 = $db->prepare("SELECT * FROM loadconfirmation WHERE id=?");
$get1->execute(array($b));
$get = $get1->fetch(PDO::FETCH_ASSOC);
$res = $get[$a];
return $res;
}
//###########GET CUSTOMER#############\\
//###########DELETE CUSTOMER START##########\\
function delloadconfirmation($a) {
$b = str_replace(".", ",", $a);
$b = explode(",", $b);
foreach ($b as $c) {
global $db;
$get = $db->prepare("DELETE FROM loadconfirmation WHERE id = ? ");
$get->execute(array($c));
}
$res = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-close"></i> Successfully Deleted!</h4></div>';
return $res;
}

function addloadconfirmation($emailid,$customer_name,$pickup_name,$delivery_name,$pickup_date,$delivery_date,$notes,$getid)
    {
    global $db;
    if ($getid == '') 
    {
       $resa = $db->prepare("INSERT INTO `loadconfirmation` (`emailid`,`customer_name`,`pickup_name`,`delivery_name`,`pickup_date`,`delivery_date`,`notes`) VALUES (?,?,?,?,?,?,?)");
        $resa->execute(array($emailid,$customer_name,$pickup_name,$delivery_name,$pickup_date,$delivery_date,$notes));
        $res = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i>Successfully Inserted</h4></div>';
       

    } 
    else 
    {
   

    $resa = $db->prepare("UPDATE `loadconfirmation` SET `emailid`=?,`customer_name`=?,`pickup_name`=?,`delivery_name`=?,`pickup_date`=?,`delivery_date`=?,`notes`=? WHERE `id`=? ");

    $resa->execute(array($emailid,$customer_name,$pickup_name,$delivery_name,$pickup_date,$delivery_date,$notes,$getid));
    
    $res = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Successfully Updated!</h4></div>';
  
    }

    return $res;

}



function getbirthday($a, $b)
{
global $db;
$get1 = $db->prepare("SELECT * FROM birthday WHERE id=?");
$get1->execute(array($b));
$get = $get1->fetch(PDO::FETCH_ASSOC);
$res = $get[$a];
return $res;
}

function getprovince($a, $b)
{
global $db;
$get1 = $db->prepare("SELECT * FROM states WHERE id=?");
$get1->execute(array($b));
$get = $get1->fetch(PDO::FETCH_ASSOC);
$res = $get[$a];
return $res;
}
//###########GET CUSTOMER#############\\
//###########DELETE CUSTOMER START##########\\
function delprovince($a) {
$b = str_replace(".", ",", $a);
$b = explode(",", $b);
foreach ($b as $c) {
global $db;
$get = $db->prepare("DELETE FROM states WHERE id = ? ");
$get->execute(array($c));
}
$res = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-close"></i> Successfully Deleted!</h4></div>';
return $res;
}

function addprovince($state,$hst,$getid)
    {
    global $db;
    if ($getid == '') 
    {
       $resa = $db->prepare("INSERT INTO `states` (`state`,`hst`) VALUES (?,?)");
        $resa->execute(array($state,$hst));
        $res = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i>Successfully Inserted</h4></div>';
       

    } 
    else 
    {
   

    $resa = $db->prepare("UPDATE `states` SET `state`=?,`hst`=? WHERE `id`=? ");

            $resa->execute(array($state,$hst,$getid));
      $res = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Successfully Updated!</h4></div>';
  
    }

    return $res;

}


function delsalessettlement($a) {
$b = str_replace(".", ",", $a);
$b = explode(",", $b);
foreach ($b as $c) {
global $db;
$get = $db->prepare("DELETE FROM salesman_settlement WHERE id = ? ");
$get->execute(array($c));
}
$res = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-close"></i> Successfully Deleted!</h4></div>';
return $res;
}




function getaddresscity($a, $b)
{
global $db;
$get1 = $db->prepare("SELECT * FROM pickup WHERE company_name=?");
$get1->execute(array($b));
$get = $get1->fetch(PDO::FETCH_ASSOC);
$res = $get[$a];
return $res;
}
function getexpenseentry($a, $b)
{
global $db;
$get1 = $db->prepare("SELECT * FROM expenseentry WHERE id=?");
$get1->execute(array($b));
$get = $get1->fetch(PDO::FETCH_ASSOC);
$res = $get[$a];
return $res;
}
//###########GET CUSTOMER#############\\
//###########DELETE CUSTOMER START##########\\
function delexpenseentry($a) {
$b = str_replace(".", ",", $a);
$b = explode(",", $b);
foreach ($b as $c) {
global $db;
$get = $db->prepare("DELETE FROM expenseentry WHERE id = ? ");
$get->execute(array($c));
}
$res = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-close"></i> Successfully Deleted!</h4></div>';
return $res;
}

function addexpenseentry($currency,$voucher_no,$voucher_date,$expense,$expense_desc,$payment_type,$payment_date,$payment_amount,$getid)
    {
    global $db;
    if ($getid == '') 
    {
       $resa = $db->prepare("INSERT INTO `expenseentry` (`currency`,`voucher_no`,`voucher_date`,`expense`,`expense_desc`,`payment_type`,`payment_date`,`payment_amount`) VALUES (?,?,?,?,?,?,?,?)");
        $resa->execute(array($currency,$voucher_no,$voucher_date,$expense,$expense_desc,$payment_type,$payment_date,$payment_amount));
        $res = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i>Successfully Inserted</h4></div>';
       

    } 
    else 
    {
   

    $resa = $db->prepare("UPDATE `expenseentry` SET `currency`=?,`voucher_no`=?,`voucher_date`=?,`expense`=?,`expense_desc`=?,`payment_type`=?,`payment_date`=?,`payment_amount`=? WHERE `id`=? ");

            $resa->execute(array($currency,$voucher_no,$voucher_date,$expense,$expense_desc,$payment_type,$payment_date,$payment_amount,$getid));
      $res = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Successfully Updated!</h4></div>';
  
    }

    return $res;

}
function getsalesmansettlement($a, $b)
{
global $db;
$get1 = $db->prepare("SELECT * FROM salesman_settlement WHERE id=?");
$get1->execute(array($b));
$get = $get1->fetch(PDO::FETCH_ASSOC);
$res = $get[$a];
return $res;
}
//###########GET CUSTOMER#############\\
//###########DELETE CUSTOMER START##########\\
function delsalesmansettlement($a) {
$b = str_replace(".", ",", $a);
$b = explode(",", $b);
foreach ($b as $c) {
global $db;
$get = $db->prepare("DELETE FROM salesman_settlement WHERE id = ? ");
$get->execute(array($c));
}
$res = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-close"></i> Successfully Deleted!</h4></div>';
return $res;
}

function addsalessettlement($payment_currency,$load_no,$settlement_amt,$payment_date,$salesman_name,$company_name,$payment_type,$cheque_no,$cheque_date,$payment_amount,$getid)
    {
    global $db;
    if ($getid == '') 
    {
       $resa = $db->prepare("INSERT INTO `salesman_settlement` (`payment_currency`,`load_no`,`settlement_amt`,`payment_date`,`salesman_name`,`company_name`,`payment_type`,`cheque_no`,`cheque_date`,`payment_amount`) VALUES (?,?,?,?,?,?,?,?,?,?)");
        $resa->execute(array($payment_currency,$load_no,$settlement_amt,$payment_date,$salesman_name,$company_name,$payment_type,$cheque_no,$cheque_date,$payment_amount));
        $res = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i>Successfully Inserted</h4></div>';
       

    } 
    else 
    {
   

    $resa = $db->prepare("UPDATE `salesman_settlement` SET `payment_currency`=?,`load_no`=?,`settlement_amt`=?,`payment_date`=?,`salesman_name`=?,`company_name`=?,`payment_type`=?,`cheque_no`=?,`cheque_date`=?,`payment_amount`=? WHERE `id`=? ");

            $resa->execute(array($payment_currency,$load_no,$settlement_amt,$payment_date,$salesman_name,$company_name,$payment_type,$cheque_no,$cheque_date,$payment_amount,$getid));
      $res = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Successfully Updated!</h4></div>';
  
    }

    return $res;

}
function getcarriersettlement($a, $b)
{
global $db;
$get1 = $db->prepare("SELECT * FROM carrier_settlement WHERE id=?");
$get1->execute(array($b));
$get = $get1->fetch(PDO::FETCH_ASSOC);
$res = $get[$a];
return $res;
}
//###########GET CUSTOMER#############\\
//###########DELETE CUSTOMER START##########\\
function delcarriersettlement($a) {
$b = str_replace(".", ",", $a);
$b = explode(",", $b);
foreach ($b as $c) {
global $db;
$get = $db->prepare("DELETE FROM carrier_settlement WHERE id = ? ");
$get->execute(array($c));
}
$res = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-close"></i> Successfully Deleted!</h4></div>';
return $res;
}

function addcarriersettlement($payment_date,$carrier_code,$carrier_name,$contact_name,$payment_type,$cheque_no,$cheque_date,$payment_amount,$getid)
    {
    global $db;
    if ($getid == '') 
    {
       $resa = $db->prepare("INSERT INTO `carrier_settlement` (`payment_date`,`carrier_code`,`carrier_name`,`contact_name`,`payment_type`,`cheque_no`,`cheque_date`,`payment_amount`) VALUES (?,?,?,?,?,?,?,?)");
        $resa->execute(array($payment_date,$carrier_code,$carrier_name,$contact_name,$payment_type,$cheque_no,$cheque_date,$payment_amount));
        $res = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i>Successfully Inserted</h4></div>';
       

    } 
    else 
    {
   

    $resa = $db->prepare("UPDATE `carrier_settlement` SET `payment_date`=?,`customer_code`=?,`customer_name`=?,`contact_name`=?,`payment_type`=?,`cheque_no`=?,`cheque_date`=?,`payment_amount`=? WHERE `id`=? ");

            $resa->execute(array($payment_date,$customer_code,$customer_name,$contact_name,$payment_type,$cheque_no,$cheque_date,$payment_amount,$getid));
      $res = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Successfully Updated!</h4></div>';
  
    }

    return $res;

}
function getcustomersettlement($a, $b)
{
global $db;
$get1 = $db->prepare("SELECT * FROM customer_settlement WHERE id=?");
$get1->execute(array($b));
$get = $get1->fetch(PDO::FETCH_ASSOC);
$res = $get[$a];
return $res;
}
//###########GET CUSTOMER#############\\
//###########DELETE CUSTOMER START##########\\
function delcustomersettlement($a) {
$b = str_replace(".", ",", $a);
$b = explode(",", $b);
foreach ($b as $c) {
global $db;
$get = $db->prepare("DELETE FROM customer_settlement WHERE id = ? ");
$get->execute(array($c));
}
$res = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-close"></i> Successfully Deleted!</h4></div>';
return $res;
}

function addcustomersettlement($payment_date,$customer_code,$customer_name,$contact_name,$payment_type,$cheque_no,$cheque_date,$payment_amount,$getid)
    {
    global $db;
    if ($getid == '') 
    {
       $resa = $db->prepare("INSERT INTO `customer_settlement` (`payment_date`,`customer_code`,`customer_name`,`contact_name`,`payment_type`,`cheque_no`,`cheque_date`,`payment_amount`) VALUES (?,?,?,?,?,?,?,?)");
        $resa->execute(array($payment_date,$customer_code,$customer_name,$contact_name,$payment_type,$cheque_no,$cheque_date,$payment_amount));
        $res = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i>Successfully Inserted</h4></div>';
       

    } 
    else 
    {
   

    $resa = $db->prepare("UPDATE `customer_settlement` SET `payment_date`=?,`customer_code`=?,`customer_name`=?,`contact_name`=?,`payment_type`=?,`cheque_no`=?,`cheque_date`=?,`payment_amount`=? WHERE `id`=? ");

            $resa->execute(array($payment_date,$customer_code,$customer_name,$contact_name,$payment_type,$cheque_no,$cheque_date,$payment_amount,$getid));
      $res = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Successfully Updated!</h4></div>';
  
    }

    return $res;

}
function getinvoicetransaction($a, $b)
{
global $db;
$get1 = $db->prepare("SELECT * FROM invoice_transaction WHERE id=?");
$get1->execute(array($b));
$get = $get1->fetch(PDO::FETCH_ASSOC);
$res = $get[$a];
return $res;
}
//###########GET CUSTOMER#############\\
//###########DELETE CUSTOMER START##########\\
function delinvoicetransaction($a) {
$b = str_replace(".", ",", $a);
$b = explode(",", $b);
foreach ($b as $c) {
global $db;
$get = $db->prepare("DELETE FROM invoice_transaction WHERE id = ? ");
$get->execute(array($c));
}
$res = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-close"></i> Successfully Deleted!</h4></div>';
return $res;
}

function addinvoice_transaction($remark,$tax1,$total1,$hst,$note,$received_amount,$rate_currency,$total_currency,$payment_type,$payment_date,$cheque_no,$cheque_date,$invoice_date,$customer_no,$customer_name,$invoice_no,$shipment_no,$qty,$rate,$charge,$tax,$total,$getid)
    {
    global $db;
    global $sitename;
    if ($getid == '') 
    {
       $resa = $db->prepare("INSERT INTO `invoice_transaction` (`remark`,`tax1`,`total1`,`hst`,`note`,`received_amount`,`rate_currency`,`total_currency`,`payment_type`,`payment_date`,`cheque_no`,`cheque_date`,`invoice_date`,`customer_no`,`customer_name`,`invoice_no`,`shipment_no`,`qty`,`rate`,`charge`,`tax`,`total`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $resa->execute(array($remark,$tax1,$total1,$hst,$note,$received_amount,$rate_currency,$total_currency,$payment_type,$payment_date,$cheque_no,$cheque_date,$invoice_date,$customer_no,$customer_name,$invoice_no,$shipment_no,$qty,$rate,$charge,$tax,$total));
        $res = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i>Successfully Inserted</h4></div>';
       
  $insert_id = $db->lastInsertId();

    } 
    else 
    {
   

    $resa = $db->prepare("UPDATE `invoice_transaction` SET `remark`=?,`tax1`=?,`total1`=?,`hst`=?,`note`=?,`received_amount`=?,`rate_currency`=?,`total_currency`=?,`payment_type`=?,`payment_date`=?,`cheque_no`=?,`cheque_date`=?,`invoice_date`=?,`customer_no`=?,`customer_name`=?,`invoice_no`=?,`shipment_no`=?,`qty`=?,`rate`=?,`charge`=?,`tax`=?,`total`=? WHERE `id`=? ");

            $resa->execute(array($remark,$tax1,$total1,$hst,$note,$received_amount,$rate_currency,$total_currency,$payment_type,$payment_date,$cheque_no,$cheque_date,$invoice_date,$customer_no,$customer_name,$invoice_no,$shipment_no,$qty,$rate,$charge,$tax,$total,$getid));
      $res = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Successfully Updated!</h4></div>';

      //Send Mail

$cusinfo = FETCH_all("SELECT * FROM `customer` WHERE customer_name=? ", $customer_name);

$to=$cusinfo['email_dispatch'];//
$from="microwebzc@gmail.com";//config pana email


$message='<p>Hi<br><br>Your recent Invoice Transaction <br><br>
* <a href="'.$sitename.'MPDF/invoice_report.php?id='.$getid.'&type="download">Click the link to download the invoice</a>
</p>';


///////form2//

$subject =$customer_name." (".$invoice_no.")"." - Invoice Transaction";
$resmail = sendgridApiMail($to, $message, $subject, $from, '');

        if ($resmail->statusCode() == '202') 
        {
}

//Send Mail


  
    }

    return $res;

}
function getcarrierconfirmation($a, $b)
{
global $db;
$get1 = $db->prepare("SELECT * FROM carrier_confirmation WHERE id=?");
$get1->execute(array($b));
$get = $get1->fetch(PDO::FETCH_ASSOC);
$res = $get[$a];
return $res;
}
//###########GET CUSTOMER#############\\
//###########DELETE CUSTOMER START##########\\
function delcarrierconfirmation($a) {
$b = str_replace(".", ",", $a);
$b = explode(",", $b);
foreach ($b as $c) {
global $db;
$get = $db->prepare("DELETE FROM carrier_confirmation WHERE id = ? ");
$get->execute(array($c));
}
$res = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-close"></i> Successfully Deleted!</h4></div>';
return $res;
}

function addcarrierconfirmation($atype1,$addressid1,$adate1,$atime1,$no1,$cname1,$address1,$qty1,$description1,$weight1,$invoice_received_date,$charging_amount,$status,$note2,$note,$bill_currency,$payment_currency,$bill_amount,$salesman_payment_type,$salesman_payment_date,$salesman_cheque_no,$salesman_cheque_date,$book_date,$book_time,$salesman,$salesman_commission,$payment_type,$payment_date,$cheque_no,$cheque_date,$payment_amount,$load_no,$booked_by,$carrier,$contact,$payment,$getid)
    {
    global $db;
    global $sitename;
    if ($getid == '') 
    {
       $resa = $db->prepare("INSERT INTO `carrier_confirmation` (`invoice_received_date`,`charging_amount`,`status`,`note2`,`note`,`bill_currency`,`payment_currency`,`bill_amount`,`salesman_payment_type`,`salesman_payment_date`,`salesman_cheque_no`,`salesman_cheque_date`,`book_date`,`book_time`,`salesman`,`salesman_commission`,`payment_type`,`payment_date`,`cheque_no`,`cheque_date`,`payment_amount`,`carrier`,`load_no`,`booked_by`,`contact`,`payment`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $resa->execute(array($invoice_received_date,$charging_amount,$status,$note2,$note,$bill_currency,$payment_currency,$bill_amount,$salesman_payment_type,$salesman_payment_date,$salesman_cheque_no,$salesman_cheque_date,$book_date,$book_time,$salesman,$salesman_commission,$payment_type,$payment_date,$cheque_no,$cheque_date,$payment_amount,$carrier,$load_no,$booked_by,$contact,$payment));
   $insert_id = $db->lastInsertId();

    $atype=explode(',',$atype1);
    $addressid=explode(',',$addressid1);
    $adate=explode(',',$adate1);
    $atime=explode(',',$atime1);
    $no=explode(',',$no1);
    $cname=explode(',',$cname1);
    $address=explode(',',$address1);
    $qty=explode(',',$qty1);
    $description=explode(',',$description1);
    $weight=explode(',',$weight1);

$i=0;
foreach($atype as $atypes){
        if($no[$i]!='') {
$aresa = $db->prepare("INSERT INTO `loadboard_address` (`load_id`,`atype`,`adate`,`atime`,`no`,`cname`,`address`,`qty`,`description`,`weight`) VALUES (?,?,?,?,?,?,?,?,?,?)");
$aresa->execute(array($insert_id,$atypes,$adate[$i],$atime[$i],$no[$i],$cname[$i],$address[$i],$qty[$i],$description[$i],$weight[$i]));
$i++;
}
}


$cmpdetails = FETCH_all("SELECT * FROM `salesman` WHERE salesman_name=? ", $salesman);
$cmpyname=$cmpdetails['company_name'];
$salesmanid=$cmpdetails['id'];

$resa1 = $db->prepare("INSERT INTO `salesman_settlement` (`salesman_name`,`company_name`,`payment_type`,`payment_date`,`cheque_no`,`cheque_date`,`commission_amount`,`load_no`) VALUES (?,?,?,?,?,?,?,?)");
$resa1->execute(array($salesmanid,$cmpyname,$salesman_payment_type,$salesman_payment_date,$salesman_cheque_no,$salesman_cheque_date,$salesman_commission,$load_no));
$hst_percent='';
if($contact!='') { 
$cusdetails = FETCH_all("SELECT * FROM `customer` WHERE customer_name=? ", $contact);
$statedetails=FETCH_all("SELECT * FROM `states` WHERE state=? ", $cusdetails['province_state']);
$hst_percent=$statedetails['hst'];
}
$link22 = FETCH_all("SELECT * FROM `invoice_transaction` WHERE id!=? ORDER BY `id` DESC", 0);
           if($link22['invoice_no']!=''){
            $excode=explode("WT",$link22['invoice_no']);
            $invoice=$excode['1']+1;
                 $invoicecode="WT000000".$invoice;
           }
           else{
             $invoicecode="WT0000001";
           } 

$resa2 = $db->prepare("INSERT INTO `invoice_transaction` (`hst_percent`,`load_no`,`customer_name`,`invoice_no`) VALUES (?,?,?,?)");
$resa2->execute(array($hst_percent,$load_no,$contact,$invoicecode));


        $res = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i>Successfully Inserted</h4></div>';
       

    } 
    else 
    {
   

    $resa = $db->prepare("UPDATE `carrier_confirmation` SET `invoice_received_date`=?,`charging_amount`=?,`status`=?,`note2`=?,`note`=?,`bill_currency`=?,`payment_currency`=?,`bill_amount`=?,`salesman_payment_type`=?,`salesman_payment_date`=?,`salesman_cheque_no`=?,`salesman_cheque_date`=?,`book_date`=?,`book_time`=?,`salesman`=?,`salesman_commission`=?,`payment_type`=?,`payment_date`=?,`cheque_no`=?,`cheque_date`=?,`payment_amount`=?,`carrier`=?,`load_no`=?,`booked_by`=?,`contact`=?,`payment`=? WHERE `id`=? ");

    $resa->execute(array($invoice_received_date,$charging_amount,$status,$note2,$note,$bill_currency,$payment_currency,$bill_amount,$salesman_payment_type,$salesman_payment_date,$salesman_cheque_no,$salesman_cheque_date,$book_date,$book_time,$salesman,$salesman_commission,$payment_type,$payment_date,$cheque_no,$cheque_date,$payment_amount,$carrier,$load_no,$booked_by,$contact,$payment,$getid));



 $atype=explode(',',$atype1);
    $addressid=explode(',',$addressid1);
    $adate=explode(',',$adate1);
    $atime=explode(',',$atime1);
    $no=explode(',',$no1);
    $cname=explode(',',$cname1);
    $address=explode(',',$address1);
    $qty=explode(',',$qty1);
    $description=explode(',',$description1);
    $weight=explode(',',$weight1);

$i=0;
foreach($atype as $atypes){
     if($no[$i]!='') {
    $aid=$addressid[$i];
    if($aid=='') {
$aresa = $db->prepare("INSERT INTO `loadboard_address` (`load_id`,`atype`,`adate`,`atime`,`no`,`cname`,`address`,`qty`,`description`,`weight`) VALUES (?,?,?,?,?,?,?,?,?,?)");
$aresa->execute(array($getid,$atypes,$adate[$i],$atime[$i],$no[$i],$cname[$i],$address[$i],$qty[$i],$description[$i],$weight[$i]));
} else
{
$aresa = $db->prepare("UPDATE `loadboard_address` SET `atype`=?,`adate`=?,`atime`=?,`no`=?,`cname`=?,`address`=?,`qty`=?,`description`=?,`weight`=? WHERE `id`=? ");
$aresa->execute(array($atypes,$adate[$i],$atime[$i],$no[$i],$cname[$i],$address[$i],$qty[$i],$description[$i],$weight[$i],$aid));
}
$i++;
}
}



    $resa1 = $db->prepare("UPDATE `salesman_settlement` SET `salesman_name`=?,`company_name`=?,`payment_type`=?,`payment_date`=?,`cheque_no`=?,`cheque_date`=?,`commission_amount`=? WHERE `load_no`=? ");
$resa1->execute(array($booked_by,$contact,$salesman_payment_type,$salesman_payment_date,$salesman_cheque_no,$salesman_cheque_date,$salesman_commission,$load_no));


      $res = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Successfully Updated!</h4></div>';
  
    }


//Send Mail
    return $res;

}


function getexpense($a, $b)
{
global $db;
$get1 = $db->prepare("SELECT * FROM expense WHERE id=?");
$get1->execute(array($b));
$get = $get1->fetch(PDO::FETCH_ASSOC);
$res = $get[$a];
return $res;
}
//###########GET CUSTOMER#############\\
//###########DELETE CUSTOMER START##########\\
function delexpense($a) {
$b = str_replace(".", ",", $a);
$b = explode(",", $b);
foreach ($b as $c) {
global $db;
$get = $db->prepare("DELETE FROM expense WHERE id = ? ");
$get->execute(array($c));
}
$res = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-close"></i> Successfully Deleted!</h4></div>';
return $res;
}

function addexpense($expense_code,$expense_name,$getid)
    {
    global $db;
    if ($getid == '') 
    {
        $alreadyexist = FETCH_all("SELECT * FROM `expense` WHERE expense_code=? ", $expense_code);
       if($alreadyexist['id']=='') {
        $resa = $db->prepare("INSERT INTO `expense` (`expense_code`,`expense_name`) VALUES (?,?)");
        $resa->execute(array($expense_code,$expense_name));
        $res = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i>Successfully Inserted</h4></div>';
        }
        else
        {
        $res = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-close"></i> Salesman Name Already Exist</h4></div>';
        }
   
    } 
    else 
    {
    $alreadyexist = FETCH_all("SELECT * FROM `expense` WHERE expense_code=? AND `id`!=?", $expense_code,$getid);
    if($alreadyexist['id']=='') {

    $resa = $db->prepare("UPDATE `expense` SET `expense_code`=?,`expense_name`=?  WHERE `id`=? ");

            $resa->execute(array($expense_code,$expense_name,$getid));
      $res = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Successfully Updated!</h4></div>';
  }
        else
        {
            $res = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-close"></i> Salesman Name Already Exist</h4></div>';
        }
    
    }

    return $res;

}



//###########GET CUSTOMER#############\\
//###########DELETE CUSTOMER START##########\\
function getsalesman($a, $b)
{
global $db;
$get1 = $db->prepare("SELECT * FROM salesman WHERE id=?");
$get1->execute(array($b));
$get = $get1->fetch(PDO::FETCH_ASSOC);
$res = $get[$a];
return $res;
}
function delsalesman($a) {
$b = str_replace(".", ",", $a);
$b = explode(",", $b);
foreach ($b as $c) {
global $db;
$get = $db->prepare("DELETE FROM salesman WHERE id = ? ");
$get->execute(array($c));
}
$res = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-close"></i> Successfully Deleted!</h4></div>';
return $res;
}
//###########Delivery MGMNT FUNCTION START###########//
function addsalesman($salesman_name,$company_name,$address1,$address2,$postalcode,$country,$province,$phoneno,$city,$tripcommission,$getid)
    {
    global $db;
    if ($getid == '') 
    {
        $alreadyexist = FETCH_all("SELECT * FROM `salesman` WHERE salesman_name=? ", $salesman_name);
       if($alreadyexist['id']=='') {
        $resa = $db->prepare("INSERT INTO `salesman` (`company_name`,`salesman_name`,`address1`,`address2`,`postalcode`,`country`,`province`,`phoneno`, `city`,`tripcommission`) VALUES (?,?,?,?,?,?,?,?,?,?)");
            $resa->execute(array($company_name,$salesman_name,$address1,$address2,$postalcode,$country,$province,$phoneno,$city,$tripcommission));
            $insert_id = $db->lastInsertId();
            $res = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i>Successfully Inserted</h4></div>';
        }
        else
        {
            $res = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-close"></i> Salesman Name Already Exist</h4></div>';
        }
   
    } 
    else 
    {
 $alreadyexist = FETCH_all("SELECT * FROM `salesman` WHERE salesman_name=? AND `id`!=?", $salesman_name,$getid);
       if($alreadyexist['id']=='') {


    $resa = $db->prepare("UPDATE `salesman` SET `company_name`=?,`salesman_name`=?,`address1`=?,`address2`=?,`postalcode`=?,`country`=?,`province`=?,`phoneno`=?, `city`=?,`tripcommission`=?  WHERE `id`=? ");

            $resa->execute(array($company_name,$salesman_name,$address1,$address2,$postalcode,$country,$province,$phoneno,$city,$tripcommission,$getid));
      $res = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Successfully Updated!</h4></div>';
  }
        else
        {
            $res = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-close"></i> Salesman Name Already Exist</h4></div>';
        }
    
    }

    return $res;

}



//###########GET CUSTOMER#############\\
//###########DELETE CUSTOMER START##########\\
function deldelivery($a) {
$b = str_replace(".", ",", $a);
$b = explode(",", $b);
foreach ($b as $c) {
global $db;
$get = $db->prepare("DELETE FROM delivery WHERE id = ? ");
$get->execute(array($c));
}
$res = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-close"></i> Successfully Deleted!</h4></div>';
return $res;
}
function getdelivery($a, $b)
{
global $db;
$get1 = $db->prepare("SELECT * FROM delivery WHERE id=?");
$get1->execute(array($b));
$get = $get1->fetch(PDO::FETCH_ASSOC);
$res = $get[$a];
return $res;
}

//###########Delivery MGMNT FUNCTION START###########//
function adddelivery($company_name,$contact_name,$address1,$address2,$postalcode,$country,$province,$phoneno,$city,$getid)
    {
    global $db;
    if ($getid == '') 
    {
        $resa = $db->prepare("INSERT INTO `delivery` (`company_name`,`contact_name`,`address1`,`address2`,`postalcode`,`country`,`province`,`phoneno`, `city`) VALUES (?,?,?,?,?,?,?,?,?)");
            $resa->execute(array($company_name,$contact_name,$address1,$address2,$postalcode,$country,$province,$phoneno,$city));
            $insert_id = $db->lastInsertId();
            $res = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i>Successfully Inserted</h4></div>';
   
    } 
    else 
    {



    $resa = $db->prepare("UPDATE `delivery` SET `company_name`=?,`contact_name`=?,`address1`=?,`address2`=?,`postalcode`=?,`country`=?,`province`=?,`phoneno`=?, `city`=?  WHERE `id`=? ");

            $resa->execute(array($company_name,$contact_name,$address1,$address2,$postalcode,$country,$province,$phoneno,$city, $getid));
      $res = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Successfully Updated!</h4></div>';

    
    }

    return $res;

}
//###########GET CUSTOMER#############\\

function getpickup($a, $b)
{
global $db;
$get1 = $db->prepare("SELECT * FROM pickup WHERE id=?");
$get1->execute(array($b));
$get = $get1->fetch(PDO::FETCH_ASSOC);
$res = $get[$a];
return $res;
}
//###########GET CUSTOMER#############\\
//###########DELETE CUSTOMER START##########\\
function delpickup($a) {
$b = str_replace(".", ",", $a);
$b = explode(",", $b);
foreach ($b as $c) {
global $db;
$get = $db->prepare("DELETE FROM pickup WHERE id = ? ");
$get->execute(array($c));
}
$res = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-close"></i> Successfully Deleted!</h4></div>';
return $res;
}
//###########CUSTOMER MGMNT FUNCTION START###########//
function addpickup($company_name,$contact_name,$address1,$address2,$postalcode,$country,$province,$phoneno,$city,$getid)
    {
    global $db;
    if ($getid == '') 
    {
        $resa = $db->prepare("INSERT INTO `pickup` (`company_name`,`contact_name`,`address1`,`address2`,`postalcode`,`country`,`province`,`phoneno`, `city`) VALUES (?,?,?,?,?,?,?,?,?)");
            $resa->execute(array($company_name,$contact_name,$address1,$address2,$postalcode,$country,$province,$phoneno,$city));
            $insert_id = $db->lastInsertId();
            $res = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i>Successfully Inserted</h4></div>';
   
    } 
    else 
    {



    $resa = $db->prepare("UPDATE `pickup` SET `company_name`=?,`contact_name`=?,`address1`=?,`address2`=?,`postalcode`=?,`country`=?,`province`=?,`phoneno`=?, `city`=?  WHERE `id`=? ");

            $resa->execute(array($company_name,$contact_name,$address1,$address2,$postalcode,$country,$province,$phoneno,$city, $getid));
      $res = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Successfully Updated!</h4></div>';

    
    }

    return $res;

}
//###########GET CUSTOMER#############\\
//###########CUSTOMER MGMNT FUNCTION START###########//
function addcarrier($typeofload,$broker_email,$ins_company_name,$policy_no,$policy_exp_date,$broker_tel_no,$remark,$email_dispatch,$currency,$website,$status,$email,$customer_name,$contact_name,$customer_address,$customer_address1,$posta_zip_code,$country,$telephone_admin,$telephone_port,$fax1,$fax2,$province_state,$city,$terms,$surity,$credit_limit,$getid) 
    {
    global $db;
    if ($getid == '') 
    {
$alreadyexist = FETCH_all("SELECT * FROM `carrier` WHERE customer_name=? ", $customer_name);
if($alreadyexist['id']=='') {
    $link22 = FETCH_all("SELECT * FROM `carrier` WHERE id!=? ORDER BY `id` DESC", 0);
           if($link22['customer_code']!=''){
               $customer_code=$link22['customer_code']+1;
           }
           else{
             $customer_code='991240001';
           } 


        $resa = $db->prepare("INSERT INTO `carrier` (`typeofload`,`broker_email`,`ins_company_name`,`policy_no`,`policy_exp_date`,`broker_tel_no`,`remark`,`email_dispatch`,`currency`,`website`,`status`,`email`,`customer_code`,`customer_name`, `contact_name`, `customer_address`, `customer_address1`, `posta_zip_code`, `country`, `telephone_admin`, `telephone_port`, `fax1`, `fax2`,`province_state`,`city`,`terms`,`surity`,`credit_limit`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
            $resa->execute(array($typeofload,$broker_email,$ins_company_name,$policy_no,$policy_exp_date,$broker_tel_no,$remark,$email_dispatch,$currency,$website,$status,$email,$customer_code,$customer_name,$contact_name,$customer_address,$customer_address1,$posta_zip_code,$country,$telephone_admin,$telephone_port,$fax1,$fax2,$province_state,$city,$terms,$surity,$credit_limit));
            $insert_id = $db->lastInsertId();
            $res = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i>Successfully Inserted</h4></div>';
}
else
{
    $res = '<div class="alert alert-warning alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-warning"></i> Company Name Already Exist</h4></div>';
}
       
    } 
    else 
    {

$alreadyexist = FETCH_all("SELECT * FROM `carrier` WHERE customer_name=? AND `id`!=? ", $customer_name,$getid);
if($alreadyexist['id']=='') {

    $resa = $db->prepare("UPDATE `carrier` SET `typeofload`=?,`broker_email`=?,`ins_company_name`=?,`policy_no`=?,`policy_exp_date`=?,`broker_tel_no`=?,`remark`=?,`email_dispatch`=?,`currency`=?,`website`=?,`status`=?, `email`=?, `customer_name`=?, `contact_name`=?, `customer_address`=?, `customer_address1`=?, `posta_zip_code`=?, `country`=?, `telephone_admin`=?,`telephone_port`=?,`fax1`=?, `fax2`=?,`province_state`=?,`city`=?,`terms`=?,`surity`=?,`credit_limit`=?  WHERE `id`=? ");

            $resa->execute(array($typeofload,$broker_email,$ins_company_name,$policy_no,$policy_exp_date,$broker_tel_no,$remark,$email_dispatch,$currency,$website,$status,$email,$customer_name,$contact_name,$customer_address,$customer_address1,$posta_zip_code,$country,$telephone_admin,$telephone_port,$fax1,$fax2,$province_state,$city,$terms,$surity,$credit_limit, $getid));

            // $htry = $db->prepare("INSERT INTO `history` (`page`,`pageid`,`action`,`userid`,`ip`,`actionid`) VALUES (?,?,?,?,?,?)");

            // $htry->execute(array('Cutomer', 3, 'Update', $_SESSION['GRUID'], $ip, $id));

            $res = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Successfully Updated!</h4></div>';

       }
else
{
    $res = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-close"></i> Company Name Already Exist</h4></div>';
}
    }

    return $res;

}
//###########GET CUSTOMER#############\\
function getcarrier($a, $b)
{
global $db;
$get1 = $db->prepare("SELECT * FROM carrier WHERE id=?");
$get1->execute(array($b));
$get = $get1->fetch(PDO::FETCH_ASSOC);
$res = $get[$a];
return $res;
}
//###########GET CUSTOMER#############\\
//###########DELETE CUSTOMER START##########\\
function delcarrier($a) {
$b = str_replace(".", ",", $a);
$b = explode(",", $b);
foreach ($b as $c) {
global $db;
$get = $db->prepare("DELETE FROM carrier WHERE id = ? ");
$get->execute(array($c));
}
$res = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-close"></i> Successfully Deleted!</h4></div>';
return $res;
}
//###########DELETE CUSTOMER END##########\\
//--------------------------------------------------------------------------------\\
//###########carrier mgmnt function end###########//


//###########CUSTOMER MGMNT FUNCTION START###########//
function addcustomer($dob,$remark,$email_dispatch,$currency,$website,$status,$email,$customer_name,$contact_name,$customer_address,$customer_address1,$posta_zip_code,$country,$telephone_admin,$telephone_port,$fax1,$fax2,$province_state,$city,$terms,$surity,$credit_limit,$getid) 
    {
    global $db;
    if ($getid == '') 
    {
$alreadyexist = FETCH_all("SELECT * FROM `customer` WHERE customer_name=? ", $customer_name);
if($alreadyexist['id']=='') {
    $link22 = FETCH_all("SELECT * FROM `customer` WHERE id!=? ORDER BY `id` DESC", 0);
           if($link22['customer_code']!=''){
               $customer_code=$link22['customer_code']+1;
           }
           else{
             $customer_code='991240001';
           } 


        $resa = $db->prepare("INSERT INTO `customer` (`dob`,`remark`,`email_dispatch`,`currency`,`website`,`status`,`email`,`customer_code`,`customer_name`, `contact_name`, `customer_address`, `customer_address1`, `posta_zip_code`, `country`, `telephone_admin`, `telephone_port`, `fax1`, `fax2`,`province_state`,`city`,`terms`,`surity`,`credit_limit`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
            $resa->execute(array($dob,$remark,$email_dispatch,$currency,$website,$status,$email,$customer_code,$customer_name,$contact_name,$customer_address,$customer_address1,$posta_zip_code,$country,$telephone_admin,$telephone_port,$fax1,$fax2,$province_state,$city,$terms,$surity,$credit_limit));
            $insert_id = $db->lastInsertId();
            $res = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i>Successfully Inserted</h4></div>';
}
else
{
    $res = '<div class="alert alert-warning alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-warning"></i> Company Name Already Exist</h4></div>';
}
       
    } 
    else 
    {

$alreadyexist = FETCH_all("SELECT * FROM `customer` WHERE customer_name=? AND `id`!=? ", $customer_name,$getid);
if($alreadyexist['id']=='') {

    $resa = $db->prepare("UPDATE `customer` SET `dob`=?,`remark`=?,`email_dispatch`=?,`currency`=?,`website`=?,`status`=?, `email`=?, `customer_name`=?, `contact_name`=?, `customer_address`=?, `customer_address1`=?, `posta_zip_code`=?, `country`=?, `telephone_admin`=?,`telephone_port`=?,`fax1`=?, `fax2`=?,`province_state`=?,`city`=?,`terms`=?,`surity`=?,`credit_limit`=?  WHERE `id`=? ");

            $resa->execute(array($dob,$remark,$email_dispatch,$currency,$website,$status,$email,$customer_name,$contact_name,$customer_address,$customer_address1,$posta_zip_code,$country,$telephone_admin,$telephone_port,$fax1,$fax2,$province_state,$city,$terms,$surity,$credit_limit, $getid));

            // $htry = $db->prepare("INSERT INTO `history` (`page`,`pageid`,`action`,`userid`,`ip`,`actionid`) VALUES (?,?,?,?,?,?)");

            // $htry->execute(array('Cutomer', 3, 'Update', $_SESSION['GRUID'], $ip, $id));

            $res = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Successfully Updated!</h4></div>';

       }
else
{
    $res = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-close"></i> Company Name Already Exist</h4></div>';
}
    }

    return $res;

}
//###########GET CUSTOMER#############\\
function getcustomer($a, $b)
{
global $db;
$get1 = $db->prepare("SELECT * FROM customer WHERE id=?");
$get1->execute(array($b));
$get = $get1->fetch(PDO::FETCH_ASSOC);
$res = $get[$a];
return $res;
}
//###########GET CUSTOMER#############\\
//###########DELETE CUSTOMER START##########\\
function delcustomer($a) {
$b = str_replace(".", ",", $a);
$b = explode(",", $b);
foreach ($b as $c) {
global $db;
$get = $db->prepare("DELETE FROM customer WHERE id = ? ");
$get->execute(array($c));
}
$res = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-close"></i> Successfully Deleted!</h4></div>';
return $res;
}
//###########DELETE CUSTOMER END##########\\
//--------------------------------------------------------------------------------\\
//###########customer mgmnt function end###########//

//###########staff mgmnt function start###########//
function addstaff($username,$password,$staff_name,$staff_email,$staff_address1,$staff_salary,$staff_address2,$staff_status,$staff_postal_code,$staff_sin_no,$staff_city,$staff_notes,$staff_provience_state,$staff_dob,$staff_country,$staff_hire_date,$staff_home_telephone,$staff_terminate_date,$staff_cell_no,$staff_option,$getid)
    {


    global $db;
    if ($getid == '') 
    {
  $alreadyexist = FETCH_all("SELECT * FROM `staff_tbl` WHERE staff_name=?", $staff_name);
if($alreadyexist['id']=='') {

       $link22 = FETCH_all("SELECT * FROM `staff_tbl` WHERE id!=? ORDER BY `id` DESC", 0);
           if($link22['staff_code']!=''){
               $staff_code=$link22['staff_code']+1;
           }
           else{
             $staff_code='991250001';
           } 


        $resa = $db->prepare("INSERT INTO `staff_tbl` (`username`,`password`,`staff_code`,`staff_name`,`staff_email`,`staff_address1`,`staff_salary`,`staff_address2`,`staff_status`,`staff_postal_code`,`staff_sin_no`,`staff_city`,`staff_notes`,`staff_provience_state`,`staff_dob`,`staff_country`,`staff_hire_date`,`staff_home_telephone`,`staff_cell_no`,`staff_option`,`staff_terminate_date`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

            $resa->execute(array($username,$password,$staff_code,$staff_name,$staff_email,$staff_address1,$staff_salary,$staff_address2,$staff_status,$staff_postal_code,$staff_sin_no,$staff_city,$staff_notes,$staff_provience_state,$staff_dob,$staff_country,$staff_hire_date,$staff_home_telephone,$staff_cell_no,$staff_option,$staff_terminate_date));
            $insert_id = $db->lastInsertId();


//create user
$uresa = $db->prepare("INSERT INTO users (`name`, `type`, `typeid`, `val1`, `val2`, `val3`, `emailid`, `mobileno`, `orgpassword`,`status`) VALUES (?,?,?,?,?,?,?,?,?,?)" );
$uresa->execute(array($staff_name,'staff',$insert_id,$username,md5($password),'1',$staff_email,$staff_cell_no,$password,'1'));
//create user


            $res = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i>Successfully Inserted</h4></div>';

        } 
        else 
        {

            $res = '<div class="alert alert-warning alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-warning"></i> Staff Name Already Exist</h4></div>';

        }

    } 
    else 
    {
 
   $alreadyexist = FETCH_all("SELECT * FROM `staff_tbl` WHERE staff_name=? AND `id`!=?", $staff_name,$getid);
if($alreadyexist['id']=='') {

    $resa = $db->prepare("UPDATE `staff_tbl` SET `username`=?,`password`=?,`staff_name`=?, `staff_email`=?, `staff_address1`=?, `staff_salary`=?, `staff_address2`=?, `staff_status`=?, `staff_postal_code`=?, `staff_sin_no`=?,`staff_city`=?,`staff_notes`=?, `staff_provience_state`=?,`staff_dob`=?,`staff_country`=?,`staff_hire_date`=?,`staff_home_telephone`=?,`staff_cell_no`=?,`staff_option`=?  WHERE `id`=? ");
            $resa->execute(array($username,$password,$staff_name,$staff_email,$staff_address1,$staff_salary,$staff_address2,$staff_status,$staff_postal_code,$staff_sin_no,$staff_city,$staff_notes,$staff_provience_state,$staff_dob,$staff_country,$staff_hire_date,$staff_home_telephone,$staff_cell_no,$staff_option,$getid));

 $alreadyexistuser = FETCH_all("SELECT * FROM `users` WHERE typeid=?", $getid);
 if($alreadyexistuser==0) {
//create user
$uresa = $db->prepare("INSERT INTO users (`name`, `type`, `typeid`, `val1`, `val2`, `val3`, `emailid`, `mobileno`, `orgpassword`, `status`) VALUES (?,?,?,?,?,?,?,?,?,?)" );
$uresa->execute(array($staff_name,'staff',$getid,$username,md5($password),'1',$staff_email,$staff_cell_no,$password,'1'));
//create user

 }
 else{
 //update user
$uresa = $db->prepare("UPDATE users SET `name`=?, `val1`=?, `val2`=?, `val3`=?, `emailid`=?, `mobileno`=?, `orgpassword`=?, `status`=? WHERE `typeid`=? AND `type`=? " );
$uresa->execute(array($staff_name,$username,md5($password),'1',$staff_email,$staff_cell_no,$password,'1',$getid,'staff'));
//update user
}

$res = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Successfully Updated!</h4></div>';
}

   else 
        {
            $res = '<div class="alert alert-warning alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-warning"></i> Staff Name Already Exist</h4></div>';

        }     

    }

    return $res;

}

function getstaff($a, $b) {
global $db;
$get1 = $db->prepare("SELECT * FROM staff_tbl WHERE id=?");
$get1->execute(array($b));
$get = $get1->fetch(PDO::FETCH_ASSOC);
$res = $get[$a];
return $res;
}

function delstaff($a) {
$b = str_replace(".", ",", $a);
$b = explode(",", $b);
foreach ($b as $c) {
global $db;
$get = $db->prepare("DELETE FROM staff_tbl WHERE id = ? ");
$get->execute(array($c));
}
$res = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-close"></i> Successfully Deleted!</h4></div>';
return $res;
}

//###########staff mgmnt function end###########//



function Imageuploadd($fileName, $Size, $maxW, $fullPath, $relPath, $colorR, $colorG, $colorB, $maxH, $file, $tmpname) {

    $folder = $relPath;
//$maxlimit = $maxSize;
    $allowed_ext = "jpg,jpeg,gif,png,bmp";
    $match = "";

    if ($Size > 0) {
        $filename = strtolower($fileName);
        $filename = preg_replace('/\s/', '_', $filename);
        if ($Size < 1) {
            $errorList[] = "File size is empty.";
        }
        /* if($filesize > $maxlimit){ 
          $errorList[] = "File size is too big.";
          } */
        if (count($errorList) < 1) {
            $file_ext = preg_split("/\./", $filename);
            $allowed_ext = preg_split("/\,/", $allowed_ext);
            foreach ($allowed_ext as $ext) {
                if ($ext == end($file_ext)) {
                    $match = "1"; // File is allowed
                    $NUM = time();
                    $front_name = substr($file_ext[0], 0, 15);
                    $newfilename = $file . "." . end($file_ext);
                    $filetype = end($file_ext);
                    $save = $folder . $newfilename;
                    if (!file_exists($save)) {
                        list($width_orig, $height_orig) = getimagesize($tmpname);
                        $width_orig . "-" . $height_orig;
                        if ($maxH == null) {
                            if ($width_orig < $maxW) {
                                $fwidth = $width_orig;
                            } else {
                                $fwidth = $maxW;
                            }
                            $ratio_orig = $width_orig / $height_orig;
                            $fheight = $fwidth / $ratio_orig;

                            $blank_height = $fheight;
                            $top_offset = 0;
                        } else {
                            if ($width_orig <= $maxW && $height_orig <= $maxH) {
                                $fheight = $height_orig;
                                $fwidth = $width_orig;
                            } else {
                                if ($width_orig > $maxW) {
                                    $ratio = ($width_orig / $maxW);
                                    $fwidth = $maxW;
                                    $fheight = ($height_orig / $ratio);
                                    if ($fheight > $maxH) {
                                        $ratio = ($fheight / $maxH);
                                        $fheight = $maxH;
                                        $fwidth = ($fwidth / $ratio);
                                    }
                                }
                                if ($height_orig > $maxH) {
                                    $ratio = ($height_orig / $maxH);
                                    $fheight = $maxH;
                                    $fwidth = ($width_orig / $ratio);
                                    if ($fwidth > $maxW) {
                                        $ratio = ($fwidth / $maxW);
                                        $fwidth = $maxW;
                                        $fheight = ($fheight / $ratio);
                                    }
                                }
                            }
                            if ($fheight == 0 || $fwidth == 0 || $height_orig == 0 || $width_orig == 0) {
                                die("FATAL ERROR REPORT ERROR CODE [add-pic-line-67-orig] to <a href='https://www.nbaysmart.com/'>NBAYSMART</a>");
                            }
                            if ($fheight < 45) {
                                $blank_height = 45;
                                $top_offset = round(($blank_height - $fheight) / 2);
                            } else {
                                $blank_height = $fheight;
                            }
                        }
                        $imaall_p = imagecreatetruecolor($fwidth, $blank_height);
                        $white = imagecolorallocate($imaall_p, $colorR, $colorG, $colorB);
                        imagefill($imaall_p, 0, 0, $white);
                        switch ($filetype) {
                            case "gif":
                                $image = @imagecreatefromgif($tmpname);
                                break;
                            case "jpg":
                                $image = @imagecreatefromjpeg($tmpname);
                                break;
                            case "jpeg":
                                $image = @imagecreatefromjpeg($tmpname);
                                break;
                            case "png":
                                $image = @imagecreatefrompng($tmpname);
                                break;
                        }
                        @imagecopyresampled($imaall_p, $image, 0, $top_offset, 0, 0, $fwidth, $fheight, $width_orig, $height_orig);
                        $black = imagecolorallocatealpha($imaall_p, 158, 155, 159, 70);
                        $font = '../monofont.ttf';
                        $font_size = 15;
                        imagettftext($imaall_p, $font_size, 0, 10, 90, $black, $font, $WaterMarkText);

                        switch ($filetype) {
                            case "gif":
                                if (!@imagegif($imaall_p, $save)) {
                                    $errorList[] = "PERMISSION DENIED [GIF]";
                                }
                                break;
                            case "jpg":
                                if (!@imagejpeg($imaall_p, $save, 100)) {
                                    $errorList[] = "PERMISSION DENIED [JPG]";
                                }
                                break;
                            case "jpeg":
                                if (!@imagejpeg($imaall_p, $save, 100)) {
                                    $errorList[] = "PERMISSION DENIED [JPEG]";
                                }
                                break;
                            case "png":
                                if (!@imagepng($imaall_p, $save, 0)) {
                                    $errorList[] = "PERMISSION DENIED [PNG]";
                                }
                                break;
                        }
                        @imagedestroy($filename);
                    } else {
                        $errorList[] = "CANNOT MAKE IMAGE IT ALREADY EXISTS";
                    }
                }
            }
        }
    } else {
        $errorList[] = "NO FILE SELECTED";
    }
    if (!$match) {
        $errorList[] = "File type isn't allowed: $filename";
    }
    if (sizeof($errorList) == 0) {
        return $fullPath . $newfilename;
    } else {
        $eMessage = array();
        for ($x = 0; $x < sizeof($errorList); $x++) {
            $eMessage[] = $errorList[$x];
        }
        return $eMessage;
    }
}




////////////End////////////////////

function generateRandomString($length = 6) {
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}



function getusers($a, $b) {
    global $db;
    $get1 = $db->prepare("SELECT * FROM `users` WHERE `id`=?");
    $get1->execute(array($b));
    $get = $get1->fetch(PDO::FETCH_ASSOC);
    $res = $get[$a];
    return $res;
}

function LoginCheck($a = '', $b = '', $c = '', $d = '', $e = '') {

    global $db;
    if (($a == '') || ($b == '')) {
        $res = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button><i class="icon fa fa-close"></i>Email or Password was empty</div>';
    } else {
        if ($e == '') {
            $stmt = $db->prepare("SELECT * FROM `users` WHERE `val1`=? AND `val3`=?");
            $stmt->execute(array($a, 1));
            $ress = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($ress['id'] != '') {
                if ($ress['val2'] == md5($b)) {
                    $res = "Hurray! You will redirect into dashboard soon";
					
                    $_SESSION['GRUID'] = $ress['id'];
                    $_SESSION['Gpassword'] = $ress['orgpassword'];
                    $_SESSION['policestation'] = $ress['policestation'];
                    $_SESSION['type'] = 'admin';
                     $_SESSION['name'] = $ress['val1'];
                     $_SESSION['usertype'] = $ress['type'];
                     $_SESSION['usertypeid'] = $ress['typeid'];
                    @extract($ress);
                    if ($id != '') {
                        $e = date('Y-m-d H:i:s');
                        $sql = 'INSERT INTO `admin_history`(admin_uid,ip,checkintime) VALUES(?,?,?)';
                        $stmt1 = $db->prepare($sql);
                        $stmt1->execute(array($id, $c, $e));
                        $_SESSION['admhistoryid'] = $db->lastInsertId();
                        if ($d == '1') {
                            //if rememberme checkbox checked
                            setcookie('lemail', $a, time() + (60 * 60 * 24 * 10)); //Means 10 days change value of 10 to how many days as you want to remember the user details on user's computer
                            setcookie('lpass', $b, time() + (60 * 60 * 24 * 10));  //Here two coockies created with username and password as cookie names, $username,$password (login crediantials) as corresponding values
                        }
                    }
                } elseif ($ress['val3'] == 0) {
                    $res = '<div class="alert alert-danger alert-dismissible" id="hideDiv" style="font-size:14px;"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button><i class="icon fa fa-close"></i> Your Account was deactivated by Admin</div>';
                } else {
                    $res = '<div class="alert alert-danger alert-dismissible" id="hideDiv" style="font-size:14px;"><i class="icon fa fa-close"></i> User name or Password was Incorrect</div>';
                }
            } 
            else
            {
               $res = '<div class="alert alert-danger alert-dismissible" id="hideDiv" style="font-size:14px;"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button><i class="icon fa fa-close"></i> Your Account was deactivated by Admin</div>';  
            }
            return $res;
        }
    }
}



function logout() {
    global $db;
    $sql = $db->prepare("UPDATE `admin_history` SET `checkouttime`='" . date('Y-m-d H:i:s') . "' WHERE `id`=?");
    $sql->execute(array($_SESSION['admhistoryid']));
    // DB("UPDATE `admin_history` SET `checkouttime`='" . date('Y-m-d H:i:s') . "' WHERE `id`='" . $_SESSION['admhistoryid'] . "'");
}

function companylogos($a) {
    //$getlogo = mysql_fetch_array(mysql_query("SELECT `image` FROM `profile_area` WHERE `pid`='" . $a . "'"));
    global $db;
    $getlogo1 = $db->prepare("SELECT `image` FROM `profile_area` WHERE `pid`=?");
    $getlogo1->execute(array($a));
    $getlogo = $getlogo1->fetch(PDO::FETCH_ASSOC);
    if ($getlogo['image'] != '') {
        $res = $getlogo['image'];
    } else {
        $res = $sitename . 'data/profile/logo.png';
    }
    return $res;
}

function addprofile($tax,$title, $firstname, $lastname, $image, $cmpnyname, $recoveryemail, $phonenumber,$mail_option, $caddress, $abn, $ip,$bank_name,$branch_name,$account_name,$account_no,$ifsc_code,$swift_code,$branch_address, $id) {
    global $db;
    if ($id == '') {
        $resa = $db->prepare("INSERT INTO `manageprofile` (`tax`,`title`,`firstname`,`lastname`,`image`,`Company_name`,`recoveryemail`,`phonenumber`,`caddress`,`abn`,`ip`,`mail`,`bank_name`,`branch_name`,`account_name`,`account_no`,`ifsc_code`,`swift_code`,`branch_address`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $resa->execute(array($tax,$title, $firstname, $lastname, $image, $cmpnyname, $recoveryemail, $phonenumber, $caddress, $abn, $ip,$mail_option,$bank_name,$branch_name,$account_name,$account_no,$ifsc_code,$swift_code,$branch_address));
        $res = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button><h4><i class="icon fa fa-check"></i>Successfully Inserted</h4></div>';
    } else {
        
        $resa = $db->prepare("UPDATE `manageprofile` SET `tax`=?,`title`=?,`firstname`=?,`lastname`=?,`image`=?,`Company_name`=?,`recoveryemail`=?,`phonenumber`=?,`caddress`=?,`abn`=?,`ip`=?,`mail`=?,`bank_name`=?,`branch_name`=?,`account_name`=?,`account_no`=?,`ifsc_code`=?,`swift_code`=?,`branch_address`=? WHERE `pid`=?");
        $resa->execute(array($tax,$title, $firstname, $lastname, $image, $cmpnyname, $recoveryemail, $phonenumber, $caddress, $abn, $ip,$mail_option,$bank_name,$branch_name,$account_name,$account_no,$ifsc_code,$swift_code,$branch_address, $id));
        $res = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button><h4><i class="icon fa fa-check"></i> Successfully Updated</h4></div>';
    }

    return $res;
}

function getprofile($a, $b) {
    global $db;
    $get1 = $db->prepare("SELECT * FROM `manageprofile` WHERE `pid`=?");
    $get1->execute(array($b));
    $get = $get1->fetch(PDO::FETCH_ASSOC);
    $res = $get[$a];
    return $res;
}


function compress_image($destination_url, $quality) {

    $info = getimagesize($destination_url);

    if ($info['mime'] == 'image/jpeg')
        $image = imagecreatefromjpeg($destination_url);

    elseif ($info['mime'] == 'image/gif')
        $image = imagecreatefromgif($destination_url);

    elseif ($info['mime'] == 'image/png')
        $image = imagecreatefrompng($destination_url);

    imagejpeg($image, $destination_url, $quality);
    return $destination_url;
}

?>