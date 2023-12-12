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
                                <h3 class="card-title">Template Settings</h3>
                            </div>

                            <form method="post" action="{{ route('adminpanel/template') }}">
                                @csrf
                                <div class="card-body">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Active Template</label>
                                        <select name="template" id="template" class="form-control">
                                            @foreach ($folders as $folder)
                                                <option value="{{ $folder }}" @if($folder == $templateProvider->active) selected @endif>{{ $folder }}</option>
                                            @endforeach
                                        </select>
                                    </div>
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
