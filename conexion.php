<?php
//New Connection
if (!function_exists('mysqli_init') && !extension_loaded('mysqli')) {
    echo 'We don\'t have mysqli!!!';
}

//server
Class Db {
    public static function connect() {
        $host = "174.136.25.70"; // nombre del anfitrion
        $username = "grupoid5_daniel_ed"; // Mysql nombre del usuario
        $password = "5RExqBpaZVYG"; // Mysql contrasenia
        $db_name = "grupoid5_grupoidea"; // nombre de la base de datos
        $conn = new mysqli($host,$username,$password,$db_name);
        if($conn->connect_error){
            die("Conexion fallida: " . $conn->connect_error);
        }
        return $conn;
    }
}

//local
/*
Class Db {
    public static function connect() {
        $host		=	"mysql"; // nombre del anfitrion
        $username	=	"user"; // Mysql nombre del usuario
        $password	=	"user"; // Mysql contrasenia
        $db_name	=	"default_schema"; // nombre de la base de datos
        $conn = new mysqli($host,$username,$password,$db_name);
        if($conn->connect_error){
            die("Conexion fallida: " . $conn->connect_error);
        }
        return $conn;
    }
}
*/

?>