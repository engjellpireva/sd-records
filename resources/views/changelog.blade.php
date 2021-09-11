@extends('layouts.sidebar')

@section('content')
<div class="container-fluid my-2">
    <div class="row">
        <div class="col-md-12">
            <div class="card rounded-0">
                <div class="card-header rounded-0 bg-dark text-white">Changelog</div>

                <div class="card-body rounded-0">
                    <h4 class="my-auto">Latest Site Updates</h4>
                    <p class="my-auto text-muted border-bottom py-2">Release notes for new features and updates.</p>

                    @foreach($changelogs as $changelog)
                    <div class="mt-2">
                        <div class="d-flex">
                            <i class="fas fa-newspaper my-auto me-1"></i>
                            <p class="my-auto text-black">{{ $changelog->body }}</p>
                        </div>
                        <p class="mt-1 my-auto blockquote-footer">{{ $changelog->publisher }}, {{ \Carbon\Carbon::parse($changelog->created_at)->diffForHumans() }}</p>
                    </div>
                    @endforeach
                    <div class="mt-3">
                        {{ $changelogs->links() }}
                    </div>
                </div>
            </div>
            
            @hasrole('Supervisor|Administrator')
            <div class="card rounded-0 mt-5">
                <div class="card-header rounded-0 bg-dark text-white">Add new changelog</div>

                <div class="card-body rounded-0">
                    <form method="POST" action="/changelog/add" class="d-flex flex-column">
                        @csrf
                        <label for="body">Description:</label>
                        <textarea name="body" id="body" cols="30" rows="5"></textarea>
                        <input type="submit" class="btn btn-dark rounded-0" value="Submit">
                    </form>
                </div>
            </div>
            @endhasrole
        </div>
    </div>
</div>
@endsection