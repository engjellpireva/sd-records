@extends('layouts.sidebar')

@section('content')
<div class="container-fluid my-2">
    <div class="row">
        <div class="col-md-12">
            <div class="card rounded-0">
                <div class="card-header rounded-0 bg-dark text-white">Create a New Role</div>

                <div class="card-body">
                    <form action="/admin/role/create" method="POST">
                        @csrf

                        @if(session('success'))
                        <div class="form-group my-auto">
                            <div class="col-md-12">
                                <div class="d-flex justify-content-between rounded-0 alert alert-success alert-dismissable fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close my-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </div>
                        </div>
                        @endif

                        <div class="form-group my-auto">
                            <label for="roleName" class="col-md-4 col-form-label">Role Name:</label>
                            <div class="col-md-12">
                                <input type="text" id="roleName" name="roleName" placeholder="Role" class="form-control rounded-0" value="{{ old('roleName') }}" required>
                            </div>
                        </div>

                        <div class="form-group my-auto">
                            <div class="col-md-12">
                                <input type="submit" class="btn btn-dark rounded-0 mt-3 col-12" value="Create Role">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection