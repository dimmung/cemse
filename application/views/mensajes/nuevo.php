<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->view('header.php') ?>

<body>

<?php $this->view('menu.php'); ?>
<?php if ($this->session->userdata('ver') == 1) {
  echo $error;}?>
<form id="frm-mensaje" action="<?= base_url('mensajes/enviar'); ?>" enctype="multipart/form-data" method="post" accept-charset="utf-8" >
  <div class="form-group row">
    <label for="Hora" class="col-sm-2 col-form-label col-form-label-sm">Hora</label>
    <div class="col-sm-10">
      <input type="datetime-local" class="form-control col-sm-3" id="date1" name="date" readonly>
    </div>
  </div>
  <div class="form-group row">
    <label for="destinatarios" class="col-sm-2 col-form-label col-form-label-sm ">Para</label>
    <div class="col-sm-10">
      <select data-placeholder="Seleccione uno o varios Destinatarios" class="chosen-select ancho" multiple tabindex="4" id="destinatarios" name="destinatarios[]" class="chosen-container" >
        <?php
        foreach($destinatarios as $fila)
        {
        ?>
            <option value="<?= $fila -> id_rol ?>" ><?= $fila -> nombre_rol ?></option>
        <?php
        }
        ?>
      </select>
    </div>
  </div>
  <div class="form-group row">
    <label for="asunto" class="col-sm-2 col-form-label col-form-label-sm">Asunto</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="asunto" name="asunto" placeholder="" required>
    </div>
  </div>
  <div class="form-group row">
    <label for="situacion" class="col-form-label col-form-label-sm col-sm-2">Situación</label>
    <select id="id_situacion" name="id_situacion" type="text" class="form-control form-control-sm col-sm-10 "  >
      <option value="0" selected >Seleccione  Situación</option>
      <?php

      foreach($situaciones as $fila)
      {
      ?>
          <option value="<?= $fila -> id_situacion ?>"  ><?= $fila -> nombre ?></option>
      <?php
      }
      ?>
    </select>
  </div>
  <div class="form-group row">
    <label for="asunto" class="col-form-label col-form-label-sm col-sm-2">Mensaje</label>
    <textarea name="mensaje" rows="8" class="col-sm-2 " id="mensaje"></textarea>
  </div>
  <div class="form-group row">
    <div class="col-md-2">
      <div class="form-check">
        <input class="form-check-input" type="checkbox" id="adjuntar" name="adjuntar">
        <label class="form-check-label" for="adjuntar">
          Adjuntar
        </label>
        <input type="file" name="file" size="20" style="display:none;" id="file"/>
      </div>
    </div>
  </div>
  <div class="form-group row">
    <label for="ordenes" class="col-sm-2 col-form-label col-form-label-sm ">Compartir Órdenes</label>
    <div class="col-sm-10">
      <select data-placeholder="Seleccione uno o varias Órdenes " class="chosen-select ancho" multiple tabindex="4" id="ordenes" name="ordenes[]" class="chosen-container" >
        <?php
        foreach($ordenes as $fila)
        {
        ?>
            <option value="<?= $fila -> id_orden ?>" ><?= $fila -> tipo_orden ." - ". $fila -> titulo ?> </option>
        <?php
}
        ?>
      </select>
    </div>
  </div>

  <div class="form-group row">
    <div class="col-sm-10">
      <button type="submit" class="btn btn-green derecha" >Enviar</button>
    </div>

  </div>

</form>


</body>

<script src="<?= base_url('/assets/js/sweetalert2.all.js')?>"></script>
<script src="<?= base_url('/assets/js/usuario.js')?>"></script>
<script src="<?= base_url('/assets/js/juego.js')?>"></script>


<?php $this->session->set_userdata('ver',0); ?>
</html>
<link rel="stylesheet" type="text/css" href="<?= base_url('/assets/css/chosen.min.css') ?>">
<link rel="stylesheet" type="text/css" href="<?= base_url('/assets/css/yellow-text-default.css') ?>">
<script src="<?= base_url('/assets/js/chosen.jquery.js') ?>"></script>
<script src="<?= base_url('/assets/js/init.js') ?>"></script>
<script src="<?= base_url('/assets/js/yellow-text.js') ?>"></script>
<script type="text/javascript">

   $(".chosen-select").chosen({no_results_text: "Oops, no hay coincidencias!"});
   $(".chosen-select").chosen({width: "100%"});
   $("#mensaje").trumbowyg({
     btns: [
         ['viewHTML'],
         ['undo', 'redo'], // Only supported in Blink browsers
         ['formatting'],
         ['strong', 'em', 'del'],
         ['superscript', 'subscript'],
         ['link'],
         ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
         ['unorderedList', 'orderedList'],
         ['horizontalRule'],
         ['removeformat'],
     ],
     autogrow: true
   });


</script>

<script type="text/javascript">

var actualizarHora1 = function(){
  // Obtenemos la fecha actual, incluyendo las horas, minutos, segundos, dia de la semana, dia del mes, mes y año;
  var fecha1 = new Date(),

    nueva = fecha1.setHours(fecha1.getHours()+<?= $this->session->userdata('hora') ?>),
    horas = fecha1.getHours(),
    minutos = fecha1.getMinutes(),
    segundos = fecha1.getSeconds(),
    diaSemana = fecha1.getDay(),
    dia = fecha1.getDate(),
    mes = fecha1.getMonth()+1,
    year = fecha1.getFullYear();
    if (horas < 10){ horas = "0" + horas; };
    if (minutos < 10){ minutos = "0" + minutos; };
    if (segundos < 10){ segundos = "0" + segundos; };
    if (mes < 10){ mes = "0" + mes; };
    if (dia < 10){ dia = "0" + dia; };

  $('#date1').val(year+'-'+mes+'-'+dia+'T'+horas+':'+minutos+':'+segundos);
  };
actualizarHora1();
var intervalo1 = setInterval(actualizarHora1, 1000);

$('#adjuntar').click(function() {
  if ($('#adjuntar').prop('checked')) {
    $('#file').show();
  } else {
    $('#file').hide();
  }

});
</script>
