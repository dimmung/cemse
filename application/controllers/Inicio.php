<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Juego');
			$this->load->model('Inventario');
	}


	public function index()
	{
	 if ($this->session->has_userdata('id')) {
		if ($this->session->userdata('administrador') == 't') {
			$data['juegos'] = $this->Juego->get_juegos();
			$data['estados'] = $this->Juego->get_estados();
			$this->load->view('index',$data);
		} else {
		  $data['roles'] = $this->Juego->get_roles_by_user($this->session->userdata('id'));
			// var_dump($data);
			// die();
			$this->load->view('index_user',$data);
		}


	 } else {
	 	 redirect(base_url('/login/index/'));
	 }
	}

	public function inicio($datos,$rol = null,$director = null)
	{

		$this->session->set_userdata('id_juego', $datos);
		$this->session->set_userdata('id_rol', $rol);
		$this->session->set_userdata('director', $director);

		if ($rol) {
					$rol_juego =  $this->Juego->get_nombre_rol($this->session->userdata('id_rol'));
					$this->session->set_userdata('nombre_rol', $rol_juego->nombre_rol);
		}

		$juego =  $this->Juego->get_nombre_juego($this->session->userdata('id_juego'));
		$this->session->set_userdata('nombre_juego', $juego->descripcion);
		$data['hora'] =  $this->Inventario->get_hora($this->session->userdata('id_juego'));
		$this->session->set_userdata('hora', $data['hora']-> h_tactica );
		 $this->load->view('inicio');
	}



}
