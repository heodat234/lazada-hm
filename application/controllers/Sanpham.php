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
    public function lichSuNhapKho($slug)
    {   
        $data['sp'] = $this->Sanpham_model->selsectSPBySlug($slug);
        $data['import'] = $this->Sanpham_model->nhap_kho_id_product($data['sp']['id']);
        // var_dump($data['import']);
        $this->_data['html_body'] = $this->load->view('page/chitiet_sanpham',$data,true);           
        return $this->load->view('home/master', $this->_data);
    }
    public function insertSanpham()
    {   
        $post = $this->input->post();
        $data['id_product']     = $post['id_sanpham'];
        $data['name']           = $post['ten_sanpham'];
        $data['slug']           = create_slug($post['ten_sanpham']);
        // $adata['price']          = unNumber_Format($post['gia_nhap']);
        // $adata['qty']            = unNumber_Format($post['so_luong']);
        if ($this->Sanpham_model->checkSanpham($post['id_sanpham']) == false) {
            $this->Sanpham_model->insert_sanpham($data);
            $sp = $this->Sanpham_model->checkSanpham($post['id_sanpham']);
            $_data['mess'] = 'success';
            $_data['ngay_tao']  = $sp['created_at'];
            $_data['id']        = $sp['id'];
            // var_dump($sp);
        }else{
            $_data['mess'] = 'error';
        }
        echo json_encode($_data);
    }

    public function editSanpham()
    {   
        $post = $this->input->post();
    
        $data['name']       = $post['ten_sanpham'];
        $data['slug']           = create_slug($post['ten_sanpham']);
        // $data['price']      = unNumber_Format($post['gia_nhap']);
        // $data['qty']        = unNumber_Format($post['so_luong']);
        $this->Sanpham_model->edit_sanpham( $post['id_sanpham'], $data);
        
    }
    public function insertKho()
    {   
        $post = $this->input->post();
        $adata['id_product']     = $post['id_sanpham'];
        $adata['price']          = unNumber_Format($post['price']);
        $adata['qty']            = unNumber_Format($post['qty']);

        $this->Sanpham_model->insert_import_sanpham($adata);
        $sp = $this->Sanpham_model->selsectSPById($post['id_sanpham']);
        $_data['ngay_tao'] = $sp['created_at'];
            // var_dump($sp);
       
        echo json_encode($_data);
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
    public function locLichSuNhapId()
    {
        $post   = $this->input->post();
        $data['sp'] = $this->Sanpham_model->selsectSPById($post['id']);
        $match = array(
            'id_product'   =>$post['id'],
            'created_at >='=>$post['from'],
            'created_at <='=>$post['to']
        );
        $data['import'] = $this->Sanpham_model->loc_lichSuNhapKho($match);
        $data['start']      = $post['from'];
        $data['end']        = $post['to'];
        $this->_data['html_body'] = $this->load->view('page/chitiet_sanpham',$data,true);           
        return $this->load->view('home/master', $this->_data);
    }
}
