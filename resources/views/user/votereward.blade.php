@extends('layout.default')

@section('content')

    @include('block.rightblock')

    <main class="content">

            <h1>Vote Reward</h1>
        @include('block.alert')

        @foreach($output as $op)
        {!! $op !!}
        @endforeach

    </main><!-- content -->

@endsection
