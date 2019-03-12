document.onreadystatechange = function () {
    $('.button-collapse').sideNav({
        menuWidth: 300, // Default is 300
        edge: 'left', // Choose the horizontal origin
        closeOnClick: true, // Closes side-nav on <a> clicks, useful for Angular/Meteor
        draggable: true // Choose whether you can drag to open on touch screens
    });
};

$(document).ready(function() {
    $('select').material_select();
});
            
            
$('#fechaInicio').pickadate({
  selectMonths: true,
  selectYears: 15,
  format: 'yyyy/mm/dd',
  //min: new Date(fecha()),
  monthsFull: [ 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre' ],
  monthsShort: [ 'Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dec' ],
  weekdaysFull: [ 'Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado' ],
  weekdaysShort: [ 'Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab' ],
  today: 'Hoy',
  clear: 'Borrar',
  close: 'Continuar',
  //Materialize modified
  weekdaysLetter: [ 'D', 'L', 'M', 'M', 'J', 'V', 'S' ],
  onSet: function(obj){
    var picker2 = $('#fechaTermino').pickadate('picker');
    if( obj.select ){
      var val = moment(obj.select);
      picker2.set('min', val.startOf('quarter').toDate());
      picker2.set('max', val.endOf('quarter').toDate());
    }
    
    if( obj.clear ){
      picker2.set('min', false);
      picker2.set('max', false);
    }
  }
});


$('#fechaTermino').pickadate({
  selectMonths: true,
  selectYears: 15,
  format: 'yyyy/mm/dd',
  //min: new Date(fecha()),
  monthsFull: [ 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre' ],
  monthsShort: [ 'Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dec' ],
  weekdaysFull: [ 'Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado' ],
  weekdaysShort: [ 'Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab' ],
  //Materialize modified
  weekdaysLetter: [ 'D', 'L', 'M', 'M', 'J', 'V', 'S' ],
  today: 'Hoy',
  clear: 'Borrar',
  close: 'Continuar',
  onSet: function(obj){
    var picker1 = $('#fechaInicio').pickadate('picker');
    if( obj.select ){
      var val = moment(obj.select);
      picker1.set('min', val.startOf('quarter').toDate());
      picker1.set('max', val.endOf('quarter').toDate());
    }
    
    if( obj.clear ){
      picker1.set('min', false);
      picker1.set('max', false);
    }
  }
});

$('#fechaNacimiento').pickadate({
    
    selectYears: 100, // Creates a dropdown of 15 years to control year
    selectMonths: true, // Creates a dropdown to control month
    format: 'yyyy/mm/dd',
    max: new Date().getFullYear(),
    // max: new Date(fecha()),
    monthsFull: [ 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre' ],
    monthsShort: [ 'Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dec' ],
    weekdaysFull: [ 'Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado' ],
    weekdaysShort: [ 'Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab' ],
    //Materialize modified
    weekdaysLetter: [ 'D', 'L', 'M', 'M', 'J', 'V', 'S' ],
    today: 'Hoy',
    clear: 'Borrar',
    close: 'Continuar',
});


function fecha() {


    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1; //January is 0!
    var yyyy = today.getFullYear();
    
    
    if(dd<10) {
        dd='0'+dd
    } 
    
    if(mm<10) {
        mm='0'+mm
    } 
    
    today = yyyy+','+mm+','+dd;
    return today;
}


function goBack() {
    window.history.back(-1);
}

7

// ----------------------------------PROGRAMAS---------------------------------------- //


$(document).ready(function(){
  $.get("../controllers/listaProgramas.php")
    .done(function(data){
        document.getElementById("listaProgramas").innerHTML = data;
    });
});


function listaProgramas(){
    $.get("../controllers/listaProgramas.php")
    .done(function(data){
        document.getElementById("listaProgramas").innerHTML = data;
    });
}

// ----------------------------------------------------------------------------------- //

// ----------------------------------ORGANIZACION---------------------------------------- //


$(document).ready(function(){
  $.get("../controllers/listaOrganizaciones.php")
    .done(function(data){
        document.getElementById("listaOrganizaciones").innerHTML = data;
    });
});


function listaOrganizaciones(){
    $.get("../controllers/listaOrganizaciones.php")
    .done(function(data){
        document.getElementById("listaOrganizaciones").innerHTML = data;
    });
}

// ----------------------------------------------------------------------------------- //

// ----------------------------------ACTIVIDAD---------------------------------------- //


$(document).ready(function(){
  $.get("../controllers/listaActividades.php")
    .done(function(data){
        document.getElementById("listaActividades").innerHTML = data;
    });
});


function listaActividades(){
    $.get("../controllers/listaActividades.php")
    .done(function(data){
        document.getElementById("listaActividades").innerHTML = data;
    });
}

// ----------------------------------------------------------------------------------- //

// ----------------------------------VOLUNTARIOS---------------------------------------- //

$(document).ready(function(){
  $.get("../controllers/listaVoluntarios.php")
    .done(function(data){
        document.getElementById("listaDatosVoluntarios").innerHTML = data;
        $('.collapsible').collapsible();
    });
});

function listaVoluntarios(){
    $.get("../controllers/listaVoluntarios.php")
    .done(function(data){
        document.getElementById("listaDatosVoluntarios").innerHTML = data;
        $('.collapsible').collapsible();
    });
}

// ----------------------------------------------------------------------------------- //

// ----------------------------------SERVICIO SOCIAL---------------------------------------- //

$(document).ready(function(){
  $.get("../controllers/listaServicioSocial.php")
    .done(function(data){
        document.getElementById("listaDatosServicioSocial").innerHTML = data;
        $('.collapsible').collapsible();
    });
});

function listaServicioSocial(){
    $.get("../controllers/listaServicioSocial.php")
    .done(function(data){
        document.getElementById("listaDatosServicioSocial").innerHTML = data;
        $('.collapsible').collapsible();
    });
}


// ----------------------------------------------------------------------------------- //

// ----------------------------------ALUMNOS---------------------------------------- //

$(document).ready(function(){
  $.get("../controllers/listaAlumnos.php")
    .done(function(data){
        document.getElementById("listaDatosAlumnos").innerHTML = data;
        $('.collapsible').collapsible();
    });
});

function listaAlumnos(){
    $.get("../controllers/listaAlumnos.php")
    .done(function(data){
        document.getElementById("listaDatosAlumnos").innerHTML = data;
        $('.collapsible').collapsible();
    });
}

// ----------------------------------------------------------------------------------- //

// ----------------------------------ADMIN---------------------------------------- //

$(document).ready(function(){
  $.get("../controllers/listaAdmin.php")
    .done(function(data){
        document.getElementById("listaDatosAdmin").innerHTML = data;
        $('.collapsible').collapsible();
    });
});

function listaAdmin(){
    $.get("../controllers/listaAdmin.php")
    .done(function(data){
        document.getElementById("listaDatosAdmin").innerHTML = data;
        $('.collapsible').collapsible();
    });
}

// ----------------------------------------------------------------------------------- //



function borrarItem(idElem, table){
    
    if(table == "Voluntario"){
        var tipoUsuario = table;
        table = "Usuario";
    }else if(table == "ServicioSocial"){
        var tipoUsuario = table;
        table = "Usuario";
    }else if(table == "Alumno"){
        var tipoUsuario = table;
        table = "Usuario";
    }
    
    $.confirm({
        title: '¿Desea eliminar el registro?',
        content: 'Confirma para continuar.',
        buttons: {
            Continuar: function () {
                $.post( 
                        "../controllers/eliminar.php",
                        { id:idElem , tabla:table })
                        .done(function( ) {
                            if(table == "Programa"){
                                listaProgramas();
                            }else if(table == "Organizacion"){
                                listaOrganizaciones();
                            }else if(table == "Actividad"){
                                listaActividades();
                                
                            }else if(table == "Usuario"){
                                if(tipoUsuario == "Voluntario"){
                                    listaVoluntarios();
                                }
                                else if(tipoUsuario == "ServicioSocial"){
                                    listaServicioSocial();
                                }
                                else if(tipoUsuario == "Alumno"){
                                    listaAlumnos();
                                }
                                else{
                                    listaAdmin();
                                }
                            }
                        }
                );
            },
            Cancelar: function () {
    
            }
        }
    });
}

//Confirmar contraseña:
$("#password").on("focusout", function (e) {
    if ($(this).val() != $("#passwordConfirm").val()) {
        $("#passwordConfirm").removeClass("valid").addClass("invalid");
        document.getElementById("formaUsuario").disabled = true;
        $("#formaUsuario").addClass("grey");
    } else {
        $("#passwordConfirm").removeClass("invalid").addClass("valid");
        document.getElementById("formaUsuario").disabled = false;
        $("#formaUsuario").removeClass("grey");
    }
});

$("#passwordConfirm").on("keyup", function (e) {
    if ($("#password").val() != $(this).val()) {
        $(this).removeClass("valid").addClass("invalid");
        document.getElementById("formaUsuario").disabled = true;
        $("#formaUsuario").addClass("grey");
    } else {
        $(this).removeClass("invalid").addClass("valid");
        document.getElementById("formaUsuario").disabled = false;
        $("#formaUsuario").removeClass("grey");
    }
});

// $("#passwordV").on("focusout", function (e) {
//     if ($(this).val() != $("#passwordConfirmV").val()) {
//         $("#passwordConfirmV").removeClass("valid").addClass("invalid");
//     } else {
//         $("#passwordConfirmV").removeClass("invalid").addClass("valid");
//     }
// });

// $("#passwordConfirmV").on("keyup", function (e) {
//     if ($("#passwordV").val() != $(this).val()) {
//         $(this).removeClass("valid").addClass("invalid");
//     } else {
//         $(this).removeClass("invalid").addClass("valid");
//     }
// });

$(document).on('change', '.div-toggle', function() {
    var target = $(this).data('target');
    var show = $("option:selected", this).data('show');
    $(target).children().addClass('hide');
    $(show).removeClass('hide');
});
$(document).ready(function(){
  $('.div-toggle').trigger('change');
});

$("#formValidate").validate({
    rules: {
            newPass: {
                required: true,
                minlength: 15,
            },
    },
    messages: {
        newPass:{
            required: "Enter a username",
            minlength: "Enter at least 5 characters"
        },
    },
});