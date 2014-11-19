<form id="form1" name="form1" method="post">

    <input type="hidden" id="fnPost" name="fnPost" value="fnPost" />

    <input type="hidden" id="hdPageActual" name="hdPageActual" value="1" />

    <input type="hidden" id="hdPage" name="hdPage" value="1" />

    <input type="hidden" id="hdIdPrimary" name="hdIdPrimary" value="0">

    <input type="hidden" id="hdFoto" name="hdFoto" value="no-set">

    <div class="page-region">
    	<div id="pnlListado" class="inner-page with-title-window with-panel-search">
            <h1 class="title-window">
                <?php $translate->__('Control de ventas'); ?>
            </h1>
            <div class="panel-search">
                <table class="tabla-normal">
                    <tr>
                        <td>
                            <div class="input-control text" data-role="input-control">
                                <input id="txtSearch" name="txtSearch" type="text" placeholder="<?php $translate->__('Ingrese criterios de b&uacute;squeda'); ?>">
                                <button id="btnSearch" name="btnSearch" type="button"  tabindex="-1" title="<?php $translate->__('Buscar'); ?>" class="btn-search"></button>
                            </div>
                        </td>
                        <td style="width:45px;">
                            <button id="btnFilter" type="button" title="<?php $translate->__('M&aacute;s filtros'); ?>" style="margin-left:10px; margin-bottom:0px;"><i class="icon-filter"></i></button>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="grid filtro">
                <div class="row">
                </div>
            </div>
            <div class="divload">
                <div id="gvDatos">
                    <div class="tile-area gridview"></div>
                </div>
            </div>
        </div>
        <div id="pnlForm" class="inner-page" style="display:none;">
            <h1 class="title-window">
                <a id="btnBackList" href="#" title="<?php $translate->__('Regresar a listado'); ?>" class="back-button"><i class="icon-arrow-left-3 fg-darker smaller"></i></a>
                <?php $translate->__('Registro'); ?>
            </h1>
            <div class="divContent">
                <div class="form-register-data">
                    <div class="grid">
                        <div class="row">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="appbar">
         <button id="btnEliminar" name="btnEliminar" type="button" class="cancel metro_button oculto float-right">
            <span class="content">
                <img src="images/trash.png" alt="<?php $translate->__('Eliminar'); ?>" />
                <span class="text"><?php $translate->__('Eliminar'); ?></span>
            </span>
        </button>
        <button id="btnEditar" type="button" class="metro_button oculto float-right">
            <span class="content">
                <img src="images/edit.png" alt="<?php $translate->__('Editar'); ?>" />
                <span class="text"><?php $translate->__('Editar'); ?></span>
            </span>
        </button>
        <button id="btnNuevo" type="button" class="metro_button float-right">
            <span class="content">
                <img src="images/add.png" alt="<?php $translate->__('Nuevo'); ?>" />
                <span class="text"><?php $translate->__('Nuevo'); ?></span>
            </span>
        </button>
    </div>
</form>
<?php
include('common/libraries-js.php');
include('common/validate-js.php');
include('common/bootstrap-js.php');
?>
<script>

</script>