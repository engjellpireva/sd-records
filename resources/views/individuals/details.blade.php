@extends('layouts.sidebar')

@section('content')
<div class="container-fluid my-2">
    <div class="row">
        <div class="col-md-12">
            <div class="card rounded-0">
                <div class="d-flex justify-content-between my-auto card-header rounded-0 bg-dark text-white">
                    <p class="my-auto">Individual Details - {{ $individual->name }}</p>
                    @if($individual->publisher_id === Auth::id())
                        <a href="/individuals/edit/{{ $individual->id }}" type="button" class="btn btn-light rounded-0 my-auto">
                            Edit Individual
                        </a>
                    @endif
                </div>

                <div class="card-body">
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
                    <div class="card rounded-0">
                        <img class="p-3" src="{{ $individual->image }}" alt="Image" style="width: 320px;">
                        <div class="card-body">
                            <p class="my-auto">Suspect Name: <strong>{{ $individual->name }}</strong></p>
                            <p class="my-auto">Suspect Age: <strong>{{ $individual->age }}</strong></p>
                            <p class="my-auto">Suspect Alias: <strong>{{ $individual->alias }}</strong></p>
                            <p class="my-auto">Suspect Address: <strong>{{ $individual->address }}</strong></p>
                            <p class="my-auto">Suspect Gender: <strong>{{ $individual->gender }}</strong></p>
                            <p class="my-auto">Suspect Race: <strong>{{ $individual->race }}</strong></p>
                            <p class="my-auto">Suspect Number: <strong>{{ $individual->number }}</strong></p>
                            <p class="my-auto">Suspect Description: <strong>{{ $individual->description }}</strong></p>
                            <p class="my-auto">Suspect Gang: <strong>{{ $individual->gang }}</strong></p>
                            <hr />
                            <p class="my-auto">Submitted By: <strong>{{ $individual->publisher }}</strong></p>
                            <p class="my-auto">Submitted: <strong>{{ \Carbon\Carbon::parse($individual->created_at)->diffForHumans() }}</strong></p>
                        </div>
                    </div>
                </div>

                <div class="card rounded-0 mt-4">
                    <div class="card-header rounded-0 bg-dark text-white">Comments</div>

                    <div class="card-body rounded-0">
                        @foreach($comments as $comment)
                        <div class="py-2 border-bottom mb-4">
                            <div class="d-flex justify-content-between mb-2">
                                <h5 class="fw-bold my-auto">
                                    {{ $comment->username }}
                                </h5>
                                <p class="text-muted my-auto">{{ \Carbon\Carbon::parse($comment->created_at)->diffForHumans() }}</p>
                            </div>
                            <p class="my-auto">{{ $comment->comment }}</p>
                        </div>
                        @endforeach
                        <hr />
                    <p>Add Comment</p>
                    <form method="POST" action="/individuals/view/{{ $individual->id }}/add">
                        @csrf
                            <textarea textarea name="comment" class="col-12 border rounded-0" id="comment" cols="30" rows="7" required></textarea>
                            <input type="submit" class="mt-2 col-12 btn btn-dark rounded-0" value="Submit">
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection