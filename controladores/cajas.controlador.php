<?php
    class cajasControlador{
        static function ctrListar() {
            $tabla = "cajas"; 
            $respuesta = cajasModel::mdlListar($tabla, null, null);
            return $respuesta;
        }
        static function ctrListarCajasAbiertas(){
            $tabla = "cajas"; 
            $item = "caja_estado";
            $valor = 0;
            $respuesta = cajasModel::mdlListar($tabla,$item, $valor);
            return $respuesta;
        }
        static function ctrGuardar($descripcion) {
            $respuesta= cajasModel::mdlGuardar($descripcion);
            return $respuesta;
        }
        static function ctrActualizar($id, $estado) {
            $respuesta = cajasModel::mdlActualizar($id, $estado);
            return $respuesta;
        }
    }
?>