<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// Allow from any origin
if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');    // cache for 1 day
}
// Access-Control headers are received during OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
    exit(0);
}

class Create extends CI_Controller {

    public function __construct() {
        //
        parent::__construct();
        //
        $this->load->model('Encuesta');
        $this->load->model('Familia');
        $this->load->model('Morbilidad');
    }

//---------------------------------Encuesta-------------------------------------
//
    //
    function guardarEncuesta() {
        //
        $rsp = $this->Encuesta->guardarEncuesta();
        //
        echo json_encode($rsp);
    }

    //
    function guardarEncuestaF() {
        //
        $rsp = $this->Encuesta->guardarEncuestaF();
        //
        echo json_encode($rsp);
    }

//----------------------------------Familia-------------------------------------
//
    //
    function guardarFamiliar() {
        //
        $rsp = $this->Familia->guardarFamiliar();
        //
        echo json_encode($rsp);
    }

//---------------------------------Mobilidad------------------------------------
//
    //
    function guardarMorbilidad() {
        //
        $rsp = $this->Morbilidad->guardarMorbilidad();
        //
        echo json_encode($rsp);
    }
    
    //
    function guardarMorbilidadF() {
        //
        $rsp = $this->Morbilidad->guardarMorbilidadF();
        //
        echo json_encode($rsp);
    }

}
