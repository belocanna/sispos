<?php

    class comprasControlador{
        static function ctrlistarCompras($fechadesde, $fechahasta){
            $respuesta  = comprasModel::mdlListarCompras($fechadesde, $fechahasta);
            return $respuesta;
        }
        static function ctrCodigoCompra(){
            $respuesta = comprasModel::mdlCodigoCompra();
            return $respuesta;
        }
        static function  ctrRegistrar($datos,$numero, $proovedor, $total, $documento){
            $respuesta= comprasModel::mdlRegistrarCompra($datos, $numero, $proovedor, $total, $documento);
            return $respuesta;
        }
       
    }