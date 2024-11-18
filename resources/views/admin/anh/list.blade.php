@extends('admin.main')

@section('content')
    <table class="table">
        <thead>
        <tr>
            <th style="width: 50px">ID</th>
            <th>Tên sản phẩm</th>
            <th>Ảnh</th>
            <th>Active</th>
            <th>Update</th>
            <th style="width: 100px">&nbsp;</th>
        </tr>
        </thead>
        <tbody>
            @foreach($anhs as $key => $anh)
            <tr>
                <td>{{ $anh->id }}</td>
                <td>{{ $anh->SanPham->name }}</td>
                <td><a href="{{ $anh->thumb }}" target="_blank">
                        <img src="{{ $anh->thumb }}" height="40px">
                    </a>
                </td>
                <td>{!! \App\Helper\Helper::active( $anh->active ) !!}</td>
                <td>{{ $anh->updated_at }}</td>
                <td>
                    <a class="btn btn-primary btn-sm" href="/admin/anhs/edit/{{ $anh->id }}">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="#" class="btn btn-danger btn-sm"
                       onclick="removeRow('{{ $anh->id }}', '/admin/anhs/destroy')">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <a href="/admin/anhs/add" class="button">Thêm ảnh </a>
    <div class="card-footer clearfix">
        {!! $anhs->links() !!}
    </div>
@endsection


