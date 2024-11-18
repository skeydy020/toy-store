@extends('admin.main')

@section('head')
    <script src="/ckeditor/ckeditor.js"></script>
@endsection

@section('content')
    <form action="" method="POST">
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

               

            <div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Sản phẩm</label>
                        <select class="form-control" name="sanpham_id">
                            @foreach($sanphams as $sanpham)
                                <option value="{{ $sanpham->id }}">{{ $sanpham->name }}</option>
                            @endforeach
                        </select>
                    </div>
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
@endsection

@section('footer')
 
@endsection
