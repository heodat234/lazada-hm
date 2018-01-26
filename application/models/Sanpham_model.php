<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Sanpham_model extends CI_Model{
	
	/* Gán tên bảng cần xử lý*/
	private $_name = 'product';
    private $_import = 'import_product';
	
	function __construct(){
        parent::__construct();
        $this->load->database();
    } 
    function checkSanpham( $id_sp ){
        $sp =   $this->db->select()
                            ->where('id_product', $id_sp)
                            ->get($this->_name)
                            ->row_array();
        if(count($sp) >0){
            return $sp;
        } else {
            return false;
        }
    }
    function list_sanpham(){
    	$sanpham = $this->db->select()
				        ->get($this->_name)
				        ->result_array();
    	return $sanpham;
    }
    function nhap_kho_id_product($id_product){
        $im = $this->db->select()->where('id_product',$id_product)
                        ->get($this->_name)
                        ->result_array();
        return $im;
    }
    function insert_sanpham($data){
        $sanpham = $this->db->insert($this->_name,$data);
    }
    function insert_import_sanpham($data){
        $sanpham = $this->db->insert($this->_import,$data);
    }
    function edit_sanpham($id,$data){
        $sanpham = $this->db->where('id_product',$id)->update($this->_name,$data); 
    }
    function loc_donhang($match)
    {
        $dh =   $this->db->select()
                    ->where($match)
                    ->get($this->_name)
                    ->result_array();
        return $dh;
    }
}