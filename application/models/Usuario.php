<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Model {

    //
    function login() {
        //
        $correo = $this->input->post("correo");
        $password = $this->input->post("password");
        //
        $query = $this->db->query("select IdUsuario, Cedula, Rol, emp_id from "
                . "usuario where Correo = '$correo' and Contrasena ="
                . "'" . hash('MD5', $password) . "'");
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
                    'rol' => $row->Rol,
                    'empresa' => $row->emp_id
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
