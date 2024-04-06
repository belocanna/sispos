<?php
require_once "../controllers/detalleVentas.controller.php";
require_once "../models/detalleVentas.model.php";
class detalleVentasAjax
{
    public $id;
    public $codigoProducto;
    public $cantidadProducto;
    public $precioProducto;
    public $venta;
    function guardar()
    {
        $respuesta = detalleVentasController::ctrGuardar($this->codigoProducto, $this->precioProducto);
        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
    }
    function listar()
    {
        $respuesta = detalleVentasController::ctrListar();
        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
    }
    function vaciar() {
        $respuesta = detalleVentasController::ctrVaciar();
        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
    }
    function eliminar()  {
        $respuesta = detalleVentasController::ctrEliminar($this->id);
        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
    }
    function aumentar() {
        $respuesta = detalleVentasController::ctrAumentar($this->id, $this->cantidadProducto);
        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
    }
    function consultar() {
        $respuesta = detalleVentasController::ctrConsultar($this->venta);
        echo json_encode($respuesta);
    }
}
if (!isset($_POST['accion'])) {
    $respuesta = new detalleVentasAjax();
    $respuesta->listar();
} else {
    if (isset($_POST['accion']) && $_POST['accion'] == "agregar") {
        $respuesta = new detalleVentasAjax();
        $respuesta->codigoProducto = $_POST['codigo'];
        $respuesta->precioProducto = $_POST['precio'];
        $respuesta->guardar();
    }
    if (isset($_POST['accion']) && $_POST['accion'] == "vaciar") {
        $respuesta = new detalleVentasAjax();
        $respuesta->vaciar();
    }
    if (isset($_POST['accion']) && $_POST['accion'] == "eliminar") {
        $respuesta = new detalleVentasAjax();
        $respuesta->id = $_POST['id'];
        $respuesta->eliminar();
    }
    if(isset($_POST['accion']) && $_POST['accion'] == "aumentar"){

    }
}