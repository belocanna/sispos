<?php
    require_once "../controladores/formaspago.controlador.php";
    require_once "../modelos/formaspago.model.php";
    class formaspagoAjax{
        public function listar() {
            $respuesta = formaspagoControlador::ctrListar();
            echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
        }
    }
    $respuesta =new formaspagoAjax();
    $respuesta->listar();