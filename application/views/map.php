<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->view('header');
require_once ("menu.php");
?>
<img src="<?= base_url('assets/img/cargando1.gif') ?>" alt="" id="load" style="display:none;">
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
