$(document).ready(function () {
  let accion = "";
  let tabla = $("#tblDetalleVentas").DataTable({
    ajax: {
      destroy: true,
      responsive: true,
      serverside: true,
      url: "ajax/detalleVentas.ajax.php",
      type: "POST",
      dataSrc: "",
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
        width: "100px",
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
      {
        targets: 6,
        width: "50px",
        defaultContent:
          "<button class='btn btn-danger btn-sm btnEliminar'><i class = 'fas fa-trash'></></button>"+
          " " +
          "<button class='btn btn-success btn-sm btnAumentar'><i class = 'fas fa-plus'></></button>"+
          " " +
          "<button class='btn btn-primary btn-sm btnDisminuir'><i class = 'fas fa-delete'></></button>",
        data: null,
      },
    ],
    columns: [
      { data: "id_detalle" },
      { data: "producto_detalle" },
      { data: "producto_nombre" },
      { data: "precio_detalle" },
      { data: "cantidad_detalle" },
      { data: "total_detalle"}
    ],
    language: {
      url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
    },
  });

  document.querySelector("#btnVaciarListado").addEventListener("click", function () {
      Swal.fire({
        title: "Desea eliminar el listado?",
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: "Eliminar",
        denyButtonText: `No Eliminar`,
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
          let datos = new FormData();
          datos.append("accion", "vaciar");
          $.ajax({
            url: "ajax/detalleventas.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            success: function (respuesta) {
              tabla.ajax.reload();
            },
          });
        }
      });
     
    });

  document.querySelector("#iptCodigoProducto").addEventListener("blur", function (e) {
      codigo = document.querySelector("#iptCodigoProducto").value;
      if (codigo == null || codigo == 0) {
        Swal.fire({
          text: "Ingrese Codigo del Producto",
          target: "#custom-target",
          customClass: {
            container: "position-absolute",
          },
          toast: true,
          position: "bottom-right",
        });
        return false;
      }
      let datos = new FormData();
      datos.append("codigo", codigo);
      datos.append("accion", "validar");
      $.ajax({
        url: "ajax/productos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function (respuesta) {
          var data = JSON.parse(respuesta);
          if (data.length == 0) {
            swal.fire("Producto No Registrado");
            document.querySelector("#iptCodigoProducto").value = "";
            return false;
          } else {
            datos.append("accion", "buscar");
            $.ajax({
              url: "ajax/productos.ajax.php",
              method: "POST",
              data: datos,
              cache: false,
              contentType: false,
              processData: false,
              success: function (respuesta) {
                var data = JSON.parse(respuesta);
                datos.append("codigo", data[0].producto_codigo);
                datos.append("precio", data[0].producto_precio_venta);
                datos.append("accion", "agregar");
                $.ajax({
                  url: "ajax/detalleVentas.ajax.php",
                  method: "POST",
                  data: datos,
                  cache: false,
                  contentType: false,
                  processData: false,
                  success: function (respuesta) {
                    document.querySelector("#frmVentas").reset();
                    tabla.ajax.reload();
                  },
                });
              },
            });
          }
        },
      });
     
     
    });


    document.querySelector("#iptCodigoProducto").addEventListener("keyup",function name(params) {
      
    })
    $(document).on("click", ".btnEliminar", function () {
          let data = tabla.row($(this).parents("tr")).data();
          let datos = new FormData();
          datos.append("id", data["id_detalle"])
          datos.append("accion", "eliminar");
          $.ajax({
            url: "ajax/detalleventas.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            success: function (respuesta) {
              tabla.ajax.reload();
            },
          });
        })

    $(document).on("click", ".btnAumentar", function () {
      // accion = "aumentar";
      $("#modalCantidad").modal("show");
      // let data = tabla.row($(this).parents("tr")).data();
      // document.querySelector("#titulo").innerHTML = "Actualizar Cantidad";
      // document.querySelector("#btnGuardarCantidad").innerHTML = "Aumentar";
      // document.querySelector("#idDetalle").value = data["id_detalle"]
     
    })
});
