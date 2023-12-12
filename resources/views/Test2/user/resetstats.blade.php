@extends('Test2.layout.default')

@section('content')

    @include('Test2.block.rightblock')

    <main class="content">
        <h1>Reset Stats</h1>

        @include('Test2.block.alert')

        <form method="post" action="{{route('reset-stats')}}">
            @csrf
            <select name="char">
                <option value="">Select Character</option>
                @foreach($characterMiddleware as $chars)

                    <option value={{$chars->Name}}>{{$chars->Name}}</option>

                @endforeach
            </select>
            <p>
                <button class="big">Reset Stats</button>
            </p>
        </form>
        @foreach($resetStatsProvider as $values)
            <div class="notification information">
                <div>Information for Reset Stats

                    <li><b>Credits for Reset Stats</b> - {{$values->credits}}</li>
                    <li><b>Zen for Reset Stats</b> - {{$values->zen}}</li>
                    <li><b>Required Level</b> - {{$values->level}}</li>
                    <li><b>Required Resets</b> - {{$values->resets}}</li>
                </div>
            </div>
        @endforeach
    </main><!-- content -->
@endsection
