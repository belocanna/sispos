$(document).ready(function () {
    let accion = "";
    document.querySelector("#fechaDesde").value = moment().startOf("month").format("YYYY-MM-DD")
  document.querySelector("#fechaHasta").value = moment().format("YYYY-MM-DD")
  ventasdesde = document.querySelector("#fechaDesde").value
  ventashasta = document.querySelector("#fechaHasta").value
  
    $.ajax({
        serverside: true,
        url: "ajax/cajas.ajax.php",
        data:{'accion':3},
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
          $("#cajaApertura").html(options);
        },
      });
    // LISTAR APERTURAS
    let tabla = $("#tblAperturas").DataTable({
      
      ajax: {
        serverside: true,
        url: "ajax/apertura.ajax.php",
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
          width:"200px",
        },
        {
            targets: 3,
            width:"200px",
          },
          {
            targets: 4,
            width:"200px",
          },
          {
            targets: 5,
            width:"200px",
          },
          {
            targets: 6,
            width:"200px",
          },
          {
            targets: 7,
            width:"200px",
          },
          {
            targets: 8,
            sortable: false,
            render: function (data, type, full, meta) {
                if (data == 1) {
                  return "<button class='btn btn-primary btn-sm btnCierre'>Caja Abierta</button>";
                } else {
                  return "<span class='badge badge-secondary'>Caja Cerrada</span>";
                }
            },
          },
      ],
      columns: [
        { data: "apertura_id" },
        { data: "caja_nombre" },
        { data: "usuario_nombres"},
        { data: "apertura_fechainicial"},
        { data: "apertura_inicial"},
        { data: "apertura_fechaCierre"},
        { data: "apertura_cierre"},
        { data: "apertura_ventas"},
        { data: "apertura_estado"},
        // {
        //   defaultContent:
        //     "<button class='btn btn-danger btn-sm btnCortar'>Cortar</button>",
        // },
      ],
      dom:'Bfrtip',
      language: {
        url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
      },
    });
    
    document.querySelector("#btnAdicionarApertura").addEventListener("click", function () {
        accion = 1
        let date = new Date()
        // document.querySelector("#cabeceraCaja").setAttribute('style', 'background-Color: darkblue')
        document.querySelector("#tituloApertura").innerHTML = "Apertura de Caja"
        document.querySelector("#btnGuardarApertura").innerHTML = "Guardar"
        document.querySelector("#fechaApertura").value = date.toLocaleDateString()
    })

    document.querySelector("#btnGuardarApertura").addEventListener("click", function () {
        caja = document.querySelector("#cajaApertura").value
        monto = document.querySelector("#montoApertura").value;
        if (caja == null || caja == 0) {
            Swal.fire({
                text: "Seleccione Caja Apertura",
                target: "#custom-target",
                customClass: {
                  container: "position-absolute",
                },
                toast: true,
                position: "bottom-right",
              });
            return false;  
            
        }
        if (monto == null || monto.length == 0) {
            Swal.fire({
                text: "Ingrese Monto de Apertura en Caja",
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
                text: "Seguro desea registrar la Apertura ?",
                icon: "info",
                showCancelButton: true,
                confirmButtonText: "Si, deseo Registrar",
              }).then((result) => {
                if (result.isConfirmed) {
                  let datos = new FormData();
                  datos.append("caja", caja);
                  datos.append("monto", monto);
                  datos.append("accion", accion);
                  $.ajax({
                    url: "ajax/apertura.ajax.php",
                    method: "POST",
                    data: datos,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (respuesta) {
                      $.ajax({
                        url: "ajax/apertura.ajax.php",
                    method: "POST",
                    data: {'accion': 3},
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: "json",
                        success:function (respuesta) {
                          console.log(respuesta)
                        }
                      })
                      $("#modalApertura").modal("hide");
                      tabla.ajax.reload(null, false);
                      document.querySelector("#frmApertura").reset();
                        $.ajax({
                          url: "ajax/cajas.ajax.php",
                          method: "POST",
                          data: {id: caja, estado: 1, accion: 2},
                          cache: false,
                          contentType: false,
                          processData: false,
                          success: function () {
                            Swal.fire({
                              text: respuesta,
                              icon: "confirm"
                            });
                          }
                        })
                    },
                  });
                }
              });
        }
    })

    $(document).on("click",".btnCierre", function () {
      let data = tabla.row($(this).parents("tr")).data();
      $("#modalCierre").modal('show');
      document.querySelector("#cabeceraCierre").setAttribute("style", "background-color:darkred")
      document.querySelector("#tituloCierre").innerHTML = "Cierre de Caja"
      document.querySelector("#btnGuardarCierre").innerHTML = "Guardar"
      document.querySelector("#montoAperturaCierre").value = data['apertura_inicial']
        let datos = new FormData();
        datos.append("accion", 6);
        $.ajax({
          url: "ajax/ventas.ajax.php",
          method: "POST",
          data: datos,
          cache: false,
          contentType: false,
          processData: false,
          dataType: "json",
          success: function (respuesta) {
          document.querySelector("#totalVentas").value = respuesta[0]["totalVentas"]
          inicial = document.querySelector("#montoAperturaCierre").value
          venta = document.querySelector("#totalVentas").value
          document.querySelector("#montoCierre").value = (parseFloat(inicial)  + parseFloat(venta)).toFixed(2)
          },
        });
    });
    
    document.querySelector("#btnGuardarCierre").addEventListener("click", function () {
       monto = document.querySelector("#montoCierre").value
       ventas = document.querySelector("#totalVentas").value
       Swal.fire({
        title: "CONFIRMAR",
        text: "Seguro desea registrar el Cierre ?",
        icon: "info",
        showCancelButton: true,
        confirmButtonText: "Si, deseo Registrar",
      }).then((result) => {
        if (result.isConfirmed) {
          let datos = new FormData();
          datos.append("monto", monto);
          datos.append("ventas",ventas)
          datos.append("accion", 4);
          $.ajax({
            url: "ajax/apertura.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            success: function (respuesta) {
              $("#modalCierre").modal("hide");
              tabla.ajax.reload(null, false);
              document.querySelector("#frmCierre").reset();
                    Swal.fire({
                      text: respuesta,
                      icon: "confirm"
                    });
                  }
                })
            }
          });
      });
  });