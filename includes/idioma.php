<?php
/**
* Idiomas
*/
class clsIdioma
{
	private $objData;

	function __construct()
	{
		$this->objData = new Db();
	}

	function Listar($tipo, $param1 = '', $param2 = '')
	{
		$bd = $this->objData;
		$tabla = 'tm_idioma';
		$condicion = '';

		if ($tipo === 'L' || $tipo === 'ALL'){			
			if ($tipo === 'L')
				$campos = array('tm_ididioma', 'tm_nombre', 'tm_simbolo');
			elseif ($tipo === 'ALL')
				$campos = '*';
			
			$condicion = 'Activo = 1';
			
			if ($param2 != '')
				$condicion .= ' tm_nombre like \'%'.$param2.'%\'';
			$orden = 'tm_nombre';
		}
		elseif ($tipo === "O"){
			$campos = '*';
			$condicion = 'tm_ididioma = '.$param1;
		}
		$rs = $bd->set_select($campos, $tabla, $condicion);
		return $rs;
	}
}
?>