<?php
  require_once 'partes/db.php';

  $id = isset($_GET['id'])?$_GET['id']:'';

  $contacto = contacto_obtener($id);

  if(!$contacto){
     header("Location:./");
     exit;
  }

  $titulo = 'Ficha de '.$contacto->nombre;
  include 'partes/cabecera.php';

  // Etiquetas legibles para los campos
  $etiquetas = [
    'nombre' => 'Nombre',
    'apellido' => 'Apellido',
    'telefono' => 'Teléfono',
    'tsangre' => 'Tipo de sangre',
    'cedula' => 'Cédula',
    'fnacimiento' => 'Fecha de nacimiento',
    'codigo' => 'Código',
  ];
?>

    <div class="container my-4">

      <div class="text-end mb-3 no-print">
        <a href="index.php" class="btn btn-outline-secondary"><i class="fa fa-arrow-left me-1"></i> Volver</a>
        <button class="btn btn-primary" onclick="window.print()"><i class="fa fa-print me-1"></i> Imprimir</button>
      </div>

      <div class="doc-sheet">

        <header class="doc-letterhead">
          <div class="doc-brand">
            <?= shell_logo(56) ?>
            <div class="doc-company">Shell
              <small>Estación de servicio</small>
            </div>
          </div>
          <div class="doc-meta">
            <strong>Ficha de Contacto</strong>
            Emitido: <?= date('d/m/Y') ?><br>
            Ref: <?= htmlspecialchars($id) ?>
          </div>
        </header>

        <div class="doc-body">

          <h1 class="doc-title"><?= htmlspecialchars($contacto->nombre); ?> <?= htmlspecialchars(isset($contacto->apellido) ? $contacto->apellido : ''); ?></h1>
          <div class="doc-title-rule"></div>

          <div class="section-label">Datos personales</div>
          <table class="data-sheet">
              <?php
                  foreach($contacto as $campo=>$valor){

                    if($campo == 'llamadas' || $campo == 'codigo' || $campo == '_id'){
                      continue;
                    }
                    $nombreCampo = isset($etiquetas[$campo]) ? $etiquetas[$campo] : ucfirst($campo);
                    $valor = htmlspecialchars((string)$valor);
                    if($valor === '') { $valor = '—'; }
                    echo "<tr>
                        <th>{$nombreCampo}</th>
                        <td>{$valor}</td>
                    </tr>";
                  }
              ?>
          </table>

          <div class="section-label">Histórico de llamadas</div>
          <?php
            if(isset($contacto->llamadas) && count($contacto->llamadas)){
              foreach($contacto->llamadas as $llamada){

                $fecha = htmlspecialchars($llamada->fecha);
                $motivo = htmlspecialchars($llamada->motivo);
                $empleado = htmlspecialchars($llamada->empleado);

                echo <<<FILA
                  <div class="call-item">
                      <span class="call-date"><i class="fa fa-calendar-day"></i> {$fecha}</span>
                      <p class="call-reason">{$motivo}</p>
                      <p class="call-author">Atendido por {$empleado}</p>
                  </div>
FILA;
              }
            } else {
              echo "<p class='text-muted'>Sin llamadas registradas.</p>";
            }
          ?>

        </div>

        <footer class="doc-footer">
          <span>Shell &middot; Documento generado automáticamente por la Agenda de Contactos</span>
          <span>Confidencial</span>
        </footer>

      </div>

    </div>

    <script>
        window.print();
    </script>

<?php include 'partes/pie.php'; ?>
