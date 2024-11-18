@extends('main')

@section('content')
    <form method="post">
        @include('admin.alert')

        @if (count($sanphams) != 0)
            <div class="container py-5">
                <div class="row">
                    <div class="col-lg-8 mb-4">
                        <div class="table-responsive">
                            @php $total = 0; @endphp
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="w-15">Sản phẩm</th>
                                        <th class="w-30"></th>
                                        <th class="w-15">Giá</th>
                                        <th class="w-15">Số lượng</th>
                                        <th class="w-15">Tổng tiền</th>
                                        <th class="w-10"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($sanphams as $key => $sanpham)
                                        @php
                                            $Gia = $sanpham->GiamGia != 0 ? $sanpham->GiamGia : $sanpham->Gia;
                                            $priceEnd = $Gia * $GioHang[$sanpham->id];
                                            $total += $priceEnd;
                                        @endphp
                                        <tr>
                                            <td class="align-middle">
                                                <img src="{{ $sanpham->thumb }}" alt="IMG" class="img-fluid">
                                            </td>
                                            <td class="align-middle">{{ $sanpham->name }}</td>
                                            <td class="align-middle price">{{ number_format($Gia, 0, '', '.') }}</td>
                                            <!-- <td class="align-middle">
                                                <input class="form-control w-50" type="number" name="SoLuong[{{ $sanpham->id }}]" value="{{ $GioHang[$sanpham->id] }}">
                                            </td> -->

                                            <td class="align-middle quantity-control">
                                                <button class="btn btn-outline-secondary btn-sm decrement" type="button">-</button>
                                                <input class="form-control quantityDisplay" type="number" name="SoLuong[{{ $sanpham->id }}]" value="{{ $GioHang[$sanpham->id] }}">
                                                <button class="btn btn-outline-secondary btn-sm increment" type="button">+</button>
                                            </td>


                                            
                                            <td class="align-middle text-main price fw-500">{{ number_format($priceEnd, 0, '', '.') }}</td>
                                            <td class="align-middle">
                                                <a href="/carts/delete/{{ $sanpham->id }}" class="text-danger">Xóa</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="d-flex justify-content-end">
                            <input class="form-control w-25 me-4" type="text" name="coupon" placeholder="Mã giảm giá">
                            <input type="submit" value="Cập nhật giỏ hàng" formaction="/update-cart" class="btn btn-main-hover">
                        </div>
                        <div class="d-flex justify-content-end  mt-4">
                                <span class="fw-500 me-3 h5">Tổng tiền: </span>
                                <span class="fw-600 text-main h5 price">{{ number_format($total, 0, '', '.') }}</span>
                                <input type="hidden" name="TongTien" value="{{ $total }}">
                        </div>
                        @csrf
                    </div>

                    <div class="col-lg-4">
                        <div class="border p-4 rounded">
                            <div class="">
                                <h4 class="mb-3 text-second">Thông Tin Khách Hàng</h4>
                                <div class="mb-3">
                                    <input class="form-control" type="text" name="TenKH" placeholder="Tên khách hàng">
                                </div>
                                <div class="mb-3">
                                    <input class="form-control" type="text" name="SDT" placeholder="Số điện thoại">
                                </div>
                                <div class="mb-3">
                                    <input class="form-control" type="text" name="DiaChiNhanHang" placeholder="Địa chỉ giao hàng">
                                </div>
                                <div class="mb-3">
                                    <label class="mb-1 fw-500" for="pttt_id">Phương thức thanh toán</label>
                                    <select class="form-select" name="pttt_id" id="pttt_id">
                                        @foreach($thanhtoans as $thanhtoan)
                                            <option value="{{ $thanhtoan->id }}">{{ $thanhtoan->TenPt }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <textarea class="form-control" name="GhiChu" placeholder="Ghi chú"></textarea>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-main-hover w-100">Đặt Hàng</button>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center"><h2>Giỏ hàng trống</h2></div>
        @endif
    </form>
@endsection
