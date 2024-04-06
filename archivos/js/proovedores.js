$(document).ready(function () {

    //  CARGAR TIPOS DE DOCUMENTO
  
      
      let accion = ""
      let tabla =  $("#tblProovedores").DataTable({
          ajax: {
              serverside: true,
              url: "ajax/proovedores.ajax.php",
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
                width: "300px",
              },
              {
                targets: 3,
                width: "300px",
              },
              {
                targets: 4,
                width:"100px",
              },
              {
                targets: 5,
                width: "100px",
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
              { data: "proovedor_id" },
              { data: "proovedor_numero_documento" },
              { data: "proovedor_nombres"},
              { data: "proovedor_direccion"},
              { data: "proovedor_telefono"},
              { data: "proovedor_ciudad"},
              { data: "proovedor_correo"},
            ],
            dom:'Bfrtip',
            language: {
              url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
            },
      });
     
      document.querySelector("#btnAdicionarProovedor").addEventListener("click", function () {
        accion = 1
        document.querySelector("#cabeceraProovedor").setAttribute("style","background-color:royalblue")
        document.querySelector("#tituloProovedor").innerHTML = "Nuevo Proovedor";
        document.querySelector("#btnGuardarProovedor").innerHTML = "Guardar"
      })
      
      document.querySelector("#btnGuardarProovedor").addEventListener("click", function () {
        id = document.querySelector("#idProovedor").value
        documento = document.querySelector("#documentoProovedor").value
        nombres = document.querySelector("#nombresProovedor").value 
        direccion = document.querySelector("#domicilioProovedor").value
        telefono = document.querySelector("#telefonoProovedor").value
        ciudad = document.querySelector("#ciudadProovedor").value
        correo = document.querySelector("#correoProovedor").value
        if (documento == null || documento.length == 0) {
          Swal.fire({
            text: "Ingrese Documento del Proovedor",
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
            text: "Ingrese Nombres del Proovedor",
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
            text: "Ingrese Ciudad del Proovedor",
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
            text: "Ingrese Direccion del Proovedor",
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
            text: "Seguro desea registrar el Proovedor ?",
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
              console.log(datos)
              $.ajax({
                url: "ajax/proovedores.ajax.php",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                success: function (respuesta) {
                  $("#modalProovedor").modal("hide");
                    tabla.ajax.reload(null, false);
                    document.querySelector("#idProovedor").value = ""
                    document.querySelector("#documentoProovedor").value = ""
                    document.querySelector("#nombresProovedor").value = ""
                    document.querySelector("#domicilioProovedor").value = ""
                    document.querySelector("#telefonoProovedor").value = ""
                    document.querySelector("#ciudadProovedor").value = ""
                    document.querySelector("#correoProovedor").value = ""
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

      document.querySelector("#btnCancelarProovedor").addEventListener("click", function () {
        document.querySelector("#frmProovedores").reset()
      })
      
      document.querySelector("#cerrarProovedor").addEventListener("click", function () {
        document.querySelector("#frmProovedores").reset()
      })
      $(document).on("click", ".btnEditar", function () {
        accion = 2;
        $("#modalProovedor").modal("show");
        let data = tabla.row($(this).parents("tr")).data();
        document.querySelector("#cabeceraProovedor").setAttribute("style","background-color:darkgreen")
        document.querySelector("#tituloProovedor").innerHTML = "Actualizar Proovedor";
        document.querySelector("#btnGuardarProovedor").innerHTML = "Actualizar";
        document.querySelector("#idProovedor").value = data["proovedor_id"]
        document.querySelector("#documentoProovedor").value = data["proovedor_numero_documento"]
        document.querySelector("#nombresProovedor").value = data["proovedor_nombres"]
        document.querySelector("#domicilioProovedor").value = data["proovedor_direccion"]
        document.querySelector("#telefonoProovedor").value = data["proovedor_telefono"]
        document.querySelector("#ciudadProovedor").value = data["proovedor_ciudad"]
        document.querySelector("#correoProovedor").value = data["proovedor_correo"]
      })
      
      document.querySelector("#documentoProovedor").addEventListener("blur", function () {
        validarProovedor()
      })
    
  });

  function validarProovedor() {
    documento = document.querySelector("#documentoProovedor").value
    let datos = new FormData();
    datos.append("documento", documento);
    datos.append("accion", 3)
    $.ajax({
      url: "ajax/proovedores.ajax.php",
      type: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function (respuesta) {
        if (respuesta[0] > 0) {
          Swal.fire({
            text: "Proovedor ya Registrado",
            target: "#custom-target",
            customClass: {
              container: "position-absolute",
            },
            toast: true,
            icon: "error",
            position: "top-end",
          });
        }
        document.querySelector("#documentoProovedor").value = ""
        return false
      },
    });
  }