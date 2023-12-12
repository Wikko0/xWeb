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
                                <h3 class="card-title">Grand Reset Settings</h3>
                            </div>
                            <form method="post" action="{{ route('adminpanel/grand-reset') }}">
                                @csrf
                                @foreach($grandResetProvider as $values)
                                    <div class="card-body">
                                        <input type="hidden" name="id" value="{{$values->id}}">
                                        <div class="form-group">
                                            <label for="resets">Required Resets</label>
                                            <input type="number" class="form-control" id="resets" name="resets" value="{{$values->resets}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="level">Required Level</label>
                                            <input type="number" class="form-control" id="level" name="level" value="{{$values->level}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="zen">Zen for GReset</label>
                                            <input type="number" class="form-control" id="zen" name="zen" value="{{$values->zen}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="maxgresets">Max Grand Resets</label>
                                            <input type="number" class="form-control" id="maxgresets" name="maxgresets" value="{{$values->maxgresets}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="credits">Credits Reward</label>
                                            <input type="number" class="form-control" id="credits" name="credits" value="{{$values->credits}}">
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
