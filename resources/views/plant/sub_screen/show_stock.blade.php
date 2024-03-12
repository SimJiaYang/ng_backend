@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <h5 class="card-header">Plant Stock History</h5>
                <div class="card m-3">
                    @foreach ($plant as $plants)
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <p class="fw-normal mb-1">Current Inventory: &nbsp;</p>
                                <p class="fw-bold mb-1">{{ $plants->quantity }} Item</p>
                            </div>
                            <div class="d-flex align-items-center">
                                <p class="fw-normal mb-1">Last updated at:: {{ $plants->updated_at }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="card-body">
                    @foreach ($plant as $plants)
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="table-light">
                                    <tr>
                                        <th class="text-truncate">ID</th>
                                        <th class="text-truncate">Reason</th>
                                        <th class="text-truncate">Quantity</th>
                                        <th class="text-truncate">Unit Price</th>
                                        <th class="text-truncate">Created At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($stock) < 1)
                                        <tr>
                                            <td class="text-truncate">
                                                <p class="fw-normal mb-1">History no found.</p>
                                            </td>
                                        </tr>
                                    @else
                                        @foreach ($stock as $stocks)
                                            <tr>
                                                {{-- ID --}}
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <p class="fw-bold mb-1">{{ $stocks->id }}</p>
                                                    </div>
                                                </td>

                                                {{-- Reason --}}
                                                <td class="text-truncate">
                                                    <p class="fw-normal mb-1">
                                                        {{ $stocks->reason }}
                                                    </p>
                                                </td>

                                                {{-- Quantity --}}
                                                <td class="text-truncate">
                                                    {{ $stocks->quantity }}</p>
                                                </td>

                                                {{-- Price --}}
                                                <td class="text-truncate">
                                                    <p class="fw-normal mb-1">{{ $stocks->unit_price }}</p>
                                                </td>

                                                {{-- Create Ar --}}
                                                <td class="text-truncate">
                                                    <p class="fw-normal mb-1">{{ $stocks->created_at }}</p>
                                                </td>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                            <div class="col-md-12 mt-3">
                                <a href="{{ route('plant.index') }}" class="btn btn-primary" value="Back">Back</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>

    </div>

    <!--/ Data Tables -->
    <div class="m-4 d-flex justify-content-between">
        {!! $stock->render() !!}
    </div>
@endsection
