<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sanpham extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->helper(array('url','my_helper'));
        $this->load->library(array('session','excel'));
        $this->load->model(array('Donhang_model','Sanpham_model'));
        $this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
        $this->_data['html_header']   = $this->load->view('home/header', NULL, TRUE);
        $mdata['page'] = 'sanpham';
        $this->_data['html_menu']     = $this->load->view('home/menu', $mdata, TRUE);
        
    }
	public function index()
	{	
        if ( ! $data['sanpham'] = $this->cache->get('sanpham') )
         {
            $data['sanpham'] = $this->Sanpham_model->list_sanpham();
            $this->cache->save('sanpham', $data['sanpham'], 600);
         }
        $this->_data['html_body'] = $this->load->view('page/listSanpham',$data,true); 	        
		return $this->load->view('home/master', $this->_data);
	}

    public function insertSanpham()
    {   
        $post = $this->input->post();
        $data['id_sanpham']     = $post['id_sanpham'];
        $data['ten_sanpham']    = $post['ten_sanpham'];
        $data['gia_nhap']       = unNumber_Format($post['gia_nhap']);
        $data['so_luong']       = unNumber_Format($post['so_luong']);
        if ($this->Sanpham_model->checkSanpham($post['id_sanpham']) == false) {
            $this->Sanpham_model->insert_sanpham($data);
            $sp = $this->Sanpham_model->checkSanpham($post['id_sanpham']);
            $_data['mess'] = 'success';
            $_data['ngay_tao'] = $sp['created_at'];
            // var_dump($sp);
        }else{
            $_data['mess'] = 'error';
        }
        echo json_encode($_data);
    }

    public function editSanpham()
    {   
        $post = $this->input->post();
    
        $data['ten_sanpham']    = $post['ten_sanpham'];
        $data['gia_nhap']       = unNumber_Format($post['gia_nhap']);
        $data['so_luong']       = unNumber_Format($post['so_luong']);
        $this->Sanpham_model->edit_sanpham( $post['id_sanpham'], $data);
        
    }
    public function locSanpham()
    {
        $post   = $this->input->post();
        $match = array(
            'created_at >='=>$post['from'],
            'created_at <='=>$post['to']
        );
        $data['sanpham'] = $this->Sanpham_model->loc_donhang($match);
        $data['start']      = $post['from'];
        $data['end']        = $post['to'];
        $this->_data['html_body'] = $this->load->view('page/listSanpham',$data,true);           
        return $this->load->view('home/master', $this->_data);
    }
}
