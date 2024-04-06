<?php
    require_once "../controladores/apertura.controlador.php";
    require_once "../modelos/apertura.model.php";
    class aperturaAjax{
        public $caja;
        public $monto;
        public $ventas;
        public $usuario;
        public function listar()  {
            $respuesta = aperturaControlador::ctrListar();
            echo json_encode($respuesta);
        }
        public function guardar() {
            $respuesta = aperturaControlador::ctrGuardar($this->caja, $this->monto);
            echo json_encode($respuesta);
        }
        public function validar() {
            $respuesta = aperturaControlador::ctrValidar($this->usuario);
            echo json_encode($respuesta);
        }
        public function buscar() {
            $respuesta = aperturaControlador::ctrBuscar($this->usuario);
            echo json_encode($respuesta);
        }
        public function actualizar() {
            $respuesta = aperturaControlador::ctrActualizar($this->monto, $this->ventas);
            echo json_encode($respuesta);
        }
    }

    if(!isset($_POST['accion'])){
        $respuesta = new aperturaAjax();
        $respuesta->listar();
    }else{
        if (isset($_POST['accion']) && $_POST['accion'] == 1) {
            $respuesta = new aperturaAjax();
            $respuesta->caja = $_POST['caja'];
            $respuesta->monto = $_POST['monto'];
            $respuesta->guardar();
        }
        if(isset($_POST['accion']) && $_POST['accion'] == 2){
            $respuesta =new aperturaAjax();
            $respuesta->$_POST['usuario'];
            $respuesta->validar();
        }
        if (isset($_POST['accion']) && $_POST['accion'] == 3) {
            $respuesta = new aperturaAjax();
            $respuesta->$_POST['usuario'];
            $respuesta->buscar();
        }
        if (isset($_POST['accion']) && $_POST['accion'] == 4) {
            $respuesta = new aperturaAjax();
            $respuesta->monto = $_POST['monto'];
            $respuesta->ventas = $_POST['ventas'];
            $respuesta->actualizar();
        }
    }   