$(document).ready(function () {
  document.querySelector("#btnOlvidoClave").addEventListener("click", function () {
    $("#correoRecuperacion").modal('show');
  })  
})



  function restablecerContrasena() {
    var email = document.getElementById("correoUsuario").value
    if (email.length == 0) {
        Swal.fire({
            title: "ALERTA",
            text: "Llene los campos en blanco",
            icon: "warning",
          });   
    }else{
        var caracteres = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        var contrasena = '';
        for (let i = 0; i < 6; i++) {
          contrasena+=caracteres.charAt(Math.floor(Math.random()*caracteres.length))
        }
        let datos = new FormData();
        datos.append("email", email);
        datos.append("contrasena", contrasena);
        datos.append("accion", 4);
        $.ajax({   
        url: "ajax/usuarios.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function (respuesta) {
            $("#correoRecuperacion").modal('hide');
        //   console.log(respuesta);
          Swal.fire(respuesta);
        },
      });
    }
    
  }