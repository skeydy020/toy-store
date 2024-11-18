@extends('admin.main')

@section('head')
    <script src="/ckeditor/ckeditor.js"></script>
@endsection

@section('content')
    <form action="" method="POST">
        <div class="card-body">
            <div class="row">

            <div class="col-md-6">
                    <div class="form-group">
                        <label for="menu">Mã Code sản phẩm</label>
                        <input type="text" name="Code" value="{{ $sanpham->Code }}" class="form-control"
                               placeholder="Nhập code">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="menu">Tên sản phẩm</label>
                        <input type="text" name="name" value="{{ $sanpham->name }}" class="form-control"
                               placeholder="Nhập tên bài hát">
                    </div>
                </div>
                <div class="col-md-6">
            <div class="form-group">
                <label for="menu">Ảnh Sản Phẩm</label>
                <input type="file"  class="form-control" id="upload">
                <div id="image_show">
                    <a href="{{ $sanpham->thumb }}">
                        <img src="{{ $sanpham->thumb }}" width="100px">
                    </a>
                </div>
                <input type="hidden" name="thumb" value="{{ $sanpham->thumb }}" id="thumb">
            </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Mô Tả </label>
                    <textarea name="description" class="form-control">{{ $sanpham->description }}</textarea>
             </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="menu">Giá</label>
                        <input type="number" name="Gia" value="{{ $sanpham->Gia }}"  class="form-control" >
                    </div> </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="menu">Giá giảm</label>
                        <input type="number" name="GiamGia" value="{{ $sanpham->GiamGia }}"  class="form-control" >
                    </div> </div>
                
            </div>
</div>
            <div class="row">
                <div class="col-md-6">
                        <label>Thể loại</label>
                        <select class="form-control" name="menu_id">
                        <option value="0"> Không thuộc thể loại nào</option>
                            @foreach($menus as $menu)
                                <option value="{{ $menu->id }}" {{ $sanpham->menu_id == $menu->id ? 'selected' : '' }}>
                                    {{ $menu->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Thương hiệu</label>
                        <select class="form-control" name="thuonghieu_id">
                            @foreach( $thuonghieus as $thuonghieu)
                                <option value="{{ $thuonghieu->id }}" {{ $sanpham->thuonghieu_id == $thuonghieu->id ? 'selected' : '' }}>
                                    {{ $thuonghieu->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                </div>
            <div class="form-group">
                        <label>Giới tính phù hợp</label>
                        <select class="form-control" name="gioitinh_id">
                            @foreach($gioitinhs as $gioitinh)
                                <option value="{{ $gioitinh->id }}" {{ $sanpham->gioitinh_id == $gioitinh->id ? 'selected' : '' }}>
                                    {{ $gioitinh->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
            <div class="form-group">
                    <label>Độ tuổi phù hợp</label>
                        <select class="form-control" name="dotuoi_id">
                            @foreach($dotuois as $dotuoi)
                                <option value="{{ $dotuoi->id }}" {{ $sanpham->dotuoi_id == $dotuoi->id ? 'selected' : '' }}>
                                    {{ $dotuoi->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

              <div class="form-group">
                    <label>Xuất xứ</label>
                        <select class="form-control" name="xuatxu_id">
                            @foreach($xuatxus as $xuatxu)
                                <option value="{{ $xuatxu->id }}" {{ $sanpham->xuatxu_id == $xuatxu->id ? 'selected' : '' }}>
                                    {{ $xuatxu->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="menu">Số lượng</label>
                        <input type="number" name="SoLuong" value="{{ $sanpham->SoLuong }}"  class="form-control" >
                    </div>
                </div>
            </div>

           
            <div class="form-group">
                <label>Mô tả chi tiết </label>
                <textarea name="content" class="form-control">{{ $sanpham->content }}</textarea>
            </div>


            <div class="form-group">
                <label>Kích Hoạt</label>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="1" type="radio" id="active" name="active"
                        {{ $sanpham->active == 1 ? ' checked=""' : '' }}>
                    <label for="active" class="custom-control-label">Có</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="0" type="radio" id="no_active" name="active"
                        {{ $sanpham->active == 0 ? ' checked=""' : '' }}>
                    <label for="no_active" class="custom-control-label">Không</label>
                </div>
            </div>

        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Cập Nhật Sản Phẩm</button>
        </div>
        @csrf
    </form>
@endsection

@section('footer')
    <script>
        CKEDITOR.replace('content');
    </script>
@endsection
