<?php


if($_POST){

  if(!is_dir('datax')){
      mkdir('datax');
  }


  $datos = $_POST;



  $tmp = scandir("datax");

  $n = count($tmp) - 2;

  $ruta = "datax/data{$n}.json";

  if(isset($_POST['codigo']) && strlen($_POST['codigo']) > 3){
    $ruta = "datax/{$_POST['codigo']}";

    if(is_file($ruta)){

      $viejotxt = file_get_contents($ruta);
      $viejo = json_decode($viejotxt);

      foreach($viejo as $campo=>$valor){

          if(!isset($datos[$campo])){
            $datos[$campo] = $valor;
          }
      }

    }

  }



  $datos = json_encode($datos);
  file_put_contents($ruta, $datos);


  header("Location: index.php");

}
