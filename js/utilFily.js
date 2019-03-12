
var tipo;

$( "#tipoDeUsuario" ).change(function () {
      
    var seleccionado = $("#tipoDeUsuario").val();
    
    tipo = seleccionado;
    
    // alert(tipo);
      
    switch(seleccionado) {
    case "servicioSocial":
        $(".usuario").css('display', 'block');
        
        $(".voluntario").css('display', 'none');
        document.getElementById("ocupacionVoluntario").required = false;
        
        $(".servicioSocial").css('display', 'block');
        document.getElementById("semestreSS").required = true;
        document.getElementById("matriculaSS").required = true;
        document.getElementById("claveAcceso").required = true;
        break;
    case "voluntario":
        $(".usuario").css('display', 'block');
        
        $(".voluntario").css('display', 'block');
        document.getElementById("ocupacionVoluntario").required = true;
        
        $(".servicioSocial").css('display', 'none');
        document.getElementById("semestreSS").required = false;
        document.getElementById("matriculaSS").required =false;
        document.getElementById("claveAcceso").required =false;
        break;
    default:
    }
});


$("#claveAcceso").on("focusout", function (e) {
  
    // var id;
    
    // alert("HOLA");
    
    if(tipo == "servicioSocial"){
        $.get(
            "../controllers/codigoOrganizacion.php", 
            {idOr: $("#nombreOrganizaciones").val()})
            .done(function(data){
                validarClave(data);
          });
    }else if(tipo == "voluntario"){
        $.get(
            "../controllers/codigoOrganizacion.php", 
            {idOr: $("#nombreOrganizaciones").val()})
            .done(function(data){
                validarClave(data);
          });
    }
});

function validarClave(password){
  
    // alert(password + "CLAVE");
    // alert($("#claveAcceso").val());
    
    var A = $("#claveAcceso").val();
    var B = password;
    
    if(A == B){
        
        $("#claveAcceso").removeClass("invalid").addClass("valid");
        document.getElementById("formaUsuario").disabled = false;
        $("#formaUsuario").removeClass("grey");
    }else{
        $("#claveAcceso").removeClass("valid").addClass("invalid");
        document.getElementById("formaUsuario").disabled = true;
        $("#formaUsuario").addClass("grey");
    }
}


//.change();
$(document).ready(function(){
  var seleccionado = $("#tipoActividad").val();
  if(seleccionado == "Grupal"){
    $(".involucrados").css('display', 'block');
  }
});


$( "#tipoActividad" )
  .change(function () {
      
    var seleccionado = $("#tipoActividad").val();
      
    switch(seleccionado) {
    case "Individual":
        $(".involucrados").css('display', 'none');
        break;
    case "Grupal":
        $(".involucrados").css('display', 'block');
        break;
    default:
    }
    
});


function idAgregarActividad(idAct, idUs, limiteAct){
    
    //var registros = $("#numeroDeRegistros").val();
    
    // alert(registros);
    
    var registros = parseInt($("#numeroDeRegistros").val());
    
    var addBtn = "addBtn" + idAct;
    var doneBtn = "doneBtn" + idAct;
    
    var acc;
    
    if(document.getElementById(doneBtn).hidden){
        
        if(limiteAct == 1 && registros >= 1 ){
            
            $.alert({
                title: "Error",
                content: 'Sólo es posible seleccionar 1 actividad.',
                buttons: {
                    Ok: function () {
                    }
                }
            });
            
        }else{
            
            acc = 1;
        
            $.get(
                "../controllers/inscribirActividadUsuario.php", 
                {idAc: idAct, idUsr: idUs, accion: acc})
                .done(function(data){
                    if(data == 1){
                        document.getElementById(addBtn).hidden = true;
                        document.getElementById(doneBtn).hidden = false;
                        registros += 1;
                        $("#numeroDeRegistros").val(registros);
                        // alert(document.getElementById("numeroDeRegistros").value);
                    }else{
                        $.alert({
                            title: "Error",
                            content: 'Existe otra actividad registrada en el mismo horario.',
                            buttons: {
                                Ok: function () {
                                }
                            }
                        });
                    }
             });
        }
        
        
        
    }else{
        
        acc = 2;
        $.get(
            "../controllers/inscribirActividadUsuario.php", 
            {idAc: idAct, idUsr: idUs, accion: acc})
            .done(function(data){
                registros -= 1;
                $("#numeroDeRegistros").val(registros);
                document.getElementById(addBtn).hidden = false;
                document.getElementById(doneBtn).hidden = true;
        });
    }
    
}


function alertRegistros(rol){
   
   $.alert({
        title: "Actividades Registradas Exitosamente",
        content: '',
        buttons: {
            Ok: function () {
                if(rol == 'D'){
                    window.location.href = "registrosUsuarios.php";
                }else{
                    window.location.href = "actividadesRegistradas.php";
                }
            }
        }
    });
}


// $('input.limitedCheckbox').on('change', function (e) {
//     // console.log("Check");
//     if($("#tipoDeOrganizacion").val() == 1){
//         if ($('input.limitedCheckbox:checked').length > 1) {
//             $(this).prop('checked', false);
//             $.alert("Sólo puedes seleccionar 1 actividad.");
//         }
//     }
// });

//-----------------------------------COLLAPSIBLE ACTIVIDADES------------------------------------------//
$(document).ready(function(){
    $('.collapsible').collapsible();
});

$('.collapsible').collapsible({
    accordion: false, // A setting that changes the collapsible behavior to expandable instead of the default accordion style
    onOpen: function(el) { alert('Open'); }, // Callback for Collapsible open
    //onClose: function(el) { alert('Closed'); } // Callback for Collapsible close
  });
// Open
$('.collapsible').collapsible('open', 0);

// Close
$('.collapsible').collapsible('close', 0);
//------------------------------------------------------------------------------------------//

//-----------------------------------LISTA DE USUARIOS------------------------------------------//


$( "#listaAlumnos" ) .change(function () {
      
    var idAlumno = $("#listaAlumnos").val();
    actividadesRegistradas(idAlumno, "A");
    
    $("#botonAlumno").val($("#listaAlumnos").val());
    
    document.getElementById("botonAlumno").disabled = false;
});


$( "#listaVoluntarios" ) .change(function () {
      
    var idVoluntario = $("#listaVoluntarios").val();
    actividadesRegistradas(idVoluntario, "C");
    
    $("#botonVoluntario").val($("#listaVoluntarios").val());
    
    document.getElementById("botonVoluntario").disabled = false;
});


$( "#listaServicioSocial" ) .change(function () {
      
    var idSS = $("#listaServicioSocial").val();
    actividadesRegistradas(idSS, "B");
    
    $("#botonServicioSocial").val($("#listaServicioSocial").val());
    
    document.getElementById("botonServicioSocial").disabled = false;
});

//------------------------------------------------------------------------------------------//


function actividadesRegistradas(id, rol){
  $.get( 
    "../controllers/listaUsuarioActividades.php",
    { idUs: id})
    .done(function(data) {
      if(rol == "A"){
        document.getElementById("actividadesAlumno").innerHTML = data;
      }
      if(rol == "C"){
        document.getElementById("actividadesVoluntario").innerHTML = data;
      }
      if(rol == "B"){
        document.getElementById("actividadesSericioSocial").innerHTML = data;
      }
      
    }
  );
}

function editarCiclo(){
    
    var nombre =  $("#nombre_ciclo").val();
    
    var fechaI = $("#fechaInicio").val();
    
    var fechaT = $("#fechaTermino").val();
    
    if(nombre && fechaI && fechaT){
        
        if(fechaI < fechaT){
            
            $.post(
                "../controllers/editarCiclo.php",
                {nombreCiclo: nombre, fechaInicio: fechaI, fechaTermino: fechaT})
                .done(function(data){
                    window.location.href = "../controllers/consultarCiclo.php";
            });
            
        }else{
            
            $.alert({
                title: "Error.",
                content: 'La fecha de término debe ser posterior a la fecha de inicio.'
            });
            
        }
    }
    
}

function nuevoCiclo(){
    
    var nombre =  $("#nombre_ciclo").val();
    
    var fechaI = $("#fechaInicio").val();
    
    var fechaT = $("#fechaTermino").val();
    
    if(nombre && fechaI && fechaT){
        
        if(fechaI < fechaT){
            
            $.confirm({
                title: '¿Desea crear un ciclo nuevo?',
                content: 'Se creará el respaldo de reportes y se eliminarán las listas de programas y actividades.',
                buttons: {
                    Continuar: function () {
                        
                        $.confirm({
                            title: 'Confirmar Ciclo Nuevo.',
                            content: 'Se eliminarán las listas de programas y actividades.',
                            buttons: {
                                Continuar: function () {
                                    
                                     $.get(
                                        "../controllers/moduloProgramas.php",
                                        {eliminar: 1})
                                        .done(function(data){
                                            $.post(
                                                "../controllers/registrarCiclo.php",
                                                {nombreCiclo: nombre, fechaInicio: fechaI, fechaTermino: fechaT})
                                                .done(function(data){
                                                    window.location.href = "../controllers/consultarCiclo.php";
                                            });
                                            
                                    });
                                },
                                Cancelar: function () {
                        
                                }
                            }
                        });
                        
                        $.alert({
                            title: "Reporte de Programas Creado Exitosamente",
                            content: '',
                            buttons: {
                                Ok: function () {
                                    window.location.href = "../controllers/moduloExcel.php?reporte=4";
                                }
                            }
                        });
                        
                        $.alert({
                            title: "Reporte de Colaboradores Servicio Social Creado Exitosamente",
                            content: '',
                            buttons: {
                                Ok: function () {
                                    window.location.href = "../controllers/moduloExcel.php?reporte=3";
                                }
                            }
                        });
                        
                        $.alert({
                            title: "Reporte de Voluntarios Creado Exitosamente",
                            content: '',
                            buttons: {
                                Ok: function () {
                                    window.location.href = "../controllers/moduloExcel.php?reporte=2";
                                }
                            }
                        });
                        
                        $.alert({
                            title: "Reporte de Alumnos Creado Exitosamente",
                            content: '',
                            buttons: {
                                Ok: function () {
                                    window.location.href = "../controllers/moduloExcel.php?reporte=1";
                                }
                            }
                        });
                    },
                    Cancelar: function () {
            
                    }
                }
            });
        
            
        }else{
            
            $.alert({
                title: "Error.",
                content: 'La fecha de término debe ser posterior a la fecha de inicio.'
            });
            
        }
        
        
        
    }else{
        
    }
    
}

