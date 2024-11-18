@extends('admin.main')

@section('content')
    <table class="table">
        <thead>
        <tr>
            <th style="width: 50px">ID</th>
            <th>Độ tuổi</th>
            <th>Ảnh</th>
            <th>Trang Thái</th>
            <th>Cập Nhật</th>
            <th style="width: 100px">&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        @foreach($dotuois as $key => $dotuoi)
            <tr>
                <td>{{ $dotuoi->id }}</td>
                <td>{{ $dotuoi->name }}</td>
                <td><a href="{{ $dotuoi->thumb }}" target="_blank">
                        <img src="{{ $dotuoi->thumb }}" height="40px">
                    </a>
                </td>
                <td>{!! \App\Helper\Helper::active( $dotuoi->active ) !!}</td>
                <td>{{ $dotuoi->updated_at }}</td>
                <td>
                    <a class="btn btn-primary btn-sm" href="/admin/dotuois/edit/{{ $dotuoi->id }}">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="#" class="btn btn-danger btn-sm"
                       onclick="removeRow('{{ $dotuoi->id }}', '/admin/dotuois/destroy')">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <a href="/admin/dotuois/add" class="button">Thêm độ tuổi    </a>
    {!! $dotuois->links() !!}
@endsection


