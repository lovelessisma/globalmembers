<?php 
include("bussiness/empresas.php");
include("bussiness/rubros.php");
include("bussiness/subrubros.php");

$objData = new clsEmpresa();
$objRubro = new clsRubro();
$objSubRubro = new clsSubRubro();

$ddlTipoOrg = isset($_GET['ddlTipoOrg']) ? $_GET['ddlTipoOrg'] : '1';
$ddlPais = isset($_GET['ddlPais']) ? $_GET['ddlPais'] : $idPaisDefault;
$ddlPais = isset($_GET['ddlPais']) ? $_GET['ddlPais'] : $idPaisDefault;
$ddlRubro = isset($_GET['ddlRubro']) ? $_GET['ddlRubro'] : $idRubroDefault;
$rbTipoCriterio = isset($_GET['rbTipoCriterio']) ? $_GET['rbTipoCriterio'] : 'isEmp';
$esMiembro = isset($_GET['chkMiembro']) ? $_GET['chkMiembro'] : '0';

$i = 0;
$checkOpEmp = '';
$checkOpRep = '';
$activeLetter = '';
$linksearch = "?pag=$pag&subpag=$subpag&op=$op&chkMiembro=$esMiembro&txtSearch=$txtSearch&firstLit=";



if (isset($_POST['fnPost'])){
    if (isset($_POST['isSwitch'])){
        $iditem = isset($_POST['iditem']) ? $_POST['iditem'] : '0';
        $state = isset($_POST['state']) ? $_POST['state'] : '0';
        $rpta = $objData->ToogleState($iditem, $state);
    }
    else if (isset($_POST['multiDelete'])){
        $paramVars = isset($_POST['paramVars']) ? $_POST['paramVars'] : '0';
        $listIds = str_replace('|', ',', $paramVars);
        $rpta = $objData->MultiDelete($listIds);
    }
    else if (isset($_POST['upload'])){
        extract($_POST);
        if ($action == 'upload'){
        //cargamos el archivo al servidor con el mismo nombre
        //solo le agregue el sufijo bak_ 
            $rowRubro = $objRubro->Listar('L', '');
            $rowSubRubro = $objSubRubro->Listar('L', '');

            $archivo = $_FILES['excel']['name'];
            $tipo = $_FILES['excel']['type'];
            $destino = 'bak_'.$archivo;
            
            copy($_FILES['excel']['tmp_name'],$destino); 
            ////////////////////////////////////////////////////////
            if (file_exists ('bak_'.$archivo)){
                require_once('common/PHPExcel.php');
                require_once('common/PHPExcel/Reader/Excel2007.php');

                $objReader = new PHPExcel_Reader_Excel2007();
                $objPHPExcel = $objReader->load('bak_'.$archivo);
                $objFecha = new PHPExcel_Shared_Date();       

                // Asignar hoja de excel activa
                $objPHPExcel->setActiveSheetIndex(0);
                $countRowsExcel = $objPHPExcel->getActiveSheet()->getHighestRow();
                        // Llenamos el arreglo con los datos  del archivo xlsx
                for ($i=2;$i<=$countRowsExcel;$i++)
                {
                    $getTipoEmpresa = $objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue();
                    $getIdRubro = in_array_column($objPHPExcel->getActiveSheet()->getCell('D'.$i)->getCalculatedValue(), 'tp_idrubro', 'tp_nombre', $rowRubro);
                    $getIdSubRubro = in_array_column($objPHPExcel->getActiveSheet()->getCell('E'.$i)->getCalculatedValue(), 'tp_idsubrubro', 'tp_nombre', $rowSubRubro);
                    $getIdCargo = $objPHPExcel->getActiveSheet()->getCell('H'.$i)->getCalculatedValue();

                    $_DATOS_EXCEL[$i]['idtipoempresa'] = $getTipoEmpresa == "EMPRESA" ? 1 : 2;
                    $_DATOS_EXCEL[$i]['nombre'] = $objPHPExcel->getActiveSheet()->getCell('C'.$i)->getCalculatedValue();
                    $_DATOS_EXCEL[$i]['idrubro'] = $getIdRubro == false ? 199 : $getIdRubro;
                    $_DATOS_EXCEL[$i]['idsubrubro'] = $getIdSubRubro == false ? 147 : $getIdSubRubro;
                    $_DATOS_EXCEL[$i]['representante'] = $objPHPExcel->getActiveSheet()->getCell('F'.$i)->getCalculatedValue();
                    $_DATOS_EXCEL[$i]['idcargo'] = $getIdCargo == "" ? 380 : $getIdCargo;
                    $_DATOS_EXCEL[$i]['contacto'] = $objPHPExcel->getActiveSheet()->getCell('I'.$i)->getCalculatedValue();
                    $_DATOS_EXCEL[$i]['telefono'] = $objPHPExcel->getActiveSheet()->getCell('J'.$i)->getCalculatedValue();
                    $_DATOS_EXCEL[$i]['fax'] = $objPHPExcel->getActiveSheet()->getCell('K'.$i)->getCalculatedValue();
                    $_DATOS_EXCEL[$i]['email'] = $objPHPExcel->getActiveSheet()->getCell('L'.$i)->getCalculatedValue();
                    $_DATOS_EXCEL[$i]['website'] = $objPHPExcel->getActiveSheet()->getCell('M'.$i)->getCalculatedValue();
                    $_DATOS_EXCEL[$i]['direccion'] = $objPHPExcel->getActiveSheet()->getCell('N'.$i)->getCalculatedValue();
                    $_DATOS_EXCEL[$i]['ciudad'] = $objPHPExcel->getActiveSheet()->getCell('O'.$i)->getCalculatedValue();
                    $_DATOS_EXCEL[$i]['provincia'] = $objPHPExcel->getActiveSheet()->getCell('P'.$i)->getCalculatedValue();
                    $_DATOS_EXCEL[$i]['idpais'] = $objPHPExcel->getActiveSheet()->getCell('R'.$i)->getCalculatedValue();
                    $_DATOS_EXCEL[$i]['nroruc'] = $objPHPExcel->getActiveSheet()->getCell('S'.$i)->getCalculatedValue();
                    $_DATOS_EXCEL[$i]['observaciones'] = $objPHPExcel->getActiveSheet()->getCell('T'.$i)->getCalculatedValue();
                }
            }
            else {
                echo 'Necesitas primero importar el archivo';
                exit(0);
            }
            $errores=0;
            //recorremos el arreglo multidimensional 
            //para ir recuperando los datos obtenidos
            //del excel e ir insertandolos en la BD
            $sql = "INSERT INTO tm_empresa (`tp_idtipoorg`, `tm_nombre`, `tp_idrubro`, `tp_idsubrubro`, ";
            $sql .= " `tm_representante`, `tp_idcargo`, `tm_contacto`, `tm_telefonos`, `tm_fax`, `tm_email`, ";
            $sql .= " `tm_website`, `tm_direccion`, `tm_ciudad`, `tm_provincia`, `tp_idpais`, `tm_nroruc`, `tm_observaciones`, ";
            $sql .= " `tm_miembro`, `tm_fecharegistro`, `Activo`, `IdUsuarioReg`, `FechaReg`, `IdUsuarioAct`, `FechaAct`) VALUES ";
            foreach($_DATOS_EXCEL as $campo => $valor){
                $sql.= " ('";
                foreach ($valor as $campo2 => $valor2){
                    $campo2 == "observaciones" ? $sql.= str_replace("'", "\'", trim(preg_replace('/\s+/', ' ', $valor2)))."', '1', NOW(), '1', '1', NOW(), '1', NOW()),\n" : $sql.= str_replace("'", "\'", trim(preg_replace('/\s+/', ' ', $valor2)))."','";
                }
            }
            $sql = substr($sql, 0, strlen(trim($sql)) - 1);
            $sql = $sql.";";
            /*$fp = fopen($_SERVER['DOCUMENT_ROOT'] . "/myText.txt","wb");
            fwrite($fp,$sql);
            fclose($fp);*/
            //echo $sql;
            $rptaBulk = $objData->MultiInsert($sql);
            //echo "<strong><center>ARCHIVO IMPORTADO CON EXITO, EN TOTAL $campo REGISTROS Y $errores ERRORES</center></strong>";
            //una vez terminado el proceso borramos el 
            //archivo que esta en el servidor el bak_
            if ($rptaBulk){
                unlink($destino);
                header("location: index.php".$linksearch);
            }
        }
    }
    $jsondata = array('rpta' => $rpta);
    echo json_encode($jsondata);
    exit(0);
}


if(isset($_GET["lastid"]) && $_GET["lastid"] != "0"){
    $lastid = $_GET['lastid'];
}
else {
    $lastid = 0;
}

$busqueda = $firstLit != '' ? $firstLit.substr($txtSearch, 1, strlen($txtSearch)) : $txtSearch;

$parametros = array(
'tipocriterio' => $rbTipoCriterio, 
'criterio' => $busqueda,
'idtipoorg' => $ddlTipoOrg,
'idpais' => $ddlPais,  
'idrubro' => $ddlRubro,
'miembro' => $esMiembro,
'lastid' => $lastid );

$row = $objData->Listar('L', $parametros);

if (isset($_GET['viaAjax'])){
    $isAjax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
    if(!$isAjax) {
      $user_error = 'Access denied - direct call is not allowed...';
      trigger_error($user_error, E_USER_ERROR);
    }
    echo json_encode($row);
    exit (0);
}

$countrows = count($row);

if ($rbTipoCriterio == 'isEmp'){
    $checkOpEmp = ' checked=""';
    $checkOpRep = '';
}
else {
    $checkOpEmp = '';
    $checkOpRep = ' checked=""';
}
?>

<script type="text/javascript">
    $(document).ready(function(){
        intializeComponents();
    });

    function intializeComponents(){
        $('#btnSearch').click(function () {
            BuscarDatos('0');
            return false;
        }); 

        $('#ddlTipoOrg').keydown(function(event) {
            if (event.keyCode == $.ui.keyCode.ENTER){
                $('#ddlPais').focus();
                return false;
            }
        });       

        $('#ddlPais').keydown(function(event) {
            if (event.keyCode == $.ui.keyCode.ENTER){
                $('#ddlRubro').focus();
                return false;
            }
        });

        $('#ddlRubro').keydown(function(event) {
            if (event.keyCode == $.ui.keyCode.ENTER){
                $('#rbEmpresa').focus();
                return false;
            }
        });

        $('#btnDescargar').click(function () {
            $('#dialogUpload').show();
            return false;
        });

        $('#btnCancelUpload').click(function () {
            $('#dialogUpload').hide();
            return false;
        });

        $('#btnShowMore').click(function () {
            $(this).html("<img src='images/loading.gif' alt='loading'/>"); /* displa the loading content */
                /*var LastDiv = $(".as_country_container:last"); *//* get the last div of the dynamic content using ":last" */
            var LastId  = $("#tblDatos tbody tr:last").attr("rel"); /* get the id of the last div */
            BuscarDatos(LastId);
            return false;
        });

        $("#btnNewOrg").click(function(){
            goToEditOrg('0');
            return false;
        });

        $("#btnEditOrg").click(function(){
            iditem = $('.data-view .modern-row.selected-row:first').attr("rel");
            goToEditOrg(iditem);
            return false;
        });
        initEventsRowsOrg();
    }

    function goToEditOrg(id){
        urlData = "?pag=<?php echo $pag; ?>&subpag=<?php echo $subpag; ?>&op=form";
        urlData += "&firstLit=" + $('.pagination ul li.active a').attr('rel');
        urlData += "&ddlTipoOrg=" + $('#ddlTipoOrg').val();
        urlData += "&ddlPais=" + $('#ddlPais').val();
        urlData += "&ddlRubro=" + $('#ddlRubro').val();
        urlData += "&txtSearch=" + $('#txtSearch').val();
        urlData += "&rbTipoCriterio=" + ($('#rbEmpresa')[0].checked ? "isEmp" : "isRep");
        urlData += "&chkMiembro=" + ($('#chkMiembro')[0].checked ? "1" : "0");
        urlData += "&lastid=" + $("#tblDatos tbody tr:last").attr("rel");
        urlData += "&showAppBar=0";
        urlData += "&viaAjax=1";
        urlData += "&id=" + id;

        window.location = urlData;
    }

    function BuscarDatos(lastid){
        var urlData = "";
        urlData = "fnGet=fnGet";
        urlData += "&pag=<?php echo $pag; ?>&subpag=<?php echo $subpag; ?>&op=<?php echo $op; ?>";
        urlData += "&firstLit=" + $('.pagination ul li.active a').attr('rel');
        urlData += "&ddlTipoOrg=" + $('#ddlTipoOrg').val();
        urlData += "&ddlPais=" + $('#ddlPais').val();
        urlData += "&ddlRubro=" + $('#ddlRubro').val();
        urlData += "&txtSearch=" + $('#txtSearch').val();
        urlData += "&rbTipoCriterio=" + ($('#rbEmpresa')[0].checked ? "isEmp" : "isRep");
        urlData += "&chkMiembro=" + ($('#chkMiembro')[0].checked ? "1" : "0");
        urlData += "&lastid=" + lastid;
        urlData += "&showAppBar=0";
        urlData += "&viaAjax=1";

        if (lastid == 0)
            $("#tblDatos tbody tr").remove();
        AsyncGetDataListar(urlData, callbackData);
    }

    function initEventsRowsOrg(){
        $('.data-view .modern-row').dblclick(function(){
            iditem = $(this).attr("rel");
            goToEditOrg(iditem);
        });
    }

    function callbackData(data){
        datos = eval( "(" + data + ")" );
        i = 0;
        if (datos.length > 0){
            $.each(datos, function(i){
                $contentRow = "";
                $rowData = $('<tr></tr>').attr({ 
                    'id' : "row" + datos[i].tm_idempresa, 
                    'rel' : datos[i].tm_idempresa,
                    'class' : "modern-row"
                });
                $contentRow = '<td>' + datos[i].TipoOrg + '</td>';
                $contentRow += '<td class="nombre">' + datos[i].tm_nombre + '</td>';
                $contentRow += '<td class="hidden">' + datos[i].tm_representante + '</td>';
                $contentRow += '<td class="email">' + datos[i].tm_email + '</td>';
                $contentRow += '<td class="hidden">' + datos[i].tm_telefonos + '</td>';
                $contentRow += '<td class="hidden">' + datos[i].Pais + '</td>';
                $rowData.append($contentRow);
                $('#tblDatos tbody').append($rowData);
                $('.grid-down').slideUp();
            });
            initEventRowsData();
            initEventsRowsOrg();
        }
        $("#btnShowMore").html("...");
        $(".data-view").animate({ scrollTop: $('.data-view')[0].scrollHeight}, 1000);
    }
</script>
<div class="page-region">
    <form id="form1" name="form1" method="get">
        <input type="hidden" id="pag" name="pag" value="<?php echo $pag; ?>" />
        <input type="hidden" id="subpag" name="subpag" value="<?php echo $subpag; ?>" />
        <input type="hidden" id="op" name="op" value="<?php echo $op; ?>" />
        <input type="hidden" id="firstLit" name="firstLit" value="<?php echo $firstLit; ?>" />
        <input type="hidden" id="hdFilterPais" name="hdFilterPais" value="<?php echo $hdFilterPais; ?>" />
        <input type="hidden" id="hdFilterRubro" name="hdFilterRubro" value="<?php echo $hdFilterRubro; ?>" />

        <input type="hidden" id="showAppBar" name="showAppBar" value="<?php echo $showAppBar; ?>" />

        <div class="main-filter">
            <table class="tabla-normal">
                <tr>
                    <td>
                        <div class="input-control text" style="padding-bottom:0px; margin-bottom:0px;">
                            <input id="txtSearch" name="txtSearch" type="text" class="search" placeholder="Ingrese criterio de b&uacute;squeda..." value="<?php echo $txtSearch; ?>">
                            <button class="btn-clear" tabindex="-1" type="button"></button>
                        </div>
                    </td>
                    <td style="width:85px;">
                        <div class="toolbar" style="margin:0px !important; padding:0px !important;">
                            <button id="btnFilter" type="button" title="M&aacute;s filtros" class="default" style="margin-left:10px; margin-bottom:0px;"><i class="icon-filter"></i></button>
                            <button id="btnSearch" type="button" title="M&aacute;s filtros" class="default" style="margin-bottom:0px;"><i class="icon-search"></i></button>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <div class="grid-down">
            <div class="pagination">
                <ul>
                    <li<?php 
                        if ($firstLit == '')
                            $activeLetter = ' class="active"';
                        echo $activeLetter; 
                    ?>><a href="<?php echo $linksearch; ?>" rel="">*</a></li>
                    <?php
                    
                    foreach (range('A', 'Z') as $char) {
                        $activeLetter = '';
                        if ($char == $firstLit)
                            $activeLetter = ' class="active"';
                        echo '<li'.$activeLetter.'><a href="'.$linksearch.$char.'" rel="'.$char.'">'.$char.'</a></li>';
                    }
                    ?>
                </ul>
            </div>
            <div class="grid" style="padding-bottom:0px; margin-bottom:0px;">
                <div class="row">
                    <div class="span4">
                        <h3 class="fg-color-white">Tipo de organizaci&oacute;n</h3>
                        <div class="input-control select">
                            <select id="ddlTipoOrg" name="ddlTipoOrg">
                                <option value="0">TODOS</option>
                                <?php 
                                echo loadOpcionSel('tp_tipoorganizacion', 'Activo=1', 'tp_idtipoorg', 'tp_nombre', $ddlTipoOrg);
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="span4">
                        <h3 class="fg-color-white">Pa&iacute;ses</h3>
                        <div class="input-control select">
                            <select id="ddlPais" name="ddlPais">
                                <option value="0">TODOS</option>
                                <?php 
                                echo loadOpcionSel('tp_pais', 'Activo=1', 'tp_idpais', 'tp_nombre', $ddlPais);
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="span4">
                        <h3 class="fg-color-white">Rubros</h3>
                        <div class="input-control select">
                            <select id="ddlRubro" name="ddlRubro">
                                <option value="0">TODOS</option>
                                <?php 
                                echo loadOpcionSel('tp_rubro', 'Activo=1', 'tp_idrubro', 'tp_nombre', $ddlRubro);
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="span2">
                        <label class="input-control radio" onclick="">
                            <input id="rbEmpresa" type="radio" name="rbTipoCriterio" value="isEmp"<?php echo $checkOpEmp; ?>>
                            <span class="helper fg-color-white">Empresa</span>
                        </label>
                    </div>
                    <div class="span2">
                        <label class="input-control radio" onclick="">
                            <input id="rbRepresentante" type="radio" name="rbTipoCriterio" value="isRep"<?php echo $checkOpRep; ?>>
                            <span class="helper fg-color-white">Representante</span>
                        </label>
                    </div>
                    <div class="span2">
                        <label class="input-control switch" onclick="">
                            <input id="chkMiembro" name="chkMiembro" type="checkbox"<?php echo $esMiembro == '1' ? ' checked="checked"' : ''; ?> value="<?php echo $esMiembro; ?>">
                            <span class="helper fg-color-white">Miembros</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="data-view">
            <table id="tblDatos" class="bordered hovered fg-color-white">
                <thead>
                    <tr>
                        <th class="bg-color-darken fg-color-white">Tipo</th>
                        <th class="bg-color-darken fg-color-white">Nombre</th>
                        <th class="bg-color-darken fg-color-white hidden">Representante</th>
                        <th class="bg-color-darken fg-color-white">Email</th>
                        <th class="bg-color-darken fg-color-white hidden">Tel&eacute;fono</th>
                        <th class="bg-color-darken fg-color-white hidden">Pa&iacute;s</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($i < $countrows){
                    ?>
                    <tr id="row<?php echo $row[$i]['tm_idempresa']; ?>" rel="<?php echo $row[$i]['tm_idempresa']; ?>" class="modern-row">
                        <td><?php echo $row[$i]['TipoOrg']; ?></td>
                        <td class="nombre"><?php echo $row[$i]['tm_nombre']; ?></td>
                        <td class="hidden"><?php echo $row[$i]['tm_representante']; ?></td>
                        <td class="email"><?php echo $row[$i]['tm_email']; ?></td>
                        <td class="hidden"><?php echo $row[$i]['tm_telefonos']; ?></td>
                        <td class="hidden"><?php echo $row[$i]['Pais']; ?></td>
                    </tr>
                    <?php
                        ++$i;
                    }
                    
                    ?>
                </tbody>
            </table>
            <div class="clear"></div>
        </div>
        <div class="more">
            <button id="btnShowMore" type="button">...</button>
        </div>
    </form>
    <?php
    if ($showAppBar == '1'){
    ?>
    <div class="appbar">
        <button id="btnDescargar" type="button" class="metro_button float-right">
            <span class="content">
                <img src="images/Cloud-download.png" alt="Descargar" />
                <span class="text">Archivos</span>
            </span>
        </button>
        <button id="btnEliminar" type="button" class="metro_button oculto float-right">
            <span class="content">
                <img src="images/trash.png" alt="Eliminar" />
                <span class="text">Eliminar</span>
            </span>
        </button>
        <button id="btnEditOrg" type="button" class="metro_button oculto float-right">
            <span class="content">
                <img src="images/edit.png" alt="Editar" />
                <span class="text">Editar</span>
            </span>
        </button>
        <button id="btnNewOrg" type="button" class="metro_button float-right">
            <span class="content">
                <img src="images/add.png" alt="Nuevo" />
                <span class="text">Nuevo</span>
            </span>
        </button>
        <button id="btnLimpiarSeleccion" type="button" class="metro_button oculto float-right">
            <span class="content">
                <img src="images/icon_uncheck.png" alt="Limpiar selecci&oacute;n" />
                <span class="text">Limpiar selecci&oacute;n</span>
            </span>
        </button>
        <div class="clear"></div>
    </div>
    <?php
    }
    ?>
    <div id="dialogUpload" style="position:absolute; top:0px; right:0px; left:0px; bottom:0px; background:rgba(0,0,0,0.5); display:none; ">
        <div class="message-dialog bg-color-blueLight fg-color-black" style="padding-bottom:20px;">
            <h2 style="color:#369;">File manager</h2>
            <form id="form2" name="form2" method="post" action="<?php echo $PHP_SELF; ?>" enctype="multipart/form-data">
                <input type="file" id="excel" name="excel" />
                <input type="hidden" value="upload" name="action" id="action" />
                <input type="hidden" value="upload" name="upload" id="upload" />
                <input type="hidden" id="fnPost" name="fnPost" value="fnPost" name="action" />

                <button id="btnCancelUpload" name="btnCancelUpload" type="button" class="default place-right">Cancelar</button>
                <button id="btnExecUpload" name="btnExecUpload" type="submit" class="default place-right">Subir archivos</button>
            </form>
        </div>
    </div>
    <div class="clear"></div>
</div>