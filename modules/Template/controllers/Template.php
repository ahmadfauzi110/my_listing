<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Template extends Base_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index($data='')
    {
        


        $data['_header'] = $this->load->view('header', $data, true);
        $data['_footer'] = $this->load->view('footer', $data, true);
        $data['_view'] = $this->load->view($data['view'], $data, true);
        $data['_sidebar'] = $this->load->view('sidebar', $data, true);

        $this->load->view('template/index', $data);
    }

}
