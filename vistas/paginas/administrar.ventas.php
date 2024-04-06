<div class="content-header">
    <div class="content-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>
                    Administrar Ventas
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li><a href="inicio"><i class="breadcrumb-item"></i> Inicio</a></li>
                    <li class="breadcrumb-item active">Administrar Ventas</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
    <div class="card">
        <div class="card-header">
        <div class="row mb-1">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-info">
                            <h4>Criterios de Busquedad</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="">Desde</label>
                                        <input id="fechaDesde" class="form-control" type="date" name="">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                <div class="form-group">
                                        <label for="">Hasta</label>
                                        <input id="fechaHasta" class="form-control" type="date" name="">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <a href="" class="btn btn-success" id="btnFiltrar" >Filtrar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
        </div>    
        <div class="row mb-2">
        <h3 id="totalVentas"></h3>
        </div>
        <div class="card-body">
            <div class="table-responsive sm">
                <table class="table table-striped  nowrap" style="width:100%" id="lstVentas">
                    <thead class="bg-primary">
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Numero</th>
                            <th scope="col">Fecha</th>
                            <th scope="col"></th>
                            <th scope="col">Cliente</th>
                            <th scope="col">Valor</th>
                            <th scope="col"></th>
                            <th scope="col">Forma de Pago</th>
                            <th scope="col"></th>
                            <th scope="col">Comprobante</th>
                            <th scope="col">Usuario</th>
                            <th scope="col">Acciones</th>
                        </tr>

                    </thead>
                </table>
            </div>
        </div>
    </div>        
    </div>
    <!-- Small boxes (Stat box) -->
    

</div>

<div id="modalDetalleVentas" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title" id="my-modal-title">Editar Venta</h5>
                <button class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive sm">
                    <table class="table table-bordered table-striped w-100" style="width:100%" id="tblDetalle">
                        <thead class="bg-info">
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">Articulo</th>
                                <th scope="col">Cantidad</th>
                                <th scope="col">Precio</th>
                            </tr>

                        </thead>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnCerrarDetalle" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>



<script>
  $(document).ready(function () {
    var tabla, ventasdesde, ventashasta, tablaDetalle
    var groupColumn = 0
  let accion = ""

  document.querySelector("#fechaDesde").value = moment().startOf("month").format("YYYY-MM-DD")
  document.querySelector("#fechaHasta").value = moment().format("YYYY-MM-DD")
  ventasdesde = document.querySelector("#fechaDesde").value
  ventashasta = document.querySelector("#fechaHasta").value
  tabla = $("#lstVentas").DataTable({
    ajax: {
      serverside: true,
      url: "ajax/ventas.ajax.php",
      type: "POST",
      data: {
        'fechaDesde' : ventasdesde,
        'fechaHasta' : ventashasta,
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
    "columnDefs": [
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
          "<button class='btn btn-warning btn-md btnDetalle'><i class='fas fa-edit'></i></button>" +
          " " +
          "<button class='btn btn-danger btn-md btnReimprimir'><i class='fas fa-print'></i></button>",
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
    Destroy: true,
    dom:'Bfrtip',
    language: {
      url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
    },
  });

  $(document).on("click",".btnDetalle", function () {
    accion = 5
    let datos = new FormData()
    let data = tabla.row($(this).parents("tr")).data();
    numero = data[1];
    // datos.append("numero", numero)
    // datos.append("accion", accion)
    $("#tblDetalle").DataTable({
      ajax: {
        serverside: true,
        url: "ajax/ventas.ajax.php",
        type: "POST",
        data: {
          'numero' : numero,
          'accion' : accion
        },
        dataSrc: "",
        dataType : "json",
        Destroy : true,
        paging: false,
        processing : true
      },
      columns: [
      { data: "producto_detalle" },
      { data: "producto_nombre" },
      { data: "cantidad_detalle" },
      { data: "precio_detalle" },
    ],
    dom : "Bfrtip",

    language: {
        url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
      },
    });
    $("#modalDetalleVentas").modal("show");
  });

  document.querySelector("#btnCerrarDetalle").addEventListener("click", function () {
   $("#tblDetalle").DataTable().clear().destroy();
  })

  $(document).on("click", ".btnReimprimir", function () {
    let data = tabla.row($(this).parents("tr")).data();
    window.open("http://localhost/davidmotos/views/generar_ticket.php?numero="+data[0])
  });
  document.querySelector("#btnFiltrar").addEventListener("click", function () {
    tabla.destroy();
    if (document.querySelector("#fechaDesde").value == '') {
        ventasdesde = '2000/10/01'
    }else{
      ventasdesde = document.querySelector("#fechaDesde").value
    }
    if (document.querySelector("#fechaDesde").value == '') {
        ventashasta = '3000/10/01'
    } else {
      ventashasta = document.querySelector("#fechaHasta").value
    }
    var groupColumn = 0
    tabla = $("#lstVentas").DataTable({
    ajax: {
      serverside: true,
      url: "ajax/ventas.ajax.php",
      type: "POST",
      data: {
        'fechaDesde' : ventasdesde,
        'fechaHasta' : ventashasta,
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
    drawCallback: function (settings) {
                
                var api = this.api();
                var rows = api.rows( {page:'current'} ).nodes();
                var last=null;
    
                api.column(groupColumn, {page:'current'} ).data().each( function ( group, i ) {                
                                    
                    if ( last !== group ) {

                        const data = group.split("-");
                        var numero = data[0];
                        numero = numero.split(":")[1].trim();                        
                        console.log("🚀 ~ file: administrar_ventas.php ~ line 134 ~ nroBoleta", numero)

                        $(rows).eq(i).before(
                            '<tr class="group">'+
                                '<td colspan="6" class="fs-6 fw-bold fst-italic bg-success text-white"> ' +
                                    '<i nroBoleta = ' + numero + ' class="fas fa-trash fs-6 text-danger mx-2 btnEliminarVenta" style="cursor:pointer;"></i> '+
                                        group +  
                                '</td>'+
                            '</tr>'
                        );

                        last = group;
                    }
                } );
            },

    language: {
      url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
    },
  });
  })
  })

</script>