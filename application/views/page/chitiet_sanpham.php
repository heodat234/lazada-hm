<div>
  <div class="content-wrapper">
    <h1>Sản phẩm</h1>
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
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-boder">
            <h3 class="box-title">Danh sách nhập kho sản phẩm</h3>
            <h3 class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool thuphong" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </h3>
          </div>
          <div class="animate_1">
            <div class="box-body no-padding-bottom">
            <table class="table table-hover table-bordered table-responsive" id="sampleTable">
              <thead>
                <tr>
                  <th class="col-data-table-0-2"></th>
                  <th class="col-data-table-2-3">Giá nhập (VNĐ)</th>
                  <th class="col-data-table-2-6">Số lượng nhập</th>
                  <th class="col-data-table-1-7">Ngày nhập </th>
                  <!-- <th class="col-data-table-0-7">Sửa</th> -->
                  <!-- <th class="col-data-table-0-7">Chi tiết nhập kho</th> -->
                </tr>
              </thead>
              <tbody>
                <?php foreach ($import as $row): ?>
                    <tr id="row_<?php echo $row['id_product'] ?>">
                      <td></td>
                      <td><?php echo number_format($row['price']) ?></td>
                      <td><?php echo number_format($row['qty']) ?></td>
                      <td><?php echo date('d-m-Y H:i:s',strtotime($row['created_at'])) ?></td>
                      <!-- <td>
                        <button class="btn btn-info btn-flat" data-toggle="modal" data-target="#edit" data-id='<?php echo $row['id_product'] ?>' data-name='<?php echo $row['name'] ?>' ><i class="fa fa-lg fa-pencil"></i></button>
                      </td>
                      <td>
                        <a class="btn btn-success btn-flat" href=""><i class="fa fa-lg fa-eye"></i></a>
                      </td> -->
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

<!-- modal thêm san pham moi -->
<div class="modal fade" id="addSP" data-backdrop='static'>
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
               <div class="col-xs-12 col-sm-12 col-md-12">
                  <div class="form-group">
                     <div><b>Mã sản phẩm</b></div>
                     <div class="input-group">
                        <div class="input-group-addon iga2">
                           <span class="glyphicon glyphicon-flag"></span>
                        </div>
                        <input type="text" class="form-control" name="id_sanpham" >
                     </div>
                     <div class="alert alert-danger hide"></div>
                  </div>
                  <div class="form-group">
                     <div><b>Tên sản phẩm</b></div>
                     <div class="input-group">
                        <div class="input-group-addon iga2">
                           <span class="glyphicon glyphicon-pencil"></span>
                        </div>
                        <input type="text" class="form-control" name="ten_sanpham" >
                     </div>
                  </div>
                  
               </div>
            </div>
         </div>
      </div>

      <div class="modal-footer">
         <div class="form-group">
            <button type="button" class="btn btn-sm btn-info"  id="btn-add"> Lưu <span class="glyphicon glyphicon-saved"></span></button>
            <button type="button" data-dismiss="modal" class="btn btn-sm btn-default"> Cancel <span class="glyphicon glyphicon-remove"></span></button>
         </div>
      </div>
      </form>
    </div>
  </div>
</div>



<!-- edit form -->
<div class="modal fade" id="edit" data-backdrop='static'>
  <div class="modal-dialog">
   <div class="modal-content">
      <div class="modal-header">
         <button type="button" class="close" data-dismiss='modal' aria-hidden="true"><span class="glyphicon glyphicon-remove"></span></button>
         <h4 class="modal-title" style="font-size: 20px; padding: 12px;">Chỉnh sửa sản phẩm</h4>
      </div>
      <form method="post" id="edit-form" enctype="multipart/form-data">
      <div class="modal-body">
         <div class="container-fluid">
            <div class="row">
               <div class="col-xs-12 col-sm-12 col-md-12">
                  <div class="form-group">
                     <div><b>Mã sản phẩm</b></div>
                     <div class="input-group">
                        <div class="input-group-addon iga2">
                           <span class="glyphicon glyphicon-folder-open"></span>
                        </div>
                        <input type="text" class="form-control" readonly="" name="id_sanpham" >
                     </div>
                     <div class="alert alert-danger hide"></div>
                  </div>
                  <div class="form-group">
                     <div><b>Tên sản phẩm</b></div>
                     <div class="input-group">
                        <div class="input-group-addon iga2">
                           <span class="glyphicon glyphicon-folder-open"></span>
                        </div>
                        <input type="text" class="form-control" name="ten_sanpham" >
                     </div>
                  </div>
                  
               </div>
            </div>
         </div>
      </div>

      <div class="modal-footer">
         <div class="form-group">
            <button type="button" class="btn btn-sm btn-info"  id="btn-edit"> Save <span class="glyphicon glyphicon-saved"></span></button>
            <button type="button" data-dismiss="modal" class="btn btn-sm btn-default"> Cancel <span class="glyphicon glyphicon-remove"></span></button>
         </div>
      </div>
      </form>
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

  //gửi điều kiện lọc
  $('#btn-filter').click(function(event) {
    $('#filter-form').submit();
  });

  $(document).ready(function() {
    //định dạng tiền tệ cho số
    $('.so').on('input', function(e){
    if ($(this).val() == '') {
              $(this).val(0);
        }        
    $(this).val(formatCurrency(this.value.replace(/[,VNĐ]/g,'')));
    }).on('keypress',function(e){
        if ($(this).val() == 0)
          $(this).val('');
        if(!$.isNumeric(String.fromCharCode(e.which))) e.preventDefault();
    }).on('paste', function(e){    
        var cb = e.originalEvent.clipboardData || window.clipboardData;      
        if(!$.isNumeric(cb.getData('text'))) e.preventDefault();
    });
    function formatCurrency(number){
        var n = number.split('').reverse().join("");
        var n2 = n.replace(/\d\d\d(?!$)/g, "$&,");    
        return  n2.split('').reverse().join('');
    }
  });
  
  //mở form chỉnh sửa
  $('#edit').on('show.bs.modal', function(e) {
  //get data-id attribute of the clicked element
  var id_sp = $(e.relatedTarget).data('id');
  var ten_sp = $(e.relatedTarget).data('name');
  //populate the textbox
  $(e.currentTarget).find('input[name="id_sanpham"]').val(id_sp);
  $(e.currentTarget).find('input[name="ten_sanpham"]').val(ten_sp);

  $('#btn-edit').on('click',function(){
  var route="<?= base_url()?>editSP";
  var frm = new FormData($('form#edit-form')[0]);
  
      $.ajax({
        url:route,
        processData:false,
        contentType:false,
        type:'post',
        data:frm,
        success:function() {
          alert('Sửa sản phẩm thành công.');
            window.location.reload();          
        }
      });
  });
  
});
//mở form thêm mới
$('#btn-add').on('click',function(){
  var route="<?= base_url()?>insertSP";
  var frm = new FormData($('form#add-form')[0]);
  var id = frm.get('id_sanpham');
  var name = frm.get('ten_sanpham');
  
      $.ajax({
        url:route,
        processData:false,
        contentType:false,
        type:'post',
        dataType:'json',
        data:frm,
        success:function(data) {
          if (data['mess'] == 'error') {
            $('.alert-danger').html('Mã sản phẩm đã tồn tại.');
            $('.alert-danger').removeClass('hide');
          }else{
            var row = [];
              row.push('<td></td>');
              row.push('<td>'+id+'</td>');
              row.push('<td>'+name+'</td>');
              row.push('<td>'+data['ngay_tao'] +'</td>');
              row.push('<td><button class="btn btn-info btn-flat" data-toggle="modal" data-target="#edit" data-id='+id+' data-name='+name+' data-gianhap='+gia+' data-soluong='+so_luong+'><i class="fa fa-lg fa-pencil"></i></button></td>');
              
              var rowIndex = $('#sampleTable').dataTable().fnAddData(row);
              var idrow =   $('#sampleTable').dataTable().fnGetNodes(rowIndex);
              $(idrow).attr('id','row_'+id);
              $(idrow).attr('class','load');
              $('.alert-danger').addClass('hide');
              $('#addSP').modal('hide');
              alert('Thêm sản phẩm thành công.');
          }
          
        }
      });
  });

</script>