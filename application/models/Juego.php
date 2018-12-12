<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Juego extends CI_Model {

    public function __construct() {
      $this->load->database();
    }

     function get_juegos() {
      $this->db->join('juego.estado', 'estado.id_estado = juego.id_estado','inner');
      $this->db->where('juego.id_estado != 5');
      $this->db->order_by('juego.id_juego','desc');
      $query = $this->db->get('juego.juego');
      if ($query->num_rows() > 0) {
          return $query->result();
      } else {
        return null;
      }
    }

    function guardar_juego($data) {
    $this->db->insert('juego.juego',$data);

   }


   public function get_users_game($id) {
     $this->db->order_by('usuario.id_usuario', 'asc');
     $this->db->where('usuarios_x_juego.id_juego',$id);
     $this->db->join('juego.usuarios_x_juego','usuarios_x_juego.id_usuario = usuario.id_usuario','inner');
     $users = $this->db->get('usuarios.usuario');
     if ($users->num_rows() > 0) {
         return $users->result();
     } else {
       return null;
     }
   }

   function guardar_usuario($data) {
   $this->db->insert('juego.usuarios_x_juego',$data);

  }

  function eliminar_usuario($data) {
  $this->db->where('usuarios_x_juego.id_juego',$data['id_juego']);
  $this->db->where('usuarios_x_juego.id_usuario',$data['id_usuario']);
  $this->db->delete('juego.usuarios_x_juego');

 }


   function actualizar_juego($data) {
   $this->db->where('juego.id_juego',$data['id_juego']);
   $this->db->update('juego.juego',$data);

  }


  function actualizar_situacion($data) {
  $this->db->where('id_situacion',$data['id_situacion']);
  $this->db->update('juego.situaciones',$data);

 }


 function get_roles_by_user($id){
   $this->db->where('roles_x_juego.id_usuario',$id);
   $this->db->where('juego.id_estado','2');
   $this->db->join('juego.juego','juego.id_juego = roles_x_juego.id_juego','inner');
   $roles = $this->db->get('juego.roles_x_juego');
   if ($roles->num_rows() > 0) {
       return $roles->result();
   } else {
     return null;
   }

 }

 function get_hora($id) {
  $this->db->where('id_juego',$id);
    $this->db->select('h_tactica');
  $query = $this->db->get('juego.juego');
      return $query->row();
 }

 function actualizar_hora($id,$data) {
  $this->db->where('id_juego',$id);
  $this->db->update('juego.juego',$data);

 }

 function get_situaciones($id){
    $this->db->where('situaciones.id_juego',$id);
    $this->db->where('situaciones.id_estado != 5');
    $this->db->join('juego.estado','situaciones.id_estado = estado.id_estado','left');
    $this->db->join('juego.tipo_situaciones','situaciones.id_tipo_situacion = tipo_situaciones.id_tipo_situacion','left');
    $situaciones = $this->db->get('juego.situaciones');
    if ($situaciones->num_rows() > 0) {
        return $situaciones->result();
    } else {
      return null;
    }
 }

 function get_t_situaciones(){
    $situaciones = $this->db->get('juego.tipo_situaciones');
    if ($situaciones->num_rows() > 0) {
        return $situaciones->result();
    } else {
      return null;
    }
 }

   function get_estados(){
      $situaciones = $this->db->get('juego.estado');
      if ($situaciones->num_rows() > 0) {
          return $situaciones->result();
      } else {
        return null;
      }
   }

   function guardar_archivo($data){
     $this->db->insert('juego.situaciones', $data);
     $id =  $this->db->insert_id();
     $query = "SELECT  st_setsrid(st_makepoint(".$data['lon'].",".$data['lat']. "), 3857) AS geom;";
    $geom = $this->db->query($query);
    $geom1 = $geom->row();
    $datos['geom'] = $geom1->geom;
    $this->db->where('id_situacion',$id);
    $this->db->update('juego.situaciones', $datos);


   }


   public function get_situacion($id) {
     $this->db->where('situaciones.id_situacion', $id);
     $situacion = $this->db->get('juego.situaciones');
     if($situacion->num_rows() > 0) {
       return $situacion->row();
     } else {
       return null;
     }
   }

   public function get_ids($id){
    $this->db->where('id_juego',$id);
    $query = $this->db->get('juego.juego');
    return $query->row();
     }


     public function get_nombre_rol($id){
      $this->db->where('id_rol',$id);
      $query = $this->db->get('juego.roles_x_juego');
      return $query->row();
       }

       public function get_nombre_juego($id){
        $this->db->where('id_juego',$id);
        $query = $this->db->get('juego.juego');
        return $query->row();
         }

     function get_iniciados(){
       $this->db->where('id_estado = 2');
        $this->db->select('count(*) as total ');
       $query = $this->db->get('juego.juego');
       return $query->row();
     }

}
