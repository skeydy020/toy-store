@extends('admin.main')

@section('content')
    <div class="customer mt-3">
        <ul>
            <li>Tên khách hàng: <strong>{{ $donhang->TenKH }}</strong></li>
            <li>Số điện thoại: <strong>{{ $donhang->SDT }}</strong></li>
            <li>Địa chỉ nhận hàng: <strong>{{ $donhang->DiaChiNhanHang }}</strong></li>
            <li>Phương thức thanh toán: <strong>{{ $donhang->PTTT->TenPt }}</strong></li>
            <li>Tình trạng đơn hàng: <strong>{{ $donhang->TTDonHang }}</strong></li>
           
            <li>Ghi chú: <strong>{{ $donhang->GhiChu }}</strong></li>
            <li>Ngày đặt hàng   : <strong>{{ $donhang->created_at }}</strong></li>
        </ul>
    </div>

    <div class="carts">
        @php $TongTien = 0; @endphp
        <table class="table">
            <tbody>
            <tr class="table_head">
                <th class="column-1">Hình ảnh</th>
                <th class="column-2">Tên sản phẩm</th>
                <th class="column-3">Giá</th>
                <th class="column-4">Số lượng</th>
                <th class="column-5">Tổng tiền</th>
            </tr>

            @foreach($Chitiets as $key => $Chitiet)
                @php
                    $GiaThoiDiem = $Chitiet->Gia * $Chitiet->SoLuong;
                    $TongTien += $GiaThoiDiem;
                @endphp
                <tr>
                    <td class="column-1">
                        <div class="how-itemcart1">
                            <img src="{{ $Chitiet->SanPham->thumb }}" alt="IMG" style="width: 100px">
                        </div>
                    </td>
                    <td class="column-2">{{ $Chitiet->SanPham->name }}</td>
                    <td class="column-3">{{ number_format($Chitiet->Gia, 0, '', '.') }}</td>
                    <td class="column-4">{{ $Chitiet->SoLuong }}</td>
                    <td class="column-5">{{ number_format($GiaThoiDiem, 0, '', '.') }}</td>
                </tr>
            @endforeach
                <tr>
                    <td colspan="4" class="text-right">Tổng Tiền Đơn Hàng</td>
                    <td>{{ number_format($TongTien, 0, '', '.') }}</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection


