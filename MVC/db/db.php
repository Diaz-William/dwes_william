<?php
    require_once("movconfig.php");
    class Conectar {
        public static function conexion(){
            $conexion = new PDO("mysql:host=".DB_SERVER.";dbname=".DB_DATABASE, DB_USERNAME,DB_PASSWORD);
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conexion;
        }
    }
?>