<?php

require_once 'partes/db.php';

if($_POST){

  // El campo "codigo" es de control: vacío = nuevo, con valor = id existente.
  $codigo = isset($_POST['codigo']) ? trim($_POST['codigo']) : '';

  // Campos del contacto (todo lo que viene del formulario salvo el control).
  $datos = $_POST;
  unset($datos['codigo']);

  if($codigo !== '' && contacto_obtener($codigo)){
    // Actualiza el contacto existente (las llamadas se conservan).
    contacto_actualizar($codigo, $datos);
  }else{
    // Crea un contacto nuevo.
    contacto_insertar($datos);
  }

  header("Location: index.php");
  exit;
}
