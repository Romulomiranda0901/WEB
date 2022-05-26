$(document).ready(function () {
    let id_usuario = 1;
    
    
    $("#btnguardarh").on("click", function () { 
   
  
    
    var fechaInicio = document.getElementById("myDate").value;
    var fechaSalida = document.getElementById("myDate2").value;
  
    $.post('../modelo/historial_cl.php',
    {"fecha_entrada":fechaInicio,"fecha_alta":fechaSalida},
    function(data){
       
            console.log(data);
        
    });
  })
});
