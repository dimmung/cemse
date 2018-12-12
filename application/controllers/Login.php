<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct() {
		parent::__construct();
    $this->load->model('Usuario');
		$this->load->model('Juego');
	}

	public function index($error = null) {
		if ($error) {
			$this->load->view('login');
		} else {
			$this->load->view('login');
		}
	}

	public function validar() {
		$data['usuario'] = $this->input->post('usuario');
		$data['password'] = hash("sha256",$this->input->post('clave'));

		$busqueda = $this->Usuario->login($data);

		if ($busqueda) {
			if ($busqueda->is_active == 't') {
				$datos['last_login']= 'now()';
				$this->Usuario->guardar_usuario($datos,$busqueda->user_id);
				// $permisos = $this->Usuario->get_permisos_by_rol(intval($busqueda->rol));
				// agregamos los datos en un arreglo
				$arraydata = array (
								 'id'  => $busqueda->user_id,
								 'usuario'=> $busqueda->usuario,
								 'nombre' => $busqueda->nombre_apellido,
								 'administrador'=> $busqueda->administrador

				);
				// creamos la sesión con la data buscada

				$this->session->set_userdata($arraydata);
				// redirigimos a la vista principal del sistema

				// if ($this->input->post('clave')== 'serviu123'){
				// 	redirect(base_url('/login/change'));
				// } else {
					redirect(base_url('/inicio/index'));
				// }

			} else {
				redirect(base_url('/login/index/1'));
			}
		} else {
			redirect(base_url('/login/index/0'));
		}
	}

	public function cerrar_sesion() {
		$this->session->sess_destroy();
		redirect(base_url('/login/index'));
	}

	public function change()
	{
		$this->load->view('change');
	}



}
