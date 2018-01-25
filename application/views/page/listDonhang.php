<div>
  <div class="content-wrapper">
    <h1>Đơn hàng</h1>
    <div class="row">
      <div class="col-md-12">
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
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label>Từ ngày</label>
                      <?php if (isset($start)) {
                        echo '<input type="date" name="from" class="form-control" value="'.$start.'">';
                      } else{
                        echo '<input type="date" name="from" class="form-control" id="date-from-picker">';
                      } ?>
                    </div>
                  </div>
                  <div class="col-sm-3">
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
                  <button class="btn_margin_bottom btn btn-success btn_quick_filter" data-toggle="modal" data-target="#addDonhang"><i class="fa fa-plus"></i> Thêm đơn hàng mới</button>
                </div>
              </div>
            </div>
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
              <!-- <div class="col-sm-3">
                <h5>Số lượng đơn hàng: <strong class="label label-info"><?php echo number_format($thongke[0]['qty']) ?></strong></h5>
              </div>
              <div class="col-sm-3">
                <h5>Doanh thu: <strong class="label label-success"><?php echo number_format($thongke[0]['doanhthu']) ?></strong></h5>
              </div>
              <div class="col-sm-3">
                <h5>Chi phí: <strong class="label label-warning"><?php echo number_format($thongke[0]['chiphi']) ?></strong></h5>
              </div>
              <div class="col-sm-3">
                <h5>Lợi nhuận: <strong class="label label-danger"><?php echo number_format($thongke[0]['doanhthu'] - $thongke[0]['chiphi']) ?></strong></h5>
              </div> -->
            </div>
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
                    <th class="col-data-table-1-7">Phương thức thanh toán</th>
                    <th class="col-data-table-1-7">Tình trạng thanh toán</th>
                    <th class="col-data-table-0-7">Thao tác</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($donhang as $row): ?>
                      <tr>
                        <td></td>
                        <td><?php echo $row['id_bill'] ?></td>
                        <td><?php echo $row['type_bill'] ?></td>
                        <td><?php echo $row['bill_status'] ?></td>
                        <td><?php echo date('d-m-Y H:i:s',strtotime($row['order_day'])) ?></td>
                         <td><?php echo date('d-m-Y H:i:s',strtotime($row['deliv_day'])) ?></td>
                        <td><?php echo $row['payment_method'] ?></td>
                        <td><?php echo $row['payment_status'] ?></td>
                        <td><!-- <button class="btn btn-primary btn-flat" data-toggle="modal" data-id='<?php echo $row['id_bill'];?>' data-target="#addPrice"><i class="fa fa-lg fa-edit"></i>Thêm giá bán</button> --></td>
                      </tr>                    
                  <?php endforeach;?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
<!-- modal thêm don hang -->
<div class="modal fade" id="addDonhang" data-backdrop='static'>
  <div class="modal-dialog">
   <div class="modal-content">
      <div class="modal-header">
         <button type="button" class="close" data-dismiss='modal' aria-hidden="true"><span class="glyphicon glyphicon-remove"></span></button>
         <h4 class="modal-title" style="font-size: 20px; padding: 12px;">Thêm các đơn hàng mới</h4>
      </div>
      <form method="post" id="add-form" enctype="multipart/form-data">
      <div class="modal-body">
         <div class="container-fluid">
            <div class="row">
               <div class="col-xs-6 col-sm-6 col-md-6">
                  <div class="form-group">
                     <div><b>Thêm bằng tay</b></div>
                     <div class="input-group">
                      <a class="btn_margin_bottom btn btn-info btn_quick_filter"  href="<?php echo base_url() ?>taodonhang"><i class="fa fa-plus"></i> Thêm bằng nhập form</a> 
                     </div>
                  </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                  <div class="form-group">
                     <div><b>Thêm bằng file Excel</b></div>
                     <div class="input-group">
                      <button type="button" class="btn_margin_bottom btn btn-success btn_quick_filter" onclick="addFile()"><i class="fa fa-plus"></i> Thêm bằng file Excel</button> 
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>

      <div class="modal-footer">
         <div class="form-group">
            <button type="button" data-dismiss="modal" class="btn btn-sm btn-default"> Cancel <span class="glyphicon glyphicon-remove"></span></button>
         </div>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- add file -->
<div class="modal fade" id="addFile" data-backdrop='static'>
  <div class="modal-dialog">
   <div class="modal-content">
      <div class="modal-header">
         <button type="button" class="close" data-dismiss='modal' aria-hidden="true"><span class="glyphicon glyphicon-remove"></span></button>
         <h4 class="modal-title" style="font-size: 20px; padding: 12px;">Thêm file excel</h4>
      </div>
      <form method="post" id="add-form" enctype="multipart/form-data" action="<?php echo base_url() ?>addExcel">
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
                        <input type="file" class="form-control" name="file" required="">
                        
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
            <button type="submit" class="btn btn-sm btn-info"  id="btn-add"> Save <span class="glyphicon glyphicon-saved"></span></button>

            <button type="button" data-dismiss="modal" class="btn btn-sm btn-default"> Cancel <span class="glyphicon glyphicon-remove"></span></button>
         </div>
      </div>
      </form>
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
  function addFile() {
    $('#addDonhang').modal('hide');
    $('#addFile').modal('show');
  }

  $('#btn-add').click( function(e) {
           //kiem tra trinh duyet co ho tro File API
            if (window.File && window.FileReader && window.FileList && window.Blob)
            {
              // lay dung luong va kieu file tu the input file
                var ftype = $('#i_file')[0].files[0].type;
               // .alert( ftype);
               switch(ftype)
                {
                    case 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet':
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
</script>