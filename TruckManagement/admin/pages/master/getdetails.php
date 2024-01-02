<?php 
include ('../../config/config.inc.php');
$response=array();

if($_REQUEST['salesmanamt'] !=''){
 $search = $_REQUEST['salesmanamt'];
$customer = pFETCH("SELECT * FROM `salesman` WHERE id='".$search."'  AND `id`!=?", '0');
$row = $customer->fetch(PDO::FETCH_ASSOC);


$carri = pFETCH("SELECT * FROM `carrier_confirmation` WHERE load_no='".$_REQUEST['load_no']."' AND `id`!=? ", '0');
$carrirow = $carri->fetch(PDO::FETCH_ASSOC);

$invtrans = pFETCH("SELECT * FROM `invoice_transaction` WHERE load_no='".$_REQUEST['load_no']."' AND `id`!=? ", '0');
$invtransrow = $invtrans->fetch(PDO::FETCH_ASSOC);

if($carrirow['bill_amount']>$invtransrow['charge']) {
$finalamt=$carrirow['bill_amount']-$invtransrow['charge'];
$calu=$finalamt*($row['tripcommission']/100);
}
if($carrirow['bill_amount']<$invtransrow['charge']) {
$finalamt=$invtransrow['charge']-$carrirow['bill_amount'];
$calu=$finalamt*($row['tripcommission']/100);
}

 echo $calu.'#'.$row['company_name'];
 exit;
}

if($_REQUEST['salesman'] !=''){
 $search = $_REQUEST['salesman'];
$payment=$_REQUEST['payment'];
$customer = pFETCH("SELECT * FROM `salesman` WHERE salesman_name='".$search."'  AND `id`!=?", '0');
$row = $customer->fetch(PDO::FETCH_ASSOC);
 $calu=$payment*($row['tripcommission']/100);
 echo $calu;
 exit;
}

if($_POST['request'] == 77){
 $search = $_POST['search'];
$customer = pFETCH("SELECT * FROM `salesman` WHERE salesman_name like'%".$search."%'  AND `id`!=?", '0');
while ($row = $customer->fetch(PDO::FETCH_ASSOC)) 
{
    $labl=$row['salesman_name'];
  $response[] = array("value"=>$row['salesman_name'],"label"=>$labl);
 }

 // encoding array to json format
 echo json_encode($response);
 exit;
 
 
}


if($_REQUEST['pickup'] !=''){
 $search = $_REQUEST['pickup'];

$customer = pFETCH("SELECT * FROM `pickup` WHERE company_name='".$search."'  AND `id`!=?", '0');
$row = $customer->fetch(PDO::FETCH_ASSOC);
 // encoding array to json format
 echo $row['address1'].','.$row['address2'].','.$row['province'].','.$row['city'].','.$row['country'].','.$row['postalcode'];
 exit;
}

if($_REQUEST['delivery'] !=''){
 $search = $_REQUEST['delivery'];

$customer = pFETCH("SELECT * FROM `pickup` WHERE company_name='".$search."'  AND `id`!=?", '0');
$row = $customer->fetch(PDO::FETCH_ASSOC);
 // encoding array to json format
 echo $row['address1'].','.$row['address2'].','.$row['province'].','.$row['city'].','.$row['country'].','.$row['postalcode'];
 exit;
}


if($_POST['request'] == 88){
 $search = $_POST['search'];
$customer = pFETCH("SELECT * FROM `pickup` WHERE company_name like'%".$search."%'  AND `id`!=?", '0');
while ($row = $customer->fetch(PDO::FETCH_ASSOC)) 
{
    $labl=$row['company_name'];
  $response[] = array("value"=>$row['company_name'],"label"=>$labl);
 }

 // encoding array to json format
 echo json_encode($response);
 exit;
 
 
}
if($_POST['request'] == 99){
 $search = $_POST['search'];
$customer = pFETCH("SELECT * FROM `delivery` WHERE company_name like'%".$search."%'  AND `id`!=?", '0');
while ($row = $customer->fetch(PDO::FETCH_ASSOC)) 
{
    $labl=$row['company_name'];
  $response[] = array("value"=>$row['company_name'],"label"=>$labl);
 }

 // encoding array to json format
 echo json_encode($response);
 exit;
 
 
}


if($_POST['request'] == 124){
 $search = $_POST['search'];
$customer = pFETCH("SELECT * FROM `pickup` WHERE contact_name like'%".$search."%'  AND `id`!=?", '0');
while ($row = $customer->fetch(PDO::FETCH_ASSOC)) 
{
    $labl=$row['contact_name'];
  $response[] = array("value"=>$row['contact_name'],"label"=>$labl);
 }

 // encoding array to json format
 echo json_encode($response);
 exit;
 
 
}


if($_POST['request'] == 125){
    $search = $_POST['search'];
$customer = pFETCH("SELECT * FROM `carrier` WHERE customer_name like'%".$search."%'  AND `id`!=?", '0');
while ($row = $customer->fetch(PDO::FETCH_ASSOC)) 
{
    $labl=$row['customer_name'];
  $response[] = array("value"=>$row['customer_name'],"label"=>$labl);
 }

 // encoding array to json format
 echo json_encode($response);
 exit;
 

}


if($_POST['request'] == 123){
 $search = $_POST['search'];
$customer = pFETCH("SELECT * FROM `staff_tbl` WHERE staff_name like'%".$search."%'  AND `id`!=?", '0');
while ($row = $customer->fetch(PDO::FETCH_ASSOC)) 
{
    $labl=$row['staff_name'];
  $response[] = array("value"=>$row['staff_name'],"label"=>$labl);
 }

 // encoding array to json format
 echo json_encode($response);
 exit;
 
}

if($_POST['request'] == 11){
 $search = $_POST['search'];
$customer = pFETCH("SELECT * FROM `carrier_confirmation` WHERE load_no like'%".$search."%'  AND `id`!=?", '0');
while ($row = $customer->fetch(PDO::FETCH_ASSOC)) 
{
    $labl=$row['load_no'];
  $response[] = array("value"=>$row['load_no'],"label"=>$labl);
 }

 // encoding array to json format
 echo json_encode($response);
 exit;
 
}
if($_POST['request'] == 1){
 $search = $_POST['search'];
$customer = pFETCH("SELECT * FROM `customer` WHERE customer_name like'%".$search."%'  AND `id`!=?", '0');
while ($row = $customer->fetch(PDO::FETCH_ASSOC)) 
{
	$labl=$row['customer_name'];
  $response[] = array("value"=>$row['customer_name'],"label"=>$labl);
 }

 // encoding array to json format
 echo json_encode($response);
 exit;
 
}

if($_POST['request'] == 21){
 $search = $_POST['search'];
$customer = pFETCH("SELECT * FROM `steamship` WHERE steamship like'%".$search."%'  AND `id`!=?", '0');
while ($row = $customer->fetch(PDO::FETCH_ASSOC)) 
{
    $labl=$row['steamship'];
  $response[] = array("value"=>$row['steamship'],"label"=>$labl);
 }

 // encoding array to json format
 echo json_encode($response);
 exit;
}

if($_POST['request'] == 2){
 $search = $_POST['search'];
$customer = pFETCH("SELECT * FROM `driver_tbl` WHERE driver_name like'%".$search."%'  AND `id`!=?", '0');
while ($row = $customer->fetch(PDO::FETCH_ASSOC)) 
{
    $labl=$row['driver_name'];
  $response[] = array("value"=>$row['driver_name'],"label"=>$labl);
 }

 // encoding array to json format
 echo json_encode($response);
 exit;
}


if($_POST['request'] == 3){
 $search = $_POST['search'];
$customer = pFETCH("SELECT * FROM `truck_tbl` WHERE company_name like'%".$search."%'  AND `id`!=?", '0');
while ($row = $customer->fetch(PDO::FETCH_ASSOC)) 
{
    $labl=$row['company_name'];
  $response[] = array("value"=>$row['company_name'],"label"=>$labl);
 }

 // encoding array to json format
 echo json_encode($response);
 exit;
}


if($_REQUEST['drivername'] !=''){
 $search = $_REQUEST['drivername'];

$customer = pFETCH("SELECT * FROM `driver_tbl` WHERE driver_name='".$search."'  AND `id`!=?", '0');
$row = $customer->fetch(PDO::FETCH_ASSOC);
 // encoding array to json format
 echo $row['telephone_home'];
 exit;
}
?>