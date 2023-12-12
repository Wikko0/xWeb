@extends('layout.default')

@section('content')

    @include('block.rightblock')

    <main class="content">
        <h1>Buy VIP</h1>

        @include('block.alert')

        @foreach($vipProvider as $value)
            <form action="{{route('getvip')}}" method="post">

                @csrf
                <input type="hidden" name="days" value="{{$value->days}}">
                <input type="hidden" name="credits" value="{{$value->credits}}">
                <div class="buyvip-heading">
                    <h4 class="buyvip-title">

                        <span>{{$value->name}}</span>
                        <span>{{$value->days}} Days</span>
                        <span>{{$value->credits}} Credits</span>
                        <span> <button type="submit" class="buyvipbutton">Get VIP</button> </span>
                    </h4>
                </div>
            </form>
        @endforeach
    </main><!-- content -->
@endsection
