<?php 
     class Conexion{
        static public function connect() {
            $con = new PDO("mysql:host=localhost;dbname=pos", "root","", array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8"));
            return $con;
        }
    }
?>