<!-- estadisticas_view.php - Vista del controlador estadistica.php -->

  <!-- Grocery Crud CSS -->
  <?php foreach($css_files as $file): ?>
    <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
  <?php endforeach; ?>
  <!-- Grocery Crud Javascript -->
  <?php foreach($js_files as $file): ?>
    <script src="<?php echo $file; ?>"></script>
  <?php endforeach; ?>
<!-- Texto principal -->
<div class="container-fluid">
  <h2> Estad&iacute;sticas de Usuario </h2>
  <P ALIGN=center>Muestra las estad&iacute;sticas de asistencia de los usuarios a las convocatorias .</P>
</div>
<!-- Rendering CRUD -->
<div class="container-fluid">
<?php echo $output; ?>
</div>