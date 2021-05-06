<?php 
  session_start();
  ini_set("display_errors", true);
  require_once "conexion.php";

  $myusername = $_POST['user'];
  $mypassword = $_POST['pass'];

  $con = Db::connect();
  $sql = $con->query("SELECT email,password FROM usuarios WHERE email='$myusername'") or die("No se puede ejecutar la consulta: ".mysqli_error($con));
  $data = mysqli_fetch_array($sql);

  $mypassword = md5($mypassword);
  if($data['email'] != $myusername) {
    echo "usuario";
  } else {
    if($data['password'] != $mypassword) {
      echo "contraseña";
    } else {
      echo "true";
      $_SESSION["s_user"] = $data['email'];
    }
  }
?>