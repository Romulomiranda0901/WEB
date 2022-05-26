$(document).ready(function () {
         
       let usaurio = $("#informacion").text();
       
       console.log(usaurio);
       $.getJSON('../controlador/doctor_controller.php',
       function (data) {
           console.log(data);
           for (var i = 0; i < data.length; i++) {
               if (data[i].usuario == usaurio) {
                $("#citas").text('hola mundo');
                $("#informacion2").text(data[i].nombre  +  data[i].apellido );
                
                
               } 
           }

       })
});
