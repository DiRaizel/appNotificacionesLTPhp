<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Familia extends CI_Model {

    //
    function guardarFamiliar() {
        //capturar Valores enviados por post
        $idUsu = $this->input->post("idUsu");
        $empresa = $this->input->post("empresa");
        $documento = $this->input->post("documento");
        $nombres = $this->input->post("nombres");
        $apellidos = $this->input->post("apellidos");
        //
        $query = $this->db->query("SELECT IdUsuario FROM usuario where Cedula "
                . "= '$documento'");
        //
        if (count($query->result()) > 0) {
            //
            return array('estado' => 'usuario');
        } else {
            //
            $datos = array(
                'fam_documento' => $documento,
                'fam_nombres' => $nombres,
                'fam_apellidos' => $apellidos,
                'usu_id' => $idUsu,
                'emp_id' => $empresa
            );
            //
            if ($this->db->insert('familia', $datos)) {
                //
                return array('estado' => 'guardado');
            } else {
                //
                return array('estado' => 'error');
            }
        }
    }

    //
    function cargarFamiliares() {
        //
        date_default_timezone_set('America/Bogota');
        //
        $idUsu = $this->input->post("idUsu");
        $fecha = date('Y-m-d');
        //
        $query = $this->db->query("SELECT fam_id, fam_documento, fam_nombres, "
                . "fam_apellidos FROM familia where usu_id = "
                . "$idUsu order by fam_nombres asc");
        //
        $datos = array();
        //
        if (count($query->result()) > 0) {
            //
            foreach ($query->result() as $row) {
                //
                $query2 = $this->db->query("SELECT encuesta_id FROM "
                        . "encuestacovidf where fam_id = $row->fam_id and "
                        . "encuesta_fecha = '$fecha'");
                //
                $encuesta = '';
                //
                if (count($query2->result()) > 0) {
                    //
                    $encuesta = 'Si';
                } else {
                    //
                    $encuesta = 'No';
                }
                //
                array_push($datos, array(
                    'idFam' => $row->fam_id,
                    'documento' => $row->fam_documento,
                    'nombres' => $row->fam_nombres,
                    'apellidos' => $row->fam_apellidos,
                    'encuesta' => $encuesta
                ));
            }
        }
        //
        return $datos;
    }

    //
    function cargarAlertas() {
        //
        date_default_timezone_set('America/Bogota');
        //
        $empresa = $this->input->post("empresa");
        $fecha = date('Y-m-d');
        //
        $query = $this->db->query("SELECT a.alert_descripcion, e.encuesta_nombres, "
                . "e.encuesta_apellidos, e.per_codigo FROM alertas a join "
                . "encuestacovid e on a.usu_id = e.usu_id where a.emp_id = "
                . "$empresa and a.alert_fecha = '$fecha' and e.encuesta_fecha ="
                . " '$fecha' order by e.encuesta_nombres asc");
        //
        $datos = array();
        //
        if (count($query->result()) > 0) {
            //
            foreach ($query->result() as $row) {
                //
                array_push($datos, array(
                    'documento' => $row->per_codigo,
                    'nombres' => $row->encuesta_nombres,
                    'apellidos' => $row->encuesta_apellidos,
                    'descripcion' => $row->alert_descripcion
                ));
            }
        }
        //
        return $datos;
    }

}
