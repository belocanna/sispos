<?php
    class categoriasControlador{
        static function ctrlistar(){
            $tabla ="categorias";
            $respuesta  = categoriasModel::mdlListar($tabla, null, null);
            return $respuesta;
        }
        static function ctrGuardar($descripcion, $ubicacion) {
            $answer = categoriasModel::mdlGuardar($descripcion, $ubicacion);
            return $answer;
        }
        static function ctrActualizar($id, $descripcion, $ubicacion) {
            $answer = categoriasModel::mdlActualizar($id, $descripcion, $ubicacion);
            return $answer;
        }

    }