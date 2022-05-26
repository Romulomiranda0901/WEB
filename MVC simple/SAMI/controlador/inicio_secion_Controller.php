<?php
include ('../conexion/conexion.php');

//session_start();
$params = $_REQUEST;
$action = isset($params['action']) && $params['action'] !='' ? $params['action'] : 'list';
$empCls = new Inicio_secion();
switch($action) {
  case 'list':
   $empCls->getInicio_secion();
  break;
  default:
  return;
 }

 class Inicio_secion {
  protected $conn;
  protected $consulta;
  protected $data = array();
  function __construct() {
    $db = new dbObj();
    $connString =  $db->getConnstring();
      $this->conn = $connString;
  }
  
  function getInicio_secion() {
  
  $arreglo = array();
  require ('../modelo/inicio_secion.php');
  if ($result = $this->conn->query($consulta)) {
      while($row = $result->fetch_array(MYSQLI_ASSOC)) {
              $arreglo[] = $row;
      }
      echo json_encode($arreglo);
  }
  $result->close();

  }
}

