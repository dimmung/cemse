<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {

	public function __construct() {
		parent::__construct();
    $this->load->model('Usuario');
		$this->load->model('Juego');
	}

  public function index() {
		if ($this->session->has_userdata('id_juego')) {

		$data['usuarios_x_juego'] = $this->Juego->get_users_game($this->session->userdata('id_juego'));
    $data['usuarios'] = $this->Usuario->get_users();
    $this->load->view('users/index', $data);
			} else {
			 redirect(base_url('/login/index/'));
		 }
  }

  public function crear() {
    $data['usuario'] = $this->input->post('usuario');
		$data['id_usuario'] = $this->input->post('rut');
    $data['nombre_apellido'] = $this->input->post('nombre_apellido');
    $data['password'] = hash("sha256",$this->input->post('clave'));
    $data['is_active'] = 't';
		$data['administrador'] = $this->input->post('administrador');
    $this->Usuario->guardar_usuario($data);
  }

  public function editar($id) {
    $data['nombre'] = $this->input->post('nombre');
    $data['email'] = $this->input->post('email');
    $data['rut'] = $this->input->post('rut');
    $data['rol'] = $this->input->post('rol');
    $data['is_active'] = $this->input->post('active');
    if($data['is_active'] == 'f') {
      date_default_timezone_set("America/Santiago");
      $data['inactive_at'] = date("Y-m-d");
    } else {
      $data['inactive_at'] = null;
    }
    $this->Usuario->guardar_usuario($data,$id);
    redirect(base_url('/usuarios/ver_perfil/'.$id));
  }

  public function bloquear($id) {
    $data['is_active'] = 'f';
    $data['inactive_at'] = date("Y-m-d");
    $this->Usuario->bloquear($data,$id);
    redirect(base_url('/usuarios/index'));
  }

	public function desbloquear($id) {
    $data['is_active'] = 't';
    $data['inactive_at'] = null;
    $this->Usuario->desbloquear($data,$id);
    redirect(base_url('/usuarios/index'));
  }

	public function restablecer_clave($id) {
		$data['password'] = hash("sha256",'cemse123');
		$this->Usuario->reset_pass($data,$id);
		return 1;
	}


	public function roles()
	{

		if ($this->session->has_userdata('id_juego')) {

		$data['usuarios'] = $this->Juego->get_users_game($this->session->userdata('id_juego'));
		$data['permisos'] = $this->Usuario->get_permisos();
		$data['roles'] = $this->Usuario->get_roles($this->session->userdata('id_juego'));
		 $this->load->view('users/roles',$data);
	 } else {
		 redirect(base_url('/login/index/'));
	 }
	}



	public function crear_rol() {
		$data['id_juego']   = $this->session->userdata('id_juego');
		$data['nombre_rol'] = $this->input->post('nombre_rol');
		$data['id_usuario'] = $this->input->post('id_usuario');
		$data['director'] = $this->input->post('director');
		$id = $this->Usuario->guardar_rol($data);
		$datos 	= $this->input->post('permisos[]');
		$this->Usuario->guardar_permisos($id,$datos);
	}



	public function eliminar_rol($id) {
		$this->Usuario->eliminar_permisos($id);
		$this->Usuario->eliminar_rol($id);
	}

	public function permisos() {
		$data['roles'] = $this->Usuario->get_all_roles();
		$data['permisos'] = $this->Usuario->get_permisos();
		$data['permisos_rol'] = $this->Usuario->get_permisos_rol();
		$this->load->view('users/permisos', $data);
	}

	public function change_pass()
	{
			$data['password'] = hash("sha256",$this->input->post('clave'));
			$this->Usuario->guardar_usuario($data,$this->session->userdata('id'));
			redirect(base_url('/login/cerrar_sesion'));
	}


	public function ver_rol($id){
		$usuarios= $this->Juego->get_users_game($this->session->userdata('id_juego'));
		$permisos = $this->Usuario->get_permisos();
		$data = $this->Usuario->get_rol($id);
		$datos = $this->Usuario->get_permisos_by_rol($id);

		?><div class="form-row">
			<div class="form-group form-control-sm col-md-6">
				<label for="nombre_rol">Nombre del Rol</label>
				<input type="text" class="form-control form-control-sm" id="nombre_rol" name="nombre_rol" placeholder="Nombre del Rol" autocomplete="off" required value="<?= $data-> nombre_rol  ?>">
			</div>
			<div class="form-group  col-md-6">
				<label for="id_usuario">Usuario</label> <br>
						<select id="id_usuario" name="id_usuario" type="text" class="form-control form-control-sm "  >
							<option value="0" selected >Seleccione  Usuario</option>
							<?php
							foreach($usuarios as $fila)
							{
							?>
									<option value="<?= $fila -> id_usuario ?>" <?php if ($fila->id_usuario == $data->id_usuario) {echo "selected";} ?>  ><?= $fila -> nombre_apellido ?></option>
							<?php
							}
							?>
						</select>
			 </div>
		</div>
		<div class="form-row">
			<div class="form-check form-check-inline">
				<input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="t" name="director" <?php if ($data->director == 't') {echo "checked"; }?>  >
				<label class="form-check-label" for="inlineCheckbox1">Director</label>
			</div>
		</div>

			<h3 class="text-center">Permisos</h3>
		<div class="form-row">
				<div class="text-center">

						<?php
						foreach($permisos as $fila)
						{
						?>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="<?= $fila -> id_permiso ?>" name="permisos[]" <?php if (in_array($fila->id_permiso,$datos)){ echo "checked";} ?>>
							<label class="form-check-label" for="inlineCheckbox1"><?= $fila -> descripcion ?></label>
						</div>
						<?php
						}
						?>

			</div>
		</div>




	<?php
	}

}
