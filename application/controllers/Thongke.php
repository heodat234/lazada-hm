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
        $doanhthu   = array(null,null,null,null,null,null,null,null,null,null,null,null);
        $count      = array(null,null,null,null,null,null,null,null,null,null,null,null);
        $thongke = $this->Donhang_model->thongke_theothang();
        // echo "<pre>";
        // print_r($thongke);
        // echo "</pre>";
        for ($i=0; $i < count($thongke['doanhthu']) ; $i++) { 
            $doanhthu[$thongke['doanhthu'][$i]['thang']-1] = $thongke['doanhthu'][$i]['doanh thu'] - 0;
            // $loinhuan[$thongke[$i]['thang']-1] = $thongke[$i]['doanh thu'] - $thongke[$i]['chi phi'];
        }
        for ($i=0; $i < count($thongke['count']) ; $i++) { 
            $count[$thongke['count'][$i]['thang']-1] = $thongke['count'][$i]['qty'] - 0;
        }
        $data['doanhthu'] = json_encode($doanhthu);
        $data['count'] = json_encode($count);
        // var_dump($data['doanhthu']);
        $this->_data['html_body'] = $this->load->view('page/thongke',$data,true); 	        
		return $this->load->view('home/master', $this->_data);
	}

    
}
