<html>
  <head>
      <title>Agenda Final</title>

      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  </head>

  <body>
    <div class="container mt-3">

        <h3>Agenda del Futuro</h3>

        <h4>Datos del contacto</h4>
        <div class="text-end" id="divBorrar">
        </div>

        <form method="post" action="guardar.php" class="col-md-6">

          <input type="text" name="codigo" value="<?= (isset($_GET['id']))?$_GET['id']:''; ?>"/>
          <div class="input-group mb-3"><label class="input-group-text">Nombre: </label> <input required class="form-control" type="text" name="nombre"/> </div>
          <div class="input-group mb-3"><label class="input-group-text">Apellido: </label> <input class="form-control" type="text" name="apellido"/> </div>
          <div class="input-group mb-3"><label class="input-group-text">Telefono: </label> <input class="form-control" type="text" name="telefono"/> </div>
          <div class="input-group mb-3"><label class="input-group-text">T Sangre: </label>
                <select class="form-control" name="tsangre">
                  <option></option>
                  <option>A+</option>
                  <option>A-</option>
                  <option>B+</option>
                  <option>B-</option>
                  <option>O+</option>
                  <option>O-</option>
                </select>
           </div>
          <div class="input-group mb-3"><label class="input-group-text">Cedula: </label> <input class="form-control" maxlength="12" type="text" name="cedula"/> </div>
          <div class="input-group mb-3"><label class="input-group-text">F Nacimiento: </label> <input class="form-control" type="date" name="fnacimiento"/> </div>

          <div class="text-center">
              <a onclick="return confirm('Seguro?')" style="margin-right:80px;"  class="btn btn-warning " href="./">Cancelar</a>

              <button class="btn btn-success">Guardar</button>
          </div>

        </form>


    </div>
    <script>
        function aplicarValor(campo, valor){

            document.getElementsByName(campo)[0].value = valor;

        }

        function confirmarBorrar(){



          var tmp = prompt("Escriba BORRAR para eliminar este registro");

          if(tmp.toLowerCase() == 'borrar'){
            return true;
          }



          return false;

        }
    </script>

    <?php

        if(isset($_GET['id'])){

          $archivo = $_GET['id'];

          $posible = "datax/{$archivo}";

          if(is_file($posible)){


            $datos = file_get_contents($posible);

            $datos = json_decode($datos);

            echo <<<LINEA

            <script>

              document.getElementById('divBorrar').innerHTML = '<a onclick="return confirm(\'Seguro que quiere borrar\');" href="delete.php?id=$archivo" class="btn btn-danger"><i class="fa fa-trash"></i></a>';

  LINEA;



            foreach($datos as $campo=>$valor){

              if($campo !== 'llamadas'){

                $valor = addslashes($valor);
                echo "aplicarValor('{$campo}','{$valor}'); ";
              }
            }
            echo "

              aplicarValor('codigo','{$archivo}');
            </script>";

          }else{

            echo "
              <div class='container'>
            <div class='alert alert-danger' role='alert'>
              Error al cargar los datos
            </div>
              </div>
            ";
          }


        }

    ?>

  </body>

</html>
