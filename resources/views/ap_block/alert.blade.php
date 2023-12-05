<div class="col-md-12">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;
            </button>
            <h5><i class="icon fas fa-check"></i> Alert!</h5>
            <ul>{{session('success')}}</ul>
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;
            </button>
            <h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
            @foreach ($errors->all() as $error)
                <ul>{{ $error }}</ul>
            @endforeach
        </div>
    @endif
</div>
