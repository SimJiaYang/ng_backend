@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <h5 class="card-header">Product Inventory Management</h5>
                <div class="card-body">
                    @foreach ($product as $products)
                        <form method="POST" action="{{ route('product.stock.update') }}"
                            onsubmit="return getSelectedOption();">
                            @csrf
                            {{-- ID --}}
                            <input type="hidden" name="id" value="{{ $products->id }}" />

                            {{-- Stock --}}
                            <div class="col-md-12 mt-md-1 mt-sm-3">
                                <div class="form-floating form-floating-outline">
                                    <input type="number" class="form-control" placeholder="9" name="quantity"
                                        onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57"
                                        min="0" required value="{{ $products->quantity }}" readonly />
                                    <label for="inventory">Product Inventory</label>
                                </div>
                            </div>

                            {{-- Operation --}}
                            <div class ="col-md-12 row">
                                <div class="form-floating form-floating-outline col-md-6 mt-3">
                                    <select class="form-select" id="selectOperation" name="operation">
                                        <option value="default" disabled selected>Choose option</option>
                                        <option value="Add">Add</option>
                                        <option value="Minus">Minus</option>
                                    </select>
                                    <label for="exampleFormControlSelect1">Operation</label>
                                </div>

                                {{-- Stock --}}
                                <div class="col-md-6 mt-md-3 mt-sm-3">
                                    <div class="form-floating form-floating-outline">
                                        <input type="number" class="form-control" placeholder="" name="stock_quantity"
                                            onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57"
                                            min="1" required />
                                        <label for="inventory">Stock Quantity</label>
                                    </div>
                                </div>
                            </div>

                            {{-- Price --}}
                            <div class="col-md-6 mt-3">
                                <div class="form-floating form-floating-outline">
                                    <input type="number" class="form-control" placeholder="RM" name="price"
                                        onkeypress="return (event.charCode >= 48 && event.charCode <= 57) ||
                                        event.charCode == 46 || event.charCode == 0 "
                                        min="0" step="0.01" required />
                                    <label for="price">Unit Price</label>
                                </div>
                            </div>

                            {{-- Reason --}}
                            <div class="col-md-12 mt-md-3 mt-sm-3">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" class="form-control" placeholder="..." name="reason" required />
                                    <label for="name">Reason</label>
                                </div>
                            </div>

                            {{-- DbUTTON --}}
                            <div class="col-md-12 mb-3 mt-3">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="{{ route('product.index') }}" class="btn btn-primary" value="Back">Back</a>
                            </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <script>
        function getSelectedOption() {
            var selectElement = document.getElementById("selectOperation");
            var selectedOptionValue = selectElement.value;

            if (selectedOptionValue === "default") {
                alert("Please select an option");
                return false; // Prevent form submission
            } else {
                return true; // Allow form submission
            }
        }
    </script>
@endsection
