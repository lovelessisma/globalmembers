<?php
include('adata/Db.class.php');
include('bussiness/archivos.php');

// LOG
$log = '=== ' . @date('Y-m-d H:i:s') . ' ===============================' . "\n"
        . 'FILES:' . print_r($_FILES, 1) . "\n"
        . 'POST:' . print_r($_POST, 1) . "\n";
$fp = fopen('upload-log.txt', 'a');
fwrite($fp, $log);
fclose($fp);

$objData = new clsArchivo();

// Result object
//$r = new stdClass();
// Result content type
header('content-type: application/json');


// Maximum file size
$maxsize = 100; //Mb
// File size control
if ($_FILES['xfile']['size'] > ($maxsize * 1048576)) {
    $r->error = "Max file size: $maxsize Kb";
}


// Uploading folder
$folder = 'media/files/';
if (!is_dir($folder))
    mkdir($folder);
// If specifics folder 
$folder .= $_POST['folder'] ? $_POST['folder'] . '/' : '';
if (!is_dir($folder))
    mkdir($folder);


// If the file is an image
if (preg_match('/image/i', $_FILES['xfile']['type'])) {

    $filename = $_POST['value'] ? $_POST['value'] :
            $folder . $_FILES['xfile']['name'] . '.jpg';
} else {

    $tld = explode(',', $_FILES['xfile']['name']);
    $tld = $tld[count($tld) - 1];
    $filename = $_POST['value'] ? $_POST['value'] :
            $folder . $_FILES['xfile']['name'];
}


// Supporting image file types
$types = Array('image/png', 'image/gif', 'image/jpeg');
// File type control
/*if (in_array($_FILES['xfile']['type'], $types)) {
    // Create an unique file name    
    // Uploaded file source
    $source = file_get_contents($_FILES["xfile"]["tmp_name"]);
    // Image resize
    imageresize($source, $filename, $_POST['width'], $_POST['height'], $_POST['crop'], $_POST['quality']);
} else
// If the file is not an image*/
move_uploaded_file($_FILES["xfile"]["tmp_name"], $filename);



// Result data
/*$r->filename = $filename;
$r->path = $path;
$r->img = '<img src="' . $path . $filename . '" alt="image" />';

// Return to JSON
echo json_encode($r);*/
$tipoorg = $_POST['tipoorg'];
$onlyName = basename($filename);
$typefile = $_FILES['xfile']['type'];
$idorigen = '0';
if ($tipoorg == '04')
    $idorigen = $_POST['idorigen'];


$entidad['td_idfile'] = 0;
$entidad['ta_tipoorigen'] = $tipoorg;
$entidad['tm_idorigen'] = $idorigen;
$entidad['td_url'] = $filename;
$entidad['td_type'] = $typefile;
$entidad['td_title'] = $onlyName;
$entidad['td_description'] = $typefile;
$entidad['td_correodestino'] = '';
$entidad['Activo'] = 0;
$entidad['IdUsuarioReg'] = 1;
$entidad['FechaReg'] = date("Y-m-d h:i:s");
$entidad['IdUsuarioAct'] = 1;
$entidad['FechaAct'] = date("Y-m-d h:i:s");
$rpta = $objData->Registrar($entidad);

if ($rpta){    
    

    if (in_array($typefile, $types))
        $filenamex = $filename;
    else
        $filenamex = 'images/thumb-other.png';

    $typefile = strlen($typefile) >= 20 ? substr($typefile, 0, 20).'...' : $typefile;

    $jsondata = array(
        "idfile" => $rpta, 
        "onlyname" => strlen($onlyName) >= 20 ? substr($onlyName, 0, 20).'...' : $onlyName,
        "tipofile" => $typefile,
        "filename" => $filenamex);
    
    
    echo json_encode($jsondata);
}

?>