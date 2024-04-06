<?php
    require_once "../controllers/tiposDocumentos.controller.php";
    require_once "../models/tiposDocumentos.model.php";
    class tiposDocumentosAjax{
        public $id;
        public $descripcion;
         public function listar() {
            $respuesta = tiposDocumentosController::ctrListar();
            echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
         }       
    }
    if (!isset($_POST['accion'])) {
        $respuesta = new tiposDocumentosAjax();
        $respuesta->listar();
    }