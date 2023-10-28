@extends('layouts.app')
@section('content')
    <p class="display-5">Orders</p>

    <!-- Search -->
    <form action="{{ route('order.search') }}" method="POST">
        @csrf
        <div class="navbar-nav align-items-left">
            <div class="nav-item d-flex align-items-left">
                <i class="mdi mdi-magnify mdi-24px lh-0"></i>
                <input type="search" class="form-control border-0 shadow-none bg-body" id="id" name="id"
                    placeholder="Search..." aria-label="Search..." />
            </div>
        </div>
    </form>

    <!--Label to Search -->
    <div class="col-12 mt-2 mb-2">
        <a href = "{{ route('order.index') }}" class="btn-sm btn btn-info m-1">All</a>
        <a href = "{{ route('order.filter', ['status' => 'pay']) }}" class="btn-sm btn btn-secondary m-1">To Pay</a>
        <a href = "{{ route('order.filter', ['status' => 'ship']) }}" class="btn-sm btn btn-warning m-1">To Ship</a>
        <a href = "{{ route('order.filter', ['status' => 'receive']) }}" class="btn-sm btn btn-primary m-1">To Receive</a>
        <a href = "{{ route('order.filter', ['status' => 'completed']) }}" class="btn-sm btn btn-success m-1">Completed</a>
        <a href = "{{ route('order.filter', ['status' => 'cancel']) }}" class="btn-sm btn btn-danger m-1">Cancel</a>
    </div>


    <!-- Data Tables -->
    <div class="col-12 mt-3">
        <div class="card">
            <div class="table-responsive">
                <table class="table">
                    <thead class="table-light">
                        <tr>
                            <th class="text-truncate">ID</th>
                            <th class="text-truncate">Date</th>
                            <th class="text-truncate">User ID</th>
                            <th class="text-truncate">Total amount</th>
                            <th class="text-truncate">Status</th>
                        </tr>

                    </thead>
                    <tbody>
                        @if (count($orders) < 1)
                            <tr>
                                <td class="text-truncate">
                                    <p class="fw-normal mb-1">Data no found.</p>
                                </td>
                            </tr>
                        @else
                            @foreach ($orders as $order)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="{{ route('order.detail', $order->id) }}"
                                                class="fw-bold mb-1">{{ $order->id }}</a>
                                        </div>
                                    </td>

                                    <td class="text-truncate">
                                        <p class="fw-normal mb-1">
                                            {{ Carbon\Carbon::parse($order->date)->format('d/m/Y') }}
                                        </p>
                                        {{-- <p class="fw-normal mb-1">{{ date('m/d/Y', $order->date) }}</p> --}}
                                    </td>
                                    <td class="text-truncate">
                                        <p class="fw-normal mb-1">{{ $order->user_id }}</p>
                                    </td>
                                    <td class="text-truncate">
                                        <p class="fw-normal mb-1">RM {{ number_format($order->total_amount, 2) }}</p>
                                    </td>
                                    <td class="text-truncate">
                                        @if ($order->status == 'pay')
                                            <span class="badge bg-label-secondary rounded-pill">To
                                                {{ ucfirst($order->status) }}</span>
                                        @elseif ($order->status == 'ship')
                                            <span class="badge bg-label-warning rounded-pill">To
                                                {{ ucfirst($order->status) }}</span>
                                        @elseif ($order->status == 'receive')
                                            <span class="badge bg-label-primary rounded-pill">To
                                                {{ ucfirst($order->status) }}</span>
                                        @elseif (strtolower($order->status) == 'completed')
                                            <span
                                                class="badge bg-label-success rounded-pill">{{ ucfirst($order->status) }}</span>
                                        @else
                                            <span
                                                class="badge bg-label-danger rounded-pill">{{ ucfirst($order->status) }}</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!--/ Data Tables -->
    <div class="m-4 d-flex justify-left">
        {!! $orders->render() !!}
    </div>
@endsection
