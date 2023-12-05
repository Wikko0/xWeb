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
                                <h3 class="card-title">Paypal Package</h3>
                            </div>
                            <form method="post" action="{{ route('adminpanel/paypal-pack') }}">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Package name</label>
                                        <input type="text" class="form-control" id="name" name="name">
                                    </div>
                                    <div class="form-group">
                                        <label for="amount">Amount</label>
                                        <input type="number" class="form-control" id="amount" name="amount">
                                    </div>
                                    <div class="form-group">
                                        <label for="credits">Credits Reward</label>
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
                            @foreach($paypal_pack as $values)
                                <form method="post" action="{{ route('adminpanel/paypal-pack') }}">
                                    @method('DELETE')
                                    @csrf
                                    <div class="card-body">
                                        <div class="input-group input-group-lg mb-3">
                                            <div class="input-group-prepend">
                                                <button class="btn btn-danger dropdown-toggle" data-toggle="dropdown">Action</button>
                                                <ul class="dropdown-menu">
                                                    <button type="submit" class="dropdown-item">Delete</button>
                                                </ul>
                                            </div>
                                            <input type="text" readonly class="form-control" name="name[]" value="{{ $values->name }}">
                                            <input type="text" readonly class="form-control" value="{{ $values->amount }}$">
                                            <input type="text" readonly class="form-control" value="{{ $values->credits }} Credits">
                                            <input type="hidden" class="form-control" name="id[]" value="{{ $values->id }}">
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
