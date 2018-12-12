<?php
defined('BASEPATH') OR  exit('No direct script access allowed');

class Bibliotecas extends CI_Controller {


  public function __construct()
        {
                parent::__construct();
                $this->load->helper(array('form', 'url','file'));
                $this->load->model('Biblioteca');
                $this->load->model('Juego');
        }

  public function index()
      {
            if ($this->session->has_userdata('id_juego')) {
                    if ($this->session->has_userdata('error')) {


                      $data['error'] = $this->session->userdata('error');


                    } else {

                      $data['error'] = '';

                    }

                    $data['archivos'] = $this->Biblioteca->get_archivos($this->session->userdata('id_juego'));

                    $this->load->view('bibliotecas',$data);

            } else {

             redirect(base_url('/login/index/'));

           }
      }



      public function do_upload()
         {
                 $config['upload_path']          = './biblioteca/';
                 $config['allowed_types']        = '*';
                 $this->load->library('upload', $config);

                 if ( ! $this->upload->do_upload('userfile'))
                 {


                         $error = array('error' => $this->upload->display_errors());
                         $this->session->set_userdata('error', $error['error'] );
                         $this->session->set_userdata('ver',1);
                         redirect(base_url('/bibliotecas/index/'));

                 }
                 else
                 {

                         $data = array('upload_data' => $this->upload->data());

                         $datos['nombre'] = $this->input->post('nombre');

                         $datos['nombre_archivo'] = $data['upload_data']['file_name'];

                         $datos['peso'] = $data['upload_data']['file_size'];

                         $datos['ruta'] = $data['upload_data']['full_path'];

                         $datos['id_juego'] =$this->session->userdata('id_juego');

                         $this->Biblioteca->guardar_archivo($datos);

                         $this->session->set_userdata('error', 'Archivo Cargado con éxito');
                         $this->session->set_userdata('ver',1);
                         redirect(base_url('/bibliotecas/index/'));


                 }
         }



         function eliminar_archivo($id,$ruta){
           $archivo = "./biblioteca/".$ruta;
          unlink($archivo);
          $this->Biblioteca->eliminar($id);

         }
}
