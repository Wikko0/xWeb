@extends('Default.layout.default')

@section('content')

    @include('Default.block.rightblock')

    <main class="content">
        <h1>Rename Character</h1>

        @include('Default.block.alert')

        <form method="post" action="{{route('rename')}}">
            @csrf
            <select name="char">
                <option value="">Select Character</option>
            @foreach($characterMiddleware as $chars)

                <option value={{$chars->Name}}>{{$chars->Name}}</option>

            @endforeach
            </select>
            <p><input type="text" name="name" placeholder="Choose a new name"></p>
            <p><button class="big">Rename Character</button></p>
        </form>
            @foreach($renameProvider as $values)
            <div class="notification information">
                <div>Information for Rename Character

                    <li><b>Credits for change name</b> - {{$values->credits}}</li>
                </div>
            </div>
            @endforeach
    </main><!-- content -->
@endsection
