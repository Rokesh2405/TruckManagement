<?php

include_once '../config/database.php';
 
 
$database = new Database();
$db = $database->getConnection();

function nulltoempty($a)
{
  if(is_null($a))
  {
     $res=''; 
      return $res;
  }
 return $a;
}

function getproduct($a, $b) {
    global $db;
    $get1 = $db->prepare("SELECT * FROM `products` WHERE `id`=?");
    $get1->execute(array($b));
    $get = $get1->fetch(PDO::FETCH_ASSOC);
    $res = $get[$a];
    return $res;
}
function getcustomerdetails($a, $b) {
    global $db;
    $get1 = $db->prepare("SELECT * FROM `customer` WHERE `id`=?");
    $get1->execute(array($b));
    $get = $get1->fetch(PDO::FETCH_ASSOC);
    $res = $get[$a];
    return $res;
}
function getbooking($a, $b) {
    global $db;
    $get1 = $db->prepare("SELECT * FROM `booking` WHERE `id`=?");
    $get1->execute(array($b));
    $get = $get1->fetch(PDO::FETCH_ASSOC);
    $res = $get[$a];
    return $res;
}
function gettempcustomer($a, $b) {
    global $db;
    $get1 = $db->prepare("SELECT * FROM `tempcustomer` WHERE `mobileno`=?");
    $get1->execute(array($b));
    $get = $get1->fetch(PDO::FETCH_ASSOC);
    $res = $get[$a];
    return $res;
}
function getcustomer($a, $b) {
    global $db;
    $get1 = $db->prepare("SELECT * FROM `customer` WHERE `emailid`=?");
    $get1->execute(array($b));
    $get = $get1->fetch(PDO::FETCH_ASSOC);
    $res = $get[$a];
    return $res;
}
function getdriver($a, $b) {
    global $db;
    $get1 = $db->prepare("SELECT * FROM `driver` WHERE `id`=?");
    $get1->execute(array($b));
    $get = $get1->fetch(PDO::FETCH_ASSOC);
    $res = $get[$a];
    return $res;
}
function getdriverrating($a) {
    global $db;
    $get1 = $db->prepare("SELECT SUM(`rating`) AS `torating`,COUNT(`id`) AS `touser`,   FROM `driver_rating` WHERE `driverid`=?");
    $get1->execute(array($a));
    $get = $get1->fetch(PDO::FETCH_ASSOC);
    $res = $get[$a];
    return $res;
}
function getadminuser($a, $b) {
    global $db;
    $get1 = $db->prepare("SELECT * FROM `users` WHERE `id`=?");
    $get1->execute(array($b));
    $get = $get1->fetch(PDO::FETCH_ASSOC);
    $res = $get[$a];
    return $res;
}
?>