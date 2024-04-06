<?php
require_once "conexion.php";
class cajasModel
{
    static public function mdlListar($tabla, $item, $valor )
    {
        try {
            if ($item != null) {
                $stmt = Conexion::connect()->prepare("SELECT * from $tabla where $item = : $item order by caja_id desc");
                $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
                $stmt->execute();
                return $stmt->fetch();
            }else{
                $stmt = Conexion::connect()->prepare("SELECT * from $tabla order by caja_id desc");
                $stmt->execute();
                return $stmt->fetchAll();
            }
            
        } catch (Exception $e) {
            print_r("Error");
        }
    }
    static public function mdlGuardar($descripcion)
    {
        $stmt = Conexion::connect()->prepare("INSERT INTO cajas (caja_nombre) values (?)");
        $stmt->bindParam(1, $descripcion, PDO::PARAM_STR);
        if ($stmt->execute()) {
            $result = "Caja Agregada";
        } else {
            $result = "Error al Agregar";
        }
        return $result;
    }
    static public function mdlActualizar($id, $estado)
    {
        $stmt = Conexion::connect()->prepare("UPDATE cajas set caja_estado = ? where caja_id = ?");
        $stmt->bindParam(1, $estado);
        $stmt->bindParam(2, $id);
        $stmt->execute();
    }
}
