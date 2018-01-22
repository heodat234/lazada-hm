<aside class="main-sidebar hidden-print">
        <section class="sidebar">
          <div class="user-panel">
            <div class="pull-left image"><img class="img-circle" src="https://s3.amazonaws.com/uifaces/faces/twitter/jsa/48.jpg" alt="User Image"></div>
            <div class="pull-left info">
              <p><?php echo $this->session->userdata('user')['username'] ?></p>
                <p class="designation">Admin</p>
              
            </div>
          </div>
          <!-- Sidebar Menu-->
          <ul class="sidebar-menu">
            <?php if ($page == 'thongke') { ?>
              <li class="treeview active"><a href="<?php echo base_url(); ?>thongke"><i class="fa fa-bar-chart"></i><span>Bảng tổng quan</span></a>
            </li>
              </li>
            <?php } else { ?>
              <li class="treeview"><a href="<?php echo base_url(); ?>thongke"><i class="fa fa-bar-chart"></i><span>Bảng tổng quan</span></a>
              </li>
            <?php } ?>

            <?php if ($page == 'donhang') { ?>
              <li class="treeview active"><a href="<?php echo base_url(); ?>donhang"><i class="fa fa-file-text"></i><span>Quản lý đơn hàng</span></a>
              </li>
            <?php } else { ?>
              <li class="treeview"><a href="<?php echo base_url(); ?>donhang"><i class="fa fa-file-text"></i><span>Quản lý đơn hàng</span></a>
              </li>
            <?php } ?>

            <?php if ($page == 'sanpham') { ?>
              <li class="treeview active"><a href="<?php echo base_url(); ?>sanpham"><i class="fa fa-list"></i><span>Quản lý sản phẩm</span></a>
            </li>
              </li>
            <?php } else { ?>
              <li class="treeview"><a href="<?php echo base_url(); ?>sanpham"><i class="fa fa-list"></i><span>Quản lý sản phẩm</span></a>
              </li>
            <?php } ?>
            
            <!-- <li class="treeview"><a href="#"><i class="fa fa-bars"></i><span>Quản lý công trình</span><i class="fa fa-angle-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url(); ?>list_congtrinh"><i class="fa fa-circle-o"></i> Danh sách công trình</a></li>
                <li><a href="<?php echo base_url(); ?>them_congtrinh"><i class="fa fa-circle-o"></i>Thêm công trình</a></li>
              </ul>
            </li>
            <li class="treeview"><a href="#"><i class="fa fa-file-text"></i><span>Hồ sơ đã ký</span><i class="fa fa-angle-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url(); ?>page_list_hoso_daky"><i class="fa fa-circle-o"></i>Danh sách hồ sơ đã ký</a></li>
                <!-- <li><a href="<?php echo base_url(); ?>page_them_hoso_daky"><i class="fa fa-circle-o"></i>Thêm hồ sơ</a></li> -->
              </ul>
            </li> -->
          </ul>
        </section>
      </aside>