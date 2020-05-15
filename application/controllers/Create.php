<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Create extends CI_Controller {

    public function __construct() {
        //
        parent::__construct();
        //
        $this->load->model('Encuesta');
    }

    //
    function guardarEncuesta(){
        //
        $rsp = $this->Encuesta->guardarEncuesta();
        //
        echo json_encode($rsp);
    }

}
