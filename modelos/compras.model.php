<?php
    if (!isset($_SESSION)) {
        session_start();
    }
    require_once "conexion.php";
    class comprasModel{
        static public function mdlListarCompras($fechaInicial, $fechaFinal)
        {
            $stmt = Conexion::connect()->prepare("SELECT
            compras.compra_id,
            compras.compra_fecha,
            compras.compra_numero,
            compras.compra_proovedor,
            proovedores.proovedor_nombres,
            compras.compra_total
            FROM
            compras
          INNER JOIN proovedores ON compras.compra_proovedor = proovedores.proovedor_numero_documento
          where compra_fecha between ? and ?");
            $stmt->bindParam(1, $fechaInicial);
            $stmt->bindParam(2, $fechaFinal);
            $stmt->execute();
            return $stmt->fetchAll();
            $stmt = null;
        }
        static public function mdlCodigoCompra() {
            $stmt = Conexion::connect()->prepare("SELECT count(*) as numero from compras");
            $stmt->execute();
            return $stmt->fetch();        
        }
        static public function mdlRegistrarCompra($datos, $numero, $proovedor, $total, $documento) {
            date_default_timezone_set('America/Bogota');
            $fecha = date("Y-m-d");
            $usuario = $_SESSION['idUsuario'];
            $stmt = Conexion::connect()->prepare("INSERT INTO compras (compra_numero, compra_fecha, compra_proovedor, compra_total, compra_documento, compra_usuario) values (?,?,?,?,?,?)");
            $stmt->bindParam(1, $numero);
            $stmt->bindParam(2, $fecha);
            $stmt->bindParam(3, $proovedor);
            $stmt->bindParam(4, $total);
            $stmt->bindParam(5, $documento);
            $stmt->bindParam(6, $usuario);;
            $stmt->execute();
            $listaProductos = [];
            for ($i=0; $i <  count($datos); $i++) { 
                $listaProductos = explode(".", $datos[$i]);
                $stmt =Conexion::connect()->prepare("INSERT INTO detalle_compra (compra_detalle, producto_detalle, cantidad_detalle, precio_detalle) values (?,?,?,?)");
                $stmt->bindParam(1, $numero);
                $stmt->bindParam(2, $listaProductos[0]);
                $stmt->bindParam(3, $listaProductos[1]);
                $stmt->bindParam(4, $listaProductos[2]);
                if ($stmt->execute()) {
                    $stmt= null;
                    $stmt =Conexion::connect()->prepare("UPDATE productos set producto_stock_total = producto_stock_total + ? where producto_codigo = ?");
                    $stmt->bindParam(1, $listaProductos[1]);
                    $stmt->bindParam(2, $listaProductos[0]);
                    $stmt->execute();
                }   
              
            }   
            $resultado = "Se registro la Compra Correctamente";# code...
            return $resultado;
          
        }
        // static public function mdlObtenerFiltro($fechaInicial, $fechaFinal){
        //     $stmt = Conexion::connect()->prepare("SELECT
        //     compras.compra_id,
        //     compras.compra_fecha,
        //     compras.compra_numero,
        //     compras.compra_proovedor,
        //     proovedores.proovedor_nombres,
        //     compras.compra_total
        //     FROM
        //     compras
        //     where
        //     (compra_fecha BETWEEN ? and ?)
        //     INNER JOIN proovedores ON compras.compra_proovedor = proovedores.proovedor_numero_documento 
        //     ");
        //     $stmt->bindParam(1, $fechaInicial);
        //     $stmt->bindParam(2, $fechaFinal);
        //     $stmt->execute();
        //     return $stmt->fetchAll();
        //     $stmt = null;
        // }
    }