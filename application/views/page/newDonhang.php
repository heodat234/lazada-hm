
<div>
  <div class="content-wrapper">
  <h1>Thêm Đơn Hàng Mới</h1>
  <br>   
  <div class="row">
    <div class="col-lg-12">
      <div class="box">
        <div class="box-header with-boder">
          <h3 class="box-title">Thêm đơn hàng mới</h3>
          <h3 class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool accordion" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </h3>
        </div>
        <div class="animate">
          <div class="box-body no-padding-bottom">
            <div class="alert alert-danger hide"></div>
            <form class="form-horizontal bucket-form" enctype="multipart/form-data"  id="add-form" method="post" action="<?php echo base_url(); ?>insertDonhang">
              <div class="form-group">
                <label class="col-sm-2 control-label">Mã đơn hàng</label>
                <div class="col-sm-4">
                     <input type="text" name="id_bill" id="id_donhang" class="form-control" placeholder="Nhập mã đơn hàng" required="">
                </div>
                <label class="col-sm-2 control-label">P.T Thanh toán</label>
                  <div class="col-sm-4">
                       <select class="form-control" name="payment_method">
                         <option value="CashOnDelivery">CashOnDelivery</option>
                         <option value="Cybersource">Cybersource</option>
                         <option value="VN123Pay">VN123Pay</option>
                       </select>
                  </div>
              </div>
              <div class="form-group">
                  <label class="col-sm-2 control-label">Loại đơn hàng</label>
                  <div class="col-sm-4">
                       <select class="form-control" name="type_bill">
                         <option value="Hàng Lazada">Hàng Lazada</option>
                         <option value="Hàng Shopee">Hàng Shopee</option>
                         <option value="Hàng bỏ sỉ">Hàng bỏ sỉ</option>
                         <option value="Hàng bán lẻ">Hàng bán lẻ</option>
                       </select>
                  </div>
                  <label class="col-sm-2 control-label">Ngày đặt hàng</label>
                <div class="col-sm-4">
                     <input type="date" name="order_day" class="form-control today" required="">
                </div>
              </div>
              
              <div class="form-group">
                <label class="col-sm-2 control-label">Trạng thái</label>
                <div class="col-sm-4">
                     <select class="form-control" name="bill_status">
                       <option value="Đang giao hàng">Đang giao hàng</option>
                       <option value="Đã giao hàng">Đã giao hàng</option>
                       <option value="Trả lại">Trả lại</option>
                       <option value="Đã nhận hàng trả">Đã nhận hàng trả</option>
                     </select>
                </div>
                <label class="col-sm-2 control-label">Ngày giao hàng</label>
                <div class="col-sm-4">
                     <input type="date" name="deliv_day"  class="form-control today" required="">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Trạng thái Thanh toán</label>
                  <div class="col-sm-4">
                       <select class="form-control" name="payment_status">
                         <option value="Chờ thanh toán">Chờ thanh toán</option>
                         <option value="Đã thanh toán">Đã thanh toán</option>
                       </select>
                  </div>
                
              </div>
            
              <div id="product-list" style="display: none;">
                <div class="col-sm-9">
                    <input type="text" list="product-data-list" id="decalpriceform-decaltype" class="form-control" name="id_sanpham" required="" aria-required="true">
                    <datalist id="product-data-list">
                    <?php
                    if(!$sanpham) echo "<option value='0'>Empty</option>";
                    else{
                      foreach ($sanpham as $sp) {
                        echo "<option value='".$sp['id_product']."' >".$sp['name']."</option>";
                      }
                    }
                    ?>
                    </datalist>
                </div>
                <span>*Sản phẩm</span>
              </div>                           
              <!-- <div class="form-group">
                  <label class="col-sm-3 control-label">Thông tin đơn hàng</label>
                  <div class="col-sm-6">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#contact_01" data-toggle="tab">S.phẩm 1 </a><span class="glyphicon glyphicon-remove remove-tab"></span></li>
                        <li><a href="#" class="add-contact" data-toggle="tab"><span class="glyphicon glyphicon-plus"></span> Thêm</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="contact_01">
                          <h1>Sản phẩm 1</h1>
                          <div class="form-group">
                            <div class="col-sm-9">
                              <input type="text" list="product-data-list" id="decalpriceform-decaltype" class="form-control" name="product[1][id_sanpham]" required="" aria-required="true">
                            </div>
                            <span>*Sản phẩm</span>
                          </div>
                          <div class="form-group">
                            <div class="col-sm-9">
                                 <input type="text" name="product[1][qty]" value="0" class="form-control so" >
                            </div>
                            <span>*Số lượng</span>
                          </div>
                          <div class="form-group">
                            <div class="col-sm-9">
                                 <input type="text" name="product[1][sales_deliver]" value="0" class="form-control so" >
                            </div>
                            <span>*Giá bán</span>
                          </div>
                          <div class="form-group">
                            <div class="col-sm-9">
                                 <input type="text" name="product[1][phi_co_dinh]" value="0" class="form-control so" >
                            </div>
                            <span>*Phí cố định</span>
                          </div>
                          <div class="form-group">
                            <div class="col-sm-9">
                                 <input type="text" name="product[1][phi_khac]" value="0" class="form-control so" >
                            </div>
                            <span>*Phí khác</span>
                          </div>
                          <div class="form-group">
                            <div class="col-sm-9">
                                 <input type="text" name="product[1][phi_gtgt]" value="0" class="form-control so" >
                            </div>
                            <span>*Phí GTGT</span>
                          </div>
                          <div class="form-group">
                            <div class="col-sm-9">
                                 <input type="text" name="product[1][khoan_wht]" value="0" class="form-control so" >
                            </div>
                            <span>*Khoản WHT</span>
                          </div>
                          <div class="form-group">
                            <div class="col-sm-9">
                                 <input type="text" name="product[1][khoan_thanh_toan]" value="0" class="form-control so" >
                            </div>
                            <span>*Khoản thanh toán</span>
                          </div>
                        </div>
                    </div>
                  </div>
              </div> -->
              <div id="donhang" style="display: none;">
              </div>
        <div class="panel panel-primary">
        <div class="panel-heading">
            <h4>Danh sách sản phẩm
                <div class="pull-right">
                    <button onclick="addRow('dataTable')" class="btn btn-default btn-custom"><span class="glyphicon glyphicon-plus"></span></button>
                    <button onclick="deleteRow('dataTable')" class="btn btn-default btn-custom"><span class="glyphicon glyphicon-trash"></span></button>
                </div>
            </h4>
        </div>
        <div id="toolbar-admin" class="panel-body">
            <div class="btn-toolbar" role="toolbar" aria-label="admin">
                    <div class="btn-group pull-right" role="group">
                        
                        
                    </div>
                </div>
        </div>
        <!-- <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th class="col-check"></th>
                    <th>Id</th>
                    <th>Hostname</th>
                    <th>IP</th>
                    <th>MAC</th>
                    <th>Status</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <tr class="success">
                    <td class="col-check"><input type="checkbox" class="form-check-input"></td>
                    <td>1</td>
                    <td>ZYX987</td>
                    <td>192.168.1.99</td>
                    <td>AA:BB:11:22:CC:DD</td>
                    <td class="status">Online</td>
                    <td>test</td>
                </tr>
                <tr class="success">
                    <td class="col-check"><input type="checkbox" class="form-check-input"></td>
                    <td>2</td>
                    <td>WVU654</td>
                    <td>192.168.1.98</td>
                    <td>EE:FF:33:44:AB:CD</td>
                    <td class="status">Online</td>
                    <td>test</td>
                </tr>
                <tr class="warning">
                    <td class="col-check"><input type="checkbox" class="form-check-input"></td>
                    <td>3</td>
                    <td>TSR321</td>
                    <td>192.168.1.97</td>
                    <td>EF:12:FE:34:AA:CC</td>
                    <td class="status">Offline</td>
                    <td>test</td>
                </tr>
                <tr class="danger">
                    <td class="col-check"><input type="checkbox" class="form-check-input"></td>
                    <td>4</td>
                    <td>QPO987</td>
                    <td>192.168.1.96</td>
                    <td>FA:91:EB:82:DC:73</td>
                    <td class="status">Out Of Order</td>
                    <td>test</td>
                </tr>
                <tr class="warning">
                    <td class="col-check"><input type="checkbox" class="form-check-input"></td>
                    <td>5</td>
                    <td>NML654</td>
                    <td>192.168.1.95</td>
                    <td>98:AB:76:CD:54:EF</td>
                    <td class="status">Offline</td>
                    <td>test</td>
                </tr>
            </tbody>
        </table> -->
       <div style="overflow: auto;">

          <table id="dataTable" class="table table-striped table-hover" style="margin-bottom: 0;">
                <thead>
                    <tr>
                        <th class="col-check"><input type="checkbox" class="form-check-input" id="check-all"></th>
                        <th>Sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Giá bán</th>
                        <th>Phí cố định</th>
                        <th>Phí khác</th>
                        <th>Phí GTGT</th>
                        <th>Khoản WHT</th>
                        <th>Khoản t.toán</th>
                    </tr>
                </thead>
                  <tbody>
                    <tr class="default">
                        <td class="col-check"><input type="checkbox" class="form-check-input"></td>
                        <td><input list="product-data-list" type="text" class="form-check-input" name="product[0][id_sanpham]" aria-required="true" value="" required=""></td>
                        <td><input type="text" class="form-check-input" name="product[0][qty]" value="0"></td>
                        <td><input type="text" class="form-check-input" name="product[0][sales_deliver]" value="0"></td>
                        <td><input type="text" class="form-check-input" name="product[0][phi_co_dinh]" value="0"></td>
                        <td class="status"><input type="text" class="form-check-input" name="product[0][phi_khac]" value="0"></td>
                        <td><input type="text" class="form-check-input" name="product[0][phi_gtgt]" value="0"></td>
                        <td><input type="text" name="product[0][khoan_wht]" value="0" /></td>
                        <td><input type="text" name="product[0][khoan_thanh_toan]" value="0"/></td>
                    </tr>
                  </tbody>
                    
          </table>
          <button onclick="addRow('dataTable')" class="btn btn-default btn-custom" style="margin-left: 6px; margin-top: 2px;"><span class="glyphicon glyphicon-plus"></span></button>
        </div> 
        
    </div>      
              
              <div class="form-group">
                <div style="margin: 0px 90%;">
                  <button type="button" class="btn btn-sm btn-info saveDH"  id="btn-add"> Lưu <span class="glyphicon glyphicon-saved"></span></button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<script type="text/javascript">
  var x = document.querySelectorAll(".today");
  for (var i = 0; i < x.length; i++) {
    x[i].valueAsDate = new Date();
  }

$("#btnDonhang").on('click', function(event) {
  event.preventDefault();
  var status = $('#statusDonhang').val();
  if (status == 0) {
    $('#donhang').show();
    $('#statusDonhang').val(1);
    $(this).html('<i class="fa fa-angle-up" aria-hidden="true"></i>');
  }else{
    $('#donhang').hide();
    $('#statusDonhang').val(0);
    $(this).html('<i class="fa fa-angle-down" aria-hidden="true"></i>');
  }
});


$("#btnIn").on('click', function(event) {
  event.preventDefault();
  var status = $('#statusIn').val();
  if (status == 0) {
    $('#in').show();
    $('#statusIn').val(1);
    $(this).html('<i class="fa fa-angle-up" aria-hidden="true"></i>');
  }else{
    $('#in').hide();
    $('#statusIn').val(0);
    $(this).html('<i class="fa fa-angle-down" aria-hidden="true"></i>');
  }
  
});
$(document).ready(function() {

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
    function unformatCurrency(number) {
      return n = parseFloat(number.replace(/[^0-9-.]/g, ''));
    }


    $('.saveDH').on('click', function() {
      var id_dh = $('#id_donhang').val();
      $.ajax({
        url: '<?php echo base_url() ?>checkDonhang',
        type: 'POST',
        data: {id: id_dh},
      })
      .done(function(data) {
        console.log(data);
        if (data == '1') {
          $('.alert-danger').html('Mã đơn hàng đã tồn tại.');
          $('.alert-danger').removeClass('hide');
        }else{
          $('.alert-danger').addClass('hide');
          $('form#add-form').submit();
        }
      })
      .fail(function() {
        console.log("error");
      });   
    });
});
$(document).ready(function(){

$(".nav-tabs").on("click", "a", function(e){
      e.preventDefault();
      $(this).tab('show');
    })
    .on("click", "span", function () {
        var anchor = $(this).siblings('a');
        $(anchor.attr('href')).remove();
        $(this).parent().remove();
        if ($(".nav-tabs").children().length>1) {
          $(".nav-tabs >li").children('a').first().click();
        }
    });
  $('.add-contact').click(function(e) {
      e.preventDefault();
      var id = $(".nav-tabs").children().length; //think about it ;)
      var product_list = $('#product-list').html();
      $(this).closest('li').before('<li><a href="#contact_'+id+'">S.phẩm '+id+'</a><span class="glyphicon glyphicon-remove remove-tab"></span></li>');
      $(".tab-content >div").removeClass("active");  
      $('.tab-content').append('<div class="tab-pane active" id="contact_'+id+'"><h1>Sản phẩm '+id+'</h1><div class="form-group">'+product_list.replace('name="id_sanpham"','name="product['+id+'][id_sanpham]"')+'</div><div class="form-group"><div class="col-sm-9"><input type="text" name="product['+id+'][qty]" value="0" class="form-control so" ></div><span>*Số lượng</span></div><div class="form-group"><div class="col-sm-9"><input type="text" name="product['+id+'][sales_deliver]" value="0" class="form-control so" ></div><span>*Giá bán</span></div><div class="form-group"><div class="col-sm-9"><input type="text" name="product['+id+'][phi_co_dinh]" value="0" class="form-control so" ></div><span>*Phí cố định</span></div><div class="form-group"><div class="col-sm-9"><input type="text" name="product['+id+'][phi_khac]" value="0" class="form-control so" ></div><span>*Phí khác</span></div><div class="form-group"><div class="col-sm-9"><input type="text" name="product['+id+'][phi_gtgt]" value="0" class="form-control so" ></div><span>*Phí GTGT</span></div><div class="form-group"><div class="col-sm-9"><input type="text" name="product['+id+'][khoan_wht]" value="0" class="form-control so" ></div><span>*Khoản WHT</span></div><div class="form-group"><div class="col-sm-9"><input type="text" name="product['+id+'][khoan_thanh_toan]" value="0" class="form-control so" ></div><span>*Khoản thanh toán</span></div></div>');
});
});
</script>