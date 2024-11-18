
    <!-- Footer -->
    <footer class="border-top border-5 border-main mt-5 bg-second ">
        <div class="container py-3 py-md-5 mt-3 mt-md-5">
            <div class="row row-cols-1 row-cols-md-4 text-center text-md-start">
                <div class="col">
                    <img class="img-fluid w-50 w-md-75 mx-auto" src="/template/assets/img/logo.png" alt="logo">
                    <p class="mt-3 fs-5">Theo dõi chúng tôi trên</p>
                    <ul class="list-unstyled mt-3 d-flex justify-content-center justify-content-md-start">
                        <li class=""><a href="#" class=""><i class="fs-4 fs-md-5 fab fa-facebook-f"></i></a></li>
                        <li class="ms-3"><a href="#" class=""><i class="fs-4 fs-md-5 fab fa-twitter"></i></a></li>
                        <li class="ms-3"><a href="#" class=""><i class="fs-4 fs-md-5 fab fa-pinterest"></i></a></li>
                        <li class="ms-3"><a href="#" class=""><i class="fs-4 fs-md-5 fab fa-instagram"></i></a></li>
                        <li class="ms-3"><a href="#" class=""><i class="fs-4 fs-md-5 fab fa-youtube"></i></a></li>
                    </ul>
                </div>
                <div class="col">
                    <h3 class="text-main">Điều hướng</h3>
                    <ul class="list-unstyled mt-2">
                        <li class="my-2"><a class="fs-6" href="./index.html">Trang chủ</a></li>
                        <li class="my-2"><a class="fs-6" href="./product-list.html">Sản phẩm</a></li>
                        <li class="my-2"><a class="fs-6" href="#">Khuyến mãi</a></li>
                        <li class="my-2"><a class="fs-6" href="#">Thành viên</a></li>
                        <li class="my-2"><a class="fs-6" href="#">Cẩm nang</a></li>
                    </ul>
                </div>
                <div class="col">
                    <h3 class="text-main">Hỗ trợ</h3>
                    <ul class="list-unstyled mt-2">
                        <li class="my-2"><a class="fs-6" href="#">Chính sách bảo mật</a></li>
                        <li class="my-2"><a class="fs-6" href="#">Bảo hành đổi trả hàng</a></li>
                        <li class="my-2"><a class="fs-6" href="#">Chính sách thanh toán</a></li>
                        <li class="my-2"><a class="fs-6" href="#">Câu hỏi thường gặp</a></li>
                        <li class="my-2"><a class="fs-6" href="#">Điều khoản điều kiện</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h3 class="text-main">Đăng ký</h3>
                    <p class="mt-2 fs-6">Đăng ký để nhận thông tin khuyến mãi mới nhất</p>
                    <form class="d-flex px-3 px-md-0">
                        <input type="text" class="form-control me-2" placeholder="Email của bạn" />
                        <button class="btn btn-main" type="submit"><i class="fas fa-paper-plane"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </footer>

<!-- jQuery -->


<script src="/template/admin/js/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="/template/js/script.js"></script>
<script src="/template/js/single-product.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{asset('static/js/news.js')}}"></script>

<!-- //////tìm kiếm/////////////////// -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

<script>


$(document).ready(function() {
    $("#search_text").autocomplete({
        source: function(request, response) {
            $.ajax({
                url: "{{ route('timkiemajax') }}",
                data: {
                    term: request.term
                },
                dataType: "json",
                success: function(data) {
                    let suggestions = [];

                    // Displaying the number of products found
                    if (data.total > 0) {
                        suggestions.push({
                            label: `<div class="autocomplete-header text-muted">Tìm thấy ${data.total} sản phẩm</div>`,
                            value: ""
                        });
                    } else {
                        suggestions.push({
                            label: `<div class="autocomplete-header text-muted">Không tìm thấy sản phẩm nào</div>`,
                            value: ""
                        });
                    }

                    // Adding products to suggestion list
                    $.map(data.products, function(item) {
                        suggestions.push({
                            label: `
                                <div class="autocomplete-item d-flex align-items-center p-2">
                                    <img src="${item.thumb}" alt="${item.value}" class="item-image me-2 rounded" style="width: 50px; height: 50px; object-fit: cover;" />
                                    <div class="item-details flex-grow-1">
                                        <span class="item-name fw-bold">${item.value}</span><br>
                                        ${item.GiamGia > 0 ? `
                                            <span class="price item-price-original text-decoration-line-through text-muted">${formatPrice(item.Gia)}</span>
                                            <span class="price item-price-discounted text-danger ms-2">${formatPrice(item.GiamGia)}</span>`
                                        : `<span class="price item-price-discounted text-success">${formatPrice(item.Gia)}</span>`}
                                    </div>
                                </div>`,
                            value: item.value,
                            id: item.id
                        });
                    });

                    response(suggestions);
                }
            });
        },
        minLength: 1,
        select: function(event, ui) {
            console.log("Sản phẩm ID:", ui.item.id);
        }
    }).data("ui-autocomplete")._renderMenu = function(ul, items) {
        ul.addClass("list-group"); // Apply Bootstrap list-group to the menu
        $.each(items, function(index, item) {
            $("#search_text").autocomplete("instance")._renderItemData(ul, item);
        });
    };

    // Customize each item to use Bootstrap styling
    $("#search_text").autocomplete().data("ui-autocomplete")._renderItem = function(ul, item) {
        return $("<li>")
            .addClass("list-group-item") // Apply Bootstrap list-group-item to each item
            .append(item.label)
            .appendTo(ul);
    };

    $(document).on('click', '.ui-menu-item', function() {
        $('#search-form').submit();
    });
});

function formatPrice(price) {
    return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}
    
</script>



<script>
    // Lấy tất cả checkbox
    const checkboxesBrand = document.querySelectorAll('input[name="brand_id"]');
    const result = document.getElementById('selected-options');

    // Hàm xử lý sự kiện onchange cho brand_id
    function updateBrandOptions() {
        // Tạo một mảng chứa các giá trị được chọn
        const selectedValues = Array.from(checkboxesBrand)
                                    .filter(checkbox => checkbox.checked)
                                    .map(checkbox => checkbox.value);
        
        // Lấy URL hiện tại và chuyển thành một đối tượng URL
        const currentUrl = new URL(window.location.href);
        
        // Cập nhật hoặc xoá tham số 'brands'
        if (selectedValues.length > 0) {
            currentUrl.searchParams.set('brands', selectedValues.join(','));
        } else {
            currentUrl.searchParams.delete('brands');
        }
        
        // Cập nhật URL mà không ảnh hưởng đến các tham số khác
        window.location.href = currentUrl.toString();
    }

    // Gắn sự kiện onchange cho mỗi checkbox
    checkboxesBrand.forEach(checkbox => {
        checkbox.addEventListener('change', updateBrandOptions);
    });
</script>

<script>
    // Lấy tất cả checkbox
    const checkboxesGioiTinh = document.querySelectorAll('input[name="gioitinh_id"]');
  

    // Hàm xử lý sự kiện onchange cho brand_id
    function updateGioiTinhOptions() {
        // Tạo một mảng chứa các giá trị được chọn
        const selectedValues = Array.from(checkboxesGioiTinh)
                                    .filter(checkbox => checkbox.checked)
                                    .map(checkbox => checkbox.value);
        
        // Lấy URL hiện tại và chuyển thành một đối tượng URL
        const currentUrl = new URL(window.location.href);
        
        // Cập nhật hoặc xoá tham số 'brands'
        if (selectedValues.length > 0) {
            currentUrl.searchParams.set('gioitinh', selectedValues.join(','));
        } else {
            currentUrl.searchParams.delete('gioitinh');
        }
        
        // Cập nhật URL mà không ảnh hưởng đến các tham số khác
        window.location.href = currentUrl.toString();
    }

    // Gắn sự kiện onchange cho mỗi checkbox
    checkboxesGioiTinh.forEach(checkbox => {
        checkbox.addEventListener('change', updateGioiTinhOptions);
    });
</script>
<script>
    // Lấy tất cả checkbox
    const checkboxesDotuoi = document.querySelectorAll('input[name="dotuoi_id"]');

    // Hàm xử lý sự kiện onchange cho dotuoi_id
    function updateDotuoiOptions() {
        // Tạo một mảng chứa các giá trị được chọn
        const selectedValues = Array.from(checkboxesDotuoi)
                                    .filter(checkbox => checkbox.checked)
                                    .map(checkbox => checkbox.value);
        
        // Lấy URL hiện tại và chuyển thành một đối tượng URL
        const currentUrl = new URL(window.location.href);
        
        // Cập nhật hoặc xoá tham số 'dotuoi'
        if (selectedValues.length > 0) {
            currentUrl.searchParams.set('dotuoi', selectedValues.join(','));
        } else {
            currentUrl.searchParams.delete('dotuoi');
        }
        
        // Cập nhật URL mà không ảnh hưởng đến các tham số khác
        window.location.href = currentUrl.toString();
    }

    // Gắn sự kiện onchange cho mỗi checkbox
    checkboxesDotuoi.forEach(checkbox => {
        checkbox.addEventListener('change', updateDotuoiOptions);
    });
</script>

<script>
    function updateOrderby(selectElement) {
        // Lấy giá trị của `orderby` từ tùy chọn đã chọn
        const orderby = selectElement.value;
        
        // Lấy URL hiện tại và tạo một đối tượng URL
        const currentUrl = new URL(window.location.href);
        
        // Cập nhật hoặc xoá tham số 'orderby'
        if (orderby) {
            currentUrl.searchParams.set('orderby', orderby);
        } else {
            currentUrl.searchParams.delete('orderby');
        }
        
        // Cập nhật URL mà không ảnh hưởng đến các tham số khác
        window.location.href = currentUrl.toString();
    }
</script>

