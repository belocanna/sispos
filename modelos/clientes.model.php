<?php
    require_once "conexion.php";
    class clientesModel{
        static public function mdlListar()
        {
            $stmt = Conexion::connect()->prepare("SELECT
            clientes.cliente_id,
            clientes.cliente_numero_documento,
            clientes.cliente_nombres,
            clientes.cliente_ciudad,
            clientes.cliente_direccion,
            clientes.cliente_telefono,
            clientes.cliente_correo
            FROM
            clientes");
            $stmt->execute();
            return $stmt->fetchAll();
            $stmt = null;
        }
        static public function mdlGuardar($numeroDocumento, $nombres, $direccion, $telefono, $ciudad, $correo) 
        {
            $stmt = Conexion::connect()->prepare("INSERT INTO clientes (cliente_numero_documento, cliente_nombres, cliente_direccion, cliente_telefono, cliente_ciudad,
                                    cliente_correo) values (?,?,?,?,?,?)");
            $stmt->bindParam(1, $numeroDocumento);
            $stmt->bindParam(2, $nombres);
            $stmt->bindParam(3, $direccion);
            $stmt->bindParam(4, $telefono);
            $stmt->bindParam(5, $ciudad);
            $stmt->bindParam(6, $correo);
            if ($stmt->execute()) {
                $result = "Cliente Agregado";
            } else {
                $result = "Error al Agregar";
            }
            return $result;
        }
        static public function mdlActualizar($id, $numeroDocumento, $nombres, $direccion, $ciudad, $telefono, $correo) 
        {
            $stmt =Conexion::connect()->prepare("UPDATE clientes set  cliente_numero_documento = ?, cliente_nombres = ?, cliente_direccion = ? ,
            cliente_ciudad = ?, cliente_telefono = ?, cliente_correo = ? where cliente_id = ?");
            $stmt->bindParam(1, $numeroDocumento);
            $stmt->bindParam(2, $nombres);
            $stmt->bindParam(3, $direccion);
            $stmt->bindParam(4, $ciudad);
            $stmt->bindParam(5, $telefono);
            $stmt->bindParam(6, $correo);
            $stmt->bindParam(7, $id);
            if ($stmt->execute()) {
                $result = "Cliente Actualizado";
            } else {
                $result = "Error al Agregar";
            }
            return $result;
        }
        static public function mdlValidarDocumento($numeroDocumento) 
        {
            $stmt=Conexion::connect()->prepare("SELECT count(*) FROM clientes where cliente_numero_documento = ?");
            $stmt->bindParam(1, $numeroDocumento);
            $stmt->execute();
            return $stmt->fetch();
        }
        static public function mdlBuscar($numeroDocumento) {
            $stmt=Conexion::connect()->prepare("SELECT * FROM clientes where cliente_numero_documento = ?");
            $stmt->bindParam(1, $numeroDocumento);
            $stmt->execute();
            return $stmt->fetchAll();
        }
    }