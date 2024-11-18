@extends('admin.main')

@section('content')
    <table class="table">
        <thead>
        <tr>
            <th style="width: 50px">ID</th>
            <th>Tên thương hiệu</th>
            <th>Ảnh</th>
            <th>Trang Thái</th>
            <th>Cập Nhật</th>
            <th style="width: 100px">&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        @foreach($thuonghieus as $key => $thuonghieu)
            <tr>
                <td>{{ $thuonghieu->id }}</td>
                <td>{{ $thuonghieu->name }}</td>
                <td><a href="{{ $thuonghieu->thumb }}" target="_blank">
                        <img src="{{ $thuonghieu->thumb }}" height="40px">
                    </a>
                </td>
                <td>{!! \App\Helper\Helper::active( $thuonghieu->active ) !!}</td>
                <td>{{ $thuonghieu->updated_at }}</td>
                <td>
                    <a class="btn btn-primary btn-sm" href="/admin/thuonghieus/edit/{{ $thuonghieu->id }}">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="#" class="btn btn-danger btn-sm"
                       onclick="removeRow('{{ $thuonghieu->id }}', '/admin/thuonghieus/destroy')">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <a href="/admin/thuonghieus/add" class="button">Thêm thương hiệu</a>
    {!! $thuonghieus->links() !!}
@endsection


