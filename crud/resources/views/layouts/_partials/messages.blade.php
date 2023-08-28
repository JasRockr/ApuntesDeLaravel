@if ($message = Session::get('success'))
    <div style="padding:15px; background-color:#55a855; color:white;">
        <p>{{ $message }}</p>
    </div>
@endif

@if ($message = Session::get('danger'))
    <div style="padding:15px; background-color:#ff6347; color:white;">
        <p>{{ $message }}</p>
    </div>
@endif
