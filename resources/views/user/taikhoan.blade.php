@extends('main')
@section('content') 
    <!-- Body section -->
    <section>
        <div class="container py-5">
            <h1 class="text-second text-center capitalize">Tài khoản của bạn</h1>
           
            <div class="row row-cols-2 mt-5">
            
                <!-- Sidebar -->
                <div class="w-25 side-bar-box p-0 mx-4">
                    <h5 class="bg-main side-bar-heading py-3 text-center">Tài khoản của bạn</h5>
                    <ul class="p-3 m-0">
                        <li class="mb-3 px-3 py-2 d-block fw-500 side-bar-item rounded-3 active">
                            <a href="/tai-khoan" class="nav-link">
                            Thông tin tài khoản
                            </a>
                        </li>
                        <li class="mb-3 px-3 py-2 d-block fw-500 side-bar-item rounded-3">
                            <a href="/tai-khoan/lich-su-mua-hang" class="nav-link">
                            Lịch sử đơn hàng
                            </a>
                        </li>
                        <li class="mb-3 px-3 py-2 d-block fw-500 side-bar-item rounded-3">
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
                    <h6 class="text-second fw-600 mb-4 capitalize">Thông tin tài khoản</h6>
                    @include('admin.alert')
                    <form action="" method="POST">
                        <div class="card-body">
                            <div class="row">
                                <!-- User Name -->
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="name">Tên người dùng</label>
                                        <input type="text" name="name" id="name" value="{{ $user->name }}" class="form-control">
                                    </div>
                                </div>

                                <!-- Email -->
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" id="email" value="{{ $user->email }}" class="form-control">
                                    </div>
                                </div>

                                <!-- Profile Picture -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="upload">Ảnh đại diện</label>
                                        <input type="file" name="avatar" class="form-control" id="upload">
                                        <!-- <div id="image_show">
                                            <a href="{{ $user->thumb }}" target="_blank">
                                                <img src="{{ $user->thumb }}" width="100" alt="User Thumbnail">    
                                            </a>
                                        </div>
                                        <input type="hidden" name="thumb" value="{{ $user->thumb }}" id="thumb"> -->
                                    </div>
                                </div>

                                <!-- Phone Number -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone">Số điện thoại</label>
                                        <input type="text" name="SDT" id="phone" value="{{ $user->SDT }}" class="form-control">
                                    </div>
                                </div>

                                <!-- Gender Selection -->
                                <div class="col-md-6 mt-3">
                                    <div class="form-group">
                                        <label class="">Giới tính</label>
                                        <div class="gender-selection d-flex align-items-center gap-2">
                                            <div>
                                                <input type="radio" id="male" name="GioiTinh" value="Nam" {{ $user->GioiTinh == 'Nam' ? 'checked' : '' }}>
                                                <label for="male">Nam</label>
                                            </div>
                                            <div>
                                                <input type="radio" id="female" name="GioiTinh" value="Nữ" {{ $user->GioiTinh == 'Nữ' ? 'checked' : '' }}>
                                                <label for="female">Nữ</label>
                                            </div>
                                            <div>
                                                <input type="radio" id="other" name="GioiTinh" value="Khác" {{ $user->GioiTinh == 'Khác' ? 'checked' : '' }}>
                                                <label for="other">Khác</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Address -->
                                <div class="col-md-12 mt-3">
                                    <div class="form-group">
                                        <label for="address">Địa chỉ</label>
                                        <textarea name="DiaChi" id="address" class="form-control">{{ $user->DiaChi }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-main-hover d-block mx-auto px-4">Lưu</button>
                        </div>
                        @csrf
                    </form>
                </div>
               
            </div>
        </div>
    </section>

    @endsection
