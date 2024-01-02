// $resa->execute(array($delivery_date,$invoice_number,$mobileno,$invoice_to,$ship_to));
// $lastid11=$db->lastInsertId();
// $qty=explode(',',$qty1);
// $item=explode(',',$item1);
// $description=explode(',',$description1);
// $rate=explode(',',$rate1);
// $amount=explode(',',$amount1);
// $tax=explode(',',$tax1);
// $i=0;
// foreach($description as $descriptions) 
// {
//     if($descriptions!='') 
//     {
//     $qtyy=$qty[$i];
//     $itemm = $item[$i];
//     $descriptionn = $description[$i];
//     $ratee = $rate[$i];
//     $amountt = $amount[$i];
//     $taxx = $tax[$i];
    
// $resa1 = $db->prepare("INSERT INTO delivery_items (`delivery_id`, `qty`, `item`, `description`,`rate`,`amount`,`tax`) VALUES(?,?,?,?,?,?,?)");
// $resa1->execute(array($descriptions,$qtyy,$itemm,$descriptionn,$ratee,$amountt,$taxx));

//     }
//     $i++;
// }
