<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Model {

    //
    function login() {
        //
        $correo = $this->input->post("correo");
        $password = $this->input->post("password");
        //
        $query = $this->db->query("select u.IdUsuario, u.Cedula, u.Rol, u.EstadoRecuperarContra, "
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
                    'estadoP' => $row->EstadoRecuperarContra,
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

    //
    function recuperarPass() {
        //
        $correo = $this->input->post("correo");
        $codigo = time();
        //
        $datos = array(
            'Contrasena' => hash('MD5', $codigo),
            'EstadoRecuperarContra' => 'Recuperando',
        );
        //
        $this->db->where('Correo', $correo);
        //
        if ($this->db->update('usuario', $datos)) {
            //
            $this->load->library('email');
            //
            $this->email->from('encuesta@admin', 'Admin');
            $this->email->to($correo);
            //
            $this->email->subject('Código de activación');
            $this->email->message($codigo);
            //
            if ($this->email->send()) {
                //
                return 'Enviado';
            } else {
                //
                return 'Error';
            }
        }
    }

    //
    function actualizarPass() {
        //
        $idUsu = $this->input->post("idUsu");
        $pass = $this->input->post("pass");
        //
        $datos = array(
            'Contrasena' => hash('MD5', $pass),
            'EstadoRecuperarContra' => 'Normal',
        );
        //
        $this->db->where('IdUsuario', $idUsu);
        //
        if ($this->db->update('usuario', $datos)) {
            //
            return 'Actualizada';
        } else {
            //
            return 'Error';
        }
    }

}
