@extends('admin.main')


@section('content')
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Thumb</th>
                <th>Active</th>
                <th>Update</th> 
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>     
            {!! \App\Helper\Helper::menu($menus) !!}
        </tbody>

    </table>

    <a href="/admin/menus/add" class="button">Thêm danh mục</a>
@endsection