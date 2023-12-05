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
                                <h3 class="card-title">VIP Package</h3>
                            </div>
                            <form method="post" action="{{ route('adminpanel/vip-pack') }}">
                                @csrf
                                <div class="card-body">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="name">Package name</label>
                                            <select id="name" name="name" class="form-control">
                                                <option value="VIP Bronze">VIP Bronze</option>
                                                <option value="VIP Silver">VIP Silver</option>
                                                <option value="VIP Gold">VIP Gold</option>
                                                <option value="VIP Platinum">VIP Platinum</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="days">Days</label>
                                        <input type="number" class="form-control" id="days" name="days">
                                    </div>
                                    <div class="form-group">
                                        <label for="credits">Credits</label>
                                        <input type="number" class="form-control" id="credits" name="credits">
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
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">All Packages</h3>
                            </div>
                            @foreach($vip_pack as $values)
                                <form method="post" action="{{ route('adminpanel/vip-pack') }}">
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
                                            <input type="text" readonly class="form-control" name="name[]" value="{{$values->name}}">
                                            <input type="text" readonly class="form-control" value="{{$values->days}} Days">
                                            <input type="text" readonly class="form-control" value="{{$values->credits}} Credits">
                                            <input type="hidden" class="form-control" name="id[]" value="{{$values->id}}">
                                        </div>
                                    </div>
                                </form>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
