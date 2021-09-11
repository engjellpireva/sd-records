@extends('layouts.sidebar')

@section('content')
<div class="container-fluid my-2">
    <div class="row">
        <div class="col-md-12">
            <div class="card rounded-0">
                <div class="card-header rounded-0 bg-dark text-white">Logs</div>

                <div class="card-body rounded-0">
                <form method="GET" action="/logs">
                    <div class="input-group mb-3">
                        <input type="text" name="keyword" id="keyword" class="form-control rounded-0" placeholder="Search by username or action" value="{{ request()->query('keyword') }}" required autocomplete="keyword">
                        <button type="submit" class="input-group-text btn-success rounded-0"><i class="bi bi-search"></i>Search</button>
                    </div>
                </form>
                <table class="table table-borderless table-striped table-hover">
                    <thead class="bg-white text-black">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">User</th>
                            <th scope="col">Action</th>
                            <th scope="col">Date</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        @forelse($logs as $log)
                        <tr>
                            <th scope="row">{{ $log->id }}</th>
                            <td>{{ $log->username }}</td>
                            <td>{{ $log->action }}</td>
                            <td>{{ \Carbon\Carbon::parse($log->created_at)->diffForHumans() }}</td>
                        </tr>
                        @empty
                        <p class="my-auto text-muted">No results found for <strong>{{ request()->query('keyword') }}</strong></p>
                        @endforelse
                        </tbody>
                    </table>
                    {{ $logs->appends(['keyword' => request()->query('keyword')])->links() }}
                </div>
            </div>
        </div>
    </div>
</div>


@endsection