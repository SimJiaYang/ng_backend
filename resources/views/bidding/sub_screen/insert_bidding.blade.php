@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <h5 class="card-header">Create a new Bid</h5>
                <div class="card-body">

                    <form method="POST" action="" enctype="multipart/form-data" onsubmit="return validateDateTime();">
                        @csrf
                        <!-- Personal Info -->
                        <div class="col-12">
                            <h6 class="mt-2">Basic Information</h6>
                            <hr class="mt-0" />
                        </div>
                        <!-- Plant Details -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-floating form-floating-outline">
                                    <select class="form-select" id="selectPlant" aria-label="Default select example"
                                        name="plant_id">
                                        <option value="default" disabled selected>Choose option</option>
                                        @foreach ($plants as $plant)
                                            <option value="{{ $plant->id }}">{{ $plant->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-floating form-floating-outline">
                                    <input type="number" class="form-control" placeholder="99.99" name="price"
                                        onkeypress="return (event.charCode >= 48 && event.charCode <= 57) ||
								event.charCode == 46 || event.charCode == 0 "
                                        min="1" step="0.01" required />
                                    <label for="price">Minimal amount</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-floating form-floating-outline">
                                    <input type="number" class="form-control" placeholder="99.99" name="price"
                                        onkeypress="return (event.charCode >= 48 && event.charCode <= 57) ||
								event.charCode == 46 || event.charCode == 0 "
                                        min="1" step="0.01" required />
                                    <label for="price">Bid minimal amount</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-floating form-floatsing-outline">
                                    <input type="datetime-local" class="form-control" id="start_time" name="start_time"
                                        required />
                                    <label for="price">Start Time</label>
                                    <span id="datetimeError" class="error" style="color: red"></span>
                                    <br>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating form-floatsing-outline">
                                    <input type="datetime-local" class="form-control" id="end_time" name="end_time"
                                        required />
                                    <label for="price">End Time</label>
                                    <span id="datetimeError1" class="error" style="color: red"></span>
                                    <br>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="" class="btn btn-primary" value="Back">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function validateDateTime() {
            var dateTimeInput = document.getElementById('start_time');
            var endTimeInput = document.getElementById('end_time');
            var datetimeError = document.getElementById('datetimeError');
            var datetimeError1 = document.getElementById('datetimeError1');

            var selectedDateTime = new Date(dateTimeInput.value);
            var selectedEndTime = new Date(endTimeInput.value);
            var currentDate = new Date();

            // Check if selected date is in the future
            if (selectedDateTime <= currentDate) {
                datetimeError.innerHTML = 'Please select a future date and time.';
                return false;
            }

            // Check if selected date is after end time
            if (selectedEndTime <= currentDate) {
                datetimeError1.innerHTML = 'Please select a future date and time.';
                return false;
            }

            // Check if selected time is after half an hour from now
            var halfHourFromNow = new Date(currentDate.getTime() + (30 * 60 * 1000));
            if (selectedDateTime <= halfHourFromNow) {
                datetimeError.innerHTML = 'Please select a time after half an hour from now.';
                return false;
            }
            if (selectedEndTime <= halfHourFromNow) {
                datetimeError1.innerHTML = 'Please select a time after half an hour from now.';
                return false;
            }
            // Check if selected time is between 8am and 8pm
            var selectedTime = selectedDateTime.getHours();
            if (selectedTime < 8 || selectedTime >= 20) {
                datetimeError.innerHTML = 'Please select a time between 8am and 8pm.';
                return false;
            }

            var selectedEndTime = selectedEndTime.getHours();
            if (selectedEndTime < 8 || selectedEndTime >= 20) {
                datetimeError1.innerHTML = 'Please select a time between 8am and 8pm.';
                return false;
            }

            // Clear any previous error messages
            datetimeError.innerHTML = '';
            return true;
        }

        function getSelectedOption() {
            // selectCategory
            var selectElement = document.getElementById("selectSunlight");
            var selectedOptionValue = selectElement.value;
            var selectElement1 = document.getElementById("selectWater");
            var selectedOptionValue1 = selectElement1.value;
            var selectElement2 = document.getElementById("selectCategory");
            var selectedOptionValue2 = selectElement2.value;
            var selectElement3 = document.getElementById("status");
            var selectedOptionValue3 = selectElement3.value;

            if (selectedOptionValue === "default" || selectedOptionValue1 === "default" ||
                selectedOptionValue2 === "default" || selectedOptionValue3 === "default") {
                alert("Please select an option");
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
