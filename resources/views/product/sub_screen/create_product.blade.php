@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <h5 class="card-header">Create new product</h5>
                <div class="card-body">

                    <form method="POST" action="{{ route('product.store') }}" onsubmit="return getSelectedOption();"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <!-- Personal Info -->
                            <div class="col-12">
                                <h6 class="mt-2">1. Product Information</h6>
                                <hr class="mt-0" />
                            </div>
                            <!-- Product Details -->

                            {{-- Product Name --}}
                            <div class="col-md-6 mb-3">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" class="form-control" placeholder="Soil" name="name" required />
                                    <label for="name">Product Name</label>
                                </div>
                            </div>

                            {{-- Product Price --}}
                            <div class="col-md-6 mb-3">
                                <div class="form-floating form-floating-outline">
                                    <input type="number" class="form-control" placeholder="99.99" name="price"
                                        onkeypress="return (event.charCode >= 48 && event.charCode <= 57) ||
                                event.charCode == 46 || event.charCode == 0 "
                                        min="1" step="0.01" required />
                                    <label for="price">Product Price</label>
                                </div>
                            </div>

                            {{-- Category --}}
                            <div class="form-floating form-floating-outline col-md-6 mb-3">
                                <select class="form-select" id="selectCategory" aria-label="Default select example"
                                    name="category_id">
                                    <option value="default" disabled selected>Choose option</option>
                                    @foreach ($category as $categories)
                                        <option value="{{ $categories->id }}">{{ $categories->name }}</option>
                                    @endforeach
                                </select>
                                <label for="exampleFormControlSelect1">Category</label>
                            </div>

                            {{-- Material --}}
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" class="form-control" placeholder="Plastic" name="material"
                                        required />
                                    <label for="name">Material</label>
                                </div>
                            </div>


                            {{-- Size --}}
                            <div class="col-md-6 mt-sm-3 mt-md-0 ">
                                <div class="form-floating form-floating-outline">
                                    <input type="number" class="form-control" placeholder="5 CM" name="size"
                                        onkeypress="return (event.charCode >= 48 && event.charCode <= 57) ||
                                    event.charCode == 46 || event.charCode == 0 "
                                        min="0" step="0.01" required />
                                    <label for="price">Size</label>
                                </div>
                            </div>

                            {{-- Weight --}}
                            <div class="col-md-6  mt-sm-3 mt-md-0">
                                <div class="form-floating form-floating-outline">
                                    <input type="number" class="form-control" placeholder="5 KG" name="weight"
                                        onkeypress="return (event.charCode >= 48 && event.charCode <= 57) ||
                                    event.charCode == 46 || event.charCode == 0 "
                                        min="0" step="0.01" required />
                                    <label for="price">Weight</label>
                                </div>
                            </div>

                            {{-- Length --}}
                            <div class="col-md-6  mt-sm-3 mt-md-3">
                                <div class="form-floating form-floating-outline">
                                    <input type="number" class="form-control" placeholder="5 KG" name="length"
                                        onkeypress="return (event.charCode >= 48 && event.charCode <= 57) ||
                                    event.charCode == 46 || event.charCode == 0 "
                                        min="0" step="0.01" required />
                                    <label for="price">Length</label>
                                </div>
                            </div>

                            {{-- Description --}}
                            <div class="col-md-12 mb-3 mt-3">
                                <div class="form-floating form-floating-outline">
                                    <textarea class="form-control h-px-100" name="description" maxlength="500"
                                        placeholder="Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmm ad minim veniam......"
                                        rows="3" required></textarea>
                                    <label for="description">Product description</label>
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
                            <div class="col-md-12 mt-3">
                                <div class="form-floating form-floating-outline">
                                    <input class="form-control" type="file" id="formFile" name="image[]" multiple
                                        accept="image/*">
                                    <label for="formValidationFile">Product Image</label>
                                </div>
                            </div>

                            <!-- Stock Info -->
                            <div class="col-12 mt-4">
                                <h6 class="mt-">2. Stock Information </h6>
                                <hr class="mt-0" />
                            </div>

                            {{-- Stock --}}
                            <div class="col-md-6 mt-md-1 mt-sm-3">
                                <div class="form-floating form-floating-outline">
                                    <input type="number" class="form-control" placeholder="9" name="quantity"
                                        onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57"
                                        min="0" required />
                                    <label for="inventory">Product Inventory</label>
                                </div>
                            </div>

                            {{-- Reason --}}
                            <div class="col-md-6 mt-md-1 mt-sm-3">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" class="form-control" placeholder="..." name="reason"
                                        required />
                                    <label for="name">Reason</label>
                                </div>
                            </div>

                            <div class="col-md-12 mt-3">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="{{ route('product.index') }}" class="btn btn-primary" value="Back">Back</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function getSelectedOption() {
            // selectCategory
            var selectElement = document.getElementById("selectCategory");
            var selectedOptionValue = selectElement2.value;

            if (selectedOptionValue === "default") {
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
