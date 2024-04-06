<?php
    require_once "../controladores/categorias.controlador.php";
    require_once "../modelos/categorias.model.php";
    class categoriasAjax{
        public $id;
        public $descripcion;
        public $ubicacion;
        public function listar()
        {
            $respuesta = categoriasControlador::ctrListar();
            echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
        }
        function guardar(){
            $respuesta = categoriasControlador::ctrGuardar($this->descripcion, $this->ubicacion);
            echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
        }
        function actualizar(){
            $respuesta = categoriasControlador::ctrActualizar($this->id, $this->descripcion, $this->ubicacion);
            echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
        }
}
    if (!isset($_POST['accion'])) {
        $respuesta = new categoriasAjax();
        $respuesta->listar();
    } else {
        if (isset($_POST['accion']) && $_POST['accion'] == 1) {
            $respuesta = new categoriasAjax();
            $respuesta->descripcion = $_POST['descripcion'];
            $respuesta->ubicacion = $_POST['ubicacion'];
            $respuesta->guardar();
        }
        if (isset($_POST['accion']) && $_POST['accion'] == 2) {
            $respuesta = new categoriasAjax();
            $respuesta->id = $_POST['id'];
            $respuesta->descripcion = $_POST['descripcion'];
            $respuesta->ubicacion = $_POST['ubicacion'];
            $respuesta->actualizar();
        }
    }


