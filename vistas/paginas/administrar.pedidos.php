<section class="content-header">
    <h1>
        Administrar Pedidos
    </h1>
    <ol class="breadcrumb">
        <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Compras</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="card">
        <div class="card-header">
           
        </div>
        <div class="card-body">
            <div class="table-responsive sm">
                <table class="table table-striped  nowrap" style="width:100%" id="lstCompras">
                    <thead class="bg-primary">
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Numero</th>
                            <th scope="col">Fecha</th>
                            <th scope="col"></th>
                            <th scope="col">Cliente</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

</section>


<script>
  var tabla, comprasdesde, comprashasta
  let accion = ""
  document.querySelector("#fechaDesde").value = moment().startOf("month").format("YYYY-MM-DD")
  document.querySelector("#fechaHasta").value = moment().format("YYYY-MM-DD")
  comprasdesde = document.querySelector("#fechaDesde").value
  comprashasta = document.querySelector("#fechaHasta").value
  tabla = $("#lstCompras").DataTable({
    ajax: {
      serverside: true,
      url: "ajax/compras.ajax.php",
      type: "POST",
      data: {
        'fechaDesde' : comprasdesde,
        'fechaHasta' : comprashasta,
        'accion' : 2
      },
      dataSrc:function (respuesta) {
         TotalCompras = 0;
         for (let i = 0; i < respuesta.length; i++) {
          TotalCompras = parseFloat(respuesta[i][5]) + parseFloat(TotalCompras)
         }
         $("#totalCompras").html('Total Compras : $ ' + TotalCompras)
         return respuesta
      },
    },
    columnDefs: [
      {
        targets: 0,
        visible: false,
      },
      {
        targets: 1,
        width: "100px",
      },
      {
        targets: 2,
        witdth: "100px",
      },
      {
        targets: 3,
        visible: false,
      },
      {
        targets: 4,
        width: "200px",
      },
      {
        targets: 5,
        width: "150px",
      },  
    ],
    columns: [
      { data: "compra_id" },
      { data: "compra_numero" },
      { data: "compra_fecha" },
      { data: "compra_proovedor" },
      { data: "proovedor_nombres" },
      { data: "compra_total" },
    ],
    dom:'Bfrtip',
    language: {
      url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
    },
  });

  document.querySelector("#btnFiltrar").addEventListener("click", function () {
    tabla.destroy();
    if (document.querySelector("#fechaDesde").value == '') {
        comprasdesde = '2000/10/01'
    }else{
      comprasdesde = document.querySelector("#fechaDesde").value
    }
    if (document.querySelector("#fechaDesde").value == '') {
        comprashasta = '3000/10/01'
    } else {
      comprashasta = document.querySelector("#fechaHasta").value
    }
    var groupColumn = 0
    tabla = $("#lstVentas").DataTable({
    ajax: {
      serverside: true,
      url: "ajax/ventas.ajax.php",
      type: "POST",
      data: {
        'fechaDesde' : comprasdesde,
        'fechaHasta' : comprashasta,
        'accion' : 2
      },
      dataSrc:function (respuesta) {
         TotalVenta = 0;
         for (let i = 0; i < respuesta.length; i++) {
         TotalVenta = parseFloat(respuesta[i][4]) + parseFloat(TotalVenta)
         }
         $("#totalVentas").html('Total Ventas : $ ' + TotalVenta)
         return respuesta
      },
    },
    columnDefs: [
      {
        targets: 0,
        visible: false,
      },
      {
        targets: 1,
        width: "100px",
      },
      {
        targets: 2,
        witdth: "100px",
      },
      {
        targets: 3,
        visible: false,
      },
      {
        targets: 4,
        width: "200px",
      },
      {
        targets: 5,
        width: "150px",
      },
      {
        targets: 6,
        visible: false,
      },
      {
        targets: 7,
        width: "150px",
      },
      {
        targets: 8,
        visible: false,
      },
      {
        targets: 9,
        width: "100px",
      },
      {
        targets: 10,
        width: "50px",
      },
      {
        targets: 11,
        width: "50px",
        defaultContent:
          "<button class='btn btn-primary btn-md btnDetalle'>Detalles</button>" +
          " " +
          "<button class='btn btn-danger btn-md btnReimprimir'>Reimprimir</button>",
        data: null,
      },
    ],
    columns: [
      { data: "venta_id" },
      { data: "venta_numero" },
      { data: "venta_fecha" },
      { data: "venta_cliente" },
      { data: "cliente_nombres" },
      { data: "venta_total" },
      { data: "venta_formaPago" },
      { data: "pago_nombre" },
      { data: "venta_comprobante" },
      { data: "venta_usuario" },
      { data: "usuario_nombres" },
    ],
    dom:'Bfrtip',
    language: {
      url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
    },
  });
  
  })
</script>