<?php
require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.model.php";
class usuariosAjax
{
    public $archivoUsuarios;
    public $id;
    public $usuario;
    public $email;
    public $nombres;
    public $perfil;
    public $clave;
    public $estado;
    public function listar()
    {
      $tabla ="usuarios";
      $item = null;
      $valor = null;
       $answer = usuariosControlador::ctrListar($tabla, $item, $valor);
        echo json_encode($answer);
    }
    public function actualizar()
    {
       $answer = usuariosControlador::ctrActualizar($this->id, $this->nombres, $this->email, $this->perfil);
        echo json_encode($answer, JSON_UNESCAPED_UNICODE);
    }
    public function guardar()
    {
       $answer = usuariosControlador::ctrGuardar($this->nombres, $this->email, $this->clave, $this->perfil);
        echo json_encode($answer, JSON_UNESCAPED_UNICODE);
    }
    public function cambiarClave()
    {
       $answer = usuariosControlador::ctrCambiarClave($this->clave);
        echo json_encode($answer, JSON_UNESCAPED_UNICODE);
    }
    public function recuperarClave()
    {
       $answer = usuariosControlador::ctrRecuperarClave($this->email, $this->clave);
        echo json_encode($answer, JSON_UNESCAPED_UNICODE);
    }
    public function cambiarEstado() 
    {
       $answer = usuariosControlador::ctrCambiarEstado($this->id, $this->estado);
        echo json_encode($answer, JSON_UNESCAPED_UNICODE);

    }
}
if(!isset($_POST['accion'])){
   $answer = new usuariosAjax();
   $answer->listar();
}else{
if (isset($_POST['accion']) && $_POST['accion'] == 1) {
   $answer = new usuariosAjax();
   $answer->email = $_POST['email'];
   $answer->nombres = $_POST['nombres'];
   $answer->clave = $_POST['contrasena'];
   $answer->perfil = $_POST['perfil'];
   $answer->guardar();
}
if (isset($_POST['accion']) && $_POST['accion'] == 2) {
   $answer = new usuariosAjax();
   $answer->clave = $_POST['contrasena'];
   $answer->cambiarClave();
}
if(isset($_POST['accion']) && $_POST['accion'] == 3){
   $answer = new usuariosAjax();
   $answer->id =  $_POST['id'];
   $answer->estado = $_POST['estado'];
   $answer->cambiarEstado();
}
if (isset($_POST['accion']) && $_POST['accion'] == 4) {
   $answer = new usuariosAjax();
   $answer->email = $_POST['email'];
   $answer->clave = $_POST['contrasena'];
   $answer->recuperarClave();
}
if (isset($_POST['accion']) && $_POST['accion'] == 5) {
   $answer = new usuariosAjax();
   $answer->id = $_POST['id'];
   $answer->email = $_POST['email'];
   $answer->nombres = $_POST['nombres'];
   $answer->perfil = $_POST['perfil'];
   $answer->actualizar();
}
}