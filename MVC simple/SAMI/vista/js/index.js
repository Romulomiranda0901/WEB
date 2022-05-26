$(document).ready(function () {
    $('input:text[name=usuario]').val("");
    $('input:password[name=contraseña]').val("");
    function createItem(usuario) {
        localStorage.setItem("mytime",usuario);
      }
      
      function readValue() {
        var x = localStorage.getItem("mytime");
        document.getElementById("informacion").innerHTML = x;
      }
    $("#btningresar").on("click", function () {
        let nombre = $('input:text[name=usuario]').val();
        let contraseña = $('input:password[name=contraseña]').val();
        createItem(nombre)
        $.getJSON('../controlador/inicio_secion_Controller.php',
            function (data) {
                // console.log(nombre,contraseña);
           console.log(data)
           for (var i = 0; i < data.length; i++) {
            if (contraseña == data[i].contracena && data[i].usuario == nombre) {
                console.log(data[i].type == 2);
                if (data[i].type == 1) {
                 
                    window.location = './home.html'
                }else if (data[i].type == 2) {
                 
                    window.location = './doc.html'
                }
            } else {
                
                $('input:text[name=usuario]').val("");
                $('input:password[name=contraseña]').val("");
             }
        }

            })
           
    });
   $("#btn-mostrar").on("click",function(){
       readValue();
    
   }) 
   $("#btn-mostrar").trigger("click")

    
  

});
