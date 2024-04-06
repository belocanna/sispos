<?php
class usuariosControlador{
    static public function login(){
        
        if (isset($_POST['correo'])) {
                $correo = $_POST['correo'];
                $contra = crypt($_POST['contrasena'],'$2a$07$usesomesillystringforsalt$');
                $tabla= "usuarios";
                $item = "usuario_correo";
                $valor= $correo;
                $respuesta = usuariosModel::mdlListar($tabla,$item,$valor);
                if ($respuesta["usuario_correo"] == $correo && $respuesta["usuario_clave"] == $contra) {
                    if ($respuesta['usuario_estado'] == 1) {
                        $_SESSION['idUsuario'] = $respuesta['usuario_id'];
                        $_SESSION['nombres'] = $respuesta['usuario_nombres'];
                        $_SESSION['perfil'] = $respuesta['usuario_perfil'];
                        $_SESSION['clave'] = $contra;
                        $respuesta = usuariosModel::mdlUltimoInicio($respuesta['usuario_id']);
                        echo '<script>
                        window.location ="inicio"  
                        </script>';
                        $respuesta = aperturaModel::mdlValidar($_SESSION['idUsuario']);
                        if ($respuesta > 0) {
                            $respuesta = aperturaModel::mdlBuscar($_SESSION['idUsuario']);
                            $_SESSION['idApertura'] = $respuesta[0]['apertura_id'];
                            $_SERVER['idCaja'] = $respuesta[0]['apertura_caja'];
                        }    
                    }else{
                        echo '
                        <div class="alert alert-danger">Usuario No Activo</div>
                     ';
                    }                                          
                }else{
                   echo '
                   <div class="alert alert-danger">Usuario y/o Contraseña No Validos</div>
                ';
                }  
            }
    }
    static public function ctrListar($tabla, $item, $valor)  {
        $respuesta = usuariosModel::mdlListar($tabla, $item, $valor);
        return $respuesta;
    }
    static function ctrGuardar($nombres, $email, $contrasena, $perfil){
        $respuesta = usuariosModel::mdlGuardar($nombres, $email, $contrasena, $perfil);
        return $respuesta;
    }
    static function ctrActualizar($id, $nombres, $email, $perfil){
        $respuesta = usuariosModel::mdlActualizar($id, $nombres, $email, $perfil);
        return $respuesta;
    }
    static public function ctrCambiarClave($contrasena) {
        $respuesta = usuariosModel::mdlCambiarClave($contrasena);
        return $respuesta;
    }
    static public function ctrValidarClave($id, $clave) {
        $respuesta = usuariosModel::mdlValidarClave($id, $clave);
        return $respuesta;
    }
    static public function ctrValidarUsuario($usuario) {
        $respuesta = usuariosModel::mdlValidarUsuario($usuario);
        return $respuesta;
    }
    static public function ctrRecuperarClave($email, $contrasena) {
        $respuesta = usuariosModel::mdlRecuperarClave($email, $contrasena);
        return $respuesta;
    }
    static public function ctrCambiarEstado($id, $estado) {
        $respuesta = usuariosModel::mdlCambiarEstado($id, $estado);
        return $respuesta;
    }
   
}