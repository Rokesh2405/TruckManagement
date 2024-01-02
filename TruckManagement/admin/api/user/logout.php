<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 

// get database connection
include_once '../config/database.php';

 
// instantiate product object
include_once '../objects/form.php';
 
$database = new Database();
$db = $database->getConnection();
 
$form = new Form($db);
 
// get posted data

$data = json_decode(file_get_contents("php://input"));


// make sure data is not empty
if(
    !empty($data->userid)
){


//delete tempcart	
$dquery1 = "DELETE FROM `customer` WHERE `id`='".$data->userid."' ";
$dstmt1 = $db->prepare($dquery1);
$dstmt1->execute();
//delete tempcart

 http_response_code(200);
 echo json_encode(array("success" => "true", "error" => "false", "message" => "Logout Successfully.")); 

}
 
// tell the user data is incomplete
else{
 
    // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
    echo json_encode(array("success" => "false", "error" => "true", "message" => "Unable to create user. Data is incomplete."));
}
?>