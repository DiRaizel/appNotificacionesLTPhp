<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Model {

    //
    function login() {
        //
        $correo = $this->input->post("correo");
        $password = $this->input->post("password");
        //
        $query = $this->db->query("select u.IdUsuario, u.Cedula, u.Rol, "
                . "u.emp_id, u.Nombres, u.Apellidos, e.emp_nombre from usuario"
                . " u join empresa e on u.emp_id = e.emp_id where u.Correo = "
                . "'$correo' and u.Contrasena ='" . hash('MD5', $password) . "'");
        //
        $datos = array();
        //
        if (count($query->result()) > 0) {
            //
            foreach ($query->result() as $row) {
                //
                $datos = array(
                    'estado' => 'Entra',
                    'idUsu' => $row->IdUsuario,
                    'cedula' => $row->Cedula,
                    'nombres' => $row->Nombres,
                    'apellidos' => $row->Apellidos,
                    'rol' => $row->Rol,
                    'idEmp' => $row->emp_id,
                    'empresa' => $row->emp_nombre
                );
            }
            //
            return $datos;
        } else {
            //
            return $datos['estado'] = 'Error';
        }
    }

}
