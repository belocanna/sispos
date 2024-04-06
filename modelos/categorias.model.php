<?php
    require_once "conexion.php";
    class categoriasModel{
        static public function mdlListar($tabla, $item, $valor)
        {
            if ($item != null) {
                $stmt = Conexion::connect()->prepare("SELECT * from $tabla where $item = :$item");
                $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
                $stmt->execute();
                return $stmt->fetch();
            }else{
                $stmt = Conexion::connect()->prepare("SELECT * from $tabla");
                $stmt->execute();
                return $stmt->fetchAll();
            }
           
        }
        static public function mdlGuardar($descripcion, $ubicacion)
        {
    
            $stmt = Conexion::connect()->prepare("INSERT into categorias (categoria_nombre, categoria_ubicacion) values (?,?)");
            $stmt->bindParam(1, $descripcion, PDO::PARAM_STR);
            $stmt->bindParam(2, $ubicacion, PDO::PARAM_STR);
            if ($stmt->execute()) {
                $result = "Categoria Agregada";
            } else {
                $result = "Error al Agregar";
            }
            return $result;
        }
        static public function mdlActualizar($id, $descripcion, $ubicacion) {
            $stmt = Conexion::connect()->prepare("UPDATE categorias set categoria_nombre = ?, categoria_ubicacion = ? where categoria_id = ?");
            $stmt->bindParam(1, $descripcion, PDO::PARAM_STR);
            $stmt->bindParam(2, $ubicacion, PDO::PARAM_STR);
            $stmt->bindParam(3, $id);
            if ($stmt->execute()) {
                $result = "Categoria Actualizada";
            } else {
                $result = "Error al Agregar";
            }
            return $result;   
        }
    }

