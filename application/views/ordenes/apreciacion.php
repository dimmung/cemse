<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->view('header.php') ?>

<body>

<?php $this->view('menu.php'); ?>
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
              <textarea name="datos_ejemplar" id="datos_ejemplar" rows="3" class="" ></textarea>
      </div>
  </div>
  <div class="row">
    <div class="col-md-3 offset-md-3 text-right">
        <b><u>APRECIACIÓN DE</u></b>
    </div>
      <div class="col-md-3 ">
        <input type="text" class="form-control form-control-sm" id="titulo" name="titulo" value="" autocomplete="off" placeholder="">
      </div>

  </div>
  <br>
  <div class="row">
    <div class="col-md-3 offset-md-3 text-right">
        <b>OPERACIÓN</b>
    </div>
      <div class="col-md-3 ">
        <input type="text" class="form-control form-control-sm" id="operacion" name="operacion" value="" autocomplete="off" placeholder="">
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
  <div class="form-group row text-right">
      <div class="col-md-2">
              <p><b>1. MISIÓN</b></p>
      </div>
      <div class="col-md-10 text-left">
              <textarea name="mision" id="mision" rows="8" class="textarea-lg"></textarea>
      </div>
  </div>
  <br>
  <div class="form-group row text-right">
      <div class="col-md-2">
              <p><b>2. SITUACIÓN Y CONSIDERACIONES</b></p>
      </div>
      <div class="col-md-10 text-left">
              <textarea name="situacion" id="situacion" rows="10" class="textarea-lg"></textarea>
      </div>
  </div>
  <br>
  <div class="form-group row text-right">
      <div class="col-md-2">
              <p><b>3. CURSOS DE ACCÍON</b></p>
      </div>
      <div class="col-md-10 text-left">
              <textarea name="cursos" id="cursos" rows="10" class="textarea-lg"></textarea>
      </div>
  </div>
  <br>
  <div class="form-group row text-right">
      <div class="col-md-2">
              <p><b>4. ANÁLISIS</b></p>
      </div>
      <div class="col-md-10 text-left">
              <textarea name="analisis" id="analisis" rows="10" class="textarea-lg"></textarea>
      </div>
  </div>
  <br>
  <div class="form-group row text-right">
      <div class="col-md-2">
              <p><b>4. COMPARACIÓN</b></p>
      </div>
      <div class="col-md-10 text-left">
              <textarea name="comparacion" id="comparacion" rows="10" class="textarea-lg"></textarea>
      </div>
  </div>
  <br>
  <div class="form-group row text-right">
      <div class="col-md-2">
              <p><b>6. RECOMENDACIONES Y CONCLUSIONES</b></p>
      </div>
      <div class="col-md-10 text-left">
              <textarea name="recomendaciones" id="recomendaciones" rows="10" class="textarea-lg"></textarea>
      </div>
  </div>

  <div class="col-md-4 offset-md-4 text-center">
    <textarea name="firmas" id="firmas" rows="4" ></textarea>

  </div>

  <button type="submit" class="btn btn-rose btn-sm derecha" id="crear_orden">Crear</button>

</form>


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
    $("#analisis").trumbowyg({
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
    $("#comparacion").trumbowyg({
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
    $("#recomendaciones").trumbowyg({
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

</script>


</html>
