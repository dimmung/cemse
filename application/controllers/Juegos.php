<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Juegos extends CI_Controller {

	public function __construct() {
		parent::__construct();
    $this->load->model('Juego');
	}


  public function crear() {
    $data['nombre'] = $this->input->post('nombre');
		$data['descripcion'] = $this->input->post('descripcion');
		$data['mapid'] = $this->input->post('mapid');
		$data['id_situaciones'] = $this->input->post('id_situaciones');
		$data['id_recorridos'] = $this->input->post('id_recorridos');
		$data['id_movimiento'] = $this->input->post('id_movimiento');
		$data['id_inventario'] = $this->input->post('id_inventario');
    $data['id_estado'] = 1;
    $data['created_at'] = 'now()';
    $this->Juego->guardar_juego($data);
  }

	public function agregar($id){
		$data['id_usuario'] = $id;
	  $data['id_juego'] = $this->session->userdata('id_juego');
		$this->Juego->guardar_usuario($data);
	}


	public function eliminar($id){
		$data['id_usuario'] = $id;
	  $data['id_juego'] = $this->session->userdata('id_juego');
		$this->Juego->eliminar_usuario($data);
	}

	public function eliminar_juego($id){
		$data['id_estado'] = 5;
		$data['id_juego'] = $id;
		$this->Juego->actualizar_juego($data);
	}
	public function rol(){
		$data['id_usuario'] = $id;
	  $data['id_juego'] = $this->session->userdata('id_juego');
		$this->Juego->eliminar_usuario($data);
	}

	public function hora(){
		if ($this->session->has_userdata('id_juego') && $this->session->has_userdata('id_rol') ) {
		 $data = $this->Juego->get_hora($this->session->userdata('id_juego'));
		 $this->session->set_userdata('hora', $data->h_tactica);
		 $this->load->view('hora');
	 } else {
		 redirect(base_url('/login/index/'));
	 }
}

	public function actualizar_hora(){
		$data['h_tactica'] = $this->input->post('h_tactica');
		$this->Juego->actualizar_hora( $this->session->userdata('id_juego'),$data);
		redirect(base_url('/juegos/hora/'));
	}

	public function mapa()
	{
	 if ($this->session->has_userdata('id')) {
			$this->load->view('map');
		}
	}

	public function actualizar_juego($estado,$id){
		if ($estado == 2) {
		  $juegos = $this->Juego->get_iniciados();
			if ($juegos->total == 0) {
				$datos['id_estado'] = $estado;
				$datos['id_juego'] = $id;
				$this->Juego->actualizar_juego($datos);
				echo '1';
			}

		} else {
			$datos['id_estado'] = $estado;
			$datos['id_juego'] = $id;
			$this->Juego->actualizar_juego($datos);
			echo '1';
		}
	}

}
