<?php
//Set the time out
require 'adata/Db.class.php';
require 'bussiness/archivos.php';
require 'common/functions.php';

$idfile = isset($_GET['idfile']) ? $_GET['idfile'] : '0';
set_time_limit(0);

//path to the file
//$file_path='files/'.$_REQUEST['filename'];

$objData = new clsArchivo();
$row = $objData->Listar("M", $idfile);
$countrows = count($row);

if ($row) {
	$id = stripslashes($row[0]['td_idfile']);
	$pathfile = stripslashes($row[0]['td_url']);
	$typefile = stripslashes($row[0]['td_type']);
	output_file('media/files/'.basename($pathfile), ''.basename($pathfile).'', $typefile);
}



?>