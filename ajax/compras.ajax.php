<?php
    require_once "../controladores/compras.controlador.php";
    require_once "../modelos/compras.model.php";
    class comprasAjax{
        public $id;
        public $fecha;
        public $proovedor;
        public $valor;
        public $formaPago;
        public function listarCompras($fechaDesde, $fechaHasta) {
            $respuesta = comprasControlador::ctrlistarCompras($fechaDesde, $fechaHasta);
            echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
        }
        public function codigoCompra() {
            $respuesta = comprasControlador::ctrCodigoCompra();
            echo json_encode($respuesta);
        }
        public function registrar($datos,$numero, $proovedor, $total, $documento) {
            $respuesta = comprasControlador::ctrRegistrar($datos, $numero, $proovedor, $total, $documento);
            echo json_encode($respuesta);
        }
    }
        if (isset($_POST['accion']) && $_POST['accion'] == 1) {
            $respuesta = new comprasAjax();
            $respuesta->codigoCompra();      
        }else{
            if (isset($_POST["arr"])) {
                $respuesta = new comprasAjax();
                $respuesta->registrar($_POST['arr'], $_POST['numero'], $_POST['proovedor'], $_POST['total'], $_POST['documento']);
            }
        }
        if (isset($_POST['accion']) && $_POST['accion'] == 2) {
            $respuesta = new comprasAjax();
            $respuesta->listarCompras($_POST['fechaDesde'], $_POST['fechaHasta']);      
        }
    