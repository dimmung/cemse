<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->view('header');
 $this->view('menu.php')
?>
<img src="<?= base_url('assets/img/cargando1.gif') ?>" alt="" id="load" style="display:none;">
<button type="button" name="button" class="btn btn-rose btn-sm" id="dibujar"> <i class="fas fa-pen fa-xs"></i> &nbsp; Dibujar</button>
<input id="nombre_r" placeholder="Nombre del Recorrido"  style="display:none;" autocomplete="off" ></input>
<button type="button" name="button" class="btn btn-green btn-sm" id="comenzar" style="display:none;"> <i class="fas fa-play fa-xs"></i> &nbsp; Comenzar</button>
<div class="barra" id="barra" style="display:none;">
<button type="button" name="button" class="btn btn-light btn-sm btn-block " id="boton_cerrar"> Cerrar &nbsp; <i class="fas fa-times fa-xs"></i> </button>
<div id="busqueda">

</div>
</div>
<div id="mapViewer" class="mapa">

</div>

</body>
</html>
<script src="<?= base_url('/assets/js/map_principal.js') ?>"></script>
