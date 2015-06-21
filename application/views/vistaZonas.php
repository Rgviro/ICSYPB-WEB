<!-- gestorconvocatorias_view.php - Vista del controlador gestorconvocatorias.php -->
  <!-- Grocery Crud CSS -->
    <head>
    <meta charset="utf-8" />
    <title>Zonas</title>
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
  <h2> Vista de Zonas </h2>
  <P ALIGN=center>Visualizaci&oacute;n de zonas.</P>
</div>
<!-- Rendering CRUD -->
<div class="container-fluid">
<?php echo $output; ?>
</div>

