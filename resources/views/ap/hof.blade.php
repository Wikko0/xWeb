@extends('layout.ap')

@section('content')
    <div class="content-wrapper">
        @include('ap_block.admin_header')
        <section class="content">
            <div class="container-fluid">
                @include('ap_block.alert')
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Add HOF Characters</h3>
                            </div>
                            <form method="post" action="{{ route('adminpanel/hof') }}">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="CharName">Character</label>
                                        <input type="text" max="50" class="form-control" name="name">
                                    </div>
                                    <div class="form-group">
                                        <label for="Wins">Wins</label>
                                        <input type="number" max="100" class="form-control" name="wins">
                                    </div>
                                    <div class="form-group">
                                        <label>Custom Select</label>
                                        <select class="custom-select" name="class">
                                            @foreach($char as $options)
                                                @if($options->status == "Yes")
                                                    <option>{{ $options->class }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary col-12">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
