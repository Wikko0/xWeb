@extends('Admin.layout.ap')

@section('content')
    <div class="content-wrapper">
        @include('Admin.includes.header')

        <section class="content">
            <div class="container-fluid">
                @include('Admin.includes.alert')
                <div class="row">

                    <div class="col-md-12">
                        <!-- seo form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Admin User Configuration</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form method="post" action="{{route('adminpanel/panel')}}">
                                @csrf
                                @foreach($adminProvider as $values)
                                <div class="card-body">
                                    <input type="hidden" class="form-control" id="id" name="id" value="{{$values->id}}">
                                    <div class="form-group">
                                        <label for="AdminName">Admin Name</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{$values->admin}}">
                                    </div>

                                    <div class="form-group">
                                        <label for="AdminPassword">Admin Password</label>
                                        <input type="text" class="form-control" id="password" name="password" value="{{$values->password}}">
                                    </div>
                                @endforeach

                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary col-12">Submit</button>
                                </div>
                                </div>
                            </form>
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
