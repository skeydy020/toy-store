<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Autocomplete Example</title>
   
</head>
<body>

<div class="col-md-5 my-auto">
                <form id="search-form" action="{{ url('/tim-kiem') }}" method="POST">
                    @csrf
                    <div class="input-group">
                        <input type="text" name="search_product" id="search_text" class="form-control" placeholder="Tìm kiếm sản phẩm...">
                        <button type="submit" name="searchbtn" class="input-group-text" id="basic-addon2">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                </form>
            </div>
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
                    response(data);
                }
            });
        },
        minLength: 1,
    });

    $(document).on('click', '.ui-menu-item', function() {
        $('#search-form').submit();
    });
});
</script>

</body>
</html>
