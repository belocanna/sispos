$(document).ready(function () {
  var tabla, accion,  items , tablaProductos, numero
  //  CARGAR FORMAS DE PAGO
   $.ajax({
      serverside: true,
      url: "ajax/formaspago.ajax.php",
      cache: false,
      contentType: false,
      dataType: "json",
      success: function (respuesta) {
        let options = '<option selected value="0">Seleccione</option>';
        for (let index = 0; index < respuesta.length; index++) {
          options =
            options +
            "<option value =" +
            respuesta[index][0] +
            ">" +
            respuesta[index][1] +
            "</option>";
        }
        $("#pagoVenta").html(options);
      },
    });
  fnc_cargarNumeroVenta();

  // INICIO LLENAR INPUT DE PRODUCTOS
   items = [];
   tablaProductos = $("#tblProductosVenta").DataTable({
    columnDefs: [
      {
        targets: 0,
        visible: false,
      },
      {
        targets: 1,
        width: "200px",
      },
      {
        targets: 2,
        width: "400px",
      },
      {
        targets: 3,
        width: "100px",
      },
      {
        targets: 4,
        width: "100px",
      },
      {
        targets: 5,
        width: "100px",
      },
    ],
    dom: "rtip",
    paging: false,
    language: {
      url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
    },
  });
    $.ajax({
    async: false,
    url: "ajax/productos.ajax.php",
    method: "POST",
    data: {
      'accion': 7,
    },
    dataType: "json",
    success: function (respuesta) {
      for (let i = 0; i < respuesta.length; i++) {
        items.push(respuesta[i]["descripcion_producto"]);
      }
      $("#codigoProductoVenta").autocomplete({
        source: items,
        select: function (event, ui) {
          let str = ui.item.value
          let arr= str.split(',')
          fnc_cargarProductos(arr[0])
          $("#codigoProductoVenta").val
          $("#codigoProductoVenta").focus
          return false
        },
      });
    },
  });  

  // document.querySelector("#clienteVenta").addEventListener("blur", function () {
  //   documento = document.querySelector("#clienteVenta").value;
  //   if (documento == 0 || documento == null) {
  //     Swal.fire({
  //       text: "Ingrese Documento del Cliente",
  //       target: "#custom-target",
  //       customClass: {
  //         container: "position-absolute",
  //       },
  //       toast: true,
  //       position: "top-end",
  //     });
  //     return false;
  //   } else {
  //     let datos = new FormData();
  //     datos.append("documento", documento);
  //     datos.append("accion", 3);
  //     $.ajax({
  //       url: "ajax/clientes.ajax.php",
  //       method: "POST",
  //       data: datos,
  //       cache: false,
  //       contentType: false,
  //       processData: false,
  //       dataType: "json",
  //       success: function (respuesta) {
  //         if (respuesta[0] > 0) {
  //           datos.append("accion", 4);
  //           $.ajax({
  //             url: "ajax/clientes.ajax.php",
  //             method: "POST",
  //             data: datos,
  //             cache: false,
  //             contentType: false,
  //             processData: false,
  //             dataType: "json",
  //             success: function (respuesta) {
  //               document.querySelector("#nombreCliente").innerHTML = respuesta[0]["cliente_nombres"];
  //             },
  //           });
  //         } else {
  //           Swal.fire({
  //             text: " Documento de Cliente No Registrado",
  //             target: "#custom-target",
  //             customClass: {
  //               container: "position-absolute",
  //             },
  //             toast: true,
  //             position: "top-end",
  //           });
  //           document.querySelector("#clienteVenta").value = "";
  //           return false;
  //         }
  //       },
  //     });
  //   }
  // });
  // CARGAR LISTADO PRODUCTOS DE VENTA

  
  // FUNCION PARA AUMENTAR C"ANTIDAD EN LISTADO DE PRODUCTOS
  $(document).on("click", ".btnAumentar", function () {
    var data = tablaProductos.row($(this).parents("tr")).data();
    var idx = tablaProductos.row($(this).parents("tr")).index();
    var codigo = data[1];
    var cantidad = data[3] + 1;
    $.ajax({
      url: "ajax/productos.ajax.php",
      method: "POST",
      data: {
        "codigo" :codigo,
        "cantidad" : cantidad,
        "accion" : 9
      },
      cache: false,
      contentType: false,
      processData: false,
      success: function (respuesta) {
      console.log(respuesta)
      if(respuesta== 0){
        Swal.fire({
          text: 'Inventario no Disponible',
          icon: "error",
        });
      }else{
        tablaProductos.cell(idx, 3).data(cantidad).draw();
        nuevoPrecio = parseFloat(data[3] * data[4]).toFixed(2);
        tablaProductos.cell(idx, 5).data(nuevoPrecio).draw();
        
      }
      fnc_recalcularTotales();
    }
    });
  });
  // FUNCION PARA DISMINUIR CANTIDAD EN LISTADO DE PRODUCTOS
  $(document).on("click", ".btnDisminuir", function () {
    var data = tablaProductos.row($(this).parents("tr")).data();
    var idx = tablaProductos.row($(this).parents("tr")).index();
    var codigo_producto = data[1];
    var cantidad = data[3] - 1;
          tablaProductos.cell(idx, 3).data(cantidad).draw();
          nuevoPrecio = parseFloat(data[3] * data[4]).toFixed(2);
          tablaProductos.cell(idx, 5).data(nuevoPrecio).draw();
          fnc_recalcularTotales();
  });
  // INICIO ELIMINAR UN PRODUCTO DEL DETALLE DE VENTA
  $(document).on("click", ".btnEliminar", function () {
    tablaProductos.row($(this).parents("tr")).remove().draw();
    fnc_recalcularTotales();
  });
  // FIN ELIMINAR UN PRODUCTO DEL DETALLE DE VENTA
  // INICIO CAMBIO DE PRECIO DE UN PRODUCTO DEL DETALLE DE VENTA
  $(document).on("click", ".btnCambiarPrecio", function () {
    var data = tablaProductos.row($(this).parents("tr")).data();
    Swal.fire({
      title: "",
      text: "Precio con descuento",
      input: "text",
      width: "300",
      confirmButtonText:'Aceptar',
      showCancelButton: true,
    }).then((result)=>{
      precio= result.value
      var idx = tablaProductos.row($(this).parents("tr")).index();
        tablaProductos.cell(idx, 4).data(precio).draw();
        nuevoPrecio = parseFloat(data[3] * data[4]).toFixed(2);
        tablaProductos.cell(idx, 5).data(nuevoPrecio).draw();
        fnc_recalcularTotales();
    })
  })
  // FIN CAMBIO DE PRECIO DE UN PRODUCTO DEL DETALLE DE VENTA
  //  RECALCULAR TOTALES
  function fnc_recalcularTotales() {
    var TotalVenta = 0;
    tablaProductos
      .rows()
      .eq(0)
      .each(function (index) {
        var row = tablaProductos.row(index);
        var data = row.data();
        TotalVenta = parseFloat(TotalVenta) + parseFloat(data[5]);
        document.querySelector("#totalVenta").innerHTML = "Total Venta $ " + TotalVenta;
        document.querySelector("#codigoProductoVenta").value = "";
        document.querySelector("#codigoProductoVenta").focus;
      });
  }

  // VACIAR LISTADO DE PRODUCTOS DE VENTA
  document
    .querySelector("#btnVaciarListado")
    .addEventListener("click", function () {
      fnc_vaciarListado();
    });
  // FUNCION PARA VACIAR LISTADO DE PRODUCTOS
  function fnc_vaciarListado() {
    tablaProductos.clear().draw();
  }
  // REGISTRAR VENTA
  // INICIO FUNCION PARA CARGAR PRODUCTOS AL DETALLE
  function fnc_cargarProductos(producto = "") {
    if (producto != "") {
      var codigo_producto = producto;
    } else {
      var codigo_producto = $("#codigoProductoVenta").val();
    }
    let datos = new FormData
    datos.append('codigo', codigo_producto)
    datos.append('accion', 4)
    TotalVenta = 0;
    itemproducto = 1;
    $.ajax({
      url: "ajax/productos.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function (respuesta) {
        var TotalVenta = 0;
        tablaProductos.row
          .add([
            itemproducto,
            respuesta["producto_codigo"],
            respuesta["producto_nombre"],
            respuesta["cantidad"],
            respuesta["producto_precio_venta"],
            respuesta["total"],
            "<center>" +
              "<button class='btn btn-primary btnAumentar'>" +
              "<i class = 'fa fa-plus'></i>" +
              "</button>" + 
              " " +
              "<button class='btn btn-success btnDisminuir'>" +
              "<i class = 'fa fa-minus'></i>" +
              "</button>" +
              " " +
              "<button class='btn btn-danger btnCambiarPrecio'>" +
              "<i class = 'fas fa-comment-dollar'></i>" +
              "</button>" +
              " "+
              "<button class='btn btn-danger btnEliminar'>" +
              "<i class = 'fa fa-trash'></i>" +
              "</button>" +
              "</center>" ,
          ])
          .draw();
        itemproducto = itemproducto + 1;
        tablaProductos
          .rows()
          .eq(0)
          .each(function (index) {
            var row = tablaProductos.row(index);
            var data = row.data();
            fnc_recalcularTotales();
            // TotalVenta = parseFloat(TotalVenta) + parseFloat(data[5].replace())
            // totalVenta =TotalVenta
            // document.querySelector("#totalVenta").innerHTML = "Total Venta $. " + TotalVenta
            // document.querySelector("#codigoProductoVenta").value = "";
            // document.querySelector("#codigoProductoVenta").focus;
          });
      },
    });
 
  }
  // FIN FUNCION PARA CARGAR PRODUCTOS AL DETALLE
  // GUARDAR VENTA
  document
    .querySelector("#btnRegistrarVenta")
    .addEventListener("click", function () {
      var count = 0
      var totalVenta = $("#totalVenta").html()
      alert(totalVenta)
    tablaProductos.rows().eq(0).each(function () {
      count = count+1
    })
    if (count >0) {
      if ($("#efectivoVenta").value > 0 && $("#efectivoVenta").value !="") {
        if ($("#efectivoVenta").val() < parseFloat(totalVenta) ) {
          toast.fire({
            icon:"warning",
            title:"El efectivo es menor que el valor de la venta"
          })
          return false
        }else{
          var datos = new FormData()
        var arr = []
        tablaProductos.rows().eq(0).each(function (index) {
          var row = tablaProductos.row(index)
          var data = row.data();
          arr[index] = data['producto_codigo'] + "" + data['producto_nombre']+""+data['total']
          datos.append('arr[]',arr[index])
        })
        datos.append("numero", numero);
        datos.append("cliente", cliente);
        datos.append("total", parseFloat(totalVenta));
        datos.append("pago", pago);
        datos.append("comprobante", comprobante);
        $.ajax({
          url: "ajax/ventas.ajax.php",
          method: "POST",
          data: datos,
          cache: false,
          contentType: false,
          processData: false,
          dataType: 'json',
          success: function (respuesta) {
            fnc_vaciarListado();
            fnc_cargarNumeroVenta();
            window.open("http://localhost/sispos/vistas/generar_ticket.php?numero=" + numero)
            Swal.fire({
              text: respuesta,
              icon: "confirm",
            });
           
          },
        });
        }
        

      }
    }else{
      Swal.fire({
        text: "Detalle Venta Vacio",
        target: "#custom-target",
        customClass: {
          container: "position-absolute",
        },
        toast: true,
        position: "top-end",
      });
    return false;  
    }
     
    });

    document.querySelector("#efectivoVenta").addEventListener("blur", function () {
       efectivo = document.querySelector("#efectivoVenta").value
      //  valor =  document.querySelector("#valorVenta").value;
      //  devolucion = efectivo -  valor
       document.querySelector("#efectivoVenta").value = parseFloat(efectivo).toFixed(2)
      //  document.querySelector("#devolucionVenta").value = parseFloat(devolucion).toFixed(2)
    })
    // INICIO MODAL LISTADO DE PRODUCTOS
    document.querySelector("#btnListadoProductos").addEventListener("click", function () {
      $("#modalProductosVenta").modal("show")
      $("#tituloListadoProductos").html("Busquedad de Productos")
    })
    // FIN MODAL LISTADO DE PRODUCTOS
    // INICIO TABLA LISTADO DE PRODUCTOS
     tabla =  $("#tblListadoProductos").DataTable({
      ajax: {
        async: true,
          serverside: true,
          url: "ajax/productos.ajax.php",
          type: "POST",
          dataSrc: "",
        },
        columnDefs: [
          {
            targets: 0,
            width:"50px",
          },
          {
            targets: 1,
            width:"50px",
          },
          {
            targets: 2,
            width: "50px",
            defaultContent:
              "<button class='btn btn-primary btn-sm btnSeleccionar'><i class='fas fa-check'></i></button>",
            data: null,
          },
        ],
        columns: [
          { data: "producto_codigo" },
          { data: "producto_nombre"},
        ],
        dom:'lfrtip',
        language: {
          url: ".../Spanish.json",
        },
  });
    // FIN TABLA LISTADO DE PRODUCTOS
    // INICIO FUNCION DE SELECCIONAR PRODUCTO
    $(document).on("click", ".btnSeleccionar", function () {
      var data = tabla.row($(this).parents("tr")).data();
      document.querySelector("#codigoProductoVenta").value = data[1]
    });
    // FIN FUNCION DE SELECCIONAR PRODUCTO
  function fnc_registrarVenta() {
    numero = document.querySelector("#numeroVenta").value;
    cliente = document.querySelector("#clienteVenta").value;
    total = totalVenta;
    pago = document.querySelector("#pagoVenta").value;
    comprobante = document.querySelector("#comprobanteVenta").value;
    if (cliente == null || cliente == 0) {
      Swal.fire({
        text: "Digite Cliente",
        target: "#custom-target",
        customClass: {
          container: "position-absolute",
        },
        toast: true,
        position: "top-end",
      });
      return false;
    }
    if (pago == null || pago == 0) {
      Swal.fire({
        text: "Seleccione Forma de Pago",
        target: "#custom-target",
        customClass: {
          container: "position-absolute",
        },
        toast: true,
        position: "top-end",
      });
      return false;
    }
    if (
      parseFloat(
        document.querySelector("#efectivoVenta").value <
          parseFloat("#TotalVenta").value
      )
    ) {
      Swal.fire({
        text: "Efectivo es menor",
        target: "#custom-target",
        customClass: {
          container: "position-absolute",
        },
        toast: true,
        position: "top-end",
      });
      return false;
    }
    Swal.fire({
      title: "CONFIRMAR",
      text: "Seguro desea registrar la Venta ?",
      icon: "info",
      showCancelButton: true,
      confirmButtonText: "Si, deseo Registrar",
    }).then((result) => {
      if (result.isConfirmed) {
        let datos = new FormData();
        tablaProductos.rows().eq(0).each(function (index) {
          var arr = []
            var row = tablaProductos.row(index);
            var data = row.data();
            arr[index] = data[1] + "," + data[3] + "," + data[4];
            datos.append('arr[]', arr[index]);
          });
        datos.append("numero", numero);
        datos.append("cliente", cliente);
        datos.append("total", totalVenta);
        datos.append("pago", pago);
        datos.append("comprobante", comprobante);
        $.ajax({
          url: "ajax/ventas.ajax.php",
          method: "POST",
          data: datos,
          cache: false,
          contentType: false,
          processData: false,
          dataType: 'json',
          success: function (respuesta) {
            fnc_vaciarListado();
            fnc_cargarNumeroVenta();
            window.open("http://localhost/sispos/vistas/generar_ticket.php?numero=" + numero)
            Swal.fire({
              text: respuesta,
              icon: "confirm",
            });
           
          },
        });
      }
    });
  }

  function fnc_cargarNumeroVenta() {
    $.ajax({
      async: false,
      url: "ajax/ventas.ajax.php",
      method: "POST",
      data: {
        'accion': 1
      },
      dataType: "json",
      success: function (respuesta) {
        numero = respuesta["numero"];
        document.querySelector("#numeroVenta").value = numero + 1;
        $("#totalVenta").html("Total Venta $. 0.00");
      },
    });
  }
});
// CREAR NUMERO DE FACTURA


