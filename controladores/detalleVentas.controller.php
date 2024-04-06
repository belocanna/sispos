<?php

    class detalleVentasController{
        static function ctrGuardar($codigo, $precio) {
            $respuesta = detalleVentasModel::mdlGuardar($codigo, $precio);
            return $respuesta;
        }
        static function ctrListar() {
            $respuesta = detalleVentasModel::mdlListar();
            return $respuesta;
        }
        static function ctrVaciar() {
            $respuesta = detalleVentasModel::mdlVaciar();
            return $respuesta;
        }
        static function ctrEliminar($id) {
            $respuesta = detalleVentasModel::mdlEliminar($id);
            return $respuesta;
        }
        static function ctrAumentar($id,$cantidad) {
            $respuesta = detalleVentasModel::mdlAumentar($id,$cantidad);
            return $respuesta;
        }
        static function ctrConsultar($venta) {
            $respuesta = detalleVentasModel::mdlConsultar($venta);
            return $respuesta;
        }
    }
    