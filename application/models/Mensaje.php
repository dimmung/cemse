<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mensaje extends CI_Model {

    public function __construct() {
      $this->load->database();
    }

     function get_recibidos($juego,$rol) {
       $this->db->select("situaciones.nombre,mensaje.id_mensaje as id_mensaje, roles_x_juego.nombre_rol as remitente, mensaje.fecha as fecha , mensaje.asunto as asunto, mensaje.id_estado as estado, mensaje.adjunto as rutas_ad, receptores.id_estado as visto");
      $this->db->join('mensajeria.receptores', 'receptores.id_mensaje = mensaje.id_mensaje');
      $this->db->join('juego.roles_x_juego', 'mensaje.remitente = roles_x_juego.id_rol');
       $this->db->join('juego.situaciones', 'mensaje.id_situacion = situaciones.id_situacion','left');
      $this->db->where('mensaje.id_juego', $juego);
      $this->db->where('receptores.id_rol', $rol);
      $this->db->order_by('fecha', 'desc');

      $this->db->group_by(array("mensaje.id_mensaje","roles_x_juego.nombre_rol", "mensaje.fecha", "asunto", "estado","situaciones.nombre","receptores.id_estado"));

      $query = $this->db->get('mensajeria.mensaje');
      if ($query->num_rows() > 0) {
          return $query->result();
      } else {
        return null;
      }
    }

    function get_enviados($juego,$rol) {
     $this->db->select("situaciones.nombre,mensaje.id_mensaje as id_mensaje, mensaje.fecha as fecha , mensaje.asunto as asunto, mensaje.id_estado as estado, mensaje.adjunto as rutas_ad, string_agg(DISTINCT roles_x_juego.nombre_rol, ' , ' ) AS receptores ");
     $this->db->join('mensajeria.receptores', 'receptores.id_mensaje = mensaje.id_mensaje');
     $this->db->join('juego.roles_x_juego', 'receptores.id_rol = roles_x_juego.id_rol');
     $this->db->join('juego.situaciones', 'mensaje.id_situacion = situaciones.id_situacion','left');
     $this->db->where('mensaje.id_juego', $juego);
     $this->db->where('mensaje.remitente', $rol);
     $this->db->order_by('fecha', 'desc');

     $this->db->group_by(array(  "mensaje.id_mensaje","mensaje.fecha", "asunto", "estado","situaciones.nombre"));

     $query = $this->db->get('mensajeria.mensaje');
     if ($query->num_rows() > 0) {
         return $query->result();
     } else {
       return null;
     }
   }

   function get_rol($id){
     $this->db->where('id_juego', $id);
     $query = $this->db->get('juego.roles_x_juego');
     if ($query->num_rows() > 0) {
         return $query->result();
     } else {
       return null;
     }
   }

   function enviar($data){
     $this->db->insert('mensajeria.mensaje', $data);
     return $this->db->insert_id();

   }

   function guardar_destinatarios($data){
     $this->db->insert('mensajeria.receptores', $data);
   }

   function guardar_ordenes($data){
     $this->db->insert('ordenes.compartidas', $data);
   }

   function get($id) {
     $this->db->select(" situaciones.nombre as situacion, mensaje.id_mensaje as id,  mensaje.remitente as id_remitente, mensaje.remitente as id_remitente, mensaje.id_situacion, roles.nombre_rol as remitente , mensaje.mensaje as contenido, mensaje.fecha as fecha , mensaje.asunto as asunto, mensaje.adjunto, string_agg(DISTINCT roles_x_juego.nombre_rol, ' , ' ) AS receptores, mensaje.remitente as remitente1");
     $this->db->join('mensajeria.receptores', 'receptores.id_mensaje = mensaje.id_mensaje');
     $this->db->join('juego.roles_x_juego', 'receptores.id_rol = roles_x_juego.id_rol');
      $this->db->join('juego.roles_x_juego as roles', 'mensaje.remitente = roles.id_rol');
     $this->db->join('mensajeria.adjuntos', 'mensaje.id_mensaje = adjuntos.id_mensaje','left');
     $this->db->join('juego.situaciones', 'mensaje.id_situacion = situaciones.id_situacion','left');
     $this->db->where('mensaje.id_mensaje', $id);

     $this->db->group_by(array( "situaciones.nombre", "mensaje.id_mensaje", "roles.nombre_rol","contenido","mensaje.id_mensaje","mensaje.fecha", "asunto"));

     $query = $this->db->get('mensajeria.mensaje');

     if ($query->num_rows() > 0) {
         return $query->row();
     } else {
       return null;
     }
  }

  function update($id,$rol,$data){
    $this->db->where('id_mensaje',$id);
    $this->db->where('id_rol',$rol);
    $this->db->update('mensajeria.receptores',$data);
  }

  function get_situaciones($id){
    $this->db->where('id_juego',$id);
    $query = $this->db->get('juego.situaciones');
    if ($query->num_rows() > 0) {
        return $query->result();
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

  function get_ordenes($id){
      $this->db->where('id_mensaje',$id);
      $this->db->select('b.id_orden, b.titulo');
      $this->db->join('ordenes.orden as b', 'b.id_orden = a.id_orden');
      $this->db->group_by('b.id_orden,b.titulo');
      $query = $this->db->get('ordenes.compartidas as a');
      if ($query->num_rows() > 0) {
          return $query->result();
      } else {
        return null;
      }
  }

  function get_mensajes($id){
    $this->db->where('receptores.id_rol', $id);
    $this->db->where('receptores.id_estado', 1);
    $this->db->join('mensajeria.receptores','receptores.id_mensaje = mensaje.id_mensaje');
    $this->db->select('count(*) as total');
    $query = $this->db->get('mensajeria.mensaje');
    if ($query->num_rows() > 0) {
        return $query->row();
    } else {
      return null;
    }
  }


    function get_receptores($id){
      $this->db->where('id_mensaje', $id);
      $query = $this->db->get('mensajeria.receptores');
      if ($query->num_rows() > 0) {
          return $query->result();
      } else {
        return null;
      }
    }
}
