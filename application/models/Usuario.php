<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Model {

    public function __construct() {
      $this->load->database();
    }

    public function login($data) {
      $this->db->select('*,usuario.id_usuario AS user_id');
      $this->db->where('usuario.usuario',$data['usuario'])
                ->where('usuario.password',$data['password']);
      $user = $this->db->get('usuarios.usuario');
      if ($user->num_rows() > 0) {
          return $user->row();
      } else {
        return null;
      }
    }


    public function get_users() {
      $this->db->order_by('id_usuario', 'asc');
      $users = $this->db->get('usuarios.usuario');
      return $users->result();
    }

    public function get_user($id) {
      $this->db->select('*,usuario.nombre_apellido AS nombre_u,usuario.id_usuario AS id_u');
      $this->db->join('usuarios.rol','rol.id = usuario.rol');
      $this->db->where('usuario.id_usuario',$id);
      $user = $this->db->get('usuarios.usuario');
      return $user->row();
    }




    public function get_roles($id) {
      $this->db->where('roles_x_juego.id_juego', $id);
      $this->db->order_by('roles_x_juego.nombre_rol', 'asc');
      $this->db->join('usuarios.usuario','roles_x_juego.id_usuario = usuario.id_usuario');
      $roles = $this->db->get('juego.roles_x_juego');
      if($roles->num_rows() > 0) {
        return $roles->result();
      }
    }



   function guardar_usuario($data,$id = null) {
     if($id) {
       $this->db->where('id_usuario', $id);
       $this->db->update('usuarios.usuario', $data);
        } else {
          $this->db->insert('usuarios.usuario', $data);
        }

   }


   function guardar_rol($data) {
          $this->db->insert('juego.roles_x_juego', $data);
          return $this->db->insert_id();
        }



   function bloquear($data,$id) {
     $this->db->where('id_usuario', $id);
     $this->db->update('usuarios.usuario', $data);
   }

   function desbloquear($data,$id) {
     $this->db->where('id_usuario', $id);
     $this->db->update('usuarios.usuario', $data);
   }

   function reset_pass($data,$id) {
     $this->db->where('id_usuario', $id);
     $this->db->update('usuarios.usuario', $data);
   }

   function get_permisos() {
     $this->db->order_by('permisos.id_permiso','ASC');
     $permisos = $this->db->get('juego.permisos');
     if($permisos->num_rows() > 0) {
       return $permisos->result();
     }
   }

   function get_permisos_rol() {
     $permisos = $this->db->get('usuarios.permisos_rol');
     if($permisos->num_rows() > 0) {
       return $permisos->result();
     }
   }

   function get_permisos_by_rol($id_rol) {
     $this->db->select('id_permiso')
              ->where('id_rol',$id_rol);
     $permisos = $this->db->get('juego.permisos_x_rol');
     $perm = $permisos->result();
     $array_permisos = [];
     foreach ($perm as $p) {
       array_push($array_permisos,$p->id_permiso);
     }
     return $array_permisos;
   }

   function eliminar_permisos($id) {
     $this->db->delete('juego.permisos_x_rol', ['id_rol' => $id]);
   }

   function eliminar_rol($id) {
     $this->db->delete('juego.roles_x_juego', ['id_rol' => $id]);
   }

   function guardar_permisos($id,$permisos) {
     if($permisos) {
       $data['id_rol'] = $id;
       foreach ($permisos as $per => $key) {
         $data['id_permiso'] = $key;
         $this->db->insert('juego.permisos_x_rol', $data);
       }
     }
   }


   public function get_rol($id) {
     $this->db->where('roles_x_juego.id_rol', $id);
     $roles = $this->db->get('juego.roles_x_juego');
     if($roles->num_rows() > 0) {
       return $roles->row();
     }
   }
}
