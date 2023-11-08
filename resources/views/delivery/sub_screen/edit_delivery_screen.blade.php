@extends('layouts.app')

@section('content')
    <div class="card-header d-flex justify-content-between align-items-center mb-3 px-0">
        <h5 class="mb-0">Edit Order Delivery Status</h5>
    </div>
    @foreach ($deliver as $delivery)
        <form method="POST"
            action="{{ route('delivery.update', ['id' => $delivery->id, 'order_id' => $delivery->order_ids]) }}"
            enctype="multipart/form-data">
            @csrf
            <div class="form-floating form-floating-outline mb-4">
                <select class="form-select" id="selectOption" aria-label="Default select example" name="status">
                    <option hidden value="ship">Deliver in progress</option>
                    <option value="ship">Deliver in progress</option>
                    <option value="delivered">Delivered</option>
                </select>
                <label for="exampleFormControlSelect1">Delivery Status</label>
            </div>

            <div class="form-floating form-floating-outline mb-4">
                <input type="text" id="method" name="method" class="form-control" value="{{ $delivery->method }}"
                    id="basic-default-fullname" placeholder="Delivery Company" required />
                <label for="basic-default-fullname">Delivery Company</label>
            </div>

            <div class="form-floating form-floating-outline mb-4">
                <input type="text" id="track_num" name="track_num" class="form-control"
                    value="{{ $delivery->tracking_number }}" id="basic-default-fullname" placeholder="Tracking Number"
                    required />
                <label for="basic-default-fullname">Tracking Number</label>
            </div>

            <div class="form-floating form-floating-outline mb-4">
                <input class="form-control" type="date" id="html5-date-input" required
                    value="{{ $delivery->expected_date }}" name="expected_date" />
                <label for="html5-date-input">Expected Date</label>
            </div>

            <div class="col-12">
                <h6 class="mt-2">Proof of Delivery</h6>
            </div>

            <div class="col-md-12">
                <div class="form-floating form-floating-outline">
                    <img id="frame" class="img-fluid m-1" style="height:200px; width:200px" />
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-floating form-floating-outline my-3">
                    <input class="form-control" type="file" id="formFile" name="image_proof" onchange="preview()">
                    <label for="formValidationFile">Proof of Delivery</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
    @endforeach
    </form>
    <script>
        //Calculate the total price
        function cal() {
            var items = document.getElementsByName('items[]');
            var cboxes = document.getElementsByName('cid[]');

            var id = [];
            var len = cboxes.length;

            for (var i = 0; i < len; i++) {
                if (cboxes[i].checked) {
                    id.push(cboxes[i].value);
                }
            }
            document.getElementById('items[]').value = id;
        }

        function getSelectedOption() {
            var selectedItem = document.getElementById('items[]').value;
            console.log(selectedItem);
            if (selectedItem === "") {
                alert("Please tick the item you want to deliever at first");
                return false; // Prevent form submission
            }

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

        function validateCompleted() {
            var selectElement = document.getElementById("selectOption");
            var selectedOptionValue = selectElement.value;

            if ((selectedOptionValue === "delivered" && frame.src === "") ||
                (selectedOptionValue === "ship" && frame.src !== "")
            ) {
                alert("Please update the delivery status of the order and ensure the prove of delivery is updated");
                return false; // Prevent form submission
            } else {
                // You can now use the selectedOptionValue in your further processing
                return true; // Allow form submission
            }
        }

        function preview() {
            frame.src = URL.createObjectURL(event.target.files[0]);
        }

        function clearImage() {
            document.getElementById('formFile').value = null;
            frame.src = "";
        }
    </script>
@endsection
