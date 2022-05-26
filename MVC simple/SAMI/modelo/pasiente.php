<?php
$consulta= "SELECT pacientes.nombre , pacientes.apellido , login.usuario, pacientes.id_usuario
FROM pacientes  
INNER JOIN login   
ON pacientes.id_usuario = login.id_usuario ";
?>