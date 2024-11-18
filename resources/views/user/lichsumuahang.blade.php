@extends('main')
@section('content') 
    <!-- Body section -->
    <section>
        <div class="container py-5">
            <h1 class="text-second text-center capitalize">Lịch sử mua hàng</h1>
           
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
                        <li class="mb-3 px-3 py-2 d-block fw-500 side-bar-item rounded-3 active">
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
                <div class="col-md-8 py-4 px-4 border box-rounded box-content active">
                    <h6 class="text-second fw-600 mb-4 capitalize">Lịch sử mua hàng</h6>
                    <!-- Card item -->

                    @foreach($donhangs as $key => $donhang)
                    <div class="card-cart border shadow-none">
                        <div class="p-3">
                            <div class="row border-bottom pb-3">
                                <div class="col-md-7 me-5">
                                    <div>
                                        <h5 class="text-truncate">
                                            <a href="/tai-khoan/lich-su-mua-hang/{{ $donhang->id }}" class="text-dark capitalize fs-6">Mã đơn hàng: DH{{ $donhang->id }}</a>
                                        </h5>
                                    </div>
                                </div>
                                <div class="col">
                                    <span class="fw-500">Trạng thái: 
                                        <span class=" fw-600 status
                                            {{ $donhang->TTDonHang == 'Đơn hàng đã đặt' ? 'done' : '' }}
                                            {{ $donhang->TTDonHang == 'Xác nhận đơn hàng' ? 'confirmed' : '' }}
                                            {{ $donhang->TTDonHang == 'Đang chờ vận chuyển' ? 'pending' : '' }}
                                            {{ $donhang->TTDonHang == 'Đang vận chuyển' ? 'shipping' : '' }}
                                            {{ $donhang->TTDonHang == 'Đã giao hàng xong' ? 'shipped' : '' }}
                                        ">
                                            {{ $donhang->TTDonHang == '' ? 'Chưa cập nhật' : $donhang->TTDonHang }}
                                        </span>
                                    </span>
                                </div>
                            </div>
    
                            <div>
                                <div class="row">
                                    <div class="col-md-7 me-5"></div>
                                    <div class="col">
                                        <div class="mt-3 d-flex align-items-center">
                                            <p class="m-0 fs-6 me-3 position-relative fw-500">Tổng tiền: <span class="text-main price">{{ number_format($donhang->TongTien, '0', '', '.') }}</span></p>
                                            <span class="total-price fw-bold"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
    
                        </div>
                    </div>
                    <div class="card border-0 shadow-sm mb-3">


                    
                   @endforeach
                </div>
               
            </div>
        </div>
    </section>

    @endsection
