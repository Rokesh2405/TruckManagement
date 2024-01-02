<?php 
include ('../../config/config.inc.php');

global $db; 

if($_REQUEST['cusid']!='') 
{
    $cusid=$_REQUEST['cusid'];
 
 $smessage1 = $db->prepare("SELECT * FROM `customer` WHERE `id`!='0' AND (`customer_code` LIKE '%".$cusid."%') ");
     $smessage1->execute();
     $scommsilist = $smessage1->fetch(PDO::FETCH_ASSOC);
     $customer_name=$scommsilist['customer_name'];
$contact_name=$scommsilist['contact_name'];
$currency=$scommsilist['currency'];
$customer_address=$scommsilist['customer_address'];
$customer_address1=$scommsilist['customer_address1'];
$email_dispatch=$scommsilist['email_dispatch'];
$posta_zip_code=$scommsilist['posta_zip_code'];
$country=$scommsilist['country'];
$email=$scommsilist['email'];
$telephone_admin=$scommsilist['telephone_admin'];
$telephone_port=$scommsilist['telephone_port'];
$website=$scommsilist['website'];
$fax1=$scommsilist['fax1'];
$fax2=$scommsilist['fax2'];
$status=$scommsilist['status'];
$province_state=$scommsilist['province_state'];
$city=$scommsilist['city'];
$terms=$scommsilist['terms'];
$surity=$scommsilist['surity'];
$credit_limit=$scommsilist['credit_limit'];
$remark=$scommsilist['remark'];

echo $customer_name.'#'.$contact_name.'#'.$currency.'#'.$customer_address.'#'.$customer_address1.'#'.$email_dispatch.'#'.$posta_zip_code.'#'.$country.'#'.$email.'#'.$telephone_admin.'#'.$telephone_port.'#'.$website.'#'.$fax1.'#'.$fax2.'#'.$status.'#'.$province_state.'#'.$city.'#'.$terms.'#'.$surity.'#'.$credit_limit.'#'.$scommsilist['id'].'#'.$remark;
exit;
}

if($_REQUEST['carrier']!='') 
{
    $cusid=$_REQUEST['carrier'];
 
 $smessage1 = $db->prepare("SELECT * FROM `carrier` WHERE `id`='".$cusid."' ");
     $smessage1->execute();
     $scommsilist = $smessage1->fetch(PDO::FETCH_ASSOC);
     $customer_name=$scommsilist['customer_name'];
$contact_name=$scommsilist['contact_name'];
$currency=$scommsilist['currency'];
$customer_address=$scommsilist['customer_address'];
$customer_address1=$scommsilist['customer_address1'];
$email_dispatch=$scommsilist['email_dispatch'];
$posta_zip_code=$scommsilist['posta_zip_code'];
$country=$scommsilist['country'];
$email=$scommsilist['email'];
$telephone_admin=$scommsilist['telephone_admin'];
$telephone_port=$scommsilist['telephone_port'];
$website=$scommsilist['website'];
$fax1=$scommsilist['fax1'];
$fax2=$scommsilist['fax2'];
$status=$scommsilist['status'];
$province_state=$scommsilist['province_state'];
$city=$scommsilist['city'];
$terms=$scommsilist['terms'];
$surity=$scommsilist['surity'];
$credit_limit=$scommsilist['credit_limit'];
$remark=$scommsilist['remark'];


echo $customer_name.'#'.$contact_name.'#'.$currency.'#'.$customer_address.'#'.$customer_address1.'#'.$email_dispatch.'#'.$posta_zip_code.'#'.$country.'#'.$email.'#'.$telephone_admin.'#'.$telephone_port.'#'.$website.'#'.$fax1.'#'.$fax2.'#'.$status.'#'.$province_state.'#'.$city.'#'.$terms.'#'.$surity.'#'.$credit_limit.'#'.$scommsilist['id'].'#'.$remark;
exit;
}


if($_REQUEST['customer']!='') 
{
    $cusid=$_REQUEST['customer'];
 
 $smessage1 = $db->prepare("SELECT * FROM `customer` WHERE `id`='".$cusid."' ");
     $smessage1->execute();
     $scommsilist = $smessage1->fetch(PDO::FETCH_ASSOC);
     $customer_name=$scommsilist['customer_name'];
$contact_name=$scommsilist['contact_name'];
$currency=$scommsilist['currency'];
$customer_address=$scommsilist['customer_address'];
$customer_address1=$scommsilist['customer_address1'];
$email_dispatch=$scommsilist['email_dispatch'];
$posta_zip_code=$scommsilist['posta_zip_code'];
$country=$scommsilist['country'];
$email=$scommsilist['email'];
$telephone_admin=$scommsilist['telephone_admin'];
$telephone_port=$scommsilist['telephone_port'];
$website=$scommsilist['website'];
$fax1=$scommsilist['fax1'];
$fax2=$scommsilist['fax2'];
$status=$scommsilist['status'];
$province_state=$scommsilist['province_state'];
$city=$scommsilist['city'];
$terms=$scommsilist['terms'];
$surity=$scommsilist['surity'];
$credit_limit=$scommsilist['credit_limit'];
$remark=$scommsilist['remark'];


echo $customer_name.'#'.$contact_name.'#'.$currency.'#'.$customer_address.'#'.$customer_address1.'#'.$email_dispatch.'#'.$posta_zip_code.'#'.$country.'#'.$email.'#'.$telephone_admin.'#'.$telephone_port.'#'.$website.'#'.$fax1.'#'.$fax2.'#'.$status.'#'.$province_state.'#'.$city.'#'.$terms.'#'.$surity.'#'.$credit_limit.'#'.$scommsilist['id'].'#'.$remark;
exit;
}


if($_REQUEST['staffcode']!='') 
{
    $cusid=$_REQUEST['staffcode'];
 
 $smessage1 = $db->prepare("SELECT * FROM `staff_tbl` WHERE `id`!='0' AND (`staff_code` LIKE '%".$cusid."%') ");
     $smessage1->execute();
     $scommsilist = $smessage1->fetch(PDO::FETCH_ASSOC);
      $staff_code=$scommsilist['staff_code'];
     $staff_name=$scommsilist['staff_name'];
$staff_email=$scommsilist['staff_email'];
$staff_address1=$scommsilist['staff_address1'];
$staff_salary=$scommsilist['staff_salary'];
$staff_address2=$scommsilist['staff_address2'];
$staff_status=$scommsilist['staff_status'];
$staff_postal_code=$scommsilist['staff_postal_code'];
$staff_sin_no=$scommsilist['staff_sin_no'];
$staff_city=$scommsilist['staff_city'];
$staff_notes=$scommsilist['staff_notes'];
$staff_provience_state=$scommsilist['staff_provience_state'];
$staff_dob=$scommsilist['staff_dob'];
$staff_country=$scommsilist['staff_country'];
$staff_hire_date=$scommsilist['staff_hire_date'];
$staff_home_telephone=$scommsilist['staff_home_telephone'];
$staff_cell_no=$scommsilist['staff_cell_no'];
$staff_option=$scommsilist['staff_option'];
$staff_terminate_date=$scommsilist['staff_terminate_date'];

echo $staff_name.'#'.$staff_email.'#'.$staff_address1.'#'.$staff_salary.'#'.$staff_address2.'#'.$staff_status.'#'.$staff_postal_code.'#'.$staff_sin_no.'#'.$staff_city.'#'.$staff_notes.'#'.$staff_provience_state.'#'.$staff_dob.'#'.$staff_country.'#'.$staff_hire_date.'#'.$staff_home_telephone.'#'.$staff_cell_no.'#'.$staff_option.'#'.$staff_terminate_date.'#'.$scommsilist['id'].'#'.$staff_code;
exit;
}
	

if($_REQUEST['staff']!='') 
{
    $cusid=$_REQUEST['staff'];
 
 $smessage1 = $db->prepare("SELECT * FROM `staff_tbl` WHERE `id`='".$cusid."'");
     $smessage1->execute();
     $scommsilist = $smessage1->fetch(PDO::FETCH_ASSOC);
      $staff_code=$scommsilist['staff_code'];
     $staff_name=$scommsilist['staff_name'];
$staff_email=$scommsilist['staff_email'];
$staff_address1=$scommsilist['staff_address1'];
$staff_salary=$scommsilist['staff_salary'];
$staff_address2=$scommsilist['staff_address2'];
$staff_status=$scommsilist['staff_status'];
$staff_postal_code=$scommsilist['staff_postal_code'];
$staff_sin_no=$scommsilist['staff_sin_no'];
$staff_city=$scommsilist['staff_city'];
$staff_notes=$scommsilist['staff_notes'];
$staff_provience_state=$scommsilist['staff_provience_state'];
$staff_dob=$scommsilist['staff_dob'];
$staff_country=$scommsilist['staff_country'];
$staff_hire_date=$scommsilist['staff_hire_date'];
$staff_home_telephone=$scommsilist['staff_home_telephone'];
$staff_cell_no=$scommsilist['staff_cell_no'];
$staff_option=$scommsilist['staff_option'];
$staff_terminate_date=$scommsilist['staff_terminate_date'];

echo $staff_name.'#'.$staff_email.'#'.$staff_address1.'#'.$staff_salary.'#'.$staff_address2.'#'.$staff_status.'#'.$staff_postal_code.'#'.$staff_sin_no.'#'.$staff_city.'#'.$staff_notes.'#'.$staff_provience_state.'#'.$staff_dob.'#'.$staff_country.'#'.$staff_hire_date.'#'.$staff_home_telephone.'#'.$staff_cell_no.'#'.$staff_option.'#'.$staff_terminate_date.'#'.$scommsilist['id'].'#'.$staff_code;
exit;
}
    


?>