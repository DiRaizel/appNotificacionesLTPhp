<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Read extends CI_Controller {

    public function __construct() {
        //
        parent::__construct();
        //
        $this->load->model('Usuario');
        $this->load->model('Encuesta');
    }

    //
    function login(){
        //
        $rsp = $this->Usuario->login();
        //
        echo json_encode($rsp);
    }

    //
    function cargarEncuestados(){
        //
        $rsp = $this->Encuesta->cargarEncuestados();
        //
        echo json_encode($rsp);
    }

    //
    function validarEncuesta(){
        //
        $rsp = $this->Encuesta->validarEncuesta();
        //
        echo json_encode($rsp);
    }

    //
    function cargarAlertas(){
        //
        $rsp = $this->Encuesta->cargarAlertas();
        //
        echo json_encode($rsp);
    }

}
