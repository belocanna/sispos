<?php
    require_once "../controladores/proovedores.controlador.php";
    require_once "../modelos/proovedores.model.php";
    class proovedoresAjax{
        public $id;
        public $tipoDocumento;
        public $numeroDocumento;
        public $nombres;
        public $direccion;
        public $telefono;
        public $ciudad;
        public $correo;
        public function listar() {
            $respuesta = proovedoresControlador::ctrListar();
            echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
        }
        public function guardar() {
            $respuesta = proovedoresControlador::ctrGuardar($this->numeroDocumento, $this->nombres,
            $this->direccion, $this->telefono, $this->ciudad, $this->correo);
            echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
        }
        public function actualizar() {
            $respuesta = proovedoresControlador::ctrActualizar($this->id,  $this->numeroDocumento, $this->nombres,
            $this->direccion, $this->telefono, $this->ciudad, $this->correo);
            echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
        }
        public function validar() {
            $respuesta = proovedoresControlador::ctrValidar($this->numeroDocumento);
            echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
        }
        public function buscar() {
            $respuesta = proovedoresControlador::ctrBuscar($this->numeroDocumento);
            echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
        }
    }
    if (!isset($_POST['accion'])) {
        $respuesta = new proovedoresAjax();
        $respuesta->listar();
    }else{
        if (isset($_POST['accion']) && $_POST['accion'] == 1) {
            $respuesta = new proovedoresAjax();
            $respuesta->numeroDocumento = $_POST['documento'];
            $respuesta->nombres = $_POST['nombres'];
            $respuesta->direccion = $_POST['direccion'];
            $respuesta->telefono = $_POST['telefono'];
            $respuesta->ciudad = $_POST['ciudad'];
            $respuesta->correo = $_POST['correo'];
            $respuesta->guardar();      
        }
        if (isset($_POST['accion']) && $_POST['accion'] == 2) {
            $respuesta = new proovedoresAjax();
            $respuesta->id = $_POST['id'];
            $respuesta->numeroDocumento = $_POST['documento'];
            $respuesta->nombres = $_POST['nombres'];
            $respuesta->direccion = $_POST['direccion'];
            $respuesta->telefono = $_POST['telefono'];
            $respuesta->ciudad = $_POST['ciudad'];
            $respuesta->correo = $_POST['correo'];
            $respuesta->actualizar();      
        }
        if (isset($_POST['accion']) && $_POST['accion'] == 3) {
            $respuesta = new proovedoresAjax();
            $respuesta->numeroDocumento = $_POST['documento'];
            $respuesta->validar();
        }
        if (isset($_POST['accion']) && $_POST['accion'] == 4) {
            $respuesta = new proovedoresAjax();
            $respuesta->numeroDocumento = $_POST['documento'];
            $respuesta->buscar();
        }
    }