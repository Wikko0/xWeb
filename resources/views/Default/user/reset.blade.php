@extends('Default.layout.default')

@section('content')

    @include('Default.block.rightblock')

    <main class="content">
        <h1>Reset Character</h1>

        @include('Default.block.alert')

        <form method="post" action="{{route('reset')}}">
            @csrf
            <select name="char">
                <option value="">Select Character</option>
                @foreach($characterMiddleware as $chars)
                    <option value={{$chars->Name}}>{{$chars->Name}}: {{$chars->cLevel}} Level, {{$chars->Resets}}
                        Resets
                    </option>

                @endforeach
            </select>
            <p>
                <button class="big">Reset Character</button>
            </p>
        </form>
        @foreach($resetProvider as $values)
            <div class="notification information">
                <div>Information for Reset character
                    <li><b>Reset level</b> - {{$values->level}}</li>
                    <li><b>Reset Zen</b> - {{$values->zen}} zen x <i>Reset Number</i></li>
                    @foreach($charactersProvider as $character)
                        @if($character->class == 'Blade Knight' && $character->status == 'Yes')
                            <li><b>Reset Points [Blade Knight]</b> - {{$values->bkpoints}}</li>
                        @endif
                        @if($character->class == 'Soul Master' && $character->status == 'Yes')
                            <li><b>Reset Points [Soul Master]</b> - {{$values->smpoints}}</li>
                        @endif
                        @if($character->class == 'Muse Elf' && $character->status == 'Yes')
                            <li><b>Reset Points [Muse Elf]</b> - {{$values->elfpoints}}</li>
                        @endif
                        @if($character->class == 'Magic Gladiator' && $character->status == 'Yes')
                            <li><b>Reset Points [Magic Gladiator]</b> - {{$values->mgpoints}}</li>
                        @endif
                        @if($character->class == 'Dark Lord' && $character->status == 'Yes')
                            <li><b>Reset Points [Dark Lord]</b> - {{$values->dlpoints}}</li>
                        @endif
                        @if($character->class == 'Rage Fighter' && $character->status == 'Yes')
                            <li><b>Reset Points [Rage Fighter]</b> - {{$values->rfpoints}}</li>
                        @endif
                        @if($character->class == 'Grow Lancer' && $character->status == 'Yes')
                            <li><b>Reset Points [Grow Lancer]</b> - {{$values->glpoints}}</li>
                        @endif
                    @endforeach
                    <li><b>Max Reset</b> - {{$values->maxresets}}</li>
                    <li><b>Check character for items</b> - No</li>
                    <li><b>Clear Inventory</b> - No</li>
                    <li><b>Clear Magic List</b> - No</li>
                    <li><b>Clear Quest</b> - No</li>
                </div>
            </div>
        @endforeach
    </main><!-- content -->

@endsection
