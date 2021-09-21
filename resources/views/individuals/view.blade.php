@extends('layouts.sidebar')

@section('content')
<div class="container-fluid my-2">
    <div class="row">
        <div class="col-md-12">
            <div class="card rounded-0">
                <div class="card-header rounded-0 bg-dark text-white">View Individuals</div>
                    <div class="card-body rounded-0">
                        <form method="GET" action="/individuals/view">
                            <div class="input-group mb-3">
                                <input type="text" name="keyword" id="keyword" class="form-control rounded-0" placeholder="Search by name or creator" value="{{ request()->query('keyword') }}" required autocomplete="keyword">
                                <button type="submit" class="input-group-text btn-success rounded-0"><i class="bi bi-search"></i>Search</button>
                            </div>
                        </form>

                        <table class="table table-borderless table-striped table-hover">
                            <thead class="bg-white text-black border-none">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Created By</th>
                                    <th scope="col">Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($individuals as $individual)
                                <tr>
                                    <th scope="row">{{ $individual->id }}</th>
                                    <td>
                                        <a href="/individuals/view/{{ $individual->id }}">
                                            {{ $individual->name }}
                                        </a>
                                    </td>
                                    <td>{{ $individual->publisher }}</td>
                                    <td>{{ \Carbon\Carbon::parse($individual->created_at)->diffForHumans() }}</td>
                                </tr>
                                @empty
                                <p class="my-auto p-3">There are no individuals in our records.</p>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $individuals->appends(['keyword' => request()->query('keyword')])->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection