@extends('layout.ap')

@section('content')
    <div class="content-wrapper">
        @include('ap_block.admin_header')
        <section class="content">
            <div class="container-fluid">
                @include('ap_block.alert')
                <form method="post" action="{{ route('adminpanel/add-information') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-outline card-info">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        Add Information
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <textarea id="summernote" name="information">@if($checkinfo) @foreach($checkinfo as $values){{ $values->information }}@endforeach @else Place <em>some</em> <u>text</u> <strong>here</strong> @endif</textarea>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary col-12">Post Information</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
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
    <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script>
        $(function () {
            $('#summernote').summernote();
            CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
                mode: "htmlmixed",
                theme: "monokai"
            });
        });
    </script>
@endpush
