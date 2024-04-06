<?php
    require_once "../controladores/empresa.controlador.php";
    require_once "../modelos/empresa.model.php";
    class empresaAjax{
        public $id;
        public $documento;
        public $nombre;
        public $direccion;
        public $telefono;
        public $correo;
        public $ciudad;
        public  $responsable;
        public function cargar() {
            $respuesta = empresaControlador::ctrCargar();
            echo json_encode($respuesta);
        }
        public function actualizar() {
            $respuesta =empresaControlador::ctrActualizar($this->documento,
            $this->nombre, $this->direccion, $this->telefono, $this->correo, $this->ciudad,
        $this->responsable, $this->id);
            echo json_encode($respuesta);
        }
    }
    if (!isset($_POST['accion'])) {
        $respuesta = new empresaAjax();
        $respuesta->cargar();
    }else{
        if (isset($_POST['accion']) && $_POST['accion'] == 1) {
            $respuesta = new empresaAjax();
            $respuesta->id = $_POST['id'];
            $respuesta->documento = $_POST['documento'];
            $respuesta->nombre = $_POST['nombre'];
            $respuesta->direccion = $_POST['direccion'];
            $respuesta->telefono = $_POST['telefono'];
            $respuesta->ciudad = $_POST['ciudad'];
            $respuesta->correo = $_POST['correo'];
            $respuesta->responsable = $_POST['responsable'];
            $respuesta->actualizar();      
        }
    }