@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <h5 class="card-header">Create new plant</h5>
                <div class="card-body">

                    <form method="POST" action="{{ route('plant.store') }}" class="row g-3"
                        onsubmit="return getSelectedOption();" enctype="multipart/form-data">
                        @csrf
                        <!-- Personal Info -->
                        <div class="col-12">
                            <h6 class="mt-2">1. Plant Information</h6>
                            <hr class="mt-0" />
                        </div>

                        <!-- Plant Details -->

                        {{-- Name --}}
                        <div class="col-md-6 mt-md-1 mt-sm-3">
                            <div class="form-floating form-floating-outline">
                                <input type="text" class="form-control" placeholder="Lotus" name="name" required />
                                <label for="name">Plant Name</label>
                            </div>
                        </div>

                        {{-- Price --}}
                        <div class="col-md-6 mt-1 mt-md-1 mt-sm-3">
                            <div class="form-floating form-floating-outline">
                                <input type="number" class="form-control" placeholder="RM 99.99" name="price"
                                    onkeypress="return (event.charCode >= 48 && event.charCode <= 57) ||
                                        event.charCode == 46 || event.charCode == 0 "
                                    min="1" step="0.01" required />
                                <label for="price">Plant Price</label>
                            </div>
                        </div>

                        {{-- Placement --}}
                        <div class="form-floating form-floating-outline col-md-6">
                            <select class="form-select" id="placement" name="placement">
                                <option value="default" disabled selected>Choose option</option>
                                <option value="Indoor">Indoor</option>
                                <option value="Outdoor">Outdoor</option>
                            </select>
                            <label for="exampleFormControlSelect1">Placement</label>
                        </div>

                        {{-- Temperature --}}
                        <div class="col-md-6">
                            <div class="form-floating form-floating-outline">
                                <input type="number" class="form-control" placeholder="26 Celsius" name="temperature"
                                    onkeypress="return (event.charCode >= 48 && event.charCode <= 57) ||
                                        event.charCode == 46 || event.charCode == 0 "
                                    min="1" step="0.01" required />
                                <label for="price">Temperature</label>
                            </div>
                        </div>

                        {{-- Water Need --}}
                        <div class="form-floating form-floating-outline col-md-6">
                            <select class="form-select" id="selectWater" name="water">
                                <option value="default" disabled selected>Choose option</option>
                                <option value="High">High</option>
                                <option value="Moderate">Moderate</option>
                                <option value="Low">Low</option>
                            </select>
                            <label for="exampleFormControlSelect1">Water Need</label>
                        </div>

                        {{-- Height --}}
                        <div class="col-md-6">
                            <div class="form-floating form-floating-outline">
                                <input type="number" class="form-control" placeholder="20 CM" name="height"
                                    onkeypress="return (event.charCode >= 48 && event.charCode <= 57) ||
                                    event.charCode == 46 || event.charCode == 0 "
                                    min="0" step="0.01" required />
                                <label for="price">Height</label>
                            </div>
                        </div>

                        {{-- Sunlight Need --}}
                        <div class="form-floating form-floating-outline col-md-6">
                            <select class="form-select" id="selectSunlight" name="sunlight">
                                <option value="default" disabled selected>Choose option</option>
                                <option value="Full">Full</option>
                                <option value="Partial">Partial</option>
                                <option value="Shade">Shade</option>
                            </select>
                            <label for="exampleFormControlSelect1">Sunlight Need</label>
                        </div>

                        {{-- Size --}}
                        <div class="col-md-6">
                            <div class="form-floating form-floating-outline">
                                <input type="number" class="form-control" placeholder="5 CM" name="size"
                                    onkeypress="return (event.charCode >= 48 && event.charCode <= 57) ||
                                    event.charCode == 46 || event.charCode == 0 "
                                    min="0" step="0.01" required />
                                <label for="price">Size</label>
                            </div>
                        </div>

                        {{-- Weight --}}
                        <div class="col-md-6">
                            <div class="form-floating form-floating-outline">
                                <input type="number" class="form-control" placeholder="5 KG" name="weight"
                                    onkeypress="return (event.charCode >= 48 && event.charCode <= 57) ||
                                    event.charCode == 46 || event.charCode == 0 "
                                    min="0" step="0.01" required />
                                <label for="price">Weight</label>
                            </div>
                        </div>

                        {{-- Origin --}}
                        <div class="col-md-6">
                            <div class="form-floating form-floating-outline">
                                <input type="text" class="form-control" placeholder="Malaysia" name="origin"
                                    required />
                                <label for="origin">Plant Origin</label>
                            </div>
                        </div>

                        {{-- Category --}}
                        <div class="form-floating form-floating-outline col-md-6">
                            <select class="form-select" id="selectCategory" aria-label="Default select example"
                                name="category_id">
                                <option value="default" disabled selected>Choose option</option>
                                @foreach ($category as $categories)
                                    <option value="{{ $categories->id }}">{{ $categories->name }}</option>
                                @endforeach
                            </select>
                            <label for="exampleFormControlSelect1">Category</label>
                        </div>

                        {{-- Experience Level --}}
                        <div class="form-floating form-floating-outline col-md-6">
                            <select class="form-select" id="selectExperience" name="experience">
                                <option value="default" disabled selected>Choose option</option>
                                <option value="Beginner">Beginner</option>
                                <option value="Intermediate">Intermediate</option>
                                <option value="Experienced">Experienced</option>
                            </select>
                            <label for="exampleFormControlSelect1">Experience Level</label>
                        </div>


                        {{-- Description --}}
                        <div class="col-md-12">
                            <div class="form-floating form-floating-outline">
                                <textarea class="form-control h-px-100" name="description" maxlength="500"
                                    placeholder="Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmm ad minim veniam......"
                                    rows="3" required></textarea>
                                <label for="description">Plant description</label>
                            </div>
                        </div>

                        {{-- Additional Description --}}
                        <div class="col-md-12">
                            <div class="form-floating form-floating-outline">
                                <textarea class="form-control h-px-100" name="other" maxlength="1000"
                                    placeholder="Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmm ad minim veniam......"
                                    rows="3"></textarea>
                                <label for="description">Addtional description(Optional)</label>
                            </div>
                        </div>

                        {{-- Image --}}
                        <div class="col-md-12">
                            <div class="form-floating form-floating-outline">
                                <input class="form-control" type="file" id="formFile" name="image[]" multiple
                                    accept="image/*">
                                <label for="formValidationFile">Plant Image</label>
                            </div>
                        </div>

                        <!-- Pot Information -->
                        <div class="col-12">
                            <h6 class="mt-2">2. Pot Information (Optional) </h6>
                            <hr class="mt-0" />
                        </div>

                        {{-- Pot Name --}}
                        <div class="col-md-6 mt-md-1 mt-sm-3">
                            <div class="form-floating form-floating-outline">
                                <input type="text" class="form-control" placeholder="Pot..." name="pot_name" />
                                <label for="name">Pot Name</label>
                            </div>
                        </div>

                        {{-- Size --}}
                        <div class="col-md-6 mt-md-1 mt-sm-3">
                            <div class="form-floating form-floating-outline">
                                <input type="number" class="form-control" placeholder="10 CM" name="pot_size"
                                    onkeypress="return (event.charCode >= 48 && event.charCode <= 57) ||
                                    event.charCode == 46 || event.charCode == 0 "
                                    min="0" step="0.01" />
                                <label for="price">Size</label>
                            </div>
                        </div>

                        <!-- Plant Image Info -->
                        <div class="col-12">
                            <h6 class="mt-2">3. Stock Information </h6>
                            <hr class="mt-0" />
                        </div>

                        {{-- Stock --}}
                        <div class="col-md-6 mt-md-1 mt-sm-3">
                            <div class="form-floating form-floating-outline">
                                <input type="number" class="form-control" placeholder="9" name="quantity"
                                    onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57"
                                    min="0" required />
                                <label for="inventory">Plant Inventory</label>
                            </div>
                        </div>

                        {{-- Reason --}}
                        <div class="col-md-6 mt-md-1 mt-sm-3">
                            <div class="form-floating form-floating-outline">
                                <input type="text" class="form-control" placeholder="..." name="reason" required />
                                <label for="name">Reason</label>
                            </div>
                        </div>

                        {{-- <div class="col-md-12">
                            <div class="form-floating form-floating-outline">
                                <img id="frame" class="img-fluid m-1" style="height:200px; width:200px" />
                            </div>
                        </div> --}}

                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="{{ route('plant.index') }}" class="btn btn-primary" value="Back">Back</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function getSelectedOption() {

            var selectElement = document.getElementById("placement");
            var selectedOptionValue = selectElement.value;
            var selectElement1 = document.getElementById("selectWater");
            var selectedOptionValue1 = selectElement1.value;
            var selectElement2 = document.getElementById("selectSunlight");
            var selectedOptionValue2 = selectElement1.value;
            var selectElement3 = document.getElementById("selectCategory");
            var selectedOptionValue3 = selectElement2.value;
            var selectElement4 = document.getElementById("selectExperience");
            var selectedOptionValue4 = selectElement2.value;

            if (selectedOptionValue === "default" || selectedOptionValue1 === "default" ||
                selectedOptionValue2 === "default" || selectedOptionValue3 === "default" ||
                selectedOptionValue4 === "default") {
                alert("Please select an option");
                return false; // Prevent form submission
            } else {
                return true; // Allow form submission
            }
        }

        // function preview() {
        //     frame.src = URL.createObjectURL(event.target.files[0]);
        // }

        // function clearImage() {
        //     document.getElementById('formFile').value = null;
        //     frame.src = "";
        // }
    </script>
@endsection
