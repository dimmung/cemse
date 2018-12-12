<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->view('header.php') ?>
<body>

<?php $this->view('menu.php'); ?>
<form class="" action="<?= base_url('pdfs/plan/'.$orden -> id_orden) ?>" method="post">
  <button type="submit" name="datos" class="btn btn-rose " id="datos" ><i class="fas fa-print"></i> Imprimir Pdf</button>
</form>
<form id="frm-apreciacion" action="<?= base_url('ordenes/guardar'); ?>" enctype="multipart/form-data" method="post" accept-charset="utf-8" >

  <div class="col-md-4 offset-md-4 text-center">
    <p><b>FORMATO GENÉRICO DE PLAN U ORDEN</b> </p>
  </div>
  <div class="form-group row text-center">
      <div class="col-md-4">
              <p>EJÉRCITO DE CHILE</p>
      </div>
      <div class="col-md-4">
              <p><b>SECRETO</b> </p>
      </div>
      <div class="col-md-4  text-left">
        <div class="textarea">
          <?= $orden -> datos_ejemplar ?>
        </div>
      </div>
  </div>
  <div class="row">
    <div class="col-md-3 offset-md-3 ">
        <b><u>PLAN (ORDEN) DE</u></ text-rightb>
    </div>
      <div class="col-md-3 ">
        <input type="text" class="form-control form-control-sm form-control-plaintext" id="titulo" name="titulo" value="<?=  $orden-> titulo ?>" autocomplete="off" placeholder="">
      </div>

  </div>
  <br>
  <div class="col-md-2 text-right">
          <p><b>REFERENCIAS:</b></p>
  </div>
  <div class="form-group row offset-md-1 ">

      <div class="textarea">
        <?= $orden -> referencias ?>
      </div>
  </div>
  <br>
  <div class="col-md-2 text-right">
          <p><b>HUSO HORARIO:</b></p>
  </div>
  <div class="form-group row offset-md-1">

      <div class="textarea">
        <?= $orden -> huso ?>
      </div>
  </div>
  <br>
  <div class="col-md-2 text-right">
          <p><b>ORGANIZACIÓN DE TAREA</b></p>
  </div>
  <div class="form-group row offset-md-1">

      <div class="textarea">
        <?= $orden -> organizacion ?>
      </div>
  </div>
  <div class="col-md-2 text-right">
          <p><b>1. SITUACIÓN</b></p>
  </div>
  <div class="form-group row offset-md-1 ">

      <div class="textarea">
        <?= $orden -> situacion ?>
      </div>
  </div>
  <br>
  <div class="col-md-2 text-right">
          <p><b>2. MISIÓN</b></p>
  </div>
  <div class="form-group row offset-md-1">

      <div class="textarea">
        <?= $orden -> mision ?>
      </div>
  </div>
  <br>
  <div class="col-md-2 text-right">
          <p><b>3. EJECUCIÓN</b></p>
  </div>
  <div class="form-group row offset-md-1">

      <div class="textarea">
        <?= $orden -> ejecucion ?>
      </div>
  </div>
  <br>
  <div class="col-md-2 text-right">
          <p><b>4. APOYO AL COMBATE</b></p>
  </div>
  <div class="form-group row offset-md-1">

      <div class="textarea">
        <?= $orden -> apoyo ?>
      </div>
  </div>
  <br>
  <div class="col-md-2 text-right">
          <p><b>5. MANDO Y COMUNICACIONES</b></p>
  </div>
  <div class="form-group row offset-md-1">

      <div class="textarea">
        <?= $orden -> mando ?>
      </div>
  </div>

  <div class="col-md-4 offset-md-4 text-center">
    <div class="textarea">
      <?= $orden -> firmas ?>
    </div>

  </div>



</form>


</body>

<script src="<?= base_url('/assets/js/sweetalert2.all.js')?>"></script>
<script src="<?= base_url('/assets/js/usuario.js')?>"></script>
<script src="<?= base_url('/assets/js/juego.js')?>"></script>


</html>
