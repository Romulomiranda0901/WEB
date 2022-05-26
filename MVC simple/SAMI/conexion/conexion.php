
<?php
Class dbObj{
 /* Database connection start */
       
        
 
function  __construct() {
  
 }
 function getConnstring() {
  header('Access-Control-Allow-Origin: *');
  define("DB_SERVER", "localhost");
  define("DB_USER", "root");
  define("DB_PASSWORD", "");
  define("DB_DATABASE", "hospital");
  
  $con = mysqli_connect(DB_SERVER , DB_USER, DB_PASSWORD, DB_DATABASE);
 
 
 /* check connection */
 if (mysqli_connect_error()) {
 printf("Connect failed: %s\n", mysqli_connect_error());
 exit();
 } else {
 $this->conn = $con;
 }
 return $this->conn;
 }
}

?>