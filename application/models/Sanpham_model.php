<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Sanpham_model extends CI_Model{
	
	/* Gán tên bảng cần xử lý*/
	private $_name = 'sanpham';
	
	function __construct(){
        parent::__construct();
        $this->load->database();
    } 
    function checkSanpham( $id_sp ){
        $sp =   $this->db->select()
                            ->where('id_sanpham', $id_sp)
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

    function insert_sanpham($data){
        $sanpham = $this->db->insert($this->_name,$data);
    }
    function edit_sanpham($id,$data){
        $sanpham = $this->db->where('id_sanpham',$id)->update($this->_name,$data); 
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