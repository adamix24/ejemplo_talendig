<html>
  <head>
      <title>Agenda Final</title>

      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  </head>

  <body>
    <div class="container mt-3">

        <h3>Agenda del Futuro</h3>

        <div class="text-end">
          <a href="edit_contacto.php" class="btn btn-primary">Agregar Contacto</a>
        </div>

        <table class="table table-bordered table-striped mt-3">
            <thead>
                <tr>
                  <th>Nombre</th>
                  <th>Apellido</th>
                  <th>Telefono</th>
                  <th>Llamadas</th>
                  <td>-</td>

                </tr>
            </thead>
            <tbody>
              <?php
                if(is_dir("datax")){
                  $archivos = scandir("datax");

                  foreach($archivos as $nombre){
                      $ruta = "datax/{$nombre}";

                      if(is_file($ruta)){

                        $datos = file_get_contents($ruta);
                        $datos = json_decode($datos);

                        $llamadas = (isset($datos->llamadas))?count($datos->llamadas):0;

                    echo "<tr>
                        <td>{$datos->nombre}</td>
                        <td>{$datos->apellido}</td>
                        <td>{$datos->telefono}</td>
                        <td>{$llamadas}</td>
                          <td>
                              <a class='btn btn-success' href='edit_contacto.php?id={$nombre}'>
                                <i class='fa fa-edit'></i>
                              </a>
                              <a href='contacto.php?id={$nombre}' class='btn btn-info'>
                                <i class='fa fa-phone'></i>
                              </a>
                              <a href='imprimir.php?id={$nombre}' target='ifPrint' class='btn btn-warning'>
                                <i class='fa fa-print'></i>
                              </a>
                          </td>
                        </tr>";

                      }
                  }
                }
              ?>

            </tbody>

        </table>

        <iframe name="ifPrint" style="display:none" >

        </iframe>

    </div>

  </body>

</html>
