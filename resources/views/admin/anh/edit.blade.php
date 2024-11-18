@extends('admin.main')

@section('head')
    <script src="/ckeditor/ckeditor.js"></script>
@endsection

@section('content')
    <form action="" method="POST">
        <div class="card-body">
            <div class="row">

           
            <div class="form-group">
                <label for="menu">Ảnh Sản Phẩm</label>
                <input type="file"  class="form-control" id="upload">
                <div id="image_show">
                    <a href="{{ $anh->thumb }}">
                        <img src="{{ $anh->thumb }}" width="100px">
                    </a>
                </div>
                <input type="hidden" name="thumb" value="{{ $anh->thumb }}" id="thumb">
            </div>

            <div class="form-group">
                        <label>Sản phẩm</label>
                        <select class="form-control" name="sanpham_id">
                            @foreach($sanphams as $sanpham)
                                <option value="{{ $sanpham->id }}" {{ $anh->sanpham_id == $sanpham->id ? 'selected' : '' }}>
                                    {{ $sanpham->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                
            </div>


            <div class="form-group">
                <label>Kích Hoạt</label>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="1" type="radio" id="active" name="active"
                        {{ $song->active == 1 ? ' checked=""' : '' }}>
                    <label for="active" class="custom-control-label">Có</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="0" type="radio" id="no_active" name="active"
                        {{ $song->active == 0 ? ' checked=""' : '' }}>
                    <label for="no_active" class="custom-control-label">Không</label>
                </div>
            </div>

        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Cập Nhật Ảnh</button>
        </div>
        @csrf
    </form>
@endsection

@section('footer')
@endsection
