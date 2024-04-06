<?php
    require_once "conexion.php";
    class formaspagoModel{
        static public function mdlListar() {
            $stmt = Conexion::connect()->prepare("SELECT * from formaspago order by pago_id desc");
                $stmt->execute();
                return $stmt->fetchAll();
        }
    }
    