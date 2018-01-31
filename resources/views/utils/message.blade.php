@if ($errors->any())
    <div class="alert alert-danger row message-custom alert-custom">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="alert alert-{!! Session::get('flash_level') !!} row alert-custom">
    {!! Session::get('flash_message') !!}
</div>

