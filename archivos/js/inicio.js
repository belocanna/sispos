$(document).ready(function () {
    // CARGAR SELECT COPROPIEDADES
    $.ajax ({
        url:"ajax/inicio.ajax.php",
        method: "POST",
        dataType: 'json',
        success: function(respuesta) {
           $("#totalProductos").html(respuesta[0]['totalProductos']);
           $("#totalCompras").html('$. ' + respuesta[0]['totalCompras']);
           $("#totalVentas").html('$. '+respuesta[0]['totalVentas']);
        //    $("#totalMinimo").html(respuesta[0]['totalMinimo']);
        //    $("#totalVentasHoy").html('$.' + respuesta[0]['TotalVentasHoy']);
        }  
    });
    $.ajax ({
        url:"ajax/inicio.ajax.php",
        method: "POST",
        dataType: 'json',
        data:{
            accion: 1
        },
        success: function(respuesta) {
            $("#totalMinimo").html(respuesta[0]['totalMinimo']);
        //    $("#totalVentasHoy").html('$.' + respuesta[0]['TotalVentasHoy']);
        }  
    });
    $.ajax ({
        url:"ajax/inicio.ajax.php",
        method: "POST",
        dataType: 'json',
        data:{
            accion: 2
        },
        success: function(respuesta) {
           $("#totalVentasHoy").html('$. ' + respuesta[0]['totalVentasDia']);
        }  
    });
    $.ajax ({
        url:"ajax/inicio.ajax.php",
        method: "POST",
        dataType: 'json',
        data:{
            accion: 3
        },
        success: function(respuesta) {
           $("#totalEfectivo").html('$. ' + respuesta[0]['totalEfectivo']);
        }  
    });
    $.ajax ({
        url:"ajax/inicio.ajax.php",
        method: "POST",
        dataType: 'json',
        data:{
            accion: 4
        },
        success: function(respuesta) {
           $("#totalBanco").html('$. ' + respuesta[0]['totalBanco']);
        }  
    });
    function abrirModalCambiar() {
        $("#modalCambiarPass").modal("show");
      }

    function fnc_validarApertura($usuario) {
        $.ajax ({
            url:"ajax/apertura.ajax.php",
            method: "POST",
            dataType: 'json',
            data:{
                accion: 2
            },
            success: function(respuesta) {
                console.log(respuesta)
            }  
        });
    }

    
})