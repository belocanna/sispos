<?php
    class medidasController{
        static function ctrListar() {
            $respuesta = medidasModel::mdlListar();
            return $respuesta;
        }
        static function ctrGuardar($descripcion) {
            $respuesta= medidasModel::mdlGuardar($descripcion);
            return $respuesta;
        }
        static function ctrActualizar($id, $descripcion) {
            $respuesta = medidasModel::mdlActualizar($id, $descripcion);
            return $respuesta;
        }
    }