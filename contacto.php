<?php
  $id = isset($_GET['id'])?$_GET['id']:'';

  $posible = "datax/{$id}";

  if(!is_file($posible)){
     header("Location:./");
     exit;
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
    exit;
  }

  $titulo = 'Agenda · Llamadas de '.$contacto->nombre;
  include 'partes/cabecera.php';
?>

    <div class="container my-4">

        <div class="mb-4">
          <a href="./" class="text-decoration-none small"><i class="fa fa-arrow-left me-1"></i> Volver a contactos</a>
          <h1 class="page-title h3 mt-2">Llamadas a <?= htmlspecialchars($contacto->nombre); ?></h1>
          <p class="page-subtitle">Registra una nueva llamada a este contacto</p>
        </div>

        <div class="row g-4">

          <div class="col-lg-5">
            <div class="app-card">
              <h2 class="h6 text-uppercase text-muted mb-3"><i class="fa fa-phone-volume me-1"></i> Nueva llamada</h2>
              <form method="post" action="<?= htmlspecialchars($_SERVER['REQUEST_URI']); ?>">
                <div class="mb-3">
                  <label class="form-label-strong">Fecha</label>
                  <input required type="date" name="fecha" class="form-control">
                </div>
                <div class="mb-3">
                  <label class="form-label-strong">Motivo</label>
                  <textarea required class="form-control" name="motivo" rows="3" placeholder="¿Para qué llama?"></textarea>
                </div>
                <div class="mb-4">
                  <label class="form-label-strong">Empleado</label>
                  <input required type="text" name="empleado" class="form-control" placeholder="¿Quién llama?">
                </div>
                <div class="d-grid">
                  <button type="submit" class="btn btn-primary btn-lg-soft">
                    <i class="fa fa-floppy-disk me-1"></i> Guardar llamada
                  </button>
                </div>
              </form>
            </div>
          </div>

          <div class="col-lg-7">
            <h2 class="h6 text-uppercase text-muted mb-3"><i class="fa fa-clock-rotate-left me-1"></i> Histórico de contacto</h2>
            <?php
              if(isset($contacto->llamadas) && count($contacto->llamadas)){
                foreach(array_reverse($contacto->llamadas) as $llamada){

                  $fecha = htmlspecialchars($llamada->fecha);
                  $motivo = htmlspecialchars($llamada->motivo);
                  $empleado = htmlspecialchars($llamada->empleado);

                  echo <<<FILA
                    <div class="call-item">
                        <span class="call-date"><i class="fa fa-calendar-day"></i> {$fecha}</span>
                        <p class="call-reason">{$motivo}</p>
                        <p class="call-author"><i class="fa fa-user me-1"></i> Hecho por {$empleado}</p>
                    </div>
FILA;
                }
              } else {
                echo "<div class='app-card empty-state'>
                  <div><i class='fa fa-phone-slash'></i></div>
                  <p class='mb-0'>Todavía no hay llamadas registradas.</p>
                </div>";
              }
            ?>
          </div>

        </div>

    </div>

<?php include 'partes/pie.php'; ?>
