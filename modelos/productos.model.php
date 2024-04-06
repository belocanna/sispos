<?php
require_once "conexion.php";
class productosModel
{
    static public function mdlListar()
    {
        $stmt = Conexion::connect()->prepare("SELECT
            productos.producto_id,
            productos.producto_codigo,
            productos.producto_nombre,
            productos.producto_stock_total,
            productos.producto_precio_compra,
            productos.producto_precio_venta,
            productos.producto_minimo,
            productos.producto_categoria,
            categorias.categoria_nombre,
            productos.producto_inventario
            FROM
            productos
            INNER JOIN categorias ON productos.producto_categoria = categorias.categoria_id");
        $stmt->execute();
        return $stmt->fetchAll();
        $stmt = null;
    }
    static public function mdlGuardar($codigo, $descripcion, $stock, $costo, $venta, $minimo, $categoria, $inventario)
    {
        $stmt = Conexion::connect()->prepare("INSERT INTO productos (producto_codigo, producto_nombre, producto_stock_total, producto_precio_compra, producto_precio_venta, producto_minimo,  producto_categoria, producto_inventario) values (?,?,?,?,?,?,?,?)");
        $stmt->bindParam(1, $codigo);
        $stmt->bindParam(2, $descripcion);
        $stmt->bindParam(3, $stock);
        $stmt->bindParam(4, $costo);
        $stmt->bindParam(5, $venta);
        $stmt->bindParam(6, $minimo);
        $stmt->bindParam(7, $categoria);
        $stmt->bindParam(8, $inventario);
        if ($stmt->execute()) {
            $result = "Producto Registrado";
        } else {
            $result = "Error al Agregar";
        }
        return $result;
    }
    static public function mdlValidarCodigo($codigo)
    {
        $stmt = Conexion::connect()->prepare("SELECT count(*) FROM productos where producto_codigo = ?");
        $stmt->bindParam(1, $codigo);
        $stmt->execute();
        return $stmt->fetch();
    }
    static public function mdlActualizar($id, $codigo, $descripcion,  $stock, $costo, $venta, $minimo, $categoria, $inventario)
    {
        $stmt = Conexion::connect()->prepare("UPDATE productos  set producto_codigo = ?, producto_nombre = ?, producto_stock_total = ?,  producto_precio_compra = ?, producto_precio_venta = ?, producto_minimo = ?, producto_categoria = ? , producto_inventario = ? where producto_id = ?");
        $stmt->bindParam(1, $codigo);
        $stmt->bindParam(2, $descripcion);
        $stmt->bindParam(3, $stock);
        $stmt->bindParam(4, $costo);
        $stmt->bindParam(5, $venta);
        $stmt->bindParam(6, $minimo);
        $stmt->bindParam(7, $categoria);
        $stmt->bindParam(8, $inventario);
        $stmt->bindParam(9, $id);
        if ($stmt->execute()) {
            $result = "Producto Actualizado";
        } else {
            $result = "Error al Agregar";
        }
        return $result;
    }
    static public function mdlBuscarProducto($codigo)
    {
        try {
            $stmt = Conexion::connect()->prepare("SELECT producto_codigo, producto_nombre, 1 as cantidad, producto_precio_venta,  ROUND(1 * producto_precio_venta,2) as total FROM productos where producto_codigo = ?");
            $stmt->bindParam(1, $codigo, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            echo "Excepcion Controlada ". $e->getMessage();
        }
        
    }
    static public function mdlBuscarProductoCompra($codigo)
    {
        $stmt = Conexion::connect()->prepare("SELECT producto_codigo, producto_nombre, 1 as cantidad, producto_precio_compra ,(1 * producto_precio_compra) as total FROM productos where producto_codigo = ?");
        $stmt->bindParam(1, $codigo);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
    static public function mdlTotalProductosCategoria($categoria)
    {
        $stmt = Conexion::connect()->prepare("SELECT count(*) from productos where producto_categoria = ?");
        $stmt->bindParam(1, $categoria);
        $stmt->execute();
        return $stmt->fetch();
    }
    static public function mdlMinimo()
    {
        $stmt = Conexion::connect()->prepare("SELECT
            productos.producto_id,
            productos.producto_codigo,
            productos.producto_nombre,
            productos.producto_stock_total,
            productos.producto_tipo_unidad,
            productos.producto_precio_compra,
            productos.producto_precio_venta,
            productos.producto_minimo,
            productos.producto_categoria,
            categorias.categoria_nombre
            FROM
            productos
            INNER JOIN categorias ON productos.producto_categoria = categorias.categoria_id
            where
            productos.producto_stock_total <= productos.producto_minimo");
        $stmt->execute();
        return $stmt->fetchAll();
    }
    static public function mdlListarNombresProductos()
    {
        try {
            $stmt = Conexion::connect()->prepare("SELECT concat(producto_codigo,',',producto_nombre) as descripcion_producto from productos");
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Excepcion Controlada" . $e->getMessage();
        }
       
    }
    static public function mdlVerificarStock($codigo, $cantidad)
    {
        $stmt = Conexion::connect()->prepare("SELECT count(*) as existe from productos p where p.producto_codigo = ? and p.producto_stock_total > ?");
        $stmt->bindParam(1, $codigo);
        $stmt->bindParam(2, $cantidad);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
    static public function mdlListarPorVenta($numero)
    {
        $stmt = Conexion::connect()->prepare("SELECT
            detalle_venta.id_detalle,
            detalle_venta.venta_detalle,
            detalle_venta.cantidad_detalle,
            detalle_venta.precio_detalle,
            productos.producto_nombre
            FROM
            detalle_venta
            INNER JOIN productos ON detalle_venta.producto_detalle = productos.producto_codigo
            WHERE
            detalle_venta.venta_detalle = ?");
        $stmt->bindParam(1, $numero);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    static public function mdlAumentarStock($id, $cantidad)
    {
        try {
            $stmt = Conexion::connect()->prepare("UPDATE productos set producto_stock_total = producto_stock_total + ? where producto_id = ?");
            $stmt->bindParam(1, $cantidad);
            $stmt->bindParam(2, $id);
            if ($stmt->execute()) {
                $result = "Ajuste de Inventario Realizado";
            } else {
                $result = "No ajustado";
            }
            return $result;
        } catch (Exception $e) {
            return "Excepcion Controlada " . $e->getMessage();
        }
    }
    static public function mdlDisminuirStock($id, $cantidad)
    {
        try {
            $stmt = Conexion::connect()->prepare("UPDATE productos set producto_stock_total = producto_stock_total - ? where producto_id = ?");
            $stmt->bindParam(1, $cantidad);
            $stmt->bindParam(2, $id);
            if ($stmt->execute()) {
                $result = "Ajuste de Inventario Realizado";
            } else {
                $result = "No ajustado";
            }
            return $result;
        } catch (Exception $e) {
            return "Excepcion Controlada " . $e->getMessage();
        }
    }
}
