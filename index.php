<?php
    require_once "controladores/plantilla.controlador.php";
    require_once "controladores/usuarios.controlador.php";
    require_once "modelos/usuarios.model.php";
    require_once "modelos/apertura.model.php";
    $plantilla = new plantillaControlador();
    $plantilla->ctrCargarPlantilla();
?>