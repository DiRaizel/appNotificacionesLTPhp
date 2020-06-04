<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Morbilidad extends CI_Model {

    //
    function guardarMorbilidad() {
        //capturar Valores enviados por post
        $empresa = $this->input->post("empresa");
        $idUsu = $this->input->post("idUsu");
        //
        $diabetes = $this->input->post("diabetes");
        $hipertencion = $this->input->post("hipertencion");
        $enfermedadesCorazon = $this->input->post("enfermedadesCorazon");
        $fallaRenal = $this->input->post("fallaRenal");
        $enfermedadPulmonar = $this->input->post("enfermedadPulmonar");
        $hipotiroidismo = $this->input->post("hipotiroidismo");
        $otroProblemasPulmonares = $this->input->post("otroProblemasPulmonares");
        $enfermedadesAutoinmunes = $this->input->post("enfermedadesAutoinmunes");
        $corticoides = $this->input->post("corticoides");
        $inmunodeficiencia = $this->input->post("inmunodeficiencia");
        $cancer = $this->input->post("cancer");
        $sobrepeso = $this->input->post("sobrepeso");
        $desnutricion = $this->input->post("desnutricion");
        $fumador = $this->input->post("fumador");
        $ningunoA = $this->input->post("ningunoA");
        //
        date_default_timezone_set('America/Bogota');
        //
        $datos = array(
            'emp_id' => $empresa,
            'usu_id' => $idUsu,
            'encuesta_fecha' => date('Y-m-d'),
            'enc_diabetes' => $diabetes,
            'enc_hipertencion' => $hipertencion,
            'enc_enfermedades_corazon' => $enfermedadesCorazon,
            'enc_falla_renal' => $fallaRenal,
            'enc_enfermedad_pulmonar' => $enfermedadPulmonar,
            'enc_hipotiroidismo' => $hipotiroidismo,
            'enc_problemas_pulmonares' => $otroProblemasPulmonares,
            'enc_enfermedades_autoinmunes' => $enfermedadesAutoinmunes,
            'enc_corticoides' => $corticoides,
            'enc_inmunodeficiencia' => $inmunodeficiencia,
            'enc_cancer' => $cancer,
            'enc_sobrepeso' => $sobrepeso,
            'enc_desnutricion' => $desnutricion,
            'enc_fumador' => $fumador,
            'enc_ninguno_antecedentes' => $ningunoA
        );
        //
        if ($this->db->insert('morbilidad', $datos)) {
            //
            return array('estado' => 'guardada');
        } else {
            //
            return array('estado' => 'error');
        }
    }

    //
    function validarMorbilidad() {
        //
        date_default_timezone_set('America/Bogota');
        //
        $idUsu = $this->input->post("idUsu");
        //
        $query = $this->db->query("SELECT mor_id FROM morbilidad where "
                . "usu_id = $idUsu");
        //
        $datos = array();
        //
        if (count($query->result()) > 0) {
            //
            return array('estado' => 'guardada');
        } else {
            //
            return array('estado' => 'no guardada');
        }
        //
        return $datos;
    }

    //
    function validarMorbilidadF() {
        //
        date_default_timezone_set('America/Bogota');
        //
        $idFam = $this->input->post("idFam");
        //
        $query = $this->db->query("SELECT mor_id FROM morbilidadf where "
                . "fam_id = $idFam");
        //
        $datos = array();
        //
        if (count($query->result()) > 0) {
            //
            return array('estado' => 'guardada');
        } else {
            //
            return array('estado' => 'no guardada');
        }
        //
        return $datos;
    }

    //
    function guardarMorbilidadF() {
        //capturar Valores enviados por post
        $empresa = $this->input->post("empresa");
        $idUsu = $this->input->post("idUsu");
        //
        $diabetes = $this->input->post("diabetes");
        $hipertencion = $this->input->post("hipertencion");
        $enfermedadesCorazon = $this->input->post("enfermedadesCorazon");
        $fallaRenal = $this->input->post("fallaRenal");
        $enfermedadPulmonar = $this->input->post("enfermedadPulmonar");
        $hipotiroidismo = $this->input->post("hipotiroidismo");
        $otroProblemasPulmonares = $this->input->post("otroProblemasPulmonares");
        $enfermedadesAutoinmunes = $this->input->post("enfermedadesAutoinmunes");
        $corticoides = $this->input->post("corticoides");
        $inmunodeficiencia = $this->input->post("inmunodeficiencia");
        $cancer = $this->input->post("cancer");
        $sobrepeso = $this->input->post("sobrepeso");
        $desnutricion = $this->input->post("desnutricion");
        $fumador = $this->input->post("fumador");
        $ningunoA = $this->input->post("ningunoA");
        //
        $idFam = $this->input->post("idFam");
        //
        date_default_timezone_set('America/Bogota');
        //
        $datos = array(
            'emp_id' => $empresa,
            'usu_id' => $idUsu,
            'encuesta_fecha' => date('Y-m-d'),
            'enc_diabetes' => $diabetes,
            'enc_hipertencion' => $hipertencion,
            'enc_enfermedades_corazon' => $enfermedadesCorazon,
            'enc_falla_renal' => $fallaRenal,
            'enc_enfermedad_pulmonar' => $enfermedadPulmonar,
            'enc_hipotiroidismo' => $hipotiroidismo,
            'enc_problemas_pulmonares' => $otroProblemasPulmonares,
            'enc_enfermedades_autoinmunes' => $enfermedadesAutoinmunes,
            'enc_corticoides' => $corticoides,
            'enc_inmunodeficiencia' => $inmunodeficiencia,
            'enc_cancer' => $cancer,
            'enc_sobrepeso' => $sobrepeso,
            'enc_desnutricion' => $desnutricion,
            'enc_fumador' => $fumador,
            'enc_ninguno_antecedentes' => $ningunoA,
            'fam_id' => $idFam
        );
        //
        if ($this->db->insert('morbilidadf', $datos)) {
            //
            return array('estado' => 'guardada');
        } else {
            //
            return array('estado' => 'error');
        }
    }

}
