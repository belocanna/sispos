<?php
if (!isset($_SESSION)) {
    session_start();
}
require_once "conexion.php";
class inicioModel
{
    // static public function mdlGetDatos() {
    //     $stmt = Conexion::connect()->prepare('call pcr_datos()');
    //     $stmt->execute();
    //     return $stmt->fetchAll();
    // }
    static public function mdlGetDatos()
    {
        $stmt = Conexion::connect()->prepare('SELECT count(*) as totalProductos, sum(producto_stock_total * producto_precio_compra) as totalCompras, sum(productos.producto_stock_total * productos.producto_precio_venta) as totalVentas
            from productos');
        $stmt->execute();
        return $stmt->fetchAll();
    }
    static public function mdlGetMinimo()
    {
        $stmt = Conexion::connect()->prepare('SELECT count(*) as totalMinimo from productos where producto_stock_total <= producto_minimo');
        $stmt->execute();
        return $stmt->fetchAll();
    }
    static public function mdlGetVentas()
    {
        date_default_timezone_set('America/Bogota');
        $fecha = date("Y-m-d");
        $apertura = $_SESSION['idApertura'];
        $stmt = Conexion::connect()->prepare('SELECT IFNULL(Sum(venta_total),0) as totalVentasDia FROM ventas where venta_fecha = ? and venta_apertura = ?');
        $stmt->bindParam(1, $fecha);
        $stmt->bindParam(2, $apertura);
        $stmt->execute(); 
        return $stmt->fetchAll();
        
    }
    static public function mdlGetEfectivo()
    {
        date_default_timezone_set('America/Bogota');
        $fecha = date("Y-m-d");
        $apertura = $_SESSION['IdApertura'];
        $stmt = Conexion::connect()->prepare('SELECT IFNULL(Sum(venta_total),0) as totalEfectivo FROM ventas where venta_fecha = ? and venta_formapago = 1 and venta_apertura = ?');
        $stmt->bindParam(1, $fecha);
        $stmt->bindParam(2, $apertura);
        $stmt->execute(); 
        return $stmt->fetchAll();
        
    }

    static public function mdlGetBanco()
    {
        date_default_timezone_set('America/Bogota');
        $fecha = date("Y-m-d");
        $apertura = $_SESSION['IdApertura'];
        $stmt = Conexion::connect()->prepare('SELECT IFNULL(Sum(venta_total),0) as totalBanco FROM ventas where venta_fecha = ? and venta_formapago = 2 and venta_apertura = ?');
        $stmt->bindParam(1, $fecha);
        $stmt->bindParam(2, $apertura);
        $stmt->execute(); 
        return $stmt->fetchAll();
        
    }
}
