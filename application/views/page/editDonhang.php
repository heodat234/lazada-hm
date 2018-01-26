
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
            <form class="form-horizontal bucket-form" enctype="multipart/form-data"  id="add-form" method="post" action="<?php echo base_url(); ?>updateDonhang">
              <div class="form-group">
                <label class="col-sm-3 control-label">Mã đơn hàng</label>
                <div class="col-sm-6">
                     <input type="text" name="id_bill" id="id_donhang" class="form-control" placeholder="Nhập mã đơn hàng" required="" value="<?php echo isset($bill_master[0]['id_bill'])? $bill_master[0]['id_bill']:'';?>">
                </div>
              </div>
              <div class="form-group">
                  <label class="col-sm-3 control-label">Loại đơn hàng</label>
                  <div class="col-sm-6">
                       <select class="form-control" name="type_bill">
                       	 <option selected="" hidden="" value="<?php echo isset($bill_master[0]['type_bill'])? $bill_master[0]['type_bill']:'';?>"><?php echo isset($bill_master[0]['type_bill'])? $bill_master[0]['type_bill']:'';?></option>
                         <option value="Hàng Lazada">Hàng Lazada</option>
                         <option value="Hàng Shopee">Hàng Shopee</option>
                         <option value="Hàng bỏ sỉ">Hàng bỏ sỉ</option>
                         <option value="Hàng bán lẻ">Hàng bán lẻ</option>
                       </select>
                  </div>
              </div>
              
              <div class="form-group">
                <label class="col-sm-3 control-label">Trạng thái</label>
                <div class="col-sm-6">
                     <select class="form-control" name="bill_status">
                     	<option selected="" hidden="" value="<?php echo isset($bill_master[0]['bill_status'])? $bill_master[0]['bill_status']:'';?>"><?php echo isset($bill_master[0]['bill_status'])? $bill_master[0]['bill_status']:'';?></option>
                       <option value="Đang giao hàng">Đang giao hàng</option>
                       <option value="Đã giao hàng">Đã giao hàng</option>
                       <option value="Trả lại">Trả lại</option>
                       <option value="Đã nhận hàng trả">Đã nhận hàng trả</option>
                     </select>
                </div>
              </div>
              <div class="form-group">
                  <label class="col-sm-3 control-label">P.T Thanh toán</label>
                  <div class="col-sm-6">
                       <select class="form-control" name="payment_method">
                       	 <option selected="" hidden="" value="<?php echo isset($bill_master[0]['payment_method'])? $bill_master[0]['payment_method']:'';?>"><?php echo isset($bill_master[0]['payment_method'])? $bill_master[0]['payment_method']:'';?></option>
                         <option value="CashOnDelivery">CashOnDelivery</option>
                         <option value="Cybersource">Cybersource</option>
                         <option value="VN123Pay">VN123Pay</option>
                       </select>
                  </div>
              </div>
              <div class="form-group">
                  <label class="col-sm-3 control-label">Trạng thái Thanh toán</label>
                  <div class="col-sm-6">
                       <select class="form-control" name="payment_status">
                       	 <option selected="" hidden="" value="<?php echo isset($bill_master[0]['payment_status'])? $bill_master[0]['payment_status']:'';?>"><?php echo isset($bill_master[0]['payment_status'])? $bill_master[0]['payment_status']:'';?></option>
                         <option value="Chờ thanh toán">Chờ thanh toán</option>
                         <option value="Đã thanh toán">Đã thanh toán</option>
                       </select>
                  </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Ngày đặt hàng</label>
                <div class="col-sm-6">
                     <input type="date" name="order_day" class="form-control" required="" value="<?php echo isset($bill_master[0]['order_day'])? date("Y-m-d", strtotime($bill_master[0]['order_day'])):'';?>">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Ngày giao hàng</label>
                <div class="col-sm-6">
                     <input type="date" name="deliv_day"  class="form-control" required="" value="<?php echo isset($bill_master[0]['deliv_day'])? date("Y-m-d", strtotime($bill_master[0]['deliv_day'])):'';?>">
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
              <div class="form-group">
                  <label class="col-sm-3 control-label">Thông tin đơn hàng</label>
                  <div class="col-sm-6">
                    <ul class="nav nav-tabs">
                    	<?php 
                    		if (isset($bill_detail) && !empty($bill_detail)) {
                    			for ($i=0; $i < count($bill_detail); $i++) { 
                    	?>
                        <li><a href="#contact_<?php echo($i);?>" data-toggle="tab"><?php echo "S.phẩm ".($i+1);?> </a><span class="glyphicon glyphicon-remove remove-tab"></span></li>
                        <?php }} ?>
                        <li><a href="#" class="add-contact" data-toggle="tab"><span class="glyphicon glyphicon-plus"></span> Thêm</a></li>
                    </ul>
                    <div class="tab-content">
                    	<?php 
                    		if (isset($bill_detail) && !empty($bill_detail)) {
                    			for ($i=0; $i < count($bill_detail); $i++) { 
                    	?>
                        <div class="tab-pane" id="contact_<?php echo($i);?>">
                          <h1><?php echo "Sản phẩm ".($i+1);?></h1>
                          <input type="hidden" name="product[<?php echo ($i+1)?>]['id_bill_detail']" value="<?php echo $bill_detail[$i]['id'];?>">
                          <div class="form-group">
                            <div class="col-sm-9">
                              <input type="text" list="product-data-list" id="decalpriceform-decaltype" class="form-control" name="product[<?php echo ($i+1)?>][id_sanpham]" required="" aria-required="true" value="<?php echo $bill_detail[$i]['id_product'];?>">
                            </div>
                            <span>*Sản phẩm</span>
                          </div>
                          <div class="form-group">
                            <div class="col-sm-9">
                                 <input type="text" name="product[<?php echo ($i+1)?>][qty]" value="<?php echo $bill_detail[$i]['qty'];?>" class="form-control so" >
                            </div>
                            <span>*Số lượng</span>
                          </div>
                          <div class="form-group">
                            <div class="col-sm-9">
                                 <input type="text" name="product[<?php echo ($i+1)?>][sales_deliver]" value="<?php echo $bill_detail[$i]['price'];?>" class="form-control so" >
                            </div>
                            <span>*Giá bán</span>
                          </div>
                          <div class="form-group">
                            <div class="col-sm-9">
                                 <input type="text" name="product[<?php echo ($i+1)?>][phi_co_dinh]" value="<?php echo $bill_detail[$i]['cost'];?>" class="form-control so" >
                            </div>
                            <span>*Phí cố định</span>
                          </div>
                          <div class="form-group">
                            <div class="col-sm-9">
                                 <input type="text" name="product[<?php echo ($i+1)?>][phi_khac]" value="<?php echo $bill_detail[$i]['other_cost'];?>" class="form-control so" >
                            </div>
                            <span>*Phí khác</span>
                          </div>
                          <div class="form-group">
                            <div class="col-sm-9">
                                 <input type="text" name="product[<?php echo ($i+1)?>][phi_gtgt]" value="<?php echo $bill_detail[$i]['tax_gtgt'];?>" class="form-control so" >
                            </div>
                            <span>*Phí GTGT</span>
                          </div>
                          <div class="form-group">
                            <div class="col-sm-9">
                                 <input type="text" name="product[<?php echo ($i+1)?>][khoan_wht]" value="<?php echo $bill_detail[$i]['acc_wht'];?>" class="form-control so" >
                            </div>
                            <span>*Khoản WHT</span>
                          </div>
                          <div class="form-group">
                            <div class="col-sm-9">
                                 <input type="text" name="product[<?php echo ($i+1)?>][khoan_thanh_toan]" value="<?php echo $bill_detail[$i]['acc_payment'];?>" class="form-control so" >
                            </div>
                            <span>*Khoản thanh toán</span>
                          </div>
                        </div>
                        <?php }} ?>
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
      $('form#add-form').submit();
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
        $(".nav-tabs >li").children('a').first().click();
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