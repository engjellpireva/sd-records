@extends('layouts.sidebar')

@section('content')
<div class="container-fluid my-2">
    <div class="row">
        <div class="col-md-12">
            <div class="card rounded-0">
                <div class="card-header rounded-0 bg-dark text-white">New Arrest Warrant</div>

                <div class="card-body rounded-0">
                    <form method="POST" action="/warrants/arrest/create">
                        @csrf
                        <div class="form-group my-auto">
                            <label for="name" class="col-md-4 col-form-label">Suspect Name:</label>
                            <div class="col-md-12">
                                <input type="text" id="name" name="name" placeholder="Firstname Lastname" class="form-control rounded-0" value="{{ old('name') }}" required>
                            </div>
                        </div>

                        <div class="form-group my-auto">
                            <label for="alias" class="col-md-4 col-form-label mt-1">Alias/Nickname:</label>
                            <div class="col-md-12">
                                <input type="text" id="alias" name="alias" placeholder="Alias/Nickname" class="form-control rounded-0" value="{{ old('name') }}">
                            </div>
                        </div>

                        <div class="form-group my-auto">
                            <label for="age" class="col-md-4 col-form-label mt-1">Age:</label>
                            <div class="col-md-12">
                                <input type="number" id="age" name="age" placeholder="Age" class="form-control rounded-0" value="{{ old('name') }}">
                            </div>
                        </div>

                        <div class="form-group my-auto">
                            <label for="gender" class="col-md-4 col-form-label mt-1">Gender:</label>
                            <div class="col-md-12">
                                <select name="gender" id="gender" class="form-select rounded-0" required>
                                    <option selected>Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group my-auto">
                            <label for="race" class="col-md-4 col-form-label mt-1">Race:</label>
                            <div class="col-md-12">
                                <select name="race" id="race" class="form-select rounded-0" required>
                                    <option selected>White</option>
                                    <option value="Black">Black</option>
                                    <option value="Hispanic">Hispanic</option>
                                    <option value="Asian">Asian</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group my-auto">
                            <label for="number" class="col-md-4 col-form-label mt-1">Phone Number:</label>
                            <div class="col-md-12">
                                <input type="number" id="number" name="number" placeholder="Phone Number" class="form-control rounded-0" value="{{ old('name') }}">
                            </div>
                        </div>

                        <div class="form-group my-auto">
                            <label for="description" class="col-md-4 col-form-label mt-1">Suspect Description:</label>
                            <div class="col-md-12">
                                <input type="text" id="description" name="description" placeholder="Description (e.g: Overweight, Bulky, Tall, Short)" class="form-control rounded-0" value="{{ old('name') }}">
                            </div>
                        </div>

                        <div class="form-group my-auto">
                            <label for="date" class="col-md-4 col-form-label mt-1">Date and Time:</label>
                            <div class="col-md-12">
                                <input type="text" id="date" name="date" placeholder="DD/MM/YYYY HH:MM" class="form-control rounded-0" value="{{ old('date') }}">
                            </div>
                        </div>
                        
                        <div class="form-group my-auto">
                            <label for="narrative" class="col-md-4 col-form-label mt-1">Narrative:</label>
                            <div class="col-md-12">
                                <textarea id="narrative" name="narrative" placeholder="Narrative" class="form-control rounded-0" rows="5" cols="50" value="{{ old('narrative') }}"></textarea>
                            </div>
                        </div>
                        
                        <div class="form-group my-auto">
                            <label for="type" class="col-md-4 col-form-label mt-1">Type:</label>
                            <div class="col-md-12">
                                <select name="type" id="type" class="form-select rounded-0" required>
                                    <option selected>Low-Risk</option>
                                    <option value="Higk-Risk">High-Risk</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group my-auto">
                            <div class="col-md-12">
                                <input type="submit" class="btn btn-dark rounded-0 mt-3 col-12" value="Create Arrest Warrant">
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection