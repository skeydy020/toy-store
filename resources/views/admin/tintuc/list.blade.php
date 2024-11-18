@extends('admin.main')

@section('content')
    <table class="table">
        <thead>tả
        <tr>
            <th style="width: 50px">ID</th>
            <th>Tiêu đề</th>
            <th>Ảnh bìa</th>
            <th>Danh mục</th>
            <th>Mô tả</th>
            <th>Trang Thái</th>
            <th>Cập Nhật</th>
            <th style="width: 100px">&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        @foreach($tintucs as $key => $tintuc)
            <tr>
                <td>{{ $tintuc->id }}</td>
                <td>{{ $tintuc->name }}</td>
                <td><a href="{{ $tintuc->thumb }}" target="_blank">
                        <img src="{{ $tintuc->thumb }}" height="40px">
                    </a>
                </td>
                <td>{{ $tintuc->DanhMucTinTuc->name }}</td>
                <td>{{ $tintuc->description }}</td>

                <td>{!! \App\Helper\Helper::active( $tintuc->active ) !!}</td>
                <td>{{ $tintuc->updated_at }}</td>
                <td>
                    <a class="btn btn-primary btn-sm" href="/admin/tintucs/edit/{{ $tintuc->id }}">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="#" class="btn btn-danger btn-sm"
                       onclick="removeRow('{{ $tintuc->id }}', '/admin/tintucs/destroy')">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <a href="/admin/tintucs/add" class="button">Thêm tin tức  </a>
    {!! $tintucs->links() !!}
@endsection


