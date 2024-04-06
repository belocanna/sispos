<?php
    require_once "../controllers/medidas.controller.php";
    require_once "../models/medidas.model.php";
    class medidasAjax{
        public $id;
        public $descripcion;
        public function listar()
        {
            $respuesta = medidasController::ctrListar();
            echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
        }
        function guardar(){
            $respuesta = medidasController::ctrGuardar($this->descripcion);
            echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
        }
        public function actualizar() {
            $respuesta = medidasController::ctrActualizar($this->id, $this->descripcion);
            echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
        }
    }
    if (!isset($_POST['accion'])) {
        $respuesta = new medidasAjax();
        $respuesta->listar();
    } else {
        if (isset($_POST['accion']) && $_POST['accion'] == 1) {
            $respuesta = new medidasAjax();
            $respuesta->descripcion = $_POST['descripcion'];
            $respuesta->guardar();
        }
        if (isset($_POST['accion']) && $_POST['accion'] == 2) {
            $respuesta = new medidasAjax();
            $respuesta->id = $_POST['id'];
            $respuesta->descripcion = $_POST['descripcion'];
            $respuesta->actualizar();
        }
    }