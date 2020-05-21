<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Encuesta extends CI_Model {

    //
    function guardarEncuesta() {
        //capturar Valores enviados por post
        $empresa = $this->input->post("empresa");
        $documento = $this->input->post("documento");
        $nombres = $this->input->post("nombres");
        $apellidos = $this->input->post("apellidos");
        $temperatura = (float) $this->input->post("temperatura");
        $fiebre = $this->input->post("fiebre");
        $tos = $this->input->post("tos");
        $cefalea = $this->input->post("cefalea");
        $dolorGarganta = $this->input->post("dolorGarganta");
        $malestarGeneral = $this->input->post("malestarGeneral");
        $dificultadRespiratoria = $this->input->post("dificultadRespiratoria");
        $adinamia = $this->input->post("adinamia");
        $secrecionesNasales = $this->input->post("secrecionesNasales");
        $diarrea = $this->input->post("diarrea");
        $ninguno = $this->input->post("ninguno");
        $pregunta1 = $this->input->post("pregunta1");
        $pregunta2 = $this->input->post("pregunta2");
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
            'per_codigo' => $documento,
            'encuesta_nombres' => $nombres,
            'encuesta_apellidos' => $apellidos,
            'encuesta_temperatura' => $temperatura,
            'encuesta_fiebre' => $fiebre,
            'encuesta_tos' => $tos,
            'encuesta_cefalea' => $cefalea,
            'encuesta_dolorgarganta' => $dolorGarganta,
            'encuesta_malestargeneral' => $malestarGeneral,
            'encuesta_dificultarespirar' => $dificultadRespiratoria,
            'encuesta_temperaturaencuesta_adinamia' => $adinamia,
            'encuesta_secrecionesnasales' => $secrecionesNasales,
            'encuesta_diarrea' => $diarrea,
            'encuesta_ninguna' => $ninguno,
            'encuesta_pregunta1' => $pregunta1,
            'encuesta_pregunta2' => $pregunta2,
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
        if ($this->db->insert('encuestacovid', $datos)) {
            //
            if ($temperatura > 37) {
                //
                $datos2 = array(
                    'emp_id' => $empresa,
                    'per_codigo' => $documento,
                    'alert_tipo' => 'Temperatura',
                    'alert_descripcion' => "Temperatura Alta: $temperatura" . "°",
                    'alert_fecha' => date('Y-m-d'),
                    'alert_hora' => date('H-i-s'),
                    'usu_id' => $idUsu
                );
                //
                if ($this->db->insert('alertas', $datos2)) {
                    //
                    return array('estado' => 'guardada');
                } else {
                    //
                    return array('estado' => 'error2');
                }
            } else {
                return array('estado' => 'guardada');
            }
        } else {
            //
            return array('estado' => 'error');
        }
    }

    //
    function cargarEncuestados() {
        //
        date_default_timezone_set('America/Bogota');
        //
        $empresa = $this->input->post("empresa");
        $fecha = date('Y-m-d');
        //
        $query = $this->db->query("SELECT per_codigo, encuesta_nombres, "
                . "encuesta_apellidos FROM encuestacovid where emp_id = "
                . "$empresa and encuesta_fecha = '$fecha' order by "
                . "encuesta_nombres asc");
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
                    'apellidos' => $row->encuesta_apellidos
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

    //
    function validarEncuesta() {
        //
        date_default_timezone_set('America/Bogota');
        //
        $idUsu = $this->input->post("idUsu");
        $empresa = $this->input->post("empresa");
        $fecha = date('Y-m-d');
        //
        $query = $this->db->query("SELECT encuesta_id FROM encuestacovid where "
                . "emp_id = $empresa and encuesta_fecha = '$fecha' and usu_id ="
                . "$idUsu ");
        //
        $datos = array();
        //
        if (count($query->result()) > 0) {
            //
            foreach ($query->result() as $row) {
                //
                array_push($datos, array(
                    'sql' => 'Si'
                ));
            }
        } else {
            //
            array_push($datos, array(
                'sql' => 'No'
            ));
        }
        //
        return $datos;
    }

}
