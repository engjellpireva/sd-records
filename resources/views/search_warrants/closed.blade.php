@extends('layouts.sidebar')

@section('content')
<div class="container-fluid my-2">
    <div class="row">
        <div class="col-md-12">
            <div class="card rounded-0">
                <div class="card-header rounded-0 bg-dark text-white">Closed Search Warrants</div>
                @if(count($warrants) === 0)
                    <p class="my-auto p-3">There are no closed warrants at the moment.</p>
                @else
                <div class="card-body rounded-0">
                    <table class="table table-borderless table-striped table-hover">
                        <thead class="bg-white text-black border-none">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Address / Property</th>
                                <th scope="col">Submitted</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($warrants as $warrant)
                            <tr>
                                <th scope="row">{{ $warrant->id }}</th>
                                <td>
                                    <a href="/warrants/search/details/{{ $warrant->id }}">{{ $warrant->property }}</a>
                                </td>
                                <td> <p class="text-black my-auto">{{ \Carbon\Carbon::parse($warrant->created_at)->diffForHumans() }}</p></td>
                                <td>
                                    @if($warrant->active === 1)
                                    <p class="fw-bold text-warning my-auto">Pending</p>
                                    @elseif($warrant->active === 2)
                                    <p class="fw-bold text-success my-auto">Active</p>
                                    @else
                                    <p class="fw-bold text-danger my-auto">Closed</p>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection