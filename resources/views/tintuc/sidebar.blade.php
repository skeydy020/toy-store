
<div class="col-md-4 side_bar mt-4" id="sidebar">   
    <div class="sidebar-title">DANH MỤC BÀI VIẾT</div>
    <ul>
        @foreach($danhmuctins as $key => $danhmuctin)
            <li>
                <a href="{{ route('tin-tuc', 'danhmucid=' . $danhmuctin->id) }}" class="">{{ $danhmuctin->name }}</a>
            </li>
        @endforeach
    </ul>
</div>