<?php
$consulta= "SELECT doctores.nombre , doctores.apellido , login.usuario,doctores.id_usuario
FROM doctores  
INNER JOIN login   
ON doctores.id_usuario = login.id_usuario ";

//
?>