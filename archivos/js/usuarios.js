$(document).ready(function () {
    let accion = " ";
    // CARGAR DATOS DE USUARIOS
    
    let tabla = $("#tblUsuarios").DataTable({
      ajax: {
        serverSide: true,
        url: "ajax/usuarios.ajax.php",
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
          width: "200px",
        },
        {
            targets: 2,
            sortable: false,
            render: function (data, type, full, meta) {
                if (data == 1) {
                  return "<span class='badge badge-primary'>Administrador</span>";
                } else {
                  return "<span class='badge badge-secondary'>Usuario</span>";
                }
            },
          },
          {
            targets:3,
            width: "100px",
          },
          {
            targets: 4,
            sortable: false,
            render: function (data, type, full, meta) {
                if (data == 1) {
                  return "<button class='btn btn-primary btn-sm btnDelete'><i class='fa fa-check-square'></i> Activo</button>"+
                  " " +
                  "<button class='btn btn-warning btn-sm btnEditar'><i class='fa fa-pencil-square'></i> Editar</button>" ;
                } else {
                  return "<button class='btn btn-danger btn-sm btnDelete'><i class='fa fa-dash-square'> Inactivo</button>";
                }
            },
          },
      ],
      columns: [
        { data: "usuario_id"},
        { data: "usuario_nombres"},
        { data: "usuario_perfil"},
        { data: "usuario_login"},
        { data: "usuario_estado"},
      
      ],
      dom:'Bfrtip',
      language: {
        url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
      },
    });
    
    // FUNCION PARA ADICIONAR USUARIO

    document.querySelector("#btnAdicionarUsuario").addEventListener("click", function () {
      accion = 1
      document.querySelector("#tituloUsuario").innerHTML = "Crear Usuario";
      document.querySelector("#btnGuardarUsuario").innerHTML = "Guardar";
    });
  
     // FUNCION BOTON EDITAR

    $(document).on("click",".btnEditar", function () {
      accion = 5
      $("#modalUser").modal('show');
      let data = tabla.row($(this).parents("tr")).data();
      document.querySelector("#tituloUsuario").innerHTML = "Actualizar Usuario";
      document.querySelector("#btnGuardarUsuario").innerHTML = "Actualizar";
      document.querySelector("#idUsuario").value = data["usuario_id"];
      document.querySelector("#nombresUsuario").value = data["usuario_nombres"];
      document.querySelector("#correoUsuario").value = data["usuario_correo"];
      document.querySelector("#perfilUsuario").value = data["usuario_perfil"];
    });
  
    // FUNCION BOTON CAMBIAR ESTADO

    $(document).on("click", ".btnDelete", function () {
      accion = 3
      let data = tabla.row($(this).parents("tr")).data();
      let datos = new FormData();
      datos.append("id", data["usuario_id"]);
      datos.append("estado", data["usuario_estado"]);
      datos.append("accion", accion);
      $.ajax({
        url: "ajax/usuarios.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function (answer) {
          tabla.ajax.reload(null, false);
          Swal.fire(answer);
        },
      });
    });
  
    // FUNCION AL HACER CLICK EN GUARDAR USUARIO

    document.querySelector("#btnGuardarUsuario").addEventListener("click", function () {
      Swal.fire({
        title: "CONFIRMAR",
        text: "Seguro desea registrar el Usuario ?",
        icon: "info",
        showCancelButton: true,
        confirmButtonText: "Si, deseo Registrar",
      }).then((result) => {
        if (result.isConfirmed) {
          // var caracteres = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
          var caracteres = '0123456789';
          var contrasena = '';
          for (let i = 0; i < 6; i++) {
              contrasena+=caracteres.charAt(Math.floor(Math.random()*caracteres.length))
          }
          let datos = new FormData();
          datos.append("id", document.querySelector("#idUsuario").value);
          datos.append("email", document.querySelector("#correoUsuario").value);
          datos.append("nombres",document.querySelector("#nombresUsuario").value);
          datos.append("contrasena", contrasena);
          datos.append("perfil", document.querySelector("#perfilUsuario").value);
          datos.append("accion", accion);
          $.ajax({
            url: "ajax/usuarios.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            success: function (answer) {
              console.log(answer);
              $("#modalUsuario").modal("hide");
              tabla.ajax.reload(null, false);
              document.querySelector("#correoUsuario").value = "";
              document.querySelector("#nombresUsuario").value = "";
              Swal.fire(answer);
            },
          });
        }
      });
    })

   
  })

  // FUNCION PARA CAMBIO DE CONTRASEÑA

  function cambiarContrasena() {
    accion = 2;
    var nuevaClave = document.querySelector("#claveNueva").value;
    var nuevaConfirmada = document.querySelector("#claveConfirmada").value;
    if (nuevaClave.length == 0 || nuevaConfirmada.length == 0) {
      Swal.fire({
        title: "ALERTA",
        text: "Datos Incompletos",
        icon: "warning",
      });
    }
    if (nuevaClave != nuevaConfirmada) {
      Swal.fire({
        title: "ALERTA",
        text: "Nueva Clave No Confirmada",
        icon: "warning",
      });
    }else{
  
    let datos = new FormData();
    datos.append("contrasena", document.querySelector("#claveNueva").value);
    datos.append("accion", accion);
    $.ajax({
      url: "ajax/usuarios.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      success: function (answer) {
        // console.log(answer);
        $("#cambiarPass").modal("hide");
        Swal.fire(answer);
      },
    });
  }
  }


