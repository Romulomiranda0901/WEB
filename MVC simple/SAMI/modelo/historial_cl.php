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

$sql="INSERT into historial  (fecha_entrada,fecha_alta ) values ('".$_POST["fecha_entrada"]."','".$_POST["fecha_alta"]."')";
if (mysqli_query($con, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($con);
}
mysqli_close($con);
?>