<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">  {{ ucwords(str_replace('-', ' ', str_replace('adminpanel/', '', Route::currentRouteName()))) }}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('adminpanel/dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active"> {{ ucwords(str_replace('-', ' ', str_replace('adminpanel/', '', Route::currentRouteName()))) }}</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
