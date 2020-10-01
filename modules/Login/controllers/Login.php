<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->cname = 'login';
        $this->title = 'Login';

        $this->user    = $this->session->userdata('admin_login');
    
        if(!empty($this->user)){
            redirect('dashboard');
        }
    }

    public function index()
    {
        

        $this->load->view($this->cname.'/index');
    }

    public function do_login(){
        $data = $this->input->post();

        $this->db->where('username', $data['username']);
        $user = $this->db->get('user')->row();

        if(!empty($user)){
            if(md5($data['password']) == $user->password){
                $this->session->set_userdata('admin_login', $user);
                redirect('dashboard');
            }else{
                $this->session->set_flashdata('msg', 'Password Salah');
			    redirect('login');
            }
        }else{
            $this->session->set_flashdata('msg', 'Username tidak ditemukan');
			redirect('login');
        }

    }

    public function do_logout(){
        $this->session->unset_userdata('admin_login');
        redirect('login');
    }
}
