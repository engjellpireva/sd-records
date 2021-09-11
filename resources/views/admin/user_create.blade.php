@extends('layouts.sidebar')

@section('content')
<div class="container-fluid my-2">
    <div class="row">
        <div class="col-md-12">
            <div class="card rounded-0">
                <div class="card-header rounded-0 bg-dark text-white">Create a New User</div>

                <div class="card-body">
                    <form action="/admin/user/create" method="POST">
                        @csrf
                        <div class="form-group my-auto">
                            <label for="name" class="col-md-4 col-form-label">Full Name:</label>
                            <div class="col-md-12">
                                <input type="text" id="name" name="name" placeholder="Firstname Lastname" class="form-control rounded-0" value="{{ old('name') }}" required>
                            </div>
                        </div>

                        <div class="form-group my-auto">
                            <label for="password" class="col-md-4 col-form-label">Password:</label>
                            <div class="col-md-12">
                                <input type="password" id="password" name="password" placeholder="Password" class="form-control rounded-0" value="{{ old('name') }}" required>
                            </div>
                        </div>

                        <div class="form-group my-auto">
                            <label for="role" class="col-md-4 col-form-label">Role:</label>
                            <div class="col-md-12">
                                <select name="role" id="role" class="form-control rounded-0" required>
                                    <option selected>Supervisor</option>
                                    <option value="Administrator">Administrator</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group my-auto">
                            <div class="col-md-12">
                                <input type="submit" class="btn btn-dark rounded-0 mt-3 col-12" value="Create User">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection