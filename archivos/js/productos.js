$(document).ready(function () {

  //  CARGAR TIPOS DE UNIDAD
    // $.ajax({
    //   serverside: true,
    //   url: "ajax/medidas.ajax.php",
    //   cache: false,
    //   contentType: false,
    //   dataType: "json",
    //   success: function (respuesta) {
    //     let options = '<option selected value="0">Seleccione</option>';
    //     for (let index = 0; index < respuesta.length; index++) {
    //       options =
    //         options +
    //         "<option value =" +
    //         respuesta[index][0] +
    //         ">" +
    //         respuesta[index][1] +
    //         "</option>";
    //     }
    //     $("#medidaProducto").html(options);
    //   },
    // });
    // CARGAR CATEGORIAS
    $.ajax({
      serverside: true,
      url: "ajax/categorias.ajax.php",
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
        $("#categoriaProducto").html(options);
      },
    });

    let accion = ""
    let tabla =  $("#tblProductos").DataTable({
        ajax: {
            serverside: true,
            url: "ajax/productos.ajax.php",
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
              width:"150px",
            },
            {
              targets: 2,
              width:"150px",
            },
            {
              targets: 3,
              visible: false,
            },
            {
              targets: 4,
              width:"100px",
            },
            {
              targets: 5,
              width:"100px",
            },
            {
              targets: 6,
              width:"100px",
            },
            {
              targets: 7,
              width:"100px",
            },
            {
              targets: 8,
              width:"100px",
            },
            {
              targets: 9,
              sortable: false,
              render: function (data, type, full, meta) {
                  if (data == 1) {
                    return "<span class='badge badge-primary'>Si</span>";
                  } else {
                    return "<span class='badge badge-secondary'>No</span>";
                  }
              },
            },
            {
              targets: 10,
              width: "100px",
              defaultContent:
                "<button class='btn btn-warning btn-sm btnEditar'><i class='fa fa-pencil-square'></i></button>"+
                " " +
                "<button class='btn btn-primary btn-sm btnAumentarStock'><i class='fa fa-plus'></i></button>"+
                " " +
                "<button class='btn btn-success btn-sm btnDisminuirStock'><i class='fa fa-minus'></i></button>",
              data: null,
            },
          ],
          columns: [
            { data: "producto_id" },
            { data: "producto_codigo"},
            { data: "producto_nombre" },
            { data: "producto_categoria"},
            { data: "categoria_nombre"},
            { data: "producto_stock_total"},
            { data: "producto_minimo"},
            { data: "producto_precio_compra"},
            { data: "producto_precio_venta"},
            { data: "producto_inventario"}
          ],
          dom:'Bfrtip',
          language: {
            url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
          },
    });

    let tablaMinimo =  $("#tblProductosMinimo").DataTable({
      ajax: {
          serverside: true,
          url: "ajax/productos.ajax.php",
          type: "POST",
          dataSrc: "",
          data:{
            accion : 6
          },
        },
        columnDefs: [
          {
            targets: 0,
            visible: false,
          },
          {
            targets: 1,
            width:"100px",
          },
          {
            targets: 2,
            width: "100px",
          },
          {
            targets: 3,
            visible: false,
          },
          {
            targets: 4,
            width:"100px",
          },
          {
            targets: 5,
            width:"100px",
          },
        ],
        columns: [
          { data: "producto_id" },
          { data: "producto_codigo"},
          { data: "producto_nombre" },
          { data: "producto_categoria"},
          { data: "categoria_nombre"},
          { data: "producto_stock_total"},
        ],
        dom: "Bftrip",
        language: {
          url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
        },
  });
   
    document.querySelector("#btnAdicionarProducto").addEventListener("click", function () {
      accion = 1
       document.querySelector("#cabeceraProducto").setAttribute("style","background-color:royalblue")
       document.querySelector("#tituloProducto").innerHTML = "Nuevo Articulo";
       document.querySelector("#btnGuardarProducto").innerHTML = "Guardar"
    })
    
    document.querySelector("#btnGuardarProducto").addEventListener("click", function () {
      id = document.querySelector("#idProducto").value
      codigo = document.querySelector("#codigoProducto").value
      descripcion = document.querySelector("#descripcionProducto").value
      categoria = document.querySelector("#categoriaProducto").value
      stock = document.querySelector("#stockProducto").value
      costo = document.querySelector("#costoProducto").value
      venta = document.querySelector("#ventaProducto").value
      minimo = document.querySelector("#minimoProducto").value
      inventario = document.querySelector("#inventarioProducto").value
      if (codigo == null || codigo.length == 0) {
        Swal.fire({
          text: "Ingrese Codigo de barras del Producto",
          target: "#custom-target",
          customClass: {
            container: "position-absolute",
          },
          toast: true,
          position: "top-end",
        });
      return false;  
      }
      if (descripcion == null || descripcion.length == 0) {
        Swal.fire({
          text: "Ingrese Descripcion del Producto",
          target: "#custom-target",
          customClass: {
            container: "position-absolute",
          },
          toast: true,
          position: "top-end",
        });
      return false;  
      }
      if (costo == null || costo.length == 0) {
        Swal.fire({
          text: "Ingrese Precio de Compra del Articulo",
          target: "#custom-target",
          customClass: {
            container: "position-absolute",
          },
          toast: true,
          position: "top-end",
        });
      return false;  
      }
      if (venta == null || venta.length == 0) {
        Swal.fire({
          text: "Ingrese Precio de Venta del Articulo",
          target: "#custom-target",
          customClass: {
            container: "position-absolute",
          },
          toast: true,
          position: "top-end",
        });
      return false;  
      }
      if (inventario == null || inventario == 0) {
        Swal.fire({
          text: "Seleccione Control de Inventario del Articulo",
          target: "#custom-target",
          customClass: {
            container: "position-absolute",
          },
          toast: true,
          position: "top-end",
        });
      return false;  
      }else{
        Swal.fire({
          title: "CONFIRMAR",
          text: "Seguro desea registrar el Articulo ?",
          icon: "info",
          showCancelButton: true,
          confirmButtonText: "Si, deseo Registrar",
        }).then((result) => {
          if (result.isConfirmed) {
            let datos = new FormData();
            datos.append("id", id);
            datos.append("codigo", codigo)
            datos.append("descripcion", descripcion)
            datos.append("categoria", categoria)
            datos.append("stock", stock)
            datos.append("costo", costo)
            datos.append("venta", venta)
            datos.append("minimo", minimo)
            datos.append("inventario", inventario)
            datos.append("accion", accion)
            $.ajax({
              url: "ajax/productos.ajax.php",
              method: "POST",
              data: datos,
              cache: false,
              contentType: false,
              processData: false,
              success: function (respuesta) {
                //    console.log(respuesta);
                $("#modalProducto").modal("hide");
                tabla.ajax.reload(null, false);
                  document.querySelector("#idProducto").value = ""
                  document.querySelector("#codigoProducto").value = ""
                  document.querySelector("#descripcionProducto").value = ""
                  document.querySelector("#stockProducto").value = ""
                  document.querySelector("#costoProducto").value = ""
                  document.querySelector("#ventaProducto").value = ""
                  document.querySelector("#minimoProducto").value = ""
                Swal.fire({
                  text: respuesta,
                  icon: "confirm"
                });
              },
            });
          }
        });
      }
    })
    
    document.querySelector("#btnCancelarProducto").addEventListener("click", function () {
      document.querySelector("#frmProductos").reset()
    })

    document.querySelector("#cerrarProductos").addEventListener("click", function () {
      document.querySelector("#frmProductos").reset()
    })

    $(document).on("click", ".btnEditar", function () {
      accion = 2;
      $("#modalProducto").modal("show");
      let data = tabla.row($(this).parents("tr")).data();
      document.querySelector("#cabeceraProducto").setAttribute("style","background-color:darkgreen")
      document.querySelector("#tituloProducto").innerHTML = "Actualizar Articulo";
      document.querySelector("#btnGuardarProducto").innerHTML = "Actualizar";
      document.querySelector("#idProducto").value = data["producto_id"]
      document.querySelector("#codigoProducto").value = data["producto_codigo"]
      document.querySelector("#descripcionProducto").value = data["producto_nombre"]
      document.querySelector("#categoriaProducto").value = data["producto_categoria"]
      document.querySelector("#stockProducto").value = data["producto_stock_total"]
      document.querySelector("#costoProducto").value = data["producto_precio_compra"]
      document.querySelector("#ventaProducto").value = data["producto_precio_venta"]
      document.querySelector("#minimoProducto").value = data["producto_minimo"]
      document.querySelector("#inventarioProducto").value = data["producto_inventario"]
    })

    document.querySelector("#btnExportarProductos").addEventListener("click", function () {
     $("table").tableExport({
        formats: ["xlsx"],
        position: 'button',
        bootstrap: false,
        filename: "ListadoProductos",
     })
    })
    
    document.querySelector("#categoriaProducto").addEventListener("blur", function () {
      obtenerCodigo();
    })

    document.querySelector("#ventaProducto").addEventListener("blur", function () {
       costo = parseFloat(document.querySelector("#costoProducto").value)
       venta = parseFloat(document.querySelector("#ventaProducto").value)
       if (costo >= venta) {
        Swal.fire({
          text: "Precio de Venta No Valido",
          target: "#custom-target",
          customClass: {
            container: "position-absolute",
          },
          toast: true,
          position: "top-end",
        });
        document.querySelector("#ventaProducto").value = ""
        return false 
       }
    })

    $(document).on("click", ".btnAumentarStock",function () {
      accion = 11
      $("#modalStock").modal("show")
      let data = tabla.row($(this).parents("tr")).data();
      document.querySelector("#tituloStock").innerHTML = "Aumentar Stock"
      document.querySelector("#btnGuardarStock").innerHTML = "Aumentar"
      document.querySelector("#idProductoStock").value = data[0]
      document.querySelector("#codigoStock").innerHTML = "Codigo :" + data['producto_codigo']
      document.querySelector("#descripcionStock").innerHTML = "Descripción :" + data["producto_nombre"]
      document.querySelector("#totalStock").innerHTML = "Saldo Actual :" + data['producto_stock_total']
      document.querySelector("#cabeceraStock").setAttribute('style', 'background-Color: narvu')
      document.querySelector("cantidadStock").attributes("placeholder","Ingrese Cantidad a agregar al Stock")
    })
    
    $(document).on("click", ".btnDisminuirStock",function () {
      accion = 12
      $("#modalStock").modal("show")
      let data = tabla.row($(this).parents("tr")).data();
      document.querySelector("#tituloStock").innerHTML = "Disminuir Stock"
      document.querySelector("#btnGuardarStock").innerHTML = "Disminuir"
      document.querySelector("#idProductoStock").value = data[0]
      document.querySelector("#codigoStock").innerHTML = "Codigo :" + data['producto_codigo']
      document.querySelector("#descripcionStock").innerHTML = "Descripcion :" + data["producto_nombre"]
      document.querySelector("#totalStock").innerHTML = data['producto_stock_total']
      document.querySelector("#cabeceraStock").setAttribute('style', 'background-Color: darkred')
    })

   document.querySelector("#btnGuardarStock").addEventListener("click", function () {
      id = document.querySelector("#idProductoStock").value
      cantidad = document.querySelector("#cantidadStock").value
      if (cantidad == 0 && cantidad.length== 0) {
          Swal.fire({
            text: "Ingrese Cantidad para continuar",
            target: "#custom-target",
            customClass: {
              container: "position-absolute",
            },
            toast: true,
            position: "top-end",
          });
        return false;  
      }else{
        Swal.fire({
          title: "CONFIRMAR",
          text: "Seguro desea confirmar cantidad de Stock?",
          icon: "info",
          showCancelButton: true,
          confirmButtonText: "Si, deseo Registrar",
        }).then((result) => {
          if (result.isConfirmed) {
            let datos = new FormData();
            datos.append("id", id);
            datos.append("cantidad", cantidad)
            datos.append("accion", accion)
            $.ajax({
              url: "ajax/productos.ajax.php",
              method: "POST",
              data: datos,
              cache: false,
              contentType: false,
              processData: false,
              success: function (respuesta) {
                //    console.log(respuesta);
                $("#modalStock").modal("hide");
                tabla.ajax.reload(null, false);
                 document.querySelector("#frmStock").reset()
                Swal.fire({
                  text: respuesta,
                  icon: "confirm"
                });
              },
            });
          }
        });
      }
   })
     
  })

function validarCodigo(control) {
  var codigo = control.value
  let datos = new FormData();
  datos.append("codigo", codigo);
  datos.append("accion", 3)
  $.ajax({
    url: "ajax/productos.ajax.php",
    type: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      if (respuesta[0] > 0) {
        Swal.fire({
          text: "Codigo de barras ya Registrado",
          target: "#custom-target",
          customClass: {
            container: "position-absolute",
          },
          toast: true,
          position: "top-end",
        });
        document.querySelector("#codigoProducto").value = ""
        return false 
      }
    },
  });
}

function obtenerCodigo() {
  var categoria = document.querySelector("#categoriaProducto").value
  let datos = new FormData();
  datos.append("categoria", categoria);
  datos.append("accion", 5)
  $.ajax({
    url: "ajax/productos.ajax.php",
    type: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      referencia = categoria + respuesta[0]
      document.querySelector("#codigoProducto").value = referencia
    },
  });
}