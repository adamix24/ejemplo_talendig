<html>
  <head>
      <title>Agenda Final</title>

      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

      <style>

        fieldset{
          padding:10px;
          border:solid 2px #cccccc;
          margin-bottom: 5px;

        }
      </style>
  </head>

  <body>


    <?php
      $id = isset($_GET['id'])?$_GET['id']:'';


      $posible = "datax/{$id}";

      if(!is_file($posible)){
         header("Location:./");
      }

      $tmp = file_get_contents($posible);

      $contacto = json_decode($tmp);

      if($_POST){

        $l = new stdClass();


        //obtener los Datos
        $l->fecha = $_POST['fecha'];
        $l->motivo = $_POST['motivo'];
        $l->empleado = $_POST['empleado'];

        if(!isset($contacto->llamadas)){
          $contacto->llamadas = [];
        }

        $contacto->llamadas[] = $l;

        $data = json_encode($contacto);

        file_put_contents("datax/{$id}", $data);

        header("Location:/.");

      }


    ?>

    <div class="container mt-3">

        <h3>Llamadas al <?= $contacto->nombre; ?></h3>

        <p>Aqui vamos a registrar la llama a este contacto</p>



        <form method="post" action="<?= $_SERVER['REQUEST_URI']; ?>">
          <div class="m-3"><input required type="date" name="fecha" class="form-control" ></div>
          <div class="m-3"><textarea required class="form-control" name="motivo" placeholder="Para que llama??"></textarea></div>
          <div class="m-3"><input required type="text" name="empleado" class="form-control" placeholder="QUien llama" ></div>

            <div>
                <a href="./">Volver</a>
            </div>
            <div class="text-center">

                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>

        </form>

        <div>
            <h3>Historico de contacto</h3>

            <?php
              foreach($contacto->llamadas as $llamada){

                echo <<<FILA
                  <fieldset>
                      <legend>{$llamada->fecha}</legend>
                      <p>
                          {$llamada->motivo}
                      </p>
                      <p class='text-end'>
                        Hecho por {$llamada->empleado}
                      </p>
                  </fieldset>
FILA;

              }


            ?>

        </div>

    </div>

  </body>
