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
                                <h3 class="card-title">PK Clear Settings</h3>
                            </div>
                            <form method="post" action="{{ route('adminpanel/pk-clear') }}">
                                @csrf
                                @foreach($pkClearProvider as $values)
                                    <div class="card-body">
                                        <input type="hidden" name="id" value="{{$values->id}}">
                                        <div class="form-group">
                                            <label for="zen">Zen per kill</label>
                                            <input type="number" class="form-control" id="zen" name="zen" value="{{$values->zen}}">
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
