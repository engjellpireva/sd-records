@extends('layouts.sidebar')

@section('content')
<div class="container-fluid my-2">
    <div class="row">
        <div class="col-md-12">
            <div class="card rounded-0">
                <div class="card-header rounded-0 bg-dark text-white">New Search Warrant</div>

                <div class="card-body rounded-0">
                    <form method="POST" action="/warrants/search/create">
                        @csrf
                        <div class="form-group my-auto">
                            <label for="address" class="col-md-4 col-form-label">Address / Property:</label>
                            <div class="col-md-12">
                                <input type="text" id="address" name="address" placeholder="Address / Property" class="form-control rounded-0" value="{{ old('name') }}" required>
                            </div>
                        </div>

                        <div class="form-group my-auto">
                            <label for="items" class="col-md-4 col-form-label mt-1">Illegal Items:</label>
                            <div class="col-md-12">
                                <textarea name="items" id="items" cols="30" rows="5" class="form-control rounded-0"></textarea>
                            </div>
                        </div>

                        <div class="form-group my-auto">
                            <label for="narrative" class="col-md-4 col-form-label mt-1">Narrative / Evidence:</label>
                            <div class="col-md-12">
                                <textarea name="narrative" id="narrative" cols="30" rows="5" class="form-control rounded-0"></textarea>
                            </div>
                        </div>

                        <div class="form-group my-auto">
                            <div class="col-md-12">
                                <input type="submit" class="btn btn-dark rounded-0 mt-3 col-12" value="Create Search Warrant">
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection