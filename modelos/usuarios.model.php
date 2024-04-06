<?php
if (!isset($_SESSION)) {
  session_start();
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require "PHPMailer/src/Exception.php";
require "PHPMailer/src/PHPMailer.php";
require "PHPMailer/src/SMTP.php";
require_once "conexion.php";
class usuariosModel
{
  static public function mdlListar($tabla, $item, $valor)
  {
    if ($item != null) {
      $stmt = Conexion::connect()->prepare("SELECT * from $tabla where $item = :$item order by usuario_id desc");
      $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
      $stmt->execute();
      return $stmt->fetch();
    } else {
      $stmt = Conexion::connect()->prepare("SELECT * from $tabla order by usuario_id desc");
      $stmt->execute();
      return $stmt->fetchAll();
    }
  }

  static public function mdlCambiarClave($contrasena)
  {
    $stmt = Conexion::connect()->prepare("UPDATE usuarios set usuario_clave = ? where usuario_id = ?");
    $clave = crypt($contrasena, '$2a$07$usesomesillystringforsalt$');
    $id = $_SESSION['idUsuario'];
    $stmt->bindParam(2, $id, PDO::PARAM_INT);
    $stmt->bindParam(1, $clave, PDO::PARAM_STR);
    if ($stmt->execute()) {
      $result = "Cambio Registrado";
    } else {
      $result = "Error de Registro";
    }
    return $result;
  }

  static public function mdlGuardar($nombres, $email, $contrasena, $perfil)
  {
    date_default_timezone_set('America/Bogota');
    $fecha = date('Y-m-d');
    $user = $_SESSION['idUsuario'];
    $clave = crypt($contrasena, '$2a$07$usesomesillystringforsalt$');
    $stmt = Conexion::connect()->prepare("INSERT into usuarios (usuario_nombres, usuario_correo, usuario_clave, usuario_perfil) values (?,?,?,?)");
    $stmt->bindParam(1, $nombres, PDO::PARAM_STR);
    $stmt->bindParam(2, $email, PDO::PARAM_STR);
    $stmt->bindParam(3, $clave, PDO::PARAM_STR);
    $stmt->bindParam(4, $perfil, PDO::PARAM_INT);
    if ($stmt->execute()) {
      $result = "Usuario Registrado";
      $mail = new PHPMailer(true);
      $mail->SMTPOptions = array(
        'ssl' => array(
          'verify_peer' => false,
          'verify_peer_name' => false,
          'allow_self_signed' => true
        )
      );

      $mail->SMTPDebug = 0;                      // Enable verbose debug output
      $mail->isSMTP();                                            // Send using SMTP
      $mail->Host       = ' smtp.office365.com';                    // Set the SMTP server to send through
      $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
      $mail->Username = 'carlosi.parrah@outlook.com'; //este debe ir en el address?
      $mail->Password = 'Minegra0212';                            // SMTP password
      $mail->SMTPSecure = 'tls';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
      $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above


      $mail->setFrom('carlosi.parrah@outlook.com', 'Soporte POS');
      $mail->addAddress($email);


      $mail->isHTML(true);
      $mail->Subject = 'Contraseña de Registro es :';
      $mail->Body    = 'Su contraseña : <br>' . $contrasena . '</br>';
      if (!$mail->send()) {
        echo 'Error al enviar el Mensaje';
      } else {
        echo  'mensaje enviado';
        echo
        '<script>
              window.location = "inicio";
          </script>';
      }
    } else {
      $result = "Error en Registro de Usuario";
    }
    return $result;
  }

  static public function mdlActualizar($id, $nombres, $email, $perfil)
  {
    date_default_timezone_set('America/Bogota');
    $fecha = date('Y-m-d');
    $usuario = $_SESSION['idUsuario'];
    $stmt = Conexion::connect()->prepare("UPDATE usuarios set usuario_nombres = ?, usuario_correo = ?, usuario_perfil = ? where usuario_id = ?");
    $stmt->bindParam(1, $nombres, PDO::PARAM_STR);
    $stmt->bindParam(2, $email, PDO::PARAM_STR);
    $stmt->bindParam(3, $perfil, PDO::PARAM_INT);
    $stmt->bindParam(4, $id, PDO::PARAM_INT);
    if ($stmt->execute()) {
      $result = "Usuario Actualizado";
    } else {
      $result = "Error al Actualizar";
    }
    return $result;
  }
  static public function mdlLogin($email, $contra)
  {
    $clave = crypt($contra, '$2a$07$usesomesillystringforsalt$');
    $stmt = Conexion::connect()->prepare("SELECT * from usuarios where usuario_correo = ? and usuario_clave = ?");
    $stmt->bindParam(1, $email, PDO::PARAM_STR);
    $stmt->bindParam(2, $clave, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetchAll();
  }

  static public function mdlValidarUsuario($usuario)
  {
    $stmt = Conexion::connect()->prepare("SELECT count(*) from usuarios where usuario = :usuario");
    $stmt->bindParam(":usuario", $usuario, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetchColumn();
  }

  static public function mdlValidarClave($id, $clave)
  {
    $stmt = Conexion::connect()->prepare("SELECT count(*) from usuarios where idusuari = :id, and clave_usuario = $clave");
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    $stmt->bindParam(":clave", $clave, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetchColumn();
  }

  static public function mdlRecuperarClave($email, $contrasena)
  {
    $contrasena = bin2hex(random_bytes(32));
    $clave = crypt($contrasena, '$2a$07$usesomesillystringforsalt$');
    $stmt = Conexion::connect()->prepare("UPDATE usuarios set usuario_clave = ? where usuario_correo = ?");
    $stmt->bindParam("ss", $clave, $email);
    $stmt->execute();
    $mail = new PHPMailer(true);
    $mail->SMTPOptions = array(
      'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
      )
    );
    //Server settings
    $mail->SMTPDebug = 0;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = ' smtp.office365.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username = 'carlosi.parrah@outlook.com'; //este debe ir en el address?
    $mail->Password = 'Minegra0212';                            // SMTP password
    $mail->SMTPSecure = 'tls';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('carlosi.parrah@outlook.com', 'Soporte POS');
    $mail->addAddress($email);     // Add a recipient

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Restablecer Clave';
    $mail->Body    = 'Su clave fue restablecida por : <br>' . $contrasena . '</br>';
    if (!$mail->send()) {
      echo 'Error al enviar el Mensaje';
    } else {
      echo  'mensaje enviado';
      echo
      '<script>
                window.location = "inicio";
            </script>';
    }
  }

  static public function mdlUltimoInicio($usuario)
  {
    date_default_timezone_set('America/Bogota');
    $fecha = date('Y-m-d H:i:s');
    $stmt = Conexion::connect()->prepare("UPDATE usuarios set usuario_login = ? where usuario_id = ?");
    $stmt->bindParam(1, $fecha, PDO::PARAM_STR);
    $stmt->bindParam(2, $usuario, PDO::PARAM_STR);
    $stmt->execute();
  }
  static public function mdlCambiarEstado($id, $estado)
  {
    $stmt = Conexion::connect()->prepare("UPDATE usuarios set usuario_estado = ? where usuario_id = ?");
    if ($estado == 0) {
      $estado = 1;
      $stmt->bindParam(1, $estado);
    } else {
      $estado = 0;
      $stmt->bindParam(1, $estado);
    }
    $stmt->bindParam(2, $id);
    if ($stmt->execute()) {
      $result = "Cambio Estado Registrado";
    } else {
      $result = "Error de Registro";
    }
    return $result;
  }
}
