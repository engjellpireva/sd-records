@extends('layouts.sidebar')

@section('content')
<div class="container-fluid my-2">
    <div class="row">
        <div class="col-md-12">
            <div class="card rounded-0">
                <div class="card-header rounded-0 bg-dark d-flex justify-content-between my-auto text-white">
                    <p class="my-auto">Search Warrant Details - {{ $warrant->id }}</p>
                    @hasrole('Supervisor|Administrator')
                    @if($warrant->active != 0 && $warrant->active != 2)
                    <div class="d-flex">
                        <form method="POST" action="/warrants/search/details/close/{{ $warrant->id }}">
                            @csrf
                            <button type="submit" class="btn btn-danger rounded-0 my-auto">Close</button>
                        </form>
                        <form method="POST" action="/warrants/search/details/approve/{{ $warrant->id }}">
                            @csrf
                            <button type="submit" class="btn btn-success ms-1 rounded-0 my-auto">Approve</button>
                        </form>
                    </div>
                    @elseif($warrant->active != 0)
                    <form method="POST" action="/warrants/search/details/close/{{ $warrant->id }}">
                        @csrf
                        <button type="submit" class="btn btn-danger rounded-0 my-auto">Close</button>
                    </form>
                    @else
                    <form method="POST" action="/warrants/search/details/approve/{{ $warrant->id }}">
                        @csrf
                        <button type="submit" class="btn btn-success rounded-0 my-auto">Reapprove</button>
                    </form>
                    @endif
                    @endhasrole
                </div>
                
                <div class="card-body">
                    <p class="my-auto">Submitted by: <strong>{{ $warrant->publisher }}</strong></p>
                    <p class="my-auto">Submitted: <strong>{{ \Carbon\Carbon::parse($warrant->created_at)->diffForHumans() }}</strong></p>
                    @if($warrant->active === 1)
                    <p class="my-auto">Status: <strong class="text-warning">Pending</strong></p>
                    @elseif($warrant->active === 2)
                    <p class="my-auto">Status: <strong class="text-success">Active</strong></p>
                    @else
                    <p class="my-auto">Status: <strong class="text-danger">Closed</strong></p>
                    @endif
                    <hr />
                    <p class="my-auto">Address / Property: <strong>{{ $warrant->property }}</strong></p>
                    <p class="my-auto">Illegal Items: <strong>{{ $warrant->items }}</strong></p>
                    <p class="my-auto">Evidence / Narrative: <strong>{{ $warrant->narrative }}</strong></p>
                </div>
            </div>

            <div class="card rounded-0 mt-4">
                <div class="card-header rounded-0 bg-dark text-white">Comments</div>
                <div class="card-body">
                    @foreach($comments as $comment)
                    <div class="py-2 border-bottom mb-4">
                        <div class="d-flex justify-content-between mb-2">
                            <h5 class="fw-bold my-auto">{{ $comment->username }}</h5>
                            <p class="text-muted my-auto">{{ \Carbon\Carbon::parse($comment->created_at)->diffForHumans() }}</p>
                        </div>
                        <p class="my-auto">{{ $comment->comment }}</p>
                    </div>
                    @endforeach
                    <hr />
                    <p>Add Comment</p>
                    <form method="POST" action="/warrants/search/comments/add/{{ $warrant->id }}">
                        @csrf
                        @if($warrant->active === 1 || $warrant->active === 0)
                            <textarea name="comment" placeholder="You can't add a comment on this warrant." class="col-12 rounded-0 border-0" id="comment" cols="30" rows="7" disabled></textarea>
                            <input type="submit" class="mt-2 col-12 btn btn-dark rounded-0" disabled value="Submit">
                        @else
                            <textarea textarea name="comment" class="rounded-0 border col-12" id="comment" cols="30" rows="7" required></textarea>
                            <input type="submit" class="mt-2 col-12 btn btn-dark rounded-0" value="Submit">
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection