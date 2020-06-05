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

class Read extends CI_Controller {

    public function __construct() {
        //
        parent::__construct();
        //
        $this->load->model('Usuario');
        $this->load->model('Encuesta');
        $this->load->model('Familia');
        $this->load->model('Morbilidad');
    }

    //
    function login() {
        //
        $rsp = $this->Usuario->login();
        //
        echo json_encode($rsp);
    }

    //
    function cargarEncuestados() {
        //
        $rsp = $this->Encuesta->cargarEncuestados();
        //
        echo json_encode($rsp);
    }

    //
    function validarEncuesta() {
        //
        $rsp = $this->Encuesta->validarEncuesta();
        //
        echo json_encode($rsp);
    }

    //
    function cargarAlertas() {
        //
        $rsp = $this->Encuesta->cargarAlertas();
        //
        echo json_encode($rsp);
    }

    //
    function cargarFamiliares() {
        //
        $rsp = $this->Familia->cargarFamiliares();
        //
        echo json_encode($rsp);
    }

    //
    function validarSemaforo() {
        //
        $rsp = $this->Encuesta->validarSemaforo();
        //
        echo json_encode($rsp);
    }

    //
    function validarMorbilidad() {
        //
        $rsp = $this->Morbilidad->validarMorbilidad();
        //
        echo json_encode($rsp);
    }

    //
    function validarMorbilidadF() {
        //
        $rsp = $this->Morbilidad->validarMorbilidadF();
        //
        echo json_encode($rsp);
    }

}
