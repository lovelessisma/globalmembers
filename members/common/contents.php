<?php 
require 'adata/Db.class.php';
require 'functions.php';
$path_URLEditService = '';
$path_URLListService = '';
/*** PATH MODULES ***/
$admin = "admin/";
$common = "common/";
$security = "security/";
$process = "process/";
$settings = "settings/";
/*******************/
/*** PATH VIEWS ***/
$views = "views/";
/*******************/
/*** NAMEPAGES ***/

/***** COMMON ***/
$p_home = "home.php";
$p_settings = "settings.php";
$p_logout = "logout.php";
/******************/

/******ADMIN****/
$p_admin = "admin-$op.php";
/*/////////////////*/

/********PROCESS*******/
$p_apps = "apps-$op.php";
$p_sales = "sales-$op.php";
$p_blog = "blog-$op.php";
$p_chat = "chat-$op.php";
$p_recommends = "recommends-$op.php";
$p_favorites = "favorites-$op.php";
/*************/
/********SECURITY*******/
$p_groups = "groups-$op.php";
/****************/
/********SETTINGS*******/
$p_currency = "currency.php";
$p_duty = "duty.php";
/****************/
$pathview = "";
$subcontent = "";
$pathcontroller = "";
if ($pag == "inicio")
	$pathview = $common.$p_home;
elseif ($pag == "admin")
{
	if ($subpag == "administracion")
		$subcontent = $p_admin;
	$pathview = $admin.$subcontent;
}
elseif ($pag == "procesos")
{
	if ($subpag == "aplicaciones")
		$subcontent = $p_apps;
    elseif ($subpag == "control-ventas")
        $subcontent = $p_sales;
    elseif ($subpag == "blog")
        $subcontent = $p_blog;
    elseif ($subpag == "chat")
        $subcontent = $p_chat;
    elseif ($subpag == "recomendaciones")
        $subcontent = $p_recommends;
    elseif ($subpag == "favoritos")
        $subcontent = $p_favorites;
	$pathview = $process.$subcontent;
}
elseif ($pag == "seguridad")
{
	if ($subpag == "perfiles")
		$subcontent = $p_groups;
	$pathview = $security.$subcontent;
}
elseif ($pag == "settings"){
    if (strlen(trim($subpag)) == 0)
        $pathview = $common.$p_settings;
    else {
        if ($subpag == 'moneda')
            $subcontent = $p_currency;
        $pathview = $settings.$subcontent;   
    }
}
if ($pathview != "")
{
	$pathview = $views.$pathview;
	include($pathview);
}
if ($isAction == false){
?>
<script>
	$(function  () {
		aplicarDimensiones();
        $(window).resize(function () {
            aplicarDimensiones();
        });
        ApplyValidNumbers();
	});
    function EliminarDatos () {
        var serializedReturn = $("#form1 input[type!=text]").serialize() + '&btnEliminar=btnEliminar';
        precargaExp('.page-region', true);
        $.ajax({
            type: "POST",
            url: '?pag=<?php echo $pag; ?>&subpag=<?php echo $subpag; ?>',
            cache: false,
            data: serializedReturn,
            success: function(data){
                var titleMensaje = '';
                var contentMensaje = '';
                var datos = eval( "(" + data + ")" );
                var validItems = datos.items_valid;
                var countValidItems = validItems.length;
                precargaExp('.page-region', false);
                if (Number(datos.rpta) > 0){
                    if (countValidItems > 0){
                        titleMensaje = '<?php $translate->__('Items eliminados correctamente'); ?>';
                        contentMensaje = '<?php $translate->__('Algunos items no se eliminaron. Click en "Aceptar" para ver detalle.'); ?>';
                    }
                    else {
                        titleMensaje = '<?php $translate->__('Items eliminados correctamente'); ?>';
                        contentMensaje = '<?php $translate->__('La operaci&oacute;n ha sido completada'); ?>';    
                    }
                }
                else {
                    titleMensaje = '<?php $translate->__('No se pudo eliminar'); ?>';
                    contentMensaje = '<?php $translate->__('La operaci&oacute;n no pudo completarse'); ?>';
                }
                MessageBox(titleMensaje, contentMensaje, "[<?php $translate->__('Aceptar'); ?>]", function () {
                    var arrayValid = validItems.split(',');
                    var dataSelected = $('.tile-area .tile.selected');
                    var countDataSelected = dataSelected.length;
                    var i = 0;
                    var idItem = 0;
                    var $Notif = '';
                    if (countValidItems > 0){
                        $('.error-list').html('');
                        while(i < countDataSelected){
                            idItem = dataSelected[i].getAttribute('rel');
                            if (arrayValid.indexOf( idItem )>=0){
                                $Notif += '<div class="notification warning">';
                                $Notif += '<aside><i class="fa fa-warning"></i></aside>';
                                $Notif += '<main><p><strong>Error en item con ID: ' + $(dataSelected[i]).find('.tile-status span.label').text() + '</strong>';
                                $Notif += 'El item no pudo ser eliminado por tener referencia con otras operaciones realizadas.</p></main>';
                                $Notif += '</div>';
                            }
                            else {
                                $(dataSelected[i]).fadeOut(400, function () {
                                    $(this).remove();
                                });
                            }
                            ++i;
                        }
                        $('.error-list').html($Notif);
                        $('#modalItemsError').show();
                        $.fn.custombox({
                            url: '#modalItemsError',
                            effect: 'slit'
                        });
                    }
                    else {
                        if (datos.rpta > 0){
                           dataSelected.fadeOut(400, function () {
                                $(this).remove();
                            }); 
                        }
                    }
                    clearOnlyListSelection();
                    if ($('#gvDatos .tile-area .tile').length == 0){
                        if (typeof BuscarDatos == 'function')
                            BuscarDatos('1');
                    }
                });
            }
        });
    }
	function clearSelection () {
		$('.contentPedido ul li.selected').removeClass('selected');
		clearOnlyListSelection();
	}
	function clearOnlyListSelection () {
		$('.gridview .selected').removeClass('selected');
        $('.gridview .tile input:checkbox').removeAttr('checked');
        $('.tile .input_spinner').hide();
		setButtonState("03");
	}
	function aplicarDimensiones() {
		/*windowHeight = document.documentElement.offsetHeight;
        if ($('.inner-page:visible .title-window').length > 0)
            header_height = $('.inner-page:visible .title-window').height() + 20;
        else {
            titleWindowParent = $('.inner-page:visible').parent().children('.title-window');
            if (titleWindowParent.length > 0)
                header_height = titleWindowParent.height() + 20;
            else
                header_height = 0;
        }
            
        
        appbar_height = 0;
        more_height = ($('.inner-page:visible .more').length > 0 ? $('.inner-page:visible .more').height() : 0);
        panel_search_height = ($('.inner-page:visible .panel-search').length > 0 ? $('.inner-page:visible .panel-search').height() : 0);
        
        if ($('.appbar').is(':visible')){
            if ($('.appbar').length > 0){
                strMarginTopAppBar = $('.appbar').css('marginTop');
                marginTopAppBar = Number(strMarginTopAppBar.substr(0, strMarginTopAppBar.length - 2));
                appbar_height = (marginTopAppBar > 0 ? 0 : $('.appbar').height());
                $('.slide-options').css('bottom', $('.appbar').height() + 'px');
            }
            else
                $('.slide-options').css('bottom', '0px');
        }
        header_height = Number(header_height);
        panel_search_height = Number(panel_search_height);
        more_height = Number(more_height);
        appbar_height = Number(appbar_height);
        
		<?php
		if ($subpag == 'ventas' || 
            $subpag == 'pedidos' ||
			$subpag == 'productos' || 
			$subpag == 'personal' ||
			$subpag == 'proveedores' ||
            $subpag == 'categorias' ||
			$subpag == 'clientes' ||
			$subpag == 'ambientes-mesas' ||
            $subpag == 'menu-hoy' ||
            $subpag == 'monitor' ||
            $subpag == 'cocina' ||
            $subpag == 'almacen' ||
            $pag == 'config'){
		?>
		$(".divContent").css("height", windowHeight - (header_height + appbar_height));
        $(".divload").css("height", windowHeight - (header_height + panel_search_height + more_height + appbar_height));
        <?php
		}
		else {
        ?>
        $(".divload").css("height", windowHeight - (header_height + panel_search_height + more_height + appbar_height));
        <?php
        }
        ?>*/
    }
	function setButtonState (state) {
		if (state == "01"){
            <?php
            if ($subpag != 'menu-hoy'):
            ?>
            $('#btnEliminar').removeClass('oculto');
            <?php
            endif
            ?>
			$("#btnAddOrder, #btnEditar, #btnEditRooms, #btnAsignarMenu, #btnAsignarCarta, #btnDelRooms, #btnClearSelection, #btnLimpiarSeleccion, #btnMiniBack, #btnVerDetalle, #btnContactar").removeClass("oculto");
			$("#btnNuevo, #btnUploadExcel, #btnNuevaMesa,  #btnNuevoAmbiente, #btnDescargar, #btnReporte").addClass("oculto");
		}
		else if (state == "02"){
            <?php
            if ($subpag != 'menu-hoy'):
            ?>
            $('#btnEliminar').removeClass('oculto');
            <?php
            endif
            ?>
			$("#btnContactar, #btnEditar, #btnEditRooms, #btnNuevo, #btnUploadExcel, #btnNuevoAmbiente, #btnNuevaMesa, #btnMiniBack, #btnDescargar, #btnReporte, #btnVerDetalle").addClass("oculto");
			$("#btnAddOrder, #btnDelRooms, #btnAsignarMenu, #btnAsignarCarta, #btnClearSelection, #btnLimpiarSeleccion").removeClass("oculto");
		}
		else if (state == "03"){
			$("#btnSelectAll, #btnDescargar, #btnReporte, #btnModelos, #btnMiniBack, #btnNuevoAmbiente, #btnNuevaMesa, #btnNuevo,  #btnUploadExcel").removeClass("oculto");
			$("#btnGuardarCambios, #btnAsignarFavorito, #btnQuitarFavorito, #btnAddOrder, #btnVerDetalle, #btnClearSelection, #btnLimpiarSeleccion, #btnContactar, #btnEditar, #btnEditRooms, #btnAsignarMenu, #btnAsignarCarta, #btnEliminar, #btnDelRooms, #btnQuitarItem").addClass("oculto");
		}
	}
	function initEventGridview(){
		$('.gridview').on('click', '.tile .tile_true_content', function(){
			selectingTile(this);
		});
	}
	function stateButtonsAppBar (state) {
		if (state){
			if ($('.gridview .dato.selected').length > 0){
				if ($('.gridview .dato.selected').length == 1)
					setButtonState("01");
				else {
					$("#btnEditar, #btnEditRooms").addClass("oculto");
                    <?php
                    if ($subpag != 'menu-hoy'):
                    ?>
                    $('#btnEliminar').removeClass('oculto');
                    <?php
                    endif
                    ?>
					$("#btnDelRooms").removeClass("oculto");
				}
			}
			else
				setButtonState("03");
		}
		else {
			if ($('.gridview .dato.selected').length > 0){
				if ($('.gridview .dato.selected').length == 1)
					setButtonState("01");
				else
					setButtonState("02");
			}
		}
	}
    function stateShowAppBar (state) {
        if (typeof showAppBar == 'function'){
            if (state == true){
                if ($('.gridview .dato.selected').length == 1)
                    showAppBar(state);
            }
            else {
                if ($('.gridview .dato.selected').length == 0)
                    showAppBar(state);
            }
        }
    }
	function selectInTile (obj) {
		var checkBox = $(obj).find('input:checkbox');
		
		if($(obj).hasClass("selected")){
			$(obj).removeClass("selected");
			stateButtonsAppBar(true);
			checkBox.removeAttr('checked');
            //stateShowAppBar(false);
		}
		else {
			$(obj).addClass("selected");
			stateButtonsAppBar(true);
			checkBox.attr('checked', '');
            //stateShowAppBar(true);
		}		
	}
	
	function selectingTile (obj) {
		if($(obj).parent().hasClass("selected")){
			$(obj).parent().removeClass("selected");
			stateButtonsAppBar(true);
		}
		else {
			$(obj).parent().addClass("selected");
			stateButtonsAppBar(true);
		}
	}
</script>
<?php 
}
?>