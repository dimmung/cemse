<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->view('header.php') ?>
<body>

<?php $this->view('menu.php'); ?>
<form class="" action="<?= base_url('pdfs/apreciacion/'.$orden -> id_orden) ?>" method="post">
  <button type="submit" name="datos" class="btn btn-rose " id="datos" ><i class="fas fa-print"></i> Imprimir Pdf</button>
</form>


<form id="frm-apreciacion" action="<?= base_url('ordenes/guardar'); ?>" enctype="multipart/form-data" method="post" accept-charset="utf-8" >


  <div class="col-md-4 offset-md-4 text-center">
    <p><b>FORMATO BÁSICO DE APRECIACIÓN</b> </p>
    <p><b>(CORFORME CON FM 5-0)</b> </p>
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
    <div class="col-md-3 offset-md-3 text-right">
        <b><u>APRECIACIÓN DE</u></b>
    </div>
      <div class="col-md-3 ">
        <input type="text" class="form-control form-control-sm form-control-plaintext" id="titulo" name="titulo" value="<?=  $orden-> titulo ?>" autocomplete="off" placeholder="">
      </div>

  </div>
  <br>
  <div class="row">
    <div class="col-md-3 offset-md-3 text-right">
        <b>OPERACIÓN</b>
    </div>
      <div class="col-md-3 ">
        <input type="text" class="form-control form-control-sm form-control-plaintext" id="operacion" name="operacion" value="<?=  $orden-> operacion ?>" autocomplete="off" placeholder="">
      </div>
  </div>
  <br>
  <div class="col-md-3 text-right">
          <p><b>REFERENCIAS:</b></p>
  </div>
  <div class="form-group row  offset-md-1 ">


        <div class="textarea">
          <?= $orden -> referencias ?>
        </div>

  </div>
  <br>
  <div class="col-md-3 text-right">
          <p><b>HUSO HORARIO:</b></p>
  </div>
  <div class="form-group row  offset-md-1">


        <div class="textarea">
          <?= $orden -> huso ?>
        </div>

  </div>
  <div class="col-md-3 text-right">
          <p><b>1. MISIÓN</b></p>
  </div>
  <div class="form-group row offset-md-1 ">


        <div class="textarea">
          <?= $orden -> mision ?>
        </div>

  </div>
  <br>
  <div class="col-md-3 text-right">
          <p><b>2. SITUACIÓN Y CONSIDERACIONES</b></p>
  </div>

  <div class="form-group row offset-md-1 ">

        <div class="textarea">
          <?= $orden -> situacion ?>
        </div>

  </div>
  <br>
  <div class="col-md-3 text-right">
          <p><b>3. CURSOS DE ACCÍON</b></p>
  </div>
  <div class="form-group row offset-md-1">


        <div class="textarea">
          <?= $orden -> cursos ?>
        </div>

  </div>
  <br>
  <div class="col-md-3 text-right">
          <p><b>4. ANÁLISIS</b></p>
  </div>
  <div class="form-group row offset-md-1">


        <div class="textarea">
          <?= $orden -> analisis ?>
        </div>

  </div>
  <br>

  <div class="col-md-3 text-right">
          <p><b>4. COMPARACIÓN</b></p>
  </div><div class="form-group row offset-md-1">


        <div class="textarea">
          <?= $orden -> comparacion ?>
        </div>

  </div>
  <br>

  <div class="col-md-4 text-right">
          <p><b>6. RECOMENDACIONES Y CONCLUSIONES</b></p>
  </div><div class="form-group row offset-md-1">


        <div class="textarea">
          <?= $orden -> recomendaciones ?>
        </div>

  </div>

  <div class="col-md-4 offset-md-4 text-center">
    <p><b>FIRMA</b></p>
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
