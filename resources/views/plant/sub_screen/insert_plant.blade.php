@extends('layouts.app')

@section('content')
    <style>
        .card-registration .select-input.form-control[readonly]:not([disabled]) {
            font-size: 1rem;
            line-height: 2.15;
            padding-left: .75em;
            padding-right: .75em;
        }

        .card-registration {
            background-color: #ECFFDC;
            box-shadow: 0 2px 5px 0 rgb(0 0 0 / 16%), 0 2px 10px 0 rgb(0 0 0 / 12%);
        }

        /* .card-registration .select-arrow {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    top: 13px;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                } */
    </style>
    <script>
        function getSelectedOption() {
            // selectCategory
            var selectElement = document.getElementById("selectSunlight");
            var selectedOptionValue = selectElement.value;
            var selectElement1 = document.getElementById("selectWater");
            var selectedOptionValue1 = selectElement1.value;
            var selectElement2 = document.getElementById("selectCategory");
            var selectedOptionValue2 = selectElement2.value;

            if (selectedOptionValue === "default" || selectedOptionValue1 === "default" ||
                selectedOptionValue2 === "default") {
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

    <section class=" gradient-custom">
        <div class="container py-5 h-100">
            <div class="row  h-100">
                <div class="col-12 col-lg-9 col-xl-7">
                    <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                        <div class="card-body p-4 p-md-5">
                            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5 display-5">Add Plant</h3>
                            <form method="POST" action="{{ route('plant.store') }}" onsubmit="return getSelectedOption();"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4 mb-4 d-flex align-items-center">
                                        <div class="form-outline">
                                            <input type="text" id="name" name="name"
                                                class="form-control form-control-lg" placeholder="Plant Name" required />
                                            <label class="form-label" for="name">Plant Name</label>
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-4 ">
                                        <input type="number" id="quantity" name="quantity"
                                            onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57"
                                            min="0" class="form-control form-control-lg"
                                            placeholder="Plant Inventory" required />
                                        <div class="w-100"></div>
                                        <label class="form-label">Plant Quantity</label>
                                    </div>

                                    <div class="col-md-4 mb-4 d-flex align-items-center">

                                        <div class="form-outline">
                                            <input type="number" id="price" name="price" step="0.01"
                                                onkeypress="return (event.charCode >= 48 && event.charCode <= 57) ||
                                                event.charCode == 46 || event.charCode == 0 "
                                                min="0" class="form-control form-control-lg"
                                                placeholder="Plant Price" required />
                                            <label class="form-label" for="price">Plant Price</label>
                                        </div>


                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 mb-4 d-flex align-items-center">
                                        <div class="form-outline">
                                            <select class="select form-control-lg px-3" id="selectSunlight" name="sunlight">
                                                <option value="default" disabled selected>Choose option</option>
                                                <option value="Full">Full</option>
                                                <option value="Partial">Partial</option>
                                                <option value="Shade">Shade</option>
                                            </select>
                                            <div class="w-100"></div>
                                            <label class="form-label">Sunlight Need</label>
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-4 d-flex align-items-center">
                                        <div class="form-outline">
                                            <select class="select form-control-lg px-3" id="selectWater" name="water">
                                                <option value="default" disabled selected>Choose option</option>
                                                <option value="High">High</option>
                                                <option value="Moderate">Moderate</option>
                                                <option value="Low">Low</option>
                                            </select>
                                            <div class="w-100"></div>
                                            <label class="form-label">Water Need</label>
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-4 d-flex align-items-center">
                                        <div class="form-outline">
                                            <input type="number" id="height" name="height" step="0.01"
                                                onkeypress="return (event.charCode >= 48 && event.charCode <= 57) ||
                                                event.charCode == 46 || event.charCode == 0 "
                                                min="0" class="form-control form-control-lg"
                                                placeholder="Mature Height(M)" required />
                                            <label class="form-label">Mature Height</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4 d-flex align-items-center">
                                        <div class="form-outline">
                                            <select class="select form-control-lg px-3 col-md-12" id="selectCategory"
                                                name="category_id">
                                                <option value="default" disabled selected>Choose option</option>
                                                @foreach ($category as $categories)
                                                    <option value="{{ $categories->id }}">{{ $categories->name }}</option>
                                                @endforeach
                                            </select>
                                            <div class="w-100"></div>
                                            <label class="form-label">Plant Category</label>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-4 d-flex align-items-center">
                                        <div class="form-outline">
                                            <input type="text" id="origin" name="origin"
                                                class="form-control form-control-lg" placeholder="Plant Origin" required />
                                            <label class="form-label" for="name">Plant Origin</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 mb-4 d-flex align-items-center">
                                        <div class="form-outline col-md-12">
                                            <textarea class="form-control col-md-12" id="description" rows="3" name="description" maxlength="500"
                                                required></textarea>
                                            <label class="form-label" for="name">Plant Description</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4 d-flex align-items-center">
                                        <div class="form-outline">
                                            <input class="form-control" type="file" id="formFile" name="image"
                                                onchange="preview()">
                                            <label class="form-label" for="name">Plant Image</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 mb-4 d-flex align-items-center">
                                        <div class="form-outline">
                                            <img id="frame" class="img-fluid m-1"
                                                style="height:200px; width:200px" />
                                            <div class="w-100"></div>
                                            <label class="form-label" for="name">Plant Image Preview</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-1 pt-2">
                                    <input class="btn btn-lg" style="background-color: #00A36C; color: white;"
                                        type="submit" value="Submit" />
                                    <a href="{{ route('plant.index') }}" class="btn btn-lg"
                                        style="background-color: #00A36C; color: white;" type="submit"
                                        value="Back">Back</a>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection