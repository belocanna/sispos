<?php

    class proovedoresControlador{
        static function ctrlistar(){
            $respuesta  = proovedoresModel::mdlListar();
            return $respuesta;
        }
        static function ctrGuardar($numeroDocumento, $nombres, $direccion, $telefono, $ciudad, $correo) {
            $respuesta = proovedoresModel::mdlGuardar($numeroDocumento, $nombres, $direccion, $telefono, $ciudad, $correo);
            return $respuesta;
        }
        static function ctrValidar($numeroDocumento) {
            $respuesta = proovedoresModel::mdlValidarDocumento($numeroDocumento);
            return $respuesta;
        }
        static function ctrActualizar($id, $numeroDocumento, $nombres, $direccion, $telefono, $ciudad, $correo) {
            $respuesta = proovedoresModel::mdlActualizar($id, $numeroDocumento, $nombres, $direccion, $telefono, $ciudad, $correo);
            return $respuesta;
        }
        static function ctrBuscar($documento)  {
            $respuesta = proovedoresModel::mdlBuscar($documento);
            return $respuesta;
        }
    }