$(document).ready(function () {
    let accion = "";
    
    let tabla = $("#tblCajas").DataTable({
      
      ajax: {
        serverside: true,
        url: "ajax/cajas.ajax.php",
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
          width:"200px",
        },
        {
          targets: 2,
          width:"200px",
          sortable: false,
          render: function (data, type, full, meta) {
              if (data == 1) {
                return "<button class='btn btn-success btn-sm btnDelete'> Abierta</button>";
              } else {
                return "<button class='btn btn-danger btn-sm btnDelete'> Cerrada</button>";
              }
          },
        },
      ],
      columns: [
        { data: "caja_id" },
        { data: "caja_nombre" },
        { data: "caja_estado"},
        // {
        //   defaultContent:
        //     "<button class='btn btn-danger btn-sm btnCortar'>Cortar</button>",
        // },
      ],
      dom:'Bfrtip',
      buttons: [
            'excel','pdf','copy'         
      ],
      language: {
        url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
      },
    });
    
    document.querySelector("#btnAdicionarCaja").addEventListener("click", function () {
        accion = 1
        document.querySelector("#cabeceraCaja").setAttribute('style', 'background-Color: darkblue')
        document.querySelector("#tituloCaja").innerHTML = "Crear Caja"
        document.querySelector("#btnGuardarCaja").innerHTML = "Guardar"
    })

    document.querySelector("#btnGuardarCaja").addEventListener("click", function () {
        id = document.querySelector("#idCaja").value;
        descripcion = document.querySelector("#descripcionCaja").value;
        if (descripcion == null || descripcion.length == 0) {
            Swal.fire({ 
                text: "Ingrese descripcion de la Caja",
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
                text: "Seguro desea registrar la Caja ?",
                icon: "info",
                showCancelButton: true,
                confirmButtonText: "Si, deseo Registrar",
              }).then((result) => {
                if (result.isConfirmed) {
                  $.ajax({
                    url: "ajax/cajas.ajax.php",
                    method: "POST",
                    data: {
                      'id':id,
                      'descripcion': descripcion,
                      'accion':accion
                    },
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (respuesta) {
                      //    console.log(respuesta);
                      $("#modalCaja").modal("hide");
                      tabla.ajax.reload(null, false);
                      document.querySelector("#frmCajas").reset();
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

    document.querySelector("#btnCancelarCaja").addEventListener("click",function () {
      document.querySelector("#frmCajas").reset()
    })

    document.querySelector("#cerrarCajas").addEventListener("click", function () {
      document.querySelector("#frmCajas").reset()
    })

    $(document).on("click",".btnEditar", function() {
      accion = 2;
      $("#modalCaja").modal("show");
      let data = tabla.row($(this).parents("tr")).data();
      document.querySelector("#cabeceraCaja").setAttribute('style', 'background-Color: darkgreen')
      document.querySelector("#tituloCaja").innerHTML = "Actualizar Caja";
      document.querySelector("#btnGuardarCaja").innerHTML = "Actualizar";
      document.querySelector("#idCaja").value = data["caja_id"];
      document.querySelector("#descripcionCaja").value = data["caja_nombre"];
    })
  });