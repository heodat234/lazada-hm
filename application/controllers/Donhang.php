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
        if ( ! $data['donhang'] = $this->cache->get('donhang') )
         {
            $match= '';
            
            // $data['thongke'] = $this->Donhang_model->thongke_donhang($match);
            $this->cache->save('donhang', $data['donhang'], 600);
            // $this->cache->save('thongke', $data['thongke'], 600);
         }
        $data['donhang'] = $this->Donhang_model->list_donhang();
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
