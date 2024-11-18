@extends('main')
@section('content') 
    <!-- Body section -->
    <section>
        <div class="container py-5">
            <h1 class="text-second text-center capitalize">Chi tiết đơn hàng</h1>
           
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
                        <li class="mb-3 px-3 py-2 d-block fw-500 side-bar-item rounded-3 ">
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
                    <h6 class="text-second fw-600 mb-4 capitalize">thông tin đơn hàng</h6>
                    <!-- Card item -->

                    <div class="customer mt-3">
        <ul class="p-0">
            <li class="my-1">Tên khách hàng: <strong>{{ $donhang->TenKH }}</strong></li>
            <li class="my-1">Số điện thoại: <strong>{{ $donhang->SDT }}</strong></li>
            <li class="my-1">Địa chỉ nhận hàng: <strong>{{ $donhang->DiaChiNhanHang }}</strong></li>
            <li class="my-1">Phương thức thanh toán: <strong>{{ $donhang->PTTT->TenPt }}</strong></li>
            <span class="">Trạng thái: 
                <span class=" fw-bold status
                    {{ $donhang->TTDonHang == 'Đơn hàng đã đặt' ? 'done' : '' }}
                    {{ $donhang->TTDonHang == 'Xác nhận đơn hàng' ? 'confirmed' : '' }}
                    {{ $donhang->TTDonHang == 'Đang chờ vận chuyển' ? 'pending' : '' }}
                    {{ $donhang->TTDonHang == 'Đang vận chuyển' ? 'shipping' : '' }}
                    {{ $donhang->TTDonHang == 'Đã giao hàng xong' ? 'shipped' : '' }}
                ">
                    {{ $donhang->TTDonHang == '' ? 'Chưa cập nhật' : $donhang->TTDonHang }}
                </span>
            </span>
           
            <li class="my-1">Ghi chú: <strong>{{ $donhang->GhiChu }}</strong></li>
            <li class="my-1">Ngày đặt hàng   : <strong>{{ $donhang->created_at }}</strong></li>
        </ul>
    </div>

    <div class="carts">
        @php $TongTien = 0; @endphp
        <table class="table align-middle text-center">
            <thead class="table-light">
                <tr>
                    <th scope="col" style="width: 15%;">Hình ảnh</th>
                    <th scope="col" style="width: 40%;">Tên sản phẩm</th>
                    <th scope="col" style="width: 15%;">Giá</th>
                    <th scope="col" style="width: 15%;">Số lượng</th>
                    <th scope="col" style="width: 15%;">Tổng tiền</th>
                </tr>
            </thead>
            <tbody>
                @foreach($Chitiets as $key => $Chitiet)
                    @php
                        $GiaThoiDiem = $Chitiet->Gia * $Chitiet->SoLuong;
                        $TongTien += $GiaThoiDiem;
                    @endphp
                    <tr>
                        <td>
                            <div class="d-flex justify-content-center">
                                <img src="{{ $Chitiet->SanPham->thumb }}" alt="IMG" style="width: 100px; height: auto; object-fit: cover;">
                            </div>
                        </td>
                        <td class="text-start text-truncate" style="max-width: 150px;">{{ $Chitiet->SanPham->name }}</td>
                        <td class="price">{{ number_format($Chitiet->Gia, 0, '', '.') }}</td>
                        <td>{{ $Chitiet->SoLuong }}</td>
                        <td class="price text-main">{{ number_format($GiaThoiDiem, 0, '', '.') }}</td>
                    </tr>
                @endforeach
                <tr class="table-secondary">
                    <td colspan="4" class="text-end fw-bold">Tổng Tiền Đơn Hàng</td>
                    <td class="fw-bold price text-main">{{ number_format($TongTien, 0, '', '.') }}</td>
                </tr>
            </tbody>
        </table>
    </div>


    </section>

    @endsection
