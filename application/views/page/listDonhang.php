
<div id="loader-overlay"><img src="<?php echo base_url() ?>public/images/loader.gif" alt="Loading" /></div>
<div>
  <div class="content-wrapper">
    <h1 class="title-page">Đơn hàng</h1>
    <div class="row">
      <div class="col-md-6">
        <div class="box">
          <div class="box-header with-boder">
            <h3 class="box-title">Lọc kết quả</h3>
            <h3 class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool accordion" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </h3>
          </div>
          <div class="animate">
            <div class="box-body no-padding-bottom" >
              <form method="post" action="<?php echo base_url() ?>locDonhang" id="filter-form">
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Từ ngày</label>
                      <?php if (isset($start)) {
                        echo '<input type="date" name="from" class="form-control" value="'.$start.'">';
                      } else{
                        echo '<input type="date" name="from" class="form-control" id="date-from-picker">';
                      } ?>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Đến ngày</label>
                      <?php if (isset($end)) {
                        echo '<input type="date" name="to" class="form-control" value="'.$end.'">';
                      } else{
                        echo '<input type="date" name="to" class="form-control" id="date-to-picker">';
                      } ?>
                    </div>
                  </div>
                </div>
              </form>
            </div>
            <div class="box-footer no-padding-bottom quick_filter_container">
              <div class="quick_filter">
                <button class="btn_margin_bottom btn btn-warning btn_quick_filter" id="btn-filter"><i class="fa fa-search"></i> Lọc kết quả</button>
                <div class="pull-right">
                  <a class="btn_margin_bottom btn btn-success btn_quick_filter" href="<?php echo base_url() ?>taodonhang"><i class="fa fa-plus"></i> Thêm đơn hàng mới</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="box">
          <div class="box-header with-boder">
            <h3 class="box-title">Kiểm tra</h3>
            <h3 class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool accordion" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </h3>
          </div>
          <form method="post" action="<?php echo base_url() ?>Donhang/checkLazada" id="filter-form">
            <div class="animate">
              <div class="box-body no-padding-bottom" >
                  <div class="row">
                    <div class="col-sm-4">
                      <div class="form-group checkBC">
                        <input type="radio" name="check" value="qty">
                        So sánh số lượng đơn hàng
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group checkBC">
                        <input type="radio" name="check" value="detail">
                        So sánh chi tiết đơn hàng
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group checkBC">
                        <input type="radio" name="check" value="all">
                        So sánh tất cả
                      </div>
                    </div>
                  </div>
              </div>
              <div class="box-footer no-padding-bottom quick_filter_container">
                <div class="quick_filter">
                  <a class="btn_margin_bottom btn btn-default btn_quick_filter" href="<?php echo base_url() ?>file_mau.xlsx"><i class="fa fa-download"></i> Tải file mẫu</a>
                  <button type="button" class="btn_margin_bottom btn btn-info btn_quick_filter" data-toggle="modal" data-target="#addFile"><i class="fa fa-upload"></i> Tải nhập file báo cáo</button> 
                  <div class="pull-right">
                    <button type="submit" class="btn_margin_bottom btn btn-primary btn_quick_filter" ><i class="fa fa-check"></i> Kiểm tra</button> 
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>   
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-boder">
            <h2 class="box-title">Danh sách đơn hàng</h2>
            <h3 class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool thuphong" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </h3>
            <div class="row" style="margin-top: 10px;">
              <div class="col-sm-4">
                <h4><input type="checkbox" onclick="check_all()"  name="checkBox" id="check_all" > Tổng số đơn hàng: <strong class="label label-info num-info"><?php echo number_format(count($donhang)) ?></strong>
                </h4>
              </div>
              <div class="col-sm-4">
                <h4><input type="checkbox" onchange="filterme()" name="check_lazada" id="checkbox1" value="1|2"> Tổng đơn đã tải lên: <strong class="label label-info num-info"><?php echo number_format(count($donhang)-$dem['chua_tai']) ?></strong></h4>
              </div>
              <div class="col-sm-4">
                <h4><input type="checkbox" onchange="filterme()" name="check_lazada" id="checkbox1" value="1"> Trùng khớp: <strong class="label label-info num-info"><?php echo number_format($dem['trung_khop']) ?></strong></h4>
              </div>
              <div class="col-sm-4">
                <h4><input type="checkbox" onchange="filterme()" name="check_status" id="checkbox1" value="Đã giao hàng"> Đã giao hàng: <strong class="label label-info num-info"><?php echo number_format($dem['da_giaohang']) ?></strong></h4>
              </div>
              <div class="col-sm-4">
                <h4><input type="checkbox" onchange="filterme()" name="check_lazada" id="checkbox1" value="0"> Tổng đơn chưa tải lên: <strong class="label label-info num-info"><?php echo number_format($dem['chua_tai']) ?></strong></h4>
              </div>
              <div class="col-sm-4">
                <h4><input type="checkbox" onchange="filterme()" name="check_lazada" id="checkbox1" value="2"> Sai lệch: <strong class="label label-info num-info"><?php echo number_format(count($donhang)-$dem['chua_tai']-$dem['trung_khop']) ?></strong></h4>
              </div>
              <div class="col-sm-4">
                <h4><input type="checkbox" onchange="filterme()" name="check_status" id="checkbox1" value="Trả lại"> Đã hủy: <strong class="label label-info num-info"><?php echo number_format($dem['da_huy']) ?></strong></h4>
              </div>
            </div>
            <?php if($this->session->has_userdata('thongbao')) echo $this->session->userdata('thongbao') ?>
          </div>
          <div class="animate_1">
            <div class="box-body no-padding-bottom" >
              <table class="table table-hover table-bordered table-responsive" cellspacing="0" width="100%" id="sampleTable">
                <thead>
                  <tr>
                    <th class="col-data-table-0-2"></th>
                    <th class="col-data-table-0-7">Mã đơn hàng</th>
                    <th class="col-data-table-0-7">Loại đơn hàng</th>
                    <th class="col-data-table-0-7">Trạng thái đơn hàng</th>
                    <th class="col-data-table-1-7">Ngày đặt hàng</th>
                    <th class="col-data-table-1-7">Ngày giao hàng</th>
                    <th class="col-data-table-1-7">Kiểm tra</th>
                    <th class="col-data-table-1-7">Tổng tiền</th>
                    <th class="col-data-table-1-7">Số sản phẩm</th>
                    <th class="col-data-table-1-7">Phương thức thanh toán</th>
                    <th class="col-data-table-1-7">Tình trạng thanh toán</th>
                    <th class="col-data-table-0-7">Thao tác</th>
                    <th class="col-data-table-0-7">Chi tiết đơn hàng</th>
                    <th style="display: none;"></th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($donhang as $row): ?>
                      <tr class="check_<?php echo $row['checkLazada'] ?>">
                        <td></td>
                        <td><?php echo $row['id_bill'] ?></td>
                        <td><?php echo $row['type_bill'] ?></td>
                        <td><?php echo $row['bill_status'] ?></td>
                        <td><?php echo date('d-m-Y H:i:s',strtotime($row['order_day'])) ?></td>
                        <td><?php echo date('d-m-Y H:i:s',strtotime($row['deliv_day'])) ?></td>
                        <td style="text-align: center;">
                          <?php if ($row['checkLazada'] == 0 && $row['type_bill']=='Hàng Lazada'){ ?>
                            
                          <?php }elseif ($row['checkLazada'] == 1 && $row['type_bill']=='Hàng Lazada') { ?>
                            <i class="fa fa-check"></i>
                          <?php }elseif ($row['checkLazada'] == 2 && $row['type_bill']=='Hàng Lazada') { ?>
                            <a href="javascrip:void(0)" onclick="showCheck('<?php echo $row['id_bill'] ?>')" style="color:red;" ><i class="fa fa-minus-circle"></i></a>
                          <?php }else{echo "";} ?>
                        </td>
                        <?php 
                            $detail     = json_decode($row['detail'],true);
                            $qty = count($detail);
                            $tien = 0;
                            foreach ($detail as $de) {
                                $tien += $de['qty']*$de['sales_deliver'];
                            } 
                            echo "<td>".number_format($tien)."</td><td>".number_format($qty)."</td>";
                            
                        ?>
                           
                        <td><?php echo $row['payment_method'] ?></td>
                        <td><?php echo $row['payment_status'] ?></td>
                        <td><a class="btn btn-primary btn-flat" href="<?=base_url()?>suadonhang/<?php echo $row['id_bill']?>"><i class="fa fa-lg fa-edit"></i> Sửa</a> <a class="btn btn-danger btn-flat" onclick="delRow('<?php echo $row['id_bill']?>')"><i class="fa fa-lg fa-trash"></i> Xóa</a>
                          
                        </td>
                        <td><?php echo $row['id_bill'].$row['table_detail'] ?></td>
                        <td><?php echo $row['checkLazada'] ?> </td>
                      </tr>                    
                  <?php endforeach?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>


<!-- add file -->
<div class="modal fade" id="addFile"  role="dialog"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
   <div class="modal-content">
      <div class="modal-header">
         <button type="button" class="close" data-dismiss='modal' aria-hidden="true"><span class="glyphicon glyphicon-remove"></span></button>
         <h4 class="modal-title" style="font-size: 20px; padding: 12px;">Thêm file excel</h4>
      </div>
      <form method="post" id="add-form" enctype="multipart/form-data" >
        <div class="modal-body">
           <div class="container-fluid">
              <div class="row">
                 <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                       <div><b>Chọn file</b></div>
                       <div class="input-group">
                          <div class="input-group-addon iga2">
                             <span class="glyphicon glyphicon-folder-open"></span>
                          </div>
                          <input type="file" class="form-control" name="file" required="" id="i_file">
                          
                       </div>
                       <div class="alert alert-danger hide"></div>
                       <div class="alert alert-success hide"></div>
                    </div>
                 </div>
              </div>
           </div>
        </div>
        <div class="modal-footer">
           <div class="form-group">
              <button type="button" class="btn btn-sm btn-info"  id="btn-add"> Gửi <span class="glyphicon glyphicon-saved"></span></button>
              <button type="button" data-dismiss="modal" class="btn btn-sm btn-default"> Hủy <span class="glyphicon glyphicon-remove"></span></button>
           </div>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- show 2 đơn hàng so sánh -->
<div class="modal fade" id="showCheck"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
   <div class="modal-content">
      <div class="modal-header">
         <button type="button" class="close" data-dismiss='modal' aria-hidden="true"><span class="glyphicon glyphicon-remove"></span></button>
         <h4 class="modal-title" style="font-size: 20px; padding: 12px;">Chi tiết đơn hàng so sánh</h4>
      </div>
      <div class="modal-body">
         <div class="container-fluid">
            <div class="row">
                Đơn hàng nhập
               <div class="dom_check1"></div>
               Báo cáo Lazada
               <div class="dom_check2"></div>
            </div>
         </div>
      </div>
      <div class="modal-footer">
         <div class="form-group">
            <button type="button" data-dismiss="modal" class="btn btn-sm btn-default"> Đóng <span class="glyphicon glyphicon-remove"></span></button>
         </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $('.thuphong').on('click',function(event) {
      this.classList.toggle("active");
        if ($('.animate_1').hasClass('tat')) {
                  $('.animate_1').removeClass('tat');
                  $('.animate_1').animate({height:'toggle'},1000);
                  $('.thuphong').html('<i class="fa fa-minus"></i>');
        } else {
                $('.animate_1').addClass('tat');
                $('.animate_1').animate({height:'toggle'},1000);
                $('.thuphong').html('<i class="fa fa-plus"></i>');
        }
  });

  var date = new Date(), y = date.getFullYear(), m = date.getMonth();
  var fd = new Date(y, m, 2);
  var ld = new Date(y, m + 1, 1);
  
  if ($('#date-from-picker').length >0 && $('#date-to-picker').length >0) {
    document.querySelector("#date-from-picker").valueAsDate = fd;
    document.querySelector("#date-to-picker").valueAsDate = ld;
  }
  // document.querySelector("#date-from-picker").valueAsDate = fd;
  // document.querySelector("#date-to-picker").valueAsDate = ld;


  $('#btn-filter').click(function(event) {
    $('#filter-form').submit();
  });


  $('.checkBC').click(function() {
    $('input[name="check"]', this).prop("checked",true);
    $('.checkBC').removeClass('hli');
    $(this).addClass('hli');
  });

  $('#btn-add').click( function(e) {
           //kiem tra trinh duyet co ho tro File API
            if (window.File && window.FileReader && window.FileList && window.Blob)
            {
              // lay dung luong va kieu file tu the input file
                var ftype = $('#i_file')[0].files[0].type;
               // alert( ftype);
               switch(ftype)
                {
                    case 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet':
                        var frm = new FormData($('form#add-form')[0]);
                        $('#addFile').modal('hide');
                        $('#loader-overlay').show();
                        $.ajax({
                          url: '<?php echo base_url() ?>addExcel',
                          processData:false,
                          contentType:false,
                          type:'post',
                          dataType:'json',
                          data:frm,
                        })
                        .done(function(data) {
                          
                          if (data==1) {
                            $('#loader-overlay').hide();
                          }
                         
                        })
                        .fail(function() {
                          console.log("error");
                        });
                        break;
                    default:
                        alert('File chỉ được Excel');
                        $('#i_file')[0].val(null);
                        e.preventDefault();
                }
         
            }else{
                alert("Please upgrade your browser, because your current browser lacks some new features we need!");
            }
        });
function delRow(id){
  ssi_modal.confirm({
    content: 'Bạn có chắc muốn xóa đơn hàng này?',
    okBtn: {
      className:'btn btn-primary'
    },
    cancelBtn:{
        className:'btn btn-danger'
    }
  },function (result) {
      if(result){
          var route="<?= base_url()?>Donhang/delete_bill/";
          $.ajax({
            url:route,
            type:'post',
            dataType:'json',
            data:{
              id:id,
            },
            success:function(data){
              if (data.success) {
                window.location.reload();
              }else{
                ssi_modal.notify('error', {content: 'Thất bại.'});
              }   
            }
          });
      }
      else
          ssi_modal.notify('error', {content: 'Thất bại: ' + result});
      }
  );
}


$(function() {
  otable = $('#sampleTable').dataTable();
})

function filterme() {
  

  var check_status = $('input:checkbox[name="check_status"]:checked').map(function() {
    return '^' + this.value + '\$';
  }).get().join('|');
  otable.fnFilter(check_status, 3, true, false, false, false);

  var check_lazada = $('input:checkbox[name="check_lazada"]:checked').map(function() {
    return '^' + this.value + '\$';
  }).get().join('|');
  otable.fnFilter(check_lazada, 13, true, false, false, false);

  

}
function check_all() {
  console.log('test');
  $('#sampleTable').dataTable().fnFilterClear();
  $('#checkbox1').prop('checked','');
}


function showCheck($id) {
   $('.dom_check1').html('');
    $('.dom_check2').html('');
  $.ajax({
    url: '<?php echo base_url() ?>Donhang/showCheck',
    type: 'post',
    dataType: 'json',
    data: {id: $id},
  })
  .done(function(data) {
    $('.dom_check1').html(data.table_detail);
    $('.dom_check2').html(data.lazada_detail);
    $('#showCheck').modal('show');
  });
  
}
</script>