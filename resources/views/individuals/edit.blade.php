@extends('layouts.sidebar')

@section('content')
<div class="container-fluid my-2">
    <div class="row">
        <div class="col-md-12">
            <div class="card rounded-0">
                <div class="card-header rounded-0 bg-dark text-white">Edit Individual - {{ $individual->name }}</div>

                <div class="card-body rounded-0">
                    <form method="POST" action="/individuals/edit/{{ $individual->id }}">
                        @csrf
                        <div class="form-group my-auto">
                            <label for="name" class="col-md-4 col-form-label">Individual Name:</label>
                            <div class="col-md-12">
                                <input type="text" id="name" name="name" value="{{ $individual->name }}" placeholder="{{ $individual->name }}" class="form-control rounded-0" value="{{ old('name') }}" required>
                            </div>
                        </div>

                        <div class="form-group my-auto">
                            <label for="image" class="col-md-4 col-form-label">Picture:</label>
                            <div class="col-md-12">
                                <input type="text" id="image" name="image" value="{{ $individual->image }}" placeholder="{{ $individual->image }}" class="form-control rounded-0" value="{{ old('image') }}" required>
                            </div>
                        </div>

                        <div class="form-group my-auto">
                            <label for="alias" class="col-md-4 col-form-label">Alias/Nickname:</label>
                            <div class="col-md-12">
                                <input type="text" id="alias" name="alias" value="{{ $individual->alias }}" placeholder="{{ $individual->alias}}" class="form-control rounded-0" value="{{ old('alias') }}">
                            </div>
                        </div>

                        <div class="form-group my-auto">
                            <label for="age" class="col-md-4 col-form-label">Age:</label>
                            <div class="col-md-12">
                                <input type="number" id="age" name="age" value="{{ $individual->age }}" placeholder="{{ $individual->age }}" class="form-control rounded-0" value="{{ old('age') }}">
                            </div>
                        </div>

                        <div class="form-group my-auto">
                            <label for="address" class="col-md-4 col-form-label">Address:</label>
                            <div class="col-md-12">
                                <input type="text" id="address" name="address" value="{{ $individual->address }}" placeholder="{{ $individual->address }}" class="form-control rounded-0" value="{{ old('address') }}">
                            </div>
                        </div>

                        <div class="form-group my-auto">
                            <label for="gender" class="col-md-4 col-form-label">Gender:</label>
                            <div class="col-md-12">
                                <select name="gender" id="gender" class="form-select rounded-0">
                                    <option selected>Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group my-auto">
                            <label for="race" class="col-md-4 col-form-label">Race:</label>
                            <div class="col-md-12">
                                <select name="race" id="race" class="form-select rounded-0">
                                    <option selected>White</option>
                                    <option value="Black">Black</option>
                                    <option value="Hispanic">Hispanic</option>
                                    <option value="Asian">Asian</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group my-auto">
                            <label for="number" class="col-md-4 col-form-label">Phone Number:</label>
                            <div class="col-md-12">
                                <input type="number" id="number" name="number" value="{{ $individual->number }}" placeholder="{{ $individual->number }}" class="form-control rounded-0" value="{{ old('number') }}">
                            </div>
                        </div>

                        <div class="form-group my-auto">
                            <label for="description" class="col-md-4 col-form-label">Description:</label>
                            <div class="col-md-12">
                                <input type="text" id="description" name="description" value="{{ $individual->description }}" placeholder="{{ $individual->description }}" class="form-control rounded-0" value="{{ old('description') }}" required>
                            </div>
                        </div>

                        <div class="form-group my-auto">
                            <label for="gang" class="col-md-4 col-form-label">Gang:</label>
                            <div class="col-md-12">
                                <select name="gang" id="gang" class="form-select rounded-0">
                                    <option selected>None</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group my-auto">
                            <div class="col-md-12">
                                <input type="submit" class="btn btn-dark rounded-0 mt-3 col-12" value="Edit">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection