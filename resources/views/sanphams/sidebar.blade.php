<div class="mb-3">
    <div class="orderby-wrapper d-flex align-items-center">
        <label class="mx-3 fw-500">Sắp xếp</label>
        <select class="flex-fill border rounded py-2" name="orderby" class="orderby" onchange="updateOrderby(this)">
            <option {{ Request::get('orderby')=="md" ? "selected='selected'" : "" }} value="md" selected="selected">Mặc
                định</option>
            <option {{ Request::get('orderby')=="az" ? "selected='selected'" : "" }} value="az">Theo tên từ A-Z</option>
            <option {{ Request::get('orderby')=="za" ? "selected='selected'" : "" }} value="za">Theo tên từ Z-A</option>
            <option {{ Request::get('orderby')=="desc" ? "selected='selected'" : "" }} value="desc">Sản phẩm mới
            </option>
            <option {{ Request::get('orderby')=="giatang" ? "selected='selected'" : "" }} value="giatang">Giá tăng dần
            </option>
            <option {{ Request::get('orderby')=="giagiam" ? "selected='selected'" : "" }} value="giagiam">Giá giảm dần
            </option>
        </select>
    </div>
</div>

<!-- Category -->
<div class="card mb-3">
    <div class="card-header fs-6">
        Danh mục
    </div>
    <div class="card-body overflow-auto" style="max-height: 300px;">
        <ul class="nav flex-column">
            @foreach($menus as $menu)
            <li class="py-1"><a href="/danh-muc/{{ $menu->category_id }}-{{ Str::slug($menu->category_name, '-') }}"
                    class="list-item active">{{ $menu->category_name }}</a>
                <span> ( {{$menu->product_count}} )</span>
            </li>
            @endforeach
        </ul>
    </div>
</div>
<!-- Price -->
<div class="card mb-3">
    <div class="sidebar-giatien">
        <div class="card-header fs-6">
            Khoảng giá
        </div>
        <ul class="mt-2 ps-3">
            <li class="pt-1"><a class="list-item {{ Request::get('price') ==0 ? 'active' : '' }}"
                    href="{{ request()->fullUrlWithQuery(['price' => 0]) }}">Tất cả</a></li>
            <li class="py-1"><a class="list-item {{ Request::get('price') ==1 ? 'active' : '' }}"
                    href="{{ request()->fullUrlWithQuery(['price' => 1]) }}">Dưới 200.000 Đ</a></li>
            <li class="py-1"><a class="list-item {{ Request::get('price') ==2 ? 'active' : '' }}"
                    href="{{ request()->fullUrlWithQuery(['price' => 2]) }}">200.000 Đ - 500.000 Đ</a></li>
            <li class="py-1"><a class="list-item {{ Request::get('price') ==3 ? 'active' : '' }}"
                    href="{{ request()->fullUrlWithQuery(['price' => 3]) }}">500.000 Đ - 1.000.000 Đ</a></li>
            <li class="py-1"><a class="list-item {{ Request::get('price') ==4 ? 'active' : '' }}"
                    href="{{ request()->fullUrlWithQuery(['price' => 4]) }}">1.000.000 - 2.000.000 Đ</a></li>
            <li class=""><a class="list-item {{ Request::get('price') ==5 ? 'active' : '' }}"
                    href="{{ request()->fullUrlWithQuery(['price' => 5]) }}">Trên 2.000.000 Đ</a></li>
        </ul>
    </div>
</div>
<!-- Filter -->
<div class="card mb-3">
    <div class="card-header fs-6">
        Giới tính
    </div>
    <ul class="my-2 ps-3 ">
        @foreach($gioitinhCounts as $gioitinhId => $gioitinhData)
        <li class="py-1 ">
            <label>
                <input type="checkbox" name="gioitinh_id" value="{{ $gioitinhId }}" @if(in_array(
                    $gioitinhId,explode(',',$f_gioitinhs))) checked="checked" @endif> {{$gioitinhData['name']}} (
                {{$gioitinhData['count']}} )
            </label>
        </li>

        @endforeach
    </ul>
</div>
<!-- dotuoi -->
<div class="card mb-3">
    <div class="card-header fs-6">
        Độ tuổi
    </div>
    <ul class="my-2 ps-3 ">
        @foreach($dotuoiCounts as $dotuoiId => $dotuoiData)
        <li class="py-1 "><label><input type="checkbox" name="dotuoi_id" value="{{ $dotuoiId }}" @if(in_array(
                    $dotuoiId,explode(',',$f_dotuois))) checked="checked" @endif> {{$dotuoiData['name']}} (
                {{$dotuoiData['count']}} )</label>
        </li>
        @endforeach
    </ul>
</div>

