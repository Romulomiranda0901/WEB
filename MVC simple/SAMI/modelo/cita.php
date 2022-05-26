<?php
header('Access-Control-Allow-Origin: *');
  define("DB_SERVER", "localhost");
  define("DB_USER", "root");
  define("DB_PASSWORD", "");
  define("DB_DATABASE", "hospital");
  
  $con = mysqli_connect(DB_SERVER , DB_USER, DB_PASSWORD, DB_DATABASE);

  if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

echo "Connected successfully";

$sql="INSERT into citas  (id_paciente,planta,fecha,motivo,id_medico,direccion ) values ('".$_POST["id_paciente"]."','".$_POST["planta"]."','".$_POST["fecha"]."','".$_POST["motivo"]."','".$_POST["id_medico"]."','".$_POST["direccion"]."')";
if (mysqli_query($con, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($con);
}
mysqli_close($con);
?>
