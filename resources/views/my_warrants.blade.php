@extends('layouts.sidebar')

@section('content')
<div class="container-fluid my-2">
    <div class="row">
        <div class="col-md-12">
            <div class="card rounded-0">
                <div class="card-header rounded-0 bg-dark text-white">My Arrest Warrants</div>
                @if(count($arrest_warrants) === 0)
                <p class="my-auto p-3">There are no arrest warrants of yours at the moment.</p>
                @else
                <div class="card-body rounded-0">
                    <table class="table table-borderless table-striped table-hover">
                        <thead class="bg-white text-black border-none">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Suspect</th>
                                <th scope="col">Type</th>
                                <th scope="col">Status</th>
                                <th scope="col">Submitted</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($arrest_warrants as $arrest_warrant)
                            <tr>
                                <th scope="row">{{ $arrest_warrant->id }}</th>
                                <td>
                                    <a href="/warrants/arrest/details/{{ $arrest_warrant->id }}">{{ $arrest_warrant->name }}</a>
                                </td>
                                <td>{{ $arrest_warrant->type }}</td>
                                <td>
                                    @if($arrest_warrant->active === 1)
                                    <p class="fw-bold text-warning my-auto">Pending</p>
                                    @elseif($arrest_warrant->active === 2)
                                    <p class="fw-bold text-success my-auto">Active</p>
                                    @else
                                    <p class="fw-bold text-danger my-auto">Closed</p>
                                    @endif
                                </td>
                                <td>{{ \Carbon\Carbon::parse($arrest_warrant->created_at)->diffForHumans() }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $arrest_warrants->links() }}
                </div>
                @endif
            </div>

            <div class="card rounded-0 mt-4">
                <div class="card-header rounded-0 bg-dark text-white">My Search Warrants</div>
                @if(count($search_warrants) === 0)
                    <p class="my-auto p-3">There are no search warrants of yours at the moment.</p>
                @else
                <div class="card-body rounded-0">
                <table class="table table-borderless table-striped table-hover">
                        <thead class="bg-white text-black border-none">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Property</th>
                                <th scope="col">Status</th>
                                <th scope="col">Submitted</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($search_warrants as $search_warrant)
                            <tr>
                                <th scope="row">{{ $search_warrant->id }}</th>
                                <td>
                                    <a href="/warrants/search/details/{{ $search_warrant->id }}">{{ $search_warrant->property }}</a>
                                </td>
                                <td>
                                    @if($search_warrant->active === 1)
                                    <p class="fw-bold text-warning my-auto">Pending</p>
                                    @elseif($search_warrant->active === 2)
                                    <p class="fw-bold text-success my-auto">Active</p>
                                    @else
                                    <p class="fw-bold text-danger my-auto">Closed</p>
                                    @endif
                                </td>
                                <td>{{ \Carbon\Carbon::parse($search_warrant->created_at)->diffForHumans() }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $search_warrants->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection