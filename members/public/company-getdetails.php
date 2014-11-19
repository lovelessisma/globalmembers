<?php
require '../adata/Db.class.php';
require '../bussiness/empresas.php';
$objData = new clsEmpresa();
/* prevent direct access to this page */
$isAjax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND
strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
if(!$isAjax) {
  $user_error = 'Access denied - direct call is not allowed...';
  trigger_error($user_error, E_USER_ERROR);
}
ini_set('display_errors',1);
 
/* if the 'term' variable is not sent with the request, exit */
if ( !isset($_REQUEST['idempresa']) ) {
	exit;
}

$term = trim(strip_tags($_GET['idempresa'])); 
/* replace multiple spaces with one */
$term = preg_replace('/\s+/', ' ', $term);
/* SECURITY HOLE *************************************************************** */
/* allow space, any unicode letter and digit, underscore and dash                */
if(preg_match("/[^\040\pL\pN_-]/u", $term)) {
  exit;
}
/* ***************************************************************************** */
$row = $objData->Listar("DETAILS", $term); 
/* jQuery wants JSON data */
echo json_encode($row);
flush();
?>