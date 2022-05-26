$(document).ready(function () {
    let id_usuario = 1;
    
    
    $("#btnguardar").on("click", function () { 
   
  
    let planta = $('input:text[name=planta]').val();
    var fecha = document.getElementById("myDate").value;
   
    let motivo = $('input:text[name=motivo]').val();
    let direccion = $('input:text[name=direcion]').val();
    let id_medico = 1;
    console.log(1,planta,fecha,motivo,direccion);
    $.post('../modelo/cita.php',
    {"id_paciente":id_usuario,"planta":planta,"fecha":fecha,"motivo":motivo,"id_medico":id_medico,"direccion":direccion},
    function(data){
         $('input:text[name=planta]').val(" ");
    
         $('input:text[name=motivo]').val(" ");
         $('input:text[name=direcion]').val(" ");
            console.log(data);
        
    });
  })
});
