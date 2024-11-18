@extends('admin.main')

@section('content')
    <table class="table">
        <thead>
        <tr>
            <th style="width: 50px">ID</th>
            <th>Tên danh mục</th>
            <th>Mô tả</th>
            <th>Trang Thái</th>
            <th>Cập Nhật</th>
            <th style="width: 100px">&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        @foreach($danhmuctins as $key => $danhmuctin)
            <tr>
                <td>{{ $danhmuctin->id }}</td>
                <td>{{ $danhmuctin->name }}</td>
                <td>{{ $danhmuctin->description }}</td>
                <td>{!! \App\Helper\Helper::active( $danhmuctin->active ) !!}</td>
                <td>{{ $danhmuctin->updated_at }}</td>
                <td>
                    <a class="btn btn-primary btn-sm" href="/admin/danhmuctins/edit/{{ $danhmuctin->id }}">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="#" class="btn btn-danger btn-sm"
                       onclick="removeRow('{{ $danhmuctin->id }}', '/admin/danhmuctins/destroy')">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <a href="/admin/danhmuctins/add" class="button">Thêm danh mục  </a>
    {!! $danhmuctins->links() !!}
@endsection


