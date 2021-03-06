<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Donhang_model extends CI_Model{
	
	/* Gán tên bảng cần xử lý*/
	private $_master    = 'master';
    private $_detail    = 'detail';
    private $_excel     = 'lazada';
	
	function __construct(){
        parent::__construct();
        $this->load->database();
    } 

    public function countDonHang($match)
    {
        $query=$this->db->where($match)->get($this->_master);
        return $query->num_rows(); 
    }
    public function countLazada()
    {
        $query=$this->db->where('checkLazada',0)->get($this->_excel);
        return $query->num_rows(); 
    }

    function checkDonhangLazada( $id_dh ){
        $dh =   $this->db->select()
                            ->where('id_bill', $id_dh)
                            ->get($this->_excel)
                            ->row_array();
        if(count($dh) >0){
            return $dh;
        } else {
            return false;
        }
    }
    function checkDonhang( $id_dh ){
        $dh =   $this->db->select()
                            ->where('id_bill', $id_dh)
                            ->get($this->_master)
                            ->row_array();
        if(count($dh) >0){
            return $dh;
        } else {
            return false;
        }
    }
    public function listDonhang()
    {
       $donhang = $this->db->select()
                    ->where('hidden',0)
                    ->get($this->_master)
                    ->result_array();
        return $donhang;
    }

    function insert_master($data){
        $donhang = $this->db->insert($this->_master,$data);
    }
    
    function insert_lazada($data){
        $donhang = $this->db->insert($this->_excel,$data);
    }
    function update_lazada($id,$data='')
    {
         $this->db->where('id_bill',$id)
            ->update($this->_excel,$data);
    }
    function delete_lazada()
    {
        $this->db->where('checkLazada',0)->delete($this->_excel);
    }
    function update_donhang($id,$data='')
    {
         $this->db->where('id_bill',$id)
            ->update($this->_master,$data);
    }
    function thongke_donhang($match)
    {
        if ($match == null) {
            $dh =   $this->db->select_sum('detail.into_money','doanhthu')
                    ->where('master.hidden',0)
                    ->from($this->_master)
                    ->join($this->_detail, 'master.id_bill = detail.id_bill')
                    ->get()
                    ->result_array();
                    return $dh;
        }else{
            $dh =   $this->db->select_sum('detail.into_money','doanhthu')
                    ->from($this->_master)
                    ->join($this->_detail, 'master.id_bill = detail.id_bill')
                    ->where($match)
                    ->get()
                    ->result_array();
                    return $dh;
        }
        
    }
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
        $sql = "Select Month(a.order_day) as 'thang', Sum(b.into_money) as 'doanh thu' From  `master` a, `detail` b WHERE a.id_bill = b.id_bill AND a.hidden=0  Group by Month(a.order_day)";
        $query = $this->db->query($sql); 
        $adata['doanhthu'] = $query->result_array();

        $sql1 = "Select Month(order_day) as 'thang', Count(*) as 'qty' From `master` Where hidden = 0  Group by Month(order_day)";
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

    function checkDonHangNhap($id_bill='')
    {
        $data['tongtien'] =   $this->db->select_sum('into_money','tongtien')
                    ->where('id_bill',$id_bill)
                    ->get($this->_detail)
                    ->result_array();

        $data['sp'] =   $this->db->select('id_sku_seller as id_sanpham')
                    ->where('id_bill',$id_bill)
                    ->group_by('id_sku_seller')
                    ->get($this->_detail)
                    ->result_array();
        return $data;
    }
    
    public function getDonHangCheck()
    {
        $match = array(
            'hidden' => 0,
            'checkLazada' => 0,
            'type_bill'  => 'Hàng Lazada'
        );
        $donhang = $this->db->select()
                    ->where($match)
                    ->get($this->_master)
                    ->result_array();
        return $donhang;
    }
}