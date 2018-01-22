
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Xây Dựng</title>
   
  </head>
  <body>
    <section class="material-half-bg">
      <div class="cover"></div>
    </section>
    <section class="login-content">
      <div class="logo">
        <h1 style="font-family: Minion;">Xây Dựng</h1>
      </div>
      <div class="login-box">
        <form class="login-form" action="<?php echo base_url();?>login/login/" method="post" id="form">
          <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>ĐĂNG NHẬP</h3>
          <div><span class="alert-danger"><?php if(isset($b_Check) && $b_Check == false){echo "Tài khoản không đúng. Xin vui lòng đăng nhập lại !";}?></span></div>
          <!-- <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"> -->
          <div class="form-group">
            <label class="control-label">TÊN ĐĂNG NHẬP</label>
            <input class="form-control" name="username" type="text" placeholder="Tên đăng nhập" autofocus>
          </div>
          <div class="form-group">
            <label class="control-label">MẬT KHẨU</label>
            <input class="form-control" name="password" type="password" placeholder="mật khẩu">
          </div>
          <!-- <div class="form-group">
            <div class="utility">
              <div class="animated-checkbox">
                <label class="semibold-text">
                  <input type="checkbox"><span class="label-text">Stay Signed in</span>
                </label>
              </div>
              <p class="semibold-text mb-0"><a data-toggle="flip">Forgot Password ?</a></p>
            </div>
          </div> -->
          <div class="form-group btn-container">
            <button class="btn btn-primary btn-block"><i class="fa fa-sign-in fa-lg fa-fw"></i>ĐĂNG NHẬP</button>
          </div>
        </form>
        <form class="forget-form" action="index.html">
          <!-- <h3 class="login-head"><i class="fa fa-lg fa-fw fa-lock"></i>Forgot Password ?</h3> -->
          <div class="form-group">
            <label class="control-label">EMAIL</label>
            <input class="form-control" type="text" placeholder="Email">
          </div>
          <div class="form-group btn-container">
            <button class="btn btn-primary btn-block"><i class="fa fa-unlock fa-lg fa-fw"></i>RESET</button>
          </div>
          <div class="form-group mt-20">
            <p class="semibold-text mb-0"><a data-toggle="flip"><i class="fa fa-angle-left fa-fw"></i> Back to Login</a></p>
          </div>
        </form>
      </div>
    </section>
  </body>
  <script src="<?php echo base_url(); ?>public/js/jquery-2.1.4.min.js"></script>
  <script src="<?php echo base_url(); ?>public/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url(); ?>public/js/plugins/pace.min.js"></script>
  <script src="<?php echo base_url(); ?>public/js/main.js"></script>
</html>