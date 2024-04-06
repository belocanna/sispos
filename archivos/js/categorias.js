$(document).ready(function () {
    let accion = "";
  
    // CARGAR SELECT SOLICITANTES  
    let tabla = $("#tblCategorias").DataTable({
      ajax: {
        serverside: true,
        url: "ajax/categorias.ajax.php",
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
          width:"100px",
        },
        {
            targets: 2,
            width:"100px",
          },
        {
          targets: 3,
          width: "50px",
          defaultContent:
            "<button class='btn btn-warning btn-sm btnEditar'><i class='fas fa-edit'></i></button>",
          data: null,
        },
      ],
      columns: [
        { data: "categoria_id" },
        { data: "categoria_nombre" },
        { data: "categoria_ubicacion"}
      ],
      dom:'Bfrtip',
      language: {
        url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
      },
    });
    
    document.querySelector("#btnAdicionarCategoria").addEventListener("click", function () {
        accion = 1
        document.querySelector("#cabeceraCategoria").setAttribute('style','background-color:darkblue')
        document.getElementById("tituloCategoria").innerHTML = "Crear Categoria"
        document.getElementById("btnGuardarCategoria").innerHTML = "Guardar"
    })

    document.querySelector("#btnGuardarCategoria").addEventListener("click", function () {
        id = document.querySelector("#idCategoria").value;
        descripcion = document.querySelector("#descripcionCategoria").value;
        ubicacion = document.querySelector("#ubicacionCategoria").value;
        if (ubicacion == null || ubicacion.length == 0) {
            Swal.fire({
                text: "Ingrese Ubicacion de la Categoria",
                target: "#custom-target",
                customClass: {
                  container: "position-absolute",
                },
                toast: true,
                position: "bottom-right",
              });
            return false;  
            
        }
        if (descripcion == null || descripcion.length == 0) {
            Swal.fire({ 
                text: "Ingrese descripcion de la Categoria",
                target: "#custom-target",
                customClass: {
                  container: "position-absolute",
                },
                toast: true,
                position: "bottom-right",
              });
              return false;  
        } else {
            Swal.fire({
                title: "CONFIRMAR",
                text: "Seguro desea registrar la Categoria ?",
                icon: "info",
                showCancelButton: true,
                confirmButtonText: "Si, deseo Registrar",
              }).then((result) => {
                if (result.isConfirmed) {
                  let datos = new FormData();
                  datos.append("id", id);
                  datos.append("descripcion", descripcion);
                  datos.append("ubicacion", ubicacion);
                  datos.append("accion", accion);
                  $.ajax({
                    url: "ajax/categorias.ajax.php",
                    method: "POST",
                    data: datos,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (respuesta) {
                      //    console.log(respuesta);
                      $("#modalCategoria").modal("hide");
                      tabla.ajax.reload(null, false);
                      document.querySelector("#frmCategorias").reset();
                      // document.querySelector("#descripcionCategoria").value = "";
                      // document.querySelector("#ubicacionCategoria").value = "";
                      Swal.fire(respuesta);
                    },
                  });
                }
              });
        }
    })

    document.querySelector("#btnCancelarCategoria").addEventListener("click", function () {
      document.querySelector("#frmCategorias").reset()
    })

    document.querySelector("#cerrarCategorias").addEventListener("click", function () {
      document.querySelector("#frmCategorias").reset()
    })
    $(document).on("click", ".btnEditar", function () {
      accion = 2;
      $("#modalCategoria").modal("show");
      let data = tabla.row($(this).parents("tr")).data();
      document.querySelector("#cabeceraCategoria").setAttribute('style','background-color:darkgreen')
      document.querySelector("#tituloCategoria").innerHTML = "Actualizar Categoria";
      document.querySelector("#btnGuardarCategoria").innerHTML = "Actualizar";
      document.querySelector("#idCategoria").value = data["categoria_id"];
      document.querySelector("#descripcionCategoria").value = data["categoria_nombre"];
      document.querySelector("#ubicacionCategoria").value = data["categoria_ubicacion"];
    })

  });