<?php
require_once("java/Java.inc"); 
require_once('sentencias.php');
require_once('funciones.php');
ini_set("display_errors", "on");

$nombre=$_POST['nombre'];

$cat = catalogos();
$db = conectar();
if($cat)
{
	$datalist = "SELECT  id_cat  FROM taxonomia WHERE nom_especie = '".$nombre."' ORDER BY id_cat  ASC";
	$resdata = pg_query($cat, $datalist);
	if (!$resdata) { exit("Error en la consulta"); }
	
	echo  "<datalist id=\"t_nombre_comun\">"; 	
		while 	($fila = pg_fetch_array($resdata, null, PGSQL_ASSOC))	
		{	
			foreach ($fila as $valor) 
			{ 
				$busca_nombre = "SELECT  nom_comun  FROM nombre_comun WHERE id_cat = '".$valor."'";
				$resdata_nombre = pg_query($cat, $busca_nombre);
				if (!$resdata_nombre) { exit("Error en la consulta"); }
				while 	($fila_nombre = pg_fetch_array($resdata_nombre, null, PGSQL_ASSOC))	
				{	
					foreach ($fila_nombre as $valor_nombre) 
					{ 
						echo  "<option value=\"$valor_nombre\">";	
					}	
				} 	
			}	
		} 
	echo  "</datalist>";

}
?>