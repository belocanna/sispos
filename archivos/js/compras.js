$(document).ready(function () {
  var tabla, accion,  items, tablaProductos, totalCompra, itemproducto;
  cargarNumeroCompra()

  items =[]
  $.ajax({
    serverSide: true,
    async: false,
    url: "ajax/productos.ajax.php",
    method: "POST",
    data: {
      "accion": 7,
    },
    dataType: "json",
    success: function (respuesta) {
      for (let i = 0; i < respuesta.length; i++) {
        items.push(respuesta[i]["descripcion_producto"]);
      }
      $("#codigoProductoCompra").autocomplete({
        source: items,
        select: function (event, ui) {
          let str = ui.item.value
          let arr= str.split(',')
          console.log(arr[0])
          cargarProductos(arr[0])
          $("#codigoProductoCompra").val
          $("#codigoProductoCompra").focus
          return false
        },
      });
    },
  });  

  tablaProductos = $("#tblProductosCompra").DataTable({
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
    dom: "lrtip",
    paging: false,
    language: {
      url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
    },
  });
  document
  .querySelector("#codigoProductoCompra").addEventListener("blur", function () {
    codigo = document.querySelector("#codigoProductoCompra").value
    let datos = new FormData();
      datos.append("codigo", codigo);
      datos.append("accion", 3);
      $.ajax({
        url: "ajax/productos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
          if (respuesta[0] > 0) {
            cargarProductos(codigo)
          }else{
            Swal.fire({
              text: "Producto No Registrado",
              target: "#custom-target",
              customClass: {
                container: "position-absolute",
              },
              toast: true,
              position: "top-end",
            });
            return false;
          }
        }
      })
  });
  // CREAR NUMERO DE FACTURA
  function cargarNumeroCompra() {
    $.ajax({
      async: false,
      url: "ajax/compras.ajax.php",
      method: "POST",
      data: {
        accion: 1,
      },
      dataType: "json",
      success: function (respuesta) {
        numero = respuesta["numero"];
        document.querySelector("#numeroCompra").value = numero + 1;
        $("#totalCompra").html("Total Compra $. 0.00");
      },
    });
  }

  // FUNCION PARA CARGAR DATOS
  function cargarProductos(producto = "") {
    if (producto != "") {
      var codigo_producto = producto
    } else {
      var codigo_producto = $("#codigoProductoVenta").val()
    }
    TotalCompra = 0;
    itemproducto = 1;
    let datos = new FormData();
    datos.append("codigo", codigo_producto);
    datos.append("accion", 8);
    $.ajax({
      url: "ajax/productos.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function (respuesta) {
        var TotalCompra = 0;
        tablaProductos.row
          .add([
            itemproducto,
            respuesta["producto_codigo"],
            respuesta["producto_nombre"],
            respuesta["cantidad"],
            respuesta["producto_precio_compra"],
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
              "<button class='btn btn-danger btnEliminar'>" +
              "<i class = 'fa fa-trash'></i>" +
              "</button>" +
              "</center>",
          ])
          .draw();
        itemproducto = itemproducto + 1;
        tablaProductos
          .rows()
          .eq(0)
          .each(function (index) {
            var row = tablaProductos.row(index);
            var data = row.data();
            TotalCompra = parseFloat(TotalCompra) + parseFloat(data[5].replace());
            totalCompra = TotalCompra
            document.querySelector("#totalCompra").innerHTML = "Total Compra $" + totalCompra;
           recalcularTotales()
          });

      },
    });
  }
  // FUNCION PARA RECALCULAR  EL DETALLE
  function recalcularTotales() {
    var TotalCompra = 0;
    tablaProductos
      .rows()
      .eq(0)
      .each(function (index) {
        var row = tablaProductos.row(index);
        var data = row.data();
        TotalCompra = parseFloat(TotalCompra) + parseFloat(data[5]);
        document.querySelector("#totalCompra").innerHTML = "Total Compra $ " + TotalCompra;
        document.querySelector("#codigoProductoCompra").value = "";
        document.querySelector("#codigoProductoCompra").focus;
      });
  }
  // FUNCION PARA AUMENTAR CANTIDAD
  $(document).on("click", ".btnAumentar", function () {
    var data = tablaProductos.row($(this).parents("tr")).data();
    var idx = tablaProductos.row($(this).parents("tr")).index();
    var cantidad = data[3] + 1;
          tablaProductos.cell(idx, 3).data(cantidad).draw();
          nuevoPrecio = parseFloat(data[3] * data[4]);
          tablaProductos.cell(idx, 5).data(nuevoPrecio).draw();
          recalcularTotales();
      });
  // FUNCION PARA DISMINUIR EL DETALLE
  $(document).on("click", ".btnDisminuir", function () {
    var data = tablaProductos.row($(this).parents("tr")).data();
    var idx = tablaProductos.row($(this).parents("tr")).index();
    var cantidad = data[3] - 1;
          tablaProductos.cell(idx, 3).data(cantidad).draw();
          nuevoPrecio = parseFloat(data[3] * data[4]);
          tablaProductos.cell(idx, 5).data(nuevoPrecio).draw();
          recalcularTotales();
      });
  // FUNCION PARA ELIMINAR UN PRODUCTO EN LISTADO DE INVENTARIO
  $(document).on("click", ".btnEliminar", function () {
    tablaProductos.row($(this).parents("tr")).remove().draw();
    recalcularTotales();
  });
  document
    .querySelector("#btnVaciarListado")
    .addEventListener("click", function () {
      vaciarListado();
    });
  // FUNCION PARA VACIAR LISTADO DE PRODUCTOS
  function vaciarListado() {
    tablaProductos.clear().draw();
    recalcularTotales()
  }

  document
  .querySelector("#btnRegistrarCompra")
  .addEventListener("click", function () {
    numero = document.querySelector("#numeroCompra").value;
    proovedor = document.querySelector("#proovedorCompra").value;
    total = totalCompra;
    documento = document.querySelector("#documentoCompra").value;
    if (proovedor == null || proovedor == 0) {
      Swal.fire({
        text: "Digite Proovedor",
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
      text: "Seguro desea registrar la Compra ?",
      icon: "info",
      showCancelButton: true,
      confirmButtonText: "Si, deseo Registrar",
    }).then((result) => {
      if (result.isConfirmed) {
        let datos = new FormData();
        tablaProductos
          .rows()
          .eq(0)
          .each(function (index) {
            var arr = [];
            var row = tablaProductos.row(index);
            var data = row.data();
            arr[index] = data[1] + "." + data[3] + "." + data[4];
            datos.append("arr[]", arr[index]);
          });
        datos.append("numero", numero);
        datos.append("proovedor", proovedor);
        datos.append("total", totalCompra);
        datos.append("documento", documento);
        $.ajax({
          url: "ajax/compras.ajax.php",
          method: "POST",
          data: datos,
          cache: false,
          contentType: false,
          processData: false,
          dataType: 'json',
          success: function (respuesta) {
            vaciarListado();
            Swal.fire({
              text: respuesta,
              icon: "confirm",
            });
          },
        });
      }
    });
  });

  document.querySelector("#proovedorCompra").addEventListener("blur", function () {
    documento = document.querySelector("#proovedorCompra").value;
    if (documento == 0 || documento == null) {
      Swal.fire({
        text: "Ingrese Documento del Proovedor",
        target: "#custom-target",
        customClass: {
          container: "position-absolute",
        },
        toast: true,
        position: "top-end",
      });
      return false;
    } else {
      let datos = new FormData();
      datos.append("documento", documento);
      datos.append("accion", 3);
      $.ajax({
        url: "ajax/proovedores.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
          if (respuesta[0] > 0) {
            datos.append("accion", 4);
            $.ajax({
              url: "ajax/proovedores.ajax.php",
              method: "POST",
              data: datos,
              cache: false,
              contentType: false,
              processData: false,
              dataType: "json",
              success: function (respuesta) {
                document.querySelector("#nombresProovedor").innerHTML =
                respuesta[0]['proovedor_nombres']
              },
            });
          } else {
            Swal.fire({
              text: " Documento de Proovedor No Registrado",
              target: "#custom-target",
              customClass: {
                container: "position-absolute",
              },
              toast: true,
              position: "top-end",
            });
            document.querySelector("#proovedorCompra").value = "";
            return false;
          }
        },
      });
    }
  });
})
