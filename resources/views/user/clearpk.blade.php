@extends('layout.default')

@section('content')

    @include('block.rightblock')

    <main class="content">
       <h1>Clear PK</h1>

        @include('block.alert')

        <form method="post" action="{{route('clear-pk')}}">
            @csrf
            <select name="char">
                <option value="">Select Character</option>
            @foreach($characterMiddleware as $chars)

                <option value={{$chars->Name}}>{{$chars->Name}}: {{$pk->pkLevel($chars->PkLevel)}}</option>

            @endforeach
            </select>
            <p><button class="big">Clear PK</button></p>
        </form>
            @foreach($pkClearProvider as $values)
            <div class="notification information">
                <div>Information for PK Clear

                    <li><b>Zen per kill</b> - {{$values->zen}}</li>
                </div>
            </div>
            @endforeach
    </main><!-- content -->
@endsection
