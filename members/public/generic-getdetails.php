<?php
require '../adata/Db.class.php';
require '../bussiness/paises.php';
require '../bussiness/cargos.php';
require '../bussiness/rubros.php';
require '../bussiness/subrubros.php';
require '../bussiness/agenda.php';
require '../bussiness/anhomembresia.php';

$objPais = new clsPais();
$objCargo = new clsCargo();
$objRubro = new clsRubro();
$objSubRubro = new clsSubRubro();
$objAgenda = new clsAgenda();
$objAnhoMembresia = new clsAnhoMembresia();

/* prevent direct access to this page */
$isAjax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND
strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
if(!$isAjax) {
  $user_error = 'Access denied - direct call is not allowed...';
  trigger_error($user_error, E_USER_ERROR);
}
ini_set('display_errors',1);
 
/* if the 'term' variable is not sent with the request, exit */
if ( !isset($_REQUEST['id']) ) {
	exit;
}

 
/* retrieve the search term that autocomplete sends */
$typesource = $_GET['typesource']; 
$term = trim(strip_tags($_GET['id'])); 
/* replace multiple spaces with one */
$term = preg_replace('/\s+/', ' ', $term);
 
$a_json = array();
$a_json_row = array();
 
$a_json_invalid = array(array("id" => "#", "value" => $term, "label" => "Only letters and digits are permitted..."));
$json_invalid = json_encode($a_json_invalid);
 
/* SECURITY HOLE *************************************************************** */
/* allow space, any unicode letter and digit, underscore and dash                */
if(preg_match("/[^\040\pL\pN_-]/u", $term)) {
  print $json_invalid;
  exit;
}
/* ***************************************************************************** */


$i = 0;
$idfield = '';

if ($typesource == '00'){
	$idfield = 'tp_idpais';
	$objData = $objPais;
}
elseif ($typesource == '01'){
	$idfield = 'tp_idcargo';
	$objData = $objCargo;
}
elseif ($typesource == '02'){
	$idfield = 'tp_idrubro';
	$objData = $objRubro;
}
elseif ($typesource == '03'){
	$idfield = 'tp_idsubrubro';
	$objData = $objSubRubro;
}
elseif ($typesource == '04'){
	$idfield = 'ta_idtabla';
	$objData = $objAgenda;
}
elseif ($typesource == '05'){
	$idfield = 'tm_idproceso';
	$objData = $objAnhoMembresia;
}
if ($typesource != '04')
	$row = $objData->Listar("O", $term);
else
	$row = $objData->ListarEstados("O", $term);
$countrows = count($row);


if ($row) {
	//while ($i < $countrows){
		/*$id = htmlentities(stripslashes($row[$i][$idfield]));
		$nombre = htmlentities(stripslashes($row[$i]['tp_nombre']));*/
		$id = stripslashes($row[0][$idfield]);
		if ($typesource == '04'){
			$codigo = stripslashes($row[0]['ta_codigo']);
			$nombre = stripslashes($row[0]['tp_nombre']);
			$a_json_row["value"] = $codigo;
		}
		else {
			if ($typesource == '05')
				$nombre = stripslashes($row[0]['tm_anhoproceso']);
			else
				$nombre = stripslashes($row[0]['tp_nombre']);
			$a_json_row["value"] = $nombre;
		}
		$a_json_row["id"] = $id;
		$a_json_row["label"] = $nombre;
		array_push($a_json, $a_json_row);
		//$i++;
	//}
}
 
/* jQuery wants JSON data */
echo json_encode($a_json);
flush();
?>