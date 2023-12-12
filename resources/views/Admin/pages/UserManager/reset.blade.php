@extends('Admin.layout.ap')

@section('content')
    <div class="content-wrapper">
        @include('Admin.includes.header')
        <section class="content">
            <div class="container-fluid">
                @include('Admin.includes.alert')
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Reset Settings</h3>
                            </div>
                            <form method="post" action="{{ route('adminpanel/reset') }}">
                                @csrf
                                @foreach($resetProvider as $values)
                                    <input type="hidden" name="id" value="{{ $values->id }}">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="maxresets">Max Resets</label>
                                            <input type="number" class="form-control" id="maxresets" name="maxresets" value="{{ $values->maxresets }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="level">Reset Level</label>
                                            <input type="number" class="form-control" id="level" name="level" value="{{ $values->level }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="zen">Zen for Reset</label>
                                            <input type="number" class="form-control" id="zen" name="zen" value="{{ $values->zen }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="bkpoints">Blade Knight Points</label>
                                            <input type="number" class="form-control" id="bkpoints" name="bkpoints" value="{{ $values->bkpoints }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="smpoints">Soul Master Points</label>
                                            <input type="number" class="form-control" id="smpoints" name="smpoints" value="{{ $values->smpoints }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="elfpoints">Elf Points</label>
                                            <input type="number" class="form-control" id="elfpoints" name="elfpoints" value="{{ $values->elfpoints }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="mgpoints">Magic Gladiator Points</label>
                                            <input type="number" class="form-control" id="mgpoints" name="mgpoints" value="{{ $values->mgpoints }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="dlpoints">Dark Lord Points</label>
                                            <input type="number" class="form-control" id="dlpoints" name="dlpoints" value="{{ $values->dlpoints }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="sumpoints">Summoner Points</label>
                                            <input type="number" class="form-control" id="sumpoints" name="sumpoints" value="{{ $values->sumpoints }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="rfpoints">Rage Fighter Points</label>
                                            <input type="number" class="form-control" id="rfpoints" name="rfpoints" value="{{ $values->rfpoints }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="glpoints">Grow Lancer Points</label>
                                            <input type="number" class="form-control" id="glpoints" name="glpoints" value="{{ $values->glpoints }}">
                                        </div>
                                        @endforeach
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
