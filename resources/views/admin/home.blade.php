@extends('layouts.sidebar')

@section('content')
<div class="container-fluid my-2">
    <div class="row">
        <div class="col-md-12">
            <div class="card rounded-0">
                <div class="card-header rounded-0 bg-dark text-white">Administration Control Panel</div>

                <div class="card-body rounded-0">
                    <h4 class="my-auto border-bottom py-2">
                        <i class="fas fa-user"></i>
                        User Management
                    </h4>
                    <a href="/admin/user/create" class="btn btn-dark rounded-0 mt-2">Create a new user</a>
                    <a href="/admin/user/manage" class="btn btn-dark rounded-0 mt-2">Manage user</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection