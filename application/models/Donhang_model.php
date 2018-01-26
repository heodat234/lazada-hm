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
                        ->where('hidden',0)
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
    //         $dh =   $this->db->select_sum('into_money','doanhthu')
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

    function thongke_theothang()
    {
        $sql = "Select Month(created_at) as 'thang', Sum(into_money) as 'doanh thu' From `detail`  Group by Month(created_at)";
        $query = $this->db->query($sql); 
        $adata['doanhthu'] = $query->result_array();

        $sql1 = "Select Month(created_at) as 'thang', Count(*) as 'qty' From `master`  Group by Month(created_at)";
        $query1 = $this->db->query($sql1); 
        $adata['count'] = $query1->result_array();
        return $adata;
    }

    function get_data($match, $from){
        $data = $this->db->select()
            ->where($match)
            ->get($from)
            ->result_array();
            return $data;
    }
}