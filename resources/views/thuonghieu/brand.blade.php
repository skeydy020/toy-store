
@extends('main')

@section('css')
    <link rel="stylesheet" href="{{asset('static/css/brand.css') }}">
@endsection

@section('content')

    <div class="container mt-5">
        <!-- Header -->
        <h2 class="brand-header">Thương Hiệu Đồ Chơi Nổi Bật</h2>
        
    </div>

    <div class="container my-2">
        <div class="filter-buttons d-flex justify-content-center align-items-center flex-wrap">
        </div>
        <div class="mt-2">
            <div id="brand-list" class="d-flex justify-content-center flex-wrap">
            </div>
        </div>

        <!-- Brands -->
        <div class="brand-container"> </div>
    </div>


    <script>
        @php
            $firstLetters = $thuonghieus->map(function($thuonghieu) {
                return strtoupper(substr($thuonghieu->name, 0, 1)); // Lấy chữ cái đầu và chuyển thành chữ hoa;
            })->unique()->values();

            // Chuyển đổi Collection thành mảng
            $firstLetters = $firstLetters->toArray();

            // Thêm 'Tất Cả' vào vị trí đầu tiên của mảng
            array_unshift($firstLetters, 'Tất Cả');

            // chuyển đổi lại thành Collection để tiếp tục làm việc với Laravel
            $firstLetters = collect($firstLetters);

            // 'Popo ABC' Onpiect Pokemon abc
            // P O P A
            // 0 1 2 3

            // P O null A
            // 0 1 2    3

            // P 0  A
            // 0 1  2

            $firstLetters = json_encode($firstLetters);

            $brands = $thuonghieus->map(function($thuonghieu) {

                $thuonghieu->char = strtoupper(substr($thuonghieu->name, 0, 1)); // Lấy chữ cái đầu và chuyển thành chữ hoa
                $thuonghieu->link = $thuonghieu->thumb;
                $thuonghieu->linkBrand = "/thuong-hieu/".$thuonghieu->id ."-".Str::slug($thuonghieu->name, '-');

                unset($thuonghieu->thumb);

                return $thuonghieu;
            });
            $brands = json_encode($brands);

        @endphp

    let filterValues = JSON.parse(@json($firstLetters));

    console.log(filterValues);

    let brandData = JSON.parse(@json($brands));

    // Load Database bằng PHP ( Laravel )
    // Chuyển định dạng của PHP sao cho tương ứng với bên js 
    // Chuyển giá trị PHP thành giá trị JS

    // const filterValues = [
    //     "Tất Cả", "3", "4", "5", "A", "B", "C", "D", "E", "F",
    //     "G", "H", "I", "J", "K", "L", "M", "N", "O", "P",
    //     "R", "S", "T", "U", "V", "W", "X", "Y", "Z"
    // ];

    // const brandData = [
    //     { linkBrand: '#', link: "https://www.mykingdom.com.vn/cdn/shop/files/3C4G.png?v=1701240982", char: "4", name: "4M" },
    //     { linkBrand: '#', link: "https://www.mykingdom.com.vn/cdn/shop/files/3C4G.png?v=1701240982", char: "L", name: "LEGO" },
    //     { linkBrand: '#', link: "https://www.mykingdom.com.vn/cdn/shop/files/3C4G.png?v=1701240982", char: "B", name: "Barbie" },
    //     { linkBrand: '#', link: "https://www.mykingdom.com.vn/cdn/shop/files/3C4G.png?v=1701240982", char: "F", name: "Fisher Price" },
    //     { linkBrand: '#', link: "https://www.mykingdom.com.vn/cdn/shop/files/3C4G.png?v=1701240982", char: "H", name: "Hot Wheels", },
    //     { linkBrand: '#', link: "https://www.mykingdom.com.vn/cdn/shop/files/3C4G.png?v=1701240982", char: "N", name: "NERF" },
    //     { linkBrand: '#', link: "https://www.mykingdom.com.vn/cdn/shop/files/3C4G.png?v=1701240982", char: "P", name: "Playmobil" },
    //     { linkBrand: '#', link: "https://www.mykingdom.com.vn/cdn/shop/files/3C4G.png?v=1701240982", char: "R", name: "Ravensburger" },
    //     { linkBrand: '#', link: "https://www.mykingdom.com.vn/cdn/shop/files/3C4G.png?v=1701240982", char: "T", name: "Transformers" },
    //     { linkBrand: '#', link: "https://www.mykingdom.com.vn/cdn/shop/files/3C4G.png?v=1701240982", char: "T", name: "TTG" },
    //     { linkBrand: '#', link: "https://www.mykingdom.com.vn/cdn/shop/files/3C4G.png?v=1701240982", char: "V", name: "VTech" },
    //     { linkBrand: '#', link: "https://www.mykingdom.com.vn/cdn/shop/files/3C4G.png?v=1701240982", char: "3", name: "3C4G" },
    //     { linkBrand: '#', link: "https://www.mykingdom.com.vn/cdn/shop/files/3C4G.png?v=1701240982", char: "3", name: "3C4G" },
    // ];


    // Admin xóa ----> Database xóa
    // User  -----> Database

    </script>

    <script src="{{asset('static/js/brand.js')}}"></script>
@endsection