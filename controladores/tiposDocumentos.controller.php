<?php

    class tiposDocumentosController{
        static function ctrListar() {
            $respuesta = tiposDocumentosModel::mdlListar();
            return $respuesta;
        }
    }