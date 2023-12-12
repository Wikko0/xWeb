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
                                <h3 class="card-title">Information Manage</h3>
                            </div>
                            <form method="post" action="{{ route('adminpanel/information') }}">
                                @csrf
                                @foreach($informationProvider as $values)
                                    <div class="card-body">
                                        <input type="hidden" class="form-control" id="id" name="id" value="{{ $values->id }}">
                                        <div class="form-group">
                                            <label for="sname">Server Name</label>
                                            <input type="text" class="form-control" id="sname" name="sname" value="{{ $values->sname }}">
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="version">Version</label>
                                                <select id="version" name="version" class="form-control">
                                                    <option value="97d+99i" @if($values->version == '97d+99i') selected @endif>97d+99i</option>
                                                    <option value="99b" @if($values->version == '99b') selected @endif>99b</option>
                                                    <option value="1.0M" @if($values->version == '1.0M') selected @endif>1.0M</option>
                                                    <option value="Season I" @if($values->version == 'Season I') selected @endif>Season I</option>
                                                    <option value="Season II" @if($values->version == 'Season II') selected @endif>Season II</option>
                                                    <option value="Season III" @if($values->version == 'Season III') selected @endif>Season III</option>
                                                    <option value="Season IV" @if($values->version == 'Season IV') selected @endif>Season IV</option>
                                                    <option value="Season V" @if($values->version == 'Season V') selected @endif>Season V</option>
                                                    <option value="Season VI" @if($values->version == 'Season VI') selected @endif>Season VI</option>
                                                    <option value="Season VII" @if($values->version == 'Season VII') selected @endif>Season VII</option>
                                                    <option value="Season IIX" @if($values->version == 'Season IIX') selected @endif>Season IIX</option>
                                                    <option value="Season IX" @if($values->version == 'Season IX') selected @endif>Season IX</option>
                                                    <option value="Season X" @if($values->version == 'Season X') selected @endif>Season X</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="exp">Experience</label>
                                            <input type="number" class="form-control" id="exp" name="exp" value="{{ $values->experience }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="drop">Drop rate</label>
                                            <input type="number" class="form-control" id="drop" name="drop" value="{{ $values->droprate }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="zen">Zen rate</label>
                                            <input type="number" class="form-control" id="zen" name="zen" value="{{ $values->zenrate }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="ppl">Points Per Level</label>
                                            <input type="text" class="form-control" id="ppl" name="ppl" value="{{ $values->ppl }}">
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
