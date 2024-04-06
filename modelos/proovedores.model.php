<?php
    require_once "conexion.php";
    class proovedoresModel{
        static public function mdlListar()
        {
            $stmt = Conexion::connect()->prepare("SELECT
            proovedores.proovedor_id,
            proovedores.proovedor_numero_documento,
            proovedores.proovedor_nombres,
            proovedores.proovedor_ciudad,
            proovedores.proovedor_direccion,
            proovedores.proovedor_telefono,
            proovedores.proovedor_correo
            FROM
            proovedores");
            $stmt->execute();
            return $stmt->fetchAll();
            $stmt = null;
        }
        static public function mdlGuardar($numeroDocumento, $nombres, $direccion, $telefono, $ciudad, $correo) 
        {
            $stmt = Conexion::connect()->prepare("INSERT INTO proovedores (proovedor_numero_documento, proovedor_nombres, proovedor_direccion, proovedor_telefono, proovedor_ciudad,
                                    proovedor_correo) values (?,?,?,?,?,?)");
            $stmt->bindParam(1, $numeroDocumento);
            $stmt->bindParam(2, $nombres);
            $stmt->bindParam(3, $direccion);
            $stmt->bindParam(4, $telefono);
            $stmt->bindParam(5, $ciudad);
            $stmt->bindParam(6, $correo);
            if ($stmt->execute()) {
                $result = "Proovedor Agregado";
            } else {
                $result = "Error al Agregar";
            }
            return $result;
        }
        static public function mdlValidarDocumento($numeroDocumento) 
        {
            $stmt=Conexion::connect()->prepare("SELECT count(*) FROM proovedores where proovedor_numero_documento = ?");
            $stmt->bindParam(1, $numeroDocumento);
            $stmt->execute();
            return $stmt->fetch();
        }
        static public function mdlActualizar($id, $numeroDocumento, $nombres, $direccion, $telefono, $ciudad, $correo) 
        {
            $stmt =Conexion::connect()->prepare("UPDATE proovedores set proovedor_numero_documento = ?, proovedor_nombres = ?, proovedor_direccion = ? ,
            proovedor_ciudad = ?, proovedor_telefono = ?, proovedor_correo = ? where proovedor_id = ?");
            $stmt->bindParam(1, $numeroDocumento);
            $stmt->bindParam(2, $nombres);
            $stmt->bindParam(3, $direccion);
            $stmt->bindParam(4, $ciudad);
            $stmt->bindParam(5, $telefono);
            $stmt->bindParam(6, $correo);
            $stmt->bindParam(7, $id);
            if ($stmt->execute()) {
                $result = "Proovedor Actualizado";
            } else {
                $result = "Error al Agregar";
            }
            return $result;
        }
        static public function mdlBuscar($numeroDocumento) {
            $stmt=Conexion::connect()->prepare("SELECT * FROM proovedores where proovedor_numero_documento = ?");
            $stmt->bindParam(1, $numeroDocumento);
            $stmt->execute();
            return $stmt->fetchAll();
        }
    }