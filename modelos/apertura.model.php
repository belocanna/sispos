<?php
  if (!isset($_SESSION)) {
    session_start();
  }
  require_once "conexion.php";
  require_once "cajas.model.php";
  class aperturaModel
  { 
    static public function mdlListar()
    {
      $stmt = Conexion::connect()->prepare("SELECT
          aperturas.apertura_id,
          cajas.caja_nombre,
          usuarios.usuario_nombres,
          aperturas.apertura_fechainicial,
          aperturas.apertura_inicial,
          aperturas.apertura_fechaCierre,
          aperturas.apertura_cierre,
          aperturas.apertura_ventas,
          aperturas.apertura_estado
          FROM
          aperturas
          INNER JOIN cajas ON aperturas.apertura_caja = cajas.caja_id
          INNER JOIN usuarios ON aperturas.apertura_usuario = usuarios.usuario_id
          
          ");
      $stmt->execute();
      return $stmt->fetchAll();
    }
    static public function mdlGuardar($caja, $monto) 
    {
      date_default_timezone_set('America/Bogota');
        $fecha = date("Y-m-d H:i:s");
        $usuario = $_SESSION['idUsuario'];
        $stmt =Conexion::connect()->prepare("INSERT INTO aperturas (apertura_caja,apertura_usuario, apertura_fechainicial, apertura_inicial) values (?,?,?,?)");
        $stmt->bindParam(1, $caja);
        $stmt->bindParam(2, $usuario);
        $stmt->bindParam(3, $fecha);
        $stmt->bindParam(4, $monto);
        if ($stmt->execute()) {
          $result = "Apertura Realizada";
          $respuesta = aperturaModel::mdlBuscar();
          $_SESSION['idApertura'] =$respuesta[0]['apertura_id'];
          $_SESSION['idCaja'] = $caja;
          $respuesta= cajasModel::mdlActualizar($caja, 0);
      } else {
          $result = "Error al Agregar";
      }
      return $result;
    }
    static public function mdlValidar($usuario) {
      $stmt = Conexion::connect()->prepare("SELECT count(*) from aperturas where apertura_usuario = ? and apertura_estado = 1");
      $stmt->bindParam(1, $usuario);
      $stmt->execute();
      return $stmt->fetchAll();
    }
    static public function mdlBuscar()  {
     $usuario = $_SESSION['idUsuario'];
     $stmt= Conexion::connect()->prepare("SELECT * FROM aperturas where apertura_usuario = ? and apertura_estado = 1");
     $stmt->bindParam(1, $usuario);
     $stmt->execute();
     return $stmt->fetchAll();
    }  
    static public function mdlActualizar($monto, $ventas) {
      date_default_timezone_set('America/Bogota');
      $fecha = date("Y-m-d H:i:s");
      $apertura = $_SESSION['idApertura'];
      $stmt = Conexion::connect()->prepare("UPDATE aperturas set  apertura_fechacierre = ?, apertura_cierre = ?, apertura_ventas = ?, apertura_estado = 0 where apertura_id = ?");
      $stmt->bindParam(1, $fecha);
      $stmt->bindParam(2, $monto);
      $stmt->bindParam(3, $ventas);
      $stmt->bindParam(4, $apertura);
      if ($stmt->execute()) {
        $result = "Cierre Realizado";
        cajasModel::mdlActualizar($_SESSION['idCaja'], 1);
      } else {
          $result = "Error al Agregar";
      }
      return $result;
    }
  }
