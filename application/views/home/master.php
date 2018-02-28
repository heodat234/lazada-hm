<?php 
if($this->session->has_userdata('user')) {
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css.map">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/admin.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/bootstrap.min.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
    

    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
    <link href="<?php echo base_url(); ?>public/css/jquery-ui.css" rel="stylesheet">  
  
    <script src="<?php echo base_url(); ?>public/js/jquery-2.1.4.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    
    <script type="text/javascript" src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://printjs-4de6.kxcdn.com/print.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">
    <script src="<?php echo base_url(); ?>public/ssi-modal/js/ssi-modal.min.js"></script>
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/ssi-modal/styles/ssi-modal.css"/> 
    <script type="text/javascript" src="<?php echo base_url(); ?>public/js/jquery-ui.js"></script>
    <!-- chart -->
    <script src="https://code.highcharts.com/highcharts.src.js"></script>
    
    <title>Quản lý đơn hàng</title>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries-->
    
  </head>
  <body class="sidebar-mini fixed">
    
    <div class="wrapper">
      <?php echo isset($html_header) ? $html_header : ''; ?>
      <?php echo isset($html_menu) ? $html_menu : ''; ?>
      <?php echo isset($html_body) ? $html_body : ''; ?>
      <div style="text-align: center;" style="height: 80px" >
        <p class="copy-right">Design by <a href="http://hungminhit.com/">HungMinhITS</a></p>
      </div>
    </div>
    
  </body>
  <script src="<?php echo base_url(); ?>public/js/plugins/pace.min.js"></script>
    <script src="<?php echo base_url(); ?>public/js/main.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>public/js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>public/js/plugins/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>public/js/plugins/dataTables.responsive.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>public/js/plugins/dataTables.fixedColumns.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>public/js/plugins/jquery.dataTables.yadcf.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/css/responsive.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/css/fixedColumns.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/css/jquery.dataTables.yadcf.css">
    <script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.10.16/api/fnFilterClear.js"></script>
    <script type="text/javascript">$('#sampleTable').DataTable({
      // colReorder: true,
                responsive: {
                    details: {
                        type: 'column',
                        target: 'tr'
                    }
                },
                columnDefs: [ {
                    className: 'control',
                    orderable: false,
                    targets:   0,
                    responsivePriority: 1,
                } ],
    });
    
  </script>
  <script>
        
        $('.accordion').on('click',function(event) {
          this.classList.toggle("active");
            if ($('.animate').hasClass('tat')) {
                      $('.animate').removeClass('tat');
                      $('.animate').animate({height:'toggle'},1000);
                      $('.accordion').html('<i class="fa fa-minus"></i>');
            } else {
                    $('.animate').addClass('tat');
                    $('.animate').animate({height:'toggle'},1000);
                    $('.accordion').html('<i class="fa fa-plus"></i>');
            }
        });
  </script>
  <script src="<?php echo base_url(); ?>public/js/customer.js"></script>
</html>
<?php 
}else{redirect(base_url('login'));}
?>