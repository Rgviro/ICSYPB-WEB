<!-- gestorconvocatorias_view.php - Vista del controlador gestorconvocatorias.php -->
  <!-- Grocery Crud CSS -->
  <head>
    <meta charset="utf-8" />
    <title>Administrador - Balizas</title>
 </head>
  <?php foreach($css_files as $file): ?>
    <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
  <?php endforeach; ?>
  <!-- Grocery Crud Javascript -->
  <?php foreach($js_files as $file): ?>
    <script src="<?php echo $file; ?>"></script>
  <?php endforeach; ?>
<!-- Texto principal -->
<div class="container-fluid">
  <h2> Gesti&oacute;n de balizas </h2>
  <P ALIGN=center>Creaci&oacute;n, modificaci&oacute;n y borrado de balizas.</P>
</div>
<!-- Rendering CRUD -->
<div class="container-fluid">
<?php echo $output; ?>
</div>
