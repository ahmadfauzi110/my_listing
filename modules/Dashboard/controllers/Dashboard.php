<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Base_Controller {

	public function __construct()
    {
        parent::__construct();
		$this->table = 'dashboard';
    }

  	public function index()
 	{
		$data['view'] = 'dashboard/index';
		echo Modules::run('template', @$data);
  	}

 
	public function get_statistik(){
		$this->db->select('count(*) as total_produk');
		$data['total_produk'] = $this->db->get('produk')->row()->total_produk;

		$this->db->select('count(*) as penjualan_hari_ini');
		$this->db->where('date(tanggal)', date('Y-m-d'));
		$data['penjualan_hari_ini'] = $this->db->get('penjualan')->row()->penjualan_hari_ini;

		$this->db->select('count(*) as total_penjulan');
		$data['total_penjualan'] = $this->db->get('penjualan')->row()->total_penjulan;

		echo json_encode(array('data' => $data));
	}


}
