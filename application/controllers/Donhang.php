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
        $match= '';
        for ($i=0; $i < count($data['donhang']); $i++) {
            $table_detail = '
                <table class="table table-hover table-bordered table-responsive" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Giá bán</th>
                            <th>Phí cố định</th>
                            <th>Phí khác</th>
                            <th>Phí GTGT</th>
                            <th>Khoản WHT</th>
                            <th>Khoản T.toán</th>
                        </tr>
                    </thead>
                    <tbody>
            ';
            $detail = json_decode($data['donhang'][$i]['detail'],true);
            for ($j=0; $j < count($detail); $j++) { 
                $table_detail .= '<tr>';
                $table_detail .= '<td>'.$detail[$j]['id_sanpham'].'</td>';
                $table_detail .= '<td>'.$detail[$j]['qty'].'</td>';
                $table_detail .= '<td>'.$detail[$j]['sales_deliver'].'</td>';
                $table_detail .= '<td>'.$detail[$j]['phi_co_dinh'].'</td>';
                $table_detail .= '<td>'.$detail[$j]['phi_khac'].'</td>';
                $table_detail .= '<td>'.$detail[$j]['phi_gtgt'].'</td>';
                $table_detail .= '<td>'.$detail[$j]['khoan_wht'].'</td>';
                $table_detail .= '<td>'.$detail[$j]['khoan_thanh_toan'].'</td>';
                $table_detail .= '</tr>';
            }  
            // var_dump($detail);
            $table_detail.= '
                    </tbody>
                </table>
            '; 
            $data['donhang'][$i]['table_detail'] = $table_detail;
        }
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
        // $data['bill_detail'] = $this->Donhang_model->get_data($match['bill'],'detail');
        $data['bill_detail'] = json_decode($data['bill_master'][0]['detail'],true);
        // var_dump($data['bill_detail']);
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
                'detail'                => json_encode($post['product']),
        );
        $this->Donhang_model->insert_master($master);


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
        // var_dump($post);
        $master = array(
                'type_bill'             => $post['type_bill'],
                'bill_status'           => $post['bill_status'],
                'payment_status'        => $post['payment_status'],
                'payment_method'        => $post['payment_method'],
                'order_day'             => $post['order_day'],
                'deliv_day'             => $post['deliv_day'],
                'detail'                => json_encode($post['product']),
        );
        $this->M_data->update(array('id_bill'=>$post['id_bill']),$master,'master');
        // foreach ($post['product'] as $key => $value) {
        //     $detail = array(
        //         'id_bill'               => $post['id_bill'],
        //         'id_product'            => $value['id_sanpham'],
        //         'id_sku_seller'         => $value['id_sanpham'],
        //         'price'                 => unNumber_Format($value['sales_deliver']),
        //         'qty'                   => unNumber_Format($value['qty']),
        //         'into_money'            => unNumber_Format($value['sales_deliver'])*unNumber_Format($value['qty']),
        //         'cost'                  => unNumber_Format($value['phi_co_dinh']),
        //         'other_cost'            => unNumber_Format($value['phi_khac']),
        //         'tax_gtgt'              => unNumber_Format($value['phi_gtgt']),
        //         'acc_wht'               => unNumber_Format($value['khoan_wht']),
        //         'acc_payment'           => unNumber_Format($value['khoan_thanh_toan']),
        //     );
        //     if (isset($value['id_bill_detail'])) {
        //         $this->M_data->update(array('id'=> $value['id_bill_detail']),$detail,'detail');
        //     }else{
        //         $this->M_data->insert($detail,'detail');
        //     } 
        // }
        redirect(base_url('donhang'));
    }

    public function addDonhangExcel() 
    {
        $this->Donhang_model->delete_lazada();
        if (!empty($_FILES['file']['name'])) {
            $config['upload_path'] = './files';
            $config['allowed_types'] = 'xlsx';
            $config['overwrite'] = TRUE;
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
            echo $data;
    }
	public function readExcel($filename)
    {   
        $this->Donhang_model->delete_lazada();
        $object = new PHPExcel();
        $objReader = PHPExcel_IOFactory::createReader('Excel2007');
        $objPHPExcel = $objReader->load('files/'.$filename);

        $objWorksheet  = $objPHPExcel->setActiveSheetIndex(0);
        $highestRow    = $objWorksheet->getHighestRow();
        $highestColumn = $objWorksheet->getHighestColumn();
        $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
        $array = array();
        $data = array();
        $k=1;
        for ($row = 2; $row <= $highestRow;++$row)
        {
            if ($objWorksheet->getCellByColumnAndRow(0,$row)->getValue() == null) {
                return 1;
                break;
            }
            $id_donhang           =  $objWorksheet->getCellByColumnAndRow(0,$row)->getValue();
            if ($this->Donhang_model->checkDonhangLazada($id_donhang) == false) {
                $detail = array(
                    'id_sanpham'            => $objWorksheet->getCellByColumnAndRow(7,$row)->getValue(),
                    'qty'                   => $objWorksheet->getCellByColumnAndRow(8,$row)->getValue(),
                    'sales_deliver'         => $objWorksheet->getCellByColumnAndRow(9,$row)->getValue(),
                    'phi_co_dinh'           => $objWorksheet->getCellByColumnAndRow(10,$row)->getValue(),
                    'phi_khac'              => $objWorksheet->getCellByColumnAndRow(11,$row)->getValue(),
                    'phi_gtgt'              => $objWorksheet->getCellByColumnAndRow(12,$row)->getValue(),
                    'khoan_wht'             => $objWorksheet->getCellByColumnAndRow(13,$row)->getValue(),
                    'khoan_thanh_toan'      => $objWorksheet->getCellByColumnAndRow(14,$row)->getValue(),
                );

                $lazada = array(
                    'id_bill'               => $id_donhang,
                    'type_bill'             => $objWorksheet->getCellByColumnAndRow(1,$row)->getValue(),
                    'bill_status'           => $objWorksheet->getCellByColumnAndRow(2,$row)->getValue(),
                    'payment_method'        => $objWorksheet->getCellByColumnAndRow(3,$row)->getValue(),
                    'payment_status'        => $objWorksheet->getCellByColumnAndRow(4,$row)->getValue(),
                    'order_day'             => $objWorksheet->getCellByColumnAndRow(5,$row)->getValue(),
                    'deliv_day'             => $objWorksheet->getCellByColumnAndRow(6,$row)->getValue(),
                    'detail'                => json_encode($detail),
                );
                $this->Donhang_model->insert_lazada($lazada);

            }else {
                    $dh = $this->Donhang_model->checkDonhangLazada($id_donhang);
                    $detail = json_decode($dh['detail'],true);
                    $update_detail = array(
                        'id_sanpham'            => $objWorksheet->getCellByColumnAndRow(7,$row)->getValue(),
                        'qty'                   => $objWorksheet->getCellByColumnAndRow(8,$row)->getValue(),
                        'sales_deliver'         => $objWorksheet->getCellByColumnAndRow(9,$row)->getValue(),
                        'phi_co_dinh'           => $objWorksheet->getCellByColumnAndRow(10,$row)->getValue(),
                        'phi_khac'              => $objWorksheet->getCellByColumnAndRow(11,$row)->getValue(),
                        'phi_gtgt'              => $objWorksheet->getCellByColumnAndRow(12,$row)->getValue(),
                        'khoan_wht'             => $objWorksheet->getCellByColumnAndRow(13,$row)->getValue(),
                        'khoan_thanh_toan'      => $objWorksheet->getCellByColumnAndRow(14,$row)->getValue(),
                    );
                    array_push($detail, $update_detail);
                    $lazada = array(
                        'detail'                => json_encode($detail),
                    ); 
                $this->Donhang_model->update_lazada($id_donhang,$lazada);  
            }
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
        $check   = $this->input->post('check');
        switch ($check) {
            case 'qty':
                $qty_Lazada = $this->Donhang_model->countLazada();
                $qty_Donhang = $this->Donhang_model->countDonHang();
                if ($qty_Donhang == $qty_Lazada) {
                    $data['thongbao']        = '<h5 style="color:blue">Số lượng đơn hàng trùng khớp. </h4>';
                }else{
                    $data['thongbao']        = '<h4 style="color:red">Số lượng đơn hàng không trùng khớp. </h4>';
                }
                 $data['donhang'] = $this->Donhang_model->listDonhang();
                 $match= '';
                $data['thongke'] = $this->Donhang_model->thongke_donhang($match);
                $this->_data['html_body'] = $this->load->view('page/listDonhang',$data,true);           
                    return $this->load->view('home/master', $this->_data);
                break;
            
            case 'detail':
                $donhang = $this->Donhang_model->getDonHangCheck();
                foreach ($donhang as $dh) {
                    $lazada = $this->Donhang_model->checkDonhangLazada($dh['id_bill']);
                    if ($lazada == false) {
                        $data = array('checkLazada' => '2');
                        $this->Donhang_model->update_donhang($dh['id_bill'],$data);
                    }else{
                        $detail_dh      = json_decode($dh['detail'],true);
                        $detail_lazada  = json_decode($lazada['detail'],true);
                        $checkSP = true;
                        if (count($detail_dh) == count($detail_lazada)) {
                            for ($i=0; $i < count($detail_dh); $i++) {
                                $ss[$i] = array_diff($detail_dh[$i],$detail_lazada[$i]);
                                if(!empty($ss[$i])){
                                    $checkSP = false;
                                }
                            }
                            
                            if($checkSP){
                                $data = array('checkLazada' => '1');
                                $this->Donhang_model->update_donhang($dh['id_bill'],$data);
                                $this->Donhang_model->update_lazada($dh['id_bill'],$data);
                            }else{
                                $data = array('checkLazada' => '2');
                                $this->Donhang_model->update_donhang($dh['id_bill'],$data);
                                $this->Donhang_model->update_lazada($dh['id_bill'],$data);
                            }
                        }else{
                            $data = array('checkLazada' => '2');
                            $this->Donhang_model->update_donhang($dh['id_bill'],$data);
                            $this->Donhang_model->update_lazada($dh['id_bill'],$data);
                        }
                        
                    }
                }
                
                $data['donhang'] = $this->Donhang_model->listDonhang();
                $match= '';
                $data['thongke'] = $this->Donhang_model->thongke_donhang($match);
                $this->_data['html_body'] = $this->load->view('page/listDonhang',$data,true);           
                return $this->load->view('home/master', $this->_data);
                break;

            case 'all':
                $qty_Lazada = $this->Donhang_model->countLazada();
                $qty_Donhang = $this->Donhang_model->countDonHang();
                if ($qty_Donhang == $qty_Lazada) {
                    $data['thongbao']        = '<h4 style="color:blue">Số lượng đơn hàng trùng khớp. </h4>';
                }else{
                    $data['thongbao']        = '<h4 style="color:red">Số lượng đơn hàng không trùng khớp. </h4>';
                }
                $donhang = $this->Donhang_model->getDonHangCheck();
                foreach ($donhang as $dh) {
                    $lazada = $this->Donhang_model->checkDonhangLazada($dh['id_bill']);
                    if ($lazada == false) {
                        $data = array('checkLazada' => '2');
                        $this->Donhang_model->update_donhang($dh['id_bill'],$data);
                    }else{
                        $detail_dh      = json_decode($dh['detail'],true);
                        $detail_lazada  = json_decode($lazada['detail'],true);
                        $checkSP = true;
                        if (count($detail_dh) == count($detail_lazada)) {
                            for ($i=0; $i < count($detail_dh); $i++) {
                                $ss[$i] = array_diff($detail_dh[$i],$detail_lazada[$i]);
                                if(!empty($ss[$i])){
                                    $checkSP = false;
                                }
                            }
                            
                            if($checkSP){
                                $data = array('checkLazada' => '1');
                                $this->Donhang_model->update_donhang($dh['id_bill'],$data);
                                $this->Donhang_model->update_lazada($dh['id_bill'],$data);
                            }else{
                                $data = array('checkLazada' => '2');
                                $this->Donhang_model->update_donhang($dh['id_bill'],$data);
                                $this->Donhang_model->update_lazada($dh['id_bill'],$data);
                            }
                        }else{
                            $data = array('checkLazada' => '2');
                            $this->Donhang_model->update_donhang($dh['id_bill'],$data);
                            $this->Donhang_model->update_lazada($dh['id_bill'],$data);
                        }
                        
                    }
                }
                
                $data['donhang'] = $this->Donhang_model->listDonhang();
                 $match= '';
                $data['thongke'] = $this->Donhang_model->thongke_donhang($match);
                $this->_data['html_body'] = $this->load->view('page/listDonhang',$data,true);           
                    return $this->load->view('home/master', $this->_data);
                break;

            default:
                # code...
                break;
        }
        
    }
    
}
