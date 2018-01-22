<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Thongke extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->helper(array('url','my_helper'));
        $this->load->library(array('session','excel'));
        $this->load->model(array('Donhang_model','Sanpham_model'));
        $this->_data['html_header']   = $this->load->view('home/header', NULL, TRUE);
        $mdata['page'] = 'thongke';
        $this->_data['html_menu']     = $this->load->view('home/menu', $mdata, TRUE);
        
    }
	public function index()
	{	
        $doanhthu = array(null,null,null,null,null,null,null,null,null,null,null,null);
        $loinhuan = array(null,null,null,null,null,null,null,null,null,null,null,null);
        $thongke = $this->Donhang_model->thongke_theothang();
        // print_r($thongke);
        for ($i=0; $i < count($thongke) ; $i++) { 
            $doanhthu[$thongke[$i]['thang']-1] = $thongke[$i]['doanh thu'] - 0;
            $loinhuan[$thongke[$i]['thang']-1] = $thongke[$i]['doanh thu'] - $thongke[$i]['chi phi'];
        }
        $data['doanhthu'] = json_encode($doanhthu);
        $data['loinhuan'] = json_encode($loinhuan);
        // var_dump($data['doanhthu']);
        $this->_data['html_body'] = $this->load->view('page/thongke',$data,true); 	        
		return $this->load->view('home/master', $this->_data);
	}

    
}
