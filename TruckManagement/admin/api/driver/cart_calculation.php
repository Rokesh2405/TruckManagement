<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// error_reporting(0);

$token= "";

// Code for enable getallheaders function 


if (!function_exists('getallheaders')) {
    function getallheaders() {
    $headers = [];
    foreach ($_SERVER as $name => $value) {
        if (substr($name, 0, 5) == 'HTTP_') {
            $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
        }
    }
    return $headers;
    }
}

// Code for enable getallheaders function 


foreach(getallheaders() as $name => $value)
{
 if($name=="Token")
 {
 $token=$value;    
 }
}

// include database and object files
include_once '../config/core.php';
include_once '../config/database.php';
include_once '../objects/form.php';
include_once '../objects/functions.php';
// instantiate database and patient object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$form = new Form($db);


$data = json_decode(file_get_contents("php://input"));

$checkvaliduser = $db->prepare("SELECT * FROM `driver` WHERE `token`='".$token."' ORDER BY `id` ASC");
$checkvaliduser->execute();
 $checknum = $checkvaliduser->rowCount();
if($checknum>0)  {


$checkorder = $db->prepare("SELECT * FROM `norder` WHERE `product_id`='".$data->product_name."' AND `order_id`='".$data->order_id."' ORDER BY `id` ASC");
$checkorder->execute();
$checkordernum = $checkorder->rowCount();
if($checkordernum==0) {  
 
if($data->weight!='' && $data->per_kg_amount!='' && $data->cart_id!='' && $data->order_id!='') {

$totalamount=$data->weight*$data->per_kg_amount;
$query = "UPDATE `norder` SET
                    weight='".$data->weight."',rate_per_kg='".$data->per_kg_amount."',total='".$totalamount."' WHERE id='".$data->cart_id."'";
$stmt = $db->prepare($query);
$stmt->execute();
}
else
{
$query = "INSERT INTO `norder` (`product_id`,`order_id`) VALUES ('".$data->product_name."','".$data->order_id."') ";
$stmt = $db->prepare($query);
$stmt->execute();	
}
$stmt = $db->prepare("SELECT * FROM `norder` WHERE `order_id`='".$data->order_id."'  ");	

$stmt->execute();
$checknum1 = $stmt->rowCount();
if($checknum1>0)
{
    $ps_arr["success"]="true";
    $ps_arr["error"]="false";
    $finaltotal=0;
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
extract($row);
$finaltotal+=$total;
if(getproduct('image',$product_id)!=''){
    $cimg=$sitename.'images/product/'.getproduct('image',$product_id);
}
else
{
   $cimg=''; 
}
if($product_id!=''){ 
$pid=$product_id; 
$productname=getproduct('productname_e',$product_id);
$weight1=$weight;
$rate_per_kg1=$rate_per_kg;
} else { 
$pid='';
$productname=$product_name;
$rate_per_kg1='';
$weight1='';
}

    $ps_item1[]=array(
            "cartid"=>$id,
			"product_id"=>$pid,
			"product_name"=>$productname,
			"image" => $cimg,
			"weight"=>$weight1,
			"rate_per_kg"=>$rate_per_kg1,
			"total"=>$total
        );
    
}

 if(count($ps_item1)>0) { 
        http_response_code(200);
  echo json_encode(
        array("success" => "true","error" => "false","finaltotal"=>$finaltotal,"order_details" => $ps_item1)
    );
   }
   else
   {
        http_response_code(404);
    echo json_encode(
        array("success" => "false","error" => "true")
    );   
   }
  
  
}
else
{
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no patient found
    echo json_encode(
        array("success" => "false","error" => "true","message" => "No Records Found")
    ); 
}

}
else
{
http_response_code(200);
 
    // tell the user no patient found
    echo json_encode(
        array("success" => "true","error"=>"false","message" => "Product Already Exist")
    );	
}

}
else{
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no patient found
    echo json_encode(
        array("success" => "false","message" => "Invalid Token")
    );
}  
?>
