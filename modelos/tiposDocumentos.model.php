<?php
    require_once "conexion.php";
    class tiposDocumentosModel{
        static public function mdlListar()
        {
            $stmt = Conexion::connect()->prepare("SELECT * from tiposdocumentos");
            $stmt->execute();
            return $stmt->fetchAll();
            $stmt = null;
        }
    }