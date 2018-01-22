<div>
  <div class="content-wrapper">
    <h1>Bảng tổng quan</h1>
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
            <h2 class="box-title">Doanh thu theo tháng</h2>
            <h3 class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool thuphong" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </h3>
          </div>
          <div class="animate_1">
            <div class="box-body no-padding-bottom" >
              <div id="chart1" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-boder">
            <h2 class="box-title">Lợi nhuận theo tháng</h2>
            <h3 class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool thuphong1" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </h3>
          </div>
          <div class="animate_2">
            <div class="box-body no-padding-bottom" >
              <div id="chart2" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
            </div>
          </div>
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
  $('.thuphong1').on('click',function(event) {
      this.classList.toggle("active");
        if ($('.animate_2').hasClass('tat')) {
                  $('.animate_2').removeClass('tat');
                  $('.animate_2').animate({height:'toggle'},1000);
                  $('.thuphong1').html('<i class="fa fa-minus"></i>');
        } else {
                $('.animate_2').addClass('tat');
                $('.animate_2').animate({height:'toggle'},1000);
                $('.thuphong1').html('<i class="fa fa-plus"></i>');
        }
  });
  //ngày tháng của form lọc
  var date = new Date(), y = date.getFullYear(), m = date.getMonth();
  var fd = new Date(y, m, 2);
  var ld = new Date(y, m + 1, 1);
  if ($('#date-from-picker').length >0 && $('#date-to-picker').length >0) {
    document.querySelector("#date-from-picker").valueAsDate = fd;
    document.querySelector("#date-to-picker").valueAsDate = ld;
  }

  $(function () {
    Highcharts.chart('chart1', {
      chart: {
            type: 'spline'
        },
        title: {
            text: 'Doanh thu theo tháng',
        },

        plotOptions: {
            areaspline: {
                fillOpacity: 0.5
            }
        },
        xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        },
        yAxis: {
            title: {
                text: 'Doanh thu'
            },
            plotLines: [{
                value: 0,
                width: 2,
                zIndex: 2,
                label:{text:'0'},
                color: '#808080'
            }]
        },
        tooltip: {
            
            valueSuffix: ' VNĐ',
            crosshairs: true,
            shared: true
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0,
        },
        
        series: [{
            name: 'Doanh thu',
            data: <?php echo $doanhthu ?>
        }],
    });


    Highcharts.chart('chart2', {
      chart: {
            type: 'spline'
        },
        title: {
            text: 'Lợi nhuận theo tháng',
        },

        plotOptions: {
            areaspline: {
                fillOpacity: 0.5
            }
        },
        xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        },
        yAxis: {
            title: {
                text: 'Lợi nhuận'
            },
            plotLines: [{
                value: 0,
                width: 2,
                zIndex: 2,
                label:{text:'0'},
                color: '#808080'
            }]
        },
        tooltip: {
            
            valueSuffix: ' VNĐ',
            crosshairs: true,
            shared: true
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0,
        },
        
        series: [{
            name: 'Lợi nhuận',
            data: <?php echo $loinhuan ?>
        }],
    });
  });
  
</script>