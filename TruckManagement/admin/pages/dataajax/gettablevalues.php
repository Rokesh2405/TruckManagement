<?php date_default_timezone_set('Asia/Kolkata');
include ('../../config/config.inc.php');
date_default_timezone_set('Asia/Kolkata');
// error_reporting(1);
// ini_set('display_errors','1');
// error_reporting(E_ALL);
function mres($value) {
    $search = array("\\", "\x00", "\n", "\r", "'", '"', "\x1a");
    $replace = array("\\\\", "\\0", "\\n", "\\r", "\'", '\"', "\\Z");
    return str_replace($search, $replace, $value);
}

if ($_REQUEST['types'] == 'expenseentrytable1') {
$aColumns = array('id', 'voucher_no','expense_desc');
$sIndexColumn = "id";
//$editpage = ($_REQUEST['db_table_for'] == 'live') ? "editbanner" : "editbanner";brandstable modelstable
$sTable = "expenseentry";
}
if($_REQUEST['types'] == 'salesmansettlementtable') {
$aColumns = array('id', 'load_no','salesman_name','payment_amount');
$sIndexColumn = "id";
//$editpage = ($_REQUEST['db_table_for'] == 'live') ? "editbanner" : "editbanner";brandstable modelstable
$sTable = "salesman_settlement";
}
if($_REQUEST['types'] == 'carriersettlementtable') {
$aColumns = array('id', 'carrier_code','carrier_name','contact_name');
$sIndexColumn = "id";
//$editpage = ($_REQUEST['db_table_for'] == 'live') ? "editbanner" : "editbanner";brandstable modelstable
$sTable = "carrier_settlement";
}
if($_REQUEST['types'] == 'customersettlementtable') {
$aColumns = array('id', 'customer_code','customer_name','contact_name');
$sIndexColumn = "id";
//$editpage = ($_REQUEST['db_table_for'] == 'live') ? "editbanner" : "editbanner";brandstable modelstable
$sTable = "customer_settlement";
}
if($_REQUEST['types'] == 'invoicetransactiontable') {
$aColumns = array('id', 'load_no','customer_name','invoice_no','shipment_no','invoice_status');
$sIndexColumn = "id";
//$editpage = ($_REQUEST['db_table_for'] == 'live') ? "editbanner" : "editbanner";brandstable modelstable
$sTable = "invoice_transaction";
}

if($_REQUEST['types'] == 'carrierconfirmationtable') {
$aColumns = array('id', 'load_no','pickup_date','pickup_time','pickup_contact','delivery_date','delivery_time','delivery_contact','contact','status');
$sIndexColumn = "id";
//$editpage = ($_REQUEST['db_table_for'] == 'live') ? "editbanner" : "editbanner";brandstable modelstable
$sTable = "carrier_confirmation";
}

if ($_REQUEST['types'] == 'expensetable') {
$aColumns = array('id', 'expense_code','expense_name');
$sIndexColumn = "id";
//$editpage = ($_REQUEST['db_table_for'] == 'live') ? "editbanner" : "editbanner";brandstable modelstable
$sTable = "expense";
}
if ($_REQUEST['types'] == 'deliverytable') {
$aColumns = array('id', 'company_name','contact_name','phoneno');
$sIndexColumn = "id";
//$editpage = ($_REQUEST['db_table_for'] == 'live') ? "editbanner" : "editbanner";brandstable modelstable
$sTable = "delivery";
}
if ($_REQUEST['types'] == 'salesmantable') {
$aColumns = array('id', 'salesman_name','company_name','phoneno');
$sIndexColumn = "id";
//$editpage = ($_REQUEST['db_table_for'] == 'live') ? "editbanner" : "editbanner";brandstable modelstable
$sTable = "salesman";
}


if ($_REQUEST['types'] == 'pickuptable') {
$aColumns = array('id', 'company_name','contact_name','phoneno');
$sIndexColumn = "id";
//$editpage = ($_REQUEST['db_table_for'] == 'live') ? "editbanner" : "editbanner";brandstable modelstable
$sTable = "pickup";
}

if ($_REQUEST['types'] == 'stafftable') {
$aColumns = array('id', 'staff_code','staff_name','staff_city','staff_cell_no');
$sIndexColumn = "id";
//$editpage = ($_REQUEST['db_table_for'] == 'live') ? "editbanner" : "editbanner";brandstable modelstable
$sTable = "staff_tbl";
}


if ($_REQUEST['types'] == 'customertable') {
$aColumns = array('id', 'customer_code','customer_name','country','posta_zip_code','contact_name');
$sIndexColumn = "id";
//$editpage = ($_REQUEST['db_table_for'] == 'live') ? "editbanner" : "editbanner";brandstable modelstable brokertable
$sTable = "customer";
}

if ($_REQUEST['types'] == 'carriertable') {
$aColumns = array('id', 'customer_code','customer_name','country','posta_zip_code','contact_name');
$sIndexColumn = "id";
//$editpage = ($_REQUEST['db_table_for'] == 'live') ? "editbanner" : "editbanner";brandstable modelstable brokertable
$sTable = "carrier";
}

/* Declaration table name start here */



$aColumns1 = $aColumns;

function fatal_error($sErrorMessage = '') {
    header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error');
    die($sErrorMessage);
}

$sLimit = "";

if (isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1') {
    $sLimit = "LIMIT " . intval($_GET['iDisplayStart']) . ", " . intval($_GET['iDisplayLength']);
}
 if ($_REQUEST['types'] == 'categorytable' || $_REQUEST['types'] == 'producttable' || $_REQUEST['types'] == 'subcategorytable' || $_REQUEST['types'] == 'typetable') {
   $sOrder = "ORDER BY `order` ASC ";
    }
    else
    {
    $sOrder = "ORDER BY `$sIndexColumn` DESC";
    }
    

if (isset($_GET['iSortCol_0'])) {
    $sOrder = "ORDER BY  ";
    if (in_array("order", $aColumns)) {
        $sOrder .= "`order` asc, ";
    } else if (in_array("Order", $aColumns)) {
        $sOrder .= "`Order` asc, ";
    }
    for ($i = 0; $i < intval($_GET['iSortingCols']); $i++) {
        if ($_GET['bSortable_' . intval($_GET['iSortCol_' . $i])] == "true") {
            $sOrder .= "`" . $aColumns[intval($_GET['iSortCol_' . $i])] . "` " . ($_GET['sSortDir_' . $i] === 'asc' ? 'asc' : 'desc') . ", ";
        }
        $sOrder = substr_replace($sOrder, "", -2);
        if ($sOrder == "ORDER BY ") {
            $sOrder = " ";
        }
    }
}

$sWhere = "";


if ($sWhere != '') {

     $sWhere = "WHERE `$sIndexColumn`!='' $sWhere";    
  
}
else
{ 
  
   
  


    	
    	
    
}


   $sQuery = "SELECT SQL_CALC_FOUND_ROWS `" . str_replace(",", "`,`", implode(",", $aColumns)) . "` FROM $sTable $sWhere $sOrder $sLimit ";



$rResult = $db->prepare($sQuery);
$rResult->execute();

 $sQuery = "SELECT FOUND_ROWS()";

$rResultFilterTotal = $db->prepare($sQuery);
$rResultFilterTotal->execute();

$aResultFilterTotal = $rResultFilterTotal->fetch();
$iFilteredTotal = $aResultFilterTotal[0];

$sQuery = "SELECT COUNT(" . $sIndexColumn . ") FROM $sTable";
$rResultTotal = $db->prepare($sQuery);
$rResultTotal->execute();

$aResultTotal = $rResultTotal->fetch();
$iTotal = $aResultTotal[0];

$output = array(
    "sEcho" => intval($_GET['sEcho']),
    "iTotalRecords" => $iTotal,
    "iTotalDisplayRecords" => $iFilteredTotal,
    "aaData" => array()
);

$ij = 1;
$k = $_GET['iDisplayStart'];

while ($aRow = $rResult->fetch(PDO::FETCH_ASSOC)) {
    $k++;
    $row = array();
    $row1 = '';
    for ($i = 0; $i < count($aColumns1); $i++) {
        if ($_REQUEST['types'] == 'modeltable') {
            if ($aColumns1[$i] == $sIndexColumn) {
                $row[] = $k;
            }  elseif ($aColumns1[$i] == 'bike_name') {
                $row[] = getbike('bike_name',$aRow[$aColumns1[$i]]);
            } elseif ($aColumns1[$i] == 'status') {
                $row[] = $aRow[$aColumns1[$i]] ? "Active" : "Inactive";
            } else {
                $row[] = $aRow[$aColumns1[$i]];
            }
        }
        
else  if ($_REQUEST['types'] == 'carriersettlementtable') {
            if ($aColumns1[$i] == $sIndexColumn) {
                $row[] = $k;
            }  elseif ($aColumns1[$i] == 'carrier_name') {
               $row[] = getcarrier('customer_name',$aRow[$aColumns1[$i]]);
            } elseif ($aColumns1[$i] == 'status') {
                $row[] = $aRow[$aColumns1[$i]] ? "Active" : "Inactive";
            } else {
                $row[] = $aRow[$aColumns1[$i]];
            }
        }
        else  if ($_REQUEST['types'] == 'customersettlementtable') {
            if ($aColumns1[$i] == $sIndexColumn) {
                $row[] = $k;
            }  elseif ($aColumns1[$i] == 'customer_name') {
               $row[] = getcustomer('customer_name',$aRow[$aColumns1[$i]]);
            } elseif ($aColumns1[$i] == 'status') {
                $row[] = $aRow[$aColumns1[$i]] ? "Active" : "Inactive";
            } else {
                $row[] = $aRow[$aColumns1[$i]];
            }
        }
        else  if ($_REQUEST['types'] == 'invoicetransactiontable') {
            if ($aColumns1[$i] == $sIndexColumn) {
                $row[] = $k;
            }  elseif ($aColumns1[$i] == 'invoice_status') {
                $row[] = $aRow[$aColumns1[$i]] ? "Yes" : "No";
            } else {
                $row[] = $aRow[$aColumns1[$i]];
            }
        } 
         else  if ($_REQUEST['types'] == 'salesmansettlementtable') {
            if ($aColumns1[$i] == $sIndexColumn) {
                $row[] = $k;
            }  elseif ($aColumns1[$i] == 'salesman_name') {
               $row[] = getsalesman('salesman_name',$aRow[$aColumns1[$i]]);
            } elseif ($aColumns1[$i] == 'status') {
                $row[] = $aRow[$aColumns1[$i]] ? "Active" : "Inactive";
            } else {
                $row[] = $aRow[$aColumns1[$i]];
            }
        }  else  if ($_REQUEST['types'] == 'carrierconfirmationtable') {
            if ($aColumns1[$i] == $sIndexColumn) {
                $row[] = $k;
            }  elseif ($aColumns1[$i] == 'pickup_contact') {
                $row[] = getaddresscity('city',$aRow[$aColumns1[$i]]);
            } elseif ($aColumns1[$i] == 'delivery_contact') {
                $row[] = getaddresscity('city',$aRow[$aColumns1[$i]]);
            } else {
                $row[] = $aRow[$aColumns1[$i]];
            }
        }
		else  if ($_REQUEST['types'] == 'customertable') {
            if ($aColumns1[$i] == $sIndexColumn) {
                $row[] = $k;
            }  elseif ($aColumns1[$i] == 'date') {
                $row[] = date('d-m-Y',strtotime($aRow[$aColumns1[$i]]));
            } elseif ($aColumns1[$i] == 'status') {
                $row[] = $aRow[$aColumns1[$i]] ? "Active" : "Inactive";
            } else {
                $row[] = $aRow[$aColumns1[$i]];
            }
        }else  if ($_REQUEST['types'] == 'carriertable') {

             $date = getcarrier('policy_exp_date',$aRow['id']);
             $newdate = date("Y-m-d", strtotime ( '-1 month' , strtotime ( $date ) )) ;

             if(strtotime($newdate)<=strtotime(date('Y-m-d'))) {
                $spclr='style="color:red;font-weight:bold;"';
             }
             else
             {
                $spclr='';
             }
            if ($aColumns1[$i] == $sIndexColumn) {
                $row[] = '<span '.$spclr.'>'.$k.'</span>';
            }  elseif ($aColumns1[$i] == 'date') {
                $row[] = '<span '.$spclr.'>'.date('d-m-Y',strtotime($aRow[$aColumns1[$i]])).'</span>';;
            } elseif ($aColumns1[$i] == 'status') {
                 $row[] = '<span '.$spclr.'>'.$aRow[$aColumns1[$i]] ? "Active" : "Inactive".'</span>';
            } else {
                $row[] = '<span '.$spclr.'>'.$aRow[$aColumns1[$i]].'</span>';
            }
        }
   	else {
            if ($aColumns1[$i] == $sIndexColumn) {
                $row[] = $k;
            }
			elseif ($aColumns1[$i] == 'status') {
                $row[] = $aRow[$aColumns1[$i]] ? "Active" : "Inactive";
            } else {
                $row[] = $aRow[$aColumns1[$i]];
            }
        }
    }

    /* Edit page  change start here */
  
    if (($_REQUEST['types'] == 'registertable') || ($_REQUEST['types'] == 'pendingordertable') || ($_REQUEST['types'] == 'activeordertable') || ($_REQUEST['types'] == 'completedordertable') || ($_REQUEST['types'] == 'cancelledordertable')  || ($_REQUEST['types'] == 'formtable1') ) {
        $row[] = "<i class='fa fa-eye' onclick='javascript:viewthis(" . $aRow[$sIndexColumn] . ");' style='cursor:pointer;'> </i>";
    }
    
    else {
        if($_REQUEST['types'] != 'ordertable' || $_REQUEST['types'] != 'offersettingtable')
        {
        $row[] = "<i class='fa fa-edit' onclick='javascript:editthis(" . $aRow[$sIndexColumn] . ");' style='cursor:pointer;'> Edit </i>";
        }
        
    }

    $row[] = '<input type="checkbox"  name="chk[]" id="chk[]" value="' . $aRow[$sIndexColumn] . '" />';



    $output['aaData'][] = $row;
    $ij++;
}

echo json_encode($output);
?>
 
