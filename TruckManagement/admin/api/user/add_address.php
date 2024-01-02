<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 

// get database connection
include_once '../config/database.php';

 
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

// instantiate product object
include_once '../objects/form.php';
 include_once '../objects/functions.php';
$database = new Database();
$db = $database->getConnection();
 
$form = new Form($db);
 
// get posted data

$data = json_decode(file_get_contents("php://input"));
$stmt = $db->prepare("SELECT * FROM `customer` WHERE `token`='".$token."' ");	

$stmt->execute();
$checknum1 = $stmt->rowCount();
if($checknum1>0)
{
// make sure data is not empty
if(
    !empty($data->address) && !empty($data->area)  && !empty($data->city) && !empty($data->pincode)
){
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$query1 = "INSERT INTO `customer_address` (`userid`,`address`,`area`,`city`,`pincode`) VALUES ('".$row['id']."','".$data->address."','".$data->area."','".$data->city."','".$data->pincode."')";
$stmt1 = $db->prepare($query1);
$stmt1->execute();

  http_response_code(200);
 
    // tell the user
	
	 
	 
    echo json_encode(array(
        "success" => "true", 
        "error" => "false",
		"message"=>"Added successfully"
        ));
}
 
// tell the user data is incomplete
else{
 
    // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
    echo json_encode(array("success" => "false", "error" => "true", "message" => "Unable to create user. Data is incomplete."));
}
}
else
{
  // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
    echo json_encode(array("success" => "false", "error" => "true", "message" => "Invalid Token"));
	
}
?>