<?php
require_once "conexion.php";
    class medidasModel{
        static public function mdlListar()
        {
            $stmt = Conexion::connect()->prepare("SELECT * from medidas");
            $stmt->execute();
            return $stmt->fetchAll();
        }
        static public function mdlGuardar($descripcion) {
            $stmt = Conexion::connect()->prepare("INSERT INTO medidas (medida_nombre) values (?)");
            $stmt->bindParam(1,$descripcion, PDO::PARAM_STR);
            if ($stmt->execute()) {
                $result = "Medida Agregada";
            } else {
                $result = "Error al Agregar";
            }
            return $result;
        }
        static public function mdlActualizar($id, $descripcion) {
            $stmt = Conexion::connect()->prepare("UPDATE medidas set medida_nombre = ? where medida_id = ?");
            $stmt->bindParam(1,$descripcion);
            $stmt->bindParam(2,$id);
            if ($stmt->execute()) {
                $result = "Medida Actualizada";
            } else {
                $result = "Error al Actualizar";
            }
            return $result;
        }
    }