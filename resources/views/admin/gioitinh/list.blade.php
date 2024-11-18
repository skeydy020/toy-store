@extends('admin.main')

@section('content')
    <table class="table">
        <thead>
        <tr>
            <th style="width: 50px">ID</th>
            <th>Giới tính</th>
            <th>Mô tả</th>
            <th>Trang Thái</th>
            <th>Cập Nhật</th>
            <th style="width: 100px">&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        @foreach($gioitinhs as $key => $gioitinh)
            <tr>
                <td>{{ $gioitinh->id }}</td>
                <td>{{ $gioitinh->name }}</td>
                <td>{{ $gioitinh->description }}
                </td>
                <td>{!! \App\Helper\Helper::active( $gioitinh->active ) !!}</td>
                <td>{{ $gioitinh->updated_at }}</td>
                <td>
                    <a class="btn btn-primary btn-sm" href="/admin/gioitinhs/edit/{{ $gioitinh->id }}">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="#" class="btn btn-danger btn-sm"
                       onclick="removeRow('{{ $gioitinh->id }}', '/admin/gioitinhs/destroy')">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <a href="/admin/gioitinhs/add" class="button">Thêm giới tính</a>
    {!! $gioitinhs->links() !!}
@endsection


