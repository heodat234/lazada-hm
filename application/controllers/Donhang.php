<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Donhang extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->helper(array('url','my_helper'));
        $this->load->library(array('session','excel'));
        $this->load->model(array('Donhang_model','Sanpham_model'));
        $this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
        $this->_data['html_header']   = $this->load->view('home/header', NULL, TRUE); 
        $mdata['page'] = 'donhang';
        $this->_data['html_menu']     = $this->load->view('home/menu', $mdata, TRUE);
        
    }
	public function index()
	{	
        if ( ! $data['donhang'] = $this->cache->get('donhang') && ! $data['thongke'] = $this->cache->get('thongke'))
         {
            $match= '';
            $data['donhang'] = $this->Donhang_model->list_donhang();
            $data['thongke'] = $this->Donhang_model->thongke_donhang($match);
            $this->cache->save('donhang', $data['donhang'], 600);
            $this->cache->save('thongke', $data['thongke'], 600);
         }
        $this->_data['html_body'] = $this->load->view('page/listDonhang',$data,true); 	        
		return $this->load->view('home/master', $this->_data);
	}
    public function newDonhang()
    {   
        // $data['donhang'] = $this->Donhang_model->list_donhang();
        $data['sanpham'] = $this->Sanpham_model->list_sanpham();
        $this->_data['html_body'] = $this->load->view('page/newDonhang',$data,true);           
        return $this->load->view('home/master', $this->_data);
    }
    public function checkDonhang()
    {
        $id_donhang = $this->input->post('id');
        // var_dump($id_donhang);
        if ($this->Donhang_model->checkDonhang($id_donhang) == true) {
            print_r('1');
        }else print_r('0');
    }
    public function insertDonhang()
    {
        $post = $this->input->post();
        $sp = $this->Sanpham_model->checkSanpham($post['id_sanpham']);
            $ten_sp         = $sp['ten_sanpham'];
            $gia_nhap       = $sp['gia_nhap'];
            $so_luong_ban   = $sp['so_luong_ban'];
        // var_dump($post['id_sanpham']);
        $data = array(
                'id_donhang'            => $post['id_donhang'],
                'id_monhang'            => $post['id_monhang'],
                'id_sanpham'            => $post['id_sanpham'],
                'item_name'             => $ten_sp,
                'ten_khachhang'         => $post['ten_khachhang'],
                'phone'                 => $post['phone'],
                'status'                => $post['status'],
                'ma_van_don'            => $post['ma_van_don'],
                'phuongthuc_giaohang'   => 'Dropshipping',
                'phuongthuc_thanhtoan'  => $post['phuongthuc_thanhtoan'],
                'sales_deliver'         => unNumber_Format($post['sales_deliver']),
                'sales_return'          => $gia_nhap,
                'tro_gia'               => unNumber_Format($post['tro_gia']),
                'commission'            => unNumber_Format($post['phi_co_dinh']),
                'customer_shipping_fee' => unNumber_Format($post['phi_vanchuyen']),
                'phi_boi_thuong'        => '0',
                'sum_of_fee'            => unNumber_Format($post['phi_co_dinh']),
        );
        $this->Donhang_model->insert_donhang($data);
        $_data['so_luong_ban'] = $so_luong_ban +1;
        $this->Sanpham_model->edit_sanpham( $post['id_sanpham'], $_data);
        redirect(base_url('donhang'));
    }
    public function addDonhangExcel() 
    {
        if (!empty($_FILES['file']['name'])) {
            //Kiểm tra tồn tại thư mục
            // if (!is_dir('./files'))
            // {
            //    //Tạo thư mục
            //     mkdir('./files',777);
            // }
            $config['upload_path'] = './files';
            $config['allowed_types'] = 'xlsx';
            $config['file_name'] = $_FILES['file']['name'];
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
                if ($this->upload->do_upload('file')) {
                    $uploadData = $this->upload->data();
                    $a_data["file"] = $uploadData['file_name'];
                } else{
                    $error = $this->upload->display_errors();
                    echo $error;
                    $a_data["file"] = '';
                }
            }else{
                $a_data["file"] = '';
            }
            $data = $this->readExcel($a_data["file"]);

            redirect(base_url('donhang'));
    }
	public function readExcel($filename)
    {   
        $object = new PHPExcel();
        $objReader = PHPExcel_IOFactory::createReader('Excel2007');
        $objPHPExcel = $objReader->load('files/'.$filename);

        $objWorksheet  = $objPHPExcel->setActiveSheetIndex(1);
        $highestRow    = $objWorksheet->getHighestRow();
        // var_dump($highestRow);
        $highestColumn = $objWorksheet->getHighestColumn();
        $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
        $array = array();
        $data = array();
        $k=1;
        for ($row = 6; $row <= $highestRow;++$row)
        {
            if ($objWorksheet->getCellByColumnAndRow(0,$row)->getValue() == null) {
                break;
            }
            $commission = $objWorksheet->getCellByColumnAndRow(18,$row)->getValue();
            if (substr($commission, 0,1) == '-') 
                    $commission = trim($commission,'-');

            $sum_of_fee = $objWorksheet->getCellByColumnAndRow(29,$row)->getCalculatedValue();
            $gia_nhap   = $objWorksheet->getCellByColumnAndRow(13,$row)->getCalculatedValue();
            if (substr($sum_of_fee, 0,1) == '-') 
                    $sum_of_fee = trim($sum_of_fee,'-');

            $id_sanpham = $objWorksheet->getCellByColumnAndRow(2,$row)->getValue();
            $ten_sanpham = $objWorksheet->getCellByColumnAndRow(3,$row)->getValue();

            $data = array(
                'id_donhang'            => $objWorksheet->getCellByColumnAndRow(0,$row)->getValue(),
                'id_monhang'            => $objWorksheet->getCellByColumnAndRow(1,$row)->getValue(),
                'id_sanpham'            => $id_sanpham,
                'item_name'             => $ten_sanpham,
                'ten_khachhang'         => $objWorksheet->getCellByColumnAndRow(4,$row)->getValue(),
                'phone'                 => $objWorksheet->getCellByColumnAndRow(5,$row)->getValue(),
                'created_at'            => $objWorksheet->getCellByColumnAndRow(6,$row)->getValue(),
                'status'                => $objWorksheet->getCellByColumnAndRow(7,$row)->getValue(),
                'updated_at'            => $objWorksheet->getCellByColumnAndRow(8,$row)->getValue(),
                'ma_van_don'            => $objWorksheet->getCellByColumnAndRow(9,$row)->getValue(),
                'phuongthuc_giaohang'   => $objWorksheet->getCellByColumnAndRow(10,$row)->getValue(),
                'phuongthuc_thanhtoan'  => $objWorksheet->getCellByColumnAndRow(11,$row)->getValue(),
                'sales_deliver'         => $objWorksheet->getCellByColumnAndRow(12,$row)->getValue(),
                'sales_return'          => $gia_nhap,
                'tro_gia'               => $objWorksheet->getCellByColumnAndRow(17,$row)->getValue(),
                'commission'            => $commission,
                'customer_shipping_fee' => $objWorksheet->getCellByColumnAndRow(19,$row)->getValue(),
                'phi_boi_thuong'        => $objWorksheet->getCellByColumnAndRow(28,$row)->getValue(),
                'sum_of_fee'            => $sum_of_fee,
            );
            $this->Donhang_model->insert_donhang($data);

            $array = array(
                'id_sanpham'        => $id_sanpham,
                'ten_sanpham'       => $ten_sanpham,
                'gia_nhap'          => $gia_nhap,
                'so_luong_ban'      => 1,
            );
            if ($this->Sanpham_model->checkSanpham($id_sanpham) == false) {
                $this->Sanpham_model->insert_sanpham($array);
            }else{
                $sp = $this->Sanpham_model->checkSanpham($id_sanpham);
                $so_luong_ban   = $sp['so_luong_ban'];
                $_data['so_luong_ban'] = $so_luong_ban +1;
                $this->Sanpham_model->edit_sanpham( $id_sanpham, $_data);
            }
        }
    }
    public function locDonhang()
    { 
        $post   = $this->input->post();
        $match = array(
            'created_at >='=>$post['from'],
            'created_at <='=>$post['to']
        );
        $data['donhang'] = $this->Donhang_model->loc_donhang($match);
        $data['thongke'] = $this->Donhang_model->thongke_donhang($match);
        $data['start']      = $post['from'];
        $data['end']        = $post['to'];
        $this->_data['html_body'] = $this->load->view('page/listDonhang',$data,true);           
        return $this->load->view('home/master', $this->_data);
    }
}
