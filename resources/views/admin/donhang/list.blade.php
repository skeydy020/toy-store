@extends('admin.main')

@section('content')
    <table class="table">
        <thead>
        <tr>
            <th style="width: 50px">ID</th>
            <th>Tài khoản đặt hàng</th>
            <th>Tên Khách Hàng</th>
            <th>Số Điện Thoại</th>
            <th>Phương thức thanh toán</th>
            <th>Địa chỉ nhận</th>
            <th>Tình trạng đơn hàng</th>
            <th>Ngày Đặt hàng</th>
            <th style="width: 100px">&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        @foreach($donhangs as $key => $donhang)
            <tr>
                <td>{{ $donhang->id }}</td>
                <td>{{ $donhang->NguoiDung->name }}</td>
                <td>{{ $donhang->TenKH }}</td>
                <td>{{ $donhang->SDT }}</td>
                <td>{{ $donhang->PTTT->TenPt }}</td>
                <td>{{ $donhang->DiaChiNhanHang }}</td>
                <td><span class=" fw-600 status
                                {{ $donhang->TTDonHang == 'Đơn hàng đã đặt' ? 'done' : '' }}
                                {{ $donhang->TTDonHang == 'Xác nhận đơn hàng' ? 'confirmed' : '' }}
                                {{ $donhang->TTDonHang == 'Đang chờ vận chuyển' ? 'pending' : '' }}
                                {{ $donhang->TTDonHang == 'Đang vận chuyển' ? 'shipping' : '' }}
                                {{ $donhang->TTDonHang == 'Đã giao hàng xong' ? 'shipped' : '' }}
                            ">
                                {{ $donhang->TTDonHang == '' ? 'Chưa cập nhật' : $donhang->TTDonHang }}
                    </span>
                <a class="btn btn-primary btn-sm" href="/admin/donhangs/edit/{{ $donhang->id }}">
                        <i class="fas fa-edit"></i>
                    </a></td>
                <td>{{ $donhang->created_at }}</td>
                <td>
                    <a class="btn btn-primary btn-sm" href="/admin/donhangs/{{ $donhang->id }}">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="#" class="btn btn-danger btn-sm"
                    onclick="removeRow('{{ $donhang->id }}', '/admin/donhangs/destroy')">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="card-footer clearfix">
        {!! $donhangs->links() !!}
    </div>
@endsection


