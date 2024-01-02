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
$rres=$stmt->fetch(PDO::FETCH_ASSOC);	
// make sure data is not empty
if(
    !empty($data->car_type) && !empty($data->trip_type) && !empty($data->amount)
){

$data->otp = generateRandomString();
$query1 = "INSERT INTO `booking` (`driver_id`,`userid`,`from_address`, `from_reaname`, `from_city`, `from_pincode`, `to_address`, `to_reaname`, `to_city`, `to_pincode`, `Distance`, `status`,`car_type`,`trip_type`,`amount`,`driver_id`,`otp`) VALUES ('1','".$rres['id']."','".$data->from_address."','".$data->from_reaname."','".$data->from_city."','".$data->from_pincode."','".$data->to_address."','".$data->to_reaname."','".$data->to_city."','".$data->to_pincode."','".$data->distance."','Pending','".$data->car_type."','".$data->trip_type."','".$data->amount."','1','".$data->otp."')";
$stmt1 = $db->prepare($query1);
$stmt1->execute();


  http_response_code(200);
 
    // tell the user
	
	    $get1 = $db->prepare("SELECT SUM(`rating`) AS `torating`,COUNT(`id`) AS `touser` FROM `driver_rating` WHERE `driver_id`=?");
    $get1->execute(array('1'));
    $get = $get1->fetch(PDO::FETCH_ASSOC);
	$avagrating=$get['torating']/$get['touser'];
	
    echo json_encode(array(
        "success" => "true", 
        "error" => "false",
		"message"=>"Booking successfully",
        "driver_name"=>getdriver("name",1),
		"driver_mobileno"=>getdriver("mobileno",1),
		"car_name"=>getdriver("car_name",1),
		"car_no"=>getdriver("car_no",1),
		"rating"=>$avagrating
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