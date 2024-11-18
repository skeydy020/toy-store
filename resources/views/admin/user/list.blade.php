@extends('admin.main')

@section('content')
    <table class="table">
        <thead>
        <tr>
            <th style="width: 50px">ID</th>
            <th>Tên người dùng</th>
            <th>Email</th>
            <th>Quyền</th>
            <th>SDT</th>
            <th>Giới tính</th>
            <th>Địa chỉ</th>
            <th>Cập Nhật</th>
            <th style="width: 100px">&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $key => $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role->name }}</td>
                <td>0{{ $user->SDT }}</td>
                <td>{{ $user->GioiTinh }}</td>
                <td>{{ $user->DiaChi }}</td>
                <td>{{ $user->updated_at }}</td>
                <td>
                    <a class="btn btn-primary btn-sm" href="/admin/users/edit/{{ $user->id }}">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="#" class="btn btn-danger btn-sm"
                       onclick="removeRow('{{ $user->id }}', '/admin/users/destroy')">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <a href="/admin/users/add" class="button">Thêm Người Dùng </a>
    {!! $users->links() !!}
@endsection


