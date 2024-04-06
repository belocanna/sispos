<?php
    require_once "../controladores/clientes.controlador.php";
    require_once "../modelos/clientes.model.php";
    class clientesAjax{
        public $id;
        public $tipoDocumento;
        public $numeroDocumento;
        public $nombres;
        public $direccion;
        public $telefono;
        public $ciudad;
        public $correo;
        public function actualizar()  {
            $respuesta = clientesControlador::ctrActualizar($this->id, $this->tipoDocumento, $this->numeroDocumento, $this->nombres,
            $this->direccion, $this->ciudad, $this->telefono, $this->correo);
            echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
        }
        public function listar() {
            $respuesta = clientesControlador::ctrListar();
            echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
        }
        public function guardar() {
            $respuesta = clientesControlador::ctrGuardar($this->numeroDocumento, $this->nombres,
            $this->direccion, $this->telefono, $this->ciudad, $this->correo);
            echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
        }
        public function validar() {
            $respuesta = clientesControlador::ctrValidar($this->numeroDocumento);
            echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
        }
        public function buscar() {
            $respuesta = clientesControlador::ctrBuscar($this->numeroDocumento);
            echo json_encode($respuesta);
        }
    }
    if (!isset($_POST['accion'])) {
        $respuesta = new clientesAjax();
        $respuesta->listar();
    }else{
        if (isset($_POST['accion']) && $_POST['accion'] == 1) {
            $respuesta = new clientesAjax();
            $respuesta->numeroDocumento = $_POST['documento'];
            $respuesta->nombres = $_POST['nombres'];
            $respuesta->direccion = $_POST['direccion'];
            $respuesta->telefono = $_POST['telefono'];
            $respuesta->ciudad = $_POST['ciudad'];
            $respuesta->correo = $_POST['correo'];
            $respuesta->guardar();      
        }
        if (isset($_POST['accion']) && $_POST['accion'] == 2) {
            $respuesta = new clientesAjax();
            $respuesta->id= $_POST['id'];
            $respuesta->numeroDocumento = $_POST['documento'];
            $respuesta->nombres = $_POST['nombres'];
            $respuesta->direccion = $_POST['direccion'];
            $respuesta->telefono = $_POST['telefono'];
            $respuesta->ciudad = $_POST['ciudad'];
            $respuesta->correo = $_POST['correo'];
            $respuesta->actualizar();      
        }
         if (isset($_POST['accion']) && $_POST['accion'] == 3) {
            $respuesta = new clientesAjax();
            $respuesta->numeroDocumento = $_POST['documento'];
            $respuesta->validar();
        }
        if (isset($_POST['accion']) && $_POST['accion'] == 4) {
            $respuesta = new clientesAjax();
            $respuesta->numeroDocumento = $_POST['documento'];
            $respuesta->buscar();
        }
    }