<?php
    require_once "../controladores/cajas.controlador.php";
    require_once "../modelos/cajas.model.php";
    class cajasAjax{
        public $id;
        public $descripcion;
        public $estado;
        public function listar()
        {
            $respuesta = cajasControlador::ctrListar();
            echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
        }
        public function listarCajasAbiertas()
        {
            $respuesta = cajasControlador::ctrListarCajasAbiertas();
            echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
        }
        function guardar(){
            $respuesta = cajasControlador::ctrGuardar($this->descripcion);
            echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
        }
        function actualizar() {
            $respuesta = cajasControlador::ctrActualizar($this->id, $this->estado);
            echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
        }
    }
    if (!isset($_POST['accion'])) {
        $respuesta = new cajasAjax();
        $respuesta->listar();
    } else {
        if (isset($_POST['accion']) && $_POST['accion'] == 1) {
            $respuesta = new cajasAjax();
            $respuesta->descripcion = $_POST['descripcion'];
            $respuesta->guardar();
        }
        if (isset($_POST['accion']) && $_POST['accion'] == 2) {
            $respuesta = new cajasAjax();
            $respuesta->id = $_POST['id'];
            $respuesta->estado = $_POST['estado'];
            $respuesta->actualizar();
        }
        if (isset($_POST['accion'])&& $_POST['accion'] == 3) {
            $respuesta = new cajasAjax();
            $respuesta->listarCajasAbiertas();
        }
    }
?>