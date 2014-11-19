<?php

class Db {

	private $link;

	private $stmt;

	private $array;

	

	private function conectar()

	{

		/*$host='localhost';

		$user='inuqorg_inroot';

		$password='123@abc';

		$db='inuqorg_intranet';*/

		$host='localhost';

		$user='root';

		$password='';

		$db='iunionquality';
		
		$this->link=mysql_connect($host, $user, $password);

		mysql_select_db($db,$this->link);

		@mysql_query("SET NAMES 'utf8'");

	}

	

	public function Db()

	{

		$this->conectar();

	}

	

	private function obtener_filas($stmt)

	{

		$fetchrow = array();

		while ($row = mysql_fetch_array($stmt))

			$fetchrow[] = $row;

		$this->array = $fetchrow;

		return $this->array;

	}

	

	private function lastID()

	{

		return mysql_insert_id($this->link);

	}

	

	public function ejecutar($sql)

	{

		$this->stmt=mysql_query($sql,$this->link);

		/*echo $sql;

		echo mysql_error($this->link);*/

		return $this->stmt;

	}

	
	public function show_tables($param='')

	{

		$strsql = ' SHOW TABLES FROM iunionquality';
		$rs = $this->ejecutar($strsql);

		$resultado = $this->obtener_filas($rs);

		//echo $strsql;

		//echo mysql_error($this->link);

		return $resultado;

		mysql_free_result($resultado);

	}

	public function set_select($fields, $table, $where = false, $orderby = false, $groupby = false, $limit = false)

	{

		if (is_array($fields))

			$fields = "" . implode($fields, ", ") . "";

		$groupby = ($groupby) ? " GROUP BY " . $groupby : '';

		$orderby = ($orderby) ? " ORDER BY " . $orderby : '';

		$limit = ($limit) ? " LIMIT " . $limit : '';

		$where = ($where) ? " WHERE " . $where : '';

		$strsql = "SELECT " . $fields . " FROM " . $table . "" . $where . $groupby . $orderby . $limit;

		$rs = $this->ejecutar($strsql);

		$resultado = $this->obtener_filas($rs);

		//echo $strsql;

		//echo mysql_error($this->link);

		return $resultado;

		mysql_free_result($resultado);

	}

	

	public function set_insert(array $values, $table)

	{

		if (count($values) < 0)

			return false;

		foreach($values as $field => $val){

			$val = "'".$val."'";

			$values[$field] = $val; 

		}

		$strsql = "INSERT INTO ".$table." (".implode(array_keys($values), ", ").") VALUES (".implode($values, ", ").")";

		$rs = $this->ejecutar($strsql);

		//echo $strsql;

		//echo mysql_error($this->link);

		if ($rs)

			return $this->lastID();

		else

			return 0;

	}

	

	public function set_update($values, $table, $where = false)

	{

		if (is_array($values)) {

			if (count($values) < 0)

				return false;

			$fields = array();

			foreach($values as $field => $val){

				$val = "'".$val."'";

				$fields[] = $field." = ".$val;

			}

			$strsql = "UPDATE ".$table." SET ".implode($fields, ", ");
		}
		else {
			$strsql = "UPDATE ".$table." SET $values ";
		}

		$where = ($where) ? " WHERE ".$where : '';

		$strsql = $strsql.$where;

		$rs = $this->ejecutar($strsql);

		//echo $strsql;

		//echo mysql_error($this->link);

		if ($rs)

			return $rs;

		else

			return 0;

	}

	

	public function set_delete($table, $where = false)

	{

		$where = ($where) ? " WHERE " . $where : '';

		$strsql = "DELETE FROM ".$table."".$where;

		$rs = $this->ejecutar($strsql);

		//echo $strsql;

		//echo mysql_error($this->link);

		if ($rs)

			return $rs;

		else

			return 0;

	}

}

?>