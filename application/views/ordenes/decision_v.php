<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->view('header.php') ?>
<body>

<?php $this->view('menu.php'); ?>
<form class="" action="<?= base_url('pdfs/decision/'.$orden -> id_orden) ?>" method="post">
  <button type="submit" name="datos" class="btn btn-rose " id="datos" ><i class="fas fa-print"></i> Imprimir Pdf</button>
</form>
<form id="frm-apreciacion" action="<?= base_url('ordenes/guardar'); ?>" enctype="multipart/form-data" method="post" accept-charset="utf-8" >

  <div class="col-md-4 offset-md-4 text-center">
    <p><b>FORMATO GENÉRICO DE COMUNICADO DE DECISIÓN</b> </p>
  </div>
  <div class="row">
    <div class="col-md-3 offset-md-3 text-right">
        Clasificación de Unidad
    </div>
      <div class="col-md-3 ">
        <input type="text" class="form-control form-control-sm form-control-plaintext" id="clasificacion" name="clasificacion" value="<?=  $orden-> clasificacion ?>" autocomplete="off" placeholder="">
      </div>

  </div>
  <br>
  <div class="col-md-2 text-right">
          <p><b>ÓRDENES VERBALES PREVIAS</b></p>
  </div>
  <div class="form-group row offset-md-1">

      <div class="textarea">
        <?= $orden -> previas ?>
      </div>
  </div>
  <br>
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
        <b><u>COMUNICADO DE DECISIÓN N° </u></b>
    </div>
      <div class="col-md-3 ">
        <input type="text" class="form-control form-control-sm form-control-plaintext" id="titulo" name="titulo" value="<?=  $orden-> titulo ?>" autocomplete="off" placeholder="">
      </div>

  </div>
  <br>
  <div class="row">
    <div class="col-md-2  text-center">
        <b>DEL: </b>
    </div>
      <div class="col-md-3 ">
        <input type="text" class="form-control form-control-sm form-control-plaintext" id="del" name="del" value="<?=  $orden-> del ?>" autocomplete="off" placeholder="">
      </div>

  </div>
  <br>
  <div class="row">
    <div class="col-md-2  text-center">
        <b>AL: </b>
    </div>
      <div class="col-md-3 ">
        <input type="text" class="form-control form-control-sm form-control-plaintext" id="al" name="al" value="<?=  $orden-> al ?>" autocomplete="off" placeholder="">
      </div>

  </div>
  <br>
  <div class="col-md-2 text-right">
          <p><b>TEXTO:</b></p>
  </div>
  <div class="form-group row  offset-md-1 ">

      <div class="textarea">
        <?= $orden -> referencias ?>
      </div>
  </div>
  <br>

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
