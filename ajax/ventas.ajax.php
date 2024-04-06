<?php
require_once "../controladores/ventas.controlador.php";
require_once "../modelos/ventas.model.php";
require_once "../controladores/empresa.controlador.php";
require_once "../modelos/empresa.model.php";
class ventasAjax
{
    public $numero;
    public $cliente;
    public $total;
    public $pago;
    public $comprobante;
    public $apertura;
    public function listarVentas($fechaDesde, $fechaHasta)
    {
        $respuesta = ventasControlador::ctrListarVentas($fechaDesde, $fechaHasta);
        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
    }
    public function  eliminar($factura)
    {
        $respuesta = ventasControlador::ctrEliminar($factura);
        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
    }
    public function registrar($datos, $numero, $cliente, $total, $pago, $comprobante)
    {
        $respuesta = ventasControlador::ctrRegistrar($datos, $numero, $cliente, $total, $pago, $comprobante);
        echo json_encode($respuesta);
    }
    public function codigoVenta()
    {
        $respuesta = ventasControlador::ctrCodigoVenta();
        echo json_encode($respuesta);
    }
    public function totalVentas()
    {
        $respuesta = ventasControlador::ctrTotalVentas();
        echo json_encode($respuesta);
    }
    public function generarTicketVenta($numero)
    {
        ini_set('error_reporting', E_ALL);
        require('../vistas/assets/plugins/fpdf/fpdf.php');
        ob_start();
        $pdf = new FPDF('P', 'mm', array(80, 200));
        $pdf->AddPage();
        $pdf->SetMargins(2, 0, 0);
        $pdf->SetTitle("Reporte de Venta");
        //NOMBRE DEL NEGOCIO
        $empresa = empresaControlador::ctrDatosEmpresa();
        $pdf->SetFont('Arial', '', 10);
        $pdf->ln();
        $pdf->Cell(10, 4, $empresa[0]["empresa_nombre"], 0, 1, 'L');
        $pdf->SetFont('Arial', '', 6);
        $pdf->cell(10, 3, 'Rut :', 0, 0, 'L');
        $pdf->Cell(10, 3, $empresa[0]["empresa_documento"], 0, 1, 'L');
        $pdf->Cell(10, 3, $empresa[0]["empresa_direccion"], 0, 1, 'L');
        $pdf->Cell(10, 3, $empresa[0]["empresa_correo"], 0, 1, 'L');
        $pdf->Cell(10, 3, $empresa[0]["empresa_ciudad"], 0, 1, 'L');
        $pdf->ln();
        $pdf->SetFont('Arial', '', 8);
        $pdf->cell(30, 4, 'Ticket de Venta No. ', 0, 0, 'L');
        $pdf->cell(10, 4, $numero, 0, 1, 'L');
        $pdf->cell(10, 4, '-------------------------------------------------------------------------', 0, 1, 'L');
        $ventas = ventasControlador::ctrObtenerVenta($numero);
        $pdf->cell(30, 4, 'Fecha :', 0, 0, 'L');
        $pdf->cell(10, 4, $ventas[0]["venta_fecha"], 0, 1, 'L');
        $pdf->cell(30, 4, 'Documento Cliente :', 0, 0, 'L');
        $pdf->cell(10, 4, $ventas[0]["cliente_numero_documento"], 0, 1, 'L');
        $pdf->cell(30, 4, 'Cliente :', 0, 0, 'L');
        $pdf->cell(10, 4, $ventas[0]["cliente_nombres"], 0, 1, 'L');
        $pdf->cell(30, 4, 'Forma de Pago :', 0, 0, 'L');
        $pdf->cell(10, 4, $ventas[0]["pago_nombre"], 0, 1, 'L');
        $pdf->ln();
        $pdf->SetFont('Arial', '', 10);
        $pdf->cell(60, 4, 'DETALLE VENTA', 0, 1, 'C');
        $totalVenta = $ventas[0]['venta_total'];
        $usuario = $ventas[0]['usuario_nombres'];
        $productos = ventasControlador::ctrObtenerDetalleVenta($numero);
        $pdf->SetFont('Arial', '', 6);
        $pdf->ln();
        $pdf->cell(10, 4, 'Cant', 0, 0, 'L');
        $pdf->cell(40, 4, 'Descripcion', 0, 0, 'L');
        $pdf->cell(200, 4, 'Unitario', 0, 1, 'L');
        foreach ($productos as $pro) {
            $pdf->cell(10, 4, $pro["cantidad_detalle"], 0, 0, 'L');
            $pdf->cell(40, 4, $pro["producto_nombre"], 0, 0, 'L');
            $pdf->cell(200, 4, number_format($pro["precio_detalle"], 2, '.', ','), 0, 1, 'L');
        }
        $pdf->SetFont('Arial', '', 8);
        $pdf->cell(10, 4, '-------------------------------------------------------------------------', 0, 1, 'L');
        $pdf->cell(10, 4, 'Total :', 0, 0, 'L');
        $pdf->cell(10, 4, number_format($totalVenta, 2, '.', ','), 0, 1, 'L');
        $pdf->cell(10, 4, '-------------------------------------------------------------------------', 0, 1, 'L');
        $pdf->cell(10, 4, 'Cajero :', 0, 0, 'L');
        $pdf->cell(10, 4, $usuario, 0, 1, 'L');
        $pdf->Output();
        ob_end_flush();
    }
    public function obtenerDetalleVentas($numero)
    {
        $respuesta = ventasControlador::ctrObtenerDetalleVenta($numero);
        echo json_encode($respuesta);
    }
}
if (isset($_POST['accion']) && $_POST['accion'] == 1) {
    $respuesta = new ventasAjax();
    $respuesta->codigoVenta();
} else {
    if (isset($_POST["arr"])) {
        $respuesta = new ventasAjax();
        $respuesta->registrar($_POST['arr'], $_POST['numero'], $_POST['cliente'], $_POST['total'], $_POST['pago'], $_POST['comprobante']);
    }
}
if (isset($_POST['accion']) && $_POST['accion'] == 2) {
    $respuesta = new ventasAjax();
    $respuesta->listarVentas($_POST['fechaDesde'], $_POST['fechaHasta']);
}
if (isset($_POST['accion']) && $_POST['accion'] == 4) {
    $respuesta = new ventasAjax();
    $respuesta->eliminar($_POST['factura']);
}
if (isset($_POST['accion']) && $_POST['accion'] == 5) {
    $respuesta = new ventasAjax();
    $respuesta->obtenerDetalleVentas($_POST['numero']);
}
if (isset($_POST['accion']) && $_POST['accion'] == 6) {
    $respuesta = new ventasAjax();
    $respuesta->totalVentas();
}
if (isset($_GET['venta_id'])) {
    $respuesta = new ventasAjax();
    $respuesta->generarTicketVenta($_GET['venta_id']);
}
