@if(session('success'))
    <div class="notification success">

        <div>
            <li>{{session('success')}}</li>

        </div>
    </div>
@endif
@if ($errors->any())
    <div class="notification error">
        <div>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </div>
    </div>
@endif
