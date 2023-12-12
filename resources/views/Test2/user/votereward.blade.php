@extends('Test2.layout.default')

@section('content')

    @include('Test2.block.rightblock')

    <main class="content">
        <h1>Vote Reward</h1>

        @include('Test2.block.alert')

        @foreach($output as $op)
            {!! $op !!}
        @endforeach

    </main>
    <!-- content -->

@endsection
