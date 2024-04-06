<?php
    class ventasControlador{
        // static function ctrListar(){
        //     $respuesta = ventasModel::mdlListar();
        //     return $respuesta;
        // }
        static function ctrListarVentas($fechadesde, $fechahasta) {
            $respuesta = ventasModel::mdlListarVentas($fechadesde, $fechahasta);
            return $respuesta;
        }
        static function ctrEliminar($factura) {
            $respuesta = ventasModel::mdlEliminar($factura);
            return $respuesta;
        }
        static function ctrCodigoVenta(){
            $respuesta = ventasModel::mdlCodigoVenta();
            return $respuesta;
        }
        static function  ctrRegistrar($datos, $numero, $cliente, $total, $pago, $comprobante){
            $respuesta= ventasModel::mdlRegistrarVenta($datos, $numero, $cliente, $total, $pago, $comprobante);
            return $respuesta;
        }
        static function ctrObtenerVenta($numero) {
            $respuesta = ventasModel::mdlObtenerVenta($numero);
            return $respuesta;
        }
        static function ctrTotalVentas()  {
            $respuesta = ventasModel::mdlTotalVentas();
            return $respuesta;
        }
        static function ctrObtenerDetalleVenta($numero) {
            $respuesta = ventasModel::mdlObtenerDetalleVenta($numero);
            return $respuesta;
        }
    }