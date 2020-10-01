<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends Base_Controller {

	public function __construct()
    {
        parent::__construct();
		$this->table = 'produk';
		$this->load->library('datatables');
    }

  	public function index()
 	{
		$data['view'] = 'produk/index';
		echo Modules::run('template', @$data);
  	}

  	function get_data()
  	{
		$this->datatables->select("id_produk, nama_produk, deskripsi, harga, gambar, status")
	   		->add_column('action', $this->button('$1'), 'id_produk') 
	   		->from($this->table.' a');

		echo $this->datatables->generate(); //generatie hasil dari database
  	}

   	function button($param)
   	{
		return parent::button($param);
   	}

  	function tambah()
  	{
			
		$data['view'] = $this->cname . '/add';

		echo Modules::run('template', $data);
		
  	}

  	function do_tambah()
  	{
		$data = @$this->input->post();

		if($data)
		{
			$this->form_validation->set_rules('nama_produk', 'Nama Produk', 'required');
			$this->form_validation->set_rules('deskripsi', ucwords(str_replace('_', ' ', 'desripsi')), 'trim|required');
			$this->form_validation->set_rules('harga', ucwords(str_replace('_', ' ', 'harga')), 'trim|required');
			
	  		if ($this->form_validation->run() == FALSE){   
	      		$this->session->set_flashdata('postdata', (object)$this->input->post());
	      		$this->session->set_flashdata('msg', warn_msg(validation_errors()));
	      		redirect($_SERVER['HTTP_REFERER']);
	  		}
	  		else{

				$this->db->where('nama_produk like "%'. $data['nama_produk']. '%"', null , false);
				
				$db_data =  $this->db->get('produk')->row();
				if (!empty($db_data)) {
					$this->session->set_flashdata('postdata', (object)$this->input->post());
					$this->session->set_flashdata('msg', warn_msg('Produk sudah terdaftar'));
					redirect($_SERVER['HTTP_REFERER']);
				}

				$this->db->trans_begin();
				  
				if($data['status'] == 'on'){
					$status = 'Y';
	  			}else{
					$status = 'N';
				}
				$data['status'] = $status;

				

				@$file_name = $_FILES['gambar']['name'];
					if($file_name !='') {
						$config['upload_path'] = 'assets/upload/produk/';
						$config['allowed_types'] = 'jpg|png|bmp|webm';
						
						$new_name = $file_name;
						$config['file_name'] = $new_name;
						
						$this->load->library('upload', $config);
						$this->upload->initialize($config);

						if (!$this->upload->do_upload('gambar')){
							$this->session->set_flashdata('postdata', (object)$this->input->post());
							$this->session->set_flashdata('msg', warn_msg($this->upload->display_errors()));
							redirect($_SERVER['HTTP_REFERER']);
						}else{
							$dataFile  = $this->upload->data();
							$file_name = $dataFile['file_name'];


							$data['gambar'] = $file_name;
						}
					}

				$proses = $this->db->insert($this->table,@$data);
				  

				if($proses){
					$this->db->trans_commit();
		  			$this->session->set_flashdata('msg', succ_msg('Data Berhasil ditambahkan.'));
				}
				else{
					$this->db->trans_rollback();
		  			$this->session->set_flashdata('msg', err_msg('Gagal menambahkan data.'));
				}

				redirect($this->cname);
	  		}
		}
		else{
	  		show_404();
		}
  	}

  	function edit($id=NULL)
  	{
    	if(!$id) show_404();

		$data['item'] = @$this->session->flashdata('postdata') ? @$this->session->flashdata('postdata') : $this->db->get($this->table,array('id_produk' => decode($id)))->row();
		

    	$data['view'] = $this->cname . '/edit';

		echo Modules::run('template', $data);
  	}

  	function do_ubah(){
		$data = @$this->input->post();
		
    	if($data){ 
			$this->form_validation->set_rules('nama_produk', 'Nama Produk', 'required');
			$this->form_validation->set_rules('deskripsi', ucwords(str_replace('_', ' ', 'desripsi')), 'trim|required');
			$this->form_validation->set_rules('harga', ucwords(str_replace('_', ' ', 'harga')), 'trim|required');

			if ($this->form_validation->run() == FALSE){
				
				$data['gambar'] = $data['old_gambar'];
				$this->session->set_flashdata('postdata', (object)$this->input->post());
				$this->session->set_flashdata('msg', warn_msg(validation_errors()));
				redirect($_SERVER['HTTP_REFERER']);
			}else{
				$this->db->where('nama_produk like "%'. $data['nama_produk']. '%"', null , false);
				if(!empty($data['id_produk'])){
					$this->db->where('id_produk !='. $data['id_produk'],  null, false);
				}
				$db_data =  $this->db->get('produk')->row();
				
				if (!empty($db_data)) {
					$this->session->set_flashdata('postdata', (object)$this->input->post());
					$this->session->set_flashdata('msg', warn_msg('Produk sudah terdaftar'));
					redirect($_SERVER['HTTP_REFERER']);
				}

				$this->db->trans_begin();

				if($data['status'] == 'on'){
					$status = 'Y';
				}else{
				$status = 'N';
				}
				$data['status'] = $status;

				@$file_name = $_FILES['gambar']['name'];
				if($file_name !='') {
					$config['upload_path'] = 'assets/upload/produk/';
					$config['allowed_types'] = 'jpg|png|bmp|webm';
					
					$new_name = $file_name;
					$config['file_name'] = $new_name;
					
					$this->load->library('upload', $config);
					$this->upload->initialize($config);

					if (!$this->upload->do_upload('gambar')){
						
						$data['gambar'] = $data['old_gambar'];
						$this->session->set_flashdata('postdata', (object)$data);
						$this->session->set_flashdata('msg', warn_msg($this->upload->display_errors()));
						redirect($_SERVER['HTTP_REFERER']);
					}else{
						$dataFile  = $this->upload->data();
						$file_name = $dataFile['file_name'];


						$data['gambar'] = $file_name;

						
						if(!empty($data['old_gambar'])){
							@unlink(str_replace('\\', '/', FCPATH . str_replace('./', '', './assets/upload/produk/')). $data['old_gambar']);
						}
					}

				}else{
					if(!empty($data['old_gambar'])){
						$data['gambar'] = $data['old_gambar'];
					}
				}
				unset($data['old_gambar']);
				

				$proses = $this->db->update($this->table,$data,array('id_produk' => $data['id_produk']));
				  
				$id_produk = $data['id_produk'];
  
				if($proses){

					$this->db->trans_commit();
		  			$this->session->set_flashdata('msg', succ_msg('Data berhasil diubah .'));
				}
				else{
					$this->db->trans_rollback();
		  			$this->session->set_flashdata('msg', err_msg('Gagal merubah data.'));
				}
				redirect($this->cname);
      		}
    	}
    	else{
      		show_404();
    	}
  	}

  	function hapus($id=NULL)
  	{
    	if(!$id) show_404();
    	$data = $this->db->get($this->table,array('id_produk' => decode($id)))->row();
    	if (empty($data)) {
    		show_404();
		}
			

		$this->db->trans_begin();

		$this->db->where('id_produk' ,decode($id));
		$result = $this->db->delete($this->table,array('id_produk' => decode($id)));
	
		
    	
    	if($result){
			
		@unlink(str_replace('\\', '/', FCPATH . str_replace('./', '', './assets/upload/produk/')). $data->gambar);

			$this->db->trans_commit();
        	$this->session->set_flashdata('msg', succ_msg('Data Berhasil dihapus.'));
    	}else{
			$this->db->trans_rollback();

			$this->session->set_flashdata('msg', err_msg('Gagal menghapus.'));
				
    	}

    	redirect($this->cname);
		}

	function ubah_status(){
		$id_produk = $this->input->post('id_produk');

		$data = $this->db->get($this->table,array('id_produk' => $id_produk))->row();

		if($data->status == 'Y'){
			$ganti = array('status' => 'N');
			$status = 'Tidak Aktif';
			$data->status = 'N';
		}
		else{
			$ganti = array('status' => 'Y');
			$status = 'Aktif';
			$data->status = 'Y';
		}

		$this->db->where('id_produk', $id_produk);
		$this->db->update('produk', $ganti);

		echo json_encode(array('notif' => 'sukses'));
	}


}
