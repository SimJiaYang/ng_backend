@extends('layouts.app')
@section('content')
    <!-- Basic Layout -->
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Order Status</h5>
                </div>
                <div class="card-body">
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <blockquote class="blockquote mb-0">
                                    <p>
                                        @foreach ($orders as $order)
                                            Order ID: {{ $order->id }} <br>
                                            Order Date: {{ Carbon\Carbon::parse($order->date)->format('d/m/Y') }} <br>
                                            Order Status:
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
                                        @endforeach

                                    </p>
                                    <footer class="blockquote-footer  mt-1">
                                        @foreach ($user as $users)
                                            <cite title="Order Owner">{{ $users->name }}</cite>
                                        @endforeach
                                    </footer>
                                </blockquote>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    @endsection
