<?php
    class aperturaControlador{
        static function ctrListar()  {
            $respuesta =aperturaModel::mdlListar();
            return $respuesta;
        }
        static function ctrGuardar($caja, $monto) {
            $respuesta = aperturaModel::mdlGuardar($caja, $monto);
            return $respuesta;
        }
        static function ctrValidar($usuario) {
            $respuesta =aperturaModel::mdlValidar($usuario);
            return $respuesta;
        }
        static function ctrBuscar($usuario) {
            $respuesta = aperturaModel::mdlBuscar($usuario);
            return $respuesta;
        }
        static function ctrActualizar($monto, $ventas) {
            $respuesta = aperturaModel::mdlActualizar($monto, $ventas);
            return $respuesta;
        }
    }