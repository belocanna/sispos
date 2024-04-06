<?php
    class productosControlador{
        static function ctrListar() {
            $respuesta = productosModel::mdlListar();
            return $respuesta;
        }
        static function ctrGuardar($codigo, $descripcion, $medida, $stock, $costo, $venta, $minimo, $categoria) {
            $respuesta = productosModel::mdlGuardar($codigo, $descripcion, $medida, $stock, $costo, $venta, $minimo, $categoria);
            return $respuesta;
        }
        static function ctrValidarCodigo($codigo) {
            $respuesta = productosModel::mdlValidarCodigo($codigo);
            return $respuesta;
        }
        static function ctrActualizar($id, $codigo, $descripcion, $medida, $stock, $costo, $venta,$minimo, $categoria) {
            $respuesta = productosModel::mdlActualizar($id, $codigo, $descripcion, $medida, $stock, $costo, $venta, $minimo,  $categoria);
            return $respuesta;
        }
        static function ctrBuscarProducto($codigo) {
            $respuesta = productosModel::mdlBuscarProducto($codigo);
            return $respuesta;
        }
        static function ctrBuscarProductoCompra($codigo) {
            $respuesta = productosModel::mdlBuscarProductoCompra($codigo);
            return $respuesta;
        }
        static function ctrCodigo($categoria) {
            $respuesta =productosModel::mdlTotalProductosCategoria($categoria);
            return $respuesta;
        }
        static public function ctrMinimo() {
            $respuesta = productosModel::mdlMinimo();
            return $respuesta;
        }
        static public function ctrListarNombresProductos() {
            $respuesta = productosModel::mdlListarNombresProductos();
            return $respuesta;
        }
        static public function ctrVerificarStock($codigo, $cantidad) {
            $respuesta = productosModel::mdlVerificarStock($codigo, $cantidad);
            return $respuesta;
        }
        static function ctrListarPorVenta($numero)  {
            $respuesta =productosModel::mdlListarPorVenta($numero);
            return $respuesta;
        }
        static function ctrAumentarStock($id, $cantidad) {
            $respuesta = productosModel::mdlAumentarStock($id, $cantidad);
            return $respuesta;
        }
        static function ctrDisminuirStock($id, $cantidad) {
            $respuesta = productosModel::mdlDisminuirStock($id, $cantidad);
            return $respuesta;
        }

    }