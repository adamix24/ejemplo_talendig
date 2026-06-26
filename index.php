<?php
  require_once 'partes/db.php';
  $titulo = 'Agenda Shell · Contactos';
  include 'partes/cabecera.php';
?>

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
                  $contactos = contactos_todos();

                  foreach($contactos as $datos){

                      $id = (string) $datos->_id;
                      $llamadas = (isset($datos->llamadas))?count($datos->llamadas):0;
                      $hayContactos = true;

                      $nombre    = htmlspecialchars($datos->nombre ?? '');
                      $apellido  = htmlspecialchars($datos->apellido ?? '');
                      $telefono  = htmlspecialchars($datos->telefono ?? '');

                    echo "<tr>
                        <td class='contact-name'>{$nombre}</td>
                        <td>{$apellido}</td>
                        <td><i class='fa fa-phone-flip text-muted me-1'></i>
                        <a href='tel:{$telefono}'>{$telefono}</a></td>
                        <td><span class='calls-badge'><i class='fa fa-clock-rotate-left'></i>{$llamadas}</span></td>
                          <td class='text-end'>
                            <span class='actions'>
                              <a class='btn btn-success btn-icon' title='Editar' href='edit_contacto.php?id={$id}'>
                                <i class='fa fa-edit'></i>
                              </a>
                              <a href='contacto.php?id={$id}' class='btn btn-info btn-icon' title='Registrar llamada'>
                                <i class='fa fa-phone'></i>
                              </a>
                              <a href='imprimir.php?id={$id}' target='ifPrint' class='btn btn-warning btn-icon' title='Imprimir'>
                                <i class='fa fa-print'></i>
                              </a>
                            </span>
                          </td>
                        </tr>";

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
