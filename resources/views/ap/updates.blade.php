@extends('layout.ap')

@section('content')

    <div class="content-wrapper">
    @include('ap_block.admin_header')
        <section class="content">
            <div class="container-fluid">
                @include('ap_block.alert')
                <form method="post" action="{{route('adminpanel/updates')}}">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-outline card-info">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        Add Update News
                                    </h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="NewsTitle">News Title</label>
                                        <input type="text" max="50" class="form-control" name="title">
                                    </div>
                                    <div class="form-group">
                                        <label for="Prefix">Prefix</label>
                                        <input type="text" max="10" class="form-control" name="prefix">
                                    </div>
                                    <textarea id="summernote" name="news">
                                Place <em>some</em> <u>text</u> <strong>here</strong>
                            </textarea>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary col-12">Post News</button>
                                </div>
                            </div>
                        </div>
                        <!-- /.col-->
                    </div>
                </form>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <!-- seo form elements -->
                        <div class="card card-outline card-info">
                            <div class="card-header">
                                <h3 class="card-title">
                                    All Update News
                                </h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            @foreach($new_updates as $key => $values)
                                <form method="post" action="{{route('adminpanel/updates')}}">
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
                                            <input type="hidden" name="id[]" value="{{$values->id}}">
                                            <input type="text" readonly class="form-control" name="name"
                                                   value="{{$values->subject}}">
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

@push('scripts')

    <script src="{{ asset('admin/js/slimselect.min.js') }}"></script>
    <script>
        setTimeout(function () {
            new SlimSelect({
                select: '#select'
            });
        }, 300);
    </script>
    <!-- Summernote -->
    <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script>
        $(function () {
            // Summernote
            $('#summernote').summernote();
            // CodeMirror
            CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
                mode: "htmlmixed",
                theme: "monokai"
            });
        });
    </script>
@endpush
