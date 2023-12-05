@extends('layout.default')

@section('content')

    @include('block.rightblock')

    <main class="content">

            <h1>Rename Character</h1>

        @include('block.alert')

        <form method="post" action="{{route('rename')}}">
            @csrf
            <select name="char">
                <option value="">Select Character</option>
            @foreach($char as $chars)

                <option value={{$chars->Name}}>{{$chars->Name}}</option>

            @endforeach
            </select>
            <p><input type="text" name="name" placeholder="Choose a new name"></p>
            <p><button class="big">Rename Character</button></p>
        </form>
            @foreach($rename as $values)
            <div class="notification information">
                <div>Information for Rename Character

                    <li><b>Credits for change name</b> - {{$values->credits}}</li>
                </div>
            </div>
            @endforeach
    </main><!-- content -->
@endsection
