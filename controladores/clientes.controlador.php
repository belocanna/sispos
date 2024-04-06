<?php

    class clientesControlador{   
        static function ctrlistar(){
            $respuesta  = clientesModel::mdlListar();
            return $respuesta;
        }
        static function ctrGuardar($numeroDocumento, $nombres, $direccion, $telefono, $ciudad, $correo) {
            $respuesta = clientesModel::mdlGuardar($numeroDocumento, $nombres, $direccion, $telefono, $ciudad, $correo);
            return $respuesta;            
        }
        static function ctrValidar($numeroDocumento) {
            $respuesta = clientesModel::mdlValidarDocumento($numeroDocumento);
            return $respuesta;
        }
        static function ctrActualizar($id, $numeroDocumento, $nombres, $direccion, $ciudad, $telefono, $correo) {
            $respuesta = clientesModel::mdlActualizar($id, $numeroDocumento, $nombres, $direccion, $ciudad, $telefono, $correo);
            return $respuesta;            
        }
        static function ctrBuscar($documento)  {
            $respuesta = clientesModel::mdlBuscar($documento);
            return $respuesta;
        }
    }