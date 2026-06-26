<?php $titulo = 'Agenda del Futuro · Contactos'; include 'partes/cabecera.php'; ?>

    <div class="container my-4">

        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
          <div>
            <h1 class="page-title h3">Mis contactos</h1>
            <p class="page-subtitle">Administra tu agenda y el historial de llamadas</p>
          </div>
          <a href="edit_contacto.php" class="btn btn-primary btn-lg-soft btn-sm">
            <i class="fa fa-plus me-1"></i> Agregar contacto
          </a>
        </div>

        <div class="app-card p-0 overflow-hidden">
          <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
              <thead>
                  <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Teléfono</th>
                    <th>Llamadas</th>
                    <th class="text-end">Acciones</th>
                  </tr>
              </thead>
              <tbody>
                <?php
                  $hayContactos = false;
                  if(is_dir("datax")){
                    $archivos = scandir("datax");

                    foreach($archivos as $nombre){
                        $ruta = "datax/{$nombre}";

                        if(is_file($ruta)){

                          $datos = file_get_contents($ruta);
                          $datos = json_decode($datos);

                          $llamadas = (isset($datos->llamadas))?count($datos->llamadas):0;
                          $hayContactos = true;

                      echo "<tr>
                          <td class='contact-name'>{$datos->nombre}</td>
                          <td>{$datos->apellido}</td>
                          <td><i class='fa fa-phone-flip text-muted me-1'></i>
                          <a href='tel:{$datos->telefono}'>{$datos->telefono}</a></td>
                          <td><span class='calls-badge'><i class='fa fa-clock-rotate-left'></i>{$llamadas}</span></td>
                            <td class='text-end'>
                              <span class='actions'>
                                <a class='btn btn-success btn-icon' title='Editar' href='edit_contacto.php?id={$nombre}'>
                                  <i class='fa fa-edit'></i>
                                </a>
                                <a href='contacto.php?id={$nombre}' class='btn btn-info btn-icon' title='Registrar llamada'>
                                  <i class='fa fa-phone'></i>
                                </a>
                                <a href='imprimir.php?id={$nombre}' target='ifPrint' class='btn btn-warning btn-icon' title='Imprimir'>
                                  <i class='fa fa-print'></i>
                                </a>
                              </span>
                            </td>
                          </tr>";

                        }
                    }
                  }

                  if(!$hayContactos){
                    echo "<tr><td colspan='5'>
                      <div class='empty-state'>
                        <div><i class='fa fa-user-plus'></i></div>
                        <p class='mb-0'>Aún no tienes contactos. ¡Agrega el primero!</p>
                      </div>
                    </td></tr>";
                  }
                ?>
              </tbody>
            </table>
          </div>
        </div>

        <iframe name="ifPrint" style="display:none"></iframe>

    </div>

<?php include 'partes/pie.php'; ?>
