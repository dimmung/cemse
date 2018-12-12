<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->view('header.php') ?>
<body>

<?php $this->view('menu.php') ?>
<div id="my-node">
<iframe src="https://manager.giscloud.com" id="my-node1"></iframe>

</body>

<script type="text/javascript" src="http://api.giscloud.com/1/api.js"></script>
<script src="<?= base_url('/assets/js/sweetalert2.all.js')?>"></script>
<script src="<?= base_url('/assets/js/juego.js')?>"></script>
<script src="<?= base_url('/assets/js/map_inventario.js')?>"></script>
</html>
