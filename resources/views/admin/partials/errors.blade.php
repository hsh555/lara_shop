@if (count($errors) >= 1)
    <div class="alert alert-danger" role="alert">
        <ul class="m-0" style="font-size: 14px">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
