<!-- gestorconvocatorias_view.php - Vista del controlador gestorconvocatorias.php -->
  <!-- Grocery Crud CSS -->
  <head>
    <meta charset="utf-8" />
    <title>Adminsitrador - Balizas a Zonas</title>
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
  <h2> Gesti&oacute;n de usuarios </h2>
  <P ALIGN=center>Asignaci&oacute;n, modificaci&oacute;n y borrado de balizas a zonas.</P>
</div>
<!-- Rendering CRUD -->
<div class="container-fluid">
<?php echo $output; ?>
</div>
