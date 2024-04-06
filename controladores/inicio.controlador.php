<?php
    class inicioControlador{
        static public function ctrGetDatos() {
            $datos = inicioModel::mdlGetDatos();
            return $datos;
        }
        static public function ctrGetMinimo() {
            $datos = inicioModel::mdlGetMinimo();
            return $datos;
        }
        static public function ctrGetVentas()  {
            $datos = inicioModel::mdlGetVentas();
            return $datos;
        }
        static public function ctrGetPagosEfectivo()  {
            $datos = inicioModel::mdlGetEfectivo();
            return $datos;
        }
        static public function ctrGetPagosBanco()  {
            $datos = inicioModel::mdlGetBanco();
            return $datos;
        }

        
    }