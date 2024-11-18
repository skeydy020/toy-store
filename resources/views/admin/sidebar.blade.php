<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/admin/main" class="brand-link">
      <img src="/template/admin/dist/img/AdminLTELogo.png" alt="Admin Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Manager</span>
    </a>
    
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="/template/admin/dist/img/db1.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Cunny moment</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Quản lý thông tin
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin/menus/list" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Loại sản phẩm</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/thuonghieus/list" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thương hiệu</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/xuatxus/list" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Xuất xứ</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/dotuois/list" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Độ tuổi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/gioitinhs/list" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Giới tính</p>
                </a>
              </li>


            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon 	fas fa-chess"></i>
              <p>
                Sản phẩm
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin/sanphams/add" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thêm sản phẩm</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/sanphams/list" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh sách sản phẩm</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/anhs/list" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thư viện ảnh</p>
                </a>
              </li>
            </ul>
          </li>
         
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-envelope-open-text"></i>
              <p>
                Đơn hàng
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin/donhangs" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh sách đơn hàng</p>
                </a>
              </li>
              
           
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-bullhorn"></i>
              <p>
                Quản lý tin tức
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin/danhmuctins/list" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh mục tin tức</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/tintucs/list" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh sách tin tức</p>
                </a>
              </li>
           
            </ul>
          </li>


          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-stream"></i>
              <p>
                Slider
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin/sliders/add" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thêm slider</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/sliders/list" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh sách Slider</p>
                </a>
              </li>
           
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-address-card"></i>
              <p>
                Quản lý người dùng
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin/users/list" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh sách người dùng</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/users/phanquyen" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Phân quyền người dùng</p>
                </a>
              </li>
           
            </ul>
          </li>

          <li class="nav-item">
            <a href="/admin/baocao" class="nav-link">
              <i class="nav-icon far fa-address-card"></i>
              <p>
                Báo cáo thống kê
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>      
            </ul>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
