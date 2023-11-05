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
                                            <b>Order ID:</b> {{ $order->id }} <br>
                                            <b>Order Date:</b> {{ Carbon\Carbon::parse($order->date)->format('d/m/Y') }}
                                            <br>
                                            <b>Order Address:</b><br> {{ $order->address }}<br><br>
                                            <b>Order Status:</b>
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
                    @if (strtolower($order->status) == 'ship')
                        <div class="card-header d-flex justify-content-between align-items-center m-0 px-0">
                            <h5 class="mb-0">Edit Order Delivery Status</h5>
                        </div>
                        <form method="POST" action="{{ route('delivery.update', ['id' => $order->id]) }}"
                            onsubmit="return getSelectedOption()">
                            @csrf
                            @foreach ($deliver as $delivery)
                                <div class="form-floating form-floating-outline mb-4">
                                    <select class="form-select" id="selectOption" aria-label="Default select example"
                                        name="status">
                                        @if ($delivery->status == 'pack')
                                            <option hidden value="{{ $delivery->status }}">Ready for packaging
                                            @elseif($delivery->status == 'ready')
                                            <option hidden value="{{ $delivery->status }}">Ready to deliver
                                            @elseif($delivery->status == 'ship')
                                            <option hidden value="{{ $delivery->status }}">Deliver in progress
                                        @endif

                                        </option>
                                        <option value="pack">Ready for packaging</option>
                                        <option value="ready">Ready to deliver</option>
                                        <option value="ship">Deliver in progress</option>
                                        {{-- <option value="delivered">Delivered</option> --}}
                                    </select>
                                    <label for="exampleFormControlSelect1">Type</label>
                                </div>
                                <div class="form-floating form-floating-outline mb-4">
                                    <input type="text" id="method" name="method" class="form-control"
                                        id="basic-default-fullname" placeholder="Delivery Company" required />
                                    <label for="basic-default-fullname">Delivery company</label>
                                </div>
                                <div class="form-floating form-floating-outline mb-4">
                                    <input type="text" id="track_num" name="track_num" class="form-control"
                                        id="basic-default-fullname" placeholder="Tracking Number" required />
                                    <label for="basic-default-fullname">Tracking Number</label>
                                </div>
                                <div class="form-floating form-floating-outline mb-4">
                                    <input class="form-control" type="date" id="html5-date-input" required />
                                    <label for="html5-date-input">Expected date</label>
                                </div>
                                <button type="submit" class="btn btn-primary">Save</button>
                            @endforeach
                        </form>
                    @endif



                </div>
            </div>
        </div>
        <script>
            function getSelectedOption() {
                var selectElement = document.getElementById("selectOption");
                var selectedOptionValue = selectElement.value;

                if (selectedOptionValue === "pack") {
                    alert("Please update the delivery status of the order");
                    return false; // Prevent form submission
                } else {
                    // You can now use the selectedOptionValue in your further processing
                    return true; // Allow form submission
                }
            }
        </script>

    @endsection
