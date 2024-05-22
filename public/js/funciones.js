function validaCorreo(valor) {
  if (/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i.test(valor)){
   return true;
  } else {
   return false;
  }
}
function carga_ajax_get(ruta, valor1, div) {
     $.get(ruta, { valor1: valor1 }, function(resp) {
         $("#" + div + "").html(resp);
     });
     return false;

 }
 function confirmaAlert(pregunta, ruta) {
     jCustomConfirm(pregunta, 'Tamila', 'Aceptar', 'Cancelar', function(r) {
         if (r) {
             window.location = ruta;
         }
     });
 }
 function cerrarSesion(ruta)
 {
     Swal.fire({
         title: 'Realmente deseas cerrar tu sesión?',
         icon: 'info',
         showDenyButton: true,
         showCancelButton: true,
         confirmButtonText: 'Si',
         confirmButtonColor: '#3085d6',
             cancelButtonColor: '#d33',
             cancelButtonText: 'NO' 
       }).then((result) => {
         
         if (result.isConfirmed) {
           window.location=ruta;
         }  
       })
 }
 function confirmarSweet(pregunta, ruta)
 {
     Swal.fire({
         title: pregunta,
         icon: 'error',
         showDenyButton: true,
         showCancelButton: true,
         confirmButtonText: 'Si',
         confirmButtonColor: '#3085d6',
             cancelButtonColor: '#d33',
             cancelButtonText: 'NO' 
       }).then((result) => {
         
         if (result.isConfirmed) {
           window.location=ruta;
         }  
       })
 }
 function alertAlert(mensaje) {
     jAlert(mensaje);
 }

 function buscador()
 {
    if(document.getElementById('b').value==0)
    {
        return false;
    }
    document.form_search.submit();
 }
 function soloNumeros(evt) {
     key = (document.all) ? evt.keyCode : evt.which;
     //alert(key);
     if (key == 17) return false;
     /* digitos,del, sup,tab,arrows*/
     return ((key >= 48 && key <= 57) || key == 8 || key == 127 || key == 9 || key == 0);
 }
 function crear_producto()
 {
    var form=document.form;
    if(form.file.value==0)
    {
        form.foto.value='vacio';
    }
    form.submit();
 }
 function set_atributos()
 {
    if ($('input[type=checkbox]:checked').length === 0) {
         //e.preventDefault();
         alertAlert('Debe seleccionar al menos un atributo!!!!!');
         return false;
     }
     document.form.submit();
 }
 function salir(ruta)
 {
    jCustomConfirm('¿Realmente desea cerrar sesión?', 'Ejemplo 1', 'Aceptar', 'Cancelar', function(r) {
         if (r) {
             window.location = ruta;
         }
     });
 }
function buscador22() {
    if (document.getElementById('b').value == 0) {
        return false;
    }
    window.location = "/curso_php_udemy/ejemplo_1/public/bd/buscador?b=" + document.getElementById('b').value;
}
 

 