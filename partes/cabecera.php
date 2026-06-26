<?php
  /* Encabezado compartido. Definir $titulo antes de incluir si se desea. */
  $titulo = isset($titulo) ? $titulo : 'Agenda Shell';
  include __DIR__ . '/logo.php';
?>
<!DOCTYPE html>
<html lang="es">
  <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title><?= htmlspecialchars($titulo) ?></title>

      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="assets/app.css">
  </head>
  <body>
    <nav class="app-nav no-print">
      <div class="container py-2 d-flex align-items-center justify-content-between">
        <a class="brand" href="index.php">
          <?= shell_logo(46) ?>
          <span class="brand-text">Shell
            <small>Agenda de contactos</small>
          </span>
        </a>
        <span class="brand-tag d-none d-sm-inline">Estación de servicio</span>
      </div>
    </nav>
