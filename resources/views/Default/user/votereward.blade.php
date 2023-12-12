@extends('Default.layout.default')

@section('content')

    @include('Default.block.rightblock')

    <main class="content">
        <h1>Vote Reward</h1>

        @include('Default.block.alert')

        @foreach($output as $op)
        {!! $op !!}
        @endforeach

    </main>
    <!-- content -->

@endsection
