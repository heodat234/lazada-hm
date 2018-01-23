
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
                <label class="col-sm-3 control-label">Mã đơn hàng</label>
                <div class="col-sm-6">
                     <input type="text" name="id_donhang" id="id_donhang" class="form-control" placeholder="Nhập mã đơn hàng" required="">
                </div>
              </div>
              <div class="form-group">
                  <label class="col-sm-3 control-label">Mã món hàng</label>
                  <div class="col-sm-6">
                       <input type="text" name="id_monhang" class="form-control" placeholder="Mã món hàng" >
                  </div>
              </div>
              <div class="form-group">
                  <label class="col-sm-3 control-label">Chọn sản phẩm</label>
                  <div class="col-sm-6">
                      <select id="decalpriceform-decaltype" class="form-control" name="id_sanpham" required="" aria-required="true">
                      <option selected hidden disabled value="">Chọn sản phẩm</option>
                      <?php
                      if(!$sanpham) echo "<option value='0'>Empty</option>";
                      else{
                        foreach ($sanpham as $sp) {
                          echo "<option value='".$sp['id_sanpham']."' >".$sp['ten_sanpham']."</option>";
                        }
                      }
                      ?>
                      </select>
                  </div>
              </div>
              <div class="form-group">
                  <label class="col-sm-3 control-label">Tên khách hàng</label>
                  <div class="col-sm-6">
                       <input type="text" name="ten_khachhang" class="form-control" placeholder="Tên khách hàng" >
                  </div>
              </div>
              <div class="form-group">
                  <div class="col-md-3 control-label">Số điện thoại</div>
                  <div class="col-md-6">
                     <input type="tel" pattern="[0-9]{10,11}"  title="10-11 chữ số." name="phone" class="form-control" placeholder="Số điện thoại" >
                  </div>
              </div>                                
              <div class="form-group">
                  <label class="col-sm-3 control-label">Thông tin đơn hàng</label>
                  <div class="col-sm-6">
                    <ul id="tabs" class="nav nav-tabs form-group" data-tabs="tabs">
                        <li class="active"><a href="#red" data-toggle="tab">Sp 1 <span class="glyphicon glyphicon-remove remove-tab" onclick="removeTab()"></span></a></li>
                        <li><a href="#orange" data-toggle="tab">Sp 2 <span class="glyphicon glyphicon-remove remove-tab" onclick="removeTab()"></span></a></li>
                        <li class="add-tab"><a onclick="newTab()" data-toggle="tab"><span class="glyphicon glyphicon-plus"></span></a></li>
                    </ul>
                    <div id="my-tab-content" class="tab-content form-group">
                        <div class="tab-pane active" id="red">
                          <h1>Name</h1>
                          <div class="form-group">
                            <div class="col-sm-9">
                                 <select class="form-control" name="status">
                                   <option value="delivered">delivered</option>
                                 </select>
                            </div>
                            <span>*Trạng thái</span>
                          </div>
                          <div class="form-group">
                            <div class="col-sm-9">
                                 <input type="text" name="ma_van_don"  class="form-control" >
                            </div>
                            <span>*Mã vận đơn</span>
                          </div>
                          <div class="form-group">
                              <div class="col-sm-9">
                                   <select class="form-control" name="phuongthuc_thanhtoan">
                                     <option value="CashOnDelivery">CashOnDelivery</option>
                                     <option value="Cybersource">Cybersource</option>
                                     <option value="VN123Pay">VN123Pay</option>
                                   </select>
                              </div>
                              <span>*Phương thức thanh toán</span>
                          </div>
                          <div class="form-group">
                            <div class="col-sm-9">
                                 <input type="text" name="sales_deliver" value="0" class="form-control so" >
                            </div>
                            <span>*Giá bán</span>
                          </div>
                          <div class="form-group">
                            <div class="col-sm-9">
                                 <input type="text" name="tro_gia" value="0" class="form-control so" >
                            </div>
                            <span>*Trợ giá</span>
                          </div>
                          <div class="form-group">
                            <div class="col-sm-9">
                                 <input type="text" name="phi_co_dinh" value="0" class="form-control so" >
                            </div>
                            <span>*Phí cố định</span>
                          </div>
                          <div class="form-group">
                            <div class="col-sm-9">
                                 <input type="text" name="phi_vanchuyen" value="0" class="form-control so" >
                            </div>
                            <span>*Phí vận chuyển</span>
                          </div>
                        </div>
                        <div class="tab-pane" id="orange">
                          <h1>Orange</h1>
                          <div class="form-group">
                            <div class="col-sm-9">
                                 <select class="form-control" name="status">
                                   <option value="delivered">delivered</option>
                                 </select>
                            </div>
                            <span>*Trạng thái</span>
                          </div>
                          <div class="form-group">
                            <div class="col-sm-9">
                                 <input type="text" name="ma_van_don"  class="form-control" >
                            </div>
                            <span>*Mã vận đơn</span>
                          </div>
                          <div class="form-group">
                              <div class="col-sm-9">
                                   <select class="form-control" name="phuongthuc_thanhtoan">
                                     <option value="CashOnDelivery">CashOnDelivery</option>
                                     <option value="Cybersource">Cybersource</option>
                                     <option value="VN123Pay">VN123Pay</option>
                                   </select>
                              </div>
                              <span>*Phương thức thanh toán</span>
                          </div>
                          <div class="form-group">
                            <div class="col-sm-9">
                                 <input type="text" name="sales_deliver" value="0" class="form-control so" >
                            </div>
                            <span>*Giá bán</span>
                          </div>
                          <div class="form-group">
                            <div class="col-sm-9">
                                 <input type="text" name="tro_gia" value="0" class="form-control so" >
                            </div>
                            <span>*Trợ giá</span>
                          </div>
                          <div class="form-group">
                            <div class="col-sm-9">
                                 <input type="text" name="phi_co_dinh" value="0" class="form-control so" >
                            </div>
                            <span>*Phí cố định</span>
                          </div>
                          <div class="form-group">
                            <div class="col-sm-9">
                                 <input type="text" name="phi_vanchuyen" value="0" class="form-control so" >
                            </div>
                            <span>*Phí vận chuyển</span>
                          </div>
                        </div>
                        <div class="tab-pane" id="yellow">
                          <h1>Yellow</h1>
                          <div class="form-group">
                            <div class="col-sm-9">
                                 <select class="form-control" name="status">
                                   <option value="delivered">delivered</option>
                                 </select>
                            </div>
                            <span>*Trạng thái</span>
                          </div>
                          <div class="form-group">
                            <div class="col-sm-9">
                                 <input type="text" name="ma_van_don"  class="form-control" >
                            </div>
                            <span>*Mã vận đơn</span>
                          </div>
                          <div class="form-group">
                              <div class="col-sm-9">
                                   <select class="form-control" name="phuongthuc_thanhtoan">
                                     <option value="CashOnDelivery">CashOnDelivery</option>
                                     <option value="Cybersource">Cybersource</option>
                                     <option value="VN123Pay">VN123Pay</option>
                                   </select>
                              </div>
                              <span>*Phương thức thanh toán</span>
                          </div>
                          <div class="form-group">
                            <div class="col-sm-9">
                                 <input type="text" name="sales_deliver" value="0" class="form-control so" >
                            </div>
                            <span>*Giá bán</span>
                          </div>
                          <div class="form-group">
                            <div class="col-sm-9">
                                 <input type="text" name="tro_gia" value="0" class="form-control so" >
                            </div>
                            <span>*Trợ giá</span>
                          </div>
                          <div class="form-group">
                            <div class="col-sm-9">
                                 <input type="text" name="phi_co_dinh" value="0" class="form-control so" >
                            </div>
                            <span>*Phí cố định</span>
                          </div>
                          <div class="form-group">
                            <div class="col-sm-9">
                                 <input type="text" name="phi_vanchuyen" value="0" class="form-control so" >
                            </div>
                            <span>*Phí vận chuyển</span>
                          </div>
                        </div>
                    </div>
                  </div>
              </div>
              <div id="donhang" style="display: none;">
                
                
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
// function newTab(){
//   var current = $('#tabs').children('li').length;
//   $('#tabs').find(' > li:nth-last-child(1)').before('<li id="tab'+current+'"><a href="#tab'+current+'" data-toggle="tab">Sp '+current+' <span class="glyphicon glyphicon-remove remove-tab" onclick="removeTab('+current+')"></a></li>');
//   $('#my-tab-content').find(' > div:nth-last-child(1)').after('<div class="tab-pane" id="tab'+current+'"><h1>Name '+current+'</h1><div class="form-group"><div class="col-sm-9"><select class="form-control" name="status"><option value="delivered">delivered</option></select></div><span>*Trạng thái</span></div><div class="form-group"><div class="col-sm-9"><input type="text" name="ma_van_don"  class="form-control" ></div><span>*Mã vận đơn</span></div><div class="form-group"><div class="col-sm-9"><select class="form-control" name="phuongthuc_thanhtoan"><option value="CashOnDelivery">CashOnDelivery</option><option value="Cybersource">Cybersource</option><option value="VN123Pay">VN123Pay</option></select></div><span>*Phương thức thanh toán</span></div><div class="form-group"><div class="col-sm-9"><input type="text" name="sales_deliver" value="0" class="form-control so" ></div><span>*Giá bán</span></div><div class="form-group"><div class="col-sm-9"><input type="text" name="tro_gia" value="0" class="form-control so" ></div><span>*Trợ giá</span></div><div class="form-group"><div class="col-sm-9"><input type="text" name="phi_co_dinh" value="0" class="form-control so" ></div><span>*Phí cố định</span></div><div class="form-group"><div class="col-sm-9"><input type="text" name="phi_vanchuyen" value="0" class="form-control so" ></div><span>*Phí vận chuyển</span></div></div>');
// }
// function removeTab(id){
//   var elem = document.getElementById('tab'+id);
//   elem.parentNode.removeChild(elem);
// }
$(".nav-tabs").on("click", "a", function(e){
      e.preventDefault();
      $(this).tab('show');
    })
    .on("click", "span", function () {
        var anchor = $(this).siblings('a');
        $(anchor.attr('href')).remove();
        $(this).parent().remove();
        $(".nav-tabs li").children('a').first().click();
    });

    $('.add-contact').click(function(e) {
        e.preventDefault();
        var id = $(".nav-tabs").children().length; //think about it ;)
        $(this).closest('li').before('<li><a href="#contact_'+id+'">New Tab</a><span>x</span></li>');         
        $('.tab-content').append('<div class="tab-pane" id="contact_'+id+'">Contact Form: New Contact '+id+'</div>');
});
</script>