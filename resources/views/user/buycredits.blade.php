@extends('layout.default')

@section('content')

    @include('block.rightblock')

    <main class="content">
    <h1>Buy Credits</h1>

        @include('block.alert')

        @foreach($paypalPackProvider as $value)
            <form action="{{route('pay')}}" method="post">

                @csrf
                <input type="hidden" name="amount" value="{{$value->amount}}">
                <input type="hidden" name="credits" value="{{$value->credits}}">
                <div class="paypal-heading">
                    <h4 class="paypal-title">

                        <span>{{$value->name}}</span>
                        <span>{{$value->credits}} Credits</span>
                        <span> <button type="submit" class="paybutton">{{$value->amount}}$ BUY</button> </span>
                    </h4>
                </div>
            </form>
        @endforeach
    </main><!-- content -->
@endsection
