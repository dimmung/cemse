<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->view('header.php') ?>
<body>

<?php $this->view('menu.php'); ?>
<form id="frm-mensaje" action="<?= base_url('mensajes/procesar'); ?>" enctype="multipart/form-data" method="post" accept-charset="utf-8" >

  <div class="form-group row mensaje ">
      <?php $Date = date('d-m-Y H:i:s', strtotime($datos -> fecha)); ?>
    <label for="fecha" class="col-sm-2 col-form-label col-form-label-sm strong  ">Fecha</label>
    <div class="col-sm-6">
      <input type="text" name=""  class=" form-control-plaintext " value="<?= $Date ?>">
    </div>
    <div class="col-sm-2 text-right">
      <button type="submit" name="responder" value="1" class="btn  btn-sm "> <i class="fas fa-reply"></i> &nbsp;Responder</button>
      </div>
    <div class="col-sm-2 ">
      <button type="submit" name="reenviar" value="1" class="btn  btn-sm "> <i class="fas fa-share"></i> &nbsp;Reenviar</button>
      </div>
  </div>
  <div class="form-group row mensaje ">
    <label for="remitente" class="col-sm-2 col-form-label col-form-label-sm strong  ">De</label>
    <div class="col-sm-10">
      <input type="text" name="remitente"  class=" form-control-plaintext " value="<?= $datos -> remitente ?>">
      <input type="text" name="id_remitente"  class=" form-control-plaintext " value="<?= $datos -> id_remitente ?>" hidden>
    </div>
  </div>
  <div class="form-group row mensaje ">
    <label for="destinatarios" class="col-sm-2 col-form-label col-form-label-sm strong ">Para</label>
    <div class="col-sm-10">
      <input type="text" name=""  class=" form-control-plaintext " value="<?= $datos -> receptores ?>">
    </div>
  </div>
  <div class="form-group row mensaje ">
    <label for="remitente" class="col-sm-2 col-form-label col-form-label-sm strong  ">Situación</label>
    <div class="col-sm-10">
      <input type="text" name=""  class=" form-control-plaintext " value="<?= $datos -> situacion?>">
      <input type="text" name="situacion"  class=" form-control-plaintext " value="<?= $datos -> id_situacion?>" >
    </div>
  </div>
  <div class="form-group row">
    <label for="asunto" class="col-sm-2 col-form-label col-form-label-sm strong ">Asunto</label>
    <div class="col-sm-10">
      <input type="text" class=" form-control-plaintext " id="asunto" name="asunto" placeholder="asunto" value="<?= $datos -> asunto ?>" required>
    </div>
  </div>
  <div class="form-group row">
    <label for="asunto" class="col-form-label col-form-label-sm col-sm-2 strong">Mensaje</label>
    <textarea name="contenido" rows="8" cols="80" hidden><?= $datos -> contenido ?></textarea>
      <div class="textarea offset-md-2">
        <?= $datos -> contenido ?>
      </div>
  </div>
  <br><br>
  <div class="form-group row">
    <label for="asunto" class="col-sm-2 col-form-label col-form-label-sm strong ">Adjunto</label>
    <div class="col-sm-10">
      <a href="<?= base_url('/biblioteca/adjuntos/'.$datos -> adjunto ) ?>" class="link_orden" target="_blank"><?= $datos -> adjunto ?></a>
    </div>
  </div>
  <div class="form-group row">
    <label for="asunto" class="col-form-label col-form-label-sm col-sm-2 strong">Órdenes Compartidas</label>
      <div class="">
        <?php if ($ordenes){ ?>


        <?php foreach ($ordenes as $orden){
            ?>
           <a href="<?= base_url("ordenes/ver/".$orden->id_orden) ?>" class="link_orden"><?= $orden->titulo ?> </a>

            <?php
        } ?>
      <?php } ?>
      </div>
  </div>


</form>


</body>

<script src="<?= base_url('/assets/js/sweetalert2.all.js')?>"></script>
<script src="<?= base_url('/assets/js/usuario.js')?>"></script>
<script src="<?= base_url('/assets/js/juego.js')?>"></script>


</html>

<script type="text/javascript">

$( document ).ready(function() {
  $.ajax({
    url: baseUrl+ 'mensajes/update/<?= $datos -> id ?>',
    success: function(result) {
    }
  });
});


</script>
