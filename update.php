<?php
	ini_set("display_errors", false);
	require_once "conexion.php";
	if($_GET['action'] == 'deleteProm') {
		$id = $_POST["id"];
		$picture = $_POST["imagen"];
		$temp = dirname(__FILE__).'/images/promociones/'.$picture;

		$con = Db::connect();
		$delete = $con->query("DELETE FROM promociones WHERE id_promocion = ".$id."") or die ("No se puede ejecutar la consulta: ".mysqli_error($con));
		unlink($temp);
		echo "eliminado";
	}
	if($_GET['action'] == 'deleteCat') {
		$id = $_POST["id"];
		$picture = $_POST["imagen"];
		$temp = dirname(__FILE__).'/images/categorias/';
		$tempProd = dirname(__FILE__).'/images/productos/';
		$con = Db::connect();

		$sql = $con->query("SELECT foto FROM categoria WHERE id = $id") or die ("No se puede ejecutar la consulta: ".mysqli_error($con));
		while( $row = mysqli_fetch_array($sql)) {
            unlink($temp.$row['foto']);
		}

		$sqlProd = $con->query("SELECT foto FROM productos WHERE categoria = $id") or die ("No se puede ejecutar la consulta: ".mysqli_error($con));
		while( $rowProd = mysqli_fetch_array($sqlProd)) {
            unlink($tempProd.$rowProd['foto']);
		}
		
		$deleteProd = $con->query("DELETE FROM productos WHERE categoria = $id") or die ("No se puede ejecutar la consulta: ".mysqli_error($con));

		$delete = $con->query("DELETE FROM categoria WHERE id = $id") or die ("No se puede ejecutar la consulta: ".mysqli_error($con));
		unlink($temp.$picture);

		echo "eliminado";
	}
	if($_GET['action'] == 'deleteProd') {
		$id = $_POST["id"];
		$picture = $_POST["imagen"];
		$temp = dirname(__FILE__).'/images/productos/'.$picture;
		$con = Db::connect();
		$delete = $con->query("DELETE FROM productos WHERE id = ".$id."") or die ("No se puede ejecutar la consulta: ".mysqli_error($con));
		unlink($temp);
		echo "eliminado";
	}
	if($_GET['action'] == 'update') {
		if(isset($_POST['id']))
			$id = $_POST["id"];
		if(isset($_POST['categoria']))
			$category =	$_POST["categoria"];
		if(isset($_POST['categoria_id']))
			$category_id = $_POST["categoria_id"];
		if(isset($_POST['descripcion']))
			$description = $_POST["descripcion"];
		if(isset($_POST['imagen']))
			$picture = $_POST["imagen"];
		if(isset($_POST['nombre']))
			$name = $_POST["nombre"];
		$option = $_POST["opcion"];

		//archivo para la foto
		$Image_name		=	$_FILES['image']['name'] = str_replace(" ", "", $_FILES['image']['name']); //quitar espaciados en el nombre de la imagen
		//$Image_name		=	$_FILES['image']['name']; //este es el nombre del archivo que acabas de subir
		$type			=	$_FILES['image']['type']; //este es el tipo de archivo que acabas de subir
		$temporal		=	$_FILES['image']['tmp_name'];//este es donde esta almacenado el archivo que acabas de subir.
		$size			=	$_FILES['image']['size']; //este es el tamaño en bytes que tiene el archivo que acabas de subir.
		$error			=	$_FILES['image']['error']; //este almacena el codigo de error que resultaría en la subida.
		$types			=	array("image/jpg","image/jpeg","image/gif","image/png"); // archivos extension jpeg,gif,png
		$limite_kb		=	5120;

		switch ($option) {
			case "opprod":
				$consulta = 1;
				$destino =	dirname(__FILE__).'/images/productos/'.$Image_name;
				$temp =	dirname(__FILE__).'/images/productos/'.$picture;
				break;
			case "opcat":
				$consulta = 2;
				$destino =	dirname(__FILE__).'/images/categorias/'.$Image_name;
				$temp =	dirname(__FILE__).'/images/categorias/'.$picture;
				break;
			case "opprom":
				$consulta = 3;
				$destino =	dirname(__FILE__).'/images/promociones/'.$Image_name;
				$temp =	dirname(__FILE__).'/images/promociones/'.$picture;
				break;
		}
		if ($Image_name!=NULL) {
			if (in_array($type,$types) && $size <= $limite_kb*1020) {
				if(isset($_FILES['image'])) {
					unlink($temp);
					if (!file_exists($destino)) {
						$resultado = move_uploaded_file($temporal, $destino);
						if ($resultado) {
							if ($consulta == 1) {
								$con = Db::connect();
								$update = $con->query("UPDATE productos SET nombre = '$name',categoria = '$category',descripcion = '$description',foto = '$Image_name' WHERE id = '$id'") or die ("No se puede ejecutar la consulta: ".mysqli_error($con));
							}
							if ($consulta == 2) {
								$con = Db::connect();
								$update = $con->query("UPDATE categoria SET categoria = '$category',descripcion = '$description',foto = '$Image_name' WHERE id = '$id'") or die ("No se puede ejecutar la consulta: ".mysqli_error($con));
							}
							if ($consulta == 3) {
								$con = Db::connect();
								$update = $con->query("UPDATE promociones SET descripcion = '$description',foto = '$Image_name' WHERE id_promocion = '$id'") or die ("No se puede ejecutar la consulta: ".mysqli_error($con));
							}
							/**************VARIABLES PARA BAJAR EL PESO Y TAMAÑO DE LA IMAGEN UNA VES SUBIDA AL SERVIDOR******************/
							$ruta_imagen = $destino;
							$info_imagen = getimagesize($ruta_imagen);
							$imagen_ancho = $info_imagen[0];
							$imagen_alto = $info_imagen[1];
							$imagen_tipo = $info_imagen['mime'];
						}
					} else {
						echo $Image_name . ", este archivo existe";
					}
				}
			} else {
				echo "archivo no permitido(solo jpg,jpeg,gif y png) o excede el tamano de $limite_kb Kilobytes";
			}
		} else {
			if ($consulta == 1) {
				$con = Db::connect();
				$update = $con->query("UPDATE productos SET nombre = '$name',categoria = '$category',descripcion = '$description' WHERE id = '$id'") or die ("No se puede ejecutar la consulta: ".mysqli_error($con));
			}
			if ($consulta == 2) {
				$con = Db::connect();
				$update = $con->query("UPDATE categoria SET categoria = '$category',descripcion = '$description' WHERE id = '$id'") or die ("No se puede ejecutar la consulta: ".mysqli_error($con));
			}
			if ($consulta == 3) {
				$con = Db::connect();
				$update = $con->query("UPDATE promociones SET descripcion = '$description' WHERE id_promocion = '$id'") or die ("No se puede ejecutar la consulta: ".mysqli_error($con));
			}
			echo "modificado";
		}
	}
?>