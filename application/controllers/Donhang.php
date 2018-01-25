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
        if ( ! $data['donhang'] = $this->cache->get('donhang') )
         {
            $match= '';
            $data['donhang'] = $this->Donhang_model->list_donhang();
            // $data['thongke'] = $this->Donhang_model->thongke_donhang($match);
            $this->cache->save('donhang', $data['donhang'], 600);
            // $this->cache->save('thongke', $data['thongke'], 600);
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
        // var_dump($post['product']);
        
        $master = array(
                'id_bill'               => $post['id_bill'],
                'type_bill'             => $post['type_bill'],
                'bill_status'           => $post['bill_status'],
                'payment_status'        => $post['payment_status'],
                'payment_method'        => $post['payment_method'],
                'order_day'             => $post['order_day'],
                'deliv_day'             => $post['deliv_day'],
                
        );
        $this->Donhang_model->insert_master($master);


        for ($i=1; $i <= count($post['product']) ; $i++) { 
            $detail = array(
                'id_bill'               => $post['id_bill'],
                'id_product'            => $post['product'][$i]['id_sanpham'],
                'id_sku_seller'         => $post['product'][$i]['id_sanpham'],
                'price'                 => unNumber_Format($post['product'][$i]['price']),
                'qty'                   => unNumber_Format($post['product'][$i]['qty']),
                'into_money'            => unNumber_Format($post['product'][$i]['into_money']),
                'cost'                  => unNumber_Format($post['product'][$i]['phi_co_dinh']),
                'other_cost'            => unNumber_Format($post['product'][$i]['phi_khac']),
                'tax_gtgt'              => unNumber_Format($post['product'][$i]['phi_gtgt']),
                'acc_wht'               => unNumber_Format($post['product'][$i]['khoan_gtgt']),
                'acc_payment'           => unNumber_Format($post['product'][$i]['khoan_thanhtoan']),
            );
            $this->Donhang_model->insert_detail($detail);
        }
        
       

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

            $phi_khac  = $objWorksheet->getCellByColumnAndRow(17,$row)->getValue() + $objWorksheet->getCellByColumnAndRow(19,$row)->getValue();
            // $sum_of_fee = $objWorksheet->getCellByColumnAndRow(29,$row)->getCalculatedValue();
            $gia_nhap   = $objWorksheet->getCellByColumnAndRow(13,$row)->getCalculatedValue();
            

            $id_sanpham = $objWorksheet->getCellByColumnAndRow(2,$row)->getValue();
            $ten_sanpham = $objWorksheet->getCellByColumnAndRow(3,$row)->getValue();

            $master = array(
                'id_donhang'            => $objWorksheet->getCellByColumnAndRow(0,$row)->getValue(),
                'type_bill'             => 'Hàng Lazada',                
                'order_day'             => $objWorksheet->getCellByColumnAndRow(6,$row)->getValue(),
                'payment_status'        => $objWorksheet->getCellByColumnAndRow(7,$row)->getValue(),
                'updated_at'            => $objWorksheet->getCellByColumnAndRow(8,$row)->getValue(),
                // 'ma_van_don'            => $objWorksheet->getCellByColumnAndRow(9,$row)->getValue(),
                'payment_status'        => $objWorksheet->getCellByColumnAndRow(10,$row)->getValue(),
                'payment_method'        => $objWorksheet->getCellByColumnAndRow(11,$row)->getValue(),
                'other_cost'            => $phi_khac,
            );
            $detail = array(
                'id_product' => $objWorksheet->getCellByColumnAndRow(1,$row)->getValue(), 
                'id_sku_seller'         => $id_sanpham,
                'price'                 => $objWorksheet->getCellByColumnAndRow(12,$row)->getValue(),
                'cost'                  => $commission,
            );
            
            $this->Donhang_model->insert_donhang($data);

            $array = array(
                'id_product'        => $id_sanpham,
                'name'              => $ten_sanpham,
                'price'             => $gia_nhap,
                'export_qty'        => 1,
            );
            if ($this->Sanpham_model->checkSanpham($id_sanpham) == false) {
                $this->Sanpham_model->insert_sanpham($array);
            }else{
                $sp = $this->Sanpham_model->checkSanpham($id_sanpham);
                $so_luong_ban   = $sp['export_qty'];
                $_data['export_qty'] = $so_luong_ban +1;
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
        // $data['thongke'] = $this->Donhang_model->thongke_donhang($match);
        $data['start']      = $post['from'];
        $data['end']        = $post['to'];
        $this->_data['html_body'] = $this->load->view('page/listDonhang',$data,true);           
        return $this->load->view('home/master', $this->_data);
    }
}
