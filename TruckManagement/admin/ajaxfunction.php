<?php

include 'config/config.inc.php';
//Checking login
if (( $_SESSION['BY'] == '') && ( $_SESSION['TYPE'] == '')) {
//    header("location:" . $sitename);
    echo json_encode($_REQUEST);
//    exit;
}

if ($_REQUEST['action'] == 'blocklist') {
    $districtid = $_REQUEST['districtid'];
    
$query1 = $db->prepare("SELECT * FROM `blocks` WHERE district_code = ?");
$query1->execute(array($districtid));
while ($query = $query1->fetch(PDO::FETCH_ASSOC)) {

// echo $query['block_name'];
// print_r($query);

echo json_encode($query);
}
}

// process 2
//
if ($_REQUEST['district1'] != '') {
    ?>
   <option value="">Select </option>
        <?php

        $query1 = $db->prepare("SELECT * FROM `village` WHERE district_code = ? GROUP BY `block_code`");
$query1->execute(array($_REQUEST['district1']));
while ($cate = $query1->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <option value="<?php echo $cate['block_code']; ?>"><?php echo $cate['block_name']; ?></option>
    <?php } }
if ($_REQUEST['district'] != '') {
    ?>
   <option value="">Select </option>
        <?php
   
       
        $query1 = $db->prepare("SELECT * FROM `village` WHERE block_code = ? GROUP BY `block_code`");
$query1->execute(array($_REQUEST['district']));
while ($cate = $query1->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <option value="<?php echo $cate['block_code']; ?>"><?php echo $cate['block_name']; ?></option>
    <?php } }
    
  if ($_REQUEST['supervisor'] != '') {
    ?>
   <option value="">Select </option>
        <?php
 
   $query2 = $db->prepare("SELECT * FROM `manager` WHERE supervisor = ? ");
$query2->execute(array($_REQUEST['supervisor']));
while ($cate2 = $query2->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <option value="<?php echo $cate2['id']; ?>"><?php echo $cate2['name']; ?></option>
    
    <?php
} } if ($_REQUEST['block1'] != '') {
    ?>
   <option value="">Select </option>
        <?php
        
        $query1 = $db->prepare("SELECT * FROM `village` WHERE block_code = ? GROUP BY `panchayat_code`");
$query1->execute(array($_REQUEST['block1']));
while ($cate = $query1->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <option value="<?php echo $cate['panchayat_code']; ?>"><?php echo $cate['panchayat_name']; ?></option>
    <?php } ?>
  
    <?php
} if ($_REQUEST['block11'] != '') {
    ?>
  
  
        <?php
        
        $query1 = $db->prepare("SELECT * FROM `village` WHERE district_code=? AND block_code = ? GROUP BY `panchayat_code`");
$query1->execute(array($_REQUEST['district'],$_REQUEST['block11']));
while ($cate = $query1->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <option value="<?php echo $cate['panchayat_code']; ?>"><?php echo $cate['panchayat_name']; ?></option>
    <?php } ?>
  
    <?php
}  if ($_REQUEST['block'] != '') {
    ?>
   <option value="">Select </option>
        <?php
        
        $query1 = $db->prepare("SELECT * FROM `village` WHERE panchayat_code = ? GROUP BY `panchayat_code`");
$query1->execute(array($_REQUEST['block']));
while ($cate = $query1->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <option value="<?php echo $cate['panchayat_code']; ?>"><?php echo $cate['panchayat_name']; ?></option>
    <?php } ?>
  
    <?php
}
