@extends('Admin.layout.ap')

@section('content')
    <div class="content-wrapper">
    @include('Admin.includes.header')
        <section class="content">
            <div class="container-fluid">
                @include('Admin.includes.alert')

                <div class="row">
                    <div class="col-md-12">
                        <!-- Download form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Download Settings</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form method="post" action="{{ route('adminpanel/download') }}">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="FileName">File Name</label>
                                        <input type="text" class="form-control" id="name" name="name">
                                    </div>

                                    <div class="form-group">
                                        <label for="FileMB">File MB</label>
                                        <input type="number" class="form-control" id="mb" name="mb">
                                    </div>

                                    <div class="form-group">
                                        <label for="Link">Link</label>
                                        <input type="url" class="form-control" id="link" name="link">
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Version</label>
                                            <select name="version" id="version" class="form-control">
                                                <option value="full">Full Version</option>
                                                <option value="lite">Lite Version</option>
                                                <option value="update">Update</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>From</label>
                                            <select name="site" id="site" class="form-control">
                                                <option value="mega">MEGA</option>
                                                <option value="google">Google Drive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary col-12">Submit</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Download Links -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">All Download Links</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            @foreach($downloadProvider as $values)
                                <form method="post" action="{{route('adminpanel/download')}}">
                                    @method('DELETE')
                                    @csrf
                                    <div class="card-body">
                                        <div class="input-group input-group-lg mb-3">
                                            <div class="input-group-prepend">
                                                <button class="btn btn-danger dropdown-toggle" data-toggle="dropdown">
                                                    Action
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <button type="submit" class="dropdown-item">Delete</button>
                                                </ul>
                                            </div>
                                            <!-- /btn-group -->
                                            <input type="text" readonly class="form-control" name="name[]" value="{{ $values->name }}">
                                            <input type="text" readonly class="form-control" value="{{ $values->mb }}MB">
                                            <input type="text" readonly class="form-control" value="{{ $values->link }}">
                                            <input type="hidden" class="form-control" name="id[]" value="{{ $values->id }}">
                                        </div>
                                    </div>
                                </form>
                        @endforeach
                        <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
