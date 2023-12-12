@extends('Default.layout.default')

@section('content')

    @include('Default.block.rightblock')

    <main class="content">
        <h1>Add Stats</h1>

        @include('Default.block.alert')

        <form method="post" action="{{route('add-stats')}}">
            @csrf
            <select name="char">
                <option value="">Select Character</option>
                @foreach($characterMiddleware as $chars)
                    <option value="{{ $chars->Name }}">{{ $chars->Name }}: {{ $chars->cLevel }} Level, {{ $chars->LevelUpPoint }} Points</option>
                @endforeach
            </select>
            <p><input type="number" name="str" placeholder="Strength"></p>
            <p><input type="number" name="agi" placeholder="Dexterity"></p>
            <p><input type="number" name="vit" placeholder="Vitality"></p>
            <p><input type="number" name="ene" placeholder="Energy"></p>
            <p><input type="number" name="com" placeholder="Command"></p>
            <p><button class="big">Add Stats</button></p>
        </form>

    </main><!-- content -->
@endsection
