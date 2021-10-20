<?php
	ini_set("display_errors", false);
	require_once "conexion.php";
  $option = $_POST["opcion"];
  if ($option == "opsocial") {
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