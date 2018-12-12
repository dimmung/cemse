<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->view('header.php') ?>
<body>

<?php $this->view('menu.php') ?>
      <h2 class="text-center"> Inventario</h2>
      <div class="centrado">
      <?php if ($this->session->userdata('administrador') == 't'): ?>
      <a href="<?= base_url('/inventarios/modificar_inventario/'); ?>" >    <button type="button" name="button" class="btn btn-rose rol" value="">Modificar Inventario</button> </a>
<br><br>
<?php endif; ?>
        <?php if ($this->session->userdata('administrador') != 't'): ?>
        <a href="<?= base_url('/inventarios/crear_recorridos/'); ?>" >    <button type="button" name="button" class="btn btn-rose rol" value="">Crear Recorridos</button> </a>
      <br><br>
      <?php endif; ?>
        <?php if ($this->session->userdata('administrador') != 't'): ?>
        <a href="<?= base_url('/inventarios/mover_elementos/'); ?>" >    <button type="button" name="button" class="btn btn-rose rol" value="">Mover Elementos</button> </a>
      <br><br>
      <?php endif; ?>
        <?php if ($this->session->userdata('administrador') == 't'): ?>
      <a href="<?= base_url('/inventarios/vehiculos/'); ?>" >    <button type="button" name="button" class="btn btn-rose rol" value="">Vehiculos</button> </a>
<?php endif; ?>
    <br><br>
    <?php if ($this->session->userdata('administrador') == 't'): ?>
    <a href="<?= base_url('/inventarios/materiales/'); ?>" >    <button type="button" name="button" class="btn btn-rose rol" value="">Material y Personal</button> </a>
    <?php endif; ?>
      </div>

    <br><br>

  </div>
  <br><br>  <br>

</div> </div>

</div>


</div>
</body>

<script src="<?= base_url('/assets/js/juego.js')?>"></script>


<?php $this->session->set_userdata('ver',0); ?>
</html>
