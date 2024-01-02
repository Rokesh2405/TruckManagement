<?php

function generateRandomString($length = 4) {
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}



class Form{
 
    // database connection and table name
    private $conn;
    private $table_name = "register";
 
    // object properties
    public $id;
    public $name;
    public $description;
    public $price;
    public $category_id;
    public $category_name;
    public $created;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
function createaccount(){
 $query = "INSERT INTO `customer`
            SET
                name='".$this->name."',emailid='".$this->emailid."',mobileno='".$this->mobileno."',token='".$this->token."'";

    // prepare query
$stmt = $this->conn->prepare($query);  

    if($stmt->execute()){
    
    return true;
    }
 
    return false;
}
function createtempaccount(){
 $query = "INSERT INTO `tempcustomer`
            SET
                name='".$this->name."',emailid='".$this->emailid."',mobileno='".$this->mobileno."',token='".$this->token."'";

    // prepare query
$stmt = $this->conn->prepare($query);  

    if($stmt->execute()){
    
    return true;
    }
 
    return false;
}

function tempcreate(){

     $ip=$_SERVER['REMOTE_ADDR'];
    // query to insert record
   $query = "INSERT INTO `verifyregister`
            SET
                name='".$this->name."', emailid='".$this->emailid."',mobileno='".$this->mobileno."' ";

    // prepare query
    $stmt = $this->conn->prepare($query);
 

    // execute query
    if($stmt->execute()){
        $registerid = $this->conn->lastInsertId();
        return $registerid;
    }
 
    return false;
     
}


}
