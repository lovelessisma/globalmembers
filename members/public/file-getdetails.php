<?php
require '../adata/Db.class.php';
require '../bussiness/archivos.php';

/* prevent direct access to this page */
$isAjax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND
strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
if(!$isAjax) {
  $user_error = 'Access denied - direct call is not allowed...';
  trigger_error($user_error, E_USER_ERROR);
}
ini_set('display_errors',1);
 
/* if the 'term' variable is not sent with the request, exit */
if ( !isset($_REQUEST['idfile']) ) {
	exit;
}

 
/* retrieve the search term that autocomplete sends */
$term = trim(strip_tags($_GET['idfile'])); 
/* replace multiple spaces with one */
$term = preg_replace('/\s+/', ' ', $term);
 
$a_json = array();
$a_json_row = array();
 
$a_json_invalid = array(array("id" => "#", "title" => $term, "description" => "Only letters and digits are permitted...", 'typefile' => 'None', 'urlfile' => 'None'));
$json_invalid = json_encode($a_json_invalid);
 
/* SECURITY HOLE *************************************************************** */
/* allow space, any unicode letter and digit, underscore and dash                */
if(preg_match("/[^\040\pL\pN_-]/u", $term)) {
  print $json_invalid;
  exit;
}
/* ***************************************************************************** */


$objData = new clsArchivo();
$row = $objData->Listar("M", $term);
$countrows = count($row);

if ($row) {
	$id = stripslashes($row[0]['td_idfile']);
	$title = stripslashes($row[0]['td_title']);
	$description = stripslashes($row[0]['td_description']);
	$typefile = stripslashes($row[0]['td_type']);
	$urlfile = stripslashes($row[0]['td_url']);
	
	$a_json_row["id"] = $id;
	$a_json_row["title"] = $title;
	$a_json_row["description"] = $description;
	$a_json_row["typefile"] = $typefile;
	$a_json_row["urlfile"] = $urlfile;
	array_push($a_json, $a_json_row);
	$i++;
}
 
/* jQuery wants JSON data */
echo json_encode($a_json);
flush();
?>