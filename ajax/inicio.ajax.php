<?php
require_once "../controladores/inicio.controlador.php";
require_once "../modelos/inicio.model.php";

    class inicioAjax{
        public function getDatos(){
            $datos = inicioControlador::ctrGetDatos();
            echo json_encode($datos);
        }
        public function getMinimo(){
            $datos = inicioControlador::ctrGetMinimo();
            echo json_encode($datos);
        }
        public function getVentas(){
            $datos = inicioControlador::ctrGetVentas();
            echo json_encode($datos);
        }
        public function getPagosEfectivo(){
            $datos = inicioControlador::ctrGetPagosEfectivo();
            echo json_encode($datos);
        }
        public function getPagosTransferencias(){
            $datos = inicioControlador::ctrGetPagosBanco();
            echo json_encode($datos);
        }
    }
    if (!isset($_POST['accion'])) {
        $datos = new inicioAjax();
        $datos->getDatos();
       
    }else{
        if (isset($_POST['accion']) && $_POST['accion']== 1) {
            $datos = new inicioAjax();
            $datos->getMinimo();
        }
        if (isset($_POST['accion']) && $_POST['accion']== 2) {
            $datos = new inicioAjax();
            $datos->getVentas();
        }
        if (isset($_POST['accion']) && $_POST['accion']== 3) {
            $datos = new inicioAjax();
            $datos->getPagosEfectivo();
        }
        if (isset($_POST['accion']) && $_POST['accion']== 4) {
            $datos = new inicioAjax();
            $datos->getPagosTransferencias();
        }
    }
    