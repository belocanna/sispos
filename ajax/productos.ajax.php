<?php
    require_once "../controladores/productos.controlador.php";
    require_once "../modelos/productos.model.php";
    class productosAjax{
        public $id;
        public $codigo;
        public $descripcion;
        public $medida;
        public $categoria;
        public $stock;
        public $costo;
        public $venta;
        public $minimo;
        public $inventario;
        public function listar()
        {
            $respuesta = productosControlador::ctrListar();
            echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
        }
        public function guardar() {
            $respuesta = productosControlador::ctrGuardar($this->codigo,$this->descripcion,  $this->stock, $this->costo, $this->venta, $this->minimo, $this->categoria, $this->inventario);
            echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
        }
        public function validarCodigo() {
            $respuesta = productosControlador::ctrValidarCodigo($this->codigo);
            echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
        }
        public function actualizar()  {
            $respuesta = productosControlador::ctrActualizar($this->id, $this->codigo,$this->descripcion, $this->stock, $this->costo, $this->venta, $this->minimo, $this->categoria, $this->inventario);
            echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
        }
        public function buscarProducto() {
           $respuesta = productosControlador::ctrBuscarProducto($this->codigo) ;
           echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
        }
        public function codigo() {
            $respuesta = productosControlador::ctrCodigo($this->categoria);
            echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
        }
        public function minimo()  {
            $respuesta = productosControlador::ctrMinimo();
            echo json_encode($respuesta);
        }
        public function listarNombresProductos() {
            $respuesta = productosControlador::ctrListarNombresProductos();
            echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
        }
        public function buscarProductoCompra() {
            $respuesta = productosControlador::ctrBuscarProductoCompra($this->codigo) ;
            echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
         }
        public function verificarStock() {
            $respuesta = productosControlador::ctrVerificarStock($this->codigo, $this->stock);
            echo json_encode($respuesta);
        }
        public function listarProductosVenta() {
            $respuesta = productosControlador::ctrListarPorVenta($this->id);
            echo json_encode($respuesta);
        }
        public function aumentarStock() {
            $respuesta = productosControlador::ctrAumentarStock($this->id, $this->stock);
            echo json_encode($respuesta);
        }
        public function disminuirStock() {
            $respuesta = productosControlador::ctrDisminuirStock($this->id, $this->stock);
            echo json_encode($respuesta);
        }
    }
    if (!isset($_POST['accion'])) {
        $respuesta = new productosAjax();
        $respuesta->listar();
    }else{
        if (isset($_POST['accion']) &&  $_POST['accion'] == 1) {
            $respuesta = new productosAjax();
            $respuesta->codigo = $_POST['codigo'];
            $respuesta->descripcion = $_POST['descripcion'];
            $respuesta->stock = $_POST['stock'];
            $respuesta->costo = $_POST['costo'];
            $respuesta->venta = $_POST['venta'];
            $respuesta->minimo = $_POST['minimo'];
            $respuesta->categoria = $_POST['categoria'];
            $respuesta->inventario = $_POST['inventario'];
            $respuesta->guardar();
        }
        if (isset($_POST['accion']) &&  $_POST['accion'] == 2) {
            $respuesta = new productosAjax();
            $respuesta->id = $_POST['id'];
            $respuesta->codigo = $_POST['codigo'];
            $respuesta->descripcion = $_POST['descripcion'];
            $respuesta->stock = $_POST['stock'];
            $respuesta->costo = $_POST['costo'];
            $respuesta->venta = $_POST['venta'];
            $respuesta->minimo = $_POST['minimo'];
            $respuesta->categoria = $_POST['categoria'];
            $respuesta->inventario = $_POST['inventario'];
            $respuesta->actualizar();
        }
        if (isset($_POST['accion']) && $_POST['accion'] == 3) {
           $respuesta = new productosAjax();
           $respuesta->codigo = $_POST['codigo'];
           $respuesta->validarCodigo();
        }
        if (isset($_POST['accion']) && $_POST['accion'] == 4) {
            $respuesta = new productosAjax();
            $respuesta->codigo = $_POST['codigo'];
            $respuesta->buscarProducto();
        }
        if (isset($_POST['accion']) && $_POST['accion'] == 5) {
            $respuesta = new productosAjax();
            $respuesta->categoria = $_POST['categoria'];
            $respuesta->codigo();
        }  
        if (isset($_POST['accion']) && $_POST['accion'] == 6) {
            $respuesta = new productosAjax();
            $respuesta->minimo();
        }
        if (isset($_POST['accion']) && $_POST['accion'] == 7) {
            $respuesta = new productosAjax();
            $respuesta->listarNombresProductos();
        } 
        if (isset($_POST['accion']) && $_POST['accion'] == 8) {
            $respuesta = new productosAjax();
            $respuesta->codigo = $_POST['codigo'];
            $respuesta->buscarProductoCompra();
        } 
        if (isset($_POST['accion']) && $_POST['accion'] == 9) {
            $respuesta = new productosAjax();
            $respuesta->codigo = $_POST['codigo'];
            $respuesta->stock =$_POST['cantidad'];
            $respuesta->verificarStock();
        }
        if (isset($_POST['accion']) && $_POST['accion'] == 10) {
            $respuesta = new productosAjax();
            $respuesta->id= $_POST['numero'];
            $respuesta->listarNombresProductos();
        } 
        if (isset($_POST['accion']) && $_POST['accion'] == 11) {
            $respuesta = new productosAjax();
            $respuesta->id = $_POST['id'];
            $respuesta->stock = $_POST['cantidad'];
            $respuesta->aumentarStock();
        }
        if (isset($_POST['accion']) && $_POST['accion'] == 12) {
            $respuesta = new productosAjax();
            $respuesta->id = $_POST['id'];
            $respuesta->stock = $_POST['cantidad'];
            $respuesta->disminuirStock();
        }
      
    }