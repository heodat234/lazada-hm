<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Donhang_model extends CI_Model{
	
	/* Gán tên bảng cần xử lý*/
	private $_master = 'master';
    private $_detail = 'detail';
	
	function __construct(){
        parent::__construct();
        $this->load->database();
    } 

    function checkDonhang( $id_dh ){
        $dh =   $this->db->select()
                            ->where('id_bill', $id_dh)
                            ->get($this->_master)
                            ->row_array();
        if(count($dh) >0){
            return true;
        } else {
            return false;
        }
    }
    function list_donhang(){
    	$donhang = $this->db->select()
				        ->get($this->_master)
				        ->result_array();
    	return $donhang;
    }

    function insert_master($data){
        $donhang = $this->db->insert($this->_master,$data);
    }
    function insert_detail($data){
        $donhang = $this->db->insert($this->_detail,$data);
    }
    // function thongke_donhang($match)
    // {
    //     if ($match == null) {
    //         $dh =   $this->db->select('count(*) as qty' )
    //                 ->select_sum('id_bill','doanhthu')
    //                 ->select_sum('sales_return','chiphi')
    //                 ->get($this->_master)
    //                 ->result_array();
    //                 return $dh;
    //     }else{
    //         $dh =   $this->db->select('count(*) as qty' )
    //                 ->select_sum('sales_deliver','doanhthu')
    //                 ->select_sum('sales_return','chiphi')
    //                 ->where($match)
    //                 ->get($this->_master)
    //                 ->result_array();
    //                 return $dh;
    //     }
        
    // }
    function loc_donhang($match)
    {   
        $dh =   $this->db->select()
                    ->where($match)
                    ->get($this->_master)
                    ->result_array();
                    return $dh;
    }

    // function thongke_theothang()
    // {
    //     $sql = "Select Month(created_at) as 'thang', Sum(sales_deliver) as 'doanh thu', Sum(sales_return) as 'chi phi' From donhang Group by Month(created_at)";
    //     $query = $this->db->query($sql); 
    //     return $query->result_array();
    // }
}