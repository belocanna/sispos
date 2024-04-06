<?php
    class formaspagoControlador{
        static function ctrListar()  {
            $respuesta = formaspagoModel::mdlListar();
            return $respuesta;
        }
    }