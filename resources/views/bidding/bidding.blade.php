@extends('layouts.app')

@section('content')
    {{-- Session Message --}}
    @if (Session::has('error'))
        <div class="alert alert-danger" role="alert">
            {{ Session::get('error') }}
        </div>
        {{ session()->forget('error') }}
    @endif
    @if (Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
        {{ session()->forget('success') }}
    @endif

    <p class="display-5">Biddings</p>

    <!-- Search -->
    <form action="" method="POST">
        @csrf
        <div class="navbar-nav align-items-left">
            <div class="nav-item d-flex align-items-left">
                <i class="mdi mdi-magnify mdi-24px lh-0"></i>
                <input type="search" class="form-control border-0 shadow-none bg-body" id="name" name="name"
                    placeholder="Search..." aria-label="Search..." />
            </div>
        </div>
    </form>

    <!-- Data Tables -->
    <div class="col-12 mt-3">
        <div class="card">
            <div class="table-responsive">
                <table class="table">
                    <thead class="table-light">
                        <tr>
                            <th class="text-truncate">ID</th>
                            <th class="text-truncate">Image</th>
                            <th class="text-truncate">Name</th>
                            <th class="text-truncate">Initial Amount</th>
                            <th class="text-truncate">Minimal Amount</th>
                            <th class="text-truncate">Highest Amount</th>
                            <th class="text-truncate">Winner ID</th>
                            <th class="text-truncate">Start Time</th>
                            <th class="text-truncate">End Time</th>
                            <th class="text-truncate">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($bidding) < 1)
                            <tr>
                                <td class="text-truncate">
                                    <p class="fw-normal mb-1">Data no found.</p>
                                </td>
                            </tr>
                        @else
                            @foreach ($bidding as $biddings)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <p class="fw-bold mb-1">{{ $biddings->id }}</p>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('plant_image') }}/{{ $biddings->image }}" class="img-fluid"
                                                style="height:100px; width:100px; object-fit: contain;">
                                        </div>
                                    </td>


                                    <td class="text-truncate">
                                        <p class="fw-normal mb-1">{{ Str::limit($biddings->name, 10) }}</p>
                                    </td>
                                    <td class="text-truncate">
                                        <p class="fw-normal mb-1">{{ $biddings->intial_amt }}</p>
                                    </td>
                                    <td class="text-truncate">
                                        <p class="fw-normal mb-1">{{ $biddings->min_amt }}</p>
                                    </td>
                                    <td class="text-truncate">
                                        <p class="fw-normal mb-1">{{ $biddings->highest_amt }}</p>
                                    </td>
                                    <td class="text-truncate">
                                        <p class="fw-normal mb-1">
                                            {{ $biddings->winner_id == null ? '-' : $biddings->winner_id }}
                                        </p>
                                    </td>

                                    <td class="text-truncate">
                                        <p class="fw-normal mb-1">{{ $biddings->start_time }}</p>
                                    </td>
                                    <td class="text-truncate">
                                        <p class="fw-normal mb-1">{{ $biddings->end_time }}</p>
                                    </td>
                                    <td class="text-truncate">
                                        <p class="fw-normal mb-1">{{ $biddings->bidding_status }}</p>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
