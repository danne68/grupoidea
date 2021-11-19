<?php
	ini_set("display_errors", false);
	require_once "conexion.php";
  if($_GET['action'] == 'site') {
    if(isset($_POST['id']))
      $id = $_POST["id"];
    if(isset($_POST['imagen']))
			$picture = $_POST["imagen"];
    if(isset($_POST['editorcontacto']))      
      $description = $_POST["editorcontacto"];
    
    $option = $_POST["opcion"];

    //archivo para la foto
		$Image_name = $_FILES['image']['name'] = str_replace(" ", "", $_FILES['image']['name']); //quitar espaciados en el nombre de la imagen
		//$Image_name = $_FILES['image']['name']; //este es el nombre del archivo que acabas de subir
		$type = $_FILES['image']['type']; //este es el tipo de archivo que acabas de subir
		$temporal = $_FILES['image']['tmp_name'];//este es donde esta almacenado el archivo que acabas de subir.
		$size = $_FILES['image']['size']; //este es el tamaño en bytes que tiene el archivo que acabas de subir.
		$error = $_FILES['image']['error']; //este almacena el codigo de error que resultaría en la subida.
		$types = array("image/jpg","image/jpeg","image/gif","image/png"); // archivos extension jpeg,gif,png
    $limite_kb = 5120;
    switch ($option) {
			case "opcontact":
				$consulta = 1;
				$destino =	dirname(__FILE__).'/images/'.$Image_name;
				$temp =	dirname(__FILE__).'/images/'.$picture;
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
                $update = $con->query("UPDATE sitio SET descripcion = '$description', foto = '$Image_name' WHERE id = '$id'") or die ("No se puede ejecutar la consulta: ".mysqli_error($con));
							}
							if ($consulta == 2) {
								$con = Db::connect();
								$update = $con->query("UPDATE categoria SET categoria = '$category', slug = '$slug', descripcion = '$description',foto = '$Image_name' WHERE id = '$id'") or die ("No se puede ejecutar la consulta: ".mysqli_error($con));
							}
							if ($consulta == 3) {
								$con = Db::connect();
								$update = $con->query("UPDATE promociones SET descripcion = '$description', foto = '$Image_name' WHERE id_promocion = '$id'") or die ("No se puede ejecutar la consulta: ".mysqli_error($con));
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
				echo "archivo no permitido(solo jpg, jpeg, gif y png) o excede el tamano de $limite_kb Kilobytes";
			}
		} else {
			if ($consulta == 1) {
				$con = Db::connect();
        $update = $con->query("UPDATE sitio SET descripcion = '$description' WHERE id = '$id'") or die ("No se puede ejecutar la consulta: ".mysqli_error($con));
			}
			if ($consulta == 2) {
				$con = Db::connect();
				$update = $con->query("UPDATE categoria SET categoria = '$category', slug = '$slug', descripcion = '$description' WHERE id = '$id'") or die ("No se puede ejecutar la consulta: ".mysqli_error($con));
			}
			if ($consulta == 3) {
				$con = Db::connect();
				$update = $con->query("UPDATE promociones SET descripcion = '$description' WHERE id_promocion = '$id'") or die ("No se puede ejecutar la consulta: ".mysqli_error($con));
			}
			echo "modificado";
		}
  }
  if($_GET['action'] == 'social') {
    if(isset($_POST['id-facebook'])) {
      $id = $_POST["id-facebook"];
      $link = $_POST["url-facebook"];
      $con = Db::connect();
      $update = $con->query("UPDATE redes SET link = '$link' WHERE id = '$id'") or die ("No se puede ejecutar la consulta: ".mysqli_error($con));
    }
    if(isset($_POST['id-messenger'])) {
      $id = $_POST["id-messenger"];
      $link = $_POST["url-messenger"];
      $con = Db::connect();
      $update = $con->query("UPDATE redes SET link = '$link' WHERE id = '$id'") or die ("No se puede ejecutar la consulta: ".mysqli_error($con));
    }
    if(isset($_POST['id-whatsapp'])) {
      $id = $_POST["id-whatsapp"];
      $link = $_POST["url-whatsapp"];
      $con = Db::connect();
      $update = $con->query("UPDATE redes SET link = '$link' WHERE id = '$id'") or die ("No se puede ejecutar la consulta: ".mysqli_error($con));
    }
    if(isset($_POST['id-linkedin'])) {
      $id = $_POST["id-linkedin"];
      $link = $_POST["url-linkedin"];
      $con = Db::connect();
      $update = $con->query("UPDATE redes SET link = '$link' WHERE id = '$id'") or die ("No se puede ejecutar la consulta: ".mysqli_error($con));
    }
    if(isset($_POST['id-twitter'])) {
      $id = $_POST["id-twitter"];
      $link = $_POST["url-twitter"];
      $con = Db::connect();
      $update = $con->query("UPDATE redes SET link = '$link' WHERE id = '$id'") or die ("No se puede ejecutar la consulta: ".mysqli_error($con));
    }
    if(isset($_POST['id-youtube'])) {
      $id = $_POST["id-youtube"];
      $link = $_POST["url-youtube"];
      $con = Db::connect();
      $update = $con->query("UPDATE redes SET link = '$link' WHERE id = '$id'") or die ("No se puede ejecutar la consulta: ".mysqli_error($con));
    }
    echo "modificado";
  }
  
?>