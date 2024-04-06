$(document).ready(function () {

    //  CARGAR TIPOS DE UNIDAD
       
      let accion = ""
      let tabla =  $("#tblClientes").DataTable({
          ajax: {
              serverside: true,
              url: "ajax/clientes.ajax.php",
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
                width:"100px",
              },
              {
                targets: 4,
                width: "100px",
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
                width: "50px",
                defaultContent:
                  "<button class='btn btn-warning btn-sm btnEditar'><i class='fas fa-edit'></i></button>",
                data: null,
              },
            ],
            columns: [
              { data: "cliente_id" },
              { data: "cliente_numero_documento" },
              { data: "cliente_nombres"},
              { data: "cliente_direccion"},
              { data: "cliente_telefono"},
              { data: "cliente_ciudad"},
              { data: "cliente_correo"},
            ],
            dom:'Bfrtip',
            language: {
              url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
            },
      });
     
      document.querySelector("#btnAdicionarCliente").addEventListener("click", function () {
        accion = 1
        document.querySelector("#cabeceraCliente").setAttribute("style", "background-color:darkblue")
        document.querySelector("#tituloCliente").innerHTML = "Nuevo Cliente";
        document.querySelector("#btnGuardarCliente").innerHTML = "Guardar"
      })
      
      document.querySelector("#btnCancelarCliente").addEventListener("click", function () {
        document.querySelector("#frmClientes").reset()        
      })

      document.querySelector("#btnGuardarCliente").addEventListener("click", function () {
        id = document.querySelector("#idCliente").value
        documento = document.querySelector("#documentoCliente").value
        nombres = document.querySelector("#nombresCliente").value 
        direccion = document.querySelector("#domicilioCliente").value
        telefono = document.querySelector("#telefonoCliente").value
        ciudad = document.querySelector("#ciudadCliente").value
        correo = document.querySelector("#correoCliente").value
        if (documento == null || documento.length == 0) {
          Swal.fire({
            text: "Ingrese Documento del Cliente",
            target: "#custom-target",
            customClass: {
              container: "position-absolute",
            },
            toast: true,
            position: "bottom-right",
          });
        return false;  
        }
        if (nombres == null || nombres.length == 0) {
          Swal.fire({
            text: "Ingrese Nombres del Cliente",
            target: "#custom-target",
            customClass: {
              container: "position-absolute",
            },
            toast: true,
            position: "bottom-right",
          });
        return false;  
        }
        if (telefono == null || telefono.length == 0) {
          Swal.fire({
            text: "Ingrese Precio de Venta del Producto",
            target: "#custom-target",
            customClass: {
              container: "position-absolute",
            },
            toast: true,
            position: "bottom-right",
          });
        return false;
        }
        if (ciudad == null || ciudad.length == 0) {
          Swal.fire({
            text: "Ingrese Ciudad del Cliente",
            target: "#custom-target",
            customClass: {
              container: "position-absolute",
            },
            toast: true,
            position: "bottom-right",
          });
        return false;
        }
        if (direccion == null || direccion.length == 0) {
          Swal.fire({
            text: "Ingrese Direccion del Cliente",
            target: "#custom-target",
            customClass: {
              container: "position-absolute",
            },
            toast: true,
            position: "bottom-right",
          });
        return false;  
        }else{
          Swal.fire({
            title: "CONFIRMAR",
            text: "Seguro desea registrar el Cliente ?",
            icon: "info",
            showCancelButton: true,
            confirmButtonText: "Si, deseo Registrar",
          }).then((result) => {
            if (result.isConfirmed) {
              let datos = new FormData();
              datos.append("id", id);
              datos.append("documento", documento)
              datos.append("nombres", nombres)
              datos.append("direccion", direccion)
              datos.append("telefono", telefono)
              datos.append("ciudad", ciudad)
              datos.append("correo", correo)
              datos.append("accion", accion)
              $.ajax({
                url: "ajax/clientes.ajax.php",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                success: function (respuesta) {
                  //    console.log(respuesta);
                  $("#modalCliente").modal("hide");
                  tabla.ajax.reload(null, false);
                    document.querySelector("#frmClientes").reset()
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
      document.querySelector("#cerrarCliente").addEventListener("click", function () {
        document.querySelector("#frmClientes").reset()        
      })
      
      $(document).on("click", ".btnEditar", function () {
        accion = "editar";
        $("#modalCliente").modal("show");
        let data = tabla.row($(this).parents("tr")).data();
        document.querySelector("#cabeceraCliente").setAttribute("style", "background-color:darkgreen")
        document.querySelector("#tituloCliente").innerHTML = "Actualizar Cliente";
        document.querySelector("#btnGuardarCliente").innerHTML = "Actualizar";
        document.querySelector("#idCliente").value = data["cliente_id"]
        document.querySelector("#documentoCliente").value = data["cliente_numero_documento"]
        document.querySelector("#nombresCliente").value = data["cliente_nombres"]
        document.querySelector("#domicilioCliente").value = data["cliente_direccion"]
        document.querySelector("#telefonoCliente").value = data["cliente_telefono"]
        document.querySelector("#ciudadCliente").value = data["cliente_ciudad"]
        document.querySelector("#correoCliente").value = data["cliente_correo"]
      })
  });

  function validarCliente() {
    var documento = document.querySelector("#documentoCliente").value
    let datos = new FormData();
    datos.append("documento", documento);
    datos.append("accion", "validar")
    $.ajax({
      url: "ajax/clientes.ajax.php",
      type: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function (respuesta) {
        if (respuesta[0] > 0) {
          Swal.fire({
            text: "Cliente ya Registrado",
            target: "#custom-target",
            customClass: {
              container: "position-absolute",
            },
            toast: true,
            icon: "error",
            position: "top-end",
          });
          document.querySelector("#documentoCliente").value = ""
          return false
        }
      },
    });
  }