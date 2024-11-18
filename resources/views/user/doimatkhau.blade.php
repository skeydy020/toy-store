@extends('main')
@section('content') 
    <!-- Body section -->
    <section>
        <div class="container py-5">
            <h1 class="text-second text-center capitalize">Đổi mật khẩu</h1>
           
            <div class="row row-cols-2 mt-5">
            
                <!-- Sidebar -->
                <div class="w-25 side-bar-box p-0 mx-4">
                    <h5 class="bg-main side-bar-heading py-3 text-center">Tài khoản của bạn</h5>
                    <ul class="p-3 m-0">
                        <li class="mb-3 px-3 py-2 d-block fw-500 side-bar-item rounded-3">
                            <a href="/tai-khoan" class="nav-link">
                            Thông tin tài khoản
                            </a>
                        </li>
                        <li class="mb-3 px-3 py-2 d-block fw-500 side-bar-item rounded-3">
                            <a href="/tai-khoan/lich-su-mua-hang" class="nav-link">
                            Lịch sử đơn hàng
                            </a>
                        </li>
                        <li class="mb-3 px-3 py-2 d-block fw-500 side-bar-item rounded-3 active">
                            <a href="/tai-khoan/doi-mat-khau" class="nav-link">
                            Đổi mật khẩu
                            </a>
                        </li>
                        <li class="mb-3 px-3 py-2 d-block fw-500 side-bar-item rounded-3">
                            <a href="/dang-xuat" class="nav-link">
                            Đăng xuất
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- Content -->
                <!-- Account infor -->
                <div class="col-md-8 py-4 px-4 border box-rounded box-content active">
                    @include('admin.alert')
            <form class="mt-4 w-50 mx-auto" action="" method="post">
                <div class="mb-4">
                    <label for="name" class="form-label required fw-600">Mật khẩu hiện tại</label>
                    <input type="password" class="form-control border-2" name="oldpassword"
                        required>
                </div>
                
                <div class="row row-cols-2 mb-4">
                    <div class="col">
                        <label for="password" class="form-label required fw-600">Mật khẩu</label>
                        <input type="password" class="form-control border-2" name="password" required>
                    </div>
                    <div class="col">
                        <label for="confirm-password" class="form-label required fw-600">Nhập lại mật khẩu</label>
                        <input type="password" class="form-control border-2" name="confirm-password" required>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-main-hover d-block mx-auto px-4">Đổi mật khẩu</button>
                
                @csrf
            </form>

                </div>
   
               
            </div>
        </div>
    </section>

    @endsection
