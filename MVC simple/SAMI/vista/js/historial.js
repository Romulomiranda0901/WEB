$(document).ready(function () {
    $('input:text[name=nombre]').val("");
    $('input:text[name=apallido]').val("");
    $('input:text[name=edad]').val("");
    $('input:text[name=sexo]').val("");
    $('input:text[name=telefono]').val("");
    function createItem(paciente) {
        localStorage.setItem("mytime",paciente);
      }
      
        function readValue() {
        var x = localStorage.getItem("mytime");
        document.getElementById("informacion").innerHTML = x;
      }
    
       
        $.getJSON('../controlador/historial_controller.php',
            function (data) {
                // console.log(nombre,contraseña);
           console.log(data)
           for (var i = 0; i < data.length; i++) {
            console.log(data[i]);  
            $("#nombre").html(data[i].nombre)
            $("#apellido").html(data[i].apellido)
            $("#edad").html(data[i].edad)
            $("#fecha_entrada").html(data[i].fecha_entrada)
            $("#fecha_alta").html(data[i].fecha_alta)
            } 
        

            })
           
  
   $("#btn-mostrar").on("click",function(){
       readValue();
   }) 
   $("#btn-mostrar").trigger("click")

    
  

});