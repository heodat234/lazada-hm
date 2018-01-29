<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Donhang extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->helper(array('url','my_helper'));
        $this->load->library(array('session','excel'));
        $this->load->model(array('Donhang_model','Sanpham_model','M_data'));
        $this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
        $this->_data['html_header']   = $this->load->view('home/header', NULL, TRUE); 
        $mdata['page'] = 'donhang';
        $this->_data['html_menu']     = $this->load->view('home/menu', $mdata, TRUE);
        
    }
	public function index()
	{	
        $data['donhang'] = $this->Donhang_model->listDonhang();
        $data['tong'] = $this->Donhang_model->getTongtienDonhang();
         // echo "<pre>";
         // print_r($data['tong']);
         // echo "</pre>";
         $match= '';
        $data['thongke'] = $this->Donhang_model->thongke_donhang($match);
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
    public function editDonhang($id)
    {   
        // $data['donhang'] = $this->Donhang_model->list_donhang();
        $match['bill'] = array(
            'id_bill'=>$id,
            'hidden'=>0
        );
        $data['bill_master'] = $this->Donhang_model->get_data($match['bill'],'master');
        $data['bill_detail'] = $this->Donhang_model->get_data($match['bill'],'detail');
        $data['sanpham'] = $this->Sanpham_model->list_sanpham();
        $this->_data['html_body'] = $this->load->view('page/editDonhang',$data,true);           
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


        foreach ($post['product'] as $key => $value) {
            $detail = array(
                'id_bill'               => $post['id_bill'],
                'id_product'            => $value['id_sanpham'],
                'id_sku_seller'         => $value['id_sanpham'],
                'price'                 => unNumber_Format($value['sales_deliver']),
                'qty'                   => unNumber_Format($value['qty']),
                'into_money'            => unNumber_Format($value['sales_deliver'])*unNumber_Format($value['qty']),
                'cost'                  => unNumber_Format($value['phi_co_dinh']),
                'other_cost'            => unNumber_Format($value['phi_khac']),
                'tax_gtgt'              => unNumber_Format($value['phi_gtgt']),
                'acc_wht'               => unNumber_Format($value['khoan_wht']),
                'acc_payment'           => unNumber_Format($value['khoan_thanh_toan']),
            );
            $this->Donhang_model->insert_detail($detail);
        }
        redirect(base_url('donhang'));
    }
    public function delete_detail(){
        $id = $this->input->post('id');
        $match = array('id'=>$id);
        $up_data = array('hidden'=>1);
        $table = 'detail';
        $this->M_data->update($match,$up_data,$table);
        $data['success'] = "Thành công.";
        echo json_encode($data);
    }
    public function delete_bill(){
        $id = $this->input->post('id');
        $match = array('id_bill'=>$id);
        $up_data = array('hidden'=>1);
        $this->M_data->update($match,$up_data,'master');
        $data['success'] = "Thành công.";
        echo json_encode($data);
    }
    public function updateDonhang(){
        $post = $this->input->post();
        $master = array(
                'type_bill'             => $post['type_bill'],
                'bill_status'           => $post['bill_status'],
                'payment_status'        => $post['payment_status'],
                'payment_method'        => $post['payment_method'],
                'order_day'             => $post['order_day'],
                'deliv_day'             => $post['deliv_day'],
                
        );
        $this->M_data->update(array('id_bill'=>$post['id_bill']),$master,'master');
        foreach ($post['product'] as $key => $value) {
            $detail = array(
                'id_bill'               => $post['id_bill'],
                'id_product'            => $value['id_sanpham'],
                'id_sku_seller'         => $value['id_sanpham'],
                'price'                 => unNumber_Format($value['sales_deliver']),
                'qty'                   => unNumber_Format($value['qty']),
                'into_money'            => unNumber_Format($value['sales_deliver'])*unNumber_Format($value['qty']),
                'cost'                  => unNumber_Format($value['phi_co_dinh']),
                'other_cost'            => unNumber_Format($value['phi_khac']),
                'tax_gtgt'              => unNumber_Format($value['phi_gtgt']),
                'acc_wht'               => unNumber_Format($value['khoan_wht']),
                'acc_payment'           => unNumber_Format($value['khoan_thanh_toan']),
            );
            if (isset($value['id_bill_detail'])) {
                $this->M_data->update(array('id'=> $value['id_bill_detail']),$detail,'detail');
            }else{
                $this->M_data->insert($detail,'detail');
            } 
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
            $id_donhang           =  $objWorksheet->getCellByColumnAndRow(0,$row)->getValue();
            
            $commission = $objWorksheet->getCellByColumnAndRow(18,$row)->getValue();
            if (substr($commission, 0,1) == '-') 
                    $commission = trim($commission,'-');
            
            $sum_of_fee = $objWorksheet->getCellByColumnAndRow(29,$row)->getCalculatedValue();
            if (substr($sum_of_fee, 0,1) == '-') 
                    $sum_of_fee = trim($sum_of_fee,'-');
            $gia_nhap   = $objWorksheet->getCellByColumnAndRow(13,$row)->getCalculatedValue();
            

            $lazada = array(
                'id_donhang'            => $id_donhang,
                'id_monhang'            => $objWorksheet->getCellByColumnAndRow(1,$row)->getValue(),
                'id_sanpham'            => $objWorksheet->getCellByColumnAndRow(2,$row)->getValue(),
                'item_name'             => $objWorksheet->getCellByColumnAndRow(3,$row)->getValue(),

                'created_at'            => $objWorksheet->getCellByColumnAndRow(6,$row)->getValue(),
                'status'                => $objWorksheet->getCellByColumnAndRow(7,$row)->getValue(),
                // 'ma_van_don'            => $objWorksheet->getCellByColumnAndRow(9,$row)->getValue(),
                'phuongthuc_thanhtoan'  => $objWorksheet->getCellByColumnAndRow(11,$row)->getValue(),
                'sales_deliver'         => $objWorksheet->getCellByColumnAndRow(12,$row)->getValue(),
                'sales_return'          => $gia_nhap,
                'tro_gia'               => $objWorksheet->getCellByColumnAndRow(17,$row)->getValue(),
                'commission'            => $commission,
                'customer_shipping_fee' => $objWorksheet->getCellByColumnAndRow(19,$row)->getValue(),
                'phi_boi_thuong'        => $objWorksheet->getCellByColumnAndRow(28,$row)->getValue(),
                'sum_of_fee'            => $sum_of_fee,
            );
            
            
            $this->Donhang_model->insert_lazada($lazada);
            
        }
    }
    public function locDonhang()
    { 
        $post   = $this->input->post();
        $match = array(
            'master.hidden'       => 0,
            'master.order_day >='=>$post['from'],
            'master.order_day <='=>$post['to']
        );
        $data['donhang'] = $this->Donhang_model->loc_donhang($match);
        $data['thongke'] = $this->Donhang_model->thongke_donhang($match);
        $data['start']      = $post['from'];
        $data['end']        = $post['to'];
        $this->_data['html_body'] = $this->load->view('page/listDonhang',$data,true);           
        return $this->load->view('home/master', $this->_data);
    }

    public function checkLazada()
    {
        $post   = $this->input->post();
        $id_bill = '361759685';
        $nhap = $this->Donhang_model->checkDonHangNhap($id_bill);
        $lazada = $this->Donhang_model->checkLazada($id_bill);
        $data['checkTien'] = false;
        if ($nhap['tongtien'][0]['tongtien'] == $lazada['tongtien'][0]['tongtien']) {
            $data['checkTien'] = true;
        }
        $a = count($nhap['sp']);
        $b = count($lazada['sp']);
        $mang1 = $nhap['sp'];
        $mang2 = $lazada['sp'];
        $kq = array();
        $data['checkSP'] = true;
        if ($a != $b) {
            $data['checkSP'] = false;
        }
        else{
            for ($i=0; $i < $a; $i++) { 
               $ss[$i] = array_diff($mang1[$i],$mang2[$i]);
               if(!empty($ss[$i])){
                    $data['checkSP'] = false;
                    $kq[$i]= $ss[$i];
                }
            }
            
        }
        if (!$data['checkSP']) {
           $data['danger'] = $kq;
        }
        
        echo json_encode($data);
    }
    public function xemDonhangLazada($id_bill)
    {   
         $data['lazada'] = $this->Donhang_model->getDonhangLazada($id_bill);
         $data['tong'] = 0;
         for ($i=0; $i < count($data['lazada']) ; $i++) { 
            $data['tong'] += $data['lazada'][$i]['price']-0;
         }
         // echo "<pre>";
         // print_r($data['tong']);
         // echo "</pre>";
        $this->_data['html_body'] = $this->load->view('page/pageDonLazada',$data,true);           
        return $this->load->view('home/master', $this->_data);
    }
}
