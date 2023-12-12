@extends('Admin.layout.ap')

@section('content')
    <div class="content-wrapper">
    @include('Admin.includes.header')
        <section class="content">
            <div class="container-fluid">
                @include('Admin.includes.alert')

                <div class="row">
                    <div class="col-md-12">
                        <!-- Event form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Boss Settings</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form method="post" action="{{ route('adminpanel/boss') }}">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="EventName">Event Name</label>
                                        <input type="text" class="form-control" id="event" name="event">
                                    </div>

                                    <div class="form-group">
                                        <label for="EventDays">Event Days</label>
                                        <select name="days[]" id="select" multiple onchange="showDiv()">
                                            <optgroup label="Weekdays">
                                                <option value="0">Every Day</option>
                                                <option value="1">Monday</option>
                                                <option value="2">Tuesday</option>
                                                <option value="3">Wednesday</option>
                                                <option value="4">Thursday</option>
                                                <option value="5">Friday</option>
                                                <option value="6">Saturday</option>
                                                <option value="7">Sunday</option>
                                            </optgroup>
                                        </select>
                                    </div>

                                    <!-- Event hours for each day -->
                                    @foreach(['Every Day', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $index => $day)
                                        <div class="form-group" id="hidden_div{{ $index + 1 }}" style="display: none;">
                                            <label for="FileName">{{ $day }}</label>
                                            <input type="text" class="form-control" id="name" name="{{ strtolower($day) }}"
                                                   placeholder="Event hours on {{ $day }} separated with comma ( , ) Time format hh:mm (must be sorted by time asc)">
                                        </div>
                                    @endforeach
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
                        <!-- Active Events -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Active Events</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            @foreach($bossProvider['events']['event_timers'] as $key => $values)
                                <form method="post" action="{{ route('adminpanel/boss') }}">
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
                                            <input type="text" readonly class="form-control" name="name"
                                                   value="{{ $values['name'] }}">
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
    <!-- Weekday picker -->
    <script src="{{ asset('admin/js/slimselect.min.js') }}"></script>
    <script>
        setTimeout(function () {
            new SlimSelect({
                select: '#select'
            })
        }, 300)
    </script>

    <script>
        function showDiv() {
            var options = document.getElementById('select').selectedOptions;
            var values = Array.from(options).map(({ value }) => value);
            console.log(values);
            for (let i = 1; i <= 8; i++) {
                const div = document.getElementById('hidden_div' + i);
                if (values.includes((i - 1).toString())) {
                    div.style.display = 'block';
                } else {
                    div.style.display = 'none';
                }
            }
        }
    </script>
@endpush
