<?php
if (!isset($_SESSION)) {
    session_start();
}
require_once "conexion.php";
class detalleVentasModel
{
    static public function mdlGuardar($codigo, $precio)
    {
        $usuario = $_SESSION['idUsuario'];
        $stmt = Conexion::connect()->prepare("INSERT INTO detalle_ventas_temp(producto_detalle, precio_detalle, total_detalle, usuario_detalle) values (?,?,?,?)");
        $stmt->bindParam(1, $codigo);
        $stmt->bindParam(2, $precio);
        $stmt->bindParam(3, $precio);
        $stmt->bindParam(4, $usuario);
        $stmt->execute();
    }
    static public function mdlListar()
    {
        $usuario = $_SESSION['idUsuario'];
        $stmt = Conexion::connect()->prepare("SELECT
        detalle_ventas_temp.id_detalle,
        detalle_ventas_temp.producto_detalle,
        productos.producto_nombre,
        detalle_ventas_temp.cantidad_detalle,
        detalle_ventas_temp.precio_detalle,
        detalle_ventas_temp.total_detalle,
        detalle_ventas_temp.usuario_detalle
        FROM
        detalle_ventas_temp
        INNER JOIN productos ON detalle_ventas_temp.producto_detalle = productos.producto_codigo
        WHERE
        detalle_ventas_temp.usuario_detalle = ?");
        $stmt->bindParam(1, $usuario);
        $stmt->execute();
        return $stmt->fetchAll();
        $stmt = null;
    }
    static public function mdlVaciar()  {
        $usuario = $_SESSION['idUsuario'];
        $stmt = Conexion::connect()->prepare("DELETE  FROM detalle_ventas_temp where usuario_detalle = ?");
        $stmt->bindParam(1, $usuario);
        $stmt->execute();
    }
    static public function mdlEliminar($id)  {
        $usuario = $_SESSION['idUsuario'];
        $stmt = Conexion::connect()->prepare("DELETE  FROM detalle_ventas_temp where id_detalle = ? and usuario_detalle = ?");
        $stmt->bindParam(1, $id);
        $stmt->bindParam(2, $usuario);
        $stmt->execute();
    }
    static public function mdlAumentar($id, $cantidad) {
        $usuario = $_SESSION['idUsuario'];
        $stmt = Conexion::connect()->prepare("UPDATE detalle_ventas_temp set cantidad_detalle = ? where id_detalle = ? and usuario_detalle = ?");
        $stmt->bindParam(1, $cantidad);
        $stmt->bindParam(2,$id);
        $stmt->bindParam(3,$usuario);
        $stmt->execute();
    }
    static public function mdlConsultar($venta) {
        $stmt = Conexion::connect()->prepare("SELECT
        detalle_venta.id_detalle,
        detalle_venta.venta_detalle,
        detalle_venta.producto_detalle,
        productos.producto_nombre,
        detalle_venta.cantidad_detalle,
        detalle_venta.precio_detalle
        FROM
        detalle_venta
        INNER JOIN productos ON detalle_venta.producto_detalle = productos.producto_codigo
        WHERE
        detalle_venta.venta_detalle = ?");
        $stmt->bindParam(1, $venta);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
