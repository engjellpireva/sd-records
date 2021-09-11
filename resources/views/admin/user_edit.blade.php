@extends('layouts.sidebar')

@section('content')
<div class="container-fluid my-2">
    <div class="row">
        <div class="col-md-12">
            <div class="card rounded-0">
                <div class="card-header rounded-0 bg-dark text-white">Managing User <strong>{{ $user->name }}</strong></div>

                <div class="card-body rounded-0">
                    <form method="POST" action="/admin/user/manage/{{ $user->id }}">
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
                            <label for="name" class="col-md-4 col-form-label">Change Name:</label>
                            <div class="col-md-12">
                                <input type="text" id="name" name="name" placeholder="{{ $user->name }}" class="form-control rounded-0">
                            </div>
                        </div>

                        <div class="form-group my-auto">
                            <label for="password" class="col-md-4 col-form-label">Change Password:</label>
                            <div class="col-md-12">
                                <input type="password" id="password" name="password" placeholder="Password..." class="form-control rounded-0">
                            </div>
                        </div>

                        <div class="form-group my-auto">
                            <label for="role" class="col-md-4 col-form-label">Change Role:</label>
                            <div class="col-md-12">
                                <select name="role" id="role" class="form-control rounded-0">
                                    <option selected>Supervisor</option>
                                    <option value="Administrator">Administrator</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group my-auto">
                            <div class="col-md-12">
                                <input type="submit" class="btn btn-dark rounded-0 mt-3 col-12" value="Update User">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection