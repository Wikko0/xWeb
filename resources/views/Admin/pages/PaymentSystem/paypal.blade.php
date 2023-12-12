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
                                <h3 class="card-title">Paypal Manage</h3>
                            </div>
                            <form method="post" action="{{ route('adminpanel/paypal') }}">
                                @csrf
                                @foreach($paypalProvider as $values)
                                    <div class="card-body">
                                        <input type="hidden" name="id" value="{{$values->id}}">
                                        <div class="form-group">
                                            <label for="clientId">Client ID</label>
                                            <input type="text" class="form-control" id="clientId" name="client_id" value="{{$values->client_id}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="clientSecret">Client Secret</label>
                                            <input type="text" class="form-control" name="client_secret" id="clientSecret" value="{{$values->client_secret}}">
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="currency">Currency</label>
                                                <select id="currency" name="currency" class="form-control">
                                                    <option value="USD">USD</option>
                                                    <option value="EUR">EUR</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
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
