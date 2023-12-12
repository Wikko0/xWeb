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
                                <h3 class="card-title">Announce Settings</h3>
                            </div>

                            <form method="post" action="{{route('adminpanel/announce')}}">
                                @csrf
                                <div class="card-body">
                                    <div class="btn-group btn-group-toggle mb-5" data-toggle="buttons">
                                        <label class="mr-5" for="Status">Status</label>
                                        <label class="btn bg-olive">
                                            <input type="radio" name="status" id="option_b1" value="1" autocomplete="off" @if ($announce_config && $announce_config->status==1) checked @endif> On
                                        </label>
                                        <label class="btn btn-secondary">
                                            <input type="radio" name="status" id="option_b2" value="2" @if ($announce_config && $announce_config->status==2) checked @endif> Off
                                        </label>
                                    </div>

                                    <div class="form-group">
                                        <label>Date and time:</label>
                                        <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                                            <input type="datetime" class="form-control datetimepicker-input" data-target="#reservationdatetime" value="{{date('m/d/Y h:i A', strtotime($announce_config->date ?? null))}}" name="date"/>
                                            <div class="input-group-append" data-target="#reservationdatetime" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="AnnounceTitle">Announce Title</label>
                                        <input type="text" max="50" class="form-control" id="title" name="title" placeholder="{{$announce_config->title ?? 'Enter Title'}}" value="{{$announce_config->title ?? null}}">
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

@push('scripts')

    <!-- Select2 -->
    <script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
    <!-- Bootstrap4 Duallistbox -->
    <script src="{{asset('plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js')}}"></script>
    <!-- InputMask -->
    <script src="{{asset('plugins/inputmask/jquery.inputmask.min.js')}}"></script>
    <!-- bootstrap color picker -->
    <script src="{{asset('plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>
    <!-- Bootstrap Switch -->
    <script src="{{asset('plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>
    <!-- BS-Stepper -->
    <script src="{{asset('plugins/bs-stepper/js/bs-stepper.min.js')}}"></script>
    <!-- dropzonejs -->
    <script src="{{asset('plugins/dropzone/min/dropzone.min.js')}}"></script>

    <!-- Page specific script -->
    <script>
        $(function () {
            $('.select2').select2();
            $('.select2bs4').select2({ theme: 'bootstrap4' });
            $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });
            $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' });
            $('[data-mask]').inputmask();
            $('#reservationdate').datetimepicker({ format: 'L' });
            $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });
            $('#reservation').daterangepicker();
            $('#reservationtime').daterangepicker({
                timePicker: true,
                timePickerIncrement: 30,
                locale: { format: 'MM/DD/YYYY hh:mm A' }
            });
            $('#daterange-btn').daterangepicker(
                {
                    ranges   : {
                        'Today'       : [moment(), moment()],
                        'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
                        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                        'This Month'  : [moment().startOf('month'), moment().endOf('month')],
                        'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                    },
                    startDate: moment().subtract(29, 'days'),
                    endDate  : moment()
                },
                function (start, end) {
                    $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
                }
            );
            $('#timepicker').datetimepicker({ format: 'LT' });
            $('.duallistbox').bootstrapDualListbox();
            $('.my-colorpicker1').colorpicker();
            $('.my-colorpicker2').colorpicker().on('colorpickerChange', function(event) {
                $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
            });
            $("input[data-bootstrap-switch]").each(function(){
                $(this).bootstrapSwitch('state', $(this).prop('checked'));
            });
        });

        document.addEventListener('DOMContentLoaded', function () {
            window.stepper = new Stepper(document.querySelector('.bs-stepper'));
        });

        Dropzone.autoDiscover = false;
        var previewNode = document.querySelector("#template");
        previewNode.id = "";
        var previewTemplate = previewNode.parentNode.innerHTML;
        previewNode.parentNode.removeChild(previewNode);

        var myDropzone = new Dropzone(document.body, {
            url: "/target-url",
            thumbnailWidth: 80,
            thumbnailHeight: 80,
            parallelUploads: 20,
            previewTemplate: previewTemplate,
            autoQueue: false,
            previewsContainer: "#previews",
            clickable: ".fileinput-button"
        });

        myDropzone.on("addedfile", function(file) {
            file.previewElement.querySelector(".start").onclick = function() { myDropzone.enqueueFile(file); };
        });

        myDropzone.on("totaluploadprogress", function(progress) {
            document.querySelector("#total-progress .progress-bar").style.width = progress + "%";
        });

        myDropzone.on("sending", function(file) {
            document.querySelector("#total-progress").style.opacity = "1";
            file.previewElement.querySelector(".start").setAttribute("disabled", "disabled");
        });

        myDropzone.on("queuecomplete", function(progress) {
            document.querySelector("#total-progress").style.opacity = "0";
        });

        document.querySelector("#actions .start").onclick = function() {
            myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED));
        };

        document.querySelector("#actions .cancel").onclick = function() {
            myDropzone.removeAllFiles(true);
        };
    </script>
@endpush
