@extends('Admin.layout.ap')

@section('content')
    <div class="content-wrapper">
        @include('Admin.includes.header')
        <section class="content">
            <div class="container-fluid">
                @include('Admin.includes.alert')
                <form method="post" action="{{ route('adminpanel/vote-reward') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-default">
                                <div class="card-body">
                                    <div id="actions" class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="exampleInputFile">Upload Image</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="exampleInputFile" name="image">
                                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="link">Link</label>
                                        <input type="text" class="form-control" id="link" name="link">
                                    </div>
                                    <div class="form-group">
                                        <label for="zen">Zen Reward</label>
                                        <input type="number" class="form-control" id="zen" name="zen">
                                    </div>
                                    <div class="form-group">
                                        <label for="credits">Credits Reward</label>
                                        <input type="number" class="form-control" id="credits" name="credits">
                                    </div>
                                    <div class="form-group">
                                        <label for="time">Time (Hours)</label>
                                        <input type="number" class="form-control" id="time" name="time">
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary col-12">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <div class="col-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Vote Reward Package</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @foreach($voteProvider as $values)
                                        <div class="col-sm-4">
                                            <div class="position-relative" style="min-height: 180px;">
                                                <form method="post" action="{{ route('adminpanel/vote-reward') }}">
                                                    @method('DELETE')
                                                    @csrf
                                                    <input type="hidden" name="id[]" value="{{ $values->id }}">
                                                    <input type="hidden" name="image" value="{{ $values->image }}">
                                                    <img src="/images/{{ $values->image }}" alt="Image" class="img-fluid">
                                                    <div class="ribbon-wrapper ribbon-xl">
                                                        <button class="ribbon bg-danger text-xl">
                                                            Delete
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- Select2 -->
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- Bootstrap4 Duallistbox -->
    <script src="{{ asset('plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>
    <!-- InputMask -->
    <script src="{{ asset('plugins/inputmask/jquery.inputmask.min.js') }}"></script>
    <!-- bootstrap color picker -->
    <script src="{{ asset('plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
    <!-- Bootstrap Switch -->
    <script src="{{ asset('plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
    <!-- BS-Stepper -->
    <script src="{{ asset('plugins/bs-stepper/js/bs-stepper.min.js') }}"></script>
    <!-- dropzonejs -->
    <script src="{{ asset('plugins/dropzone/min/dropzone.min.js') }}"></script>
@endpush
