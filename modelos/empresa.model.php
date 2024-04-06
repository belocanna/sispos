<?php
require_once "conexion.php";
class empresaModel
{
    static public function mdlCargar()
    {
        $stmt = Conexion::connect()->prepare("SELECT * from empresa");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
    static public function mdlActualizar($documento,$nombre, $direccion, $telefono, $correo, $ciudad,
    $responsable, $id) {
        $stmt = Conexion::connect()->prepare("UPDATE empresa SET empresa_documento = ?, empresa_nombre = ?,
        empresa_direccion= ?, empresa_telefono = ?, empresa_correo = ?, empresa_ciudad = ?,
        empresa_responsable = ? where empresa_id = ?");
        $stmt->bindParam(1, $documento);
        $stmt->bindParam(2, $nombre);
        $stmt->bindParam(3, $direccion);
        $stmt->bindParam(4, $telefono);
        $stmt->bindParam(5, $correo);
        $stmt->bindParam(6, $ciudad);
        $stmt->bindParam(7, $responsable);
        $stmt->bindParam(8, $id);
        if ($stmt->execute()) {
            $result = "Datos Generales Registrados";
        } else {
            $result = "Error al Agregar";
        }
        return $result;
    }
    static public function mdlDatosEmpresa() {
        $stmt = Conexion::connect()->prepare("SELECT  empresa_documento, empresa_nombre, empresa_direccion, empresa_telefono, empresa_correo, empresa_ciudad from empresa");
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
