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

    <form action="/admin/anhs/addsanpham/{{ $id }}" method="POST">
        <div class="card-body">
            <div class="row">
               
            <div class="form-group">
                <label for="menu">Ảnh bìa</label>
                <input type="file"  class="form-control" id="upload">
                <div id="image_show">

                </div>
                <input type="hidden" name="thumb" id="thumb">
            </div>
            </div>
            
            </div>
           
            <div class="form-group">
                <label>Kích Hoạt</label>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="1" type="radio" id="active" name="active" checked="">
                    <label for="active" class="custom-control-label">Có</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="0" type="radio" id="no_active" name="active" >
                    <label for="no_active" class="custom-control-label">Không</label>
                </div>
            </div>

        
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Thêm ảnh</button>
        </div>
        @csrf
    </form>
    <div class="card-footer clearfix">
        {!! $anhs->links() !!}
    </div>
@endsection


