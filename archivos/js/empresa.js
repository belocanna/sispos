let datos = new FormData();
  $(document).ready(function () {
    $.ajax({
        url: "ajax/empresa.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            document.querySelector("#idEmpresa").value = respuesta["empresa_id"]
            document.querySelector("#documentoEmpresa").value = respuesta['empresa_documento']
            document.querySelector("#nombreEmpresa").value = respuesta['empresa_nombre']
            document.querySelector("#direccionEmpresa").value = respuesta['empresa_direccion']
            document.querySelector("#telefonoEmpresa").value = respuesta['empresa_telefono']
            document.querySelector("#correoEmpresa").value = respuesta['empresa_correo']
            document.querySelector("#ciudadEmpresa").value = respuesta['empresa_ciudad']
            document.querySelector("#responsableEmpresa").value = respuesta['empresa_responsable']
        },
      });

   document.querySelector("#btnGuardarEmpresa").addEventListener("click", function () {
    id = document.querySelector("#idEmpresa").value 
    documento = document.querySelector("#documentoEmpresa").value
     nombres = document.querySelector("#nombreEmpresa").value
     direccion = document.querySelector("#direccionEmpresa").value
     telefono = document.querySelector("#telefonoEmpresa").value
     correo = document.querySelector("#correoEmpresa").value
     ciudad = document.querySelector("#ciudadEmpresa").value
     responsable = document.querySelector("#responsableEmpresa").value
     Swal.fire({
        title: "CONFIRMAR",
        text: "Seguro desea registrar el Negocio ?",
        icon: "info",
        showCancelButton: true,
        confirmButtonText: "Si, deseo Registrar",
      }).then((result) => {
        if (result.isConfirmed) {
          let datos = new FormData();
          datos.append("id", id);
          datos.append("documento", documento)
          datos.append("nombre", nombres)
          datos.append("direccion", direccion)
          datos.append("telefono", telefono)
          datos.append("correo", correo)
          datos.append("ciudad", ciudad)
          datos.append("responsable", responsable)
          datos.append("accion", 1)
          $.ajax({
            url: "ajax/empresa.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            success: function (respuesta) {
                document.querySelector("#frmEmpresa").reset()
                Swal.fire({
                  text: respuesta,
                  icon: "confirm"
                });
            },
          });
        }
      });
   })
})