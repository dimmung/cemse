<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mensajes extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->model('Mensaje');
			$this->load->model('Orden');
				$this->load->model('Juego');

	}


	public function recibidos()
	{
	 if ($this->session->has_userdata('id_juego')) {

		 $data['recibidos'] = $this->Mensaje->get_recibidos($this->session->userdata('id_juego'),$this->session->userdata('id_rol'));
     $this->load->view('mensajes/recibidos',$data);
	 } else {
	 	 redirect(base_url('/login/index/'));
	 }
	}

	public function enviados()
	{
	 if ($this->session->has_userdata('id_juego')) {

		 $data['enviados'] = $this->Mensaje->get_enviados($this->session->userdata('id_juego'),$this->session->userdata('id_rol'));
     $this->load->view('mensajes/enviados',$data);
	 } else {
	 	 redirect(base_url('/login/index/'));
	 }
	}

	public function nuevo(){
		if ($this->session->has_userdata('id_juego')) {
			$data['situaciones'] = $this->Mensaje-> get_situaciones($this->session->userdata('id_juego'));
			$data['destinatarios'] = $this->Mensaje->get_rol($this->session->userdata('id_juego'));
			$data['hora'] = $this->Mensaje->get_hora($this->session->userdata('id_juego'));
			$data['ordenes'] = $this->Orden->get_ordenes($this->session->userdata('id_rol'));
			if ($this->session->has_userdata('error')) {


				$data['error'] = $this->session->userdata('error');


			} else {

				$data['error'] = '';

			}

			$this->session->set_userdata('hora', $data['hora']-> h_tactica );
      $this->load->view('mensajes/nuevo',$data);
 	 } else {
 	 	 redirect(base_url('/login/index/'));
 	 }
	}


	public function responder($data){
		if ($this->session->has_userdata('id_juego')) {
			$data['situaciones'] = $this->Mensaje-> get_situaciones($this->session->userdata('id_juego'));
			$data['destinatarios'] = $this->Mensaje->get_rol($this->session->userdata('id_juego'));
			$data['hora'] = $this->Mensaje->get_hora($this->session->userdata('id_juego'));
			$data['ordenes'] = $this->Orden->get_ordenes($this->session->userdata('id_rol'));
			if ($this->session->has_userdata('error')) {


				$data['error'] = $this->session->userdata('error');


			} else {

				$data['error'] = '';

			}

			$this->session->set_userdata('hora', $data['hora']-> h_tactica );
      $this->load->view('mensajes/nuevo_resp',$data);
 	 } else {
 	 	 redirect(base_url('/login/index/'));
 	 }
	}


	public function reenviar($data){
		if ($this->session->has_userdata('id_juego')) {
			$data['situaciones'] = $this->Mensaje-> get_situaciones($this->session->userdata('id_juego'));
			$data['destinatarios'] = $this->Mensaje->get_rol($this->session->userdata('id_juego'));
			$data['hora'] = $this->Mensaje->get_hora($this->session->userdata('id_juego'));
			$data['ordenes'] = $this->Orden->get_ordenes($this->session->userdata('id_rol'));
			if ($this->session->has_userdata('error')) {


				$data['error'] = $this->session->userdata('error');


			} else {

				$data['error'] = '';

			}

			$this->session->set_userdata('hora', $data['hora']-> h_tactica );
			$this->load->view('mensajes/nuevo_reen',$data);
	 } else {
		 redirect(base_url('/login/index/'));
	 }
	}



	public function enviar()
		 {
			 if ($this->input->post('adjuntar')) {




										 $config['upload_path']          = './biblioteca/adjuntos';
										 $config['allowed_types']        = '*';
										 $this->load->library('upload', $config);

										 if ( ! $this->upload->do_upload('file'))
										 {


														 $error = array('error' => $this->upload->display_errors());
														 $this->session->set_userdata('error', $error['error'] );
														 $this->session->set_userdata('ver',1);
														 redirect(base_url('/mensajes/nuevo/'));

										 }
										 else
										 {

														 $data = array('upload_data' => $this->upload->data());

														 var_dump($data);
														 $datos['adjunto'] = $data['upload_data']['file_name'];

														 $datos['asunto'] = $this->input->post('asunto');

	 				 								 if ($this->input->post('mensaje')) {
	 				 										$datos['mensaje'] = $this->input->post('mensaje');
	 				 									}

	 				 								$datos['fecha'] = $this->input->post('date');

	 				 								$datos['id_estado'] = 1;

	 				 								$datos['id_juego'] =$this->session->userdata('id_juego');

	 				 								$datos['remitente'] =$this->session->userdata('id_rol');

	 				 								if ($this->input->post('id_situacion')) {
	 				 									$datos['id_situacion'] = $this->input->post('id_situacion');
	 				 								}
	 				 								$id = $this->Mensaje->enviar($datos);

	 				 								$destinatarios = $this->input->post('destinatarios');
	 				 								$ordenes = $this->input->post('ordenes');
	 				 								foreach ($destinatarios as $fila) {
	 				 									$data_d['id_mensaje'] = $id;
	 				 									$data_d['id_rol'] = $fila;
	 				 									$this->Mensaje->guardar_destinatarios($data_d);
	 				 								}

	 				 								foreach ($ordenes as $orden) {
	 				 									foreach ($destinatarios as $fila) {
	 				 										$data_o['id_rol'] = $fila;
	 				 										$data_o['id_orden'] =$orden;
	 				 										$data_o['id_mensaje'] =$id;
	 				 										$this->Mensaje->guardar_ordenes($data_o);

	 				 									}
	 				 								}
	 				 								 redirect(base_url('/mensajes/recibidos/'));
									 }

							 } else {

								 $datos['asunto'] = $this->input->post('asunto');

								 if ($this->input->post('mensaje')) {
										$datos['mensaje'] = $this->input->post('mensaje');
									}

								$datos['fecha'] = $this->input->post('date');

								$datos['id_estado'] = 1;

								$datos['id_juego'] =$this->session->userdata('id_juego');

								$datos['remitente'] =$this->session->userdata('id_rol');

								if ($this->input->post('id_situacion')) {
									$datos['id_situacion'] = $this->input->post('id_situacion');
								}
								$id = $this->Mensaje->enviar($datos);

								$destinatarios = $this->input->post('destinatarios');
								$ordenes = $this->input->post('ordenes');
								foreach ($destinatarios as $fila) {
									$data_d['id_mensaje'] = $id;
									$data_d['id_rol'] = $fila;
									$this->Mensaje->guardar_destinatarios($data_d);
								}

								foreach ($ordenes as $orden) {
									foreach ($destinatarios as $fila) {
										$data_o['id_rol'] = $fila;
										$data_o['id_orden'] =$orden;
										$data_o['id_mensaje'] =$id;
										$this->Mensaje->guardar_ordenes($data_o);

									}
								}
								 redirect(base_url('/mensajes/recibidos/'));


							 }



		 }

		 public function ver($id){
			 $i = 0;
			 $receptores = $this->Mensaje->get_receptores($id);
			 $data['datos'] = $this->Mensaje->get($id);
			 $data['ordenes'] = $this->Mensaje->get_ordenes($id);
			 if (!$receptores) {
						 if ($this->session->userdata('id_rol') == $data['datos']->remitente1)  {
						 		$this->load->view('mensajes/ver',$data);
						 } else {
							 redirect(base_url('/mensajes/recibidos/'));
						 }
				} else {

							foreach ($receptores as $receptor) {
							 if ($receptor->id_rol == $this->session->userdata('id_rol') ) {
								 $i++;
							 }
							}

							if ($i!= 0 ) {
							 $this->load->view('mensajes/ver',$data);
						 } else {
							redirect(base_url('/mensajes/recibidos/'));
						 }

				}




		 }

		 public function update($id){
			 $data['id_estado'] = 2;

			 $this->Mensaje->update($id,$this->session->userdata('id_rol'),$data);
		 }

		 public function get_mensajes(){
			 $mensajes = $this->Mensaje->get_mensajes($this->session->userdata('id_rol'));
			 echo $mensajes->total;
		 }



		 public function procesar()
	 		 {
	 			 if ($this->input->post()) {
	 			 		if ($this->input->post('responder')) {
							$data['id_remitente'] = $this->input->post('id_remitente');
							$data['remitente'] = $this->input->post('remitente');
							$data['situacion'] = $this->input->post('situacion');
							$data['asunto'] = $this->input->post('asunto');
							$data['contenido'] = $this->input->post('contenido');
							$this->responder($data);
	 			 		}else{
							if ($this->input->post('reenviar')) {
								$data['id_remitente'] = $this->input->post('id_remitente');
								$data['remitente'] = $this->input->post('remitente');
								$data['situacion'] = $this->input->post('situacion');
								$data['asunto'] = $this->input->post('asunto');
								$data['contenido'] = $this->input->post('contenido');
								$this->reenviar($data);
							}
						}
	 			 };

	 		 }



}
