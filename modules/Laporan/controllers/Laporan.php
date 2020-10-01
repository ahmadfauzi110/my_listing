<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends Base_Controller {

	public function __construct()
    {
		parent::__construct();
		$this->table = 'penjualan';
		$this->load->library('datatables');
    }

  	public function index()
 	{
 		$filter = $this->input->post();
        $this->session->set_userdata('filter', $filter);
		$data['filter'] = $this->session->userdata('filter');
		
		$data['view'] = 'laporan/index';

		echo Modules::run('template', $data);
  	}

  	function get_data()
  	{
  		$filter = $this->session->userdata('filter');

		$this->datatables->select("a.*, b.nama_produk");
		if(!empty($filter['tanggal_awal']) && !empty($filter['tanggal_akhir'])){
			$this->datatables->where('date(tanggal) >=', $filter['tanggal_awal'].' 00:00:00');
         	$this->datatables->where('date(tanggal) <=', $filter['tanggal_akhir'].' 23:59:59');
		}


		$this->datatables->join('produk b', 'a.id_produk = b.id_produk', 'left');
	   	$this->datatables->from($this->table.' a');

		echo $this->datatables->generate(); 
  	}


   	public function reset_filter()
	{
		$this->session->unset_userdata('filter');
		redirect($this->cname);
	}

}

