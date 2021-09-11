@extends('layouts.sidebar')

@section('content')
<div class="container-fluid my-2">
    <div class="row">
        <div class="col-md-12">
            <div class="card rounded-0">
                <div class="card-header rounded-0 bg-dark text-white">{{ __('Home') }}</div>

                <div class="card-body rounded-0">
                    <div class="alert alert-danger rounded-0" role="alert">
                        <p class="fw-bold my-auto">
                            <i class="fas fa-exclamation-triangle"></i>
                            System Alert
                        </p>
                        This is the official release of SDRecords. If you encounter any bugs, please reach out to <strong>Pireva</strong> on Discord.
                    </div>

                    <h4 class="fw-bold my-auto border-bottom py-2">Statistics</h4>
                    <div class="row col-12 p-2 ms-1 gap-4 justify-content-around">
                        <div class="col-md-2 p-4">
                            <h2 class="my-auto fs-1 text-center">{{ $pending->count() }}</h2>
                            <p class="my-auto text-uppercase fw-bold text-center text-nowrap">Warrant Applications</p>
                        </div>
                        <div class="col-md-2 p-4">
                            <h2 class="my-auto fs-1 text-center">{{ $active->count() }}</h2>
                            <p class="my-auto text-uppercase fw-bold text-center">Open Warrants</p>
                        </div>
                        <div class="col-md-2 p-4">
                            <h2 class="my-auto fs-1 text-center">{{ $closed->count() }}</h2>
                            <p class="my-auto text-uppercase fw-bold text-center">Closed Warrants</p>
                        </div>
                        <div class="col-md-2 p-4">
                            <h2 class="my-auto fs-1 text-center">55</h2>
                            <p class="my-auto text-uppercase fw-bold text-center">Individuals</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
