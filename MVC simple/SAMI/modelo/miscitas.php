<?php
$consulta= "SELECT doctores.nombre , doctores.apellido , citas.planta,citas.fecha,citas.direccion,citas.motivo
FROM citas  
INNER JOIN doctores   
ON citas.id_medico = doctores.id_doctor ";

?>