<?php

    class empresaControlador{
        static function ctrCargar() {
            $respuesta = empresaModel::mdlCargar();
            return $respuesta;
        }
        static function ctrActualizar($documento,$nombre, $direccion, $telefono, $correo, $ciudad,
        $responsable, $id) {
            $respuesta = empresaModel::mdlActualizar($documento,$nombre, $direccion, $telefono, $correo, $ciudad,
            $responsable, $id);
            return $respuesta;
        }
        static function ctrDatosEmpresa() {
            $respuesta = empresaModel::mdlDatosEmpresa();
            return $respuesta;
        }
    }