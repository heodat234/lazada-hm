<div>
  <div class="content-wrapper">
    <h1>Đơn hàng Lazada</h1>
    <!-- <div class="row">
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
              <form method="post" action="<?php echo base_url() ?>locSanpham" id="filter-form">
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
                  <button class="btn_margin_bottom btn btn-success btn_quick_filter" data-toggle="modal" data-target="#addSP"><i class="fa fa-plus"></i> Thêm sản phẩm mới</button> 
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>  
    </div> -->

    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-boder">
            <h3 class="box-title">Danh sách sản phẩm đơn <?php echo $lazada[0]['id_donhang'] ?></h3>
            <h3 class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool thuphong" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </h3>
            <div class="row" style="margin-top: 10px;">
              <div class="col-sm-3">
                <h5>Số lượng sản phẩm: <strong class="label label-info"><?php echo number_format(count($lazada)) ?></strong></h5>
              </div>
              <div class="col-sm-3">
                <h5>Tổng giá tiền: <strong class="label label-success"><?php echo number_format($tong) ?></strong></h5>
              </div>
            </div>
          </div>
          <div class="animate_1">
            <div class="box-body no-padding-bottom">
            <table class="table table-hover table-bordered table-responsive" id="sampleTable">
              <thead>
                <tr>
                  <th class="col-data-table-0-2"></th>
                  <th class="col-data-table-1-3">Mã đơn hàng</th>
                  <th class="col-data-table-1-3">Mã sản phẩm</th>
                  <th class="col-data-table-1-6">Tên sản phẩm</th>
                  <th class="col-data-table-0-7">Ngày nhập </th>
                  <th class="col-data-table-1-7">Trạng thái</th>
                  <th class="col-data-table-1-3">Số lượng</th>
                  <th class="col-data-table-1-3">Giá</th>
                  <th class="col-data-table-1-3">Phương thức thanh toán</th>
                  <th class="col-data-table-1-3">Phí cố định</th>
                  <th class="col-data-table-1-3">Tổng phí</th>
                  
                </tr>
              </thead>
              <tbody>
                <?php foreach ($lazada as $row): ?>
                    <tr >
                      <td></td>
                      <td><?php echo $row['id_donhang'] ?></td>
                      <td><?php echo $row['id_sanpham'] ?></td>
                      <td><?php echo $row['item_name'] ?></td>
                      <td><?php echo date('d-m-Y H:i:s',strtotime($row['created_at'])) ?></td>
                      <td><?php echo $row['status'] ?></td>
                      <td><?php echo number_format($row['qty']) ?></td>
                      <td><?php echo number_format($row['price']) ?></td>
                      <td><?php echo $row['phuongthuc_thanhtoan'] ?></td>
                      <td><?php echo number_format($row['phi']) ?></td>
                      <td><?php echo number_format($row['tongphi']) ?></td>
                      
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


<script type="text/javascript">
  //thu gọn, mở rộng table
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

  //set ngày đầu tháng, cuối tháng
  var date = new Date(), y = date.getFullYear(), m = date.getMonth();
  var fd = new Date(y, m, 2);
  var ld = new Date(y, m + 1, 1);
  if ($('#date-from-picker').length >0 && $('#date-to-picker').length >0) {
    document.querySelector("#date-from-picker").valueAsDate = fd;
    document.querySelector("#date-to-picker").valueAsDate = ld;
  }

 

</script>