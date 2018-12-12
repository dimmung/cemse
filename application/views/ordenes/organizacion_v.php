<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->view('header.php') ?>
<body>

<?php $this->view('menu.php'); ?>
<form class="" action="<?= base_url('pdfs/organizacion/'.$orden -> id_orden) ?>" method="post">
  <button type="submit" name="datos" class="btn btn-rose" id="datos" ><i class="fas fa-print"></i> Imprimir Pdf</button>
</form>
<form id="frm-apreciacion" action="<?= base_url('ordenes/guardar'); ?>" enctype="multipart/form-data" method="post" accept-charset="utf-8" >

  <div class="col-md-4 offset-md-4 text-center">
    <p><b>FORMATO GENÉRICO DE ORGANIZACIÓN DE TAREA</b> </p>
  </div>
  <br>
  <br>
  <div class="row">
    <div class="col-md-3 text-right">
        ORGANIZACIÓN DE TAREA DE LA
    </div>
    <div class="col-md-3 ">
      <input type="text" class="form-control form-control-sm form-control-plaintext" id="titulo" name="titulo" value="<?=  $orden-> titulo ?>" autocomplete="off" placeholder="">
    </div>


  </div>
  <br>
  <br>
  <div class="row">
    <div class="col-md-2  text-right">
        <b>DEL: </b>
    </div>
      <div class="col-md-3 ">
        <input type="text" class="form-control form-control-sm" id="del" name="del" value=" <?=  $orden-> del ?>" autocomplete="off" placeholder="">
      </div>
      <div class="col-md-2  text-center">
          <b>AL: </b>
      </div>
        <div class="col-md-3 ">
          <input type="text" class="form-control form-control-sm" id="al" name="al" value=" <?=  $orden-> al ?>" autocomplete="off" placeholder="">
        </div>

  </div>
  <br>
<br><br>
  <div class="form-group row text-left offset-md-1"  >
      <div class="col-md-3">
              <p><b>1.UNIDAD DE MANDO Y CONTROL</b></p>
      </div>

            <div class="textarea text-left " >
              <?= $orden -> referencias ?>
            </div>
  </div>
  <br>
  <div class="form-group row text-left offset-md-1"  >
      <div class="col-md-3">
              <p><b>2.UNIDADES SUBORDINADAS</b></p>
      </div>

            <div class="textarea text-left " >
              <?= $orden -> referencias ?>
            </div>
  </div>
  <br>

  <div class="col-md-4 offset-md-4 text-center">

            <p><b>FIRMA</b></p>

            <div class="textarea text-center">
              <?= $orden -> firmas ?>
            </div>

  </div>

  <button type="submit" class="btn btn-rose btn-sm derecha" id="crear_orden">Crear</button>

</form>


</body>

<script src="<?= base_url('/assets/js/sweetalert2.all.js')?>"></script>
<script src="<?= base_url('/assets/js/usuario.js')?>"></script>
<script src="<?= base_url('/assets/js/juego.js')?>"></script>

</html>
