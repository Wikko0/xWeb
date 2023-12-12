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
                                <h3 class="card-title">Reset Stats Settings</h3>
                            </div>
                            <form method="post" action="{{ route('adminpanel/reset-stats') }}">
                                @csrf
                                @foreach($resetStatsProvider as $values)
                                    <div class="card-body">
                                        <input type="hidden" name="id" value="{{$values->id}}">
                                        <div class="form-group">
                                            <label for="credits">Need credits for reset stats</label>
                                            <input type="number" class="form-control" id="credits" name="credits" value="{{$values->credits}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="zen">Need zen for reset stats</label>
                                            <input type="number" class="form-control" id="zen" name="zen" value="{{$values->zen}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="level">Required Level</label>
                                            <input type="number" class="form-control" id="level" name="level" value="{{$values->level}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="resets">Required Resets</label>
                                            <input type="number" class="form-control" id="resets" name="resets" value="{{$values->resets}}">
                                        </div>
                                    </div>
                                @endforeach
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
