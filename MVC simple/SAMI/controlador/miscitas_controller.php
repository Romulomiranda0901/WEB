<?php
include ('../conexion/conexion.php');

//session_start();
$params = $_REQUEST;
$action = isset($params['action']) && $params['action'] !='' ? $params['action'] : 'list';
$empCls = new citas();
switch($action) {
  case 'list':
   $empCls->datos();
  break;
  default:
  return;
 }

 class citas {
  protected $conn;
  protected $consulta;
  protected $data = array();
  function __construct() {
    $db = new dbObj();
    $connString =  $db->getConnstring();
      $this->conn = $connString;
  }
  
  function datos() {
  
  $arreglo = array();
  require ('../modelo/miscitas.php');
  if ($result = $this->conn->query($consulta)) {
      while($row = $result->fetch_array(MYSQLI_ASSOC)) {
              $arreglo[] = $row;
      }
      echo json_encode($arreglo);
  }
  

  }
}

