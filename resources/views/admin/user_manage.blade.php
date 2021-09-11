@extends('layouts.sidebar')

@section('content')
<div class="container-fluid my-2">
    <div class="row">
        <div class="col-md-12">
            <div class="card rounded-0">
                <div class="card-header rounded-0 bg-dark text-white">Manage User(s)</div>
                
                <div class="card-body rounded-0">
                    <form method="GET" action="/admin/user/manage">
                        <div class="input-group mb-3">
                            <input type="text" name="user" id="user" class="form-control rounded-0" placeholder="Search by username or ID" value="{{ request()->query('user') }}" required autocomplete="user">
                            <button type="submit" class="input-group-text btn-success rounded-0"><i class="bi bi-search"></i>Search</button>
                        </div>
                    </form>

                    @if(session('success'))
                    <div class="d-flex justify-content-between alert rounded-0 alert-success alert-dismissable fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close my-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <table class="table col-md-12 table-borderless table-striped table-hover">
                        <thead class="bg-white text-black">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Username</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($users as $user)
                            <tr>
                                <th scope="row">{{ $user->id }}</th>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->created_at }}</td>
                                <td class="my-auto d-md-flex">
                                    <a href="/admin/user/manage/{{ $user->id }}" class="btn btn-dark rounded-0">Manage</a>
                                    <form method="POST" action="/admin/user/manage/delete/{{ $user->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" class="btn btn-danger ms-2 rounded-0" value="Delete User">
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <p class="my-auto text-muted">No results found for user <strong>{{ request()->query('user') }}</strong></p>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $users->appends(['user' => request()->query('user')])->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection