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
                                <h3 class="card-title">Rename Character Settings</h3>
                            </div>
                            <form method="post" action="{{ route('adminpanel/rename') }}">
                                @csrf
                                @foreach($renameProvider as $values)
                                    <div class="card-body">
                                        <input type="hidden" name="id" value="{{$values->id}}">
                                        <div class="form-group">
                                            <label for="credits">Need credits for change name</label>
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
