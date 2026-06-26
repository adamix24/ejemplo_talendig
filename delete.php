<?php

require_once 'partes/db.php';

$id = isset($_GET['id']) ? $_GET['id'] : '';

if($id !== ''){
  contacto_borrar($id);
}

header("Location:./");
exit;
