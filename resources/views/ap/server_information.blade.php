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
                                <h3 class="card-title">Server Information</h3>
                            </div>

                            <form method="post" action="{{ route('adminpanel/server-information') }}">
                                @csrf
                                @foreach($webInformationProvider as $values)
                                    <input type="hidden" name="id" value="{{ $values->id }}">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="ServerName">Server Name</label>
                                            <input type="text" class="form-control" name="sname" value="{{ $values->sname }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="WebsiteTitle">Title</label>
                                            <input type="text" class="form-control" name="stitle" value="{{ $values->stitle }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="Description">Description</label>
                                            <input type="text" class="form-control" name="sdescription" value="{{ $values->sdescription }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="Keywords">Keywords</label>
                                            <input type="text" class="form-control" name="skeywords" value="{{ $values->skeywords }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="WebsiteUrl">Website Url</label>
                                            <input type="url" class="form-control" name="surl" value="{{ $values->surl }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="ForumUrl">Forum Url</label>
                                            <input type="url" class="form-control" name="sforum" value="{{ $values->sforum }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="DiscordUrl">Discord Url</label>
                                            <input type="url" class="form-control" name="sdiscord" value="{{ $values->sdiscord }}">
                                        </div>
                                        @endforeach
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
