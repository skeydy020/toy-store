@extends('admin.main')

@section('content')
    <table class="table">
        <thead>
        <tr>
            <th style="width: 50px">ID</th>
            <th>Xuất xứ</th>
            <th>Mô tả</th>
            <th>Trang Thái</th>
            <th>Cập Nhật</th>
            <th style="width: 100px">&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        @foreach($xuatxus as $key => $xuatxu)
            <tr>
                <td>{{ $xuatxu->id }}</td>
                <td>{{ $xuatxu->name }}</td>
                <td>{{ $xuatxu->description }}
                </td>
                <td>{!! \App\Helper\Helper::active( $xuatxu->active ) !!}</td>
                <td>{{ $xuatxu->updated_at }}</td>
                <td>
                    <a class="btn btn-primary btn-sm" href="/admin/xuatxus/edit/{{ $xuatxu->id }}">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="#" class="btn btn-danger btn-sm"
                       onclick="removeRow('{{ $xuatxu->id }}', '/admin/xuatxus/destroy')">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <a href="/admin/xuatxus/add" class="button">Thêm xuất xứ</a>
    {!! $xuatxus->links() !!}
@endsection


