@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $errors)
                <li>{{$errors}}</li>
            @endforeach
        </ul>

    </div>
@endif

@if (Session::has('error'))
    <div class="alert alert-danger">
        {{Session::get('error')}}
    </div>
@endif

@if (Session::has('error'))
    <div class="alert alert-success">
        {{Session::get('success')}}
    </div>
@endif
