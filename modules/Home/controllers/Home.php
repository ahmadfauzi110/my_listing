<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MX_Controller {

	public function __construct()
    {
        parent::__construct();
		$this->table = 'home';
		$this->cname = 'home';
    }

  	public function index()
 	{
		$this->db->where('status', 'Y');
		$data['produk'] = $this->db->get('produk')->result();

		$this->load->view('home/index', $data);
	}
	  
	public function do_beli(){
		$data = $this->input->post();

		$data['tanggal'] = date('Y-m-d');
		if($this->db->insert('penjualan', $data)){
			echo json_encode(array('status' => 'sukses'));
		}else{
			echo json_encode(array('status' => 'gagal', 'msg' => 'Proses Pembelian Gagal'));
		}
	}

 
	

}
