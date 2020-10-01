<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Base_Controller extends MX_Controller {

	public function __construct(){
    parent::__construct();
    $this->user    = $this->session->userdata('admin_login');
    
    if(empty($this->user)){
      redirect('login');
    }

    $this->menu = array(
      'dashboard' => array(
        'url'=> 'dashboard' , 
        'title'=> 'Dashboard' , 
        'icon'=> 'fa fa-home'),
      'produk' => array(
          'url'=> 'produk' , 
          'title'=> 'Produk' , 
          'icon'=> 'fa fa-list'),
      'laporan' => array(
          'url'=> 'laporan' , 
          'title'=> 'Laporan' , 
          'icon'=> 'icon-screen-desktop'),
    );

    $this->info = $this->menu[$this->uri->segment(1)];
    $this->cname = $this->info['url'];
    
    $this->button_tambah = $this->button_tambah();
    $this->button_simpan = $this->button_simpan();

  }

  public function button_tambah(){
    $html = '';

    $html .= '<a class="btn btn-info width-150 buttonAnimation" data-animation="pulse" href="'. site_url($this->info['url'].'/tambah') .'"><span class="fa fa-plus"> </span>&nbsp;&nbsp;Tambah</a>';
    

    return $html;
  }

  public function button($param){

    $html = "";

    $html .= "<a class='btn btn-cyan btn-sm tombolEdit' title='Edit' href='" . site_url($this->cname . '/edit/') . "' data-id='" . $param . "'><span class='icon-pencil'></span> Edit</a>&nbsp;";
        
    $html .= "<a class='btn btn-danger btn-sm tombolHapus' title='Hapus' href='#' data-id='" . $param . "' ><span class=' icon-trash'></span> Hapus</a>";
    
    return $html;
  }

  public  function button_simpan(){
    $html = '';

    $html .= '<a href="'. site_url($this->cname).'" class="btn btn-warning buttonAnimation" data-animation="pulse"><i class="fa fa-reply"></i> Kembali</a>
    <button type="submit" class="btn btn-success buttonAnimation" data-animation="pulse"><i class="fa fa-check"></i> Simpan</button>';

    return $html;
  }

}