<?php
  require_once 'partes/db.php';
  $titulo = 'Agenda Shell · Datos del contacto';
  include 'partes/cabecera.php';
?>

    <div class="container my-4">

        <div class="d-flex justify-content-between align-items-center mb-4">
          <div>
            <h1 class="page-title h3">Datos del contacto</h1>
            <p class="page-subtitle">Completa la información de la persona</p>
          </div>
          <div id="divBorrar"></div>
        </div>

        <div class="app-card" style="max-width:640px;">
          <form method="post" action="guardar.php">

            <input type="hidden" name="codigo" value="<?= (isset($_GET['id']))?$_GET['id']:''; ?>"/>

            <div class="input-group mb-3"><label class="input-group-text">Nombre</label> <input required class="form-control" type="text" name="nombre"/> </div>
            <div class="input-group mb-3"><label class="input-group-text">Apellido</label> <input class="form-control" type="text" name="apellido"/> </div>
            <div class="input-group mb-3"><label class="input-group-text">Teléfono</label> <input class="form-control" type="text" name="telefono"/> </div>
            <div class="input-group mb-3"><label class="input-group-text">T. Sangre</label>
                  <select class="form-select" name="tsangre">
                    <option></option>
                    <option>A+</option>
                    <option>A-</option>
                    <option>B+</option>
                    <option>B-</option>
                    <option>O+</option>
                    <option>O-</option>
                  </select>
             </div>
            <div class="input-group mb-3"><label class="input-group-text">Cédula</label> <input class="form-control" maxlength="12" type="text" name="cedula"/> </div>
            <div class="input-group mb-4"><label class="input-group-text">F. Nacimiento</label> <input class="form-control" type="date" name="fnacimiento"/> </div>

            <div class="d-flex justify-content-between">
                <a onclick="return confirm('Seguro?')" class="btn btn-outline-secondary" href="./">
                  <i class="fa fa-xmark me-1"></i> Cancelar
                </a>
                <button class="btn btn-success btn-lg-soft">
                  <i class="fa fa-floppy-disk me-1"></i> Guardar
                </button>
            </div>

          </form>
        </div>

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

          $datos = contacto_obtener($archivo);

          if($datos){


            echo <<<LINEA

            <script>

              document.getElementById('divBorrar').innerHTML = '<a onclick="return confirm(\'Seguro que quiere borrar\');" href="delete.php?id=$archivo" class="btn btn-danger btn-lg-soft"><i class="fa fa-trash me-1"></i> Eliminar</a>';

  LINEA;



            foreach($datos as $campo=>$valor){

              if($campo !== 'llamadas' && $campo !== '_id'){

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

<?php include 'partes/pie.php'; ?>
