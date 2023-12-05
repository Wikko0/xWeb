@extends('layout.default')

@section('content')

@include('block.rightblock')

<main class="content">
    <h1>Information</h1>

    <div>
        @foreach($addinfo as $values)
            {!! $values->information !!}
        @endforeach
    </div>


@foreach($information as $values)
    <div class="information-table">
        <ul>
            <li>
                SERVER INFORMATION
            </li>

            <li>Server name <span>{{$values->sname}}</span> </li>
            <li>Version <span>{{$values->version}}</span> </li>
            <li>Experience <span>{{$values->experience}}</span> </li>
            <li>Drop Rate <span>{{$values->droprate}}</span> </li>
            <li>Zen Drop <span>{{$values->zenrate}}</span> </li>
            <li>Points Per Level <span>{{$values->ppl}}</span> </li>

        </ul>

    </div>
    @endforeach
    <div class="information-table">
        <ul>
            <li>
                STATISTICS
            </li>

            <li>Total Accounts <span>{{$countAcc}}</span> </li>
            <li>Total Characters <span>{{$countChar}}</span> </li>
            <li>Total Guilds <span>{{$countGuild}}</span> </li>
            <li>Players Online <span style="color: #00bb00">{{$countOnline}}</span> </li>


        </ul>

    </div>

</main><!-- content -->

@endsection
