<?php
$consulta= "SELECT  pacientes.nombre, pacientes.apellido, pacientes.edad, pacientes.sexo, historial.fecha_entrada, historial.fecha_alta from pacientes,historial;";
?>