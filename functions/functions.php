<?php

function insert_into($tbl,$campos,$values){
    $unCampos = join(",",$campos);
    $unValues = join("','",$values);
    $con = Db::connect();
    $sql = "INSERT INTO $tbl ($unCampos) VALUES('".$unValues."')";
	$con->query($sql) or die("No se puede ejecutar la consulta: ".mysqli_error($con));
}

function select_to_where($tbl,$campos,$donde){
	if(is_array($donde)) {
		foreach( $donde as $key => $key_value ){
			$query_array[] = urlencode( $key ) . '=' . urlencode( $key_value );
		}
		$unDonde = implode($query_array);
	} else {
		$unDonde = $donde;
	}
	$data= array();
	$con = Db::connect();
	$query = $con->query("SELECT $campos FROM $tbl WHERE $unDonde");
	if($query->num_rows>0){
		while ($r=$query->fetch_array()) {
			$data[]=$r;
		}
	}
	return $data;
	mysql_close();
}

function select_to($tbl,$campos){
	$data= array();
	$con = Db::connect();
	$query = $con->query("SELECT $campos FROM $tbl");
	if($query->num_rows>0){
		while ($r=$query->fetch_array()) {
			$data[]=$r;
		}
	}
	return $data;
	mysql_close();
}

function select_to_order($tbl,$campos,$order){
	$data= array();
	$con = Db::connect();
	$query = $con->query("SELECT $campos FROM $tbl ORDER BY $order");
	if($query->num_rows>0){
		while ($r=$query->fetch_array()) {
			$data[]=$r;
		}
	}
	return $data;
	mysql_close();
}

?>