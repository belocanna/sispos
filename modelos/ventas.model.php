<?php

if (!isset($_SESSION)) {
    session_start();
}
require_once "conexion.php";
class ventasModel
{
    // static public function mdlListar()
    // {
    //     try {
    //         $apertura = $_SESSION['idApertura'];
    //         $stmt = Conexion::connect()->prepare("SELECT
    //         ventas.venta_id,
    //         ventas.venta_numero,
    //         ventas.venta_fecha,
    //         ventas.venta_cliente,
    //         ventas.venta_total,
    //         ventas.venta_usuario,
    //         usuarios.usuario_nombres,
    //         ventas.venta_formaPago,
    //         formaspago.pago_nombre,
    //         ventas.venta_comprobante,
    //         clientes.cliente_nombres
    //         FROM
    //         ventas
    //         INNER JOIN clientes ON ventas.venta_cliente = clientes.cliente_numero_documento
    //         INNER JOIN usuarios ON ventas.venta_usuario = usuarios.usuario_id
    //         INNER JOIN formaspago ON ventas.venta_formaPago = formaspago.pago_id
    //         where
    //         ventas.venta_apertura = ?
    //         ");
    //         $stmt->bindParam(1, $apertura);
    //         $stmt->execute();
    //         return $stmt->fetchAll();
    //         $stmt = null;
    //     } catch (Exception $e) {
    //         return "Excepcion Controlada" . $e->getMessage();
    //     }
    // }
    static public function mdlListarVentas($fechaInicial, $fechaFinal)
    {
        try {
            $stmt = Conexion::connect()->prepare("SELECT
        ventas.venta_id,
        ventas.venta_numero,
        ventas.venta_fecha,
        ventas.venta_cliente,
        ventas.venta_total,
        ventas.venta_usuario,
        usuarios.usuario_nombres,
        ventas.venta_formaPago,
        formaspago.pago_nombre,
        ventas.venta_comprobante,
        clientes.cliente_nombres
        FROM
        ventas
        INNER JOIN clientes ON ventas.venta_cliente = clientes.cliente_id
        INNER JOIN usuarios ON ventas.venta_usuario = usuarios.usuario_id
        INNER JOIN formaspago ON ventas.venta_formaPago = formaspago.pago_id
        where venta_fecha between ? and ?");
            $stmt->bindParam(1, $fechaInicial);
            $stmt->bindParam(2, $fechaFinal);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            return "Excepcion Controlada" . $e->getMessage();
        }
    }
    static public function mdlEliminar($factura)
    {
    }
    static public function mdlCodigoVenta()
    {
        try {
            $stmt = Conexion::connect()->prepare("SELECT count(*) as numero from ventas");
            $stmt->execute();
            return $stmt->fetch();
        } catch (Exception $e) {
            return "Excepcion Controlada" . $e->getMessage();
        }
    }
    static public function mdlRegistrarVenta($datos, $numero, $cliente, $total, $pago, $comprobante)
    {
            date_default_timezone_set('America/Bogota');
            $fecha = date("Y-m-d");
            $usuario = $_SESSION['idUsuario'];
            $apertura = $_SESSION['idApertura'];
            $stmt = Conexion::connect()->prepare("INSERT INTO ventas (venta_numero, venta_fecha,venta_cliente,venta_total,venta_usuario, venta_formapago, venta_comprobante, venta_apertura) values (?,?,?,?,?,?,?,?)");
            $stmt->bindParam(1, $numero);
            $stmt->bindParam(2, $fecha);
            $stmt->bindParam(3, $cliente);
            $stmt->bindParam(4, $total);
            $stmt->bindParam(5, $usuario);
            $stmt->bindParam(6, $pago);
            $stmt->bindParam(7, $comprobante);
            $stmt->bindParam(8, $apertura);
            if ($stmt->execute()) {
                $listaProductos = [];
                for ($i = 0; $i < count($datos); ++$i) {
                    $listaProductos = explode(",", $datos[$i]);
                    $stmt = Conexion::connect()->prepare("INSERT INTO detalle_venta (venta_detalle, producto_detalle, cantidad_detalle, precio_detalle) values (?,?,?,?)");
                    $stmt->bindParam(1, $numero);
                    $stmt->bindParam(2, $listaProductos[0]);
                    $stmt->bindParam(3, $listaProductos[1]);
                    $stmt->bindParam(4, $listaProductos[2]);
                    if ($stmt->execute()) {
                        $stmt = null;
                        $stmt = Conexion::connect()->prepare("UPDATE productos set producto_stock_total = producto_stock_total - ? where producto_codigo = ?");
                        $stmt->bindParam(1, $listaProductos[1]);
                        $stmt->bindParam(2, $listaProductos[0]);
                        if ($stmt->execute()) {
                            $resultado = "Se registro la venta Correctamente";
                        } else {
                            $resultado = "Error al actualizar el Stock";
                        }
                    }else{
                        $resultado = "Error al registrar la venta";
                    }    
                }
                    return $resultado;
                    $stmt = null;
            }
    }
    static public function mdlDetalleVenta($numero)
    {
        try {
            $stmt = Conexion::connect()->prepare("SELECT
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
            $stmt->bindParam(1, $numero);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            return "Excepcion Controalda" . $e->getMessage();
        }
    }
    static public function  mdlTotalVentas()
    {
        try {
            $apertura = $_SESSION['idApertura'];
            $stmt = Conexion::connect()->prepare("SELECT ifnull(sum(venta_total),0) as totalVentas from ventas where venta_apertura = ?");
            $stmt->bindParam(1, $apertura);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            return "Excepcion Controlada" . $e->getMessage();
        }
    }
    static public function mdlImpresionObtenerVentaId($id_venta)
    {
        try {
            $stmt = Conexion::connect()->prepare("SELECT
        ventas.venta_fecha,
        ventas.venta_numero,
        ventas.venta_cliente,
        clientes.cliente_numero_documento,
        ventas.venta_total,
        ventas.venta_usuario,
        ventas.venta_formaPago,
        formaspago.pago_nombre,
        ventas.venta_comprobante
        FROM
        ventas
        INNER JOIN clientes ON ventas.venta_cliente = clientes.cliente_numero_documento
        INNER JOIN formaspago ON ventas.venta_formaPago = formaspago.pago_id
        WHERE
        ventas.venta_id = ?
        ");
            $stmt->bindParam(1, $id_venta);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            return "Excepcion Controlada" . $e->getMessage();
        }
    }
    static public function mdlObtenerDetalleVenta($id_venta)
    {
        try {
            $stmt = Conexion::connect()->prepare("SELECT
            detalle_venta.venta_detalle,
            detalle_venta.producto_detalle,
            productos.producto_nombre,
            detalle_venta.cantidad_detalle,
            detalle_venta.precio_detalle
            FROM
            detalle_venta
            INNER JOIN productos ON detalle_venta.producto_detalle = productos.producto_codigo
            WHERE
            detalle_venta.venta_detalle = ?
            ");
            $stmt->bindParam(1, $id_venta);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            return "Excepcion Controlada" . $e->getMessage() . "\n";
        }
    }
    static public function mdlObtenerVenta($venta)
    {
        $stmt = Conexion::connect()->prepare("SELECT
        ventas.venta_id,
        ventas.venta_fecha,
        clientes.cliente_numero_documento,
        clientes.cliente_nombres,
        ventas.venta_total,
        ventas.venta_usuario,
        formaspago.pago_nombre,
        usuarios.usuario_nombres
        FROM
        ventas
        INNER JOIN clientes ON ventas.venta_cliente = clientes.cliente_id
        INNER JOIN formaspago ON ventas.venta_formaPago = formaspago.pago_id
        INNER JOIN usuarios ON ventas.venta_usuario = usuarios.usuario_id
        WHERE
        ventas.venta_id = ?");
        $stmt->bindParam(1, $venta);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
