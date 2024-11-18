@extends('admin.main')

@section('content')
    <table class="table">
        <thead>
        <tr>
            <th style="width: 50px">ID</th>
            <th>Code</th>
            <th>Tên sản phẩm</th>
            <th>Ảnh</th>
            <th>Loại sản phẩm</th>
            <th>Thương hiệu</th>
            <th>Giới tính</th>
            <th>Giá</th>
            <th>Giá giảm</th>
            <th>Số lượng</th>
            <th>Active</th>
            <th>Update</th>
            <th>Thư viện ảnh</th>
            <th style="width: 100px">&nbsp;</th>
        </tr>
        </thead>
        <tbody>
            @foreach($sanphams as $key => $sanpham)
            <tr>
                <td>{{ $sanpham->id }}</td>
                <td>{{ $sanpham->Code }}</td>
                <td>{{ $sanpham->name }}</td>
                <td><a href="{{ $sanpham->thumb }}" target="_blank">
                        <img src="{{ $sanpham->thumb }}" height="40px">
                    </a>
                </td>
                <td>{{ $sanpham->DanhMuc->name }}</td>
                <td>{{ $sanpham->ThuongHieu->name }}</td>
                <td>{{ $sanpham->GioiTinh->name }}</td>
                <td>{{ $sanpham->Gia }}</td>
                <td>{{ $sanpham->GiamGia }}</td>
                <td>{{ $sanpham->SoLuong }}</td>
                <td>{!! \App\Helper\Helper::active( $sanpham->active ) !!}</td>
                <td>{{ $sanpham->updated_at }}</td>
                <td>
                    <a class="btn btn-info" href="/admin/anhs/listanh/{{ $sanpham->id }}">
                        <i class="fas fa-image"></i>
                    </a>
                </td>
                <td>
                    <a class="btn btn-primary btn-sm" href="/admin/sanphams/edit/{{ $sanpham->id }}">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="#" class="btn btn-danger btn-sm"
                       onclick="removeRow('{{ $sanpham->id }}', '/admin/sanphams/destroy')">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="card-footer clearfix">
        {!! $sanphams->links() !!}
    </div>
@endsection


