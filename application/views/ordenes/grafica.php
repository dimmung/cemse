<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->view('header.php') ?>

<div class="text-center">

  <?php if ($this->session->userdata('ver') == 1) {
    echo $error;}?>
</div>
<body>

<?php $this->view('menu.php'); ?>
<form id="frm-apreciacion" action="<?= base_url('ordenes/guardar_grafica'); ?>" enctype="multipart/form-data" method="post" accept-charset="utf-8" >

  <div class="col-md-4 offset-md-4 text-center">
    <p><b>FORMATO GENÉRICO DE ORDEN GRÁFICA</b> </p>
  </div>

  <div class="row">
    <div class="col-md-3 offset-md-3 text-right">
        <b><u>ORDEN GRÁFICA N° </u></b>
    </div>
      <div class="col-md-3 ">
        <input type="text" class="form-control form-control-sm" id="titulo" name="titulo" value="" autocomplete="off" placeholder="">
      </div>

  </div>
  <br>

  <div class="form-group row text-right">
      <div class="col-md-2">
              <p><b>REFERENCIAS:</b></p>
      </div>
      <div class="col-md-10 text-left">
              <textarea name="referencias" id="referencias" rows="3" class="textarea-lg"></textarea>
      </div>
  </div>
  <br>
  <div class="form-group row text-right">
      <div class="col-md-2">
              <p><b>HUSO HORARIO:</b></p>
      </div>
      <div class="col-md-10 text-left">
              <textarea name="huso" id="huso" rows="1" class="textarea-lg"></textarea>
      </div>
  </div>
  <br>
  <div class="form-group row text-right">
      <div class="col-md-2">
              <p><b>ORGANIZACIÓN DE TAREAS:</b></p>
      </div>
      <div class="col-md-10 text-left">
              <textarea name="organizacion" id="organizacion" rows="1" class="textarea-lg"></textarea>
      </div>
  </div>
  <br>
  <div class="form-group row text-right">
      <div class="col-md-2">
              <p><b>1. SITUACIÓN</b></p>
      </div>
      <div class="col-md-10 text-left">
              <textarea name="situacion" id="situacion" rows="10" class="textarea-lg"></textarea>
      </div>
  </div>
  <br>
  <div class="form-group row text-right">
      <div class="col-md-2">
              <p><b>2. MISIÓN</b></p>
      </div>
      <div class="col-md-10 text-left">
              <textarea name="mision"  id="mision" rows="8" class="textarea-lg"></textarea>
      </div>
  </div>
  <br>
  <div class="form-group row text-right">
      <div class="col-md-2">
              <p><b>3. EJECUCIÓN</b></p>
      </div>
      <div class="col-md-10 text-left">
              <textarea name="ejecucion" id="ejecucion" rows="10" class="textarea-lg"></textarea>
      </div>
  </div>
  <br>

  <div class="form-group row text-right">
      <div class="col-md-2">
              <p><b>4. APOYO AL COMBATE</b></p>
      </div>
      <div class="col-md-10 text-left">
              <textarea name="apoyo" id="apoyo" rows="10" class="textarea-lg"></textarea>
      </div>
  </div>
  <br>
  <div class="form-group row text-right">
      <div class="col-md-2">
              <p><b>5. MANDO Y COMUNICACIONES</b></p>
      </div>
      <div class="col-md-10 text-left">
              <textarea name="mando" id="mando" rows="10" class="textarea-lg"></textarea>
      </div>
  </div>
  <div class="col-md-4 offset-md-4 text-center">
      <p><b>Imagen</b></p>
      <input type="file" name="userfile" size="20" required/>

  </div>
    <br>
    <br>
    <br>
  <div class="col-md-4 offset-md-4 text-center">
      <p><b>FIRMA</b></p>
      <textarea name="firmas" id="firmas" rows="4" ></textarea>

  </div>


  <button type="submit" class="btn btn-rose btn-sm derecha" id="crear_orden">Crear</button>

</form>

<?php $this->session->set_userdata('ver',0); ?>
</body>

<script src="<?= base_url('/assets/js/sweetalert2.all.js')?>"></script>
<script src="<?= base_url('/assets/js/usuario.js')?>"></script>
<script src="<?= base_url('/assets/js/juego.js')?>"></script>
<script type="text/javascript">
$("#datos_ejemplar").trumbowyg({
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
$("#referencias").trumbowyg({
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
$("#huso").trumbowyg({
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
$("#mision").trumbowyg({
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
$("#situacion").trumbowyg({
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
$("#ejecucion").trumbowyg({
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
$("#apoyo").trumbowyg({
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
$("#mando").trumbowyg({
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
$("#firmas").trumbowyg({
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

$("#organizacion").trumbowyg({
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
</html>
